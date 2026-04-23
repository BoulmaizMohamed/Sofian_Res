<x-admin-layout title="Room: {{ $room->name }}">

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
    <div style="display:flex;align-items:center;gap:1rem;">
        <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary btn-sm">← Back</a>
        <h1 class="page-title" style="margin:0;">{{ $room->name }}</h1>
    </div>
    <div style="display:flex;gap:.5rem;">
        <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-secondary btn-sm">Edit Room Info</a>
        <a href="{{ route('admin.beds.create', $room->id) }}" class="btn btn-primary btn-sm">+ Add Bed</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card" style="margin-bottom:1.5rem;">
    <h2 style="font-size:1.1rem;margin-bottom:.5rem;color:#1e3a5f;">Room Details</h2>
    @if($room->description)
        <p style="color:#64748b;font-size:.9rem;margin-bottom:1rem;">{{ $room->description }}</p>
    @endif
    <div style="display:flex;gap:1.5rem;font-size:.9rem;">
        <div><strong>Total Capacity:</strong> {{ $room->capacity }} beds</div>
        <div><strong style="color:#059669;">Available:</strong> {{ $room->available_beds_count }}</div>
        <div><strong style="color:#dc2626;">Reserved:</strong> {{ $room->reserved_beds_count }}</div>
    </div>
</div>

<h2 style="font-size:1.1rem;margin-bottom:1rem;color:#1e3a5f;">Beds Management</h2>

@if($room->beds->isEmpty())
    <div class="card" style="text-align:center;color:#94a3b8;padding:2rem;">
        No beds configured for this room yet.
    </div>
@else
<div class="card" style="padding:0;overflow:hidden;">
    <table>
        <thead>
            <tr>
                <th>Bed Name</th>
                <th>Status</th>
                <th>Client Info</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($room->beds as $bed)
            <tr>
                <td style="font-weight:500;">{{ $bed->name }}</td>
                <td>
                    @if($bed->status === 'available')
                        <span style="background:#d1fae5;color:#065f46;padding:.2rem .6rem;border-radius:9999px;font-size:.75rem;font-weight:600;">Available</span>
                    @else
                        <span style="background:#fee2e2;color:#991b1b;padding:.2rem .6rem;border-radius:9999px;font-size:.75rem;font-weight:600;">Reserved</span>
                    @endif
                </td>
                <td style="color:#64748b;font-size:.85rem;">
                    @if($bed->status === 'reserved' && $bed->client_name)
                        <strong>{{ $bed->client_name }}</strong><br>
                        {{ $bed->phone_number }}<br>
                        {{ $bed->national_id ? 'ID: '.$bed->national_id : '' }}
                    @else
                        <span style="color:#cbd5e1;">—</span>
                    @endif
                </td>
                <td style="text-align:right;white-space:nowrap;">
                    <a href="{{ route('admin.beds.edit', [$room->id, $bed->id]) }}" class="btn btn-secondary btn-sm" style="margin-right:.25rem;">Edit</a>
                    <form method="POST" action="{{ route('admin.beds.destroy', [$room->id, $bed->id]) }}" onsubmit="return confirm('Delete this bed permanently?');" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm" style="background:#fee2e2;color:#991b1b;">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

</x-admin-layout>
