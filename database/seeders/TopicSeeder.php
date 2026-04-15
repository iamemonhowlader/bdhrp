<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TopicSeeder extends Seeder
{
    public function run(): void
    {
        $topics = [
            ['title' => 'Arms',                          'sort_order' => 1,  'description' => 'Millions of people worldwide are at risk from the proliferation of arms. We document the devastating impact of irresponsible arms transfers and advocate for stronger controls on the global arms trade to protect civilians affected by conflict.'],
            ['title' => "Children's Rights",             'sort_order' => 2,  'description' => "Millions of children have no access to education, work long hours under hazardous conditions, or have their safety and futures threatened by armed conflict. We are working to help protect the rights of children around the world, so they can learn safely, be treated fairly, and thrive as they grow into adults."],
            ['title' => 'Crisis and Conflict',           'sort_order' => 3,  'description' => "During armed conflicts, civilians often bear the brunt of the violence. We document war crimes and other serious violations of international law to ensure accountability. Our researchers work on the front lines to gather evidence and provide a voice for those caught in the crossfire of global conflicts."],
            ['title' => 'Disability Rights',             'sort_order' => 4,  'description' => 'People with disabilities face discrimination, neglect, and abuse across the world. We work to expose these abuses and advocate for full inclusion, equal rights, and dignity for all people regardless of physical or mental ability.'],
            ['title' => 'Economic Justice and Rights',   'sort_order' => 5,  'description' => 'Economic inequality, poverty and labor exploitation are human rights issues. We document abuses in supply chains, expose corporations that profit from forced labor, and advocate for policies that uphold the economic rights of all people.'],
            ['title' => 'Environment and Human Rights',  'sort_order' => 6,  'description' => 'The climate crisis is a human rights crisis. It threatens the rights to life, health, food, water, and shelter. We work to expose how environmental degradation and climate change disproportionately affect marginalized communities and advocate for policies that prioritize both people and the planet.'],
            ['title' => 'Free Speech',                   'sort_order' => 7,  'description' => "Freedom of expression is a fundamental human right. It is essential for a healthy democracy and the protection of other human rights. However, around the world, journalists, activists, and ordinary citizens face harassment, imprisonment, and even death for speaking their minds. We document these threats and advocate for laws and policies that protect free speech both online and offline."],
            ['title' => 'Health',                        'sort_order' => 8,  'description' => 'The right to the highest attainable standard of health is essential for a life of dignity. We work to ensure that all people have access to quality healthcare without discrimination and that governments are held accountable for their obligations to protect public health.'],
            ['title' => 'Refugees and Migrants',         'sort_order' => 9,  'description' => 'Millions of people flee violence, persecution, and poverty every year. We document the dangers they face and advocate for their rights, pushing governments to uphold international refugee law and provide protection for those forced to cross borders.'],
            ['title' => 'Rights of Older People',        'sort_order' => 10, 'description' => 'Older people face unique human rights challenges, including age discrimination, poverty, abuse in care settings, and barriers to healthcare. We work to ensure that human rights protections keep pace with an ageing world population.'],
            ['title' => 'International Justice',         'sort_order' => 11, 'description' => 'Accountability for atrocities is essential for justice and reconciliation. We advocate for strong international courts, push for the prosecution of war criminals, and support victims in their quest for justice.'],
            ['title' => 'Technology and Rights',         'sort_order' => 12, 'description' => 'Technology is reshaping the landscape of human rights. We examine how surveillance, artificial intelligence, and digital platforms can both advance and undermine rights, advocating for regulations that protect privacy and freedom online.'],
            ['title' => 'Terrorism / Counterterrorism', 'sort_order' => 13, 'description' => "The threat of terrorism is often used to justify widespread abuses by governments. We expose violations committed in the name of security, insisting that counterterrorism measures comply with international human rights law."],
            ['title' => 'Torture',                       'sort_order' => 14, 'description' => "Torture is absolutely prohibited under international law, yet it remains widespread. We document cases of torture and other cruel treatment around the world and advocate for the prosecution of perpetrators and justice for survivors."],
            ['title' => 'United Nations',                'sort_order' => 15, 'description' => 'The United Nations plays a critical role in setting global standards and protecting human rights. We engage with UN bodies, advocate for stronger mandates, and push member states to live up to their commitments.'],
            ['title' => "Women's Rights",                'sort_order' => 16, 'description' => "Equality for women remains one of the world's most persistent challenges. From gender-based violence to lack of economic opportunity, women face systemic barriers to their full participation in society. We work to dismantle these barriers through rigorous research and advocacy for gender justice."],
        ];

        foreach ($topics as $topicData) {
            Topic::updateOrInsert(
                ['slug' => Str::slug($topicData['title'])],
                [
                    'title'      => $topicData['title'],
                    'slug'       => Str::slug($topicData['title']),
                    'description'=> $topicData['description'],
                    'sort_order' => $topicData['sort_order'],
                    'is_active'  => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $this->command->info('✅ ' . count($topics) . ' topics seeded successfully.');
    }
}
