<?php

namespace Database\Factories;

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

        $role = fake()->randomElement(['admin', 'user','dogsitter']);
        if($role=='dogsitter')
            {
                $note_moyenne = fake()->numberBetween(0, 5);
                $nb_notes = fake()->numberBetween(0, 5);
                $abonnement_id = fake()->numberBetween(1, 3);
                $service = fake()->sentence();
                $disponibilite_jour = fake()->sentence();
                $experience = fake()->sentence();
                $description = fake()->sentence();
            } else {
                $note_moyenne = null;
                $nb_notes = null;
                $abonnement_id = null;
                $service = null;
                $disponibilite_jour = null;
                $experience = null;
                $description = null;
            }

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'prenom' => fake()->firstName(),
            'date_naissance'=>fake()->date(),
            'ville' => fake()->city(),
            'code_postal' => fake()->postcode(),
            'adresse' => fake()->streetAddress(),
            'numero_telephone' => fake()->phoneNumber(),
            'experience' => $experience,
            'description' => $description,
            'service' => $service,
            'disponibilite_jour' => $disponibilite_jour,
            'note_moyenne' => $note_moyenne,
            'nb_notes' => $nb_notes,
            'abonnement_id' =>$abonnement_id,
            'role' => $role,

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
