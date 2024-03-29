<?php

namespace App\Http\Controllers;

use App\Category;
use App\ItemSchema;
use App\Lib\Scraper;
use App\Link;
use App\Website;
use Goutte\Client;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::orderBy('id', 'DESC')->paginate(10);
        return view('link.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $websites = Website::all();
        $itemSchemas = ItemSchema::all();
        return view('link.create', compact('categories', 'websites', 'itemSchemas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'url' => 'required',
            'main_filter_selector' => 'required',
            'website_id' => 'required',
            'category_id' => 'required',
            'item_schema_id' => 'required'
        ]);
        Link::create($request->all());
        return redirect()->route('links.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Link $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
        $categories = Category::all();
        $websites = Website::all();
        $itemSchemas = ItemSchema::all();

        return view('link.edit', compact('link', 'categories', 'websites', 'itemSchemas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Link $link
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Link $link)
    {
        $this->validate($request, [
            'url' => 'required',
            'main_filter_selector' => 'required',
            'website_id' => 'required',
            'category_id' => 'required'
        ]);
        $link->update($request->all());

        return redirect()->route('links.index');
    }



    public function scrape(Link $link)
    {
        if( !($this->url_test($link->url)) ) {
            return redirect()->back()->with('error', 'Your Requested ' . $link->url . 'is DOWN!');
        }

        if(empty($link->main_filter_selector) && (empty($link->item_schema_id) || $link->item_schema_id == 0)) {
            return;
        }

        $scraper = new Scraper(new Client());

        $scraper->handle($link);

        if($scraper->status == 1) {
            return redirect()->back()->with('message', 'SCRAPING DONE!');
        } else {
            return response()->json(['status' => 2, 'msg' => $scraper->status]);
        }
    }

    function url_test( $url ) {
        $timeout = 10;
        $ch = curl_init();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_TIMEOUT, $timeout );
        $http_respond = curl_exec($ch);
        $http_respond = trim( strip_tags( $http_respond ) );
        $http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        if ( ( $http_code == "200" ) || ( $http_code == "302" ) ) {
            return true;
        } else {
            // return $http_code;, possible too
            return false;
        }
        curl_close( $ch );
    }
}
