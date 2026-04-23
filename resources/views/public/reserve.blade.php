<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Book a Beach Bed — Beach Reservation</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; min-height: 100vh; background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 50%, #7dd3fc 100%); display: flex; align-items: center; justify-content: center; padding: 2rem; }
        .card { background: #fff; border-radius: 18px; box-shadow: 0 12px 40px rgba(0,0,0,.13); padding: 2.5rem; width: 100%; max-width: 540px; }
        .logo { text-align: center; margin-bottom: 2rem; }
        .logo .icon { font-size: 3rem; }
        .logo h1 { font-size: 1.5rem; font-weight: 700; color: #1e3a5f; margin-top: .5rem; }
        .logo p { color: #64748b; font-size: .9rem; margin-top: .3rem; }
        .form-group { margin-bottom: 1.1rem; }
        label { display: block; font-size: .875rem; font-weight: 500; margin-bottom: .35rem; color: #374151; }
        input, select { width: 100%; padding: .65rem .9rem; border: 1.5px solid #d1d5db; border-radius: 8px; font-size: .9rem; font-family: inherit; outline: none; transition: border-color .15s, box-shadow .15s; }
        input:focus, select:focus { border-color: #2d6a9f; box-shadow: 0 0 0 3px rgba(45,106,159,.12); }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .error-text { color: #dc2626; font-size: .8rem; margin-top: .3rem; }
        .alert-error { background: #fee2e2; color: #991b1b; border-left: 4px solid #ef4444; padding: .85rem 1.1rem; border-radius: 8px; margin-bottom: 1.2rem; font-size: .9rem; }
        .btn-submit { display: block; width: 100%; padding: .85rem; background: linear-gradient(135deg, #1e3a5f, #2d6a9f); color: #fff; border: none; border-radius: 9px; font-size: 1rem; font-weight: 600; cursor: pointer; margin-top: 1.3rem; font-family: inherit; transition: opacity .15s; }
        .btn-submit:hover { opacity: .9; }
        .admin-link { text-align: center; margin-top: 1.5rem; font-size: .8rem; color: #94a3b8; }
        .admin-link a { color: #2d6a9f; text-decoration: none; }
        .badge { display: inline-block; padding: .25rem .65rem; border-radius: 9999px; font-size: .75rem; font-weight: 600; background: #fef3c7; color: #92400e; }
    </style>
</head>
<body>
<div class="card">
    <div class="logo">
        <div class="icon">🏖️</div>
        <h1>Reserve Your Beach Bed</h1>
        <p>Fill in your details to book a spot</p>
    </div>

    @if($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('reservation.store') }}">
        @csrf
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" placeholder="John Doe" required>
            @error('full_name') <p class="error-text">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" placeholder="0555 000 111" required>
            @error('phone_number') <p class="error-text">{{ $message }}</p> @enderror
        </div>

        <div class="grid-2">
            <div class="form-group">
                <label for="reservation_type">Reservation Type</label>
                <select id="reservation_type" name="reservation_type" required>
                    <option value="">-- Select --</option>
                    <option value="single"       @selected(old('reservation_type') === 'single')>Single</option>
                    <option value="group"        @selected(old('reservation_type') === 'group')>Group</option>
                    <option value="family"       @selected(old('reservation_type') === 'family')>Family</option>
                    <option value="organisation" @selected(old('reservation_type') === 'organisation')>Organisation</option>
                </select>
                @error('reservation_type') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="num_beds">Number of Beds Required</label>
                <input type="number" id="num_beds" name="num_beds" value="{{ old('num_beds', 1) }}" min="1" required>
                @error('num_beds') <p class="error-text">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid-2">
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" value="{{ old('date') }}" min="{{ date('Y-m-d') }}" required>
                @error('date') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="notes">Notes (Optional)</label>
                <input type="text" id="notes" name="notes" value="{{ old('notes') }}" placeholder="Any special requests?">
                @error('notes') <p class="error-text">{{ $message }}</p> @enderror
            </div>
        </div>

        <button type="submit" class="btn-submit">🏄 Confirm Reservation</button>
    </form>

    <p class="admin-link">Admin? <a href="{{ route('admin.login') }}">Log in here</a></p>
</div>
</body>
</html>
