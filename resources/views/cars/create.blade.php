@extends('layouts.app')

@section('content')
    <style>
        .form-wrapper {
            max-width: 720px;
            margin: 0 auto;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.1rem;
        }

        .status-cards {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.9rem;
        }

        .status-option input {
            display: none;
        }

        .status-box {
            border: 2px solid var(--border);
            border-radius: var(--radius-md);
            padding: 0.9rem 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.65rem;
            font-weight: 600;
        }

        .status-option input:checked + .status-box.opt-available {
            border-color: #059669;
            background: #ecfdf5;
            color: #065f46;
        }

        .status-option input:checked + .status-box.opt-rented {
            border-color: #d97706;
            background: #fffbeb;
            color: #92400e;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
            margin-top: 1.5rem;
            padding-top: 1.2rem;
            border-top: 1px solid var(--border);
        }
    </style>

    <div class="form-wrapper">
        <div class="page-header">
            <div>
                <h1>Add New Car</h1>
                <p class="page-subtitle">Register a new vehicle into the rental fleet.</p>
            </div>
            <a href="{{ route('cars.index') }}" class="btn btn-secondary">&larr; Back to Fleet</a>
        </div>

        <div class="card">
            <form action="{{ route('cars.store') }}" method="POST">
                @csrf

                <div class="form-grid">
                    <div class="form-group">
                        <label for="brand">Brand (الشركة المصنعة)</label>
                        <input type="text" id="brand" name="brand" value="{{ old('brand') }}" placeholder="e.g. Toyota" required>
                    </div>

                    <div class="form-group">
                        <label for="model">Model (الموديل)</label>
                        <input type="text" id="model" name="model" value="{{ old('model') }}" placeholder="e.g. Camry 2024" required>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="plate_number">Plate Number (رقم اللوحة)</label>
                        <input type="text" id="plate_number" name="plate_number" value="{{ old('plate_number') }}" placeholder="e.g. ABC-1234" required>
                    </div>

                    <div class="form-group">
                        <label for="daily_rate">Daily Rate $ (سعر الإيجار اليومي)</label>
                        <input type="number" step="0.01" id="daily_rate" name="daily_rate" value="{{ old('daily_rate') }}" placeholder="e.g. 55.00" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Availability Status (حالة السيارة)</label>
                    <div class="status-cards">
                        <label class="status-option">
                            <input type="radio" name="status" value="available" {{ old('status', 'available') === 'available' ? 'checked' : '' }}>
                            <div class="status-box opt-available">
                                <span>&#10004;</span>
                                <span>Available (متاحة)</span>
                            </div>
                        </label>

                        <label class="status-option">
                            <input type="radio" name="status" value="rented" {{ old('status') === 'rented' ? 'checked' : '' }}>
                            <div class="status-box opt-rented">
                                <span>&#9203;</span>
                                <span>Rented (مؤجرة)</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('cars.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn">Save Vehicle</button>
                </div>
            </form>
        </div>
    </div>
@endsection