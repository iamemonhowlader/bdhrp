<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'committee_id',
        'name',
        'designation',
        'image',
        'category',
        'sort_order',
    ];

    public function committee()
    {
        return $this->belongsTo(Committee::class);
    }
}
