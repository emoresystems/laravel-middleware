@extends('layouts.app')

@section('content')
    <h1>{{ config('name')}}</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('blogs.create') }}" class="btn btn-primary mb-3">Create New Blog</a>

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $blog)
                <tr>
                    <td>{{ $blog->title }}</td>
                    <td>{{ Str::limit($blog->description, 50) }}</td>
                    <td>
                        @if ($blog->image_path)
                            <img src="{{ asset('storage/' . $blog->image_path) }}" alt="Blog Image" width="50">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this blog?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
