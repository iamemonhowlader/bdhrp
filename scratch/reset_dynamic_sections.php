<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\AboutSection;
use App\Models\MenuItem;

// 1. Clear existing menu items that are hardcoded
MenuItem::where('zone', 'about')->delete();

// 2. Reset AboutSection table
AboutSection::truncate();

// 3. Setup clean dynamic sections
$sections = [
    [
        'label' => 'OUR STORY',
        'title' => 'A Movement Born to Protect',
        'slug' => 'our-story',
        'highlight' => 'Human Dignity',
        'title_end' => 'in Bangladesh',
        'description' => 'The Bangladesh Human Rights Parishad (BHRP) was founded by a group of passionate advocates who believed that every person deserves justice, equality, and respect. What began as a small initiative has grown into a nationwide movement...',
        'image_position' => 'left',
        'sort_order' => 1,
        'show_in_menu' => false, // Will show on main About page but not individual menu link
        'is_active' => true
    ],
    [
        'label' => 'OUR MISSION',
        'title' => 'Standing for Justice, Equality, and',
        'slug' => 'our-mission',
        'highlight' => 'Human Dignity',
        'title_end' => 'Across Bangladesh',
        'description' => 'At the Bangladesh Human Rights Parishad (BHRP), our mission is to protect and promote the fundamental rights of every individual — regardless of their background, belief, or identity.',
        'image_position' => 'right',
        'sort_order' => 2,
        'show_in_menu' => false,
        'is_active' => true
    ],
    [
        'label' => 'OUR VISION',
        'title' => 'A Future Where Every Bangladeshi Lives with',
        'slug' => 'our-vision',
        'highlight' => 'Freedom, Justice, and Dignity',
        'description' => 'Our vision is to create a Bangladesh where human rights are respected, protected and fulfilled for all.',
        'image_position' => 'left',
        'sort_order' => 3,
        'show_in_menu' => false,
        'is_active' => true
    ],
    [
        'label' => 'ABOUT',
        'title' => 'About Us',
        'slug' => 'about-us',
        'menu_label' => 'About Us',
        'description' => 'Learn more about our organization and our history.',
        'sort_order' => 4,
        'show_in_menu' => true,
        'is_active' => true
    ],
    [
        'label' => 'SOCIAL CONNECT',
        'title' => 'Social Media',
        'slug' => 'social-media',
        'menu_label' => 'Social Media',
        'description' => 'Follow our social channels.',
        'sort_order' => 5,
        'show_in_menu' => true,
        'is_active' => true
    ],
    [
        'label' => 'OUR PARTNERS',
        'title' => 'Partners',
        'slug' => 'partners',
        'menu_label' => 'Partners',
        'description' => 'Our local and international partners.',
        'sort_order' => 6,
        'show_in_menu' => true,
        'is_active' => true
    ],
    [
        'label' => 'ACCESSIBILITY',
        'title' => 'Accessibility',
        'slug' => 'accessibility',
        'menu_label' => 'Accessibility',
        'description' => 'Our commitment to accessibility.',
        'sort_order' => 7,
        'show_in_menu' => true,
        'is_active' => true
    ],
    [
        'label' => 'TEAM',
        'title' => 'People',
        'slug' => 'people',
        'menu_label' => 'People',
        'description' => 'Meet our team members.',
        'sort_order' => 8,
        'show_in_menu' => true,
        'is_active' => true
    ],
    [
        'label' => 'EDUCATION',
        'title' => 'Human Rights Education',
        'slug' => 'hr-education',
        'menu_label' => 'Human Rights Education',
        'description' => 'Educational resources.',
        'sort_order' => 9,
        'show_in_menu' => true,
        'is_active' => true
    ],
    [
        'label' => 'CONTACT',
        'title' => 'Contact Us',
        'slug' => 'contact',
        'menu_label' => 'Contact',
        'description' => 'Get in touch with us.',
        'sort_order' => 10,
        'show_in_menu' => true,
        'is_active' => true
    ],
    [
        'label' => 'NEWS',
        'title' => 'Newsletters',
        'slug' => 'newsletters',
        'menu_label' => 'Newsletters',
        'description' => 'Our monthly updates.',
        'sort_order' => 11,
        'show_in_menu' => true,
        'is_active' => true
    ],
    [
        'label' => 'JOBS',
        'title' => 'Careers',
        'slug' => 'careers',
        'menu_label' => 'Careers',
        'description' => 'Join our team.',
        'sort_order' => 12,
        'show_in_menu' => true,
        'is_active' => true
    ],
    [
        'label' => 'POLICY',
        'title' => 'Financials and Fundraising Policy',
        'slug' => 'financials',
        'menu_label' => 'Financials and Fundraising Policy',
        'description' => 'Transparency reports.',
        'sort_order' => 13,
        'show_in_menu' => true,
        'is_active' => true
    ]
];

foreach ($sections as $s) {
    AboutSection::create($s);
}

echo "Cleanup and setup complete. All menu items are now 100% dynamic.\n";
