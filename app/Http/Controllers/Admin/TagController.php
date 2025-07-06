<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::orderByDesc('updated_at')
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:tags'],
        ]);

        try {
            Tag::create($validated);

            return redirect()
                ->route('admin.tags.index')
                ->with('success', 'Tag created');
        } catch (\Exception $e) {
            Log::error('Create tag failed: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Create tag failed')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return view("pages.admin.tag.show", compact("tag"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view("pages.admin.tag.edit", compact("tag"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('tags')->ignore($tag->id)
            ],
        ]);

        try {
            $tag->update($validated);

            return redirect()
                ->route('admin.tags.show', $tag)
                ->with('success', 'Tag updated');
        } catch (\Exception $e) {
            Log::error('Update tag failed: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Update tag failed')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        try {
            $tag->delete();

            return redirect()
                ->route("admin.tags.index")
                ->with("success", "Tag deleted");
        } catch (\Exception $e) {
            Log::error('Delete tag failed: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Delete tag failed')
                ->with('raw', $e->getMessage())
                ->withInput();
        }
    }
}
