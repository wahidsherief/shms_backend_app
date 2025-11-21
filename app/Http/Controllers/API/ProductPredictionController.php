<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductPrediction;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Http;

class ProductPredictionController extends Controller
{
    public function generate(Request $request, $productId)
    {
        $product = Product::with('components')->findOrFail($productId);
        // logger($product->components);

        // 1️⃣ Calculate total cost
        $totalCost = $product->components->sum(fn($c) => $c->quantity * $c->purchase_cost);
        $product->cost = $totalCost;
            // logger($totalCost);
        // 2️⃣ Suggested price (markup 60%)
        $sellingPrice = round($totalCost * 1.6, 2);
        $profitMargin = round(($sellingPrice - $totalCost)/$sellingPrice*100, 2);
        $costPercentage = round(($totalCost / $sellingPrice)*100, 2);
        // logger($costPercentage);
        // 3️⃣ AI-generated description
        $componentsList = $product->components->pluck('name')->implode(', ');
        
        $prompt = "Write a professional description for {$product->name} made with {$componentsList}.";

          // 3️⃣ AI-generated description
        $componentsList = $product->components->pluck('name')->implode(', ');
        $prompt = "Write a professional menu description for Chicken Biriyani made with Lemon.";

        try {
            $aiResponse = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt]
                ],
                'max_tokens' => 50,
            ]);

            $generatedText = $aiResponse->choices[0]->message->content ?? 'Description unavailable';

        } catch (\OpenAI\Exceptions\RateLimitException $e) {
            logger("OpenAI rate limit exceeded: " . $e->getMessage());
            $generatedText = "Description temporarily unavailable due to rate limit.";
        } catch (\Exception $e) {
            logger("OpenAI error: " . $e->getMessage());
            $generatedText = "Description temporarily unavailable due to an API error.";
        }

        // 4️⃣ Save prediction
        $prediction = ProductPrediction::updateOrCreate(
            ['product_id' => $product->id],
            [
                'food_cost_percentage' => $costPercentage,
                'selling_price' => $sellingPrice,
                'profit_margin' => $profitMargin,
                'cost_saving_suggestion' => 'Optimize component quantities for cost efficiency.',
                'ai_generated_text' => $generatedText,
            ]
        );

        // $product->save();
        logger($prediction);
        return response()->json($prediction);
    }
}
