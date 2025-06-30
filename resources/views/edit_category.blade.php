@extends('layouts.mainlayout')

@section('title', 'Edit Category')

@section('content')

<div class="container mt-5">
    <h2>Edit Category</h2>

    <form method="POST" action="{{ url('/categories/' . $category->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" id="name" value="{{ $category->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="details" class="form-label">Details</label>
            <textarea name="details" id="details" class="form-control" rows="3" required>{{ $category->details }}</textarea>
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Change Photo (optional)</label>
            <input type="file" name="photo" id="photo" class="form-control">
            @if($category->photo)
                <p class="mt-2"><strong>Current Photo:</strong></p>
                <img src="{{ asset(str_replace('public/', 'storage/', $category->photo)) }}" alt="Photo" class="img-thumbnail" style="max-width: 200px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
        <a href="{{ url('/categories') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection
