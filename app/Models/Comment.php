<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    
    protected $fillable = [
        'user_id',
        'movie_id',
        'content',
        'is_deleted',
    ];

    protected $casts = [
        'is_deleted' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Пользователь, оставивший комментарий
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Фильм, к которому оставлен комментарий
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    /**
     * Только активные комментарии (не удаленные)
     */
    public function scopeActive($query)
    {
        return $query->where('is_deleted', false);
    }

    /**
     * Мягкое удаление комментария
     */
    public function softDelete()
    {
        $this->update(['is_deleted' => true]);
    }

    /**
     * Восстановление удаленного комментария
     */
    public function restore()
    {
        $this->update(['is_deleted' => false]);
    }

    /**
     * Проверка, удален ли комментарий
     */
    public function isDeleted(): bool
    {
        return (bool) $this->is_deleted;
    }

    /**
     * Короткое содержание комментария
     */
    public function getShortContentAttribute($length = 100)
    {
        return strlen($this->content) > $length 
            ? substr($this->content, 0, $length) . '...' 
            : $this->content;
    }
}