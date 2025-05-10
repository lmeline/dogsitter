<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AbonnementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('abonnements_types')->insert([
        [
            'nom' => 'Abonnement par mois ',
            'prix' => 29.99,
            'description' => 'pas de description',
            
        ],
        [
            'nom' => 'Abonnement sur l\'année',
            'prix' => 299.9,
            'description'=>'pas de description',
            
        ]
        ]);
    }
}
