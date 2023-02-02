<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container px-5">
        <a class="navbar-brand" href="{{ url('/') }}">JS Explorer</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0" id="navlinks">
                <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Główna</a></li>
                <li class="nav-item"><a href="{{ url('/comments') }}" class="nav-link">Opinie</a></li>
                @if (Route::has('login'))
                @auth
                    <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link">Mój Profil</a></li>
                @else
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Zaloguj się</a></li>

                    @if (Route::has('register'))
                    <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Zarejestruj się</a></li>
                    @endif
                @endauth
                @endif
                <li class="nav-item"><a href="{{ url('/about') }}" class="nav-link">O nas...</a></li>
                <li class="nav-item"><a href="{{ url('/contact') }}" class="nav-link">Kontakt</a></li>
            </ul>
        </div>
    </div>
</nav>