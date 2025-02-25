<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Disponibilite>
 */
class DisponibiliteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::where('role', 'dogsitter')->pluck('id')->toArray();
        $user_id = fake()->randomElement($users);
            
        return [
            'dogsitter_id' => $user_id,
            'jour_semaine' => fake()->dayOfWeek(),
            'heure_debut' => fake()->time(),
            'heure_fin' => fake()->time(),

        ];
    }
}
