<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'group'];

    /** Keys stored as JSON strings; decoded in API / allMapped(). */
    public const JSON_VALUE_KEYS = [
        'bangladesh_divisions',
        'hero_slides',
        'home_videos',
        'home_activities',
        'home_about_stats',
        'social_links',
    ];

    /** Plain string keys managed in admin (must match FrontendContentSeeder). */
    public const STRING_KEYS = [
        'header_email', 'header_phone', 'header_volunteer_cta', 'header_logo_alt',
        'nav_home_label', 'nav_gallery_label', 'nav_contact_label', 'nav_bangladesh_label',
        'nav_topics_label', 'nav_about_label', 'nav_join_label', 'donate_button_label',
        'hero_kicker', 'hero_line1', 'hero_highlight', 'hero_line2',
        'hero_primary_label', 'hero_primary_href', 'hero_secondary_label', 'hero_secondary_href',
        'home_about_title', 'home_about_body', 'home_about_more_label', 'home_about_more_href',
        'lifestyle_kicker', 'lifestyle_title', 'lifestyle_body',
        'videos_title', 'videos_more_label', 'videos_more_href',
        'latest_article_kicker', 'latest_article_title', 'latest_article_subtitle',
        'support_title', 'support_body',
        'activities_title', 'activities_view_more_label', 'activities_view_more_href',
        'lifetime_badge', 'lifetime_title', 'lifetime_body', 'lifetime_cta', 'lifetime_footer_note',
        'join_movement_title', 'join_movement_cta_label', 'join_movement_quote',
        'join_movement_author', 'join_movement_role', 'join_movement_image',
    ];

    public static function setValue(string $key, ?string $value, ?string $group = null): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group ?? static::groupForKey($key)]
        );
    }

    public static function groupForKey(string $key): string
    {
        if (str_starts_with($key, 'header_') || str_starts_with($key, 'nav_') || str_starts_with($key, 'social')) {
            return 'header';
        }
        if (str_starts_with($key, 'hero_')) {
            return 'hero';
        }
        if (str_starts_with($key, 'home_about') || str_starts_with($key, 'lifestyle_')) {
            return 'home_about';
        }
        if (str_starts_with($key, 'videos_')) {
            return 'videos';
        }
        if (str_starts_with($key, 'latest_article')) {
            return 'latest_article';
        }
        if (str_starts_with($key, 'support_')) {
            return 'support';
        }
        if (str_starts_with($key, 'activities_')) {
            return 'activities';
        }
        if (str_starts_with($key, 'lifetime_')) {
            return 'lifetime';
        }
        if (str_starts_with($key, 'join_movement_')) {
            return 'join_movement';
        }
        if ($key === 'bangladesh_divisions') {
            return 'bangladesh';
        }

        return 'general';
    }

    /** @return array<string, mixed> */
    public static function allMapped(): array
    {
        $rows = static::query()->orderBy('key')->get();
        $out = [];
        foreach ($rows as $row) {
            $out[$row->key] = static::decodeValue($row->key, $row->value);
        }

        return $out;
    }

    public static function decodeValue(string $key, ?string $value): mixed
    {
        if ($value === null || $value === '') {
            return in_array($key, static::JSON_VALUE_KEYS, true) ? (str_ends_with($key, 'stats') || $key === 'social_links' ? [] : null) : '';
        }
        if (! in_array($key, static::JSON_VALUE_KEYS, true)) {
            return $value;
        }
        $decoded = json_decode($value, true);

        return json_last_error() === JSON_ERROR_NONE ? $decoded : null;
    }
}
