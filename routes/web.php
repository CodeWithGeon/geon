<?php

use Illuminate\Support\Facades\Route;
//Web controllers handle views, redirects, and sessions.

Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');

Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
Route::view('/products', 'admin.products')->name('products.index');


Route::get('/', function () {
    return redirect('/login');
});
