<x-admin-layout title="Edit Reservation #{{ $reservation->id }}">

<div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem;">
    <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary btn-sm">← Back</a>
    <h1 class="page-title" style="margin:0;">Edit Reservation #{{ $reservation->id }}</h1>
</div>

@if($errors->any())
    <div class="alert alert-error">{{ $errors->first() }}</div>
@endif

<div class="card" style="max-width:620px;">
    {{-- Info summary --}}
    <table style="margin-bottom:1.5rem;">
        <tr><th style="width:130px;color:#64748b;font-weight:500;border-bottom:1px solid #f1f5f9;">Name</th><td>{{ $reservation->full_name }}</td></tr>
        <tr><th style="color:#64748b;font-weight:500;border-bottom:1px solid #f1f5f9;">Phone</th><td>{{ $reservation->phone_number }}</td></tr>
        <tr><th style="color:#64748b;font-weight:500;border-bottom:1px solid #f1f5f9;">Beds Req.</th><td>{{ $reservation->num_beds }}</td></tr>
        <tr><th style="color:#64748b;font-weight:500;border-bottom:1px solid #f1f5f9;">Date</th><td>{{ $reservation->date->format('d M Y') }}</td></tr>
        <tr><th style="color:#64748b;font-weight:500;">Current Status</th><td><span class="badge badge-{{ $reservation->status }}">{{ ucfirst($reservation->status) }}</span></td></tr>
    </table>

    <form method="POST" action="{{ route('admin.reservations.update', $reservation->id) }}">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="status">Update Status</label>
            <select name="status" id="status">
                <option value="pending"   @selected($reservation->status === 'pending')>⏳ Pending</option>
                <option value="confirmed" @selected($reservation->status === 'confirmed')>✅ Confirmed</option>
                <option value="cancelled" @selected($reservation->status === 'cancelled')>❌ Cancelled</option>
            </select>
            @error('status') <p class="error-text">{{ $message }}</p> @enderror
        </div>
        <div style="display:flex;gap:.75rem;margin-top:1.2rem;">
            <button type="submit" class="btn btn-primary">Update Status</button>
            <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

</x-admin-layout>
