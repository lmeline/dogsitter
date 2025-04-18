<?php
namespace Database\Factories;

use App\Models\Dog;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Prestationtype;

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
        $proprietaire = User::where('role', 'proprietaire')->inRandomOrder()->first();

        if ($proprietaire->dogs->isEmpty()) {
            return [];
        }
        $dogsitter = User::where('role', 'dogsitter')->inRandomOrder()->first();

        $prestation_type = Prestationtype::inRandomOrder()->first();

        return [
            'proprietaire_id' => $proprietaire->id, 
            'dogsitter_id' => $dogsitter->id,  
            'prestation_type_id' => $prestation_type->id,  
            'date_debut' => $this->faker->dateTimeThisYear(),  
            'date_fin' => $this->faker->dateTimeThisYear(),   
            'quantite' => $this->faker->numberBetween(1, 5),  
            'prix_total' => $this->faker->randomFloat(2, 20, 200),  
            'statut' => $this->faker->randomElement(['en cours', 'termine', 'annule', 'en attente de paiement']), 
        ];
    }
}
