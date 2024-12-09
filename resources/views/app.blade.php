<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Laravel App')</title>
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">      
    @vite('resources/css/app.css')
    @stack('styles')
</head>
<body>
    <div class="wrapper">
    @include('partials.navbar')
    <div class="main">
        @yield('content')
    </div>   
        <footer >
            <p>&copy; 2024 My Website. All Rights Reserved.</p>
        </footer>
    </div>

</body>
</html>
