<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog - @yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand text-white" href="/">MyBlog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">
         <li class="nav-item">
            <a class="nav-link text-white" href="/home1">Homepage</a>
        </li>
       
        <li class="nav-item">
            <a class="nav-link text-white" href="/posts">Posts</a>
        </li>

        @guest
            
            <li class="nav-item">
                <a href="/login" class="nav-link text-white">Login</a>
            </li>
           
        @endguest

        @auth
                            <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/categories') }}">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/edit_posts') }}">Edit Posts</a>
                </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="/adminPanel">Admin Panel</a>
            </li>
            <li class="nav-item">
                <a href="/register" class="nav-link text-white">Register</a>
            </li>

            <li class="nav-item">
                <span class="nav-link fw-bold text-warning">
                    Hi Admin, {{ Auth::user()->name }}
                </span>
            </li>

            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm mt-1">Logout</button>
                </form>
            </li>
        @endauth
    </ul>
</div>

    </nav>

    <!-- Page Heading -->
    <div class="container mt-4">
        <h2 class="mb-4">@yield('heading')</h2>

        <!-- Main Content -->
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} MyBlog. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
