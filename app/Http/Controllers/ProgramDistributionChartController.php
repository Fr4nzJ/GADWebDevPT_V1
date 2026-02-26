<?php

namespace App\Http\Controllers;

use App\Models\ProgramDistributionChart;
use Illuminate\Http\Request;

class ProgramDistributionChartController extends Controller
{
    public function index()
    {
        $chartData = ProgramDistributionChart::orderBy('order')->paginate(10);
        return view('admin.program-distribution-charts.index', compact('chartData'));
    }

    public function create()
    {
        return view('admin.program-distribution-charts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|integer|min:0',
            'color_hex' => 'nullable|string|max:7',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        ProgramDistributionChart::create($validated);

        return redirect()->route('admin.program-distribution-charts.index')
            ->with('success', 'Chart data point created successfully.');
    }

    public function show(ProgramDistributionChart $programDistributionChart)
    {
        return view('admin.program-distribution-charts.show', compact('programDistributionChart'));
    }

    public function edit(ProgramDistributionChart $programDistributionChart)
    {
        return view('admin.program-distribution-charts.edit', compact('programDistributionChart'));
    }

    public function update(Request $request, ProgramDistributionChart $programDistributionChart)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|integer|min:0',
            'color_hex' => 'nullable|string|max:7',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $programDistributionChart->update($validated);

        return redirect()->route('admin.program-distribution-charts.index')
            ->with('success', 'Chart data point updated successfully.');
    }

    public function destroy(ProgramDistributionChart $programDistributionChart)
    {
        $programDistributionChart->delete();

        return redirect()->route('admin.program-distribution-charts.index')
            ->with('success', 'Chart data point deleted successfully.');
    }
}
