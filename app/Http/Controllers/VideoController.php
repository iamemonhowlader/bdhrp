<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class VideoController extends BaseController
{
    public function index()
    {
        $videos = Video::orderBy('sort_order')->orderByDesc('created_at')->get();
        return view('backend.video.index', compact('videos'));
    }

    public function create()
    {
        return view('backend.video.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:1024',
            'duration' => 'nullable|string|max:20',
            'sort_order' => 'nullable|integer',
            'status' => 'boolean',
        ]);

        $data['url'] = $this->formatVideoUrl($data['url']);
        
        Video::create($data);

        return redirect()->route('admin.articles_videos.index')->with('success', 'Video report created successfully.');
    }

    public function edit(Video $articles_video)
    {
        return view('backend.video.edit', ['video' => $articles_video]);
    }

    public function update(Request $request, Video $articles_video)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:1024',
            'duration' => 'nullable|string|max:20',
            'sort_order' => 'nullable|integer',
            'status' => 'boolean',
        ]);

        $data['url'] = $this->formatVideoUrl($data['url']);
        
        $articles_video->update($data);

        return redirect()->route('admin.articles_videos.index')->with('success', 'Video report updated successfully.');
    }

    public function destroy(Video $articles_video)
    {
        $articles_video->delete();
        return redirect()->route('admin.articles_videos.index')->with('success', 'Video report deleted successfully.');
    }

    private function formatVideoUrl(string $url): string
    {
        if (str_contains($url, 'youtube.com/watch?v=')) {
            return str_replace('watch?v=', 'embed/', explode('&', $url)[0]);
        }
        if (str_contains($url, 'youtu.be/')) {
            return str_replace('youtu.be/', 'youtube.com/embed/', $url);
        }
        return $url;
    }
}
