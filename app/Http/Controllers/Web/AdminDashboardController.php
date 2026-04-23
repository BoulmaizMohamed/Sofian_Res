<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
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

        return view('admin.dashboard', compact('stats', 'recent', 'rooms', 'selectedDate'));
    }
}

