<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductPrediction;

class ProductPredictionSeeder extends Seeder
{
    public function run()
    {
        ProductPrediction::factory()->count(10)->create(); // 1 per product
    }
}