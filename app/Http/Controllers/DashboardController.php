<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        $bookingCountsPerDay = DB::table('bookings')
            ->select(DB::raw('DATE(start_date) as booking_date'), DB::raw('count(*) as total'))
            ->groupBy('booking_date')
            ->orderBy('booking_date', 'asc')
            ->get();

        return view('content.dashboard', [
            'title' => 'dashboard',
            'datas' => $bookingCountsPerDay
        ]);
    }
}
