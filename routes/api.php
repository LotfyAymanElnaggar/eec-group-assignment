<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\PharmacyApiController;

Route::get('products/search', [ProductApiController::class, 'search']);
Route::get('products/{productId}/cheapest-pharmacies', [ProductApiController::class, 'cheapestPharmacies']);
Route::apiResource('products', ProductApiController::class)->name('index', 'api.products');

Route::apiResource('pharmacies', PharmacyApiController::class);
Route::get('pharmacies/{pharmacyId}/products', [PharmacyApiController::class, 'pharmacyProducts']);
Route::post('pharmacies/{pharmacyId}/attach-product', [PharmacyApiController::class, 'attachProduct'])->name('pharmacy.attachProduct');