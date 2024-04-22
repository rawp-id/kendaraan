<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::apiResource('vehicles', VehicleController::class);
// Route::apiResource('drivers', DriverController::class);
// Route::apiResource('bookings', BookingController::class);
// Route::apiResource('approvals', ApprovalController::class);

