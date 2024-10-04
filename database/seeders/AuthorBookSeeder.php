<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorBookSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['book_id' => 1, 'author_id' => 1],  // "Война и мир" - Лев Толстой
            ['book_id' => 2, 'author_id' => 2],  // "Преступление и наказание" - Фёдор Достоевский
            ['book_id' => 3, 'author_id' => 3],  // "Мастер и Маргарита" - Михаил Булгаков
            ['book_id' => 4, 'author_id' => 1],  // "Анна Каренина" - Лев Толстой
            ['book_id' => 5, 'author_id' => 4],  // "Основы программирования" - Томас Кормен
            ['book_id' => 7, 'author_id' => 6],  // "Введение в искусственный интеллект" - Игорь Черпаков
            ['book_id' => 8, 'author_id' => 7],  // "Совершенный код" - Томас Кормен
            ['book_id' => 7, 'author_id' => 8],  // "Чистый код" - Томас Кормен
            ['book_id' => 7, 'author_id' => 9],  // "Изучаем Python" - Игорь Черпаков
            ['book_id' => 9, 'author_id' => 14], // "Чистый код" - Томас Кормен
            ['book_id' => 10, 'author_id' => 15],// "Алгоритмы. Построение и анализ" - Игорь Черпаков
            ['book_id' => 11, 'author_id' => 5], // "Совершенный код" - Игорь Черпаков
        ];

        DB::table('author_book')->insert($data);
    }
}
