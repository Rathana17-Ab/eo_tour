<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\TourManagement;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTours = TourManagement::count();
        $totalBookings = Booking::count();
        $totalIncome = Booking::sum('total_price');
        return view('dashboard.index', compact('totalTours', 'totalBookings', 'totalIncome'));
    }
}
