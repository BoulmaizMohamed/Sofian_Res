<x-admin-layout title="Edit Room">

<div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem;">
    <a href="{{ route('admin.rooms.show', $room->id) }}" class="btn btn-secondary btn-sm">← Back</a>
    <h1 class="page-title" style="margin:0;">Edit Room: {{ $room->name }}</h1>
</div>

@if($errors->any())
    <div class="alert alert-error">{{ $errors->first() }}</div>
@endif

<div class="card" style="max-width:560px;">
    <form method="POST" action="{{ route('admin.rooms.update', $room->id) }}">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="name">Room Name <span style="color:#dc2626;">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name', $room->name) }}" required>
            @error('name') <p class="error-text">{{ $message }}</p> @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="3" style="width:100%;padding:.65rem .9rem;border:1.5px solid #d1d5db;border-radius:8px;font-size:.9rem;font-family:inherit;resize:vertical;">{{ old('description', $room->description) }}</textarea>
            @error('description') <p class="error-text">{{ $message }}</p> @enderror
        </div>
        <div style="display:flex;gap:.75rem;margin-top:1.2rem;">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('admin.rooms.show', $room->id) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

</x-admin-layout>
