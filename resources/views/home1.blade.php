@extends('layouts.mainlayout')

@section('title', '- HOME')

@section('heading')
    Welcome to MyBlog
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="p-5 mb-4 bg-light rounded-3 shadow-sm">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Explore Inspiring Stories</h1>
            <p class="col-md-8 fs-4">Your go-to place for tech tips, news, and engaging articles from our creative writers.</p>
            <a class="btn btn-primary btn-lg" href="/posts">Start Reading</a>
        </div>
    </div>

    <!-- About Section -->
    <div class="row text-center mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Quality Content</h5>
                    <p class="card-text">We provide well-researched, insightful posts tailored to your interests.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-4 mt-md-0">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Categories</h5>
                    <p class="card-text">Browse through categories like Technology, Education, Travel, and more.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-4 mt-md-0">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Join the Conversation</h5>
                    <p class="card-text">Leave comments, like posts, and be part of a growing community.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="text-center my-5">
        <h2>Ready to Dive In?</h2>
        <p>Start exploring posts or check out trending categories now.</p>
        <a href="/posts" class="btn btn-outline-primary">View Posts</a>
       
    </div>
@endsection
