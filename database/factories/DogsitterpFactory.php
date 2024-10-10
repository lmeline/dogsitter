<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dogsitterp>
 */
class DogsitterpFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->sentence(),
            'experience' => fake()->numberBetween(1, 10),
            'tarif_horaire' => fake()->numberBetween(1, 70),
            'tarif_journalier' => fake()->numberBetween(1, 70),
            'disponibilite' => fake()->randomElement(['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche']),
            'service' => fake()->randomElement(['promenade', 'garde à domicile']),
            'horaire_disponible' => fake()->sentence(),
            'note_moyenne' => fake()->numberBetween(1, 5),
            'nb_avis' => fake()->numberBetween(1, 100),
            //'user_id' => fake()->numberBetween(1, 10)
        ];
    }
}
