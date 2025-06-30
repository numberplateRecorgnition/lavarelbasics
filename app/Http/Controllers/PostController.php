<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Show the form with dynamic dropdowns
    public function create()
    {
        $users = User::all();
        $categories = Category::all();

        return view('adminPanel', compact('users', 'categories'));
    }

    // Save the post from the form
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|max:2048',
        ]);

        // Create and save the post
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $request->user_id;
        $post->category_id = $request->category_id;

        if ($request->hasFile('photo')) {
            $post->photo = $request->file('photo')->store('uploads', 'public');
        }

        $post->save();

        return redirect()->route('admin.panel')->with('success', 'Post created successfully!');
    }
    //get all posts
    public function index()
{
    $posts = \App\Models\Post::with(['user', 'category'])->latest()->get();
    return view('posts', compact('posts'));
}

// Show the form to edit a post
public function edit($id)
{
    $post = Post::findOrFail($id);
    $users = User::all();
    $categories = Category::all();

    return view('edit_posts', compact('post', 'users', 'categories'));
}

// Update the post
public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
        'user_id' => 'required|exists:users,id',
        'category_id' => 'required|exists:categories,id',
        'photo' => 'nullable|image|max:2048',
    ]);

    $post = Post::findOrFail($id);
    $post->title = $request->title;
    $post->body = $request->body;
    $post->user_id = $request->user_id;
    $post->category_id = $request->category_id;

    if ($request->hasFile('photo')) {
        $post->photo = $request->file('photo')->store('uploads', 'public');
    }

    $post->save();

    return redirect('/edit_posts')->with('success', 'Post updated successfully!');
}

// Delete a post
public function destroy($id)
{
    $post = Post::findOrFail($id);
    $post->delete();

    return redirect('/edit_posts')->with('success', 'Post deleted successfully!');
}

public function listPosts(Request $request)
{
    $posts = Post::with(['user', 'category'])->latest()->get();

    $editPost = null;
    $users = User::all();
    $categories = Category::all();

    if ($request->has('edit_id')) {
        $editPost = Post::find($request->input('edit_id'));
    }

    return view('edit_posts', compact('posts', 'editPost', 'users', 'categories'));
}




}