<?php

namespace App\Http\Controllers;

use App\Models\ReportStatistic;
use Illuminate\Http\Request;

class ReportStatisticController extends Controller
{
    public function index()
    {
        $reportStatistics = ReportStatistic::where('page', 'reports')->orderBy('order')->paginate(20);
        return view('admin.report-statistics.index', compact('reportStatistics'));
    }

    public function create()
    {
        return view('admin.report-statistics.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'number' => 'required|string|max:20',
            'subtitle' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:100',
            'gradient_start' => 'required|string|max:20',
            'gradient_end' => 'required|string|max:20',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        try {
            $validated['page'] = 'reports';
            $validated['is_active'] = $request->has('is_active');
            ReportStatistic::create($validated);
            return redirect()->route('admin.report-statistics.index')
                ->with('success', 'Report statistic created successfully!');
        } catch (\Exception $e) {
            \Log::error('ReportStatistic creation error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to create report statistic: ' . $e->getMessage()]);
        }
    }

    public function edit(ReportStatistic $reportStatistic)
    {
        return view('admin.report-statistics.edit', compact('reportStatistic'));
    }

    public function update(Request $request, ReportStatistic $reportStatistic)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'number' => 'required|string|max:20',
            'subtitle' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:100',
            'gradient_start' => 'required|string|max:20',
            'gradient_end' => 'required|string|max:20',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        try {
            $validated['is_active'] = $request->has('is_active');
            $reportStatistic->update($validated);
            return redirect()->route('admin.report-statistics.index')
                ->with('success', 'Report statistic updated successfully!');
        } catch (\Exception $e) {
            \Log::error('ReportStatistic update error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to update report statistic: ' . $e->getMessage()]);
        }
    }

    public function destroy(ReportStatistic $reportStatistic)
    {
        try {
            $reportStatistic->delete();
            return redirect()->route('admin.report-statistics.index')
                ->with('success', 'Report statistic deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('ReportStatistic deletion error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to delete report statistic: ' . $e->getMessage()]);
        }
    }
}
