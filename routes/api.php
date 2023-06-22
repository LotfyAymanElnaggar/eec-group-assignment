<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\PharmacyApiController;

Route::get('products/search', [ProductApiController::class, 'search']);
Route::get('products/{productId}/cheapest-pharmacies', [ProductApiController::class, 'cheapestPharmacies']);
Route::apiResource('products', ProductApiController::class);

Route::apiResource('pharmacies', PharmacyApiController::class);
Route::get('pharmacies/{pharmacyId}/products', [PharmacyApiController::class, 'pharmacyProducts']);
