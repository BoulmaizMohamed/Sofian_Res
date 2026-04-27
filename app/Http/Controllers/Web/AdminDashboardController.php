<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\RevenueEntry;
use App\Models\Room;
use Illuminate\View\View;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $selectedDate = $request->query('date', today()->toDateString());

        $stats = [
            'total'     => Reservation::count(),
            'pending'   => Reservation::where('status', 'pending')->count(),
            'confirmed' => Reservation::where('status', 'confirmed')->count(),
            'cancelled' => Reservation::where('status', 'cancelled')->count(),
            'today'     => Reservation::where('date', today()->toDateString())->count(),
        ];

        $recent = Reservation::orderBy('created_at', 'desc')->take(5)->get();

        // Eager load beds and only their bookings for the selected date
        $rooms = Room::with(['beds.bookings' => function ($query) use ($selectedDate) {
            $query->where('date', $selectedDate);
        }])->orderBy('name')->get();

        // ── Revenue summary (standalone — reads only from revenue_entries) ──
        $revenueStats = [
            // Today
            'today_revenue' => RevenueEntry::revenues()->forDate(today()->toDateString())->sum('amount'),
            'today_expense' => RevenueEntry::expenses()->forDate(today()->toDateString())->sum('amount'),
            // This month
            'month_revenue' => RevenueEntry::revenues()->forMonth(now()->year, now()->month)->sum('amount'),
            'month_expense' => RevenueEntry::expenses()->forMonth(now()->year, now()->month)->sum('amount'),
            // This year
            'year_revenue'  => RevenueEntry::revenues()->forYear(now()->year)->sum('amount'),
            'year_expense'  => RevenueEntry::expenses()->forYear(now()->year)->sum('amount'),
        ];
        $revenueStats['today_net'] = $revenueStats['today_revenue'] - $revenueStats['today_expense'];
        $revenueStats['month_net'] = $revenueStats['month_revenue'] - $revenueStats['month_expense'];
        $revenueStats['year_net']  = $revenueStats['year_revenue']  - $revenueStats['year_expense'];

        return view('admin.dashboard', compact('stats', 'recent', 'rooms', 'selectedDate', 'revenueStats'));
    }
}

