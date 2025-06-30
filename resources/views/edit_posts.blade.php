@extends('layouts.mainlayout')

@section('title', 'Edit Posts')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">All Posts</h2>

    {{-- EDIT FORM SECTION --}}
    @if(isset($editPost))
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Edit Post: {{ $editPost->title }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/edit_posts/' . $editPost->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" value="{{ old('title', $editPost->title) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Body</label>
                    <textarea name="body" class="form-control" required>{{ old('body', $editPost->body) }}</textarea>
                </div>

                <div class="mb-3">
                    <label>User</label>
                    <select name="user_id" class="form-control" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == $editPost->user_id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Category</label>
                    <select name="category_id" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $editPost->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Change Photo (optional)</label>
                    <input type="file" name="photo" class="form-control">
                    @if($editPost->photo)
                        <p>Current Photo:</p>
                        <img src="{{ asset('storage/' . $editPost->photo) }}" width="150" alt="Post Photo">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Update Post</button>
                <a href="{{ url('/edit_posts') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
    @endif

    {{-- POSTS TABLE --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th style="width: 150px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->user->name ?? 'N/A' }}</td>
                        <td>{{ $post->category->name ?? 'N/A' }}</td>
                        <td>
                            @if($post->photo)
                                <img src="{{ asset('storage/' . $post->photo) }}" alt="Post Image" width="100">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('/edit_posts?edit_id=' . $post->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ url('/edit_posts/' . $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No posts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
