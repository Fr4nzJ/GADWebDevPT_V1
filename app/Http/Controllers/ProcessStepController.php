<?php

namespace App\Http\Controllers;

use App\Models\ProcessStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProcessStepController extends Controller
{
    public function index()
    {
        $processSteps = ProcessStep::orderBy('page')->orderBy('order')->paginate(20);
        return view('admin.process-steps.index', compact('processSteps'));
    }

    public function create()
    {
        return view('admin.process-steps.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'page' => 'required|string|max:50',
            'order' => 'integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        ProcessStep::create($validated);

        Log::info('Process step created', $validated);

        return redirect()->route('admin.process-steps.index')
            ->with('success', 'Process step created successfully.');
    }

    public function edit(ProcessStep $processStep)
    {
        return view('admin.process-steps.edit', compact('processStep'));
    }

    public function update(Request $request, ProcessStep $processStep)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'page' => 'required|string|max:50',
            'order' => 'integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $processStep->update($validated);

        Log::info('Process step updated', $validated);

        return redirect()->route('admin.process-steps.index')
            ->with('success', 'Process step updated successfully.');
    }

    public function destroy(ProcessStep $processStep)
    {
        $processStep->delete();

        Log::info('Process step deleted', $processStep->toArray());

        return redirect()->route('admin.process-steps.index')
            ->with('success', 'Process step deleted successfully.');
    }
}
