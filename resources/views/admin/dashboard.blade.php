<x-admin-layout title="Dashboard">

<h1 class="page-title">Dashboard</h1>

<div class="stat-grid">
    <div class="stat-card">
        <div class="value">{{ $stats['total'] }}</div>
        <div class="label">Total Reservations</div>
    </div>
    <div class="stat-card">
        <div class="value" style="color:#d97706;">{{ $stats['pending'] }}</div>
        <div class="label">Pending</div>
    </div>
    <div class="stat-card">
        <div class="value" style="color:#059669;">{{ $stats['confirmed'] }}</div>
        <div class="label">Confirmed</div>
    </div>
    <div class="stat-card">
        <div class="value" style="color:#dc2626;">{{ $stats['cancelled'] }}</div>
        <div class="label">Cancelled</div>
    </div>
    <div class="stat-card">
        <div class="value" style="color:#7c3aed;">{{ $stats['today'] }}</div>
        <div class="label">Today's Bookings</div>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr;gap:1.5rem;margin-bottom:1.5rem;">
    {{-- Rooms Map --}}
    <div class="card" style="margin:0;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
            <h2 style="font-size:1.1rem;font-weight:600;color:#1e3a5f;margin:0;">Rooms & Beds Map</h2>
            
            <form method="GET" action="{{ route('admin.dashboard') }}" style="display:flex;align-items:center;gap:.5rem;">
                <label for="date" style="font-size:.85rem;color:#64748b;margin:0;">Date:</label>
                <input type="date" name="date" id="date" value="{{ $selectedDate }}" onchange="this.form.submit()" style="padding:.3rem .5rem;font-size:.85rem;width:140px;">
            </form>
        </div>
        
        @if($rooms->isEmpty())
            <div style="text-align:center;padding:2rem;color:#94a3b8;">No rooms created yet.</div>
        @else
            <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(300px, 1fr));gap:1rem;">
                @foreach($rooms as $room)
                <div style="border:1px solid #e2e8f0;border-radius:10px;padding:1rem;">
                    <div style="display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #f1f5f9;padding-bottom:.5rem;margin-bottom:.75rem;">
                        <strong style="color:#334155;">{{ $room->name }}</strong>
                        <span style="font-size:.75rem;color:#64748b;">{{ $room->beds->count() }} beds</span>
                    </div>
                    @if($room->beds->isEmpty())
                        <div style="font-size:.8rem;color:#94a3b8;text-align:center;">Empty</div>
                    @else
                        <div style="display:flex;flex-wrap:wrap;gap:.4rem;">
                            @foreach($room->beds as $bed)
                                @php 
                                    $isOccupied = $bed->bookings->isNotEmpty();
                                    $booking = $isOccupied ? $bed->bookings->first() : null;
                                @endphp
                                @if($isOccupied)
                                    <a href="{{ route('admin.bed-bookings.edit', $booking->id) }}" 
                                       title="Reserved by {{ $booking->client_name }} - Click to edit" 
                                       style="font-size:.7rem;padding:.2rem .4rem;border-radius:4px;cursor:pointer;text-decoration:none;background:#fee2e2;color:#991b1b;border:1px solid #ef4444;">
                                        {{ $bed->name }}
                                    </a>
                                @else
                                    <a href="{{ route('admin.bed-bookings.create', ['bed_id' => $bed->id, 'date' => $selectedDate]) }}" title="{{ $bed->name }} (Available) - Click to assign client" 
                                         style="font-size:.7rem;padding:.2rem .4rem;border-radius:4px;cursor:pointer;text-decoration:none;background:#d1fae5;color:#065f46;border:1px solid #10b981;">
                                        {{ $bed->name }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
            <div style="display:flex;justify-content:space-between;margin-top:1rem;">
                <div style="display:flex;gap:1rem;font-size:.75rem;">
                    <div style="display:flex;align-items:center;gap:.3rem;">
                        <div style="width:12px;height:12px;background:#d1fae5;border:1px solid #10b981;border-radius:2px;"></div> Available
                    </div>
                    <div style="display:flex;align-items:center;gap:.3rem;">
                        <div style="width:12px;height:12px;background:#fee2e2;border:1px solid #ef4444;border-radius:2px;"></div> Reserved
                    </div>
                </div>
                <a href="{{ route('admin.rooms.index') }}" style="font-size:.8rem;color:#2d6a9f;text-decoration:none;">Manage Rooms & Beds →</a>
            </div>
        @endif
    </div>
</div>

<div class="card">
    <h2 style="font-size:1rem;font-weight:600;margin-bottom:1rem;color:#475569;">Recent Reservations</h2>
    <table>
        <thead>
            <tr>
                <th>#</th><th>Name</th><th>Beds Req.</th><th>Date</th><th>Type</th><th>Status</th><th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($recent as $r)
            <tr>
                <td>{{ $r->id }}</td>
                <td>{{ $r->full_name }}</td>
                <td>{{ $r->num_beds }}</td>
                <td>{{ $r->date->format('d M Y') }}</td>
                <td>{{ ucfirst($r->reservation_type) }}</td>
                <td><span class="badge badge-{{ $r->status }}">{{ ucfirst($r->status) }}</span></td>
                <td>
                    <a href="{{ route('admin.reservations.show', $r->id) }}" class="btn btn-secondary btn-sm">View</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" style="text-align:center;color:#94a3b8;padding:2rem;">No reservations yet.</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($stats['total'] > 5)
    <div style="margin-top:1rem;">
        <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary btn-sm">View All Reservations →</a>
    </div>
    @endif
</div>

</x-admin-layout>
