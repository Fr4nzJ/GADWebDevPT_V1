<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest()->paginate(10);
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'required|string',
            'category' => 'required|in:women_empowerment,education,safety,leadership,lgbtq,mainstreaming',
            'status' => 'required|in:ongoing,completed,upcoming,suspended',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'beneficiaries' => 'nullable|integer|min:0',
            'budget' => 'nullable|integer|min:0',
            'location' => 'nullable|string|max:255',
            'target_group' => 'nullable|string',
            'objectives' => 'nullable|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('programs', 'public');
            $validated['image'] = $imagePath;
        }

        // Convert objectives string to array
        if ($validated['objectives']) {
            $validated['objectives'] = array_filter(array_map('trim', explode("\n", $validated['objectives'])));
        }

        Program::create($validated);

        return redirect()->route('admin.programs.index')->with('success', 'Program created successfully.');
    }

    public function show(Program $program)
    {
        return view('admin.programs.show', compact('program'));
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'required|string',
            'category' => 'required|in:women_empowerment,education,safety,leadership,lgbtq,mainstreaming',
            'status' => 'required|in:ongoing,completed,upcoming,suspended',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'beneficiaries' => 'nullable|integer|min:0',
            'budget' => 'nullable|integer|min:0',
            'location' => 'nullable|string|max:255',
            'target_group' => 'nullable|string',
            'objectives' => 'nullable|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($program->image && Storage::disk('public')->exists($program->image)) {
                Storage::disk('public')->delete($program->image);
            }
            $imagePath = $request->file('image')->store('programs', 'public');
            $validated['image'] = $imagePath;
        }

        // Convert objectives string to array
        if ($validated['objectives']) {
            $validated['objectives'] = array_filter(array_map('trim', explode("\n", $validated['objectives'])));
        } else {
            $validated['objectives'] = null;
        }

        $program->update($validated);

        return redirect()->route('admin.programs.index')->with('success', 'Program updated successfully.');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('admin.programs.index')->with('success', 'Program deleted successfully.');
    }

    public function publicIndex()
    {
        $programs = Program::where('status', '!=', 'suspended')->latest()->get();
        return view('programs', compact('programs'));
    }
}
