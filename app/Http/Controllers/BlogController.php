<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class BlogController extends Controller
{   
    public function index()
    {
        
        $posts = Post::orderBy('created_at', 'desc')->paginate(10); // Пагінація по 10 постів

        return view('blog.index', compact('posts'));
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'image' => 'nullable|image|max:2048', 
        ]);

     

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $imagePath;
        }


        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'text' => $validated['text'],
            'image' => $validated['image'] ?? null,
        ]);
    
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        
        if (Auth::id() !== $post->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('blog.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
{
    
    if (Auth::id() !== $post->user_id) {
        abort(403, 'Unauthorized action.');
    }

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'text' => 'required|string',
        'image' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $validated['image'] = $request->file('image')->store('images', 'public');
    }

    $post->update($validated);

    return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
}

public function destroy(Post $post)
{
   
    if (Auth::id() !== $post->user_id) {
        abort(403, 'Unauthorized action.');
    }

    
    if ($post->image) {
        Storage::disk('public')->delete($post->image);
    }

    $post->delete();

    return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
}

}
