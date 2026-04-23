<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommitteeApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'committee_type',
        'division',
        'district',
        'thana',
        'union',
        'area',
        'city_corporation',
        'ward',
        'pouroshova',
        'members',
        'total_fee',
        'status',
    ];

    protected $casts = [
        'members' => 'array',
    ];
}
