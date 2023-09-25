<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Message;
use App\Models\Plant;
use App\Models\PlantSpecies;
use App\Models\Tip;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        PlantSpecies::factory()->count(20)
            ->create();

        User::factory()->count(10)
            ->has(
                Plant::factory()->count(5)->draft(),
                'ownedPlants'
            )
            ->createQuietly();

        User::factory()
            ->create([
               'lastname' => 'test',
               'firstname' => 'test',
               'email' => 'test@gmail.com',
               'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            ]);

        Tip::factory()->count(50);
    }
}
