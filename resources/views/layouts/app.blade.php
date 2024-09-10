<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ATC') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold fs-2" href="{{ url('/') }}">
                    {{ config('app.name', 'ATC') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link categories" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categories
                            </a>
                            <div class="dropdown-menu" aria-labelledby="categoriesDropdown">
                                <a class="dropdown-item" href="{{ route('categories.ict') }}"><span class="d-flex justify-content-between position-relative align-items-center">ICT <span class="ml-4"><i class="fa fa-chevron-right" aria-hidden="true"></i></span></span></a>
                                <a class="dropdown-item" href="#"><span class="d-flex justify-content-between position-relative align-items-center">Mechanical <span class="ml-4"><i class="fa fa-chevron-right" aria-hidden="true"></i></span></span></a>
                                <a class="dropdown-item" href="#"><span class="d-flex justify-content-between position-relative align-items-center">Civil <span class="ml-4"><i class="fa fa-chevron-right" aria-hidden="true"></i></span></span></a>
                                <a class="dropdown-item" style="width: 250px;" href="#"><span class="d-flex justify-content-between position-relative align-items-center"><span class="mr-5">Electrical and Biomedical</span> <span class="ml-4"><i class="fa fa-chevron-right" aria-hidden="true"></i></span></span></a>
                                <a class="dropdown-item" href="#"><span class="d-flex justify-content-between position-relative align-items-center">Laboratory Technology <span class="ml-4"><i class="fa fa-chevron-right" aria-hidden="true"></i></span></span></a>
                                <a class="dropdown-item" href="#"><span class="d-flex justify-content-between position-relative align-items-center">Automotive <span class="ml-4"><i class="fa fa-chevron-right" aria-hidden="true"></i></span></span></a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categories.ict') }}" class="nav-link link">ICT</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link link">Mechanical</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link link">Civil</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link link">Electrical and Biomedical</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link link">Laboratory Technology</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link link">Automotive</a>
                        </li>
                        <li class="nav-item flex-grow-1 mx-lg-2 my-2 my-lg-0">
                            <div class="position-relative">
                                <span class="position-absolute top-50 start-0 translate-middle-y ms-3">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" name="search" id="search" class="form-control ps-5" placeholder="Search for courses" style="border-radius: 25px;">
                            </div>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Teach at ATC</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cart') }}" class="nav-link">
                                <i class="fas fa-shopping-cart text-success"></i>
                            </a>
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item mt-2 mt-lg-0">
                                    <a class="btn btn-outline-secondary border-1 rounded-0 border-secondary w-100" href="{{ route('login') }}">{{ __('Log in') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item mt-2 mt-lg-0 ms-lg-2">
                                    <a class="btn btn-success border-1 rounded-0 w-100" href="{{ route('register') }}">{{ __('Sign up') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
    var dropdown = document.querySelector('.dropdown');
    var dropdownMenu = dropdown.querySelector('.dropdown-menu');
    var timeoutId;

    dropdown.addEventListener('mouseenter', function() {
        clearTimeout(timeoutId);
        dropdownMenu.style.display = 'block';
    });

    dropdown.addEventListener('mouseleave', function() {
        timeoutId = setTimeout(function() {
            dropdownMenu.style.display = 'none';
        }, 2000); // 2000 milliseconds = 2 seconds
    });

    dropdownMenu.addEventListener('mouseenter', function() {
        clearTimeout(timeoutId);
    });

    dropdownMenu.addEventListener('mouseleave', function() {
        timeoutId = setTimeout(function() {
            dropdownMenu.style.display = 'none';
        }, 200); // 2000 milliseconds = 2 seconds
    });
});
    </script>
</body>
</html>
