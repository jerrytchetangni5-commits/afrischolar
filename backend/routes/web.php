<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reset-password/{token}', function ($token) {
    return redirect('http://localhost:4200/reset-password/' . $token);
})->name('password.reset');