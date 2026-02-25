<?php

namespace Database\Seeders;

use App\Models\Statistic;
use App\Models\Milestone;
use Illuminate\Database\Seeder;

class PageContentSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Statistics for Home Page
        Statistic::create([
            'title' => 'Direct Beneficiaries',
            'value' => '250K+',
            'label' => 'Direct Beneficiaries',
            'icon' => 'fas fa-users',
            'color' => 'blue',
            'page' => 'home',
            'order' => 1,
            'is_active' => true,
        ]);

        Statistic::create([
            'title' => 'Active Programs',
            'value' => '6',
            'label' => 'Active Programs',
            'icon' => 'fas fa-project-diagram',
            'color' => 'green',
            'page' => 'home',
            'order' => 2,
            'is_active' => true,
        ]);

        Statistic::create([
            'title' => 'Research Reports',
            'value' => '45+',
            'label' => 'Research Reports',
            'icon' => 'fas fa-file-pdf',
            'color' => 'orange',
            'page' => 'home',
            'order' => 3,
            'is_active' => true,
        ]);

        Statistic::create([
            'title' => 'Regions Covered',
            'value' => '17',
            'label' => 'Regions Covered',
            'icon' => 'fas fa-map-marker-alt',
            'color' => 'purple',
            'page' => 'home',
            'order' => 4,
            'is_active' => true,
        ]);

        // Seed Featured Programs for Home Page (Section 4)
        Statistic::create([
            'title' => 'Women Entrepreneurs',
            'value' => '50K',
            'label' => 'Women trained & funded',
            'icon' => 'fas fa-dollar-sign',
            'color' => '#667eea',
            'description' => '85',
            'page' => 'featured',
            'order' => 1,
            'is_active' => true,
        ]);

        Statistic::create([
            'title' => 'VAWG Prevention',
            'value' => '75K',
            'label' => 'Beneficiaries reached',
            'icon' => 'fas fa-shield-alt',
            'color' => '#48c774',
            'description' => '92',
            'page' => 'featured',
            'order' => 2,
            'is_active' => true,
        ]);

        Statistic::create([
            'title' => 'Education Access',
            'value' => '120K',
            'label' => 'Students supported',
            'icon' => 'fas fa-graduation-cap',
            'color' => '#f0ad4e',
            'description' => '78',
            'page' => 'featured',
            'order' => 3,
            'is_active' => true,
        ]);

        // Seed Milestones for Home Page
        for ($year = 2019; $year <= 2024; $year++) {
            $descriptions = [
                2019 => 'CatSu GAD established with initial programs focusing on VAWG prevention and economic empowerment',
                2020 => 'Adapted programs during COVID-19, reaching 45,000 beneficiaries through virtual channels',
                2021 => 'Expanded to 12 regions, published first comprehensive GAD Statistical Report',
                2022 => 'Launched Women Entrepreneurship Fund with ₱150M budget allocation',
                2023 => 'Achieved 100K+ beneficiaries milestone, established LGBTQ+ rights advocacy alliance',
                2024 => 'Expanded to 17 regions, reached 250K+ cumulative beneficiaries',
            ];

            Milestone::create([
                'year' => $year,
                'description' => $descriptions[$year],
                'page' => 'home',
                'order' => $year - 2019,
                'is_active' => true,
            ]);
        }

        // Seed Page Values for About Page
        \App\Models\PageValue::create([
            'type' => 'vision',
            'content' => 'A gender sensitive and responsive university in a safe and peaceful environment free from any form of violence',
            'page' => 'about',
            'icon' => 'fas fa-eye',
            'order' => 1,
            'is_active' => true,
        ]);

        \App\Models\PageValue::create([
            'type' => 'mission',
            'content' => 'Faster gender and development advocacy, promote peaceful and safe environment and strengthen partnership network toward achieving equality for all',
            'page' => 'about',
            'icon' => 'fas fa-bullseye',
            'order' => 1,
            'is_active' => true,
        ]);

        \App\Models\PageValue::create([
            'type' => 'objective',
            'content' => 'Integrate GAD concepts in the circular agenda',
            'page' => 'about',
            'icon' => 'fas fa-hands-helping',
            'order' => 1,
            'is_active' => true,
        ]);

        \App\Models\PageValue::create([
            'type' => 'objective',
            'content' => 'Conduct GAD-related research and gender-responsive extension services',
            'page' => 'about',
            'icon' => 'fas fa-microscope',
            'order' => 2,
            'is_active' => true,
        ]);

        \App\Models\PageValue::create([
            'type' => 'objective',
            'content' => 'Institutionalize GAD enabling mechanisms',
            'page' => 'about',
            'icon' => 'fas fa-users',
            'order' => 3,
            'is_active' => true,
        ]);

        \App\Models\PageValue::create([
            'type' => 'mandate',
            'content' => 'The Catanduanes State University, in adherence to statutes, undertakes advocacy on gender equality and equity by implementing enabling policies and mechanisms including non-sexist programs, projects and other GAD-related activities.',
            'page' => 'about',
            'order' => 1,
            'is_active' => true,
        ]);

        \App\Models\PageValue::create([
            'type' => 'goal',
            'content' => 'Mainstream gender and development in the four-fold functions of the institution.',
            'page' => 'about',
            'order' => 1,
            'is_active' => true,
        ]);

        $this->command->info('Page content seeded successfully!');
    }
}
