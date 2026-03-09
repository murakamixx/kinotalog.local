@extends('layouts.app')

@section('title', 'Админ-панель — Кинокаталог')

@section('content')
    <div class="kp-page-header">
        <h1 class="kp-title">Админ-панель</h1>
        <p class="kp-subtitle">Управление кинокаталогом</p>
    </div>

    <div class="kp-profile-grid">
        <section class="kp-card">
            <h2 class="kp-section-title">Статистика</h2>
            <p><strong>Фильмов:</strong> {{ $moviesCount }}</p>
            <p><strong>Пользователей:</strong> {{ $usersCount }}</p>
        </section>

        <section class="kp-card">
            <h2 class="kp-section-title">Действия</h2>
            <a href="{{ route('admin.movies.index') }}" class="kp-button kp-button-primary">
                Управление фильмами
            </a>
        </section>
    </div>
@endsection


