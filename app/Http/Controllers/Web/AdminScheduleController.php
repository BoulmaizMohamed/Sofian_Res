<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Services\ScheduleService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminScheduleController extends Controller
{
    public function __construct(private readonly ScheduleService $service) {}

    public function index(Request $request): View
    {
        $month = (int) $request->query('month', now()->month);
        $year  = (int) $request->query('year', now()->year);

        $schedule = $this->service->getMonthlySchedule($month, $year);

        return view('admin.schedule', compact('schedule', 'month', 'year'));
    }
}
