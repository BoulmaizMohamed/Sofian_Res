<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Bed;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminRoomController extends Controller
{
    public function index(): View
    {
        $rooms = Room::withCount(['beds', 'beds as available_beds_count' => function ($q) {
            $q->where('status', 'available');
        }, 'beds as reserved_beds_count' => function ($q) {
            $q->where('status', 'reserved');
        }])->orderBy('name')->get();

        return view('admin.rooms.index', compact('rooms'));
    }

    public function create(): View
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'capacity'    => ['required', 'integer', 'min:1'],
        ]);

        $room = Room::create($data);

        // Auto-create beds if capacity provided
        for ($i = 1; $i <= $room->capacity; $i++) {
            Bed::create([
                'room_id' => $room->id,
                'name'    => 'Bed ' . $i,
                'status'  => 'available',
            ]);
        }

        return redirect()->route('admin.rooms.show', $room->id)
            ->with('success', "Room \"{$room->name}\" created with {$room->capacity} beds.");
    }

    public function show(Room $room): View
    {
        $room->load('beds');
        return view('admin.rooms.show', compact('room'));
    }

    public function edit(Room $room): View
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room): RedirectResponse
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
        ]);

        $room->update($data);

        return redirect()->route('admin.rooms.show', $room->id)
            ->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room): RedirectResponse
    {
        $room->delete(); // cascades to beds
        return redirect()->route('admin.rooms.index')
            ->with('success', "Room \"{$room->name}\" deleted.");
    }
}
