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

        <div style="display:flex;gap:.75rem;margin-top:1.5rem;">
            <button type="submit" class="btn btn-primary">Rename Bed</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

</x-admin-layout>
