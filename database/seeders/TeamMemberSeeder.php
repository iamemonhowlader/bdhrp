<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            // Leadership
            [
                'name' => 'Mohammed Khorshed Alam',
                'designation' => 'Chairman',
                'category' => 'leadership',
                'order' => 1,
            ],
            [
                'name' => 'Mohammad Amin helali',
                'designation' => 'Senior Vice Chirman',
                'category' => 'leadership',
                'order' => 2,
            ],
            [
                'name' => 'Adv. Salim Sarwar Uddin Chowdhury',
                'designation' => 'Vice Chirman',
                'category' => 'leadership',
                'order' => 3,
            ],
            [
                'name' => 'Md Aminul Islam',
                'designation' => 'Secretary General',
                'category' => 'leadership',
                'order' => 4,
            ],
            [
                'name' => 'K.M. Moinul Aziz',
                'designation' => 'Treasurer',
                'category' => 'leadership',
                'order' => 5,
            ],
            [
                'name' => 'Barrister Khwaja Saif Ahsan',
                'designation' => 'Executive Member',
                'category' => 'leadership',
                'order' => 6,
            ],
            [
                'name' => 'Mohammad Babul AKhter',
                'designation' => 'Executive Member',
                'category' => 'leadership',
                'order' => 7,
            ],
            // Coordinators
            [
                'name' => 'Md Moin Uddin Shaikh',
                'designation' => 'Chief Co-Ordinator',
                'category' => 'coordinator',
                'order' => 8,
            ],
            [
                'name' => 'Rashida Ahmed',
                'designation' => 'Central Co-Ordinator',
                'category' => 'coordinator',
                'order' => 9,
            ],
        ];

        foreach ($members as $member) {
            TeamMember::updateOrCreate(
                ['name' => $member['name'], 'designation' => $member['designation']],
                $member
            );
        }
    }
}
