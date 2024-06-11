<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\PartController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/cars', [CarController::class, 'index']);
Route::post('/cars', [CarController::class, 'store']);
Route::get('/cars/{car}', [CarController::class, 'show']);
Route::put('/cars/{car}', [CarController::class, 'update']);
Route::delete('/cars/{car}', [CarController::class, 'destroy']);

Route::get('/parts', [PartController::class, 'index']);
Route::post('/parts', [PartController::class, 'store']);
Route::get('/parts/{part}', [PartController::class, 'show']);
Route::put('/parts/{part}', [PartController::class, 'update']);
Route::delete('/parts/{part}', [PartController::class, 'destroy']);