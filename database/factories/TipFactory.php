<?php

namespace Database\Factories;

use App\Models\Plant;
use App\Models\Tip;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tip>
 */
class TipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->first()->getKey(),
            'plant_id' => Plant::query()->inRandomOrder()->first()->getKey(),
            'content' => fake()->sentence(20)
        ];
    }
}
