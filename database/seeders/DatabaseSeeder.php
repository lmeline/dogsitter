<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    
      $this->call([
        VilleSeeder::class,
        PrestationTypeSeeder::class,
        AbonnementSeeder::class,
        UserSeeder::class,
        RaceSeeder::class,
        DogSeeder::class,
        //PrestationSeeder::class,
        //AvisSeeder::class,
        UserPrestationTypeSeeder::class
      ]);
    }
}
