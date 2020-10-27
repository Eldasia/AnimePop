<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Anime;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        /**
         * Users
         */
        User::factory()
            ->create([
                'name' => 'Maureen',
                'email' => 'maureen@exemple.com',
            ]);

        User::factory()
            ->times(5)
            ->create();
    }
}