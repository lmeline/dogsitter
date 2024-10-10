<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TarifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tarifs')->insert([
            'nom' => 'Promenade 15 minutes',
            'prix' => 15.00,
            'user_id' => 1
        ]);

        DB::table('tarifs')->insert([
            'nom' => 'Promenade 30 minutes',
            'prix' => 30.00,
            'user_id' => 3
        ]);

        DB::table('tarifs')->insert([
            'nom' => 'Promenade 45 minutes',
            'prix' => 45.00,
            'user_id' => 7
        ]);


    }
}
