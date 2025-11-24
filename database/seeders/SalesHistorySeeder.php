<?php

namespace Database\Seeders;

use App\Models\SalesHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalesHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SalesHistory::factory()->count(50)->create();
    }
}
