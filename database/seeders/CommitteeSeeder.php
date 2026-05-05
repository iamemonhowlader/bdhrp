<?php

namespace Database\Seeders;

use App\Models\Committee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = [
            'Barishal',
            'Chattogram',
            'Dhaka',
            'Khulna',
            'Mymensingh',
            'Rajshahi',
            'Rangpur',
            'Sylhet',
        ];

        foreach ($divisions as $name) {
            $committee = Committee::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'about' => "The {$name} Committee of the BDHRP Parishad is a vital part of our national volunteer network. Our members help drive the activities of the Parishad through fundraising, outreach, and local advocacy initiatives tailored to the {$name} division.",
                    'image_caption' => "The vibrant community of {$name} where our committee members work to promote human rights.",
                    'contact_email' => strtolower($name) . '@bdhrp.org',
                    'facebook_url' => 'https://facebook.com/bdhrp',
                    'instagram_url' => 'https://instagram.com/bdhrp',
                ]
            );

            // Add some members for Barishal as an example
            if ($name === 'Barishal') {
                $members = [
                    ['name' => 'Jane Doe', 'designation' => 'Co-Chair', 'category' => 'Division Leadership', 'sort_order' => 1],
                    ['name' => 'John Smith', 'designation' => 'Co-Chair', 'category' => 'Division Leadership', 'sort_order' => 2],
                    ['name' => 'Sarah Wilson', 'designation' => 'Secretary', 'category' => 'Division Leadership', 'sort_order' => 3],
                    ['name' => 'Michael Brown', 'designation' => 'Treasurer', 'category' => 'Division Leadership', 'sort_order' => 4],
                ];

                foreach ($members as $memberData) {
                    $committee->members()->updateOrCreate(
                        ['name' => $memberData['name']],
                        $memberData
                    );
                }
            }
        }
    }
}
