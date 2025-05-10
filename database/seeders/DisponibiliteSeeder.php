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

        $dogsitters = User::where('role', 'dogsitter')->get();
        
        foreach ($dogsitters as $dogsitter) {
            foreach ($joursSemaine as $jour) {
                $heureDebut = fake()->numberBetween(8, 18); 
                $heureFin = fake()->numberBetween($heureDebut + 1, 20);
        
                // Formatage en H:i (ex. 08:00)
                $heureDebutStr = sprintf('%02d:00', $heureDebut);
                $heureFinStr = sprintf('%02d:00', $heureFin);
        
                Disponibilite::firstOrCreate([
                    'dogsitter_id' => $dogsitter->id,
                    'jour_semaine' => $jour,
                ], [
                    'heure_debut' => $heureDebutStr,
                    'heure_fin' => $heureFinStr,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }        
    }
}
