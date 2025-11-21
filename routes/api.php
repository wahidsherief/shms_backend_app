<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductPredictionController;
use App\Http\Controllers\API\ProductController;

// group in v1 prefix
Route::prefix('v1')->group(function () {
    Route::get('test', function () {
        return response()->json(['message' => 'API is working']);
    });
    // get all ptoducts
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/product/{id}/predict', [ProductPredictionController::class, 'generate']);
});