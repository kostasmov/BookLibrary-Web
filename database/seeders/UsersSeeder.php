<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'login' => 'admin',
                'password' => Hash::make('1111'),
                'role' => 'admin',
                'reader_id' => 1,
            ],
            [
                'login' => 'user1',
                'password' => Hash::make('0000'),
                'role' => 'user',
                'reader_id' => 2,
            ],
            [
                'login' => 'user2',
                'password' => Hash::make('0000'),
                'role' => 'user',
                'reader_id' => 3,
            ],
            [
                'login' => 'user3',
                'password' => Hash::make('0000'),
                'role' => 'user',
                'reader_id' => 4,
            ],
            [
                'login' => 'user4',
                'password' => Hash::make('0000'),
                'role' => 'user',
                'reader_id' => 5,
            ],
        ];

        DB::table('users')->insert($data);
    }
}
