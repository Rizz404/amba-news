<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderByDesc('updated_at')
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:categories'],
            'description' => ['nullable', 'string',],
        ]);

        try {
            Category::create($validated);

            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Category created');
        } catch (\Exception $e) {
            Log::error('Create category failed: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Create category failed')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view("pages.admin.category.show", compact("category"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view("pages.admin.category.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('categories')->ignore($category->id)
            ],

            'description' => ['nullable', 'string',],
        ]);

        try {
            $category->update($validated);

            return redirect()
                ->route('admin.categories.show', $category)
                ->with('success', 'Category updated');
        } catch (\Exception $e) {
            Log::error('Update category failed: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Update category failed')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();

            return redirect()
                ->route("admin.categories.index")
                ->with("success", "Category deleted");
        } catch (\Exception $e) {
            Log::error('Delete category failed: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Delete category failed')
                ->with('raw', $e->getMessage())
                ->withInput();
        }
    }
}
