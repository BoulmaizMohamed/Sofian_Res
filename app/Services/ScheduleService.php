<?php

namespace App\Services;

use App\Models\BedBooking;
use Illuminate\Support\Carbon;

class ScheduleService
{
    /**
     * Return all bed bookings for a given month/year, grouped by date.
     */
    public function getMonthlySchedule(int $month, int $year): array
    {
        $start = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $end   = $start->copy()->endOfMonth();

        $bookings = BedBooking::with('bed.room')
            ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->orderBy('date')
            ->get()
            ->groupBy(fn ($b) => $b->date->toDateString());

        $schedule = [];
        foreach ($bookings as $date => $dayBookings) {
            $schedule[$date] = $dayBookings->map(fn ($b) => [
                'id'           => $b->id,
                'client_name'  => $b->client_name,
                'phone_number' => $b->phone_number,
                'national_id'  => $b->national_id,
                'bed_name'     => $b->bed->name ?? 'Unknown',
                'room_name'    => $b->bed->room->name ?? 'Unknown',
            ])->values()->toArray();
        }

        return [
            'month'    => $month,
            'year'     => $year,
            'schedule' => $schedule,
        ];
    }
}
