<x-admin-layout title="Edit Bed {{ $bed->name }}">

<div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem;">
    <a href="{{ route('admin.rooms.show', $room->id) }}" class="btn btn-secondary btn-sm">← Back</a>
    <h1 class="page-title" style="margin:0;">Edit Bed: {{ $bed->name }} ({{ $room->name }})</h1>
</div>

@if($errors->any())
    <div class="alert alert-error">{{ $errors->first() }}</div>
@endif

<div class="card" style="max-width:600px;">
    <form method="POST" action="{{ route('admin.beds.update', [$room->id, $bed->id]) }}">
        @csrf
        @method('PATCH')
        
        <div class="form-group">
            <label for="name">Bed Name <span style="color:#dc2626;">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name', $bed->name) }}" required>
            @error('name') <p class="error-text">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="status">Bed Status <span style="color:#dc2626;">*</span></label>
            <select name="status" id="status" onchange="toggleClientFields(this.value)">
                <option value="available" @selected(old('status', $bed->status) === 'available')>✅ Available</option>
                <option value="reserved" @selected(old('status', $bed->status) === 'reserved')>🔴 Reserved</option>
            </select>
            @error('status') <p class="error-text">{{ $message }}</p> @enderror
        </div>

        <div id="client-fields" style="background:#f8fafc;padding:1.5rem;border-radius:8px;border:1px solid #e2e8f0;margin-top:1.5rem;display:{{ old('status', $bed->status) === 'reserved' ? 'block' : 'none' }};">
            <h3 style="font-size:.9rem;color:#475569;margin-bottom:1rem;">Client Information</h3>
            <p style="font-size:.8rem;color:#94a3b8;margin-bottom:1rem;">If changing status back to Available, these fields will be cleared automatically.</p>
            
            <div class="form-group">
                <label for="client_name">Client Full Name</label>
                <input type="text" id="client_name" name="client_name" value="{{ old('client_name', $bed->client_name) }}">
                @error('client_name') <p class="error-text">{{ $message }}</p> @enderror
            </div>
            
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div class="form-group" style="margin:0;">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $bed->phone_number) }}">
                    @error('phone_number') <p class="error-text">{{ $message }}</p> @enderror
                </div>
                <div class="form-group" style="margin:0;">
                    <label for="national_id">National ID</label>
                    <input type="text" id="national_id" name="national_id" value="{{ old('national_id', $bed->national_id) }}">
                    @error('national_id') <p class="error-text">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div style="display:flex;gap:.75rem;margin-top:1.5rem;">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<script>
function toggleClientFields(status) {
    const fields = document.getElementById('client-fields');
    if (status === 'reserved') {
        fields.style.display = 'block';
    } else {
        fields.style.display = 'none';
    }
}
</script>

</x-admin-layout>
