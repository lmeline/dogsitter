<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => "admin",
            'prenom' => "admin",
            'date_naissance' => "1990-01-01",
            'email' => "admin@gmail.com",
            'ville_id' => 1,
            'code_postal' => 75000,
            'role' => 'admin',
            'description' => "admin",
            'remember_token' => Str::random(10),
            'photo' => 'https://i.pravatar.cc/300?img=' . rand(1, 70),
            'email_verified_at' => now(),
            'password' => Hash::make('admin')
        ]);
        DB::table('users')->insert([
            'name' => "propriétaire",
            'prenom' => "propriétaire",
            'date_naissance' => "1990-01-01",
            'email' => "proprietaire@gmail.com",
            'ville_id' => 1,
            'code_postal' => 75000,
            'role' => 'propriétaire',
            'description' => "propriétaire",
            'remember_token' => Str::random(10),
            'photo' => 'https://i.pravatar.cc/300?img=' . rand(1, 70),
            'email_verified_at' => now(),
            'password' => Hash::make('propriétaire')
        ]);
        DB::table('users')->insert([
            'name' => "dogsitter",
            'prenom' => "dogsitter",
            'date_naissance' => "1990-01-01",
            'email' => "dogsitter@gmail.com",
            'ville_id' => 1,
            'code_postal' => 75000,
            'role' => 'dogsitter',
            'description' => "dogsitter",
            'remember_token' => Str::random(10),
            'photo' => 'https://i.pravatar.cc/300?img=' . rand(1, 70),
            'abonnement_type_id' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('dogsitter')
        ]);
        User::factory(80)->create();

    }
}
