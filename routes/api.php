<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    // vendor
    Route::post('/vendors', [VendorController::class, 'store']);

    // product
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);
    Route::post('/products/import', [ProductController::class, 'import']);
    Route::get('/trashed-products', [ProductController::class, 'trashed']);
    Route::post('/restore-products/{product}', [ProductController::class, 'restore']);
    Route::post('/force-delete-products/{product}', [ProductController::class, 'forceDelete']);
});
