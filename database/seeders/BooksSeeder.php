<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['title' => 'Война и мир', 'publisher' => 'Эксмо', 'book_year' => 2006, 'amount' => 10, 'type' => 'fiction'],
            ['title' => 'Преступление и наказание', 'publisher' => 'Эксмо', 'book_year' => 2015, 'amount' => 5, 'type' => 'fiction'],
            ['title' => 'Мастер и Маргарита', 'publisher' => 'Эксмо', 'book_year' => 2010, 'amount' => 8, 'type' => 'fiction'],
            ['title' => 'Анна Каренина', 'publisher' => 'Росмэн', 'book_year' => 2011, 'amount' => 3, 'type' => 'fiction'],
            ['title' => 'Основы программирования', 'publisher' => 'ДЕАН', 'book_year' => 2021, 'amount' => 2, 'type' => 'technic'],
            ['title' => 'Мечтают ли андроиды об электроовцах?', 'publisher' => 'Эксмо', 'book_year' => 2007, 'amount' => 2, 'type' => 'fiction'],
            ['title' => 'Алгоритмы. Построение и анализ', 'publisher' => 'ДЕАН', 'book_year' => 2005, 'amount' => 9, 'type' => 'technic'],
            ['title' => 'Введение в искусственный интеллект', 'publisher' => 'ТЕХЛИТИЗДАТ', 'book_year' => 2023, 'amount' => 3, 'type' => 'technic'],
            ['title' => 'Совершенный код', 'publisher' => 'ТЕХЛИТИЗДАТ', 'book_year' => 2000, 'amount' => 5, 'type' => 'technic'],
            ['title' => 'Чистый код', 'publisher' => 'ТЕХЛИТИЗДАТ', 'book_year' => 2008, 'amount' => 6, 'type' => 'technic'],
            ['title' => 'Изучаем Python', 'publisher' => 'ТЕХЛИТИЗДАТ', 'book_year' => 2009, 'amount' => 5, 'type' => 'technic'],
        ];

        DB::table('books')->insert($data);
    }
}
