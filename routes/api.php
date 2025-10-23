<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
//API controllers handle JSON responses and status codes.
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
});

Route::get('products', [ProductController::class, 'index']);
Route::get('products/{id}', [ProductController::class, 'show']);


Route::middleware(['auth:sanctum', 'admin'])->prefix('products')->group(function () {
    Route::post('/', [ProductController::class, 'store']);
    Route::put('{id}', [ProductController::class, 'update']);
    Route::delete('{id}', [ProductController::class, 'destroy']);
    Route::post('{id}/restore', [ProductController::class, 'restore']);
    Route::get('{id}/edit', [ProductController::class, 'edit']);
});
