<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Services\ReservationService;
use Illuminate\Http\JsonResponse;

class ReservationController extends Controller
{
    public function __construct(private readonly ReservationService $service) {}

    /**
     * POST /api/reservations
     * Create a new reservation (public — no auth required).
     */
    public function store(StoreReservationRequest $request): JsonResponse
    {
        $reservation = $this->service->createReservation($request->validated());

        return response()->json([
            'message'     => 'Reservation created successfully.',
            'reservation' => $reservation,
        ], 201);
    }
}
