<?php

namespace App\Http\Controllers;

use App\Models\ChartData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChartDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chartData = ChartData::orderBy('chart_type')
            ->orderBy('order')
            ->paginate(20);

        return view('admin.chart-data.index', compact('chartData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.chart-data.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'chart_type' => 'required|in:growth,distribution',
            'label' => 'required|string|max:255',
            'value' => 'required|integer|min:0',
            'page' => 'required|string|max:50',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        try {
            $chartData = ChartData::create($validated);
            Log::info('Chart data created', ['id' => $chartData->id, 'type' => $chartData->chart_type]);

            return redirect()->route('admin.chart-data.index')
                ->with('success', 'Chart data created successfully');
        } catch (\Exception $e) {
            Log::error('Error creating chart data', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Failed to create chart data');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChartData $chartDatum)
    {
        return view('admin.chart-data.edit', compact('chartDatum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChartData $chartDatum)
    {
        $validated = $request->validate([
            'chart_type' => 'required|in:growth,distribution',
            'label' => 'required|string|max:255',
            'value' => 'required|integer|min:0',
            'page' => 'required|string|max:50',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        try {
            $chartDatum->update($validated);
            Log::info('Chart data updated', ['id' => $chartDatum->id]);

            return redirect()->route('admin.chart-data.index')
                ->with('success', 'Chart data updated successfully');
        } catch (\Exception $e) {
            Log::error('Error updating chart data', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Failed to update chart data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChartData $chartDatum)
    {
        try {
            $chartDatum->delete();
            Log::info('Chart data deleted', ['id' => $chartDatum->id]);

            return redirect()->route('admin.chart-data.index')
                ->with('success', 'Chart data deleted successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting chart data', ['error' => $e->getMessage()]);
            return back()->with('error', 'Failed to delete chart data');
        }
    }
}

