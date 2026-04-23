<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Bed;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminBedController extends Controller
{
    public function create(Room $room): View
    {
        return view('admin.beds.create', compact('room'));
    }

    public function store(Request $request, Room $room): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:50'],
        ]);

        Bed::create([
            'room_id' => $room->id,
            'name'    => $data['name'],
            'status'  => 'available',
        ]);

        // Update room capacity count
        $room->update(['capacity' => $room->beds()->count()]);

        return redirect()->route('admin.rooms.show', $room->id)
            ->with('success', "Bed \"{$data['name']}\" added to {$room->name}.");
    }

    public function edit(Room $room, Bed $bed): View
    {
        return view('admin.beds.edit', compact('room', 'bed'));
    }

    public function update(Request $request, Room $room, Bed $bed): RedirectResponse
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:50'],
            'status'      => ['required', 'in:available,reserved'],
            'client_name' => ['nullable', 'string', 'max:100'],
            'phone_number'=> ['nullable', 'string', 'max:20'],
            'national_id' => ['nullable', 'string', 'max:50'],
        ]);

        // If set to available, clear client info
        if ($data['status'] === 'available') {
            $data['client_name']  = null;
            $data['phone_number'] = null;
            $data['national_id']  = null;
        }

        $bed->update($data);

        return redirect()->route('admin.rooms.show', $room->id)
            ->with('success', "Bed \"{$bed->name}\" updated.");
    }

    public function destroy(Room $room, Bed $bed): RedirectResponse
    {
        $bedName = $bed->name;
        $bed->delete();

        // Update room capacity count
        $room->update(['capacity' => $room->beds()->count()]);

        return redirect()->route('admin.rooms.show', $room->id)
            ->with('success', "Bed \"{$bedName}\" removed.");
    }
}
