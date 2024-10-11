<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel App')</title>
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">  
    @stack('styles')
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="wrapper">
    @include('partials.navbar')
    <div class="main">
        @yield('content')
    </div>   
    <footer class="bg-gray-800 text-white p-4 text-center">
        <p>&copy; 2024 My Website. All Rights Reserved.</p>
    </footer>
    </div>
</body>
</html>
