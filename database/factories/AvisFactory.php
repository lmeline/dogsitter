<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Avis>
 */
class AvisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::where('role', 'proprietaire','dogsitter')->pluck('id')->toArray();
        return [
            'user_id' => fake()->randomElement($users),
            'commentaire' => fake()->sentence(),
            'rating' => fake()->numberBetween(1, 5),
        ];
    }
}
