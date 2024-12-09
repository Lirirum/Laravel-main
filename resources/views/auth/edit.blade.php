@extends('app')

@section('title', 'Edit Profile')

@section('content')
@push('styles')
    <link href="{{ asset('css/editProfile.css') }}" rel="stylesheet">
@endpush 
<div class="content"> 
<div class="profile-card">
        <h2>Edit Profile</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="profile_image">Profile Image</label>
                <input type="file" id="profile_image" name="profile_image" accept="image/*">
                @if ($user->profile_image)
                    <p>Current Image:</p>
                    <div class="image-container">
                        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="profile-image">
                    </div>
                @endif
            </div>

            <button type="submit" class="edit-profile-button">Save Changes</button>
        </form>
    </div>
</div> 
@endsection
