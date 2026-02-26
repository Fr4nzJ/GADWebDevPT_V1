<?php

namespace App\Http\Controllers;

use App\Models\DashboardStatistic;
use Illuminate\Http\Request;

class DashboardStatisticController extends Controller
{
    public function index()
    {
        $statistics = DashboardStatistic::orderBy('order')->paginate(10);
        return view('admin.dashboard-statistics.index', compact('statistics'));
    }

    public function create()
    {
        return view('admin.dashboard-statistics.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|integer|min:0',
            'icon_class' => 'nullable|string|max:255',
            'color_class' => 'nullable|string|in:blue,purple,green,orange,red',
            'trend_value' => 'nullable|integer',
            'trend_direction' => 'nullable|string|in:up,down,flat',
            'trend_text' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        DashboardStatistic::create($validated);

        return redirect()->route('admin.dashboard-statistics.index')
            ->with('success', 'Statistic card created successfully.');
    }

    public function show(DashboardStatistic $dashboardStatistic)
    {
        return view('admin.dashboard-statistics.show', compact('dashboardStatistic'));
    }

    public function edit(DashboardStatistic $dashboardStatistic)
    {
        return view('admin.dashboard-statistics.edit', compact('dashboardStatistic'));
    }

    public function update(Request $request, DashboardStatistic $dashboardStatistic)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|integer|min:0',
            'icon_class' => 'nullable|string|max:255',
            'color_class' => 'nullable|string|in:blue,purple,green,orange,red',
            'trend_value' => 'nullable|integer',
            'trend_direction' => 'nullable|string|in:up,down,flat',
            'trend_text' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $dashboardStatistic->update($validated);

        return redirect()->route('admin.dashboard-statistics.index')
            ->with('success', 'Statistic card updated successfully.');
    }

    public function destroy(DashboardStatistic $dashboardStatistic)
    {
        $dashboardStatistic->delete();

        return redirect()->route('admin.dashboard-statistics.index')
            ->with('success', 'Statistic card deleted successfully.');
    }
}
