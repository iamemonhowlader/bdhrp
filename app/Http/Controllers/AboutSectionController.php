<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AboutSectionController extends BaseController
{
    public function index()
    {
        $sections = AboutSection::orderBy('sort_order')->get();
        return view('backend.about_sections.index', compact('sections'));
    }

    public function create()
    {
        return view('backend.about_sections.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'label' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:about_sections,slug',
            'menu_label' => 'nullable|string|max:255',
            'highlight' => 'nullable|string|max:255',
            'title_end' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image_file' => 'nullable|image|max:6144',
            'image_position' => 'required|in:left,right',
            'sort_order' => 'required|integer',
        ]);

        $data['is_active'] = $request->has('is_active');
        $data['show_in_menu'] = $request->has('show_in_menu');
        
        if ($request->hasFile('image_file')) {
            $data['image'] = $request->file('image_file')->store('about-sections', 'public');
        }

        if ($request->hasFile('additional_images')) {
            $additionalImages = [];
            foreach ($request->file('additional_images') as $file) {
                $additionalImages[] = $file->store('about-sections/additional', 'public');
            }
            $data['additional_images'] = $additionalImages;
        }

        AboutSection::create($data);

        return redirect()->route('admin.about-sections.index')->with('success', 'Section created successfully.');
    }

    public function edit(AboutSection $aboutSection)
    {
        return view('backend.about_sections.edit', compact('aboutSection'));
    }

    public function update(Request $request, AboutSection $aboutSection)
    {
        $data = $request->validate([
            'label' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:about_sections,slug,' . $aboutSection->id,
            'menu_label' => 'nullable|string|max:255',
            'highlight' => 'nullable|string|max:255',
            'title_end' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image_file' => 'nullable|image|max:10240',
            'additional_images.*' => 'nullable|image|max:10240',
            'image_position' => 'required|in:left,right',
            'sort_order' => 'required|integer',
        ]);

        $data['is_active'] = $request->has('is_active');
        $data['show_in_menu'] = $request->has('show_in_menu');

        if ($request->hasFile('image_file')) {
            if ($aboutSection->image) {
                Storage::disk('public')->delete($aboutSection->image);
            }
            $data['image'] = $request->file('image_file')->store('about-sections', 'public');
        }

        if ($request->hasFile('additional_images')) {
            // Remove old additional images
            if (is_array($aboutSection->additional_images)) {
                foreach ($aboutSection->additional_images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            $additionalImages = [];
            foreach ($request->file('additional_images') as $file) {
                $additionalImages[] = $file->store('about-sections/additional', 'public');
            }
            $data['additional_images'] = $additionalImages;
        }

        $aboutSection->update($data);

        return redirect()->route('admin.about-sections.index')->with('success', 'Section updated successfully.');
    }

    public function destroy(AboutSection $aboutSection)
    {
        if ($aboutSection->image) {
            Storage::disk('public')->delete($aboutSection->image);
        }
        $aboutSection->delete();
        return redirect()->route('admin.about-sections.index')->with('success', 'Section deleted successfully.');
    }
}
