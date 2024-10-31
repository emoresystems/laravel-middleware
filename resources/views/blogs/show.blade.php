@extends('layouts.app')

@section('content')
    <h1>{{ $blog->title }}</h1>

    <p>{{ $blog->description }}</p>

    @if ($blog->image_path)
        <img src="{{ asset('storage/' . $blog->image_path) }}" alt="Blog Image" class="img-fluid">
    @endif

    <div class="mt-3">
        <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Back to Blogs</a>
        <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this blog?')">Delete</button>
        </form>
    </div>
@endsection
