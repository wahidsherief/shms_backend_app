<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Component>
 */
class ComponentFactory extends Factory
{
    protected $model = \App\Models\Component::class;

    public function definition()
    {
        return [
            'product_id' => Product::inRandomOrder()->first()->id ?? 1,
            'name' => $this->faker->word,
            'quantity' => $this->faker->numberBetween(1,5),
            'unit' => $this->faker->randomElement(['g','ml','pcs']),
            'purchase_cost' => $this->faker->randomFloat(2,0.5,5),
        ];
    }
}
