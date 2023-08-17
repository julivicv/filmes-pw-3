<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Horror',
            ],
            [
                'name' => 'Drama',
            ],
            [
                'name' => 'Action',
            ],
            [
                'name' => 'Sci-fi',
            ],
            [
                'name' => 'Comedy',
            ],
            [
                'name' => 'Romance',
            ],
            [
                'name' => 'Romcom',
            ],
            [
                'name' => 'Kids',
            ]
        ]);
    }
}
