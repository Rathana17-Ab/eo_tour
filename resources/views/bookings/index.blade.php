@extends('layouts.dashboard')

@section('content')
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="display-4 fw-bold text-primary" style="letter-spacing:2px;">
                Booking Management
            </h1>
            <a href="{{ route('booking.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Add New Booking
            </a>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">ID</th>
                        <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Customer Name</th>
                        <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Customer Email</th>
                        <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">People Count</th>
                        <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Tour Name</th>
                        <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Tour Price</th>
                        <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Total Price</th>
                        <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($index as $item)
                        <tr id="booking-{{ $item->id }}">
                            <td class="text-center align-middle">{{ $item->id }}</td>
                            <td class="align-middle">{{ $item->customer_name }}</td>
                            <td class="align-middle">{{ $item->customer_email }}</td>
                            <td class="text-center align-middle">{{ $item->people_count }}</td>
                            <td class="align-middle">{{ $item->tour->name ?? '-' }}</td>
                            <td class="align-middle">{{ $item->tour->price ?? '-' }}</td>
                            <td class="align-middle">{{ $item->total_price }}</td>
                            <td class="text-center align-middle">
                                <div class="d-flex flex-column gap-1 align-items-center">
                                    <a class="btn btn-sm btn-outline-primary w-100"
                                        href="{{ route('booking.edit', $item->id) }}">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <a class="btn btn-sm btn-outline-danger w-100"
                                        href="{{ route('booking.delete', $item->id) }}">
                                        <i class="fas fa-trash me-1"></i> Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection