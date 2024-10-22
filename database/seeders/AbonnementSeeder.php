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
        DB::table('abonnements')->insert([
        [
            'nom' => 'mensuel',
            'prix' => 19.99,
        ],
        [
            'nom' => 'pas d\'abonnement',
            'prix'=>null,
        ],
        [
            'nom' => 'annuel',
            'prix' => 250.99,
        ]
        ]);
    }
}
