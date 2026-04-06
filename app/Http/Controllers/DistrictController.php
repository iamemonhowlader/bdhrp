<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DistrictController extends BaseController
{
    public function index()
    {
        $districts = District::orderBy('division')->orderBy('name')->get();
        return view('backend.district.index', compact('districts'));
    }

    public function create()
    {
        return view('backend.district.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'division' => 'required|string|max:255',
            'population' => 'nullable|string|max:255',
            'area' => 'nullable|string|max:255',
            'established' => 'nullable|string|max:255',
            'about_short' => 'nullable|string|max:1000',
            'about_body' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['name']);
        
        // Handle Landmarks JSON with File Uploads
        $landmarks = [];
        if ($request->has('landmark_titles')) {
            foreach ($request->landmark_titles as $i => $title) {
                if (!empty($title)) {
                    $imagePath = $request->landmark_urls[$i] ?? '';
                    
                    // Check if file is uploaded for this specific index
                    if ($request->hasFile("landmark_files.$i")) {
                        $file = $request->file("landmark_files.$i");
                        $imagePath = $file->store('districts', 'public');
                    }

                    $landmarks[] = [
                        'title' => $title,
                        'desc' => $request->landmark_descs[$i] ?? '',
                        'image' => $imagePath,
                    ];
                }
            }
        }
        $data['landmarks'] = $landmarks;

        District::create($data);

        return redirect()->route('admin.districts.index')->with('success', 'District created successfully.');
    }

    public function edit(District $district)
    {
        return view('backend.district.edit', compact('district'));
    }

    public function update(Request $request, District $district)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'division' => 'required|string|max:255',
            'population' => 'nullable|string|max:255',
            'area' => 'nullable|string|max:255',
            'established' => 'nullable|string|max:255',
            'about_short' => 'nullable|string|max:1000',
            'about_body' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['name']);

        $landmarks = [];
        if ($request->has('landmark_titles')) {
            foreach ($request->landmark_titles as $i => $title) {
                if (!empty($title)) {
                    // Use URL if provided, otherwise keep old image
                    $imagePath = $request->landmark_urls[$i] ?? ($request->landmark_old_images[$i] ?? '');
                    
                    // Priority: File upload overrides everything
                    if ($request->hasFile("landmark_files.$i")) {
                        $file = $request->file("landmark_files.$i");
                        $imagePath = $file->store('districts', 'public');
                        
                        // Cleanup old file if it was a storage path
                        $oldPath = $request->landmark_old_images[$i] ?? '';
                        if (!empty($oldPath) && !str_starts_with($oldPath, 'http')) {
                            Storage::disk('public')->delete($oldPath);
                        }
                    }

                    $landmarks[] = [
                        'title' => $title,
                        'desc' => $request->landmark_descs[$i] ?? '',
                        'image' => $imagePath,
                    ];
                }
            }
        }
        $data['landmarks'] = $landmarks;

        $district->update($data);

        return redirect()->route('admin.districts.index')->with('success', 'District updated successfully.');
    }

    public function destroy(District $district)
    {
        // Cleanup landmarks images
        $landmarks = is_array($district->landmarks) ? $district->landmarks : [];
        foreach ($landmarks as $landmark) {
            $path = $landmark['image'] ?? '';
            if (!empty($path) && !str_starts_with($path, 'http')) {
                Storage::disk('public')->delete($path);
            }
        }

        $district->delete();
        return redirect()->route('admin.districts.index')->with('success', 'District deleted successfully.');
    }
}
