<x-admin-layout title="Add Entry — Revenue">

@push('styles')
<style>
.form-card { max-width:560px; margin:0 auto; }
.type-toggle { display:flex; gap:.5rem; margin-bottom:1.2rem; }
.type-btn { flex:1; padding:.75rem; border-radius:9px; border:2px solid #e2e8f0; background:#fff; cursor:pointer; font-family:inherit; font-size:.95rem; font-weight:600; color:#64748b; transition:all .2s; }
.type-btn.rev.selected { border-color:#10b981; background:#d1fae5; color:#065f46; }
.type-btn.exp.selected { border-color:#ef4444; background:#fee2e2; color:#991b1b; }
textarea { width:100%; padding:.6rem .9rem; border:1px solid #d1d5db; border-radius:7px; font-size:.9rem; font-family:inherit; outline:none; resize:vertical; min-height:70px; }
textarea:focus { border-color:#2d6a9f; box-shadow:0 0 0 3px rgba(45,106,159,.12); }
</style>
@endpush

<div class="form-card">
    <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem;">
        <a href="{{ route('admin.revenue.index') }}" class="btn btn-secondary btn-sm">← Back</a>
        <h1 class="page-title" style="margin:0;">Add New Entry</h1>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('admin.revenue.store') }}" id="entry-form">
            @csrf

            {{-- Type Toggle --}}
            <div class="form-group">
                <label>Entry Type</label>
                <div class="type-toggle">
                    <button type="button" class="type-btn rev {{ old('type', $defaultType) === 'revenue' ? 'selected' : '' }}"
                            onclick="setType('revenue')">💵 Revenue (Money In)</button>
                    <button type="button" class="type-btn exp {{ old('type', $defaultType) === 'expense' ? 'selected' : '' }}"
                            onclick="setType('expense')">💸 Expense (Money Out)</button>
                </div>
                <input type="hidden" name="type" id="type-input" value="{{ old('type', $defaultType) }}">
                @error('type') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            {{-- Category --}}
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" required>
                    <option value="">— Select category —</option>
                    <optgroup label="Revenue Categories" id="rev-group">
                        @foreach($revCats as $cat)
                            <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </optgroup>
                    <optgroup label="Expense Categories" id="exp-group">
                        @foreach($expCats as $cat)
                            <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </optgroup>
                </select>
                @error('category') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            {{-- Amount --}}
            <div class="form-group">
                <label for="amount">Amount (DZD)</label>
                <input type="number" name="amount" id="amount" min="0.01" max="99999999.99" step="0.01"
                       placeholder="0.00" value="{{ old('amount') }}" required>
                @error('amount') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            {{-- Date --}}
            <div class="form-group">
                <label for="entry_date">Date</label>
                <input type="date" name="entry_date" id="entry_date"
                       value="{{ old('entry_date', today()->toDateString()) }}" required>
                @error('entry_date') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            {{-- Description --}}
            <div class="form-group">
                <label for="description">Description <span style="color:#94a3b8;font-weight:400;">(optional)</span></label>
                <textarea name="description" id="description" placeholder="Brief note...">{{ old('description') }}</textarea>
                @error('description') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;padding:.75rem;font-size:1rem;">
                Save Entry
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
const revCats = @json($revCats);
const expCats = @json($expCats);

function setType(type) {
    document.getElementById('type-input').value = type;

    document.querySelectorAll('.type-btn').forEach(b => {
        b.classList.remove('selected');
    });
    document.querySelector('.type-btn.' + (type === 'revenue' ? 'rev' : 'exp')).classList.add('selected');

    // Rebuild category select
    const sel = document.getElementById('category');
    const cats = type === 'revenue' ? revCats : expCats;
    sel.innerHTML = '<option value="">— Select category —</option>';
    cats.forEach(c => {
        const opt = document.createElement('option');
        opt.value = c; opt.textContent = c;
        sel.appendChild(opt);
    });
}

// Init on load
setType(document.getElementById('type-input').value);
// Restore old value if present
const oldCat = "{{ old('category') }}";
if (oldCat) {
    const sel = document.getElementById('category');
    [...sel.options].forEach(o => { if(o.value === oldCat) o.selected = true; });
}
</script>
@endpush

</x-admin-layout>
