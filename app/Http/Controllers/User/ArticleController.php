<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pages.user.article.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('pages.user.article.create', compact(['categories', 'tags']));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'required|string|max:255',
            'content' => 'required|string',
            'featured_image_url' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('featured_image_url')) {
            $data['featured_image_url'] = $request->file('featured_image_url')->store('articles', 'public');
        }

        $data['user_id'] = Auth::id();
        $data['status'] = 'draft';

        Article::create($data);

        return redirect()->route('user.articles.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $article = Article::where('user_id', Auth::id())->findOrFail($id);
        $categories = Category::all();
        return view('pages.user.article.edit', compact('article', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::where('user_id', Auth::id())->findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'required|string|max:255',
            'content' => 'required|string',
            'featured_image_url' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('featured_image_url')) {
            $data['featured_image_url'] = $request->file('featured_image_url')->store('articles', 'public');
        }

        $article->update($data);

        return redirect()->route('user.articles.index')->with('success', 'Artikel berhasil diupdate.');
    }

    public function destroy($id)
    {
        $article = Article::where('user_id', Auth::id())->findOrFail($id);
        $article->delete();

        return redirect()->route('user.articles.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
