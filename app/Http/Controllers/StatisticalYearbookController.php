<?php

namespace App\Http\Controllers;

use App\Models\StatisticalYearbook;
use Illuminate\Http\Request;

class StatisticalYearbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $yearbooks = StatisticalYearbook::latest()->paginate(10);
        return view('admin.statistical-yearbooks.index', compact('yearbooks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.statistical-yearbooks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'publication_date' => 'nullable|date',
            'pages' => 'nullable|integer',
            'format' => 'nullable|string|max:255',
            'languages' => 'nullable|string|max:255',
            'file_path' => 'nullable|string',
            'download_size' => 'nullable|string|max:50',
            'is_active' => 'boolean',
        ]);

        StatisticalYearbook::create($validated);

        return redirect()->route('admin.statistical-yearbooks.index')
            ->with('success', 'Statistical Yearbook created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StatisticalYearbook $statisticalYearbook)
    {
        return view('admin.statistical-yearbooks.show', compact('statisticalYearbook'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StatisticalYearbook $statisticalYearbook)
    {
        return view('admin.statistical-yearbooks.edit', compact('statisticalYearbook'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StatisticalYearbook $statisticalYearbook)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'publication_date' => 'nullable|date',
            'pages' => 'nullable|integer',
            'format' => 'nullable|string|max:255',
            'languages' => 'nullable|string|max:255',
            'file_path' => 'nullable|string',
            'download_size' => 'nullable|string|max:50',
            'is_active' => 'boolean',
        ]);

        $statisticalYearbook->update($validated);

        return redirect()->route('admin.statistical-yearbooks.index')
            ->with('success', 'Statistical Yearbook updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StatisticalYearbook $statisticalYearbook)
    {
        $statisticalYearbook->delete();

        return redirect()->route('admin.statistical-yearbooks.index')
            ->with('success', 'Statistical Yearbook deleted successfully.');
    }
}
