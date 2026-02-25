<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use App\Models\Milestone;
use App\Models\ProcessStep;
use App\Models\PageSection;
use App\Models\ChartData;
use App\Models\Achievement;

class PageController extends Controller
{
    /**
     * Show the home/welcome page with dynamic content
     */
    public function home()
    {
        $statistics = Statistic::where('page', 'home')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $milestones = Milestone::where('page', 'home')
            ->where('is_active', true)
            ->orderBy('year', 'asc')
            ->get();

        $processSteps = ProcessStep::where('page', 'home')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $featuredPrograms = Statistic::where('page', 'featured')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $growthChart = ChartData::where('chart_type', 'growth')
            ->where('page', 'home')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $distributionChart = ChartData::where('chart_type', 'distribution')
            ->where('page', 'home')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $sections = PageSection::where('page', 'home')
            ->where('is_active', true)
            ->orderBy('order')
            ->get()
            ->keyBy('section_key');

        return view('welcome', compact('statistics', 'milestones', 'processSteps', 'featuredPrograms', 'growthChart', 'distributionChart', 'sections'));
    }

    /**
     * Show the about page with dynamic content
     */
    public function about()
    {
        $visions = \App\Models\PageValue::where('type', 'vision')
            ->where('page', 'about')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $missions = \App\Models\PageValue::where('type', 'mission')
            ->where('page', 'about')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $objectives = \App\Models\PageValue::where('type', 'objective')
            ->where('page', 'about')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $mandates = \App\Models\PageValue::where('type', 'mandate')
            ->where('page', 'about')
            ->where('is_active', true)
            ->orderBy('order')
            ->first();

        $goals = \App\Models\PageValue::where('type', 'goal')
            ->where('page', 'about')
            ->where('is_active', true)
            ->orderBy('order')
            ->first();

        $achievements = Achievement::where('page', 'about')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $sections = PageSection::where('page', 'about')
            ->where('is_active', true)
            ->orderBy('order')
            ->get()
            ->keyBy('section_key');

        return view('about', compact('visions', 'missions', 'objectives', 'mandates', 'goals', 'achievements', 'sections'));
    }
}
