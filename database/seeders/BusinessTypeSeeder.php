<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BusinessType;

class BusinessTypeSeeder extends Seeder
{
    public function run()
    {
        BusinessType::factory()->count(3)->create(); // Restaurant, Hotel, Real Estate
    }
}
