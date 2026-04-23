<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AvailabilityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function __construct(private readonly AvailabilityService $service) {}

    /**
     * GET /api/availability?date=YYYY-MM-DD
     * Return bed availability for a given date.
     */
    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'date' => ['required', 'date_format:Y-m-d'],
        ]);

        $availability = $this->service->getAvailableBeds($request->query('date'));

        return response()->json($availability);
    }
}
