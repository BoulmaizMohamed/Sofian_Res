<x-admin-layout title="Reservation #{{ $reservation->id }}">

<div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem;">
    <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary btn-sm">← Back</a>
    <h1 class="page-title" style="margin:0;">Reservation #{{ $reservation->id }}</h1>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;">

    {{-- Details card --}}
    <div class="card">
        <h2 style="font-size:1rem;font-weight:600;color:#475569;margin-bottom:1rem;">Reservation Details</h2>
        <table>
            <tr><th style="width:140px;color:#64748b;font-weight:500;border-bottom:1px solid #f1f5f9;">Full Name</th><td>{{ $reservation->full_name }}</td></tr>
            <tr><th style="color:#64748b;font-weight:500;border-bottom:1px solid #f1f5f9;">Phone</th><td>{{ $reservation->phone_number }}</td></tr>
            <tr><th style="color:#64748b;font-weight:500;border-bottom:1px solid #f1f5f9;">Type</th><td>{{ ucfirst($reservation->reservation_type) }}</td></tr>
            <tr><th style="color:#64748b;font-weight:500;border-bottom:1px solid #f1f5f9;">Beds Requested</th><td>{{ $reservation->num_beds }}</td></tr>
            <tr><th style="color:#64748b;font-weight:500;border-bottom:1px solid #f1f5f9;">Date</th><td>{{ $reservation->date->format('d M Y') }}</td></tr>
            @if($reservation->notes)
            <tr><th style="color:#64748b;font-weight:500;border-bottom:1px solid #f1f5f9;">Notes</th><td>{{ $reservation->notes }}</td></tr>
            @endif
            <tr><th style="color:#64748b;font-weight:500;border-bottom:1px solid #f1f5f9;">Status</th><td><span class="badge badge-{{ $reservation->status }}">{{ ucfirst($reservation->status) }}</span></td></tr>
            <tr><th style="color:#64748b;font-weight:500;">Created</th><td>{{ $reservation->created_at->format('d M Y H:i') }}</td></tr>
        </table>
    </div>

    {{-- Update status card --}}
    <div class="card">
        <h2 style="font-size:1rem;font-weight:600;color:#475569;margin-bottom:1rem;">Update Status</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.reservations.update', $reservation->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="pending"   @selected($reservation->status === 'pending')>⏳ Pending</option>
                    <option value="confirmed" @selected($reservation->status === 'confirmed')>✅ Confirmed</option>
                    <option value="cancelled" @selected($reservation->status === 'cancelled')>❌ Cancelled</option>
                </select>
                @error('status') <p class="error-text">{{ $message }}</p> @enderror
            </div>
            <div style="display:flex;gap:.75rem;margin-top:1rem;">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.reservations.edit', $reservation->id) }}" class="btn btn-secondary">Edit Form</a>
            </div>
        </form>
    </div>

</div>

</x-admin-layout>
