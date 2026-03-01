<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Movie extends Model
{
    protected $table = 'movies';
    
    protected $fillable = [
        'title',
        'description',
        'release_year',
        'director',
        'actors',
        'duration',
        'rating',
        'poster_url',
        'video_url',
        'created_by',
    ];

    protected $casts = [
        'release_year' => 'integer',
        'duration' => 'integer',
        'rating' => 'decimal:1',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Пользователь, который добавил фильм
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Жанры фильма
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movie_genres')
            ->withTimestamps();
    }

    /**
     * Лайки фильма
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Пользователи, которые лайкнули фильм
     */
    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'likes')
            ->withTimestamps()
            ->withPivot('created_at');
    }

    /**
     * Комментарии к фильму
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Активные комментарии (не удаленные)
     */
    public function activeComments()
    {
        return $this->hasMany(Comment::class)->where('is_deleted', false);
    }

    /**
     * Избранное фильма
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Пользователи, добавившие фильм в избранное
     */
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')
            ->withTimestamps()
            ->withPivot('created_at');
    }

    /**
     * Количество лайков
     */
    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    /**
     * Количество комментариев
     */
    public function getCommentsCountAttribute()
    {
        return $this->activeComments()->count();
    }

    /**
     * Количество добавлений в избранное
     */
    public function getFavoritesCountAttribute()
    {
        return $this->favorites()->count();
    }

    /**
     * Список жанров в виде строки
     */
    public function getGenresListAttribute()
    {
        return $this->genres->pluck('name')->implode(', ');
    }

    /**
     * Короткое описание
     */
    public function getShortDescriptionAttribute($length = 200)
    {
        return strlen($this->description) > $length 
            ? substr($this->description, 0, $length) . '...' 
            : $this->description;
    }

    /**
     * Проверка наличия жанра у фильма
     */
    public function hasGenre($genreId): bool
    {
        return $this->genres()->where('genre_id', $genreId)->exists();
    }

    /**
     * Добавить лайк от пользователя
     */
    public function addLike(User $user)
    {
        if (!$this->isLikedBy($user)) {
            return $this->likes()->create(['user_id' => $user->id]);
        }
        return false;
    }

    /**
     * Удалить лайк пользователя
     */
    public function removeLike(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->delete();
    }

    /**
     * Проверить, лайкнул ли пользователь фильм
     */
    public function isLikedBy(User $user): bool
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    /**
     * Добавить комментарий от пользователя
     */
    public function addComment(User $user, string $content)
    {
        return $this->comments()->create([
            'user_id' => $user->id,
            'content' => $content,
        ]);
    }

    /**
     * Поиск фильмов по названию, описанию, режиссеру, актерам
     */
    public function scopeSearch($query, string $term)
    {
        return $query->where(function (Builder $q) use ($term) {
            $q->where('title', 'LIKE', "%{$term}%")
              ->orWhere('description', 'LIKE', "%{$term}%")
              ->orWhere('director', 'LIKE', "%{$term}%")
              ->orWhere('actors', 'LIKE', "%{$term}%");
        });
    }

    /**
     * Фильтр по жанру
     */
    public function scopeOfGenre($query, $genreId)
    {
        return $query->whereHas('genres', function (Builder $q) use ($genreId) {
            $q->where('genres.id', $genreId);
        });
    }

    /**
     * Фильтр по году выпуска
     */
    public function scopeOfYear($query, $year)
    {
        return $query->where('release_year', $year);
    }

    /**
     * Фильтр по диапазону лет
     */
    public function scopeYearBetween($query, $startYear, $endYear)
    {
        return $query->whereBetween('release_year', [$startYear, $endYear]);
    }

    /**
     * Сортировка по новизне добавления
     */
    public function scopeNewest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Сортировка по старым записям
     */
    public function scopeOldest($query)
    {
        return $query->orderBy('created_at', 'asc');
    }

    /**
     * Сортировка по году выпуска (новые сначала)
     */
    public function scopeLatestYear($query)
    {
        return $query->orderBy('release_year', 'desc');
    }

    /**
     * Сортировка по рейтингу
     */
    public function scopeTopRated($query)
    {
        return $query->orderBy('rating', 'desc');
    }

    /**
     * Популярные фильмы (по количеству лайков)
     */
    public function scopePopular($query)
    {
        return $query->withCount('likes')->orderBy('likes_count', 'desc');
    }
}