<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        return Vehicle::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'merk' => 'required|string',
            'type' => 'required|string',
            'status' => 'required|in:available,in service,unavailable',
            'number_vehicle' => 'nullable|unique:vehicles',
            'last_service_date' => 'nullable|date',
        ]);

        $vehicle = Vehicle::create($validated);
        return response()->json($vehicle, 201);
    }

    public function show(Vehicle $vehicle)
    {
        return $vehicle;
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'merk' => 'required|string',
            'type' => 'required|string',
            'status' => 'required|in:available,in service,unavailable',
            'number_vehicle' => 'nullable|unique:vehicles,number_vehicle,'.$vehicle->id,
            'last_service_date' => 'nullable|date',
        ]);

        $vehicle->update($validated);
        return response()->json($vehicle);
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return response()->json(null, 204);
    }
}
