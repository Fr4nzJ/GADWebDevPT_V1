<?php

namespace App\Http\Controllers;

use App\Models\MonthlyEventChart;
use Illuminate\Http\Request;

class MonthlyEventChartController extends Controller
{
    public function index()
    {
        $chartData = MonthlyEventChart::orderBy('order')->paginate(10);
        return view('admin.monthly-event-charts.index', compact('chartData'));
    }

    public function create()
    {
        return view('admin.monthly-event-charts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'month' => 'required|string|max:255',
            'value' => 'required|integer|min:0',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        MonthlyEventChart::create($validated);

        return redirect()->route('admin.monthly-event-charts.index')
            ->with('success', 'Chart data point created successfully.');
    }

    public function show(MonthlyEventChart $monthlyEventChart)
    {
        return view('admin.monthly-event-charts.show', compact('monthlyEventChart'));
    }

    public function edit(MonthlyEventChart $monthlyEventChart)
    {
        return view('admin.monthly-event-charts.edit', compact('monthlyEventChart'));
    }

    public function update(Request $request, MonthlyEventChart $monthlyEventChart)
    {
        $validated = $request->validate([
            'month' => 'required|string|max:255',
            'value' => 'required|integer|min:0',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $monthlyEventChart->update($validated);

        return redirect()->route('admin.monthly-event-charts.index')
            ->with('success', 'Chart data point updated successfully.');
    }

    public function destroy(MonthlyEventChart $monthlyEventChart)
    {
        $monthlyEventChart->delete();

        return redirect()->route('admin.monthly-event-charts.index')
            ->with('success', 'Chart data point deleted successfully.');
    }
}
