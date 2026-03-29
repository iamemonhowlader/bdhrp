<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class GalleryPhotoController extends BaseController
{
    /**
     * All photos across albums (admin library).
     */
    public function library()
    {
        $photos = GalleryPhoto::with('gallery')->orderByDesc('id')->paginate(30);

        return view('backend.galleries.photos.library', compact('photos'));
    }

    public function index(Gallery $gallery)
    {
        $photos = $gallery->photos()->paginate(24);

        return view('backend.galleries.photos.index', compact('gallery', 'photos'));
    }

    public function create(Gallery $gallery)
    {
        return view('backend.galleries.photos.create', compact('gallery'));
    }

    public function store(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:8192',
            'caption' => 'nullable|string|max:500',
            'photo_group' => 'nullable|string|max:64',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $path = $request->file('image')->store('gallery-photos', 'public');

        GalleryPhoto::create([
            'gallery_id' => $gallery->id,
            'image_path' => $path,
            'caption' => $validated['caption'] ?? null,
            'photo_group' => $validated['photo_group'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.galleries.photos.index', $gallery)->with('t-success', 'Photo uploaded.');
    }

    public function edit(Gallery $gallery, GalleryPhoto $photo)
    {
        abort_unless($photo->gallery_id === $gallery->id, 404);

        return view('backend.galleries.photos.edit', compact('gallery', 'photo'));
    }

    public function update(Request $request, Gallery $gallery, GalleryPhoto $photo)
    {
        abort_unless($photo->gallery_id === $gallery->id, 404);

        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:8192',
            'caption' => 'nullable|string|max:500',
            'photo_group' => 'nullable|string|max:64',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = [
            'caption' => $validated['caption'] ?? null,
            'photo_group' => $validated['photo_group'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
        ];

        if ($request->hasFile('image')) {
            if ($photo->image_path) {
                Storage::disk('public')->delete($photo->image_path);
            }
            $data['image_path'] = $request->file('image')->store('gallery-photos', 'public');
        }

        $photo->update($data);

        return redirect()->route('admin.galleries.photos.index', $gallery)->with('t-success', 'Photo updated.');
    }

    public function destroy(Gallery $gallery, GalleryPhoto $photo)
    {
        abort_unless($photo->gallery_id === $gallery->id, 404);

        if ($photo->image_path) {
            Storage::disk('public')->delete($photo->image_path);
        }

        $photo->delete();

        return redirect()->route('admin.galleries.photos.index', $gallery)->with('t-success', 'Photo removed.');
    }
}
