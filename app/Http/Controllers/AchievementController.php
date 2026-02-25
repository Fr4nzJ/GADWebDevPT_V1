<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $achievements = Achievement::where('page', 'about')->orderBy('order')->paginate(20);
        return view('admin.achievements.index', compact('achievements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.achievements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'number' => 'required|string|max:50',
                'label' => 'required|string|max:255',
                'icon' => 'nullable|string|max:100',
                'order' => 'required|integer|min:0',
                'is_active' => 'boolean',
            ]);

            $validated['page'] = 'about';
            $validated['is_active'] = $request->boolean('is_active', false);

            Achievement::create($validated);

            return redirect()->route('admin.achievements.index')->with('success', 'Achievement created successfully.');
        } catch (\Exception $e) {
            \Log::error('Achievement creation error:', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Failed to create achievement: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit(Achievement $achievement)
    {
        return view('admin.achievements.edit', compact('achievement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Achievement $achievement)
    {
        try {
            $validated = $request->validate([
                'number' => 'required|string|max:50',
                'label' => 'required|string|max:255',
                'icon' => 'nullable|string|max:100',
                'order' => 'required|integer|min:0',
                'is_active' => 'boolean',
            ]);

            $validated['is_active'] = $request->boolean('is_active', false);

            $achievement->update($validated);

            return redirect()->route('admin.achievements.index')->with('success', 'Achievement updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Achievement update error:', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Failed to update achievement: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Achievement $achievement)
    {
        try {
            $achievement->delete();
            return redirect()->route('admin.achievements.index')->with('success', 'Achievement deleted successfully.');
        } catch (\Exception $e) {
            \Log::error('Achievement deletion error:', ['error' => $e->getMessage()]);
            return back()->with('error', 'Failed to delete achievement: ' . $e->getMessage());
        }
    }
}
