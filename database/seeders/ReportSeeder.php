<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reports = [
            [
                'title' => 'National Gender & Social Inclusion Survey (NGSInS) 2024',
                'description' => 'Comprehensive nationwide survey examining attitudes towards gender equality, discrimination experiences, and social inclusion across 15,000 households',
                'year' => 2024,
                'type' => 'Survey',
                'status' => 'published',
            ],
            [
                'title' => 'Women\'s Economic Participation & Labor Trends Report',
                'description' => 'Analysis of women\'s labor force participation, wage gaps, business ownership, and sectoral distribution using data from 2019-2023 Labor Force Survey',
                'year' => 2023,
                'type' => 'Analysis',
                'status' => 'published',
            ],
            [
                'title' => 'Violence Against Women and Girls Prevalence Study',
                'description' => 'Multi-year study on prevalence, types, and impacts of VAWG in selected regions. Includes recommendations for prevention and response programs.',
                'year' => 2023,
                'type' => 'Research Study',
                'status' => 'published',
            ],
            [
                'title' => 'Gender Mainstreaming Assessment: Government Agencies 2023',
                'description' => 'Evaluation of 85 government agencies\' capacity and commitment to gender mainstreaming based on mandates, budgets, programs, and GAD focal person effectiveness.',
                'year' => 2023,
                'type' => 'Assessment',
                'status' => 'published',
            ],
            [
                'title' => 'Women\'s Access to Land & Agricultural Resources in Agrarian Reform Areas',
                'description' => 'Baseline assessment of women\'s participation in and access to benefits from agricultural reform programs across 8 regions.',
                'year' => 2023,
                'type' => 'Baseline Study',
                'status' => 'published',
            ],
            [
                'title' => 'Gender Audit of Education: Learning Materials & Curriculum Analysis',
                'description' => 'Analysis of 500+ textbooks and learning materials to identify gender stereotypes and recommend curriculum revisions for schools.',
                'year' => 2022,
                'type' => 'Audit',
                'status' => 'published',
            ],
            [
                'title' => 'Gender-Responsive Budgeting: Tracking Public Spending on Gender Programs',
                'description' => 'Comprehensive tracking of national and local government expenditures on gender equality and women empowerment programs (2018-2022 trend analysis).',
                'year' => 2022,
                'type' => 'Budget Analysis',
                'status' => 'published',
            ],
            [
                'title' => 'LGBTQ+ Health Needs Assessment & Recommendations',
                'description' => 'Study on health concerns, access barriers, and service needs of LGBTQ+ individuals in the Philippines with policy recommendations.',
                'year' => 2022,
                'type' => 'Health Study',
                'status' => 'published',
            ],
            [
                'title' => 'Women Entrepreneurs: Impact Evaluation of Loan Programs 2019-2022',
                'description' => 'Rigorous evaluation of women entrepreneurs who received microloans, measuring business growth, income changes, and household impacts over 3 years.',
                'year' => 2022,
                'type' => 'Impact Study',
                'status' => 'published',
            ],
            [
                'title' => 'Gender & Climate Change Vulnerability Assessment',
                'description' => 'Analysis of differential impacts of climate change on women and men, with recommendations for climate adaptation with gender lens.',
                'year' => 2021,
                'type' => 'Assessment',
                'status' => 'published',
            ],
        ];

        foreach ($reports as $report) {
            Report::create($report);
        }
    }
}
