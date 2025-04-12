<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Userprestationtype;
use Illuminate\Support\Arr;
use App\Models\Prestationtype;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserprestationtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     UserPrestationType::factory(100)->create();
    // }

    public function run()
    {
        // Récupérer tous les users qui sont des dogsitters
        $dogsitters = User::where('role', 'dogsitter')->get();

        foreach ($dogsitters as $dogsitter) {
            // Sélectionner entre 2 et 5 prestations au hasard
            $prestations = Prestationtype::inRandomOrder()->limit(rand(2, 5))->get();

            foreach ($prestations as $prestation) {
                DB::table('users_prestations_types')->updateOrInsert([
                    'dogsitter_id' => $dogsitter->id,
                    'prestation_type_id' => $prestation->id,
                ], [
                    'prix' => rand(10, 50), // Prix aléatoire
                    "duree" => Arr::random([60]), // Durée aléatoire en heures
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
