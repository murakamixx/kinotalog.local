<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorites';
    
    protected $fillable = [
        'user_id',
        'movie_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Пользователь, добавивший в избранное
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Фильм, добавленный в избранное
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    /**
     * Проверка, добавлял ли пользователь фильм в избранное
     */
    public function scopeByUserAndMovie($query, $userId, $movieId)
    {
        return $query->where('user_id', $userId)
                     ->where('movie_id', $movieId);
    }
}