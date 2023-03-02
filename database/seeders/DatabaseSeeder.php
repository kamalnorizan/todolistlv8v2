<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Todolist;
use App\Models\Comment;
use App\Models\Image;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(200)->create();
        // Todolist::factory(300)->create();
        // Comment::factory(800)->create();
        Image::factory(10)->create();
    }
}
