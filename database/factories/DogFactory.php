<?php

namespace Database\Factories;

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
        $created_at = fake()->dateTimeBetween('-1 year', 'now');
        return [
            'nom' => fake()->name(),
            'race' => fake()->word(),
            'age' => fake()->numberBetween(1, 20),
            'poids' => fake()->numberBetween(1, 70),
            'besoins_spe' => fake()->sentence(),
            'comportement' => fake()->sentence(),
            'sterilise' => fake()->randomElement(['oui', 'non']),
            'sexe' => fake()->randomElement(['M', 'F']),
            'created_at' => $created_at,
            'updated_at' => $created_at
        ];
    }
}
