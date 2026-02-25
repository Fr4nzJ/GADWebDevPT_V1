<?php

namespace App\Http\Controllers;

use App\Models\EventStatistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class EventStatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statistics = EventStatistic::where('page', 'events')->orderBy('order')->paginate(20);
        return view('admin.event-statistics.index', compact('statistics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.event-statistics.create');
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
                'order' => 'required|integer|min:0',
                'description' => 'nullable|string',
                'is_active' => 'boolean',
            ]);

            $validated['page'] = 'events';
            $validated['is_active'] = $request->boolean('is_active', false);

            EventStatistic::create($validated);

            return redirect()->route('admin.event-statistics.index')->with('success', 'Event statistic created successfully.');
        } catch (\Exception $e) {
            Log::error('Event statistic creation error:', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Failed to create statistic: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit(EventStatistic $eventStatistic)
    {
        return view('admin.event-statistics.edit', compact('eventStatistic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventStatistic $eventStatistic)
    {
        try {
            $validated = $request->validate([
                'label' => 'required|string|max:255',
                'value' => 'required|string|max:100',
                'icon' => 'nullable|string|max:100',
                'color' => 'nullable|string|max:50',
                'order' => 'required|integer|min:0',
                'description' => 'nullable|string',
                'is_active' => 'boolean',
            ]);

            $validated['is_active'] = $request->boolean('is_active', false);

            $eventStatistic->update($validated);

            return redirect()->route('admin.event-statistics.index')->with('success', 'Event statistic updated successfully.');
        } catch (\Exception $e) {
            Log::error('Event statistic update error:', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Failed to update statistic: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventStatistic $eventStatistic)
    {
        try {
            $eventStatistic->delete();
            return redirect()->route('admin.event-statistics.index')->with('success', 'Event statistic deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Event statistic deletion error:', ['error' => $e->getMessage()]);
            return back()->with('error', 'Failed to delete statistic: ' . $e->getMessage());
        }
    }
}
