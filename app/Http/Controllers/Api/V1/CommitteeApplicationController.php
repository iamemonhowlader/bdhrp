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

        $members = $validated['members'] ?? [];
        
        // Process member photos and signatures
        foreach ($members as $key => $member) {
            if (isset($member['photo']) && str_starts_with($member['photo'], 'data:image')) {
                $members[$key]['photo'] = $this->saveBase64Image($member['photo'], 'members/photos');
            }
            if (isset($member['signatureImage']) && str_starts_with($member['signatureImage'], 'data:image')) {
                $members[$key]['signatureImage'] = $this->saveBase64Image($member['signatureImage'], 'members/signatures');
            }
            if (isset($member['digitalSignature']) && str_starts_with($member['digitalSignature'], 'data:image')) {
                $members[$key]['digitalSignature'] = $this->saveBase64Image($member['digitalSignature'], 'members/signatures');
            }
        }

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
            'members' => [], // Clear JSON members to save space
            'total_fee' => $validated['total_fee'] ?? 0,
            'status' => 'pending',
        ]);

        // Save members in the separate table
        foreach ($members as $memberData) {
            $application->applicationMembers()->create([
                'name' => $memberData['name'] ?? null,
                'father' => $memberData['father'] ?? null,
                'mother' => $memberData['mother'] ?? null,
                'nid' => $memberData['nid'] ?? null,
                'phone' => $memberData['phone'] ?? null,
                'blood_group' => $memberData['bloodGroup'] ?? null,
                'role' => $memberData['role'] ?? null,
                'address' => $memberData['address'] ?? null,
                'profession' => $memberData['profession'] ?? null,
                'photo_path' => $memberData['photo'] ?? null,
                'signature_path' => $memberData['signatureImage'] ?? $memberData['digitalSignature'] ?? null,
                'member_id' => $memberData['memberId'] ?? null,
                'is_lifetime' => $memberData['isLifetime'] ?? false,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Committee application submitted successfully',
            'data' => $application->load('applicationMembers')
        ]);
    }

    private function saveBase64Image($base64String, $subDir)
    {
        // Extract extension
        $extension = explode('/', explode(':', substr($base64String, 0, strpos($base64String, ';')))[1])[1];
        // Remove the data:image/...;base64, part
        $replace = substr($base64String, 0, strpos($base64String, ',') + 1);
        $image = str_replace($replace, '', $base64String);
        $image = str_replace(' ', '+', $image);
        $imageName = uniqid() . '.' . $extension;

        \Illuminate\Support\Facades\Storage::disk('public')->put($subDir . '/' . $imageName, base64_decode($image));

        return url('storage/' . $subDir . '/' . $imageName);
    }
}
