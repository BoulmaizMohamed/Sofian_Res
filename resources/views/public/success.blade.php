<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Confirmed! — Beach Reservation</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; min-height: 100vh; background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); display: flex; align-items: center; justify-content: center; padding: 2rem; }
        .card { background: #fff; border-radius: 18px; box-shadow: 0 12px 40px rgba(0,0,0,.12); padding: 2.5rem; width: 100%; max-width: 480px; text-align: center; }
        h1 { font-size: 1.5rem; font-weight: 700; color: #065f46; margin: 1rem 0 .5rem; }
        p.sub { color: #64748b; font-size: .95rem; margin-bottom: 2rem; }
        .info-box { background: #f0fdf4; border-radius: 10px; padding: 1.2rem 1.5rem; text-align: left; margin-bottom: 1.5rem; }
        table { width: 100%; }
        th { color: #6b7280; font-weight: 500; width: 130px; padding: .4rem 0; font-size: .875rem; }
        td { color: #1a202c; padding: .4rem 0; font-size: .875rem; }
        .badge-pending { display: inline-block; padding: .25rem .65rem; border-radius: 9999px; font-size: .75rem; font-weight: 600; background: #fef3c7; color: #92400e; }
        .btn { display: inline-block; padding: .7rem 1.5rem; background: #2d6a9f; color: #fff; border-radius: 9px; text-decoration: none; font-weight: 600; font-size: .9rem; }
        .btn:hover { background: #1e4f7a; }
    </style>
</head>
<body>
<div class="card">
    <div style="font-size:3.5rem;">✅</div>
    <h1>Reservation Received!</h1>
    <p class="sub">Your booking is <strong>pending confirmation</strong>.<br>We'll contact you shortly.</p>

    @if($reservation)
    <div class="info-box">
        <table>
            <tr><th>Reference</th><td>#{{ $reservation['id'] ?? $reservation->id }}</td></tr>
            <tr><th>Name</th><td>{{ $reservation['full_name'] ?? $reservation->full_name }}</td></tr>
            <tr><th>Beds Requested</th><td>{{ $reservation['num_beds'] ?? $reservation->num_beds }}</td></tr>
            <tr><th>Type</th><td>{{ ucfirst($reservation['reservation_type'] ?? $reservation->reservation_type) }}</td></tr>
            <tr><th>Date</th><td>{{ \Carbon\Carbon::parse($reservation['date'] ?? $reservation->date)->format('d M Y') }}</td></tr>
            <tr><th>Status</th><td><span class="badge-pending">Pending</span></td></tr>
        </table>
    </div>
    @endif

    <a href="{{ route('reservation.create') }}" class="btn">Make Another Reservation</a>
</div>
</body>
</html>
