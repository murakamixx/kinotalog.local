<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    
    protected $fillable = [
        'user_id',
        'movie_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Пользователь, который поставил лайк
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Фильм, которому поставили лайк
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    /**
     * Проверка, ставил ли пользователь лайк фильму
     */
    public function scopeByUserAndMovie($query, $userId, $movieId)
    {
        return $query->where('user_id', $userId)
                     ->where('movie_id', $movieId);
    }
}