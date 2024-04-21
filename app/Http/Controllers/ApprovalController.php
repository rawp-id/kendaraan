<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Approval;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function index()
    {
        return Approval::with('booking')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'level' => 'required|integer|min:1',
            'status' => 'required|in:pending,approved,rejected',
            'approved_at' => 'nullable|date'
        ]);

        $approval = Approval::create($validated);
        return response()->json($approval, 201);
    }

    public function show(Approval $approval)
    {
        return $approval->load('booking');
    }

    public function update(Request $request, Approval $approval)
    {
        $validated = $request->validate([
            'booking_id' => 'exists:bookings,id',
            'level' => 'integer|min:1',
            'status' => 'in:pending,approved,rejected',
            'approved_at' => 'nullable|date'
        ]);

        $approval->update($validated);
        return response()->json($approval);
    }

    public function destroy(Approval $approval)
    {
        $approval->delete();
        return response()->json(null, 204);
    }
}
