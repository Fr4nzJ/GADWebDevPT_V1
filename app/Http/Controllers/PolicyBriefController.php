<?php

namespace App\Http\Controllers;

use App\Models\PolicyBrief;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PolicyBriefController extends Controller
{
    public function index()
    {
        $policyBriefs = PolicyBrief::where('page', 'reports')->orderBy('order')->paginate(20);
        return view('admin.policy-briefs.index', compact('policyBriefs'));
    }

    public function create()
    {
        return view('admin.policy-briefs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'pages' => 'nullable|integer|min:0',
            'year' => 'nullable|digits:4|integer|min:1900|max:2100',
            'icon' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:20',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        try {
            $validated['page'] = 'reports';
            $validated['is_active'] = $request->boolean('is_active', false);
            PolicyBrief::create($validated);
            return redirect()->route('admin.policy-briefs.index')
                ->with('success', 'Policy brief created successfully!');
        } catch (\Exception $e) {
            Log::error('PolicyBrief creation error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to create policy brief: ' . $e->getMessage()]);
        }
    }

    public function edit(PolicyBrief $policyBrief)
    {
        return view('admin.policy-briefs.edit', compact('policyBrief'));
    }

    public function update(Request $request, PolicyBrief $policyBrief)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'pages' => 'nullable|integer|min:0',
            'year' => 'nullable|digits:4|integer|min:1900|max:2100',
            'icon' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:20',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        try {
            $validated['is_active'] = $request->boolean('is_active', false);
            $policyBrief->update($validated);
            return redirect()->route('admin.policy-briefs.index')
                ->with('success', 'Policy brief updated successfully!');
        } catch (\Exception $e) {
            Log::error('PolicyBrief update error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to update policy brief: ' . $e->getMessage()]);
        }
    }

    public function destroy(PolicyBrief $policyBrief)
    {
        try {
            $policyBrief->delete();
            return redirect()->route('admin.policy-briefs.index')
                ->with('success', 'Policy brief deleted successfully!');
        } catch (\Exception $e) {
            Log::error('PolicyBrief deletion error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to delete policy brief: ' . $e->getMessage()]);
        }
    }
}
