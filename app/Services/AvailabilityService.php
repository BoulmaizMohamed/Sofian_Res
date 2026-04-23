<?php

namespace App\Services;

use App\Models\Bed;
use App\Models\Reservation;

class AvailabilityService
{
    /**
     * Return all beds that are NOT reserved (pending or confirmed) on a given date.
     */
    public function getAvailableBeds(string $date): array
    {
        $reservedBedNumbers = Reservation::where('date', $date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->pluck('bed_number')
            ->toArray();

        $availableBeds = Bed::whereNotIn('number', $reservedBedNumbers)
            ->orderBy('number')
            ->get()
            ->map(fn ($bed) => [
                'bed_number'  => $bed->number,
                'status'      => 'available',
            ]);

        $reservedBeds = Bed::whereIn('number', $reservedBedNumbers)
            ->orderBy('number')
            ->get()
            ->map(fn ($bed) => [
                'bed_number'  => $bed->number,
                'status'      => 'reserved',
            ]);

        return [
            'date'            => $date,
            'total_beds'      => Bed::count(),
            'available_count' => $availableBeds->count(),
            'reserved_count'  => $reservedBeds->count(),
            'beds'            => $availableBeds->merge($reservedBeds)->sortBy('bed_number')->values()->toArray(),
        ];
    }
}
