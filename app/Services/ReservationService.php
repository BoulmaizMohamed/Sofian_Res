<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Validation\ValidationException;

class ReservationService
{
    /**
     * Create a new reservation.
     */
    public function createReservation(array $data): Reservation
    {
        return Reservation::create(array_merge($data, ['status' => 'pending']));
    }

    /**
     * Update the status of a reservation.
     */
    public function updateStatus(int $id, string $status): Reservation
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => $status]);
        return $reservation->fresh();
    }
}
