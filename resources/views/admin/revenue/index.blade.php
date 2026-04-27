<x-admin-layout title="Revenue Management">

@push('styles')
<style>
/* ── Revenue Module Styles ─────────────────────────────────────── */
.rev-hero { display:grid; grid-template-columns:repeat(3,1fr); gap:1.2rem; margin-bottom:1.8rem; }
@media(max-width:700px){ .rev-hero{ grid-template-columns:1fr; } }

.rev-card {
    border-radius:14px;
    padding:1.4rem 1.6rem;
    color:#fff;
    display:flex; flex-direction:column; gap:.3rem;
    box-shadow:0 4px 18px rgba(0,0,0,.12);
    position:relative; overflow:hidden;
}
.rev-card::after {
    content:''; position:absolute; right:-20px; top:-20px;
    width:120px; height:120px; border-radius:50%;
    background:rgba(255,255,255,.08);
}
.rev-card.income  { background:linear-gradient(135deg,#059669,#10b981); }
.rev-card.expense { background:linear-gradient(135deg,#dc2626,#ef4444); }
.rev-card.net-pos { background:linear-gradient(135deg,#1e3a5f,#2d6a9f); }
.rev-card.net-neg { background:linear-gradient(135deg,#7c3aed,#a855f7); }

.rev-card .rc-label { font-size:.8rem; opacity:.85; font-weight:500; letter-spacing:.4px; text-transform:uppercase; }
.rev-card .rc-amount { font-size:1.9rem; font-weight:800; letter-spacing:-.5px; }
.rev-card .rc-sub { font-size:.75rem; opacity:.75; }

/* Period tabs */
.period-tabs { display:flex; gap:.4rem; background:#f1f5f9; border-radius:10px; padding:.3rem; margin-bottom:1.5rem; width:fit-content; }
.period-tab { padding:.4rem 1.1rem; border-radius:7px; font-size:.85rem; font-weight:500; color:#64748b; cursor:pointer; text-decoration:none; transition:all .15s; border:none; background:transparent; font-family:inherit; }
.period-tab.active { background:#fff; color:#1e3a5f; box-shadow:0 1px 4px rgba(0,0,0,.1); }

/* Type filter pills */
.type-pills { display:flex; gap:.5rem; margin-bottom:1rem; flex-wrap:wrap; }
.type-pill { padding:.3rem .9rem; border-radius:9999px; font-size:.8rem; font-weight:600; cursor:pointer; text-decoration:none; border:none; font-family:inherit; transition:all .15s; }
.type-pill.all     { background:#e2e8f0; color:#475569; }
.type-pill.revenue { background:#d1fae5; color:#065f46; }
.type-pill.expense { background:#fee2e2; color:#991b1b; }
.type-pill.active  { box-shadow:0 0 0 2px currentColor; }

/* Action buttons row */
.rev-actions { display:flex; gap:.75rem; margin-bottom:1.5rem; flex-wrap:wrap; }
.btn-income  { background:linear-gradient(135deg,#059669,#10b981); color:#fff; }
.btn-income:hover { background:linear-gradient(135deg,#047857,#059669); color:#fff; }
.btn-outgo   { background:linear-gradient(135deg,#dc2626,#ef4444); color:#fff; }
.btn-outgo:hover { background:linear-gradient(135deg,#b91c1c,#dc2626); color:#fff; }

/* Date input inline */
.date-row { display:flex; align-items:center; gap:.6rem; flex-wrap:wrap; margin-bottom:1.5rem; }
.date-row label { font-size:.85rem; color:#64748b; margin:0; font-weight:500; white-space:nowrap; }
.date-row input, .date-row select { width:auto; padding:.35rem .7rem; font-size:.85rem; }

/* Badge */
.badge-rev { background:#d1fae5; color:#065f46; }
.badge-exp { background:#fee2e2; color:#991b1b; }

/* Amount cell */
.amount-rev { color:#059669; font-weight:700; }
.amount-exp { color:#dc2626; font-weight:700; }

/* Pagination */
.pagination { display:flex; gap:.4rem; justify-content:center; margin-top:1.2rem; flex-wrap:wrap; }
.pagination a, .pagination span { padding:.35rem .75rem; border-radius:6px; font-size:.8rem; border:1px solid #e2e8f0; text-decoration:none; color:#475569; }
.pagination .active span { background:#2d6a9f; color:#fff; border-color:#2d6a9f; }
.pagination a:hover { background:#f1f5f9; }

/* Delete form inline */
.del-form { display:inline; }
</style>
@endpush

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:.75rem;">
    <h1 class="page-title" style="margin:0;">💰 Revenue Management</h1>
    <div class="rev-actions" style="margin:0;">
        <a href="{{ route('admin.revenue.categories') }}" class="btn btn-secondary">🏷️ Categories</a>
        <a href="{{ route('admin.revenue.create', ['type'=>'revenue']) }}" class="btn btn-income">+ Add Revenue</a>
        <a href="{{ route('admin.revenue.create', ['type'=>'expense']) }}" class="btn btn-outgo">+ Add Expense</a>
    </div>
</div>

{{-- Flash messages --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- Summary Cards (selected period) --}}
<div class="rev-hero">
    <div class="rev-card income">
        <div class="rc-label">💵 Money In</div>
        <div class="rc-amount">{{ number_format($totalRevenue, 2) }} <span style="font-size:1rem;font-weight:500;">DZD</span></div>
        <div class="rc-sub">{{ ucfirst($period) }} Revenue</div>
    </div>
    <div class="rev-card expense">
        <div class="rc-label">💸 Money Out</div>
        <div class="rc-amount">{{ number_format($totalExpense, 2) }} <span style="font-size:1rem;font-weight:500;">DZD</span></div>
        <div class="rc-sub">{{ ucfirst($period) }} Expenses</div>
    </div>
    @php $isPositive = $netBalance >= 0; @endphp
    <div class="rev-card {{ $isPositive ? 'net-pos' : 'net-neg' }}">
        <div class="rc-label">{{ $isPositive ? '📈' : '📉' }} Net Balance</div>
        <div class="rc-amount">{{ $isPositive ? '+' : '' }}{{ number_format($netBalance, 2) }} <span style="font-size:1rem;font-weight:500;">DZD</span></div>
        <div class="rc-sub">{{ ucfirst($period) }} Net</div>
    </div>
</div>

{{-- Filters Row --}}
<div class="card" style="padding:1.2rem 1.4rem;">

    {{-- Period Tabs --}}
    <div style="display:flex;align-items:center;gap:1.5rem;flex-wrap:wrap;">
        <div class="period-tabs">
            <a href="{{ route('admin.revenue.index', ['period'=>'daily',   'date'=>$date, 'type'=>$type]) }}"
               class="period-tab {{ $period==='daily'   ? 'active' : '' }}">Day</a>
            <a href="{{ route('admin.revenue.index', ['period'=>'monthly', 'date'=>$date, 'type'=>$type]) }}"
               class="period-tab {{ $period==='monthly' ? 'active' : '' }}">Month</a>
            <a href="{{ route('admin.revenue.index', ['period'=>'yearly',  'date'=>$date, 'type'=>$type]) }}"
               class="period-tab {{ $period==='yearly'  ? 'active' : '' }}">Year</a>
        </div>

        {{-- Date Picker --}}
        <form method="GET" action="{{ route('admin.revenue.index') }}" class="date-row">
            <input type="hidden" name="period" value="{{ $period }}">
            <input type="hidden" name="type"   value="{{ $type }}">
            @if($period === 'daily')
                <label>Date:</label>
                <input type="date" name="date" value="{{ $date }}" onchange="this.form.submit()" style="width:150px;">
            @elseif($period === 'monthly')
                <label>Month:</label>
                <input type="month" name="date" value="{{ substr($date,0,7) }}" onchange="this.form.submit()" style="width:150px;">
            @else
                <label>Year:</label>
                <select name="date" onchange="this.form.submit()" style="width:120px;">
                    @foreach(range(date('Y'), date('Y')-5) as $y)
                        <option value="{{ $y }}-01-01" {{ str_starts_with($date, (string)$y) ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            @endif
        </form>

        {{-- Type Pills --}}
        <div class="type-pills">
            <a href="{{ route('admin.revenue.index', ['period'=>$period, 'date'=>$date, 'type'=>'all']) }}"
               class="type-pill all {{ $type==='all' ? 'active' : '' }}">All</a>
            <a href="{{ route('admin.revenue.index', ['period'=>$period, 'date'=>$date, 'type'=>'revenue']) }}"
               class="type-pill revenue {{ $type==='revenue' ? 'active' : '' }}">Revenue</a>
            <a href="{{ route('admin.revenue.index', ['period'=>$period, 'date'=>$date, 'type'=>'expense']) }}"
               class="type-pill expense {{ $type==='expense' ? 'active' : '' }}">Expense</a>
        </div>
    </div>
</div>

{{-- Entries Table --}}
<div class="card" style="padding:0;overflow:hidden;">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Type</th>
                <th>Category</th>
                <th>Description</th>
                <th>Date</th>
                <th style="text-align:right;">Amount (DZD)</th>
                <th style="text-align:center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($entries as $entry)
            <tr>
                <td style="color:#94a3b8;font-size:.8rem;">{{ $entry->id }}</td>
                <td>
                    <span class="badge {{ $entry->type === 'revenue' ? 'badge-rev' : 'badge-exp' }}">
                        {{ $entry->type === 'revenue' ? '💵 Revenue' : '💸 Expense' }}
                    </span>
                </td>
                <td>{{ $entry->category }}</td>
                <td style="color:#64748b;font-size:.85rem;">{{ $entry->description ?? '—' }}</td>
                <td style="font-size:.85rem;">{{ $entry->entry_date->format('d M Y') }}</td>
                <td style="text-align:right;" class="{{ $entry->type === 'revenue' ? 'amount-rev' : 'amount-exp' }}">
                    {{ $entry->type === 'revenue' ? '+' : '-' }}{{ number_format($entry->amount, 2) }}
                </td>
                <td style="text-align:center;white-space:nowrap;">
                    <a href="{{ route('admin.revenue.edit', $entry) }}" class="btn btn-secondary btn-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.revenue.destroy', $entry) }}" class="del-form"
                          onsubmit="return confirm('Delete this entry?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm" style="background:#fee2e2;color:#991b1b;">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;color:#94a3b8;padding:3rem;">
                    No entries found for this period.
                    <br><br>
                    <a href="{{ route('admin.revenue.create', ['type'=>'revenue']) }}" class="btn btn-income btn-sm">Add first revenue</a>
                    &nbsp;
                    <a href="{{ route('admin.revenue.create', ['type'=>'expense']) }}" class="btn btn-outgo btn-sm">Add first expense</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($entries->hasPages())
        <div class="pagination" style="padding:1rem;">
            {{ $entries->links() }}
        </div>
    @endif
</div>

{{-- All-Time Summary Footer --}}
<div class="card" style="padding:1rem 1.5rem;background:linear-gradient(135deg,#1e3a5f,#2d6a9f);color:#fff;">
    <div style="font-size:.8rem;opacity:.8;margin-bottom:.5rem;text-transform:uppercase;font-weight:600;letter-spacing:.4px;">All-Time Summary</div>
    <div style="display:flex;gap:2.5rem;flex-wrap:wrap;">
        <div><div style="font-size:1.3rem;font-weight:700;">{{ number_format($overallRevenue, 2) }} DZD</div><div style="font-size:.75rem;opacity:.75;">Total Revenue</div></div>
        <div><div style="font-size:1.3rem;font-weight:700;">{{ number_format($overallExpense, 2) }} DZD</div><div style="font-size:.75rem;opacity:.75;">Total Expenses</div></div>
        <div><div style="font-size:1.3rem;font-weight:700;">{{ number_format($overallRevenue - $overallExpense, 2) }} DZD</div><div style="font-size:.75rem;opacity:.75;">Net Balance</div></div>
    </div>
</div>

</x-admin-layout>
