<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use App\Models\Product;
use App\Models\Anime;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //switch ($this->faker->randomElement(['product', 'post', 'anime'])) {
        switch ($this->faker->randomElement(['post'])) {
            case 'product':
                $commentable = Product::inRandomOrder()->first();
            break;
            case 'post':
                $commentable = Post::inRandomOrder()->first();
            break;
            case 'anime':
                $commentable = Anime::inRandomOrder()->first();
            break;
         }

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'commentable_id' => $commentable->id,
            'commentable_type' => get_class($commentable),
            'message' => $this->faker->paragraph,
        ];
    }
}
