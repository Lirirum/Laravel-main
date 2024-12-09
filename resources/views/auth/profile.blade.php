@extends('app')

@section('title', 'Профіль користувача')
@push('styles')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endpush 
@section('content')
    <div class="content">
        <div class="profile-card">
            <div class="profile-image-container">
                @if($user->profile_image)
                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="profile-image">
                @else
                    <img src="{{ asset('images/blog/anon.jpg') }}" alt="Default Profile" class="profile-image">
                @endif
            </div>
            <div class="profile-details">
                <h2 class="profile-name">{{ $user->name }}</h2>
                <p class="profile-email">{{ $user->email }}</p>
                <a href="{{route('profile.edit')}}" class="edit-profile-button">Edit Profile</a>
            </div>
        </div>
    </div>
@endsection
 