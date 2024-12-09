@extends('app')

@section('title', 'Create New Post')

@section('content')
@push('styles')
    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
@endpush 
<div class="content"> 
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1>Create New Post</h1>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="text">Текст</label>          
            <textarea id="text" name="text" class="form-control @error('content') is-invalid @enderror"  required>{{ old('text') }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="input-file">
                <span class="input-file-text" for="image">Image (max 2 MB)</span>
                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                <span class="input-file-btn">Оберіть файл</span>
            </label>
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>



        <button type="submit" >Опублікувати</button>
        <a href="{{ route('posts.index') }}" class="font-medium text-blue-900 hover:bg-blue-300 rounded-md p-2">Back to Posts</a> 
    </form>
</div> 
@endsection
