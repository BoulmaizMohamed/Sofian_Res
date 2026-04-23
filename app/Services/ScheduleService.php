<?php

namespace App\Services;

use App\Models\Reservation;
use Illuminate\Support\Carbon;

class ScheduleService
{
    /**
     * Return all reservations for a given month/year, grouped by date.
     */
    public function getMonthlySchedule(int $month, int $year): array
    {
        $start = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $end   = $start->copy()->endOfMonth();

        $reservations = Reservation::whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->orderBy('date')
            ->orderBy('bed_number')
            ->get()
            ->groupBy(fn ($r) => $r->date->toDateString());

        $schedule = [];
        foreach ($reservations as $date => $dayReservations) {
            $schedule[$date] = $dayReservations->map(fn ($r) => [
                'id'               => $r->id,
                'full_name'        => $r->full_name,
                'phone_number'     => $r->phone_number,
                'reservation_type' => $r->reservation_type,
                'bed_number'       => $r->bed_number,
                'duration'         => $r->duration,
                'status'           => $r->status,
            ])->values()->toArray();
        }

        return [
            'month'    => $month,
            'year'     => $year,
            'schedule' => $schedule,
        ];
    }
}
