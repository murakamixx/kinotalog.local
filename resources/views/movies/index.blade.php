@extends('layouts.app')

@section('title', 'Кинокаталог')

@section('content')
    <div class="kp-page-header">
        <h1 class="kp-title">Кинокаталог</h1>
        <p class="kp-subtitle">Поиск, сортировка и фильтрация фильмов</p>
    </div>

    <section class="kp-filters">
        <form method="GET" action="{{ route('movies.index') }}" class="kp-filters-form">
            <input type="hidden" name="q" value="{{ request('q') }}">

            <div class="kp-filters-row">
                <div class="kp-field">
                    <label class="kp-label">Год</label>
                    <input
                        type="number"
                        name="year"
                        value="{{ request('year') }}"
                        class="kp-input"
                        placeholder="Например, 2024"
                    >
                </div>

                <div class="kp-field">
                    <label class="kp-label">Жанр</label>
                    <select name="genre" class="kp-input">
                        <option value="">Все жанры</option>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" @selected(request('genre') == $genre->id)>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="kp-field">
                    <label class="kp-label">Сортировка</label>
                    <select name="sort" class="kp-input">
                        <option value="newest" @selected(request('sort') === 'newest')>Новые сначала</option>
                        <option value="oldest" @selected(request('sort') === 'oldest')>Старые сначала</option>
                        <option value="year" @selected(request('sort') === 'year')>По году выпуска</option>
                        <option value="rating" @selected(request('sort') === 'rating')>По рейтингу</option>
                        <option value="popular" @selected(request('sort') === 'popular')>По популярности</option>
                    </select>
                </div>

                <div class="kp-field kp-field-submit">
                    <button type="submit" class="kp-button kp-button-primary">Применить</button>
                </div>
            </div>
        </form>
    </section>

    <section class="kp-movies-grid">
        @forelse($movies as $movie)
            <a href="{{ route('movies.show', $movie) }}" class="kp-movie-card">
                <div class="kp-movie-poster-wrapper">
                    @if($movie->poster_url)
                        <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="kp-movie-poster">
                    @else
                        <div class="kp-movie-poster kp-movie-poster-placeholder">
                            <span>{{ mb_substr($movie->title, 0, 1) }}</span>
                        </div>
                    @endif
                    <div class="kp-movie-badges">
                        @if($movie->release_year)
                            <span class="kp-badge">{{ $movie->release_year }}</span>
                        @endif
                        @if($movie->rating)
                            <span class="kp-badge kp-badge-rating">{{ number_format($movie->rating, 1) }}</span>
                        @endif
                    </div>
                </div>

                <div class="kp-movie-body">
                    <h2 class="kp-movie-title">{{ $movie->title }}</h2>
                    @if($movie->genres->isNotEmpty())
                        <div class="kp-movie-genres">
                            {{ $movie->genres_list }}
                        </div>
                    @endif
                    <p class="kp-movie-description">
                        {{ $movie->short_description }}
                    </p>
                    <div class="kp-movie-meta">
                        <span class="kp-meta-item">❤ {{ $movie->likes_count }}</span>
                        <span class="kp-meta-item">💬 {{ $movie->comments_count }}</span>
                        <span class="kp-meta-item">★ {{ $movie->favorites_count }}</span>
                    </div>
                </div>
            </a>
        @empty
            <div class="kp-empty">
                По вашему запросу ничего не найдено.
            </div>
        @endforelse
    </section>

    <div class="kp-pagination">
        {{ $movies->links() }}
    </div>
@endsection


