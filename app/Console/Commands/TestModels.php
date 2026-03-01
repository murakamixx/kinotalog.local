<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Favorite;

class TestModels extends Command
{
    protected $signature = 'test:models';
    protected $description = 'Тестирование всех моделей и их методов';

    public function handle()
    {
        $this->info('Начинаем тестирование моделей...');
        
        try {
            // Тестирование пользователя
            $this->info("\n Тестирование модели User:");
            $user = User::first();
            if ($user) {
                $this->line(" Найден пользователь: {$user->username}");
                $this->line("   - Администратор: " . ($user->isAdmin() ? 'Да' : 'Нет'));
                $this->line("   - Забанен: " . ($user->isBanned() ? 'Да' : 'Нет'));
            } else {
                $this->warn(" Пользователи не найдены");
            }

            // Тестирование фильмов
            $this->info("\n Тестирование модели Movie:");
            $movie = Movie::with(['genres', 'creator'])->first();
            if ($movie) {
                $this->line(" Найден фильм: {$movie->title}");
                $this->line("   - Жанры: {$movie->genres_list}");
                $this->line("   - Добавил: " . ($movie->creator->username ?? 'Неизвестно'));
                $this->line("   - Лайков: {$movie->likes_count}");
                $this->line("   - Комментариев: {$movie->comments_count}");
            } else {
                $this->warn(" Фильмы не найдены");
            }

            // Тестирование жанров
            $this->info("\n Тестирование модели Genre:");
            $genre = Genre::withCount('movies')->first();
            if ($genre) {
                $this->line(" Найден жанр: {$genre->name}");
                $this->line("   - Фильмов в жанре: {$genre->movies_count}");
            } else {
                $this->warn(" Жанры не найдены");
            }

            // Тестирование связей
            if ($user && $movie) {
                $this->info("\n Тестирование связей:");
                
                // Тест лайка
                $like = $movie->addLike($user);
                $this->line(" Добавление лайка: " . ($like ? 'Успешно' : 'Уже лайкнуто'));
                $this->line("   - Лайкнут пользователем: " . ($movie->isLikedBy($user) ? 'Да' : 'Нет'));
                
                // Тест избранного
                $favorite = $movie->favorites()->create(['user_id' => $user->id]);
                $this->line(" Добавление в избранное: Успешно");
                $this->line("   - В избранном у пользователя: " . ($user->hasFavorited($movie) ? 'Да' : 'Нет'));
                
                // Тест комментария
                $comment = $movie->addComment($user, 'Тестовый комментарий ' . now());
                $this->line(" Добавление комментария: {$comment->short_content}");
                
                // Тест лайкнутых фильмов пользователя
                $likedMovies = $user->likedMovies;
                $this->line(" Лайкнутых фильмов у пользователя: {$likedMovies->count()}");
                
                // Тест скоупов фильмов
                $this->info("\n Тестирование скоупов Movie:");
                $popularMovies = Movie::popular()->limit(5)->get();
                $this->line(" Популярных фильмов найдено: {$popularMovies->count()}");
                
                $newMovies = Movie::newest()->limit(5)->get();
                $this->line(" Новых фильмов найдено: {$newMovies->count()}");
            }

            $this->info("\n Все тесты успешно завершены!");
            
        } catch (\Exception $e) {
            $this->error(" Ошибка: " . $e->getMessage());
        }
    }
}