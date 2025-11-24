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
        $dishes = [
            'Margherita Pizza',
            'Chicken Biryani',
            'Beef Burger',
            'Veggie Sandwich',
            'Caesar Salad',
            'Spaghetti Carbonara',
            'Grilled Salmon',
            'Paneer Tikka',
            'Sushi Roll',
            'Tom Yum Soup',
            'Chocolate Lava Cake',
            'Mushroom Risotto',
            'Tandoori Chicken',
            'Falafel Wrap',
            'Fish and Chips',
            'Pancakes with Maple Syrup'
        ];

        // Generate random cost
        $cost = $this->faker->randomFloat(2, 1, 10); // e.g., $1 to $10

        // Suggested price with random markup between 30% to 80%
        $markupPercent = $this->faker->numberBetween(30, 80);
        $suggestedPrice = round($cost * (1 + $markupPercent / 100), 2);
        $profitMargin = round(($suggestedPrice - $cost) / $suggestedPrice * 100, 2);

        return [
            'business_id' => Business::inRandomOrder()->first()->id ?? 1,
            'name' => $this->faker->randomElement($dishes),
            'description' => $this->faker->sentence,
        ];
    }
}
