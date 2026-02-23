<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date_format:Y-m-d\TH:i|nullable',
            'location' => 'required|string|max:255',
            'status' => 'required|in:upcoming,ongoing,completed,cancelled',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:51200',
        ]);

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('events', 'public');
                $imagePaths[] = $path;
            }
        }

        $validated['images'] = $imagePaths;
        Event::create($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    public function publicShow(Event $event)
    {
        return view('public.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date_format:Y-m-d\TH:i|nullable',
            'location' => 'required|string|max:255',
            'status' => 'required|in:upcoming,ongoing,completed,cancelled',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:51200',
            'remove_images' => 'nullable|array',
        ]);

        // Handle image removal
        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $imagePath) {
                Storage::disk('public')->delete($imagePath);
                $event->images = array_diff($event->images ?? [], [$imagePath]);
            }
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $newImages = $event->images ?? [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('events', 'public');
                $newImages[] = $path;
            }
            $validated['images'] = $newImages;
        } else {
            $validated['images'] = $event->images;
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        // Delete associated images
        if (!empty($event->images)) {
            foreach ($event->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }
        
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }
}