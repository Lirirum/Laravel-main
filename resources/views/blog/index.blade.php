@extends('app')

@section('title', 'Create New Post')

@section('content')
@push('styles')
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet">
@endpush 
<div class="content"> 
<h1 class="blog-title">All Published Posts</h1>

@if($posts->isEmpty())
    <div class="no-posts">No published posts available.</div>
@else
    <div class="posts-grid">
        @foreach($posts as $post)
            <div class="post-card">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="post-image">
                @else
                    <img src="{{ asset('images/blog/default.jpg') }}" alt="Default Image" class="post-image">
                @endif

                <div class="post-content">
                    <h3 class="post-title">{{ $post->title }}</h3>
                    <p class="post-text">{{ Str::limit($post->text, 120) }}</p>

                    <div class="post-meta">
                        <div class="author-info">
                            @if($post->user->profile_image)
                                <img src="{{asset('storage/' . $post->user->profile_image) }}" alt="{{ $post->user->name }}" class="author-image">
                            @else
                                <img src="{{asset('images/blog/anon.jpg') }}" alt="Anonymous" class="author-image">
                            @endif
                            <span class="author-name">{{ $post->user->name }}</span>
                        </div>
                        <span class="post-date">{{ $post->created_at->diffForHumans() }}</span>
                    </div>

                    @if(Auth::id() === $post->user_id)
                        <div class="post-actions">
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-edit">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="delete-form" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endif
</div>
@endsection
