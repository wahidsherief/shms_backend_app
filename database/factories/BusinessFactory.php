<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BusinessType;
use App\Models\User;
use Illuminate\Validation\Rules\Unique;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business>
 */
class BusinessFactory extends Factory
{
    protected $model = \App\Models\Business::class;

    public function definition()
    {
        $userId = User::inRandomOrder()->first()->id ?? null;

        return [
            'name' => $this->faker->company,
            'business_type_id' => BusinessType::inRandomOrder()->first()->id ?? 1,
            'user_id' => $userId,
            'email' => $this->faker->unique()->companyEmail,
        ];
    }
}
