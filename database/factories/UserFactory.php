<?php

namespace Database\Factories;

use App\Models\Ville;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ville = Ville::inRandomOrder()->first();
        $role = fake()->randomElement(['admin', 'proprietaire', 'dogsitter']);
        if ($role == 'dogsitter') {
            $abonnement_type_id = fake()->numberBetween(1, 2);
        } else {
            $abonnement_type_id = null;
        }

        return [
            'name' => fake()->lastName(),
            'prenom' => fake()->firstName(),
            'date_naissance' => fake()->date(),
            'email' => fake()->unique()->safeEmail(),
            'ville_id' => $ville->id,
            'code_postal' => $ville->code_postal,
            'role' => $role,
            'description' => fake()->sentence(),
            'remember_token' => Str::random(10),
            'photo' => 'https://i.pravatar.cc/300?img=' . rand(1, 70),
            'abonnement_type_id' => $abonnement_type_id,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
