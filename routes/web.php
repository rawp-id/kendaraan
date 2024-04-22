<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', function () {
//     return view('layout.app');
// });

Route::get('/dashboard', function () {
    return view('content.dashboard', [
        'title' => 'dashboard'
    ]);
});

Route::Resource('vehicles', VehicleController::class);
Route::Resource('drivers', DriverController::class);
Route::Resource('bookings', BookingController::class);
Route::get('bookings/status/{booking:id}', [BookingController::class, 'status']);
Route::get('check', [ApprovalController::class, 'check']);
Route::Resource('approvals', ApprovalController::class);

Route::get('login',[AuthController::class, 'showLoginForm']);
Route::post('login',[AuthController::class, 'login']);
Route::get('register',[AuthController::class, 'showRegistrationForm']);
Route::post('register',[AuthController::class, 'register']);
Route::get('logout',[AuthController::class, 'logout']);