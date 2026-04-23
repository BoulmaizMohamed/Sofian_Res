<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Beach Reservation')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #f0f4f8; color: #1a202c; min-height: 100vh; }
        .navbar { background: linear-gradient(135deg, #1e3a5f 0%, #2d6a9f 100%); color: #fff; padding: 1rem 2rem; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 2px 8px rgba(0,0,0,.2); }
        .navbar-brand { font-size: 1.3rem; font-weight: 700; letter-spacing: .5px; }
        .navbar a { color: rgba(255,255,255,.85); text-decoration: none; font-size: .9rem; }
        .navbar a:hover { color: #fff; }
        .nav-links { display: flex; gap: 1.5rem; align-items: center; }
        .btn-logout { background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.3); color: #fff; padding: .4rem 1rem; border-radius: 6px; cursor: pointer; font-size: .85rem; text-decoration: none; }
        .btn-logout:hover { background: rgba(255,255,255,.25); }
        .main { max-width: 1200px; margin: 2rem auto; padding: 0 1.5rem; }
        .card { background: #fff; border-radius: 12px; box-shadow: 0 1px 4px rgba(0,0,0,.08); padding: 1.5rem; margin-bottom: 1.5rem; }
        .alert { padding: .85rem 1.2rem; border-radius: 8px; margin-bottom: 1rem; font-size: .9rem; }
        .alert-success { background: #d1fae5; color: #065f46; border-left: 4px solid #10b981; }
        .alert-error   { background: #fee2e2; color: #991b1b; border-left: 4px solid #ef4444; }
        .badge { display: inline-block; padding: .25rem .65rem; border-radius: 9999px; font-size: .75rem; font-weight: 600; }
        .badge-pending   { background: #fef3c7; color: #92400e; }
        .badge-confirmed { background: #d1fae5; color: #065f46; }
        .badge-cancelled { background: #fee2e2; color: #991b1b; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: .75rem 1rem; text-align: left; border-bottom: 1px solid #e2e8f0; font-size: .9rem; }
        th { background: #f8fafc; font-weight: 600; color: #475569; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f8fafc; }
        .btn { display: inline-block; padding: .5rem 1.1rem; border-radius: 7px; font-size: .875rem; font-weight: 500; text-decoration: none; cursor: pointer; border: none; transition: all .15s; }
        .btn-primary { background: #2d6a9f; color: #fff; } .btn-primary:hover { background: #1e4f7a; }
        .btn-sm { padding: .3rem .7rem; font-size: .8rem; }
        .stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem; margin-bottom: 1.5rem; }
        .stat-card { background: #fff; border-radius: 10px; padding: 1.1rem 1.3rem; box-shadow: 0 1px 4px rgba(0,0,0,.07); }
        .stat-card .value { font-size: 2rem; font-weight: 700; color: #2d6a9f; }
        .stat-card .label { font-size: .8rem; color: #64748b; margin-top: .25rem; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; font-size: .875rem; font-weight: 500; margin-bottom: .35rem; color: #374151; }
        input, select { width: 100%; padding: .6rem .9rem; border: 1px solid #d1d5db; border-radius: 7px; font-size: .9rem; outline: none; }
        input:focus, select:focus { border-color: #2d6a9f; box-shadow: 0 0 0 3px rgba(45,106,159,.12); }
        .error-text { color: #dc2626; font-size: .8rem; margin-top: .25rem; }
        .page-title { font-size: 1.4rem; font-weight: 700; margin-bottom: 1.5rem; color: #1e3a5f; }
        .pagination { display: flex; gap: .5rem; margin-top: 1rem; justify-content: center; }
        .sidebar { width: 220px; flex-shrink: 0; }
        .sidebar-nav a { display: flex; align-items: center; gap: .6rem; padding: .65rem 1rem; border-radius: 8px; color: #475569; text-decoration: none; font-size: .9rem; margin-bottom: .25rem; }
        .sidebar-nav a:hover, .sidebar-nav a.active { background: #eff6ff; color: #2d6a9f; }
        .layout { display: flex; gap: 1.5rem; }
        .content { flex: 1; }
    </style>
    @stack('styles')
</head>
<body>
@yield('body')
@stack('scripts')
</body>
</html>
