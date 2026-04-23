<x-admin-layout title="Rooms">

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
    <h1 class="page-title" style="margin:0;">Rooms</h1>
    <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">+ Add Room</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($rooms->isEmpty())
    <div class="card" style="text-align:center;color:#94a3b8;padding:3rem;">
        No rooms yet. <a href="{{ route('admin.rooms.create') }}">Create your first room →</a>
    </div>
@else
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.5rem;">
    @foreach($rooms as $room)
    <div class="card" style="position:relative;">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:.75rem;">
            <div>
                <h3 style="font-size:1.1rem;font-weight:700;color:#1e3a5f;">{{ $room->name }}</h3>
                @if($room->description)
                    <p style="font-size:.82rem;color:#64748b;margin-top:.2rem;">{{ $room->description }}</p>
                @endif
            </div>
            <span style="font-size:.75rem;color:#94a3b8;white-space:nowrap;">{{ $room->beds_count }} bed(s)</span>
        </div>



        <div style="display:flex;gap:.5rem;">
            <a href="{{ route('admin.rooms.show', $room->id) }}"  class="btn btn-primary btn-sm">Manage</a>
            <a href="{{ route('admin.rooms.edit', $room->id) }}"  class="btn btn-secondary btn-sm">Edit</a>
            <form method="POST" action="{{ route('admin.rooms.destroy', $room->id) }}" onsubmit="return confirm('Delete room {{ addslashes($room->name) }} and all its beds?');" style="margin:0;">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm" style="background:#fee2e2;color:#991b1b;">Delete</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endif

</x-admin-layout>
