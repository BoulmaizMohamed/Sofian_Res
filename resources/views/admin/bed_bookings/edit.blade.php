<x-admin-layout title="Edit Booking for {{ $booking->bed->name }}">

<div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem;">
    <a href="{{ route('admin.dashboard', ['date' => $booking->date->toDateString()]) }}" class="btn btn-secondary btn-sm">← Back</a>
    <h1 class="page-title" style="margin:0;">Edit Booking: {{ $booking->bed->name }} ({{ $booking->bed->room->name }})</h1>
</div>

@if($errors->any())
    <div class="alert alert-error">{{ $errors->first() }}</div>
@endif

<div class="card" style="max-width:600px;">
    <form method="POST" action="{{ route('admin.bed-bookings.update', $booking->id) }}">
        @csrf
        @method('PATCH')
        
        <div class="form-group">
            <label for="date">Booking Date <span style="color:#dc2626;">*</span></label>
            <input type="date" id="date" name="date" value="{{ old('date', $booking->date->toDateString()) }}" required>
            @error('date') <p class="error-text">{{ $message }}</p> @enderror
        </div>

        <div style="background:#f8fafc;padding:1.5rem;border-radius:8px;border:1px solid #e2e8f0;margin-top:1.5rem;">
            <h3 style="font-size:.9rem;color:#475569;margin-bottom:1rem;">Client Information</h3>
            
            <div class="form-group">
                <label for="client_name">Client Full Name <span style="color:#dc2626;">*</span></label>
                <input type="text" id="client_name" name="client_name" value="{{ old('client_name', $booking->client_name) }}" required>
                @error('client_name') <p class="error-text">{{ $message }}</p> @enderror
            </div>
            
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div class="form-group" style="margin:0;">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $booking->phone_number) }}">
                    @error('phone_number') <p class="error-text">{{ $message }}</p> @enderror
                </div>
                <div class="form-group" style="margin:0;">
                    <label for="national_id">National ID</label>
                    <input type="text" id="national_id" name="national_id" value="{{ old('national_id', $booking->national_id) }}">
                    @error('national_id') <p class="error-text">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div style="display:flex;justify-content:space-between;margin-top:1.5rem;">
            <div style="display:flex;gap:.75rem;">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.dashboard', ['date' => $booking->date->toDateString()]) }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
    <form method="POST" action="{{ route('admin.bed-bookings.destroy', $booking->id) }}" style="margin-top:-2.4rem;text-align:right;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-secondary" style="background:#fee2e2;color:#991b1b;border-color:#ef4444;" onclick="return confirm('Clear this booking and make the bed available?');">Clear Booking</button>
    </form>
</div>

</x-admin-layout>
