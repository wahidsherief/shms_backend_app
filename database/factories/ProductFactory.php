<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Business;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = \App\Models\Product::class;

    public function definition()
    {
        return [
            'business_id' => Business::inRandomOrder()->first()->id ?? 1,
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'size' => $this->faker->randomElement(['200g','250g','300g']),
            'cost' => 0,  // Will calculate later
            'suggested_price' => 0,
            'profit_margin' => 0,
        ];
    }
}
