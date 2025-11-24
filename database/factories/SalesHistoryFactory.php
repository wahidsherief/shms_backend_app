<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SalesHistoryFactory extends Factory
{
    public function definition(): array
    {
        $productId = $this->faker->numberBetween(1, 2);
        $unitsProduced = $this->faker->numberBetween(500, 5000);
        $productionCostPerUnit = $this->faker->randomFloat(2, 5, 20);

        $unitsSold = $this->faker->numberBetween(400, $unitsProduced);
        $sellingPricePerUnit = $this->faker->randomFloat(2, 10, 40);

        $totalProductionCost = $unitsProduced * $productionCostPerUnit;
        $totalRevenue = $unitsSold * $sellingPricePerUnit;

        $additionalCost = $this->faker->randomFloat(2, 1000, 5000);

        $grossProfit = $totalRevenue - $totalProductionCost;
        $netProfit = $grossProfit - $additionalCost;

        return [
            'start_date' => $this->faker->dateTimeBetween('-3 years', '-1 month'),
            'end_date'   => $this->faker->dateTimeBetween('-1 month', 'now'),

            'product_id' => $productId,
            'units_produced' => $unitsProduced,
            'production_cost_per_unit' => $productionCostPerUnit,
            'total_production_cost' => $totalProductionCost,

            'units_sold' => $unitsSold,
            'selling_price_per_unit' => $sellingPricePerUnit,
            'total_revenue' => $totalRevenue,

            'additional_cost' => $additionalCost,

            'gross_profit' => $grossProfit,
            'net_profit' => $netProfit,
        ];
    }
}
