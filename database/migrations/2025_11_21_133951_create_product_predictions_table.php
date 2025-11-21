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
        Schema::create('product_predictions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->decimal('cost_percentage',5,2)->nullable();
            $table->decimal('selling_price',10,2)->nullable();
            $table->decimal('profit_margin',5,2)->nullable();
            $table->text('cost_saving_suggestion')->nullable();
            $table->text('ai_generated_text')->nullable(); // menu description / room description
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_predictions');
    }
};
