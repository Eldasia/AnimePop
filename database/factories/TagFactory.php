<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tag::class;

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
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Tag $tag) {
            //
        })->afterCreating(function (Tag $tag) {
            $tag->posts()->sync(
                Post::select('id')
                    ->inRandomOrder()
                    ->take($this->faker->numberBetween(1, 3))
                    ->get()
                    ->pluck('id')
                    ->toArray()
            );
            $tag->products()->sync(
                Product::select('id')
                    ->inRandomOrder()
                    ->take($this->faker->numberBetween(1, 3))
                    ->get()
                    ->pluck('id')
                    ->toArray()
            );
        });
    }
}
