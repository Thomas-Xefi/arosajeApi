<?php

namespace Database\Factories;

use App\Models\PlantSpecies;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plant>
 */
class PlantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'name' => fake()->colorName(),
            'description' => fake()->realText(),
            'price' => fake()->randomFloat(2, 5, 100),
            'plant_species_id' => PlantSpecies::query()->inRandomOrder()->first()->getKey(),
        ];
    }

    public function draft(): Factory {
        return $this->state(function (array $attributes) {
            return [
                'status_id' => Status::query()->where('slug', 'draft')->first()->getKey(),
            ];
        });
    }
}
