<x-admin-layout title="Dashboard">

@push('styles')
<style>
.rev-widget-tabs { display:flex; gap:.35rem; background:#f1f5f9; border-radius:10px; padding:.25rem; width:fit-content; margin-bottom:1rem; }
.rev-widget-tab { padding:.3rem .85rem; border-radius:7px; font-size:.8rem; font-weight:600; cursor:pointer; background:transparent; color:#64748b; border:none; font-family:inherit; transition:all .15s; }
.rev-widget-tab.active { background:#fff; color:#1e3a5f; box-shadow:0 1px 3px rgba(0,0,0,.1); }
.rev-period { display:none; }
.rev-period.active { display:grid; grid-template-columns:repeat(3,1fr); gap:.8rem; }
@media(max-width:600px){ .rev-period.active{ grid-template-columns:1fr; } }
.rw-card { border-radius:11px; padding:1rem 1.2rem; color:#fff; display:flex; flex-direction:column; gap:.15rem; }
.rw-card.rc-in  { background:linear-gradient(135deg,#059669,#10b981); }
.rw-card.rc-out { background:linear-gradient(135deg,#dc2626,#ef4444); }
.rw-card.rc-net-p { background:linear-gradient(135deg,#1e3a5f,#2d6a9f); }
.rw-card.rc-net-n { background:linear-gradient(135deg,#7c3aed,#a855f7); }
.rw-card .rw-label { font-size:.72rem; opacity:.8; text-transform:uppercase; font-weight:600; letter-spacing:.3px; }
.rw-card .rw-val { font-size:1.35rem; font-weight:800; letter-spacing:-.3px; }
.rw-card .rw-cur { font-size:.78rem; font-weight:500; opacity:.8; }
</style>
@endpush

<h1 class="page-title">Dashboard</h1>

<div class="stat-grid">
    <div class="stat-card">
        <div class="value">{{ $stats['total'] }}</div>
        <div class="label">Total Reservations</div>
    </div>
    <div class="stat-card">
        <div class="value" style="color:#d97706;">{{ $stats['pending'] }}</div>
        <div class="label">Pending</div>
    </div>
    <div class="stat-card">
        <div class="value" style="color:#059669;">{{ $stats['confirmed'] }}</div>
        <div class="label">Confirmed</div>
    </div>
    <div class="stat-card">
        <div class="value" style="color:#dc2626;">{{ $stats['cancelled'] }}</div>
        <div class="label">Cancelled</div>
    </div>
    <div class="stat-card">
        <div class="value" style="color:#7c3aed;">{{ $stats['today'] }}</div>
        <div class="label">Today's Bookings</div>
    </div>
</div>

{{-- ── Revenue Summary Widget ────────────────────────────────────── --}}
<div class="card" style="margin-bottom:1.5rem;">
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;margin-bottom:1rem;">
        <h2 style="font-size:1.05rem;font-weight:700;color:#1e3a5f;margin:0;">💰 Revenue Overview</h2>
        <a href="{{ route('admin.revenue.index') }}" style="font-size:.8rem;color:#2d6a9f;text-decoration:none;font-weight:500;">View Full Report →</a>
    </div>

    <div class="rev-widget-tabs">
        <button class="rev-widget-tab active" onclick="switchRevPeriod('today',this)">Today</button>
        <button class="rev-widget-tab"        onclick="switchRevPeriod('month',this)">This Month</button>
        <button class="rev-widget-tab"        onclick="switchRevPeriod('year',this)">This Year</button>
    </div>

    {{-- Today --}}
    <div class="rev-period active" id="rev-today">
        <div class="rw-card rc-in">
            <div class="rw-label">💵 Revenue In</div>
            <div class="rw-val">{{ number_format($revenueStats['today_revenue'], 2) }}</div>
            <div class="rw-cur">DZD · Today</div>
        </div>
        <div class="rw-card rc-out">
            <div class="rw-label">💸 Expenses Out</div>
            <div class="rw-val">{{ number_format($revenueStats['today_expense'], 2) }}</div>
            <div class="rw-cur">DZD · Today</div>
        </div>
        <div class="rw-card {{ $revenueStats['today_net'] >= 0 ? 'rc-net-p' : 'rc-net-n' }}">
            <div class="rw-label">{{ $revenueStats['today_net'] >= 0 ? '📈' : '📉' }} Net Balance</div>
            <div class="rw-val">{{ $revenueStats['today_net'] >= 0 ? '+' : '' }}{{ number_format($revenueStats['today_net'], 2) }}</div>
            <div class="rw-cur">DZD · Today</div>
        </div>
    </div>

    {{-- This Month --}}
    <div class="rev-period" id="rev-month">
        <div class="rw-card rc-in">
            <div class="rw-label">💵 Revenue In</div>
            <div class="rw-val">{{ number_format($revenueStats['month_revenue'], 2) }}</div>
            <div class="rw-cur">DZD · {{ now()->format('F Y') }}</div>
        </div>
        <div class="rw-card rc-out">
            <div class="rw-label">💸 Expenses Out</div>
            <div class="rw-val">{{ number_format($revenueStats['month_expense'], 2) }}</div>
            <div class="rw-cur">DZD · {{ now()->format('F Y') }}</div>
        </div>
        <div class="rw-card {{ $revenueStats['month_net'] >= 0 ? 'rc-net-p' : 'rc-net-n' }}">
            <div class="rw-label">{{ $revenueStats['month_net'] >= 0 ? '📈' : '📉' }} Net Balance</div>
            <div class="rw-val">{{ $revenueStats['month_net'] >= 0 ? '+' : '' }}{{ number_format($revenueStats['month_net'], 2) }}</div>
            <div class="rw-cur">DZD · {{ now()->format('F Y') }}</div>
        </div>
    </div>

    {{-- This Year --}}
    <div class="rev-period" id="rev-year">
        <div class="rw-card rc-in">
            <div class="rw-label">💵 Revenue In</div>
            <div class="rw-val">{{ number_format($revenueStats['year_revenue'], 2) }}</div>
            <div class="rw-cur">DZD · {{ now()->year }}</div>
        </div>
        <div class="rw-card rc-out">
            <div class="rw-label">💸 Expenses Out</div>
            <div class="rw-val">{{ number_format($revenueStats['year_expense'], 2) }}</div>
            <div class="rw-cur">DZD · {{ now()->year }}</div>
        </div>
        <div class="rw-card {{ $revenueStats['year_net'] >= 0 ? 'rc-net-p' : 'rc-net-n' }}">
            <div class="rw-label">{{ $revenueStats['year_net'] >= 0 ? '📈' : '📉' }} Net Balance</div>
            <div class="rw-val">{{ $revenueStats['year_net'] >= 0 ? '+' : '' }}{{ number_format($revenueStats['year_net'], 2) }}</div>
            <div class="rw-cur">DZD · {{ now()->year }}</div>
        </div>
    </div>

    <div style="display:flex;gap:.75rem;margin-top:1rem;">
        <a href="{{ route('admin.revenue.create', ['type'=>'revenue']) }}"
           style="padding:.4rem 1rem;border-radius:7px;font-size:.82rem;font-weight:600;text-decoration:none;background:#d1fae5;color:#065f46;">+ Add Revenue</a>
        <a href="{{ route('admin.revenue.create', ['type'=>'expense']) }}"
           style="padding:.4rem 1rem;border-radius:7px;font-size:.82rem;font-weight:600;text-decoration:none;background:#fee2e2;color:#991b1b;">+ Add Expense</a>
    </div>
</div>

@push('scripts')
<script>
function switchRevPeriod(period, btn) {
    document.querySelectorAll('.rev-period').forEach(el => el.classList.remove('active'));
    document.querySelectorAll('.rev-widget-tab').forEach(b => b.classList.remove('active'));
    document.getElementById('rev-' + period).classList.add('active');
    btn.classList.add('active');
}
</script>
@endpush
{{-- ──────────────────────────────────────────────────────────────── --}}

<div style="display:grid;grid-template-columns:1fr;gap:1.5rem;margin-bottom:1.5rem;">
    {{-- Rooms Map --}}
    <div class="card" style="margin:0;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
            <h2 style="font-size:1.1rem;font-weight:600;color:#1e3a5f;margin:0;">Rooms & Beds Map</h2>
            
            <form method="GET" action="{{ route('admin.dashboard') }}" style="display:flex;align-items:center;gap:.5rem;">
                <label for="date" style="font-size:.85rem;color:#64748b;margin:0;">Date:</label>
                <input type="date" name="date" id="date" value="{{ $selectedDate }}" onchange="this.form.submit()" style="padding:.3rem .5rem;font-size:.85rem;width:140px;">
            </form>
        </div>
        
        @if($rooms->isEmpty())
            <div style="text-align:center;padding:2rem;color:#94a3b8;">No rooms created yet.</div>
        @else
            <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(300px, 1fr));gap:1rem;">
                @foreach($rooms as $room)
                <div style="border:1px solid #e2e8f0;border-radius:10px;padding:1rem;">
                    <div style="display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #f1f5f9;padding-bottom:.5rem;margin-bottom:.75rem;">
                        <strong style="color:#334155;">{{ $room->name }}</strong>
                        <span style="font-size:.75rem;color:#64748b;">{{ $room->beds->count() }} beds</span>
                    </div>
                    @if($room->beds->isEmpty())
                        <div style="font-size:.8rem;color:#94a3b8;text-align:center;">Empty</div>
                    @else
                        <div style="display:flex;flex-wrap:wrap;gap:.4rem;">
                            @foreach($room->beds as $bed)
                                @php 
                                    $isOccupied = $bed->bookings->isNotEmpty();
                                    $booking = $isOccupied ? $bed->bookings->first() : null;
                                @endphp
                                @if($isOccupied)
                                    <a href="{{ route('admin.bed-bookings.edit', $booking->id) }}" 
                                       title="Reserved by {{ $booking->client_name }} - Click to edit" 
                                       style="font-size:.7rem;padding:.2rem .4rem;border-radius:4px;cursor:pointer;text-decoration:none;background:#fee2e2;color:#991b1b;border:1px solid #ef4444;">
                                        {{ $bed->name }}
                                    </a>
                                @else
                                    <a href="{{ route('admin.bed-bookings.create', ['bed_id' => $bed->id, 'date' => $selectedDate]) }}" title="{{ $bed->name }} (Available) - Click to assign client" 
                                         style="font-size:.7rem;padding:.2rem .4rem;border-radius:4px;cursor:pointer;text-decoration:none;background:#d1fae5;color:#065f46;border:1px solid #10b981;">
                                        {{ $bed->name }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
            <div style="display:flex;justify-content:space-between;margin-top:1rem;">
                <div style="display:flex;gap:1rem;font-size:.75rem;">
                    <div style="display:flex;align-items:center;gap:.3rem;">
                        <div style="width:12px;height:12px;background:#d1fae5;border:1px solid #10b981;border-radius:2px;"></div> Available
                    </div>
                    <div style="display:flex;align-items:center;gap:.3rem;">
                        <div style="width:12px;height:12px;background:#fee2e2;border:1px solid #ef4444;border-radius:2px;"></div> Reserved
                    </div>
                </div>
                <a href="{{ route('admin.rooms.index') }}" style="font-size:.8rem;color:#2d6a9f;text-decoration:none;">Manage Rooms & Beds →</a>
            </div>
        @endif
    </div>
</div>

<div class="card">
    <h2 style="font-size:1rem;font-weight:600;margin-bottom:1rem;color:#475569;">Recent Reservations</h2>
    <table>
        <thead>
            <tr>
                <th>#</th><th>Name</th><th>Beds Req.</th><th>Date</th><th>Type</th><th>Status</th><th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($recent as $r)
            <tr>
                <td>{{ $r->id }}</td>
                <td>{{ $r->full_name }}</td>
                <td>{{ $r->num_beds }}</td>
                <td>{{ $r->date->format('d M Y') }}</td>
                <td>{{ ucfirst($r->reservation_type) }}</td>
                <td><span class="badge badge-{{ $r->status }}">{{ ucfirst($r->status) }}</span></td>
                <td>
                    <a href="{{ route('admin.reservations.show', $r->id) }}" class="btn btn-secondary btn-sm">View</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" style="text-align:center;color:#94a3b8;padding:2rem;">No reservations yet.</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($stats['total'] > 5)
    <div style="margin-top:1rem;">
        <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary btn-sm">View All Reservations →</a>
    </div>
    @endif
</div>

</x-admin-layout>
