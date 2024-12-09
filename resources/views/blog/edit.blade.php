@extends('app')

@section('title', 'Edit Post')

@section('content')
@push('styles')
    <link href="{{ asset('css/editPost.css') }}" rel="stylesheet">
@endpush 
<div class="content">
<h1>Edit Post</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="edit-post-form">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required>
    </div>

    <div class="form-group">
        <label for="text">Content</label>
        <textarea id="text" name="text" rows="6" required>{{ old('text', $post->text) }}</textarea>
    </div>

    <div class="form-group">
        <label for="image">Post Image</label>
    

        <label class="input-file">
                <span class="input-file-text" for="image">Image (max 2 MB)</span>
                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                <span class="input-file-btn">Оберіть файл</span>
        </label>

        @if ($post->image)
            <div class="current-image">
                <p>Current Image:</p>
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image">
            </div>
        @endif
    </div>

    <div class="form-buttons">
        <button type="submit" class="save-button">Save Changes</button>
        <a href="{{ route('posts.index') }}" class="cancel-button">Cancel</a>
    </div>
</form>
</div>
@endsection
