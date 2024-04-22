<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {

        return view('booking.index', [
            'title' => 'bookings',
            'drivers' => Driver::where('status', '=', 'available')->get(),
            'vehicles' => Vehicle::where('status', '=', 'available')->get(),
            'bookings' => Booking::with(['user', 'vehicle', 'driver'])
                ->when(request('date'), function ($query) {
                    $query->where(DB::raw('date(start_date)'), '=', request('date'));
                })
                ->orderBy('start_date', 'desc')
                ->get()
        ]);


        // return Booking::with(['user', 'vehicle', 'driver'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $booking = Booking::create($validated);

        Driver::where('id', $validated['driver_id'])->update([
            'status' => 'service',
            'last_service_date' => now()
        ]);

        Vehicle::where('id', $validated['vehicle_id'])->update([
            'status' => 'service',
            'last_service_date' => now()
        ]);

        return redirect('/bookings')->with('success', 'New Booking Successfully Saved');
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

    public function status(Booking $booking)
    {
        $booking->update([
            'status'=>request('status')
        ]);
        return redirect('/bookings')->with('success', 'Successfully changed status');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return response()->json(null, 204);
    }
}

