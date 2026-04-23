<x-admin-layout title="Add Bed to {{ $room->name }}">

<div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem;">
    <a href="{{ route('admin.rooms.show', $room->id) }}" class="btn btn-secondary btn-sm">← Back</a>
    <h1 class="page-title" style="margin:0;">Add Bed to {{ $room->name }}</h1>
</div>

@if($errors->any())
    <div class="alert alert-error">{{ $errors->first() }}</div>
@endif

<div class="card" style="max-width:560px;">
    <form method="POST" action="{{ route('admin.beds.store', $room->id) }}">
        @csrf
        <div class="form-group">
            <label for="name">Bed Name/Identifier <span style="color:#dc2626;">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Bed 12, Window Bed, A4" required autofocus>
            @error('name') <p class="error-text">{{ $message }}</p> @enderror
        </div>
        <p style="font-size:.8rem;color:#64748b;margin-bottom:1rem;">New beds are created as <strong>Available</strong> by default.</p>
        
        <div style="display:flex;gap:.75rem;margin-top:1.2rem;">
            <button type="submit" class="btn btn-primary">Add Bed</button>
            <a href="{{ route('admin.rooms.show', $room->id) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

</x-admin-layout>
