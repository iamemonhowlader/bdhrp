<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\CommitteeApplication;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommitteeApplicationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'committeeType' => 'required|string',
            'location.division' => 'nullable|string',
            'location.district' => 'nullable|string',
            'location.thana' => 'nullable|string',
            'location.union' => 'nullable|string',
            'location.area' => 'nullable|string',
            'location.cityCorporation' => 'nullable|string',
            'location.ward' => 'nullable|string',
            'location.pouroshova' => 'nullable|string',
            'members' => 'nullable|array',
            'total_fee' => 'nullable|numeric',
        ]);

        $application = CommitteeApplication::create([
            'committee_type' => $validated['committeeType'],
            'division' => $validated['location']['division'] ?? null,
            'district' => $validated['location']['district'] ?? null,
            'thana' => $validated['location']['thana'] ?? null,
            'union' => $validated['location']['union'] ?? null,
            'area' => $validated['location']['area'] ?? null,
            'city_corporation' => $validated['location']['cityCorporation'] ?? null,
            'ward' => $validated['location']['ward'] ?? null,
            'pouroshova' => $validated['location']['pouroshova'] ?? null,
            'members' => $validated['members'] ?? [],
            'total_fee' => $validated['total_fee'] ?? 0,
            'status' => 'pending',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Committee application submitted successfully',
            'data' => $application
        ]);
    }
}
