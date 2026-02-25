<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StatisticController extends Controller
{
    public function index()
    {
        $statistics = Statistic::orderBy('page')->orderBy('order')->paginate(20);
        return view('admin.statistics.index', compact('statistics'));
    }

    public function create()
    {
        return view('admin.statistics.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'value' => 'required|string|max:50',
            'label' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'color' => 'required|in:blue,green,orange,purple',
            'page' => 'required|string|max:50',
            'order' => 'integer',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Statistic::create($validated);

        Log::info('Statistic created', $validated);

        return redirect()->route('admin.statistics.index')
            ->with('success', 'Statistic created successfully.');
    }

    public function edit(Statistic $statistic)
    {
        return view('admin.statistics.edit', compact('statistic'));
    }

    public function update(Request $request, Statistic $statistic)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'value' => 'required|string|max:50',
            'label' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'color' => 'required|in:blue,green,orange,purple',
            'page' => 'required|string|max:50',
            'order' => 'integer',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $statistic->update($validated);

        Log::info('Statistic updated', $validated);

        return redirect()->route('admin.statistics.index')
            ->with('success', 'Statistic updated successfully.');
    }

    public function destroy(Statistic $statistic)
    {
        $statistic->delete();

        Log::info('Statistic deleted', $statistic->toArray());

        return redirect()->route('admin.statistics.index')
            ->with('success', 'Statistic deleted successfully.');
    }
}
