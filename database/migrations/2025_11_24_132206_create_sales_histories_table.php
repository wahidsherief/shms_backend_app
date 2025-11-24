<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            // Production related
            $table->integer('units_produced');
            $table->decimal('production_cost_per_unit', 10, 2);
            $table->decimal('total_production_cost', 12, 2)->nullable(); // auto calculated

            // Sales related
            $table->integer('units_sold');
            $table->decimal('selling_price_per_unit', 10, 2);
            $table->decimal('total_revenue', 12, 2)->nullable(); // auto calculated

            // Additional cost
            $table->decimal('additional_cost', 12, 2)->default(0);

            // Profit fields
            $table->decimal('gross_profit', 12, 2)->nullable();
            $table->decimal('net_profit', 12, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_histories');
    }
};
