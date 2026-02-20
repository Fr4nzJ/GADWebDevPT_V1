<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'category' => 'required|string|max:100',
            'author' => 'required|string|max:100',
            'status' => 'required|in:draft,pending,published,archived',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:51200',
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($request->title) . '-' . time();

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('news', 'public');
                $imagePaths[] = $path;
            }
        }

        $validated['images'] = $imagePaths;
        News::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'News article created successfully.');
    }

    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    public function publicShow(News $news)
    {
        $news->incrementViews();
        $relatedNews = News::where('status', 'published')
            ->where('id', '!=', $news->id)
            ->where('category', $news->category)
            ->latest()
            ->limit(3)
            ->get();

        return view('public.news.show', compact('news', 'relatedNews'));
    }

    public function newsPage()
    {
        $articles = News::where('status', 'published')->latest()->paginate(6);
        return view('news', compact('articles'));
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'category' => 'required|string|max:100',
            'author' => 'required|string|max:100',
            'status' => 'required|in:draft,pending,published,archived',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:51200',
            'remove_images' => 'nullable|array',
        ]);

        // Handle image removal
        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $imagePath) {
                Storage::disk('public')->delete($imagePath);
                $news->images = array_diff($news->images ?? [], [$imagePath]);
            }
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $newImages = $news->images ?? [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('news', 'public');
                $newImages[] = $path;
            }
            $validated['images'] = $newImages;
        } else {
            $validated['images'] = $news->images;
        }

        // Update slug if title changed
        if ($request->title !== $news->title) {
            $validated['slug'] = Str::slug($request->title) . '-' . time();
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'News article updated successfully.');
    }

    public function destroy(News $news)
    {
        // Delete associated images
        if (!empty($news->images)) {
            foreach ($news->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'News article deleted successfully.');
    }
}
