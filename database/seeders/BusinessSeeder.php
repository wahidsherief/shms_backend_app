<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Business;

class BusinessSeeder extends Seeder
{
    public function run()
    {
        Business::factory()->count(5)->create(); // 5 sample businesses
    }
}