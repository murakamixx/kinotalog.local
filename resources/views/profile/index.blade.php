@extends('layouts.app')

@section('title', 'Личный кабинет — Кинокаталог')

@section('content')
    <div class="kp-page-header">
        <h1 class="kp-title">Личный кабинет</h1>
        <p class="kp-subtitle">Ваш профиль и активность</p>
    </div>

    <div class="kp-profile-grid">
        <section class="kp-card">
            <h2 class="kp-section-title">Профиль</h2>
            <p><strong>Логин:</strong> {{ $user->username }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Роль:</strong> {{ $user->role === 'admin' ? 'Администратор' : 'Пользователь' }}</p>
            <p><strong>Последний вход:</strong> {{ $user->last_login?->format('d.m.Y H:i') ?? '—' }}</p>
        </section>

        <section class="kp-card">
            <h2 class="kp-section-title">Статистика</h2>
            <p><strong>Лайков:</strong> {{ $user->likes_count }}</p>
            <p><strong>Комментариев:</strong> {{ $user->comments_count }}</p>
            <p><strong>В избранном:</strong> {{ $user->favorites_count }}</p>
        </section>
    </div>

    <section class="kp-card">
        <h2 class="kp-section-title">Избранные фильмы</h2>
        <div class="kp-movies-grid kp-movies-grid-sm">
            @forelse($user->favoriteMovies as $movie)
                <a href="{{ route('movies.show', $movie) }}" class="kp-movie-card">
                    <div class="kp-movie-poster-wrapper">
                        @if($movie->poster_url)
                            <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="kp-movie-poster">
                        @else
                            <div class="kp-movie-poster kp-movie-poster-placeholder">
                                <span>{{ mb_substr($movie->title, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="kp-movie-body">
                        <h3 class="kp-movie-title">{{ $movie->title }}</h3>
                        <p class="kp-movie-description">{{ $movie->short_description }}</p>
                    </div>
                </a>
            @empty
                <div class="kp-empty">
                    У вас пока нет фильмов в избранном.
                </div>
            @endforelse
        </div>
    </section>
@endsection


