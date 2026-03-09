@extends('layouts.app')

@section('title', $movie->title . ' — Кинокаталог')

@section('content')
    <div class="kp-movie-page">
        <div class="kp-movie-hero">
            <div class="kp-movie-hero-poster">
                @if($movie->poster_url)
                    <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="kp-movie-poster-lg">
                @else
                    <div class="kp-movie-poster-lg kp-movie-poster-placeholder">
                        <span>{{ mb_substr($movie->title, 0, 1) }}</span>
                    </div>
                @endif
            </div>

            <div class="kp-movie-hero-info">
                <h1 class="kp-title">{{ $movie->title }}</h1>

                <div class="kp-movie-hero-meta">
                    @if($movie->release_year)
                        <span class="kp-meta-chip">{{ $movie->release_year }}</span>
                    @endif
                    @if($movie->duration)
                        <span class="kp-meta-chip">{{ $movie->duration }} мин</span>
                    @endif
                    @if($movie->rating)
                        <span class="kp-meta-chip kp-meta-chip-rating">
                            Рейтинг: {{ number_format($movie->rating, 1) }}
                        </span>
                    @endif
                </div>

                @if($movie->genres->isNotEmpty())
                    <div class="kp-movie-hero-genres">
                        {{ $movie->genres_list }}
                    </div>
                @endif

                <p class="kp-movie-hero-description">
                    {{ $movie->description }}
                </p>

                <div class="kp-movie-hero-actions">
                    @auth
                        <form action="{{ route('movies.like', $movie) }}" method="POST" class="kp-inline-form">
                            @csrf
                            <button type="submit" class="kp-button kp-button-ghost">
                                ❤
                                @if(auth()->user()->hasLiked($movie))
                                    Удалить лайк
                                @else
                                    Лайкнуть
                                @endif
                                ({{ $movie->likes_count }})
                            </button>
                        </form>

                        <form action="{{ route('movies.favorite', $movie) }}" method="POST" class="kp-inline-form">
                            @csrf
                            <button type="submit" class="kp-button kp-button-ghost">
                                ★
                                @if(auth()->user()->hasFavorited($movie))
                                    Удалить из избранного
                                @else
                                    В избранное
                                @endif
                                ({{ $movie->favorites_count }})
                            </button>
                        </form>
                    @else
                        <div class="kp-muted">
                            Чтобы лайкать и добавлять в избранное, <a href="{{ route('login') }}">войдите</a>.
                        </div>
                    @endauth
                </div>
            </div>
        </div>

        <section class="kp-comments">
            <h2 class="kp-section-title">Комментарии ({{ $movie->comments_count }})</h2>

            @auth
                <form action="#" method="POST" class="kp-comment-form">
                    <div class="kp-field">
                        <label class="kp-label">Оставить комментарий</label>
                        <textarea
                            class="kp-input kp-textarea"
                            name="content"
                            rows="3"
                            placeholder="Что вы думаете об этом фильме?"
                            disabled
                        ></textarea>
                        <p class="kp-muted">
                            Для краткости сейчас форма комментариев не реализована полностью
                            (в контроллере нет метода). Её легко добавить через MovieController::addComment.
                        </p>
                    </div>
                </form>
            @endauth

            <div class="kp-comments-list">
                @forelse($movie->activeComments as $comment)
                    <div class="kp-comment">
                        <div class="kp-comment-header">
                            <span class="kp-comment-author">{{ $comment->user->username }}</span>
                            <span class="kp-comment-date">
                                {{ $comment->created_at?->format('d.m.Y H:i') }}
                            </span>
                        </div>
                        <p class="kp-comment-body">{{ $comment->content }}</p>
                    </div>
                @empty
                    <div class="kp-empty">
                        Комментариев пока нет.
                    </div>
                @endforelse
            </div>
        </section>
    </div>
@endsection


