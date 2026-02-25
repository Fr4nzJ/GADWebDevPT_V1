<?php

namespace App\Http\Controllers;

use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PageSectionController extends Controller
{
    public function index()
    {
        $sections = PageSection::orderBy('page')->orderBy('order')->paginate(20);
        return view('admin.page-sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.page-sections.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'page' => 'required|string|max:50',
            'section_key' => 'required|string|max:100',
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
            'order' => 'integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        PageSection::create($validated);

        Log::info('Page section created', $validated);

        return redirect()->route('admin.page-sections.index')
            ->with('success', 'Page section created successfully.');
    }

    public function edit(PageSection $pageSection)
    {
        return view('admin.page-sections.edit', compact('pageSection'));
    }

    public function update(Request $request, PageSection $pageSection)
    {
        $validated = $request->validate([
            'page' => 'required|string|max:50',
            'section_key' => 'required|string|max:100',
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
            'order' => 'integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $pageSection->update($validated);

        Log::info('Page section updated', $validated);

        return redirect()->route('admin.page-sections.index')
            ->with('success', 'Page section updated successfully.');
    }

    public function destroy(PageSection $pageSection)
    {
        $pageSection->delete();

        Log::info('Page section deleted', $pageSection->toArray());

        return redirect()->route('admin.page-sections.index')
            ->with('success', 'Page section deleted successfully.');
    }
}
