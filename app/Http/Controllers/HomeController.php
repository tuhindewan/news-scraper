<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('id', 'DESC')->paginate(20);

        return view('home')->withArticles($articles);
    }

    public function getArticleDetails($id)
    {
        $article = Article::find($id);

        return view('details')->withArticle($article);
    }

    public function getCategory($id)
    {
        $category = Category::find($id);

        $articles = Article::where('category_id', $id)->orderBy('id', 'DESC')->paginate(20);

        return view('category')->withArticles($articles)->withCategory($category);
    }
}
