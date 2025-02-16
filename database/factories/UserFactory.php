<?php

namespace Database\Factories;

use App\Models\PrestationType;
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
        $role = fake()->randomElement(['admin', 'proprietaire','dogsitter']);
        if($role=='dogsitter')
            {
                $note_moyenne = fake()->numberBetween(0, 5);
                $nb_notes = fake()->numberBetween(0, 5);
                $abonnement_type_id = fake()->numberBetween(1, 3);
                $disponibilite_jour = fake()->sentence();
                $description = fake()->sentence();
            } else {
                $note_moyenne = null;
                $nb_notes = null;
                $abonnement_type_id = null;
                $disponibilite_jour = null;
                $description = null;
            }

        return [
            'name' => fake()->lastName(),
            'prenom' => fake()->firstName(),
            'date_naissance'=>fake()->date(),
            'numero_telephone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'adresse' => fake()->streetAddress(),
            'ville_id' => $ville->id,
            'code_postal' => $ville->code_postal,
            'role' => $role,
            'description' => $description,
            'remember_token' => Str::random(10),
            'photo'=>fake()->imageUrl(),
            'disponibilite_jour' => $disponibilite_jour,
            'note_moyenne' => $note_moyenne,
            'nb_notes' => $nb_notes,
            'abonnement_type_id' =>$abonnement_type_id,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),

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
