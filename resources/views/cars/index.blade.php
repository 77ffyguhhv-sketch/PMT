@extends('layouts.app')

@section('content')
    <style>
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 1rem;
            margin-bottom: 1.6rem;
        }

        .stat-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 1.2rem 1.35rem;
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .stat-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .stat-value {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--navy-dark);
            margin-top: 0.2rem;
            line-height: 1.2;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.2rem;
            padding-bottom: 1.1rem;
            border-bottom: 1px solid var(--border);
        }

        .search-box {
            position: relative;
            flex: 1;
            min-width: 240px;
            max-width: 360px;
        }

        .search-box input {
            width: 100%;
            padding-left: 2.4rem;
            background: #f8fafc;
        }

        .search-box svg {
            position: absolute;
            left: 0.8rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        .filter-pills {
            display: flex;
            gap: 0.4rem;
        }

        .pill-btn {
            padding: 0.42rem 0.9rem;
            border-radius: 999px;
            border: 1px solid var(--border);
            background: #f8fafc;
            color: var(--text-muted);
            font-family: inherit;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .pill-btn.active,
        .pill-btn:hover {
            background: var(--navy-dark);
            color: #fff;
            border-color: var(--navy-dark);
        }

        .car-cell {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .car-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--primary-soft);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.95rem;
            flex-shrink: 0;
        }

        .plate-tag {
            display: inline-block;
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
            font-weight: 700;
            font-size: 0.84rem;
            background: #f8fafc;
            color: var(--navy-dark);
            border: 1.5px solid #cbd5e1;
            border-radius: 6px;
            padding: 0.2rem 0.6rem;
            letter-spacing: 0.06em;
        }

        .rate-tag {
            font-weight: 700;
            color: var(--navy-dark);
            font-size: 0.95rem;
        }

        .rate-tag span {
            font-weight: 500;
            font-size: 0.78rem;
            color: var(--text-muted);
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            display: inline-block;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--text-muted);
        }
    </style>

    <div class="page-header">
        <div>
            <h1>Cars Fleet Management</h1>
            <p class="page-subtitle">Manage rental vehicles, daily rates, and real-time availability.</p>
        </div>
        <a href="{{ route('cars.create') }}" class="btn">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Add New Car</span>
        </a>
    </div>

    {{-- KPI Summary Cards --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div>
                <div class="stat-label">Total Fleet</div>
                <div class="stat-value">{{ $cars->count() }}</div>
            </div>
            <div class="stat-icon" style="background: #eff6ff; color: #2563eb;">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1"/>
                </svg>
            </div>
        </div>

        <div class="stat-card">
            <div>
                <div class="stat-label">Available Now</div>
                <div class="stat-value" style="color: #059669;">{{ $cars->where('status', 'available')->count() }}</div>
            </div>
            <div class="stat-icon" style="background: #d1fae5; color: #059669;">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
        </div>

        <div class="stat-card">
            <div>
                <div class="stat-label">Currently Rented</div>
                <div class="stat-value" style="color: #d97706;">{{ $cars->where('status', 'rented')->count() }}</div>
            </div>
            <div class="stat-icon" style="background: #fef3c7; color: #d97706;">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>

        <div class="stat-card">
            <div>
                <div class="stat-label">Avg. Daily Rate</div>
                <div class="stat-value">${{ number_format($cars->avg('daily_rate') ?? 0, 2) }}</div>
            </div>
            <div class="stat-icon" style="background: #f3e8ff; color: #7c3aed;">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="card">
        {{-- Instant Search & Status Filter --}}
        <div class="toolbar">
            <div class="search-box">
                <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
                </svg>
                <input type="text" id="carSearchInput" placeholder="Search brand, model, or plate...">
            </div>

            <div class="filter-pills">
                <button type="button" class="pill-btn active" data-filter="all">All ({{ $cars->count() }})</button>
                <button type="button" class="pill-btn" data-filter="available">Available</button>
                <button type="button" class="pill-btn" data-filter="rented">Rented</button>
            </div>
        </div>

        <div class="table-responsive">
            <table id="carsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Vehicle</th>
                        <th>Plate Number</th>
                        <th>Daily Rate</th>
                        <th>Status</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cars as $car)
                        <tr class="car-row"
                            data-status="{{ $car->status }}"
                            data-search="{{ strtolower($car->brand . ' ' . $car->model . ' ' . $car->plate_number) }}">
                            <td style="color: var(--text-muted); font-weight: 600;">#{{ $car->id }}</td>
                            <td>
                                <div class="car-cell">
                                    <div class="car-avatar">{{ strtoupper(substr($car->brand, 0, 2)) }}</div>
                                    <div>
                                        <div style="font-weight: 700; color: var(--navy-dark);">{{ $car->brand }}</div>
                                        <div style="font-size: 0.83rem; color: var(--text-muted);">{{ $car->model }}</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="plate-tag">{{ $car->plate_number }}</span></td>
                            <td><span class="rate-tag">${{ number_format($car->daily_rate, 2) }} <span>/ day</span></span></td>
                            <td>
                                @if ($car->status === 'available')
                                    <span class="badge badge-done">
                                        <span class="status-dot" style="background: #059669;"></span>
                                        Available
                                    </span>
                                @else
                                    <span class="badge badge-pending">
                                        <span class="status-dot" style="background: #d97706;"></span>
                                        Rented
                                    </span>
                                @endif
                            </td>
                            <td style="text-align: right; white-space: nowrap;">
                                <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-secondary btn-sm">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    <span>Edit</span>
                                </a>

                                <form action="{{ route('cars.destroy', $car->id) }}" method="POST" class="inline-form"
                                      onsubmit="return confirm('Are you sure you want to delete {{ $car->brand }} {{ $car->model }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        <span>Delete</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div style="font-weight: 700; font-size: 1.05rem; color: var(--navy-dark); margin-bottom: 0.3rem;">No vehicles in the fleet yet</div>
                                    <div>Click <strong>"+ Add New Car"</strong> above to register your first car.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('carSearchInput');
            const filterButtons = document.querySelectorAll('.pill-btn');
            const rows = document.querySelectorAll('.car-row');
            let currentStatus = 'all';

            function applyFilters() {
                const term = searchInput.value.toLowerCase().trim();
                rows.forEach(row => {
                    const matchesSearch = row.dataset.search.includes(term);
                    const matchesStatus = currentStatus === 'all' || row.dataset.status === currentStatus;
                    row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
                });
            }

            searchInput.addEventListener('input', applyFilters);

            filterButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    filterButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    currentStatus = this.dataset.filter;
                    applyFilters();
                });
            });
        });
    </script>
@endsection