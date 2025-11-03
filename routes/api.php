<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderItemController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\CategoryController;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
});

// Public product routes
Route::get('products', [ProductController::class, 'index']);
Route::get('products/{id}', [ProductController::class, 'show']);

//products
Route::middleware(['auth:sanctum', 'admin'])->prefix('products')->group(function () {
    Route::post('/', [ProductController::class, 'store']);
    Route::put('{id}', [ProductController::class, 'update']);
    Route::delete('{id}', [ProductController::class, 'destroy']);
    Route::post('{id}/restore', [ProductController::class, 'restore']);
    Route::get('{id}/edit', [ProductController::class, 'edit']);
});


Route::middleware(['auth:sanctum'])->prefix('orders')->group(function () {
    Route::post('/', [OrderController::class, 'store']);
    Route::get('/user/{userId}', [OrderController::class, 'userOrders']);
});

//order
Route::middleware(['auth:sanctum', 'admin'])->prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::get('/status/{status}', [OrderController::class, 'ByStatus']);
    Route::get('/{id}', [OrderController::class, 'show']);
});

// orderItem
Route::middleware(['auth:sanctum'])->prefix('order-items')->group(function () {
    Route::post('/', [OrderItemController::class, 'store']);
    Route::get('/order/{orderId}', [OrderItemController::class, 'getItemsByOrder']);
    Route::get('/product/{productId}', [OrderItemController::class, 'getItemByProduct']);
    Route::get('/user/{userId}', [OrderItemController::class, 'getItemsByUser']);
});
//category
Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{id}', [CategoryController::class, 'show']);
Route::middleware(['auth:sanctum', 'admin'])->prefix('categories')->group(function () {
    Route::post('/', [CategoryController::class, 'store']);
    Route::put('{id}', [CategoryController::class, 'update']);
    Route::delete('{id}', [CategoryController::class, 'destroy']);
});
