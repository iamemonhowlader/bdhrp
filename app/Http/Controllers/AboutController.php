<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class AboutController extends BaseController
{
    public function edit()
    {
        $stats = SiteSetting::decodeValue('home_about_stats', SiteSetting::query()->where('key', 'home_about_stats')->value('value'));
        $stats = is_array($stats) ? $stats : [
            ['label' => 'Join Our Team', 'value' => '6,472+'],
            ['label' => 'Donate Now', 'value' => '$38,768'],
            ['label' => 'Total Fund Raised', 'value' => '1,193,210']
        ];

        return view('backend.about.edit', compact('stats'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'home_about_title' => 'required|string|max:255',
            'home_about_body' => 'required|string',
            'home_about_more_label' => 'nullable|string|max:255',
            'home_about_more_href' => 'nullable|string|max:255',
            'home_about_stats' => 'nullable|array|min:1|max:4',
            'home_about_stats.*.label' => 'required|string|max:100',
            'home_about_stats.*.value' => 'required|string|max:100',
            'home_about_stats.*.icon' => 'nullable|string|max:100',
        ]);

        SiteSetting::setValue('home_about_title', $data['home_about_title'], 'home_about');
        SiteSetting::setValue('home_about_body', $data['home_about_body'], 'home_about');
        SiteSetting::setValue('home_about_more_label', $data['home_about_more_label'] ?? 'more about us', 'home_about');
        SiteSetting::setValue('home_about_more_href', $data['home_about_more_href'] ?? '/about-us', 'home_about');

        if (isset($data['home_about_stats'])) {
            SiteSetting::setValue('home_about_stats', json_encode($data['home_about_stats'], JSON_UNESCAPED_UNICODE), 'home_about');
        }

        return redirect()->route('admin.about.edit')->with('success', 'About section updated successfully.');
    }
}
