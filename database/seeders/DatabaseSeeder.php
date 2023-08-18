<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('administrators')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => '$2y$10$HoWacFVh8Pd..ek16UxgYuK3GT.g3hDV8qN0mAzTkMtB8cQB8hxba',
            ],
        ]);
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
        Movie::factory(20)->create();
    }
}
