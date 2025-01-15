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
            'prix' => 29.99,
            
        ],
        [
            'nom' => 'Standard sur l\'année',
            'prix' => 299.9,
            
        ],
        [
            'nom' => 'pas d\'abonnement',
            'prix'=>null,
        ],
        ]);
    }
}
