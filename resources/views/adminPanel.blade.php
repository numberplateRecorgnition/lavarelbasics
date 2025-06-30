@extends('layouts.mainlayout')

@section('title','Admin Panel')

@section('content')

<style>
    body, html {
        height: 100%;
        margin: 0;
    }

    .wrapper {
        display: flex;
        min-height: 100vh;
        flex-direction: row;
        background: 
    }

    .sidebar {
        width: 250px;
        background-color: #0d6efd;
        color: white;
        padding-top: 20px;
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 1000;
    }

    .sidebar .list-group-item {
        background-color: #0d6efd;
        color: white;
        border: none;
    }

    .sidebar .list-group-item:hover {
        background-color: #0b5ed7;
    }

    .main-content {
        margin-left: 250px;
        padding: 30px;
        flex: 1;
    }

    section:target {
        scroll-margin-top: 80px;
    }

    footer {
        position: fixed;
        bottom: 0;
        left: 250px;
        width: calc(100% - 250px);
        background-color: #a5a7a8;
        text-align: center;
        padding: 10px 0;
        border-top: 1px solid #dee2e6;
    }
</style>

<div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar">
        <h5 class="text-center mb-4">Admin Menu</h5>
        <div class="list-group">
            <a href="#add-category" class="list-group-item list-group-item-action">Add Category</a>
            <a href="#add-post" class="list-group-item list-group-item-action">Add Post</a>
            
            

        </div>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <!-- Add Category -->
        <section id="add-category" class="mb-5">
            <div class="card">
                <div class="card-header bg-primary text-white">Add New Category</div>
                <div class="card-body">
                    <form method="POST" action="/categories" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="details" class="form-label">Details</label>
                            <textarea name="details" id="details" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" name="photo" id="photo" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Save Category</button>
                    </form>
                </div>
            </div>
        </section>
        @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


        <!-- Add Post -->
<section id="add-post" class="mb-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"> Add New Post</h5>
        </div>
        <div class="card-body bg-light">
            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Post Title -->
                <div class="mb-4">
                    <label for="title" class="form-label fw-semibold">Post Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" placeholder="Enter post title..." required>
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Post Body -->
                <div class="mb-4">
                    <label for="body" class="form-label fw-semibold">Post Body</label>
                    <textarea name="body" id="body" class="form-control" rows="4" placeholder="Write your post content..." required>{{ old('body') }}</textarea>
                    @error('body')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Upload Photo -->
                <div class="mb-4">
                    <label for="photo" class="form-label fw-semibold">Attach Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                    @error('photo')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Select User -->
                <div class="mb-4">
                    <label for="user_id" class="form-label fw-semibold">Post Author</label>
                    <select name="user_id" id="user_id" class="form-select" required>
                        <option value="">-- Select User --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Select Category -->
                <div class="mb-4">
                    <label for="category_id" class="form-label fw-semibold">Category</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-upload me-1"></i> Publish Post
                    </button>
                </div>
            </form>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
</section>


        

<!-- Footer -->
<footer>
    <p class="mb-0">&copy; {{ date('Y') }} MyBlog. All rights reserved.</p>
</footer>

<!-- Smooth scroll -->
<script>
    document.querySelectorAll('.list-group-item').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            const yOffset = -70;
            const y = target.getBoundingClientRect().top + window.pageYOffset + yOffset;
            window.scrollTo({ top: y, behavior: 'smooth' });
        });
    });
</script>

@endsection
