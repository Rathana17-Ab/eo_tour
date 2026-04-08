@extends('layouts.dashboard')

@section('content')
    
    <div class="container my-4">
        <h1 class="fw-bold text-primary mb-4">Dashboard</h1>

        <div class="row g-4">

            {{-- Total Tours --}}
            <div class="col-md-4">
                <div class="card text-white bg-primary shadow">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Total Tours</h6>
                            <h2 class="fw-bold mb-0">{{ $totalTours }}</h2>
                        </div>
                        <i class="fas fa-compass fa-3x opacity-50"></i>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <a href="{{ route('tour.index') }}" class="text-white small">View all tours →</a>
                    </div>
                </div>
            </div>

            {{-- Total Bookings --}}
            <div class="col-md-4">
                <div class="card text-white bg-success shadow">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Total Bookings</h6>
                            <h2 class="fw-bold mb-0">{{ $totalBookings }}</h2>
                        </div>
                        <i class="fas fa-calendar-check fa-3x opacity-50"></i>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <a href="{{ route('booking.index') }}" class="text-white small">View all bookings →</a>
                    </div>
                </div>
            </div>

            {{-- Total Income --}}
            <div class="col-md-4">
                <div class="card text-white bg-warning shadow">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Total Income</h6>
                            <h2 class="fw-bold mb-0">${{ number_format($totalIncome, 2) }}</h2>
                        </div>
                        <i class="fas fa-dollar-sign fa-3x opacity-50"></i>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <span class="text-white small">From all bookings</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
