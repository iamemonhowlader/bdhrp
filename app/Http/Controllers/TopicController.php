<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TopicController extends BaseController
{
    public function index()
    {
        $topics = Topic::orderBy('sort_order')->orderBy('title')->get();
        return view('backend.topic.index', compact('topics'));
    }

    public function create()
    {
        return view('backend.topic.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'image_file' => 'nullable|image|max:2048',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['is_active'] = $request->has('is_active');
        
        if ($request->hasFile('image_file')) {
            $data['image'] = $request->file('image_file')->store('topics', 'public');
        }

        Topic::create($data);

        return redirect()->route('admin.topics.index')->with('success', 'Topic created successfully.');
    }

    public function edit(Topic $topic)
    {
        return view('backend.topic.edit', compact('topic'));
    }

    public function update(Request $request, Topic $topic)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'image_file' => 'nullable|image|max:2048',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image_file')) {
            // Delete old image
            if ($topic->image) {
                Storage::disk('public')->delete($topic->image);
            }
            $data['image'] = $request->file('image_file')->store('topics', 'public');
        }

        $topic->update($data);

        return redirect()->route('admin.topics.index')->with('success', 'Topic updated successfully.');
    }

    public function destroy(Topic $topic)
    {
        if ($topic->image) {
            Storage::disk('public')->delete($topic->image);
        }
        $topic->delete();
        return redirect()->route('admin.topics.index')->with('success', 'Topic deleted successfully.');
    }
}
