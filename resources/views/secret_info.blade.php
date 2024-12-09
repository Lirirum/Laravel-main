@extends('app')

@section('title', 'Home Page')
@push('styles')
    <link href="{{ asset('css/info.css') }}" rel="stylesheet">
@section('content')
    <h1 >Welcome to the Secret Info Page</h1>
    <p >Тут міститься дуже секрета інформація. </p>
    <div class="image-container">
        <img  src="{{asset('images/secret/fractal001.jpg')}}"> 
    </div>
@endsection
