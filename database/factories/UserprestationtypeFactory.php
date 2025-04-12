<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use App\Models\User;
use App\Models\Prestationtype;
use App\Models\Userprestationtype;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserprestationtypeFactory extends Factory
{
    /**
     * Define the model's default state.
     * 
     *
     * @return array<string, mixed>
     */

    protected $model = Userprestationtype::class;
    public function definition(): array
    {
        return [
            'dogsitter_id' => User::inRandomOrder()->first()->id,
            'prestation_type_id' => Prestationtype::inRandomOrder()->first()->id,
            "prix" => rand(10, 20),
            "duree" => Arr::random([60]),
        ];
    }
}
