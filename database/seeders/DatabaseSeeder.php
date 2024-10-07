<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
//        $this->call(ReadersSeeder::class);
//        $this->call(UsersSeeder::class);
//        $this->call([AuthorsSeeder::class]);
//        $this->call([BooksSeeder::class]);
//        $this->call([AuthorBookSeeder::class]);
        $this->call([IssuanceSeeder::class]);
    }
}
