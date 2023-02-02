<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JS Explorer</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="/css/user-styles.css">
    <link rel="stylesheet" href="/css/course-tags.css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   JS Explorer
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Strona Główna</a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Zaloguj się</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Zarejestruj się</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/home') }}">Kokpit</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/mycourses') }}">Moje Kursy</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/comments') }}">Opinie</a>
                            </li>
                            @if(Auth::user()->role_id == 3)
                            <li class="nav-item">
                                <a class="nav-link admin-link" href="{{ url('/admin') }}">Admin</a>
                            </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('myprofile') }}">Ustawienia</a>
                                    <a class="dropdown-item logout" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        Wyloguj się
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="/js/footer_loader.js"></script>
    <style>
        footer {
            position: fixed;
            z-index: 10;
            bottom: 0;
            left: 0;
            right: 0;
            display: grid;
            grid-auto-flow: column;
            place-items: center;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            color: #ffffff;
            height: fit-content;
            background: linear-gradient(0deg, rgba(52, 58, 64, 0.9), rgba(52, 58, 64, 0.7));
            box-shadow: 0 -0.5rem 0.2rem 0.2rem rgba(52, 58, 64, 0.7);
        }
        footer > span {padding: 0 0 0.5rem 0;}
        #bottom-redux {
            display: block;
            height: 3rem;
        }
        @media screen and (max-width: 720px) {
            footer {
                font-size: 0.9rem;
                box-shadow: 0 -0.33rem 0.15rem 0.15rem rgba(52, 58, 64, 0.7);
            }
            footer > span {padding: 0 0 0.33rem 0;}
        }
        @media screen and (max-width: 384px) {
            footer {
                font-size: 0.75rem;
                box-shadow: 0 -0.25rem 0.1rem 0.1rem rgba(52, 58, 64, 0.7);
            }
            footer > span {padding: 0 0 0.25rem 0;}
        }
    </style>
</body>
<!-- Footer -->
<div id="bottom-redux"></div>
<footer></footer>
</html>
