<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConversationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Conversation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Conversation $conversation) {
            $users = User::inRandomOrder()
                ->take($this->faker->numberBetween(2, 5))
                ->get();

            $conversation->users()->attach($users->pluck('id')->toArray());

            $messages = [];
            for ($i = 0; $i < $this->faker->numberBetween(5,15); $i++){
                $messages[$i] = new Message([
                    'sender_id' => $users->shuffle()->first()->id,
                    'content' => $this->faker->paragraph
                ]);
            }

            $conversation->messages()->saveMany($messages);
        });
    }
}
