<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'status' => $this->faker->numberBetween(1, 5),
            'shipping_address' => $this->faker->address,
            'billing_address' => $this->faker->address,
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Order $order) {
            //
        })->afterCreating(function (Order $order) {

            $products = Product::inRandomOrder()
            ->take($this->faker->numberBetween(1, 3))
            ->get()
            ->transform(function($product) {
                return [
                    'id' => $product->id,
                    'pivot' => [
                        'price' => $product->price,
                        'tax' => $product->tax,
                        'quantity' => $this->faker->numberBetween(1,5)
                    ]
                ];
            })
            ->pluck('pivot', 'id')
            ->toArray();

            $order->products()->attach($products);
        });
    }
}
