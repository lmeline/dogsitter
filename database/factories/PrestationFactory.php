<?php

namespace Database\Factories;

use App\Models\Dog;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Prestationtype;
use App\Models\Userprestationtype;

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
        $proprietaire = User::where('role', 'proprietaire')
            ->whereHas('dogs')
            ->inRandomOrder()
            ->first();

        if (!$proprietaire || $proprietaire->dogs->isEmpty()) {
            return [];
        }

        $dog = $proprietaire->dogs()->inRandomOrder()->first();
        $dogsitter = User::where('role', 'dogsitter')->inRandomOrder()->first();
        $prestation_type = Userprestationtype::inRandomOrder()->first();
        $prix_total = $prestation_type->prix;

        // Génère une heure de début aléatoire entre 8h et 17h
        $heureDebut = fake()->numberBetween(8, 17);
        $minuteDebut = fake()->randomElement([0, 30]);

        // Si type 1 (par exemple garde à la journée), durée aléatoire jusqu’à 5h, sinon 1h
        $durée = $prestation_type->prestation_type_id == 1 ? fake()->numberBetween(1, 5) : 1;

        $datetimeDebut = now()->setTime($heureDebut, $minuteDebut)->addDays(fake()->numberBetween(1, 60));
        $datetimeFin = (clone $datetimeDebut)->addHours($durée);

        return [
            'proprietaire_id' => $proprietaire->id,
            'dogsitter_id' => $dogsitter->id,
            'dog_id' => $dog->id,
            'prestation_type_id' => $prestation_type->prestation_type_id,
            'date_debut' => $datetimeDebut,
            'date_fin' => $datetimeFin,
            'prix_total' => $prix_total,
            'statut' => fake()->randomElement(['en attente', 'terminée', 'annulée', 'validée']),
        ];
    }
}
