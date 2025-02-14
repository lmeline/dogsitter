<?php

namespace Database\Factories;

use App\Models\Race;
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
        
        $users = User::where('role', 'proprietaire')->pluck('id')->toArray();
        $races = Race::pluck('nom')->toArray();
        $race_id = fake()->randomElement($races);
        $user_id = fake()->randomElement($users);
            


        return [
            'nom' => fake()->firstName(),
            'race' => $race_id,
            'age' => fake()->numberBetween(1, 20),
            'poids' => fake()->numberBetween(1, 70),
            'besoins_speciaux' => fake()->sentence(),
            'comportement' => fake()->sentence(),
            'proprietaire_id' => $user_id,
            'sterilise' => fake()->randomElement([true, false]),
            'sexe' => fake()->randomElement(['M', 'F']),
        ];
    }
}
