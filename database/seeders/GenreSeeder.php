<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            'Боевик', 'Комедия', 'Драма', 'Ужасы', 'Фантастика',
            'Триллер', 'Мелодрама', 'Детектив', 'Приключения',
            'Мультфильм', 'Документальный', 'Исторический'
        ];

        foreach ($genres as $genre) {
            DB::table('genres')->insert([
                'name' => $genre,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}