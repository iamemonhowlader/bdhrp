<?php

namespace App\Http\Controllers;

use App\Models\Committee;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CommitteeController extends BaseController
{
    public function index()
    {
        $committees = Committee::all();
        return view('backend.committees.index', compact('committees'));
    }

    public function create()
    {
        return view('backend.committees.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:committees,slug',
            'about' => 'nullable|string',
            'image_file' => 'nullable|image|max:2048',
            'image_caption' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'pdf_file' => 'nullable|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('image_file')) {
            $data['landscape_image'] = $request->file('image_file')->store('committees', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            $data['leadership_pdf'] = $request->file('pdf_file')->store('committees/pdfs', 'public');
        }

        Committee::create($data);

        return redirect()->route('admin.committees.index')->with('success', 'Committee created successfully.');
    }

    public function edit(Committee $committee)
    {
        return view('backend.committees.edit', compact('committee'));
    }

    public function update(Request $request, Committee $committee)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:committees,slug,' . $committee->id,
            'about' => 'nullable|string',
            'image_file' => 'nullable|image|max:2048',
            'image_caption' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'pdf_file' => 'nullable|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('image_file')) {
            if ($committee->landscape_image) {
                Storage::disk('public')->delete($committee->landscape_image);
            }
            $data['landscape_image'] = $request->file('image_file')->store('committees', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            if ($committee->leadership_pdf) {
                Storage::disk('public')->delete($committee->leadership_pdf);
            }
            $data['leadership_pdf'] = $request->file('pdf_file')->store('committees/pdfs', 'public');
        }

        $committee->update($data);

        return redirect()->route('admin.committees.index')->with('success', 'Committee updated successfully.');
    }

    public function destroy(Committee $committee)
    {
        if ($committee->landscape_image) {
            Storage::disk('public')->delete($committee->landscape_image);
        }
        if ($committee->leadership_pdf) {
            Storage::disk('public')->delete($committee->leadership_pdf);
        }
        $committee->delete();
        return redirect()->route('admin.committees.index')->with('success', 'Committee deleted successfully.');
    }
}
