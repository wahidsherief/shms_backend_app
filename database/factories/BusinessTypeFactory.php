<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BusinessType>
 */
class BusinessTypeFactory extends Factory
{
    protected $model = \App\Models\BusinessType::class;
    
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Restaurant','Hotel','Real Estate']),
        ];
    }
}
