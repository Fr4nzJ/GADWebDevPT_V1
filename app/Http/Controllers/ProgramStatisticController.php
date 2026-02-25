<?php

namespace App\Http\Controllers;

use App\Models\ProgramStatistic;
use Illuminate\Http\Request;

class ProgramStatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statistics = ProgramStatistic::where('page', 'programs')->orderBy('order')->paginate(20);
        return view('admin.program-statistics.index', compact('statistics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.program-statistics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'label' => 'required|string|max:255',
                'value' => 'required|string|max:100',
                'icon' => 'nullable|string|max:100',
                'color' => 'nullable|string|max:50',
                'background_class' => 'nullable|string|max:100',
                'order' => 'required|integer|min:0',
                'description' => 'nullable|string',
                'is_active' => 'boolean',
            ]);

            $validated['page'] = 'programs';
            $validated['is_active'] = $request->boolean('is_active', false);

            ProgramStatistic::create($validated);

            return redirect()->route('admin.program-statistics.index')->with('success', 'Program statistic created successfully.');
        } catch (\Exception $e) {
            \Log::error('Program statistic creation error:', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Failed to create statistic: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit(ProgramStatistic $programStatistic)
    {
        return view('admin.program-statistics.edit', compact('programStatistic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramStatistic $programStatistic)
    {
        try {
            $validated = $request->validate([
                'label' => 'required|string|max:255',
                'value' => 'required|string|max:100',
                'icon' => 'nullable|string|max:100',
                'color' => 'nullable|string|max:50',
                'background_class' => 'nullable|string|max:100',
                'order' => 'required|integer|min:0',
                'description' => 'nullable|string',
                'is_active' => 'boolean',
            ]);

            $validated['is_active'] = $request->boolean('is_active', false);

            $programStatistic->update($validated);

            return redirect()->route('admin.program-statistics.index')->with('success', 'Program statistic updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Program statistic update error:', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Failed to update statistic: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramStatistic $programStatistic)
    {
        try {
            $programStatistic->delete();
            return redirect()->route('admin.program-statistics.index')->with('success', 'Program statistic deleted successfully.');
        } catch (\Exception $e) {
            \Log::error('Program statistic deletion error:', ['error' => $e->getMessage()]);
            return back()->with('error', 'Failed to delete statistic: ' . $e->getMessage());
        }
    }
}
