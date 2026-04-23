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
            <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary btn-sm">Manage Rooms</a>
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
                                <a href="{{ route('admin.beds.edit', [$room->id, $bed->id]) }}" 
                                   title="{{ $bed->name }} ({{ ucfirst($bed->status) }}{{ $bed->client_name ? ' - '.$bed->client_name : '' }}) - Click to edit" 
                                     style="font-size:.7rem;padding:.2rem .4rem;border-radius:4px;cursor:pointer;text-decoration:none;
                                            {{ $bed->status === 'available' ? 'background:#d1fae5;color:#065f46;border:1px solid #10b981;' : 'background:#fee2e2;color:#991b1b;border:1px solid #ef4444;' }}">
                                    {{ $bed->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
            <div style="display:flex;gap:1rem;margin-top:1rem;font-size:.75rem;">
                <div style="display:flex;align-items:center;gap:.3rem;">
                    <div style="width:12px;height:12px;background:#d1fae5;border:1px solid #10b981;border-radius:2px;"></div> Available
                </div>
                <div style="display:flex;align-items:center;gap:.3rem;">
                    <div style="width:12px;height:12px;background:#fee2e2;border:1px solid #ef4444;border-radius:2px;"></div> Reserved
                </div>
            </div>
        @endif
    </div>
</div>

<div class="card">
    <h2 style="font-size:1rem;font-weight:600;margin-bottom:1rem;color:#475569;">Recent Reservations</h2>
    <table>
        <thead>
            <tr>
                <th>#</th><th>Name</th><th>Beds Req.</th><th>Room</th><th>Date</th><th>Type</th><th>Status</th><th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($recent as $r)
            <tr>
                <td>{{ $r->id }}</td>
                <td>{{ $r->full_name }}</td>
                <td>{{ $r->num_beds }}</td>
                <td>{{ $r->room ? $r->room->name : 'Any' }}</td>
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
