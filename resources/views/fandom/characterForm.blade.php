@extends('app')
@section('title', 'Створити персонажа' )
@section('content')
@push('styles')
    <link href="{{ asset('css/characterForm.css') }}" rel="stylesheet">
@endpush 
<div class="content">
<h1>Створити персонажа</h1>

@if ($errors->any())
    <div>
        <strong>Помилки при заповненні форми:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('characterPost') }}" method="POST">
    @csrf
    <label for="name">Ім'я:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="full-name">Повне ім'я:</label>
    <input type="text" id="full-name" name="full-name" required><br><br>

    <label for="status">Статус:</label>
    <input type="text" id="status" name="status" required><br><br>

    <label for="birth">Дата народження:</label>
    <input type="text" id="birth" name="birth" required><br><br>

    <label for="race">Раса:</label>
    <input type="text" id="race" name="race" required><br><br>

    <label for="gender">Стать:</label>
    <input type="text" id="gender" name="gender" required><br><br>

    <label for="age">Вік:</label>
    <input type="text" id="age" name="age" required><br><br>

    <label for="height">Зріст:</label>
    <input type="text" id="height" name="height" required><br><br>

    <label for="hair">Колір волосся:</label>
    <input type="text" id="hair" name="hair" required><br><br>

    <label for="summary">Короткий опис:</label>
    <textarea id="summary" name="summary" required></textarea><br><br>

    <label for="biography">Біографія:</label>
    <textarea id="biography" name="biography" required></textarea><br><br>

    <label for="image">Зображення персонажа:</label>
    <input type="text" id="image" name="image" required><br><br>

    <label for="abilities">Здібності (через кому):</label>
    <input type="text" id="abilities" name="abilities"required><br><br>

    <label for="images">Зображення персонажа (через кому):</label>
    <input type="text" id="images" name="images"  required><br><br>
    
    <button type="submit">Створити персонажа</button>
</form>
</div>
@endsection
