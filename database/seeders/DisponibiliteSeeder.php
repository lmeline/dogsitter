<?php

namespace Database\Seeders;

use App\Models\Disponibilite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DisponibiliteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Disponibilite::factory(10)->create();
    }
}
