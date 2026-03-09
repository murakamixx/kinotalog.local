@extends('layouts.app')

@section('title', 'Регистрация — Кинокаталог')

@section('content')
    <div class="kp-auth-card">
        <h1 class="kp-title">Регистрация</h1>

        <form method="POST" action="{{ route('register.post') }}" class="kp-form">
            @csrf

            <div class="kp-field">
                <label for="username" class="kp-label">Логин</label>
                <input
                    id="username"
                    type="text"
                    name="username"
                    class="kp-input @error('username') kp-input-error @enderror"
                    value="{{ old('username') }}"
                    required
                    autofocus
                >
                @error('username')
                    <div class="kp-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="kp-field">
                <label for="email" class="kp-label">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    class="kp-input @error('email') kp-input-error @enderror"
                    value="{{ old('email') }}"
                    required
                >
                @error('email')
                    <div class="kp-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="kp-field">
                <label for="password" class="kp-label">Пароль</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    class="kp-input @error('password') kp-input-error @enderror"
                    required
                >
                @error('password')
                    <div class="kp-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="kp-field">
                <label for="password_confirmation" class="kp-label">Повторите пароль</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    class="kp-input"
                    required
                >
            </div>

            <div class="kp-field">
                <button type="submit" class="kp-button kp-button-primary kp-button-block">
                    Создать аккаунт
                </button>
            </div>

            <p class="kp-muted kp-auth-switch">
                Уже есть аккаунт?
                <a href="{{ route('login') }}">Войти</a>
            </p>
        </form>
    </div>
@endsection


