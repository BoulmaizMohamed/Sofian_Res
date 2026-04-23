<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\ScheduleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function __construct(private readonly ScheduleService $service) {}

    /**
     * GET /api/admin/schedule?month=MM&year=YYYY
     * Return all reservations grouped by date for a given month.
     */
    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'month' => ['required', 'integer', 'between:1,12'],
            'year'  => ['required', 'integer', 'min:2020', 'max:2100'],
        ]);

        $schedule = $this->service->getMonthlySchedule(
            (int) $request->query('month'),
            (int) $request->query('year'),
        );

        return response()->json($schedule);
    }
}
