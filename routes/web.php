<?php

use App\Http\Controllers\API\PredictionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prediction', [PredictionController::class, 'showPredictionForm']);

Route::post('/predict', [PredictionController::class, 'showPredictionView'])
    ->name('prediction.view');
