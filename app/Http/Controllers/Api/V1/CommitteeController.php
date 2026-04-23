<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Committee;
use Illuminate\Http\Request;

class CommitteeController extends Controller
{
    public function index()
    {
        $committees = Committee::select('id', 'name', 'slug')->get();
        return response()->json([
            'status' => 'success',
            'data' => $committees
        ]);
    }

    public function show($slug)
    {
        $committee = Committee::with('members')->where('slug', $slug)->firstOrFail();
        
        // Group members by category for easier display
        $groupedMembers = $committee->members->groupBy('category');

        return response()->json([
            'status' => 'success',
            'data' => [
                'committee' => $committee,
                'grouped_members' => $groupedMembers
            ]
        ]);
    }
}
