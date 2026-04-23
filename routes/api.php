<?php

use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Api\Admin\ScheduleController;
use App\Http\Controllers\Api\AvailabilityController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Middleware\AdminAuthenticated;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public API Routes (No Authentication Required)
|--------------------------------------------------------------------------
*/

// POST /api/reservations — Create a reservation
Route::post('/reservations', [ReservationController::class, 'store']);

// GET /api/availability?date=YYYY-MM-DD — Get bed availability for a date
Route::get('/availability', [AvailabilityController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Admin API Routes (JWT Authentication Required)
|--------------------------------------------------------------------------
*/

// Auth endpoints (public)
Route::prefix('admin')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    // Protected admin routes
    Route::middleware(AdminAuthenticated::class)->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);

        // Reservations management
        Route::get('/reservations', [AdminReservationController::class, 'index']);
        Route::patch('/reservations/{id}', [AdminReservationController::class, 'update']);

        // Schedule / calendar
        Route::get('/schedule', [ScheduleController::class, 'index']);
    });
});
