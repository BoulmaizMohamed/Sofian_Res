<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Bed;
use App\Models\BedBooking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminBedBookingController extends Controller
{
    public function create(Request $request): View
    {
        $bedId = $request->query('bed_id');
        $date = $request->query('date', today()->toDateString());

        $bed = Bed::with('room')->findOrFail($bedId);

        return view('admin.bed_bookings.create', compact('bed', 'date'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'bed_id'       => ['required', 'exists:beds,id'],
            'date'         => ['required', 'date'],
            'client_name'  => ['required', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:50'],
            'national_id'  => ['nullable', 'string', 'max:50'],
        ]);

        // Prevent double booking
        if (BedBooking::where('bed_id', $data['bed_id'])->where('date', $data['date'])->exists()) {
            return back()->withInput()->withErrors(['date' => 'This bed is already booked on this date.']);
        }

        BedBooking::create($data);

        return redirect()->route('admin.dashboard', ['date' => $data['date']])
            ->with('success', 'Bed assigned successfully.');
    }

    public function edit(BedBooking $booking): View
    {
        $booking->load('bed.room');
        return view('admin.bed_bookings.edit', compact('booking'));
    }

    public function update(Request $request, BedBooking $booking): RedirectResponse
    {
        $data = $request->validate([
            'client_name'  => ['required', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:50'],
            'national_id'  => ['nullable', 'string', 'max:50'],
            'date'         => ['required', 'date'],
        ]);

        // Prevent double booking if date changed
        if ($data['date'] !== $booking->date->toDateString() && BedBooking::where('bed_id', $booking->bed_id)->where('date', $data['date'])->exists()) {
            return back()->withInput()->withErrors(['date' => 'This bed is already booked on the new date.']);
        }

        $booking->update($data);

        return redirect()->route('admin.dashboard', ['date' => $booking->date->toDateString()])
            ->with('success', 'Booking updated successfully.');
    }

    public function destroy(BedBooking $booking): RedirectResponse
    {
        $date = $booking->date->toDateString();
        $booking->delete();

        return redirect()->route('admin.dashboard', ['date' => $date])
            ->with('success', 'Booking removed. Bed is now available.');
    }
}
