<?php

namespace Database\Factories;

use App\Models\Anime;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AnimeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Anime::class;

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
            'mal_id' => $this->faker->randomNumber(3, true),
            'mal_url' => $this->faker->url,
            'img_url' => $this->faker->imageUrl(200, 300),
            'type' => $this->faker->word,
            'synopsis' => $this->faker->paragraphs(2, true),
            'episodes' => $this->faker->randomNumber(3, true),
            'start_diff' => $this->faker->date('d-m-Y', 'now'),
            'end_diff' => $this->faker->date('d-m-Y', 'now'),
            'rated' => $this->faker->randomDigit,
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Anime $anime) {
            //
        })->afterCreating(function (Anime $anime) {
            $anime->comments()->save(Comment::factory()->make());
        });
    }
}
