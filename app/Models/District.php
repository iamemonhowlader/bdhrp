<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'division',
        'population',
        'area',
        'established',
        'about_short',
        'about_body',
        'landmarks',
        'is_active',
    ];

    protected $casts = [
        'landmarks' => 'array',
        'is_active' => 'boolean',
    ];
}
