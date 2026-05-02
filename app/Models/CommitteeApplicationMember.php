<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeApplicationMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'committee_application_id',
        'name',
        'father',
        'mother',
        'nid',
        'phone',
        'blood_group',
        'role',
        'address',
        'profession',
        'photo_path',
        'signature_path',
        'member_id',
        'is_lifetime',
    ];

    public function application()
    {
        return $this->belongsTo(CommitteeApplication::class, 'committee_application_id');
    }
}
