@extends('app')
@section('title', 'Створити персонажа' )
@section('content')
@push('styles')
    <link href="{{ asset('css/characterForm.css') }}" rel="stylesheet">
@endpush 
<div class="content">
<h1>Видалити персонажа</h1>



<form method="POST"  action="{{ route('character.destroy', $character->id) }}">
    @csrf
   
    <input type="hidden" name="character_id" value="{{ $character->id }}"> <!-- ID персонажа -->
    
    <label for="name">Ім'я:</label>
    <input type="text" name="name" value="{{ old('name', $character->name) }}" required > 

    <label for="full-name">Повне ім'я:</label> 
    <input type="text" name="full-name" value="{{ old('full-name', $character->{'full-name'}) }}" required disabled> 

    <label for="status">Статус:</label> 
    <input type="text" name="status" value="{{ old('status', $character->status) }}" required disabled> 

    <label for="birth">Дата народження:</label> 
    <input type="text" name="birth" value="{{ old('birth', $character->birth) }}" required disabled> 

    <label for="race">Раса:</label> 
    <input type="text" name="race" value="{{ old('race', $character->race) }}" required disabled> 

    <label for="gender">Стать:</label> 
    <input type="text" name="gender" value="{{ old('gender', $character->gender) }}" required disabled> 

    <label for="age">Вік:</label> 
    <input type="text" name="age" value="{{ old('age', $character->age) }}" required disabled> 

    <label for="height">Зріст:</label> 
    <input type="text" name="height" value="{{ old('height', $character->height) }}" required disabled> 

    <label for="hair">Колір волосся:</label> 
    <input type="text" name="hair" value="{{ old('hair', $character->hair) }}" required disabled> 

    <label for="summary">Короткий опис:</label> 
    <textarea name="summary" required disabled>{{ old('summary', $character->summary) }}</textarea> 

    <label for="biography">Біографія:</label> 
    <textarea name="biography" required disabled>{{ old('biography', $character->biography) }}</textarea> 

    <label for="image">Зображення:</label> 
    <div class="image-container">                  
        <img src="{{ asset('images/character/' . $character['image']) }}" alt="{{ $character['name'] }}">
    </div>    

    <input type="submit" value="Видалити" > 
</form>



</div>
@endsection
