<x-admin-layout title="All Reservations">

<h1 class="page-title">All Reservations</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card" style="padding:0;overflow:hidden;">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Beds</th>
                <th>Date</th>
                <th>Type</th>
                <th>Status</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $r)
            <tr>
                <td>{{ $r->id }}</td>
                <td>{{ $r->full_name }}</td>
                <td>{{ $r->phone_number }}</td>
                <td>{{ $r->num_beds }}</td>
                <td>{{ $r->date->format('d M Y') }}</td>
                <td>{{ ucfirst($r->reservation_type) }}</td>
                <td><span class="badge badge-{{ $r->status }}">{{ ucfirst($r->status) }}</span></td>
                <td style="color:#94a3b8;font-size:.8rem;">{{ $r->created_at->format('d M Y') }}</td>
                <td style="white-space:nowrap;">
                    <a href="{{ route('admin.reservations.show', $r->id) }}" class="btn btn-secondary btn-sm">View</a>
                    <a href="{{ route('admin.reservations.edit', $r->id) }}" class="btn btn-primary btn-sm">Edit</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" style="text-align:center;padding:3rem;color:#94a3b8;">No reservations found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="display:flex;justify-content:center;">
    {{ $reservations->links() }}
</div>

</x-admin-layout>
