<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Anime;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Order;
use App\Models\Conversation;


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
        User::factory(5)->create();
        Anime::factory(5)->create();
        Product::factory(5)->create();
        Tag::factory(5)->create();
        Order::factory(5)->create();
        Conversation::factory(10)->create();
    }
}