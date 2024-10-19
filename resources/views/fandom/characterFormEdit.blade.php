@extends('app')
@section('title', 'Створити персонажа' )
@section('content')
@push('styles')
    <link href="{{ asset('css/characterForm.css') }}" rel="stylesheet">
@endpush 
<div class="content">
<h1>Змінити персонажа</h1>

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

<form method="POST"  action="{{ route('character.update', $character->id) }}">
    @csrf
    <input type="hidden" name="character_id" value="{{ $character->id }}"> <!-- ID персонажа -->
    
    <label for="name">Ім'я:</label>
    <input type="text" name="name" value="{{ old('name', $character->name) }}" required> 

    <label for="full-name">Повне ім'я:</label> 
    <input type="text" name="full-name" value="{{ old('full-name', $character->{'full-name'}) }}" required> 

    <label for="status">Статус:</label> 
    <input type="text" name="status" value="{{ old('status', $character->status) }}" required> 

    <label for="birth">Дата народження:</label> 
    <input type="text" name="birth" value="{{ old('birth', $character->birth) }}" required> 

    <label for="race">Раса:</label> 
    <input type="text" name="race" value="{{ old('race', $character->race) }}" required> 

    <label for="gender">Стать:</label> 
    <input type="text" name="gender" value="{{ old('gender', $character->gender) }}" required> 

    <label for="age">Вік:</label> 
    <input type="text" name="age" value="{{ old('age', $character->age) }}" required> 

    <label for="height">Зріст:</label> 
    <input type="text" name="height" value="{{ old('height', $character->height) }}" required> 

    <label for="hair">Колір волосся:</label> 
    <input type="text" name="hair" value="{{ old('hair', $character->hair) }}" required> 

    <label for="summary">Короткий опис:</label> 
    <textarea name="summary" required>{{ old('summary', $character->summary) }}</textarea> 

    <label for="biography">Біографія:</label> 
    <textarea name="biography" required>{{ old('biography', $character->biography) }}</textarea> 

    <label for="image">Зображення:</label> 
    <input type="text" name="image" value="{{ old('image', $character->image) }}" required> 

    <input type="submit" value="Оновити">
</form>


</div>
@endsection
