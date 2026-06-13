<?php

namespace Database\Factories;

use App\Models\Feature;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Feature>
 */
class FeatureFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->text(),
            'description' => fake()->text(2000),
            'user_id' => User::where('email', 'admin@example.com')->first()->id
        ];
    }


}
