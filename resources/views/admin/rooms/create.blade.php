<x-admin-layout title="Create Room">

<div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem;">
    <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary btn-sm">← Back</a>
    <h1 class="page-title" style="margin:0;">Create New Room</h1>
</div>

@if($errors->any())
    <div class="alert alert-error">{{ $errors->first() }}</div>
@endif

<div class="card" style="max-width:560px;">
    <form method="POST" action="{{ route('admin.rooms.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Room Name <span style="color:#dc2626;">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. VIP Room, Section A" required>
            @error('name') <p class="error-text">{{ $message }}</p> @enderror
        </div>
        <div class="form-group">
            <label for="description">Description (optional)</label>
            <textarea id="description" name="description" rows="3" placeholder="Brief description of this room..." style="width:100%;padding:.65rem .9rem;border:1.5px solid #d1d5db;border-radius:8px;font-size:.9rem;font-family:inherit;resize:vertical;">{{ old('description') }}</textarea>
            @error('description') <p class="error-text">{{ $message }}</p> @enderror
        </div>
        <div class="form-group">
            <label for="capacity">Number of Beds to Auto-Create <span style="color:#dc2626;">*</span></label>
            <input type="number" id="capacity" name="capacity" value="{{ old('capacity', 10) }}" min="1" max="200" required>
            <p style="font-size:.78rem;color:#94a3b8;margin-top:.3rem;">Beds will be auto-named "Bed 1", "Bed 2", etc. You can rename them later.</p>
            @error('capacity') <p class="error-text">{{ $message }}</p> @enderror
        </div>
        <div style="display:flex;gap:.75rem;margin-top:1.2rem;">
            <button type="submit" class="btn btn-primary">Create Room</button>
            <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

</x-admin-layout>
