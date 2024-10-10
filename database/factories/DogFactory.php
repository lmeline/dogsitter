<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dog>
 */
class DogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'nom' => fake()->name(),
            'race' => fake()->word(),
            'age' => fake()->numberBetween(1, 20),
            'poids' => fake()->numberBetween(1, 70),
            'besoins_speciaux' => fake()->sentence(),
            'comportement' => fake()->sentence(),
            'user_id' => fake()->numberBetween(1, 40),
            'sterilise' => fake()->randomElement([true, false]),
            'sexe' => fake()->randomElement(['M', 'F']),
        ];
    }
}
