<?php

namespace Database\Factories;

use App\Models\Dog;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\PrestationType;

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

        $proprietaires = User::where('role', 'proprietaire')->pluck('id')->toArray();
        $dogsitters = User::where('role', 'dogsitter')->pluck('id')->toArray();
        $prestations_types = PrestationType::all()->pluck('id')->toArray();
        $dog = Dog::where('proprietaire_id', $proprietaires)->inRandomOrder()->first();

        return [
            'proprietaire_id' => fake()->randomElement($proprietaires),
            'dogsitter_id' => fake()->randomElement($dogsitters),
            'prestation_type_id' => fake()->randomElement($prestations_types),
            'date_fin'=> fake()->date($format = 'Y-m-d', $max = 'now'),
            'date_debut'=> fake()->date($format = 'Y-m-d', $max = 'now'),
            'prix' => fake()->numberBetween(1, 100),
            'quantite' => fake()->numberBetween(1, 100),
            'prix_total' => fake()->numberBetween(1, 100),
            'statut'=> fake()->randomElement(['en cours', 'termine', 'annule', 'en attente de paiement']),
            'dog_id' => $dog ? $dog->id : null,

        ];
    }
}
