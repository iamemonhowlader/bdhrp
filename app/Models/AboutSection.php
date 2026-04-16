<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = [
        'label',
        'title',
        'slug',
        'content',
        'highlight',
        'title_end',
        'description',
        'image',
        'image_alt',
        'additional_images',
        'image_position',
        'is_active',
        'show_in_menu',
        'menu_label',
        'meta_title',
        'meta_description',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_in_menu' => 'boolean',
        'additional_images' => 'array',
        'sort_order' => 'integer',
    ];
}
