<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorsSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['first_name' => 'Лев', 'last_name' => 'Толстой'],
            ['first_name' => 'Фёдор', 'last_name' => 'Достоевский'],
            ['first_name' => 'Михаил', 'last_name' => 'Булгаков'],
            ['first_name' => 'Игорь', 'last_name' => 'Черпаков'],
            ['first_name' => 'Марк', 'last_name' => 'Лутц'],
            ['first_name' => 'Томас', 'last_name' => 'Кормен'],
            ['first_name' => 'Денис', 'last_name' => 'Смолин'],
            ['first_name' => 'Чарльз', 'last_name' => 'Лейзерин'],
            ['first_name' => 'Рональд', 'last_name' => 'Ревет'],
            ['first_name' => 'Клиффорд', 'last_name' => 'Штайн'],
            ['first_name' => 'Филип', 'last_name' => 'Дик'],
            ['first_name' => 'Александр', 'last_name' => 'Пушкин'],
            ['first_name' => 'Антон', 'last_name' => 'Чехов'],
            ['first_name' => 'Стив', 'last_name' => 'Макконнелл'],
            ['first_name' => 'Роберт', 'last_name' => 'Мартин'],
        ];

        DB::table('authors')->insert($data);
    }
}
