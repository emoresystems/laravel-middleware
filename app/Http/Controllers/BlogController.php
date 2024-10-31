<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the blogs.
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new blog.
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created blog in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Blog::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }

    /**
     * Display the specified blog.
     */
    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified blog.
     */
    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified blog in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload if a new image is uploaded
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $blog->image_path = $imagePath;
        }

        $blog->update([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $blog->image_path,
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified blog from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
