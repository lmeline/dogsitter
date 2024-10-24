<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Userprestationtype;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserprestationtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (User::where('role', 'dogsitter')->get() as $dogsitter) {
            DB::table('users_prestationtypes')->insert([
                "user_id" => $dogsitter->id,
                "prestationtype_id" => rand(1, 2),
                "prix" => rand(10, 20),
            ]);
        }
    }
}
