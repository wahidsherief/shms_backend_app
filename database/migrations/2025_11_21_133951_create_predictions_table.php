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
        Schema::create('predictions', function (Blueprint $table) {
            $table->id();

            // Link to product
            $table->foreignId('product_id')->constrained()->onDelete('cascade');

            // Prediction month (for which month the forecast is done)
            $table->string('prediction_month')->nullable(); // e.g., "January 2025"

            // ===== FORECASTED NUMBERS =====
            $table->integer('forecast_units_sold')->nullable();
            $table->decimal('forecast_unit_cost', 10, 2)->nullable();
            $table->decimal('forecast_selling_price', 10, 2)->nullable();
            $table->decimal('forecast_revenue', 12, 2)->nullable();
            $table->decimal('forecast_profit', 12, 2)->nullable();

            // ===== CALCULATED METRICS =====
            $table->decimal('cost_percentage', 5, 2)->nullable();   // (unit_cost / price) × 100
            $table->decimal('profit_margin', 5, 2)->nullable();     // (profit/unit ÷ price) × 100
            $table->decimal('ideal_selling_price', 10, 2)->nullable(); // optional AI suggestion

            // ===== AI OUTPUTS =====
            $table->text('ai_summary')->nullable();          // e.g., "Sales expected to rise 15%"
            $table->text('ai_recommendation')->nullable();   // e.g., "Increase price to 320 BDT"
            $table->text('ai_menu_description')->nullable(); // e.g., "Delicious chicken biryani..."

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predictions');
    }
};
