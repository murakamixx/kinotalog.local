<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Кинокаталог')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="kp-body">
    <header class="kp-header">
        <div class="kp-container kp-header-inner">
            <a href="{{ route('movies.index') }}" class="kp-logo">
                <span class="kp-logo-main">Kino</span><span class="kp-logo-accent">Catalog</span>
            </a>

            <form action="{{ route('movies.index') }}" method="GET" class="kp-search">
                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Фильмы, сериалы, персоны"
                    class="kp-input kp-input-search"
                >
            </form>

            <nav class="kp-nav">
                @auth
                    <a href="{{ route('profile.index') }}" class="kp-nav-link">
                        {{ auth()->user()->username }}
                    </a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="kp-nav-link">Админ</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="kp-inline-form">
                        @csrf
                        <button type="submit" class="kp-button kp-button-ghost">Выйти</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="kp-nav-link">Войти</a>
                    <a href="{{ route('register') }}" class="kp-button kp-button-primary">Регистрация</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="kp-main">
        <div class="kp-container">
            @if (session('status'))
                <div class="kp-alert kp-alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</body>
</html>


