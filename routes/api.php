<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\PharmacyApiController;

Route::apiResource('products', ProductApiController::class);
Route::get('products/{productId}/cheapest-pharmacies', [ProductApiController::class, 'cheapestPharmacies']);

Route::apiResource('pharmacies', PharmacyApiController::class);
Route::get('pharmacies/{pharmacyId}/products', [PharmacyApiController::class, 'pharmacyProducts']);
