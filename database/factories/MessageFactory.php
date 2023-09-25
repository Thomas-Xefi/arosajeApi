<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sender = User::query()->inRandomOrder()->first();
        $receiver = User::query()->inRandomOrder()->whereNot('id', $sender->getKey())->first();

        return [
            'sender_id' => $sender->getKey(),
            'receiver_id' => $receiver->getKey(),
            'content' => fake()->sentence(10),
            'send_at' => fake()->dateTimeBetween('-30 days')
        ];
    }
}
