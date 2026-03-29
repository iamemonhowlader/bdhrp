<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'author_id',
        'title',
        'slug',
        'content',
        'meta_title',
        'meta_description',
        'featured_image',
        'status',
        'page_type',
        'published_at',
        'show_in_nav',
        'nav_group',
        'nav_label',
        'nav_sort_order',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'show_in_nav' => 'boolean',
        'nav_sort_order' => 'integer',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')->whereNotNull('published_at');
    }

    public function scopeInNavigation($query)
    {
        return $query->published()->where('show_in_nav', true)->orderBy('nav_sort_order');
    }
}
