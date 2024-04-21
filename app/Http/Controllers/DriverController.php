<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        return Driver::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'license' => 'required|string|max:255',
            'status' => 'required|in:available,in service,unavailable',
            'last_service_date' => 'nullable|date'
        ]);

        $driver = Driver::create($validated);
        return response()->json($driver, 201);
    }

    public function show(Driver $driver)
    {
        return $driver;
    }

    public function update(Request $request, Driver $driver)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'license' => 'required|string|max:255',
            'status' => 'required|in:available,in service,unavailable',
            'last_service_date' => 'nullable|date'
        ]);

        $driver->update($validated);
        return response()->json($driver);
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return response()->json(null, 204);
    }
}

