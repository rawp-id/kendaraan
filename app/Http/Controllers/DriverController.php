<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        return view('driver.index',[
            'title'=>'drivers',
            'drivers'=>Driver::all()
        ]);
        // return Driver::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'license' => 'required|string|max:255'
        ]);

        Driver::create($validated);
        return redirect('/drivers')->with('success', 'New Driver Successfull Saved');
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
            'status' => 'required|in:available,in-service,unavailable',
            'last_service_date' => 'nullable|date'
        ]);

        $driver->update($validated);
        return response()->json($driver);
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect('/drivers')->with('success', 'Delete Driver Successfull');
    }
}

