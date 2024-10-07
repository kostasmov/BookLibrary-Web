<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IssuanceSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['id' => 1, 'book_id' => 1, 'reader_id' => 1, 'book_date' => '2022-12-10', 'return_date' => '2023-01-10', 'status' => 'returned'],
            ['id' => 2, 'book_id' => 3, 'reader_id' => 2, 'book_date' => '2023-12-05', 'return_date' => '2024-01-05', 'status' => 'issued'],
            ['id' => 3, 'book_id' => 2, 'reader_id' => 3, 'book_date' => '2024-01-20', 'return_date' => '2024-02-20', 'status' => 'issued'],
            ['id' => 4, 'book_id' => 4, 'reader_id' => 1, 'book_date' => '2023-05-01', 'return_date' => '2023-06-01', 'status' => 'returned'],
            ['id' => 5, 'book_id' => 5, 'reader_id' => 5, 'book_date' => '2024-02-12', 'return_date' => '2024-03-12', 'status' => 'issued'],
            ['id' => 6, 'book_id' => 5, 'reader_id' => 1, 'book_date' => null, 'return_date' => null, 'status' => 'pending'],
            ['id' => 12, 'book_id' => 1, 'reader_id' => 1, 'book_date' => null, 'return_date' => null, 'status' => 'pending'],
            ['id' => 7, 'book_id' => 8, 'reader_id' => 1, 'book_date' => '2024-04-06', 'return_date' => '2024-10-01', 'status' => 'returned'],
        ];

        DB::table('issuances')->insert($data);
    }
}
