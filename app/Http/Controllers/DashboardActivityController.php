<?php

namespace App\Http\Controllers;

use App\Models\DashboardActivity;
use Illuminate\Http\Request;

class DashboardActivityController extends Controller
{
    public function index()
    {
        $activities = DashboardActivity::orderByDesc('action_time')->paginate(10);
        return view('admin.dashboard-activities.index', compact('activities'));
    }

    public function create()
    {
        return view('admin.dashboard-activities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'action' => 'required|string|in:created,updated,deleted',
            'module' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|string|in:published,pending,active,archived,inactive',
            'action_time' => 'required|date_format:Y-m-d H:i',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        DashboardActivity::create($validated);

        return redirect()->route('admin.dashboard-activities.index')
            ->with('success', 'Activity logged successfully.');
    }

    public function show(DashboardActivity $dashboardActivity)
    {
        return view('admin.dashboard-activities.show', compact('dashboardActivity'));
    }

    public function edit(DashboardActivity $dashboardActivity)
    {
        return view('admin.dashboard-activities.edit', compact('dashboardActivity'));
    }

    public function update(Request $request, DashboardActivity $dashboardActivity)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'action' => 'required|string|in:created,updated,deleted',
            'module' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|string|in:published,pending,active,archived,inactive',
            'action_time' => 'required|date_format:Y-m-d H:i',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $dashboardActivity->update($validated);

        return redirect()->route('admin.dashboard-activities.index')
            ->with('success', 'Activity updated successfully.');
    }

    public function destroy(DashboardActivity $dashboardActivity)
    {
        $dashboardActivity->delete();

        return redirect()->route('admin.dashboard-activities.index')
            ->with('success', 'Activity deleted successfully.');
    }
}
