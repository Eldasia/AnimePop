<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'intro' => $this->faker->sentence,
            'content' => $this->faker->paragraph(3, true),
            'is_published' => $this->faker->boolean,
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Post $post) {
            //
        })->afterCreating(function (Post $post) {
            $post->comments()->saveMany(Comment::factory($this->faker->numberBetween(1,3))->make());
        });
    }
}
