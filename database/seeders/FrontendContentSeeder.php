<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class FrontendContentSeeder extends Seeder
{
    public function run(): void
    {
        if (SiteSetting::query()->exists()) {
            return;
        }

        $bangladesh = [
            ['division' => 'Barishal', 'districts' => ['Barguna', 'Barishal', 'Bhola', 'Jhalokati', 'Patuakhali', 'Pirojpur']],
            ['division' => 'Chattogram', 'districts' => ['Bandarban', 'Brahmanbaria', 'Chandpur', 'Chattogram', 'Cumilla', "Cox's Bazar", 'Feni', 'Khagrachari', 'Lakshmipur', 'Noakhali', 'Rangamati']],
            ['division' => 'Dhaka', 'districts' => ['Dhaka', 'Faridpur', 'Gazipur', 'Gopalganj', 'Kishoreganj', 'Madaripur', 'Manikganj', 'Munshiganj', 'Narayanganj', 'Narsingdi', 'Rajbari', 'Shariatpur', 'Tangail']],
            ['division' => 'Khulna', 'districts' => ['Bagerhat', 'Chuadanga', 'Jessore', 'Jhenaidah', 'Khulna', 'Kushtia', 'Magura', 'Meherpur', 'Narail', 'Satkhira']],
            ['division' => 'Mymensingh', 'districts' => ['Jamalpur', 'Mymensingh', 'Netrokona', 'Sherpur']],
            ['division' => 'Rajshahi', 'districts' => ['Bogra', 'Joypurhat', 'Naogaon', 'Natore', 'Chapainawabganj', 'Pabna', 'Rajshahi', 'Sirajganj']],
            ['division' => 'Rangpur', 'districts' => ['Dinajpur', 'Gaibandha', 'Kurigram', 'Lalmonirhat', 'Nilphamari', 'Panchagarh', 'Rangpur', 'Thakurgaon']],
            ['division' => 'Sylhet', 'districts' => ['Habiganj', 'Moulvibazar', 'Sunamganj', 'Sylhet']],
        ];

        $heroSlides = [
            ['image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=1600', 'alt' => 'Community'],
            ['image' => 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=1600', 'alt' => 'Support'],
            ['image' => 'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=1600', 'alt' => 'Helping hands'],
        ];

        $homeVideos = [
            ['id' => 1, 'title' => 'Breaking the Authoritarian Wave: A Generational Challenge for Human Rights', 'duration' => '04:29', 'videoUrl' => 'https://www.youtube.com/embed/jdxoXOFSY34'],
            ['id' => 2, 'title' => 'World Report 2026: Press Conference', 'duration' => '54:34', 'videoUrl' => 'https://www.youtube.com/embed/eY8kcypHxmI'],
            ['id' => 3, 'title' => 'Deadly Crackdown, Mass Arrests in Iran', 'duration' => '00:43', 'videoUrl' => 'https://www.youtube.com/embed/11hpw6HkGFs'],
            ['id' => 4, 'title' => 'Iranian Authorities Brutally Repressing Protests', 'duration' => '00:44', 'videoUrl' => 'https://www.youtube.com/embed/6wTKJbbT_WM'],
            ['id' => 5, 'title' => 'Survivors face lack of support as sexual violence escalates in eastern Congo', 'duration' => '03:50', 'videoUrl' => 'https://www.youtube.com/embed/6l4Zz_c1t3g'],
        ];

        $homeActivities = [
            ['id' => 1, 'image' => 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=600&h=800&fit=crop', 'type' => 'image', 'title' => 'Community Outreach Program'],
            ['id' => 2, 'image' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=600&h=800&fit=crop', 'type' => 'video', 'title' => 'Leadership Training Workshop', 'videoUrl' => 'https://www.youtube.com/embed/dQw4w9WgXcQ'],
            ['id' => 3, 'image' => 'https://images.unsplash.com/photo-1593113598332-cd288d649433?w=600&h=800&fit=crop', 'type' => 'image', 'title' => 'Youth Empowerment Initiative'],
            ['id' => 4, 'image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=600&h=800&fit=crop', 'type' => 'video', 'title' => 'Human Rights Awareness Campaign', 'videoUrl' => 'https://www.youtube.com/embed/dQw4w9WgXcQ'],
            ['id' => 5, 'image' => 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=600&h=800&fit=crop', 'type' => 'image', 'title' => "Women's Rights Forum"],
            ['id' => 6, 'image' => 'https://images.unsplash.com/photo-1609220136736-443140cffec6?w=600&h=800&fit=crop', 'type' => 'video', 'title' => 'Legal Aid Documentation', 'videoUrl' => 'https://www.youtube.com/embed/dQw4w9WgXcQ'],
        ];

        $homeAboutStats = [
            ['caption' => 'join our team', 'value' => '6,472+', 'icon' => 'team'],
            ['caption' => 'donate now', 'value' => '$38,768', 'icon' => 'donate'],
            ['caption' => 'total fund Raised', 'value' => '1,193,210', 'icon' => 'fund'],
        ];

        $socialLinks = [
            ['network' => 'facebook', 'url' => '#'],
            ['network' => 'twitter', 'url' => '#'],
            ['network' => 'linkedin', 'url' => '#'],
        ];

        $pairs = [
            'header_email' => 'contact@bdhrp.org',
            'header_phone' => '01715103321',
            'header_volunteer_cta' => "🎯 Are you ready to help them? Let's become a volunteers!",
            'header_logo_alt' => 'BDHRP Logo',
            'nav_home_label' => 'Home',
            'nav_gallery_label' => 'Gallery',
            'nav_contact_label' => 'Contact',
            'nav_bangladesh_label' => 'Bangladesh',
            'nav_topics_label' => 'Topics',
            'nav_about_label' => 'About',
            'nav_join_label' => 'Join Us',
            'donate_button_label' => 'Donate Now',
            'hero_kicker' => 'Start Donating Poor People',
            'hero_line1' => 'Celebrate',
            'hero_highlight' => 'World Human Rights Day!',
            'hero_line2' => 'our everyday essentials',
            'hero_primary_label' => 'Discover More',
            'hero_primary_href' => '/about-us',
            'hero_secondary_label' => 'Get A Quote',
            'hero_secondary_href' => '/contact',
            'home_about_title' => 'ABOUT BDHRP',
            'home_about_body' => 'Founded in 2007, the Bangladesh Human Rights Parishad is a non-political, voluntary organization approved by the Government of the People’s Republic of Bangladesh. It is committed to protecting human rights and promoting sustainable development throughout Bangladesh. Guided by the charter of the United Nations, the organization is dedicated to eradicating poverty, ensuring social justice, and safeguarding the constitutional rights of every citizen.',
            'home_about_more_label' => 'more about us',
            'home_about_more_href' => '/about-us',
            'lifestyle_kicker' => 'KNOW ABOUT',
            'lifestyle_title' => 'Inspiring and helping for better lifestyle',
            'lifestyle_body' => 'We have been providing technical mentoring services to support the Government of Bangladesh and other stakeholders committed to promoting technologies and services in sustainable development country and its society. It upholds the Dream of the development. It aims to facilitate poverty, gender equality.',
            'videos_title' => 'Videos',
            'videos_more_label' => 'Watch more',
            'videos_more_href' => '/videos',
            'latest_article_kicker' => 'Our Latest Article',
            'latest_article_title' => 'Latest News & Articles from',
            'latest_article_subtitle' => 'clean heart',
            'support_title' => 'Your Support Can Change Lives',
            'support_body' => 'Every small donation helps Bangladesh Human Rights Parishad (BDHRP) provide essential services to those in need, including legal aid, community support, and human rights advocacy. Your contribution is helping the people, making a significant impact on improving the lives of people throughout Bangladesh, the country.',
            'activities_title' => "Visually demonstrate\nBDHRP’s activities",
            'activities_view_more_label' => 'View More',
            'activities_view_more_href' => '/activities',
            'lifetime_badge' => 'Exclusive Membership',
            'lifetime_title' => 'Become a Life Time Member',
            'lifetime_body' => 'Join our global network of dedicated advocates. Your lifelong commitment empowers BDHRP to investigate human rights abuses and build a legacy of justice for future generations.',
            'lifetime_cta' => 'Join Now For Life',
            'lifetime_footer_note' => 'Leave a lasting impact',
            'join_movement_title' => 'Join Our Movement',
            'join_movement_cta_label' => 'Join Now',
            'join_movement_quote' => 'Be part of our mission to protect human rights in Bangladesh. Join as a volunteer, collaborate as a partner, or contribute to our ongoing programs to make a real impact in communities across the country. Together, we can promote justice, equality, and dignity for everyone.',
            'join_movement_author' => 'Mohammed Khorshed Alam',
            'join_movement_role' => 'Chairman',
            'join_movement_image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&h=200&fit=crop',
        ];

        foreach ($pairs as $key => $value) {
            SiteSetting::setValue($key, $value, SiteSetting::groupForKey($key));
        }

        SiteSetting::setValue('bangladesh_divisions', json_encode($bangladesh, JSON_UNESCAPED_UNICODE), 'bangladesh');
        SiteSetting::setValue('hero_slides', json_encode($heroSlides, JSON_UNESCAPED_UNICODE), 'hero');
        SiteSetting::setValue('home_videos', json_encode($homeVideos, JSON_UNESCAPED_UNICODE), 'videos');
        SiteSetting::setValue('home_activities', json_encode($homeActivities, JSON_UNESCAPED_UNICODE), 'activities');
        SiteSetting::setValue('home_about_stats', json_encode($homeAboutStats, JSON_UNESCAPED_UNICODE), 'home_about');
        SiteSetting::setValue('social_links', json_encode($socialLinks, JSON_UNESCAPED_UNICODE), 'header');

        if (! MenuItem::query()->exists()) {
            $about = [
                ['Newsletters', '/newsletters'],
                ['Careers', '/careers'],
                ['About Us', '/about-us'],
                ['People', '/people'],
                ['Social Media', '/social-media'],
                ['Human Rights Education', '/hr-education'],
                ['Partners', '/partners'],
                ['Financials and Fundraising Policy', '/financials'],
                ['Accessibility', '/accessibility'],
                ['Contact', '/contact'],
            ];
            $sort = 0;
            foreach ($about as [$label, $href]) {
                MenuItem::create([
                    'zone' => 'about',
                    'label' => $label,
                    'href' => $href,
                    'sort_order' => $sort++,
                ]);
            }

            $join = [
                ['Our Committees', '/our-committees'],
                ['Activities', '/activities'],
                ['Legacies for Justice', '/legacies'],
                ['Become a Member', '/committee'],
                ['Become Life Time Member', null, 'openModal'],
            ];
            $sort = 0;
            foreach ($join as $row) {
                MenuItem::create([
                    'zone' => 'join_us',
                    'label' => $row[0],
                    'href' => $row[1] ?? null,
                    'action' => $row[2] ?? null,
                    'sort_order' => $sort++,
                ]);
            }

            $topicsList = [
                'Arms', "Children's Rights", 'Crisis and Conflict', 'Disability Rights',
                'Economic Justice and Rights', 'Environment and Human Rights',
                'Free Speech', 'Health', 'Refugees and Migrants',
                'Rights of Older People', 'International Justice', 'Technology and Rights',
                'Terrorism / Counterterrorism', 'Torture', 'United Nations', "Women's Rights",
            ];
            $sort = 0;
            foreach ($topicsList as $topic) {
                $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', trim($topic)));
                $slug = trim($slug, '-');
                MenuItem::create([
                    'zone' => 'topics',
                    'label' => $topic,
                    'href' => '/topic/'.$slug,
                    'sort_order' => $sort++,
                ]);
            }
        }
    }
}
