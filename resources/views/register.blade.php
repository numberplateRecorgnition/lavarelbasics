@extends('layouts.mainlayout')

@section('title', '- HOME')

@section('heading')
    Welcome to MyBlog
@endsection

@section('content')
    <h1>Register</h1>
    <form method="POST" action="{{ url('/register') }}">
    @csrf

    {{-- Show Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password" required>
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
    </div>

    <button type="submit" class="btn btn-primary">Register</button>

    <p class="mt-3">
        Already have an account? 
        <a href="{{ url('/login') }}">Login here</a>.
    </p>
</form>

@endsection
