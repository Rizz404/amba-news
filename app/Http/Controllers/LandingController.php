<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class LandingController extends Controller
{
    public function index()
    {
        $articles = Article::all()->sortByDesc('published_at');
        $categories = Category::all();

        return view('pages.shared.landing.index', compact(['articles', 'categories']));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('pages.shared.landing.show', compact('article'));
    }
}
