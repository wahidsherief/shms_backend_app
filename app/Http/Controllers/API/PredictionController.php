<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\AiService;

class PredictionController extends Controller
{
    protected $ai;

    public function __construct(AiService $aiService)
    {
        $this->ai = $aiService;
    }

    public function showPredictionForm()
    {
        $products = Product::all();
        return view('prediction_form', compact('products'));
    }

    public function generate(Request $request)
    {
        $productId = $request->product_id;

        $product = Product::with(['components', 'salesHistories'])->findOrFail($productId);

        // 1️⃣ Total cost from components
        $totalCost = $product->components->sum(fn($c) => $c->quantity * $c->purchase_cost);

        // 2️⃣ Historical averages
        $history = $product->salesHistories;
        $avgUnitsSold = $history->avg('units_sold') ?? 0;
        $avgSellingPrice = $history->avg('selling_price_per_unit') ?? round($totalCost * 1.6, 2);
        $avgUnitCost = $history->avg('production_cost_per_unit') ?? $totalCost;

        // 3️⃣ Forecast values (simple moving average)
        $forecastUnitsSold = round($avgUnitsSold * 1.05); // small growth assumption
        $forecastUnitCost = round($avgUnitCost, 2);
        $forecastSellingPrice = round($avgSellingPrice, 2);

        $forecastRevenue = round($forecastUnitsSold * $forecastSellingPrice, 2);
        $forecastProfit = round(($forecastSellingPrice - $forecastUnitCost) * $forecastUnitsSold, 2);
        $costPercentage = $forecastSellingPrice != 0 ? round(($forecastUnitCost / $forecastSellingPrice) * 100, 2) : 0;
        $profitMargin = $forecastRevenue != 0 ? round(($forecastProfit / $forecastRevenue) * 100, 2) : 0;
        $idealSellingPrice = round($forecastUnitCost * 1.6, 2);

        // 4️⃣ Generate AI menu description and recommendation
        $componentsList = $product->components->pluck('name')->implode(', ');
        $prompt = "Analyze the following product: {$product->name} with ingredients {$componentsList}, 
            historical average units sold {$avgUnitsSold}, average unit cost {$avgUnitCost}, 
            and average selling price {$avgSellingPrice}. 
            Give a forecast for next month: predicted units sold, ideal price, profit margin,
            cost-saving suggestions, and a professional menu description.";

        $aiText = $this->ai->generateText($prompt, 150);

        // 5️⃣ Return as array (or save to DB if needed)
        $prediction = [
            'product' => $product->name,
            'forecast_units_sold' => $forecastUnitsSold,
            'forecast_unit_cost' => $forecastUnitCost,
            'forecast_selling_price' => $forecastSellingPrice,
            'forecast_revenue' => $forecastRevenue,
            'forecast_profit' => $forecastProfit,
            'cost_percentage' => $costPercentage,
            'profit_margin' => $profitMargin,
            'ideal_selling_price' => $idealSellingPrice,
            'ai_generated_text' => $aiText,
            'cost_saving_suggestion' => 'Check expensive ingredients and optimize portions.',
        ];

        return response()->json($prediction);
    }

    public function showPredictionView(Request $request)
    {
        // Call the existing generate method internally
        $response = $this->generate($request);

        // Get prediction array from JSON response
        $prediction = $response->getData(true);

        // Return to Blade view
        return view('predictions', compact('prediction'));
    }
}
