<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MilestoneController extends Controller
{
    public function index()
    {
        $milestones = Milestone::orderBy('year', 'desc')->paginate(20);
        return view('admin.milestones.index', compact('milestones'));
    }

    public function create()
    {
        return view('admin.milestones.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'description' => 'required|string',
            'page' => 'required|string|max:50',
            'order' => 'integer',
            'icon' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Milestone::create($validated);

        Log::info('Milestone created', $validated);

        return redirect()->route('admin.milestones.index')
            ->with('success', 'Milestone created successfully.');
    }

    public function edit(Milestone $milestone)
    {
        return view('admin.milestones.edit', compact('milestone'));
    }

    public function update(Request $request, Milestone $milestone)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'description' => 'required|string',
            'page' => 'required|string|max:50',
            'order' => 'integer',
            'icon' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $milestone->update($validated);

        Log::info('Milestone updated', $validated);

        return redirect()->route('admin.milestones.index')
            ->with('success', 'Milestone updated successfully.');
    }

    public function destroy(Milestone $milestone)
    {
        $milestone->delete();

        Log::info('Milestone deleted', $milestone->toArray());

        return redirect()->route('admin.milestones.index')
            ->with('success', 'Milestone deleted successfully.');
    }
}
