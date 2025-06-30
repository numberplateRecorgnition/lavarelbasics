<?php
    use App\Models\Category;
?>
@extends('layouts.mainlayout')

@section('title','Categories')

@section('content')

<div class="container mt-4">
    <h2 class="mb-4">Welcome Categories</h2>

    <!-- Search Form -->
    <form method="GET" action="{{ url('/categories') }}" class="row g-3 mb-4">
        <div class="col-md-8">
            <input type="text" name="search" class="form-control" placeholder="Search category..." value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary w-100">Search</button>
        </div>
    </form>

    @php
        $search = request('search');
        $list = $search
            ? Category::where('name', 'like', "%$search%")->get()
            : Category::all();
    @endphp

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Name</th>
                    <th style="width: 150px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($list as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>
                            <a href="{{ url('/categories/'.$item->id.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ url('/categories/'.$item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


@endsection
