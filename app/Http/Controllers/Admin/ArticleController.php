<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with('category', 'user', 'tags')
            ->orderByDesc('updated_at')
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $status = Article::ARTICLE_STATUS;

        return view('pages.admin.article.create', compact('categories', 'tags', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:100', 'unique:articles,title'],
            'category_id' => ['required', 'exists:categories,id'],
            'content' => ['required', 'string'],
            'excerpt' => ['nullable', 'string', 'max:255'],
            'featured_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'status' => ['required', 'in:pending,draft,published'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['exists:tags,id']
        ]);

        try {
            $validated['user_id'] = Auth::id();

            if ($request->hasFile('featured_image')) {
                $path = $request->file('featured_image')->store('articles', 'public');
                $validated['featured_image_url'] = $path;
            }

            if ($validated['status'] === 'published') {
                $validated['published_at'] = now();
            }

            $article = Article::create($validated);

            if ($request->has('tags')) {
                $article->tags()->attach($request->tags);
            }

            return redirect()
                ->route('admin.articles.index')
                ->with('success', 'Article created');
        } catch (\Exception $e) {
            Log::error('Create article failed: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Create article failed')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        // * Muat relasi jika belum dimuat (jaga-jaga)
        $article->loadMissing('user', 'category', 'tags');
        return view("pages.admin.article.show", compact("article"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $article->load('tags'); // Eager load tags untuk form
        $status = Article::ARTICLE_STATUS;
        return view("pages.admin.article.edit", compact('article', 'categories', 'tags', 'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:100', Rule::unique('articles')->ignore($article->id)],
            'category_id' => ['required', 'exists:categories,id'],
            'content' => ['required', 'string'],
            'excerpt' => ['nullable', 'string', 'max:255'],
            'featured_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'status' => ['required', 'in:pending,draft,published'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['exists:tags,id']
        ]);

        try {
            if ($request->hasFile('featured_image')) {
                // Hapus gambar lama jika ada
                if ($article->featured_image_url) {
                    Storage::disk('public')->delete($article->featured_image_url);
                }
                $path = $request->file('featured_image')->store('articles', 'public');
                $validated['featured_image_url'] = $path;
            }

            // Atur tanggal publikasi jika status berubah menjadi published dan belum pernah di-set
            if ($validated['status'] === 'published' && is_null($article->published_at)) {
                $validated['published_at'] = now();
            }

            $article->update($validated);

            // Sinkronisasi tags
            $article->tags()->sync($request->tags ?? []);

            return redirect()
                ->route('admin.articles.show', $article)
                ->with('success', 'Article updated');
        } catch (\Exception $e) {
            Log::error('Update article failed: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Update article failed')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        try {
            if ($article->featured_image_url) {
                Storage::disk('public')->delete($article->featured_image_url);
            }

            $article->tags()->detach();
            $article->delete();

            return redirect()
                ->route("admin.articles.index")
                ->with("success", "Article deleted");
        } catch (\Exception $e) {
            Log::error('Delete article failed: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Delete article failed');
        }
    }
}
