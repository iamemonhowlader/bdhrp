<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'about',
        'landscape_image',
        'image_caption',
        'contact_email',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'leadership_pdf',
    ];

    public function members()
    {
        return $this->hasMany(CommitteeMember::class)->orderBy('sort_order');
    }
}
