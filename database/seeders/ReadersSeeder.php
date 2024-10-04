<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReadersSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'first_name' => 'Вероника',
                'last_name' => 'Морозова',
                'group_code' => null,
                'phone' => '+79785679966',
                'email' => 'morozko@mail.ru',
            ],
            [
                'first_name' => 'Екатерина',
                'last_name' => 'Буянова',
                'group_code' => 'УТС/б-20-1-о',
                'phone' => '+79784444444',
                'email' => 'katherina@gmail.com',
            ],
            [
                'first_name' => 'Илья',
                'last_name' => 'Васин',
                'group_code' => 'ИВТ/б-21-1-о',
                'phone' => '+78005553535',
                'email' => 'vasvasvas@mail.ru',
            ],
            [
                'first_name' => 'Мария',
                'last_name' => 'Баранович',
                'group_code' => 'ИБ/б-22-2-о',
                'phone' => '+79782225555',
                'email' => 'matryona@mail.ru',
            ],
            [
                'first_name' => 'Руслан',
                'last_name' => 'Марков',
                'group_code' => 'ПИ/б-20-1-о',
                'phone' => null,
                'email' => null,
            ],
        ];

        DB::table('readers')->insert($data);
    }
}
