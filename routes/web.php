<?php

use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('layout.app');
});

Route::get('/dashboard', function () {
    return view('content.dashboard');
});