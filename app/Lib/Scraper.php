<?php

namespace App\Lib;

use App\Article;
use Goutte\Client as GoutteClient;

/**
 * Class Scraper
 *
 * handles and process scraping using specific link
 * first we work on the main filter expression which is the
 * the container of the items, then using annonymous callback
 * on the filter function we iterate and save the results
 * into the article table
 *
 * @package App\Lib
 */
class Scraper
{
    protected $client;

    public $results = [];

    public $savedItems = 0;

    public $status = 1;

    public function __construct(GoutteClient $client)
    {
        $this->client = $client;
    }

    public function handle($linkObj)
    {
        try {
            $crawler = $this->client->request('GET', $linkObj->url);

            $translateExpre = $this->translateCSSExpression($linkObj->itemSchema->css_expression);

            if (isset($translateExpre['title'])) {

                $data = [];

                // filter
                $crawler->filter($linkObj->main_filter_selector)->each(function ($node) use ($translateExpre, &$data, $linkObj) {

                    // using the $node var we can access sub elements deep the tree

                    foreach ($translateExpre as $key => $val) {

                        if($node->filter($val['selector'])->count() > 0) {

                            if ($val['is_attribute'] == false) {

                                $data[$key][] = preg_replace("#\n|'|\"#",'', $node->filter($val['selector'])->text());
                            } else {
                                if ($key == 'source_link') {

                                    $item_link = $node->filter($val['selector'])->attr($val['attr']);

                                    // append website url in case the article is not full url
                                    if ($linkObj->itemSchema->is_full_url == 0) {
                                        $item_link = $linkObj->website->url . $node->filter($val['selector'])->attr($val['attr']);
                                    }

                                    $data[$key][] = $item_link;
                                    $data['content'][] = $this->fetchFullContent($item_link, $linkObj->itemSchema->full_content_selector);
                                } else {
                                    $data[$key][] = $node->filter($val['selector'])->attr($val['attr']);
                                }
                            }
                        }
                    }

                    $data['category_id'][] = $linkObj->category->id;

                    $data['website_id'][] = $linkObj->website->id;

                });
                //dd($data);
                $this->save($data);

                $this->results = $data;
            }
        } catch (\Exception $ex) {
            $this->status = $ex->getMessage();
        }
    }


    /**
     * fetchFullContent
     *
     * this method pulls the full content of a single item using the
     * item url and selector
     *
     * @param $item_url
     * @param $selector
     * @return string
     */
    protected function fetchFullContent($item_url, $selector)
    {
        try {
            $crawler = $this->client->request('GET', $item_url);

            return $crawler->filter($selector)->html();
        } catch (\Exception $ex) {
            return "";
        }
    }

    protected function save($data)
    {
        foreach ($data['title'] as $k => $val) {

            $checkExist = Article::where('source_link', $data['source_link'][$k])->first();

            if(!isset($checkExist->id)) {

                $article = new Article();

                $article->title = $val;

                $article->excerpt = isset($data['excerpt'][$k]) ? $data['excerpt'][$k] : "";

                $article->content = isset($data['content'][$k]) ? $data['content'][$k] : "";

                $article->image = isset($data['image'][$k]) ? $data['image'][$k] : "";

                $article->source_link = $data['source_link'][$k];

                $article->category_id = $data['category_id'][$k];

                $article->website_id = $data['website_id'][$k];

                $article->save();

                $this->savedItems++;
            }
        }
    }


    /**
     * translateCSSExpression
     *
     * translate the css expression into corresponding fields and sub selectors
     *
     * @param $expression
     * @return array
     */
    protected function translateCSSExpression($expression)
    {
        $exprArray = explode("||", $expression);

        // try to match split that expression into pieces
        $regex = '/(.*?)\[(.*)\]/m';

        $fields = [];

        foreach ($exprArray as $subExpr) {

            preg_match($regex, $subExpr, $matches);

            if(isset($matches[1]) && isset($matches[2])) {

                $is_attribute = false;

                $selector = $matches[2];

                $attr = "";

                // if this condition meets then this is attribute like img[src] or a[href]
                if (strpos($selector, "[") !== false && strpos($selector, "]") !== false) {

                    $is_attribute = true;

                    preg_match($regex, $matches[2], $matches_attr);

                    $selector = $matches_attr[1];

                    $attr = $matches_attr[2];
                }

                $fields[$matches[1]] = ['field' => $matches[1], 'is_attribute' => $is_attribute, 'selector' => $selector, 'attr' => $attr];
            }
        }

        return $fields;
    }
}
