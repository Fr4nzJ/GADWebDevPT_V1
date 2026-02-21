<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Report::query();

        // Search filter (title or type)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%");
            });
        }

        // Year filter
        if ($request->filled('year') && $request->input('year') !== 'all') {
            $query->where('year', $request->input('year'));
        }

        // Type filter
        if ($request->filled('type') && $request->input('type') !== 'all') {
            $query->where('type', $request->input('type'));
        }

        // Status filter
        if ($request->filled('status') && $request->input('status') !== 'all') {
            $query->where('status', $request->input('status'));
        }

        $reports = $query->latest()->paginate(10)->appends($request->query());

        return view('admin.reports.index', compact('reports'));
    }

    public function create()
    {
        return view('admin.reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'year' => 'required|integer|min:2000|max:' . date('Y'),
            'type' => 'required|string|max:100',
            'file_path' => 'nullable|file|mimes:pdf|max:102400',
            'status' => 'required|in:draft,published,archived',
        ]);

        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('reports', 'public');
        }

        Report::create($validated);

        return redirect()->route('admin.reports.index')->with('success', 'Report created successfully.');
    }

    public function show(Report $report)
    {
        return view('admin.reports.show', compact('report'));
    }

    public function edit(Report $report)
    {
        return view('admin.reports.edit', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'year' => 'required|integer|min:2000|max:' . date('Y'),
            'type' => 'required|string|max:100',
            'file_path' => 'nullable|file|mimes:pdf|max:102400',
            'status' => 'required|in:draft,published,archived',
        ]);

        if ($request->hasFile('file_path')) {
            if ($report->file_path) {
                Storage::disk('public')->delete($report->file_path);
            }
            $validated['file_path'] = $request->file('file_path')->store('reports', 'public');
        }

        $report->update($validated);

        return redirect()->route('admin.reports.index')->with('success', 'Report updated successfully.');
    }

    public function destroy(Report $report)
    {
        if ($report->file_path) {
            Storage::disk('public')->delete($report->file_path);
        }

        $report->delete();

        return redirect()->route('admin.reports.index')->with('success', 'Report deleted successfully.');
    }

    public function publicIndex(Request $request)
    {
        // Check if any published reports exist in the database
        $hasPublishedReports = Report::where('status', 'published')->exists();

        $query = Report::where('status', 'published');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('year') && $request->input('year') !== 'all') {
            $query->where('year', $request->input('year'));
        }

        if ($request->filled('type') && $request->input('type') !== 'all') {
            $query->where('type', $request->input('type'));
        }

        $reports = $query->latest()->paginate(10)->appends($request->query());

        return view('reports', compact('reports', 'hasPublishedReports'));
    }
}
