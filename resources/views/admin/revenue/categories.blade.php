<x-admin-layout title="Revenue Categories">

@push('styles')
<style>
/* ── Category Page Styles ─────────────────────────── */
.cat-layout { display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; }
@media(max-width:760px){ .cat-layout{ grid-template-columns:1fr; } }

.cat-section-header {
    display:flex; align-items:center; gap:.65rem;
    padding:.9rem 1.2rem;
    border-radius:10px 10px 0 0;
    font-size:.95rem; font-weight:700; color:#fff;
    margin-bottom:0;
}
.cat-section-header.income-hdr  { background:linear-gradient(135deg,#059669,#10b981); }
.cat-section-header.expense-hdr { background:linear-gradient(135deg,#dc2626,#ef4444); }

.cat-box { border:1px solid #e2e8f0; border-radius:12px; overflow:hidden; }
.cat-list { list-style:none; margin:0; padding:0; }
.cat-item {
    display:flex; align-items:center; gap:.6rem;
    padding:.65rem 1rem;
    border-bottom:1px solid #f1f5f9;
    font-size:.9rem;
}
.cat-item:last-child { border-bottom:none; }
.cat-item .cat-name { flex:1; font-weight:500; color:#1e3a5f; }
.cat-item .badge-default { font-size:.68rem; background:#eff6ff; color:#3b82f6; border-radius:9999px; padding:.15rem .55rem; font-weight:600; }

/* Inline edit form (hidden by default) */
.edit-form { display:none; flex:1; gap:.4rem; align-items:center; }
.edit-form.visible { display:flex; }
.edit-form input { flex:1; padding:.3rem .6rem; font-size:.85rem; border:1px solid #2d6a9f; border-radius:6px; outline:none; }
.cat-name-text { flex:1; }
.cat-name-text.hidden { display:none; }

/* Add form inside the box */
.cat-add-form { display:flex; gap:.5rem; padding:.85rem 1rem; background:#f8fafc; border-top:1px solid #e2e8f0; }
.cat-add-form input { flex:1; padding:.45rem .8rem; font-size:.875rem; border:1px solid #d1d5db; border-radius:7px; outline:none; font-family:inherit; }
.cat-add-form input:focus { border-color:#2d6a9f; box-shadow:0 0 0 3px rgba(45,106,159,.1); }

/* Action buttons */
.btn-edit-cat { background:none; border:none; cursor:pointer; font-size:.8rem; color:#2d6a9f; font-family:inherit; padding:.2rem .5rem; border-radius:5px; }
.btn-edit-cat:hover { background:#eff6ff; }
.btn-del-cat { background:none; border:none; cursor:pointer; font-size:.8rem; color:#dc2626; font-family:inherit; padding:.2rem .5rem; border-radius:5px; }
.btn-del-cat:hover { background:#fee2e2; }
.btn-save-cat { background:#2d6a9f; color:#fff; border:none; cursor:pointer; font-size:.8rem; border-radius:5px; padding:.28rem .7rem; font-family:inherit; }
.btn-cancel-edit { background:#f1f5f9; color:#475569; border:none; cursor:pointer; font-size:.8rem; border-radius:5px; padding:.28rem .7rem; font-family:inherit; }
.btn-add-cat { background:linear-gradient(135deg,#059669,#10b981); color:#fff; border:none; cursor:pointer; font-size:.85rem; font-weight:600; border-radius:7px; padding:.45rem 1rem; font-family:inherit; white-space:nowrap; }
.btn-add-cat.expense-btn { background:linear-gradient(135deg,#dc2626,#ef4444); }
</style>
@endpush

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:.75rem;">
    <div style="display:flex;align-items:center;gap:1rem;">
        <a href="{{ route('admin.revenue.index') }}" class="btn btn-secondary btn-sm">← Back to Revenue</a>
        <h1 class="page-title" style="margin:0;">🏷️ Manage Categories</h1>
    </div>
</div>

{{-- Flash messages --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-error">{{ session('error') }}</div>
@endif

<p style="color:#64748b;font-size:.9rem;margin-bottom:1.5rem;">
    Create and manage custom categories for your revenue and expense entries.
    Default categories are marked with <span style="background:#eff6ff;color:#3b82f6;border-radius:9999px;padding:.1rem .5rem;font-size:.75rem;font-weight:600;">default</span> and can still be deleted if unused.
</p>

<div class="cat-layout">

    {{-- ── Revenue Categories ─────────────────────── --}}
    <div>
        <div class="cat-box">
            <div class="cat-section-header income-hdr">
                💵 Revenue Categories
                <span style="margin-left:auto;font-size:.8rem;opacity:.85;font-weight:500;">{{ $revenues->count() }} categories</span>
            </div>

            <ul class="cat-list">
                @forelse($revenues as $cat)
                <li class="cat-item" id="cat-row-{{ $cat->id }}">

                    {{-- Normal display --}}
                    <span class="cat-name-text" id="cat-text-{{ $cat->id }}">
                        <span class="cat-name">{{ $cat->name }}</span>
                        @if($cat->is_default)
                            <span class="badge-default">default</span>
                        @endif
                    </span>

                    {{-- Inline edit form --}}
                    <form method="POST" action="{{ route('admin.revenue.categories.update', $cat) }}"
                          class="edit-form" id="edit-form-{{ $cat->id }}">
                        @csrf @method('PATCH')
                        <input type="text" name="name" value="{{ $cat->name }}" required maxlength="100">
                        <button type="submit" class="btn-save-cat">Save</button>
                        <button type="button" class="btn-cancel-edit"
                                onclick="cancelEdit({{ $cat->id }})">Cancel</button>
                    </form>

                    {{-- Action buttons (visible when not editing) --}}
                    <span id="cat-actions-{{ $cat->id }}">
                        <button class="btn-edit-cat" onclick="startEdit({{ $cat->id }})">✏️ Edit</button>
                        <form method="POST" action="{{ route('admin.revenue.categories.destroy', $cat) }}"
                              style="display:inline" onsubmit="return confirm('Delete category \'{{ $cat->name }}\'?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-del-cat">🗑 Delete</button>
                        </form>
                    </span>

                </li>
                @empty
                <li class="cat-item" style="color:#94a3b8;font-size:.85rem;">No revenue categories yet.</li>
                @endforelse
            </ul>

            {{-- Add new revenue category --}}
            <form method="POST" action="{{ route('admin.revenue.categories.store') }}" class="cat-add-form">
                @csrf
                <input type="hidden" name="type" value="revenue">
                <input type="text" name="name" placeholder="New revenue category..." required maxlength="100"
                       id="rev-name-input">
                <button type="submit" class="btn-add-cat">+ Add</button>
            </form>
        </div>

        @error('name')
            <div class="error-text" style="margin-top:.4rem;">{{ $message }}</div>
        @enderror
    </div>

    {{-- ── Expense Categories ──────────────────────── --}}
    <div>
        <div class="cat-box">
            <div class="cat-section-header expense-hdr">
                💸 Expense Categories
                <span style="margin-left:auto;font-size:.8rem;opacity:.85;font-weight:500;">{{ $expenses->count() }} categories</span>
            </div>

            <ul class="cat-list">
                @forelse($expenses as $cat)
                <li class="cat-item" id="cat-row-{{ $cat->id }}">

                    <span class="cat-name-text" id="cat-text-{{ $cat->id }}">
                        <span class="cat-name">{{ $cat->name }}</span>
                        @if($cat->is_default)
                            <span class="badge-default">default</span>
                        @endif
                    </span>

                    <form method="POST" action="{{ route('admin.revenue.categories.update', $cat) }}"
                          class="edit-form" id="edit-form-{{ $cat->id }}">
                        @csrf @method('PATCH')
                        <input type="text" name="name" value="{{ $cat->name }}" required maxlength="100">
                        <button type="submit" class="btn-save-cat">Save</button>
                        <button type="button" class="btn-cancel-edit"
                                onclick="cancelEdit({{ $cat->id }})">Cancel</button>
                    </form>

                    <span id="cat-actions-{{ $cat->id }}">
                        <button class="btn-edit-cat" onclick="startEdit({{ $cat->id }})">✏️ Edit</button>
                        <form method="POST" action="{{ route('admin.revenue.categories.destroy', $cat) }}"
                              style="display:inline" onsubmit="return confirm('Delete category \'{{ $cat->name }}\'?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-del-cat">🗑 Delete</button>
                        </form>
                    </span>

                </li>
                @empty
                <li class="cat-item" style="color:#94a3b8;font-size:.85rem;">No expense categories yet.</li>
                @endforelse
            </ul>

            <form method="POST" action="{{ route('admin.revenue.categories.store') }}" class="cat-add-form">
                @csrf
                <input type="hidden" name="type" value="expense">
                <input type="text" name="name" placeholder="New expense category..." required maxlength="100"
                       id="exp-name-input">
                <button type="submit" class="btn-add-cat expense-btn">+ Add</button>
            </form>
        </div>
    </div>

</div>

@push('scripts')
<script>
function startEdit(id) {
    document.getElementById('cat-text-' + id).classList.add('hidden');
    document.getElementById('cat-actions-' + id).style.display = 'none';
    document.getElementById('edit-form-' + id).classList.add('visible');
    document.getElementById('edit-form-' + id).querySelector('input').focus();
}

function cancelEdit(id) {
    document.getElementById('cat-text-' + id).classList.remove('hidden');
    document.getElementById('cat-actions-' + id).style.display = '';
    document.getElementById('edit-form-' + id).classList.remove('visible');
}
</script>
@endpush

</x-admin-layout>
