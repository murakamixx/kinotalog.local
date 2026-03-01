<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genres';
    
    protected $fillable = ['name'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Фильмы этого жанра
     */
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_genres')
            ->withTimestamps();
    }

    /**
     * Количество фильмов в жанре
     */
    public function getMoviesCountAttribute()
    {
        return $this->movies()->count();
    }

    /**
     * Поиск жанров по названию
     */
    public function scopeSearch($query, string $term)
    {
        return $query->where('name', 'LIKE', "%{$term}%");
    }

    /**
     * Самые популярные жанры (с наибольшим количеством фильмов)
     */
    public function scopeMostPopular($query)
    {
        return $query->withCount('movies')->orderBy('movies_count', 'desc');
    }
}