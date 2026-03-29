<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class TagController extends BaseController
{
    public function index()
    {
        $tags = Tag::withCount('articles')->orderBy('name')->paginate(20);

        return view('backend.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('backend.tags.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Helper::makeSlug($validated['slug'] ?? $validated['name'], 'tags');

        Tag::create($validated);

        return redirect()->route('admin.tags.index')->with('t-success', 'Tag created.');
    }

    public function edit(Tag $tag)
    {
        return view('backend.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:tags,slug,' . $tag->id,
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['slug']);

        $tag->update($validated);

        return redirect()->route('admin.tags.index')->with('t-success', 'Tag updated.');
    }

    public function destroy(Tag $tag)
    {
        $tag->articles()->detach();
        $tag->delete();

        return redirect()->route('admin.tags.index')->with('t-success', 'Tag deleted.');
    }
}
