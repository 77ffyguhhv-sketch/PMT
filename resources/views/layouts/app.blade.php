<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PMT — Fleet & Task Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-body: #f1f5f9;
            --bg-card: #ffffff;
            --navy-dark: #0f172a;
            --navy-mid: #1e293b;
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --primary-soft: #eff6ff;
            --emerald: #059669;
            --emerald-soft: #d1fae5;
            --amber: #d97706;
            --amber-soft: #fef3c7;
            --danger: #dc2626;
            --danger-hover: #b91c1c;
            --danger-soft: #fee2e2;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --radius-lg: 14px;
            --radius-md: 10px;
            --shadow-sm: 0 1px 3px rgba(15, 23, 42, 0.05);
            --shadow-md: 0 10px 25px -5px rgba(15, 23, 42, 0.06), 0 4px 10px -2px rgba(15, 23, 42, 0.03);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            font-size: 14.5px;
            line-height: 1.6;
            background: var(--bg-body);
            color: var(--text-main);
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--navy-dark) 0%, var(--navy-mid) 100%);
            color: #fff;
            padding: 0.9rem 2.2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.15);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .navbar .brand {
            font-size: 1.15rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .brand-badge {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            padding: 0.25rem 0.55rem;
            border-radius: 7px;
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.04em;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .navbar .nav-links a {
            color: #cbd5e1;
            text-decoration: none;
            padding: 0.45rem 0.85rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.88rem;
            transition: all 0.2s ease;
        }

        .navbar .nav-links a:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.09);
        }

        .navbar .nav-links a.active {
            color: #fff;
            background: var(--primary);
            box-shadow: 0 2px 10px rgba(37, 99, 235, 0.4);
        }

        /* Layout Container */
        .container {
            max-width: 1120px;
            width: 100%;
            margin: 2.2rem auto;
            padding: 0 1.25rem;
            flex: 1;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.6rem;
        }

        .page-header h1 {
            margin: 0;
            font-size: 1.65rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            color: var(--navy-dark);
        }

        .page-subtitle {
            margin: 0.2rem 0 0;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* Cards */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-md);
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            padding: 0.6rem 1.15rem;
            border-radius: var(--radius-md);
            border: 1px solid transparent;
            font-family: inherit;
            font-size: 0.88rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            background: linear-gradient(135deg, #3b82f6 0%, var(--primary) 100%);
            color: #fff;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.25);
            transition: all 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(37, 99, 235, 0.35);
            background: var(--primary-hover);
        }

        .btn-secondary {
            background: #fff;
            color: var(--navy-mid);
            border-color: #cbd5e1;
            box-shadow: var(--shadow-sm);
        }

        .btn-secondary:hover {
            background: #f8fafc;
            border-color: #94a3b8;
            box-shadow: 0 4px 10px rgba(15, 23, 42, 0.06);
        }

        .btn-danger {
            background: #fff;
            color: var(--danger);
            border-color: #fecaca;
            box-shadow: none;
        }

        .btn-danger:hover {
            background: var(--danger);
            color: #fff;
            border-color: var(--danger);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25);
        }

        .btn-sm {
            padding: 0.38rem 0.75rem;
            font-size: 0.82rem;
            border-radius: 8px;
        }

        /* Forms */
        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            align-items: center;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            font-size: 0.88rem;
            color: var(--navy-mid);
            margin-bottom: 0.45rem;
        }

        input,
        select,
        textarea {
            padding: 0.65rem 0.85rem;
            border: 1.5px solid #cbd5e1;
            border-radius: var(--radius-md);
            font-family: inherit;
            font-size: 0.92rem;
            color: var(--text-main);
            background: #fff;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3.5px rgba(37, 99, 235, 0.14);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
        }

        /* Tables */
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: left;
            padding: 0.95rem 1rem;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        th {
            background: #f8fafc;
            font-weight: 700;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
        }

        tbody tr {
            transition: background-color 0.15s ease;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.28rem 0.7rem;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 700;
        }

        .badge-pending {
            background: var(--amber-soft);
            color: #92400e;
        }

        .badge-in_progress {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-done {
            background: var(--emerald-soft);
            color: #065f46;
        }

        /* Alerts */
        .alert-success {
            background: var(--emerald-soft);
            border: 1px solid #a7f3d0;
            color: #065f46;
            padding: 0.9rem 1.2rem;
            border-radius: var(--radius-md);
            margin-bottom: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .alert-error {
            background: var(--danger-soft);
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 0.9rem 1.2rem;
            border-radius: var(--radius-md);
            margin-bottom: 1.5rem;
        }

        .alert-error ul {
            margin: 0;
            padding-left: 1.2rem;
        }

        .inline-form {
            display: inline;
        }

        footer {
            text-align: center;
            padding: 1.4rem;
            color: var(--text-muted);
            font-size: 0.82rem;
            border-top: 1px solid var(--border);
            background: #fff;
            margin-top: auto;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <a href="/tasks" class="brand">
            <span class="brand-badge">PMT</span>
            <span>PixelMindTrainning</span>
        </a>
        <div class="nav-links">
            <a href="/tasks" class="{{ request()->is('tasks') ? 'active' : '' }}">All Tasks</a>
            <a href="/tasks/create" class="{{ request()->is('tasks/create') ? 'active' : '' }}">+ New Task</a>
            <a href="/cars" class="{{ request()->is('cars*') ? 'active' : '' }}">Cars Fleet</a>
            <a href="/api/tasks">JSON API</a>
            <a href="/docs/api">API Docs</a>
        </div>
    </nav>

    <div class="container">
        @if (session('success'))
            <div class="alert-success">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>

    <footer>
        PMT — Laravel MVC &amp; Relational CRUD Assignment &bull; Built with Laravel
    </footer>
</body>

</html>