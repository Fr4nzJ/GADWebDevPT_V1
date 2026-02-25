<?php

namespace App\Http\Controllers;

use App\Models\ProcessStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PageValueController extends Controller
{
    public function index()
    {
        $values = \App\Models\PageValue::orderBy('type')->orderBy('order')->paginate(20);
        return view('admin.page-values.index', compact('values'));
    }

    public function create()
    {
        return view('admin.page-values.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:objective,value,mandate,goal,vision,mission,achievement',
            'content' => 'required|string',
            'page' => 'required|string|max:50',
            'order' => 'integer',
            'icon' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        \App\Models\PageValue::create($validated);

        Log::info('Page value created', $validated);

        return redirect()->route('admin.page-values.index')
            ->with('success', 'Page value created successfully.');
    }

    public function edit(\App\Models\PageValue $pageValue)
    {
        return view('admin.page-values.edit', compact('pageValue'));
    }

    public function update(Request $request, \App\Models\PageValue $pageValue)
    {
        $validated = $request->validate([
            'type' => 'required|in:objective,value,mandate,goal,vision,mission,achievement',
            'content' => 'required|string',
            'page' => 'required|string|max:50',
            'order' => 'integer',
            'icon' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $pageValue->update($validated);

        Log::info('Page value updated', $validated);

        return redirect()->route('admin.page-values.index')
            ->with('success', 'Page value updated successfully.');
    }

    public function destroy(\App\Models\PageValue $pageValue)
    {
        $pageValue->delete();

        Log::info('Page value deleted', $pageValue->toArray());

        return redirect()->route('admin.page-values.index')
            ->with('success', 'Page value deleted successfully.');
    }
}
