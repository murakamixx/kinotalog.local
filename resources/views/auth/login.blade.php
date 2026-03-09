@extends('layouts.app')

@section('title', 'Вход — Кинокаталог')

@section('content')
    <div class="kp-auth-card">
        <h1 class="kp-title">Вход</h1>

        <form method="POST" action="{{ route('login.post') }}" class="kp-form">
            @csrf

            <div class="kp-field">
                <label for="email" class="kp-label">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    class="kp-input @error('email') kp-input-error @enderror"
                    value="{{ old('email') }}"
                    required
                    autofocus
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

            <div class="kp-field kp-field-inline">
                <label class="kp-checkbox">
                    <input type="checkbox" name="remember">
                    <span>Запомнить меня</span>
                </label>
            </div>

            <div class="kp-field">
                <button type="submit" class="kp-button kp-button-primary kp-button-block">
                    Войти
                </button>
            </div>

            <p class="kp-muted kp-auth-switch">
                Нет аккаунта?
                <a href="{{ route('register') }}">Зарегистрироваться</a>
            </p>
        </form>
    </div>
@endsection


