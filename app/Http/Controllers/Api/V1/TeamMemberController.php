<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('order')->get();
        
        $leadership = $members->where('category', 'leadership')->values();
        $coordinators = $members->where('category', 'coordinator')->values();

        return response()->json([
            'status' => 'success',
            'data' => [
                'leadership' => $leadership,
                'coordinators' => $coordinators
            ]
        ]);
    }
}
