<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrestationtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB ::table('prestations_types')->insert([
            [
                'nom' => 'garde de chien',
            ],
            [
                'nom' => 'promenade ',
            ],
           
            ]);
    }
}
