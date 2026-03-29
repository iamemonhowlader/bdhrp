<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class SiteSettingController extends BaseController
{
    private const HERO_SLIDE_SLOTS = 10;

    private const SOCIAL_ROWS = 5;

    private const STATS_ROWS = 3;

    private const BD_DIVISION_SLOTS = 12;

    private const VIDEO_SLOTS = 15;

    private const ACTIVITY_SLOTS = 15;

    public function edit()
    {
        $rows = SiteSetting::query()->orderBy('key')->get()->keyBy('key');
        $formDefaults = $this->formDefaultsFromRows($rows);

        return view('backend.site-settings.edit', compact('rows', 'formDefaults'));
    }

    public function update(Request $request)
    {
        $rules = [];
        foreach (SiteSetting::STRING_KEYS as $key) {
            $rules[$key] = $key === 'header_email' ? 'nullable|email' : 'nullable|string';
        }
        $rules['hero_slides'] = 'nullable|array|max:'.self::HERO_SLIDE_SLOTS;
        $rules['hero_slides.*.image'] = 'nullable|string|max:4096';
        $rules['hero_slides.*.alt'] = 'nullable|string|max:512';
        $rules['social_rows'] = 'nullable|array|max:'.self::SOCIAL_ROWS;
        $rules['social_rows.*.network'] = 'nullable|string|max:64';
        $rules['social_rows.*.url'] = 'nullable|string|max:2048';
        $rules['stats'] = 'nullable|array|max:'.self::STATS_ROWS;
        $rules['stats.*.caption'] = 'nullable|string|max:255';
        $rules['stats.*.value'] = 'nullable|string|max:64';
        $rules['stats.*.icon'] = 'nullable|in:team,donate,fund';
        $rules['bangladesh_divisions'] = 'nullable|array|max:'.self::BD_DIVISION_SLOTS;
        $rules['bangladesh_divisions.*.division'] = 'nullable|string|max:128';
        $rules['bangladesh_divisions.*.districts'] = 'nullable|string|max:16000';
        $rules['home_videos'] = 'nullable|array|max:'.self::VIDEO_SLOTS;
        $rules['home_videos.*.title'] = 'nullable|string|max:500';
        $rules['home_videos.*.duration'] = 'nullable|string|max:32';
        $rules['home_videos.*.videoUrl'] = 'nullable|string|max:2048';
        $rules['home_activities'] = 'nullable|array|max:'.self::ACTIVITY_SLOTS;
        $rules['home_activities.*.title'] = 'nullable|string|max:255';
        $rules['home_activities.*.type'] = 'nullable|in:image,video';
        $rules['home_activities.*.image'] = 'nullable|string|max:4096';
        $rules['home_activities.*.videoUrl'] = 'nullable|string|max:2048';

        $validated = $request->validate($rules);

        foreach (SiteSetting::STRING_KEYS as $key) {
            if (! array_key_exists($key, $validated)) {
                continue;
            }
            $val = $validated[$key] ?? '';
            SiteSetting::setValue($key, (string) $val, SiteSetting::groupForKey($key));
        }

        $this->saveJsonSetting('hero_slides', $this->normalizeHeroSlides($request->input('hero_slides')));
        $this->saveJsonSetting('social_links', $this->normalizeSocialRows($request->input('social_rows')));
        $this->saveJsonSetting('home_about_stats', $this->normalizeStats($request->input('stats')));
        $this->saveJsonSetting('bangladesh_divisions', $this->normalizeBangladesh($request->input('bangladesh_divisions')));
        $this->saveJsonSetting('home_videos', $this->normalizeVideos($request->input('home_videos')));
        $this->saveJsonSetting('home_activities', $this->normalizeActivities($request->input('home_activities')));

        return redirect()
            ->route('admin.site-settings.edit')
            ->with('success', 'Site appearance and homepage content saved.');
    }

    /** @param \Illuminate\Support\Collection<int, \App\Models\SiteSetting> $rows */
    private function formDefaultsFromRows($rows): array
    {
        $slides = SiteSetting::decodeValue('hero_slides', $rows->get('hero_slides')?->value);
        $slides = is_array($slides) ? $slides : [];
        $slides = array_values(array_map(fn ($s) => [
            'image' => is_array($s) ? (string) ($s['image'] ?? $s['url'] ?? '') : '',
            'alt' => is_array($s) ? (string) ($s['alt'] ?? '') : '',
        ], $slides));
        while (count($slides) < self::HERO_SLIDE_SLOTS) {
            $slides[] = ['image' => '', 'alt' => ''];
        }

        $social = SiteSetting::decodeValue('social_links', $rows->get('social_links')?->value);
        $social = is_array($social) ? $social : [];
        $socialRows = array_values(array_map(fn ($s) => [
            'network' => is_array($s) ? (string) ($s['network'] ?? '') : '',
            'url' => is_array($s) ? (string) ($s['url'] ?? '') : '',
        ], $social));
        while (count($socialRows) < self::SOCIAL_ROWS) {
            $socialRows[] = ['network' => '', 'url' => ''];
        }
        $socialRows = array_slice($socialRows, 0, self::SOCIAL_ROWS);

        $stats = SiteSetting::decodeValue('home_about_stats', $rows->get('home_about_stats')?->value);
        $stats = is_array($stats) ? $stats : [];
        $statsRows = array_values(array_map(fn ($s) => [
            'caption' => is_array($s) ? (string) ($s['caption'] ?? $s['label'] ?? '') : '',
            'value' => is_array($s) ? (string) ($s['value'] ?? '') : '',
            'icon' => is_array($s) ? (string) ($s['icon'] ?? 'team') : 'team',
        ], $stats));
        while (count($statsRows) < self::STATS_ROWS) {
            $statsRows[] = ['caption' => '', 'value' => '', 'icon' => 'team'];
        }
        $statsRows = array_slice($statsRows, 0, self::STATS_ROWS);

        $bd = SiteSetting::decodeValue('bangladesh_divisions', $rows->get('bangladesh_divisions')?->value);
        $bd = is_array($bd) ? $bd : [];
        $bdRows = array_values(array_map(function ($row) {
            if (! is_array($row)) {
                return ['division' => '', 'districts' => ''];
            }
            $districts = $row['districts'] ?? [];
            if (is_string($districts)) {
                $districtsText = $districts;
            } else {
                $districtsText = is_array($districts) ? implode("\n", $districts) : '';
            }

            return [
                'division' => (string) ($row['division'] ?? ''),
                'districts' => $districtsText,
            ];
        }, $bd));
        while (count($bdRows) < self::BD_DIVISION_SLOTS) {
            $bdRows[] = ['division' => '', 'districts' => ''];
        }
        $bdRows = array_slice($bdRows, 0, self::BD_DIVISION_SLOTS);

        $videos = SiteSetting::decodeValue('home_videos', $rows->get('home_videos')?->value);
        $videos = is_array($videos) ? $videos : [];
        $videoRows = array_values(array_map(fn ($v) => [
            'title' => is_array($v) ? (string) ($v['title'] ?? '') : '',
            'duration' => is_array($v) ? (string) ($v['duration'] ?? '') : '',
            'videoUrl' => is_array($v) ? (string) ($v['videoUrl'] ?? $v['video_url'] ?? '') : '',
        ], $videos));
        while (count($videoRows) < self::VIDEO_SLOTS) {
            $videoRows[] = ['title' => '', 'duration' => '', 'videoUrl' => ''];
        }
        $videoRows = array_slice($videoRows, 0, self::VIDEO_SLOTS);

        $acts = SiteSetting::decodeValue('home_activities', $rows->get('home_activities')?->value);
        $acts = is_array($acts) ? $acts : [];
        $actRows = array_values(array_map(fn ($a) => [
            'title' => is_array($a) ? (string) ($a['title'] ?? '') : '',
            'type' => is_array($a) ? (string) ($a['type'] ?? 'image') : 'image',
            'image' => is_array($a) ? (string) ($a['image'] ?? $a['image_url'] ?? '') : '',
            'videoUrl' => is_array($a) ? (string) ($a['videoUrl'] ?? $a['video_url'] ?? '') : '',
        ], $acts));
        while (count($actRows) < self::ACTIVITY_SLOTS) {
            $actRows[] = ['title' => '', 'type' => 'image', 'image' => '', 'videoUrl' => ''];
        }
        $actRows = array_slice($actRows, 0, self::ACTIVITY_SLOTS);

        return [
            'hero_slides' => $slides,
            'social_rows' => $socialRows,
            'stats' => $statsRows,
            'bangladesh_divisions' => $bdRows,
            'home_videos' => $videoRows,
            'home_activities' => $actRows,
        ];
    }

    private function normalizeHeroSlides(?array $rows): ?string
    {
        if (! is_array($rows)) {
            return null;
        }
        $out = [];
        foreach ($rows as $r) {
            if (! is_array($r)) {
                continue;
            }
            $img = trim((string) ($r['image'] ?? ''));
            if ($img === '') {
                continue;
            }
            $out[] = [
                'image' => $img,
                'alt' => trim((string) ($r['alt'] ?? '')),
            ];
        }

        return $out === [] ? null : json_encode($out, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    private function normalizeSocialRows(?array $rows): ?string
    {
        if (! is_array($rows)) {
            return null;
        }
        $out = [];
        foreach ($rows as $r) {
            if (! is_array($r)) {
                continue;
            }
            $net = trim((string) ($r['network'] ?? ''));
            $url = trim((string) ($r['url'] ?? ''));
            if ($net === '' && $url === '') {
                continue;
            }
            $out[] = ['network' => $net ?: 'link', 'url' => $url ?: '#'];
        }

        return $out === [] ? null : json_encode($out, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    private function normalizeStats(?array $rows): ?string
    {
        if (! is_array($rows)) {
            return null;
        }
        $out = [];
        foreach ($rows as $r) {
            if (! is_array($r)) {
                continue;
            }
            $cap = trim((string) ($r['caption'] ?? ''));
            $val = trim((string) ($r['value'] ?? ''));
            if ($cap === '' && $val === '') {
                continue;
            }
            $icon = trim((string) ($r['icon'] ?? 'team'));
            if (! in_array($icon, ['team', 'donate', 'fund'], true)) {
                $icon = 'team';
            }
            $out[] = ['caption' => $cap, 'value' => $val, 'icon' => $icon];
        }

        return $out === [] ? null : json_encode($out, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    private function normalizeBangladesh(?array $rows): ?string
    {
        if (! is_array($rows)) {
            return null;
        }
        $out = [];
        foreach ($rows as $r) {
            if (! is_array($r)) {
                continue;
            }
            $div = trim((string) ($r['division'] ?? ''));
            if ($div === '') {
                continue;
            }
            $raw = (string) ($r['districts'] ?? '');
            $lines = preg_split('/\r\n|\r|\n/', $raw) ?: [];
            $districts = array_values(array_filter(array_map('trim', $lines), fn ($x) => $x !== ''));
            $out[] = ['division' => $div, 'districts' => $districts];
        }

        return $out === [] ? null : json_encode($out, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    private function normalizeVideos(?array $rows): ?string
    {
        if (! is_array($rows)) {
            return null;
        }
        $out = [];
        $id = 1;
        foreach ($rows as $r) {
            if (! is_array($r)) {
                continue;
            }
            $title = trim((string) ($r['title'] ?? ''));
            $url = trim((string) ($r['videoUrl'] ?? ''));
            if ($title === '' || $url === '') {
                continue;
            }
            $out[] = [
                'id' => $id++,
                'title' => $title,
                'duration' => trim((string) ($r['duration'] ?? '')),
                'videoUrl' => $url,
            ];
        }

        return $out === [] ? null : json_encode($out, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    private function normalizeActivities(?array $rows): ?string
    {
        if (! is_array($rows)) {
            return null;
        }
        $out = [];
        $id = 1;
        foreach ($rows as $r) {
            if (! is_array($r)) {
                continue;
            }
            $title = trim((string) ($r['title'] ?? ''));
            $image = trim((string) ($r['image'] ?? ''));
            if ($title === '' || $image === '') {
                continue;
            }
            $type = trim((string) ($r['type'] ?? 'image'));
            if (! in_array($type, ['image', 'video'], true)) {
                $type = 'image';
            }
            if ($type === 'video') {
                $vu = trim((string) ($r['videoUrl'] ?? ''));
                if ($vu === '') {
                    continue;
                }
            }
            $item = [
                'id' => $id++,
                'title' => $title,
                'type' => $type,
                'image' => $image,
            ];
            if ($type === 'video') {
                $item['videoUrl'] = trim((string) ($r['videoUrl'] ?? ''));
            }
            $out[] = $item;
        }

        return $out === [] ? null : json_encode($out, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    private function saveJsonSetting(string $key, ?string $json): void
    {
        if ($json === null || $json === '' || $json === '[]') {
            SiteSetting::query()->where('key', $key)->delete();

            return;
        }
        SiteSetting::setValue($key, $json, SiteSetting::groupForKey($key));
    }
}
