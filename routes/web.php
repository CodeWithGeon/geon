<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;// Import the controller

//Route definitions
// Route::get('/', function () {
//     return redirect('/users/12'); // redirect root to a profile for testing
// });
// Route::get('/', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
