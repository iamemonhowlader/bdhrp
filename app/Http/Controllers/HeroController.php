<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class HeroController extends BaseController
{
    public function edit()
    {
        $slides = SiteSetting::decodeValue('hero_slides', SiteSetting::query()->where('key', 'hero_slides')->value('value'));
        $slides = is_array($slides) ? $slides : [];

        while (count($slides) < 3) {
            $slides[] = ['image' => '', 'alt' => ''];
        }
        $slides = array_slice($slides, 0, 3);

        return view('backend.hero.edit', compact('slides'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'required|string|max:255',
            'hero_slides' => 'required|array|min:1|max:3',
            'hero_slides.*.existing_image' => 'nullable|string|max:4096',
            'hero_slides.*.image_file' => 'nullable|image|max:6144',
            'hero_slides.*.alt' => 'nullable|string|max:255',
            'hero_kicker' => 'nullable|string|max:255',
            'hero_primary_label' => 'nullable|string|max:255',
            'hero_primary_href' => 'nullable|string|max:255',
            'hero_secondary_label' => 'nullable|string|max:255',
            'hero_secondary_href' => 'nullable|string|max:255',
        ]);

        SiteSetting::setValue('hero_title', $data['hero_title'], 'hero');
        SiteSetting::setValue('hero_subtitle', $data['hero_subtitle'], 'hero');
        // Keep compatibility with older frontend fallback keys.
        SiteSetting::setValue('hero_line1', $data['hero_title'], 'hero');
        SiteSetting::setValue('hero_highlight', $data['hero_title'], 'hero');
        SiteSetting::setValue('hero_line2', $data['hero_subtitle'], 'hero');
        SiteSetting::setValue('hero_kicker', (string) ($data['hero_kicker'] ?? ''), 'hero');
        SiteSetting::setValue('hero_primary_label', (string) ($data['hero_primary_label'] ?? 'Discover More'), 'hero');
        SiteSetting::setValue('hero_primary_href', (string) ($data['hero_primary_href'] ?? '/about-us'), 'hero');
        SiteSetting::setValue('hero_secondary_label', (string) ($data['hero_secondary_label'] ?? 'Get A Quote'), 'hero');
        SiteSetting::setValue('hero_secondary_href', (string) ($data['hero_secondary_href'] ?? '/contact'), 'hero');

        $slides = [];
        foreach ($request->input('hero_slides', []) as $i => $slideInput) {
            $existing = trim((string) ($slideInput['existing_image'] ?? ''));
            $imagePath = $existing;

            if ($request->hasFile("hero_slides.$i.image_file")) {
                $file = $request->file("hero_slides.$i.image_file");
                if ($file) {
                    // Remove old uploaded file if it belongs to storage.
                    if ($existing !== '' && !str_starts_with($existing, 'http') && Storage::disk('public')->exists($existing)) {
                        Storage::disk('public')->delete($existing);
                    }
                    $imagePath = $file->store('hero-slides', 'public');
                }
            }

            if ($imagePath === '') {
                continue;
            }

            $slides[] = [
                'image' => $imagePath,
                'alt' => trim((string) ($slideInput['alt'] ?? 'hero-slide')),
            ];
        }

        if (empty($slides)) {
            return back()->withErrors(['hero_slides' => 'At least one hero image is required.'])->withInput();
        }

        SiteSetting::setValue('hero_slides', json_encode($slides, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), 'hero');

        return redirect()->route('admin.hero.edit')->with('success', 'Hero section updated successfully.');
    }
}
