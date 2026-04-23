<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateReservationStatusRequest;
use App\Models\Reservation;
use App\Services\ReservationService;
use Illuminate\Http\JsonResponse;

class ReservationController extends Controller
{
    public function __construct(private readonly ReservationService $service) {}

    /**
     * GET /api/admin/reservations
     * List all reservations, ordered by date desc.
     */
    public function index(): JsonResponse
    {
        $reservations = Reservation::orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'total'        => $reservations->count(),
            'reservations' => $reservations,
        ]);
    }

    /**
     * PATCH /api/admin/reservations/{id}
     * Update a reservation's status.
     */
    public function update(UpdateReservationStatusRequest $request, int $id): JsonResponse
    {
        $reservation = $this->service->updateStatus($id, $request->validated('status'));

        return response()->json([
            'message'     => 'Reservation status updated.',
            'reservation' => $reservation,
        ]);
    }
}
