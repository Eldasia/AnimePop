<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        return [
            'name' => $title,
            'type' => 'product',
            'slug' => Str::slug($title),
            'image' => $this->faker->imageUrl(640, 480),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 5, 20),
            'tax' => $this->faker->randomFloat(2, 0, 2),
            'stock' => $this->faker->numberBetween(0, 100),
        ];
    }
}
