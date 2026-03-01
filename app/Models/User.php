<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    
    protected $fillable = [
        'username',
        'email',
        'password_hash',
        'role',
        'is_banned',
        'last_login',
    ];

    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    protected $casts = [
        'is_banned' => 'boolean',
        'last_login' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Установка хеша пароля
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password_hash'] = Hash::make($password);
    }

    /**
     * Проверка пароля пользователя
     */
    public function validatePassword($password): bool
    {
        return Hash::check($password, $this->password_hash);
    }

    /**
     * Проверка, является ли пользователь администратором
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Проверка, забанен ли пользователь
     */
    public function isBanned(): bool
    {
        return (bool) $this->is_banned;
    }

    /**
     * Фильмы, созданные этим пользователем
     */
    public function createdMovies()
    {
        return $this->hasMany(Movie::class, 'created_by');
    }

    /**
     * Лайки пользователя
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Фильмы, которые лайкнул пользователь
     */
    public function likedMovies()
    {
        return $this->belongsToMany(Movie::class, 'likes')
            ->withTimestamps()
            ->withPivot('created_at');
    }

    /**
     * Комментарии пользователя
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Избранное пользователя
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Фильмы в избранном пользователя
     */
    public function favoriteMovies()
    {
        return $this->belongsToMany(Movie::class, 'favorites')
            ->withTimestamps()
            ->withPivot('created_at');
    }

    /**
     * Проверка, лайкнул ли пользователь фильм
     */
    public function hasLiked(Movie $movie): bool
    {
        return $this->likes()->where('movie_id', $movie->id)->exists();
    }

    /**
     * Проверка, добавил ли пользователь фильм в избранное
     */
    public function hasFavorited(Movie $movie): bool
    {
        return $this->favorites()->where('movie_id', $movie->id)->exists();
    }

    /**
     * Количество комментариев пользователя
     */
    public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
    }

    /**
     * Количество лайков пользователя
     */
    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    /**
     * Количество фильмов в избранном пользователя
     */
    public function getFavoritesCountAttribute()
    {
        return $this->favorites()->count();
    }

    /**
     * Выборка только активных пользователей (не забаненных)
     */
    public function scopeActive($query)
    {
        return $query->where('is_banned', false);
    }

    /**
     * Выборка только администраторов
     */
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    /**
     * Выборка только обычных пользователей
     */
    public function scopeUsers($query)
    {
        return $query->where('role', 'user');
    }
}