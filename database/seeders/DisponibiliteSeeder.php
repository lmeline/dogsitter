<?php

namespace Database\Seeders;

use App\Models\Disponibilite;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DisponibiliteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $joursSemaine = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

        // Récupère tous les dogsitters
        $dogsitters = User::where('role', 'dogsitter')->get();

        foreach ($dogsitters as $dogsitter) {
            foreach ($joursSemaine as $jour) {
                Disponibilite::firstOrCreate([
                    'dogsitter_id' => $dogsitter->id,
                    'jour_semaine' => $jour,
                ], [
                    'heure_debut' => fake()->time("H:i"),
                    'heure_fin' => fake()->time("H:i"),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
