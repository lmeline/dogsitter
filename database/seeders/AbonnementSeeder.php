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
            'nom' => 'Standard par mois ',
            'prix' => 19.99,
            
        ],
        [
            'nom' => 'Standard sur l\'année',
            'prix' => 199.9,
            
        ],
        [
            'nom' => 'pas d\'abonnement',
            'prix'=>null,
        ],
        [
            'nom' => 'Premium par mois',
            'prix' => 39.99,
        ],
        [
            'nom' => 'Premium sur l\'annee',
            'prix' => 399.9,
        ]
        ]);
    }
}
