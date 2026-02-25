<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index()
    {
        $resources = Resource::where('page', 'reports')->orderBy('order')->paginate(20);
        return view('admin.resources.index', compact('resources'));
    }

    public function create()
    {
        return view('admin.resources.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:20',
            'button_text' => 'required|string|max:100',
            'button_url' => 'nullable|string|max:255',
            'button_action' => 'required|in:download,access,view,link',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        try {
            $validated['page'] = 'reports';
            $validated['is_active'] = $request->has('is_active');
            Resource::create($validated);
            return redirect()->route('admin.resources.index')
                ->with('success', 'Resource created successfully!');
        } catch (\Exception $e) {
            \Log::error('Resource creation error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to create resource: ' . $e->getMessage()]);
        }
    }

    public function edit(Resource $resource)
    {
        return view('admin.resources.edit', compact('resource'));
    }

    public function update(Request $request, Resource $resource)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:20',
            'button_text' => 'required|string|max:100',
            'button_url' => 'nullable|string|max:255',
            'button_action' => 'required|in:download,access,view,link',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        try {
            $validated['is_active'] = $request->has('is_active');
            $resource->update($validated);
            return redirect()->route('admin.resources.index')
                ->with('success', 'Resource updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Resource update error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to update resource: ' . $e->getMessage()]);
        }
    }

    public function destroy(Resource $resource)
    {
        try {
            $resource->delete();
            return redirect()->route('admin.resources.index')
                ->with('success', 'Resource deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Resource deletion error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to delete resource: ' . $e->getMessage()]);
        }
    }
}
