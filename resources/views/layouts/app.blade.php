<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Shop') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
        <div class="container-xl">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Shop') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link ml-auto" href="#"><i class="bi bi-x-diamond"></i> Каталог</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    @csrf
                    <input class="form-control mr-sm-2" type="search" placeholder="Что будем искать?" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Найти</button>
                </form>
                <ul class="navbar-nav ml-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="bi bi-person"></i>
                                {{ Auth::user()->first_name . " " . Auth::user()->last_name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('main') }}">Кабинет</a>
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
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-cart"></i> Корзина</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <div class="container-xl">
        <div class="row">

         <!--   <aside class="col-lg-3 col-md-4 pr-md-0">
                <div class="card">
                    <div class="card-body">
                    @if (Route::is('main'))
                        Привет, юзер
                    @else
                        Категория 1
                        <br>
                        Категория 2
                    @endif
                    </div>
                </div>
                <br>
                <div class="card">
                    ExampleShop 2021
                </div>
            </aside>

            <main class="col-lg-9 col-md-8 /*pl-md-0*/">

            </main> -->

            @yield('aside')
            @yield('content')
        </div>

    </div>
    @yield('scripts')
</body>
</html>
