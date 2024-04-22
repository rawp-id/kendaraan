<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Approval;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    public function index()
    {
        return view('approved.index', [
            'title' => 'approvals',
            'bookings' => Booking::with(['user', 'vehicle', 'driver'])->get(),
            'approvals' => Approval::with('booking')
                ->when(request('date'), function ($query) {
                    $query->where(DB::raw('date(approved_at)'), '=', request('date'));
                })
                ->orderBy('approved_at', 'desc')
                ->get()
        ]);
        // return Approval::with('booking')->get();
    }

    public function check()
    {
        return view('check.index', [
            'title' => 'check',
            'bookings' => Booking::with(['user', 'vehicle', 'driver'])->get(),
            'approvals' => Approval::with('booking')->get()
        ]);
        // return Approval::with('booking')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'status' => 'required|in:pending,approved,rejected',
            'approved_at' => 'nullable|date'
        ]);

        $approval = Approval::create($validated);
        return redirect('/approvals')->with('success', 'Successfully approved');
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
