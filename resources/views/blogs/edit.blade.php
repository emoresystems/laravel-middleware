@extends('layouts.app')

@section('content')
    <h1>Edit Blog</h1>

    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $blog->title }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="5" required>{{ $blog->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            @if ($blog->image_path)
                <img src="{{ asset('storage/' . $blog->image_path) }}" alt="Current Blog Image" width="100" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Blog</button>
    </form>
@endsection
