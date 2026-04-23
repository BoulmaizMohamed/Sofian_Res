<x-admin-layout title="Monthly Schedule">

<h1 class="page-title">Monthly Schedule</h1>

<form method="GET" action="{{ route('admin.schedule') }}" style="display:flex;gap:1rem;align-items:flex-end;margin-bottom:1.5rem;flex-wrap:wrap;">
    <div class="form-group" style="margin:0;">
        <label>Month</label>
        <select name="month" style="width:140px;">
            @foreach(range(1,12) as $m)
                <option value="{{ $m }}" @selected($m == $month)>
                    {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group" style="margin:0;">
        <label>Year</label>
        <input type="number" name="year" value="{{ $year }}" style="width:100px;" min="2020" max="2100">
    </div>
    <button type="submit" class="btn btn-primary">View Schedule</button>
</form>

@if(empty($schedule['schedule']))
    <div class="card" style="text-align:center;color:#94a3b8;padding:3rem;">
        No reservations found for {{ \Carbon\Carbon::create()->month($month)->format('F') }} {{ $year }}.
    </div>
@else
    @foreach($schedule['schedule'] as $date => $dayReservations)
    <div class="card" style="margin-bottom:1rem;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.75rem;">
            <h3 style="font-size:1rem;font-weight:600;color:#1e3a5f;">
                📅 {{ \Carbon\Carbon::parse($date)->format('l, d F Y') }}
            </h3>
            <span style="font-size:.8rem;color:#94a3b8;">{{ count($dayReservations) }} reservation(s)</span>
        </div>
        <table>
            <thead>
                <tr><th>Name</th><th>Phone</th><th>Beds Req.</th><th>Type</th><th>Status</th><th></th></tr>
            </thead>
            <tbody>
                @foreach($dayReservations as $r)
                <tr>
                    <td>{{ $r['full_name'] }}</td>
                    <td>{{ $r['phone_number'] }}</td>
                    <td>{{ $r['num_beds'] }}</td>
                    <td>{{ ucfirst($r['reservation_type']) }}</td>
                    <td><span class="badge badge-{{ $r['status'] }}">{{ ucfirst($r['status']) }}</span></td>
                    <td>
                        <a href="{{ route('admin.reservations.show', $r['id']) }}" class="btn btn-secondary btn-sm">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endforeach
@endif

</x-admin-layout>
