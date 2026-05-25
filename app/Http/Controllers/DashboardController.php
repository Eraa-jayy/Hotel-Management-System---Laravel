<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Guest;
use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Key metrics
        $totalRooms = Room::count();
        $availableRooms = Room::where('is_available', true)->count();
        $occupancyRate = $totalRooms > 0 ? round((($totalRooms - $availableRooms) / $totalRooms) * 100) : 0;
        
        $totalGuests = Guest::count();
        $totalBookings = Booking::count();
        $confirmedBookings = Booking::where('status', 'Confirmed')->count();
        
        $totalRevenue = Booking::sum('total_price');
        
        // Recent bookings
        $recentBookings = Booking::with(['room', 'guest'])->latest()->take(5)->get();
        
        // Bookings this month
        $bookingsThisMonth = Booking::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        // Revenue this month
        $revenueThisMonth = Booking::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_price');
        
        return view('dashboard', compact(
            'totalRooms',
            'availableRooms',
            'occupancyRate',
            'totalGuests',
            'totalBookings',
            'confirmedBookings',
            'totalRevenue',
            'recentBookings',
            'bookingsThisMonth',
            'revenueThisMonth'
        ));
    }
}
