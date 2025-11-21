<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Component;

class ComponentSeeder extends Seeder
{
    public function run()
    {
        Component::factory()->count(30)->create(); // 3 per product on average
    }
}