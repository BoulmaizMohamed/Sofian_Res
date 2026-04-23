<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Services\ReservationService;
use App\Http\Requests\UpdateReservationStatusRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminReservationController extends Controller
{
    public function __construct(private readonly ReservationService $service) {}

    public function index(): View
    {
        $reservations = Reservation::orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.reservations.index', compact('reservations'));
    }

    public function show(int $id): View
    {
        $reservation = Reservation::findOrFail($id);
        return view('admin.reservations.show', compact('reservation'));
    }

    public function edit(int $id): View
    {
        $reservation = Reservation::findOrFail($id);
        return view('admin.reservations.edit', compact('reservation'));
    }

    public function update(UpdateReservationStatusRequest $request, int $id): RedirectResponse
    {
        $this->service->updateStatus($id, $request->validated('status'));
        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reservation status updated successfully.');
    }
}
