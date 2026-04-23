<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Models\Room;
use App\Services\ReservationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PublicReservationController extends Controller
{
    public function __construct(private readonly ReservationService $service) {}

    public function create(): View
    {
        return view('public.reserve');
    }

    public function store(StoreReservationRequest $request): RedirectResponse
    {
        $reservation = $this->service->createReservation($request->validated());

        return redirect()->route('reservation.success')
            ->with('reservation', $reservation->toArray());
    }

    public function success(): View
    {
        return view('public.success', [
            'reservation' => session('reservation'),
        ]);
    }
}

