<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPanelController extends Controller
{
   
    public function admin()
    {
        return view('adminPanel');
    }
    

    public function welcome()
    {
        return view('home');
    }

    public function index()
        {
            $users = User::all();            // Get all users
            $categories = Category::all();   // Get all categories

            return view('adminPanel', compact('users', 'categories'));
        }

   
     //Save new category
     
    public function save_categories(Request $request)
    {
        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create new category instance
        $category = new Category();
        $category->name = $request->name;
        $category->details = $request->details;

        // Handle image upload
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/photos');
            $category->photo = $path; // save path in DB
        } else {
            $category->photo = ''; // no photo uploaded
        }

        // Save category to DB
        $category->save();

        // Redirect to category list with success message
        return redirect('/categories')->with('success', 'Category created successfully!');
    }

   
     // List all categories
     
    public function list_categories(Request $request)
    {
        $search = $request->input('search');

        $list = $search
            ? Category::where('name', 'like', "%$search%")->get()
            : Category::all();

        return view('categories', compact('list', 'search'));
    }

    // Show edit form
public function edit_category($id)
{
    $category = Category::findOrFail($id);
    return view('edit_category', compact('category'));
}

// Handle update
public function update_category(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'details' => 'required|string',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $category = Category::findOrFail($id);
    $category->name = $request->name;
    $category->details = $request->details;

    if ($request->hasFile('photo')) {
        $path = $request->file('photo')->store('public/photos');
        $category->photo = $path;
    }

    $category->save();

    return redirect('/categories')->with('success', 'Category updated successfully!');
}

// Handle delete
public function delete_category($id)
{
    $category = Category::findOrFail($id);
    $category->delete();

    return redirect('/categories')->with('success', 'Category deleted successfully!');
}

public function search_categories(Request $request)
{
    $search = $request->input('search');
    $categories = Category::where('name', 'like', "%$search%")->get();

    return view('partials.category_table', compact('categories'))->render(); 
}

    

// List all posts with user and category data
public function list_posts(Request $request)
{
    $search = $request->input('search');

    $posts = $search
        ? Post::where('title', 'like', "%$search%")->with('user', 'category')->get()
        : Post::with('user', 'category')->get();

    return view('edit_posts', compact('posts'));
}

// Show edit form for a single post
public function edit_post($id)
{
    $post = Post::findOrFail($id);
    $users = User::all();
    $categories = Category::all();

    return view('edit_post', compact('post', 'users', 'categories'));
}

// Update post after edit form submission
public function update_post(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'user_id' => 'required|exists:users,id',
        'category_id' => 'required|exists:categories,id',
    ]);

    $post = Post::findOrFail($id);
    $post->title = $request->title;
    $post->body = $request->body;
    $post->user_id = $request->user_id;
    $post->category_id = $request->category_id;

    if ($request->hasFile('photo')) {
        $path = $request->file('photo')->store('uploads');  // store inside storage/app/uploads
        $post->photo = $path;
    }

    $post->save();

    return redirect('/edit_posts')->with('success', 'Post updated successfully!');
}

// Delete a post
public function delete_post($id)
{
    $post = Post::findOrFail($id);
    $post->delete();

    return redirect('/edit_posts')->with('success', 'Post deleted successfully!');
}
}