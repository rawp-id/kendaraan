<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return Booking::with(['user', 'vehicle', 'driver'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $booking = Booking::create($validated);
        return response()->json($booking, 201);
    }

    public function show(Booking $booking)
    {
        return $booking->load(['user', 'vehicle', 'driver']);
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'user_id' => 'exists:users,id',
            'vehicle_id' => 'exists:vehicles,id',
            'driver_id' => 'exists:drivers,id',
            'start_date' => 'date',
            'end_date' => 'date|after_or_equal:start_date',
            'status' => 'in:pending,approved,rejected'
        ]);

        $booking->update($validated);
        return response()->json($booking);
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return response()->json(null, 204);
    }
}

