<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total'     => Reservation::count(),
            'pending'   => Reservation::where('status', 'pending')->count(),
            'confirmed' => Reservation::where('status', 'confirmed')->count(),
            'cancelled' => Reservation::where('status', 'cancelled')->count(),
            'today'     => Reservation::where('date', today()->toDateString())->count(),
        ];

        $recent = Reservation::with('room')->orderBy('created_at', 'desc')->take(5)->get();
        $rooms  = Room::with('beds')->orderBy('name')->get();

        return view('admin.dashboard', compact('stats', 'recent', 'rooms'));
    }
}

