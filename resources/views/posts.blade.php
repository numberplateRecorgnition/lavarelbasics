@extends('layouts.mainlayout')
@section('title', '-POST')
@section('content')

<div class="container mt-5">
    <h1 class="mb-4">All Posts</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($posts->isEmpty())
        <p>No posts found.</p>
    @else
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        @if($post->photo)
                            <img src="{{ asset('storage/' . str_replace('public/', '', $post->photo)) }}" class="card-img-top" alt="Post Image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->body }}</p>
                        </div>
                        <div class="card-footer text-muted">
                            Posted by: <strong>{{ $post->user->name ?? 'Unknown' }}</strong> <br>
                            Category: <strong>{{ $post->category->name ?? 'Uncategorized' }}</strong>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
