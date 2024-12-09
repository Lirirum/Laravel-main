@extends('app')

@section('title', 'Реєстрація')
@push('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endpush 
@section('content')
    <div class="h-screen  flex flex-col space-y-10 justify-center items-center">
        <div class="bg-white w-96 shadow-xl rounded p-5 form-container">
            <h1 class="text-3xl font-medium">Реєстрація</h1>

            <form action="{{ route('register_process') }}" class="space-y-5 mt-5" method="POST">
                @csrf

                <input name="name" type="text" class="w-full h-12 border border-gray-800 rounded px-3 @error('name') border-red-500 @enderror" placeholder="Ім'я" />

                @error('name')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="email" type="text" class="w-full h-12 border border-gray-800 rounded px-3 @error('email') border-red-500 @enderror" placeholder="Email" />

                @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="password" type="password" class="w-full h-12 border border-gray-800 rounded px-3 @error('password') border-red-500 @enderror" placeholder="Пароль" />

                @error('password')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="password_confirmation" type="password" class="w-full h-12 border border-gray-800 rounded px-3 @error('password_confirmation') border-red-500 @enderror" placeholder="Підтверждення пароля" />

                @error('password_confirmation')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <label class="input-file">
                    <span class="input-file-text" for="image">Image (max 2 MB)</span>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                    <span class="input-file-btn">Оберіть файл</span>
                </label>
                <div>
                    <a href="{{ route('login') }}" class="font-medium text-blue-900 hover:bg-blue-300 rounded-md p-2">Вже є акаунт?</a>
                </div>

                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Зареєструватися</button>
            </form>
        </div>
    </div>
@endsection
 
