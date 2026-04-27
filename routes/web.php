<?php

use App\Http\Controllers\Web\AdminAuthController;
use App\Http\Controllers\Web\AdminBedController;
use App\Http\Controllers\Web\AdminDashboardController;
use App\Http\Controllers\Web\AdminReservationController;
use App\Http\Controllers\Web\AdminRoomController;
use App\Http\Controllers\Web\AdminScheduleController;
use App\Http\Controllers\Web\AdminRevenueController;
use App\Http\Controllers\Web\AdminRevenueCategoryController;
use App\Http\Controllers\Web\PublicReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes — No login required
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => redirect()->route('reservation.create'));

Route::get('/reserve',         [PublicReservationController::class, 'create'])->name('reservation.create');
Route::post('/reserve',        [PublicReservationController::class, 'store'])->name('reservation.store');
Route::get('/reserve/success', [PublicReservationController::class, 'success'])->name('reservation.success');

/*
|--------------------------------------------------------------------------
| Admin Auth — Guest only
|--------------------------------------------------------------------------
*/

Route::middleware('guest:admin_web')->prefix('admin')->group(function () {
    Route::get('/login',  [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
});

/*
|--------------------------------------------------------------------------
| Admin Panel — Session authentication required
|--------------------------------------------------------------------------
*/

Route::middleware('admin.web.auth')->prefix('admin')->group(function () {

    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Reservations
    Route::get('/reservations',           [AdminReservationController::class, 'index'])->name('admin.reservations.index');
    Route::get('/reservations/{id}',      [AdminReservationController::class, 'show'])->name('admin.reservations.show');
    Route::get('/reservations/{id}/edit', [AdminReservationController::class, 'edit'])->name('admin.reservations.edit');
    Route::patch('/reservations/{id}',    [AdminReservationController::class, 'update'])->name('admin.reservations.update');

    // Schedule
    Route::get('/schedule', [AdminScheduleController::class, 'index'])->name('admin.schedule');

    // Rooms CRUD
    Route::get('/rooms',                [AdminRoomController::class, 'index'])->name('admin.rooms.index');
    Route::get('/rooms/create',         [AdminRoomController::class, 'create'])->name('admin.rooms.create');
    Route::post('/rooms',               [AdminRoomController::class, 'store'])->name('admin.rooms.store');
    Route::get('/rooms/{room}',         [AdminRoomController::class, 'show'])->name('admin.rooms.show');
    Route::get('/rooms/{room}/edit',    [AdminRoomController::class, 'edit'])->name('admin.rooms.edit');
    Route::patch('/rooms/{room}',       [AdminRoomController::class, 'update'])->name('admin.rooms.update');
    Route::delete('/rooms/{room}',      [AdminRoomController::class, 'destroy'])->name('admin.rooms.destroy');

    // Beds CRUD (nested under rooms)
    Route::get('/rooms/{room}/beds/create',   [AdminBedController::class, 'create'])->name('admin.beds.create');
    Route::post('/rooms/{room}/beds',         [AdminBedController::class, 'store'])->name('admin.beds.store');
    Route::get('/rooms/{room}/beds/{bed}/edit',   [AdminBedController::class, 'edit'])->name('admin.beds.edit');
    Route::patch('/rooms/{room}/beds/{bed}',      [AdminBedController::class, 'update'])->name('admin.beds.update');
    Route::delete('/rooms/{room}/beds/{bed}',     [AdminBedController::class, 'destroy'])->name('admin.beds.destroy');
    // Bed Bookings (Manual assignments)
    Route::get('/bed-bookings/create',            [\App\Http\Controllers\Web\AdminBedBookingController::class, 'create'])->name('admin.bed-bookings.create');
    Route::post('/bed-bookings',                  [\App\Http\Controllers\Web\AdminBedBookingController::class, 'store'])->name('admin.bed-bookings.store');
    Route::get('/bed-bookings/{booking}/edit',    [\App\Http\Controllers\Web\AdminBedBookingController::class, 'edit'])->name('admin.bed-bookings.edit');
    Route::patch('/bed-bookings/{booking}',       [\App\Http\Controllers\Web\AdminBedBookingController::class, 'update'])->name('admin.bed-bookings.update');
    Route::delete('/bed-bookings/{booking}',      [\App\Http\Controllers\Web\AdminBedBookingController::class, 'destroy'])->name('admin.bed-bookings.destroy');

    // Revenue Management (standalone — no link to any other table)
    Route::get('/revenue',                [AdminRevenueController::class, 'index'])->name('admin.revenue.index');
    Route::get('/revenue/create',         [AdminRevenueController::class, 'create'])->name('admin.revenue.create');
    Route::post('/revenue',               [AdminRevenueController::class, 'store'])->name('admin.revenue.store');
    Route::get('/revenue/{entry}/edit',   [AdminRevenueController::class, 'edit'])->name('admin.revenue.edit');
    Route::patch('/revenue/{entry}',      [AdminRevenueController::class, 'update'])->name('admin.revenue.update');
    Route::delete('/revenue/{entry}',     [AdminRevenueController::class, 'destroy'])->name('admin.revenue.destroy');

    // Revenue Categories
    Route::get('/revenue/categories',               [AdminRevenueCategoryController::class, 'index'])->name('admin.revenue.categories');
    Route::post('/revenue/categories',              [AdminRevenueCategoryController::class, 'store'])->name('admin.revenue.categories.store');
    Route::patch('/revenue/categories/{category}',  [AdminRevenueCategoryController::class, 'update'])->name('admin.revenue.categories.update');
    Route::delete('/revenue/categories/{category}', [AdminRevenueCategoryController::class, 'destroy'])->name('admin.revenue.categories.destroy');
});
