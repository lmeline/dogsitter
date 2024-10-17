<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PrestationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date_fin'=> fake()->date($format = 'Y-m-d', $max = 'now'),
            'date_debut'=> fake()->date($format = 'Y-m-d', $max = 'now'),
            'prix' => fake()->numberBetween(1, 100),
            'quantite' => fake()->numberBetween(1, 100),
            'prix_total' => fake()->numberBetween(1, 100),
            'statut'=> fake()->randomElement(['en cours', 'termine', 'annule', 'en attente de paiement']),


        ];
    }
}
