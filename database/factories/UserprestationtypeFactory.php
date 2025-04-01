<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use App\Models\User;
use App\Models\PrestationType;
use App\Models\UserPrestationType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserPrestationTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     * 
     *
     * @return array<string, mixed>
     */

    protected $model = UserPrestationType::class;
    public function definition(): array
    {
        return [
            'dogsitter_id' => User::inRandomOrder()->first()->id,
            'prestation_type_id' => PrestationType::inRandomOrder()->first()->id,
            "prix" => rand(10, 20),
            "duree" => Arr::random([30, 60, 90, 120]),
        ];
    }
}
