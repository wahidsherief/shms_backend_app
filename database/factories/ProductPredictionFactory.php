<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductPrediction>
 */
class ProductPredictionFactory extends Factory
{
    protected $model = \App\Models\ProductPrediction::class;

    public function definition()
    {
        return [
            'product_id' => Product::inRandomOrder()->first()->id ?? 1,
            'cost_percentage' => $this->faker->randomFloat(2,20,50),
            'selling_price' => $this->faker->randomFloat(2,10,50),
            'profit_margin' => $this->faker->randomFloat(2,30,70),
            'cost_saving_suggestion' => 'Optimize component quantities.',
            'ai_generated_text' => $this->faker->sentence,
        ];
    }
}
