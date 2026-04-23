<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login — Beach Reservation</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; min-height: 100vh; background: linear-gradient(135deg, #1e3a5f 0%, #2d6a9f 100%); display: flex; align-items: center; justify-content: center; padding: 2rem; }
        .card { background: #fff; border-radius: 18px; box-shadow: 0 12px 40px rgba(0,0,0,.25); padding: 2.5rem; width: 100%; max-width: 400px; }
        .logo { text-align: center; margin-bottom: 2rem; }
        .logo .icon { font-size: 2.5rem; }
        .logo h1 { font-size: 1.35rem; font-weight: 700; color: #1e3a5f; margin-top: .5rem; }
        .logo p { color: #64748b; font-size: .85rem; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; font-size: .875rem; font-weight: 500; margin-bottom: .35rem; color: #374151; }
        input[type="email"], input[type="password"] { width: 100%; padding: .65rem .9rem; border: 1.5px solid #d1d5db; border-radius: 8px; font-size: .9rem; font-family: inherit; outline: none; transition: border-color .15s; }
        input:focus { border-color: #2d6a9f; box-shadow: 0 0 0 3px rgba(45,106,159,.12); }
        .remember { display: flex; align-items: center; gap: .5rem; margin-bottom: 1.2rem; }
        .remember input { width: auto; }
        .remember label { margin: 0; font-size: .85rem; color: #64748b; }
        .alert-error { background: #fee2e2; color: #991b1b; border-left: 4px solid #ef4444; padding: .85rem; border-radius: 8px; margin-bottom: 1rem; font-size: .875rem; }
        .alert-success { background: #d1fae5; color: #065f46; border-left: 4px solid #10b981; padding: .85rem; border-radius: 8px; margin-bottom: 1rem; font-size: .875rem; }
        .btn-submit { display: block; width: 100%; padding: .8rem; background: linear-gradient(135deg, #1e3a5f, #2d6a9f); color: #fff; border: none; border-radius: 9px; font-size: 1rem; font-weight: 600; cursor: pointer; font-family: inherit; transition: opacity .15s; }
        .btn-submit:hover { opacity: .9; }
        .back-link { text-align: center; margin-top: 1.3rem; font-size: .82rem; }
        .back-link a { color: #2d6a9f; text-decoration: none; }
    </style>
</head>
<body>
<div class="card">
    <div class="logo">
        <div class="icon">🏖️</div>
        <h1>Beach Reservation</h1>
        <p>Admin Panel</p>
    </div>

    @if(session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@beach.com" required autofocus>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>
        <div class="remember">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember me</label>
        </div>
        <button type="submit" class="btn-submit">Sign In</button>
    </form>

    <p class="back-link"><a href="{{ route('reservation.create') }}">← Back to reservation form</a></p>
</div>
</body>
</html>
