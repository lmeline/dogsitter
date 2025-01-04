<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\PrestationType;
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
            'user_id' => User::factory(), 
            'prestation_type_id' => PrestationType::factory(), 
            'prix' => $this->faker->randomFloat(2, 10, 100),
            'duree' => $this->faker->randomNumber(2),
        ];  
    }
}
