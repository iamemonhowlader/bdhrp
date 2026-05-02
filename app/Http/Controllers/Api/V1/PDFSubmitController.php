<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\CommitteeApplication;
use App\Models\CommitteeApplicationMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PDFSubmitController extends Controller
{
    public function submit(Request $request)
    {
        try {
            $request->validate([
                'pdf_file' => 'required|file|mimes:pdf|max:10240'
            ]);

            $file = $request->file('pdf_file');
            
            // Store the PDF file
            $pdfPath = $file->store('submitted-pdfs', 'public');
            
            // For demo purposes, create mock data from PDF
            // In real implementation, you would use PDF parsing library
            $mockData = $this->extractMockDataFromPDF($file);
            
            // Create committee application
            $application = CommitteeApplication::create([
                'committee_type' => $mockData['committee_type'],
                'division' => $mockData['division'],
                'district' => $mockData['district'],
                'thana' => $mockData['thana'],
                'union' => $mockData['union'],
                'area' => $mockData['area'],
                'city_corporation' => $mockData['city_corporation'],
                'ward' => $mockData['ward'],
                'pouroshova' => $mockData['pouroshova'],
                'members' => [], // Empty since using separate table
                'total_fee' => $mockData['total_fee'],
                'status' => 'pending',
            ]);

            // Save members to separate table
            foreach ($mockData['members'] as $memberData) {
                $application->applicationMembers()->create([
                    'name' => $memberData['name'],
                    'father' => $memberData['father'],
                    'mother' => $memberData['mother'],
                    'nid' => $memberData['nid'],
                    'phone' => $memberData['phone'],
                    'blood_group' => $memberData['blood_group'],
                    'role' => $memberData['role'],
                    'address' => $memberData['address'],
                    'profession' => $memberData['profession'],
                    'photo_path' => $memberData['photo_path'] ?? null,
                    'signature_path' => $memberData['signature_path'] ?? null,
                    'member_id' => $memberData['member_id'],
                    'is_lifetime' => $memberData['is_lifetime'] ?? false,
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'PDF successfully submitted and data saved to database',
                'application_id' => $application->id,
                'pdf_path' => $pdfPath,
                'members_count' => count($mockData['members'])
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to process PDF: ' . $e->getMessage()
            ], 500);
        }
    }

    private function extractMockDataFromPDF($file)
    {
        // This is a mock implementation
        // In real implementation, you would use libraries like:
        // - smalot/pdfparser
        // - setasign/fpdi
        // - or other PDF parsing libraries
        
        // For demo, return sample data
        return [
            'committee_type' => 'union',
            'division' => 'Chattogram',
            'district' => 'Chandpur',
            'thana' => 'Shahrasti',
            'union' => 'Uttar Shahrasti',
            'area' => 'উত্তর শাহরাস্তি',
            'city_corporation' => null,
            'ward' => null,
            'pouroshova' => null,
            'total_fee' => 35000.00,
            'members' => [
                [
                    'name' => 'মোঃ আব্দুল করিম',
                    'father' => 'মোঃ ইব্রাহিম',
                    'mother' => 'ফাতেমা বেগম',
                    'nid' => '1234567890123',
                    'phone' => '01712345678',
                    'blood_group' => 'O+',
                    'role' => 'সভাপতি',
                    'address' => 'উত্তর শাহরাস্তি, চাঁদপুর',
                    'profession' => 'ব্যবসায়ী',
                    'member_id' => 'GM-COM-CH-001',
                    'is_lifetime' => true
                ],
                [
                    'name' => 'মোঃ রহিম উদ্দিন',
                    'father' => 'মোঃ কামাল উদ্দিন',
                    'mother' => 'খাদিজা বেগম',
                    'nid' => '9876543210987',
                    'phone' => '01898765432',
                    'blood_group' => 'B+',
                    'role' => 'সাধারণ সম্পাদক',
                    'address' => 'উত্তর শাহরাস্তি, চাঁদপুর',
                    'profession' => 'শিক্ষক',
                    'member_id' => 'GM-COM-CH-002',
                    'is_lifetime' => false
                ],
                [
                    'name' => 'মোঃ সালাহউদ্দিন',
                    'father' => 'মোঃ জাকির হোসেন',
                    'mother' => 'আয়েশা বেগম',
                    'nid' => '4567890123456',
                    'phone' => '01956789012',
                    'blood_group' => 'A+',
                    'role' => 'সহ-সভাপতি',
                    'address' => 'উত্তর শাহরাস্তি, চাঁদপুর',
                    'profession' => 'কৃষক',
                    'member_id' => 'GM-COM-CH-003',
                    'is_lifetime' => false
                ]
            ]
        ];
    }
}
