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
        // Sélectionner un propriétaire aléatoire
        $proprietaire = User::where('role', 'proprietaire')->inRandomOrder()->first();

        // Si le propriétaire n'a pas de chien, ne pas créer cette prestation
        if ($proprietaire->dogs->isEmpty()) {
            return [];
        }

        // Sélectionner un chien parmi ceux du propriétaire
        $dog = $proprietaire->dogs->random();

        // Sélectionner un dogsitter aléatoire
        $dogsitter = User::where('role', 'dogsitter')->inRandomOrder()->first();

        // Sélectionner un type de prestation aléatoire
        $prestation_type = PrestationType::inRandomOrder()->first();

        return [
            'proprietaire_id' => $proprietaire->id, 
            'dogsitter_id' => $dogsitter->id,  
            'prestation_type_id' => $prestation_type->id,  
            'date_debut' => $this->faker->dateTimeThisYear(),  
            'date_fin' => $this->faker->dateTimeThisYear(),  
            'prix' => $this->faker->randomFloat(2, 10, 100),  
            'quantite' => $this->faker->numberBetween(1, 5),  
            'prix_total' => $this->faker->randomFloat(2, 20, 200),  
            'statut' => $this->faker->randomElement(['en cours', 'termine', 'annule', 'en attente de paiement']),
            'dog_id' => $dog->id,  
        ];
    }
}
