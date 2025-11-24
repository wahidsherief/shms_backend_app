<?php

use App\Http\Controllers\API\ComponentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PredictionController;
use App\Http\Controllers\API\ProductController;

// group in v1 prefix
Route::prefix('v1')->group(function () {
    Route::get('test', function () {
        return response()->json(['message' => 'API is working']);
    });
    // get all ptoducts
    Route::get('/components', [ComponentController::class, 'index']);
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/product/{id}/predict', [PredictionController::class, 'generate']);
});