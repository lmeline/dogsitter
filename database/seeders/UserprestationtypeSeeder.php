<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserPrestationType;
use Illuminate\Support\Arr;
use App\Models\PrestationType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPrestationTypeSeeder extends Seeder
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
<<<<<<< HEAD
        // Récupérer tous les users qui sont des dogsitters
        $dogsitters = User::where('role', 'dogsitter')->get();

        foreach ($dogsitters as $dogsitter) {
            // Sélectionner entre 2 et 5 prestations au hasard
            $prestations = PrestationType::inRandomOrder()->limit(rand(2, 5))->get();

            foreach ($prestations as $prestation) {
                DB::table('users_prestations_types')->updateOrInsert([
                    'dogsitter_id' => $dogsitter->id,
                    'prestation_type_id' => $prestation->id,
                ], [
                    'prix' => rand(10, 50), // Prix aléatoire
                    "duree" => Arr::random([30, 60, 90, 120]), // Durée aléatoire en heures
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
=======
        foreach (User::where('role', 'dogsitter')->get() as $dogsitter) {
            DB::table('users_prestations_types')->insert([
                "dogsitter_id" => $dogsitter->id,
                "prestation_type_id" => rand(1, 2),
                "prix" => rand(10, 20),
                "duree" => rand(1,1),
            ]);
>>>>>>> ca8bc9671b24d0dd331985eb95202366c2160436
        }
    }
}
