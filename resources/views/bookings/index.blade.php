@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="mb-4 text-center">Booking Management</h2>

            @if (session('success'))
                <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
            @endif

            <a href="{{ route('booking.create') }}" class="btn btn-primary mb-3">
                Create New Booking
            </a>

            {{-- Filter Form --}}
            <form action="{{ route('booking.index') }}" method="GET" class="mb-3">
                <div class="row g-2">

                    {{-- Search --}}
                    <div class="col-md-3">
                        <label class="form-label small text-muted mb-1">Search</label>
                        <input type="text" name="q" class="form-control" placeholder="Search bookings..."
                            value="{{ $q ?? '' }}">
                    </div>

                    {{-- Tour Name --}}
                    <div class="col-md-3">
                        <label class="form-label small text-muted mb-1">Tour Name</label>
                        <input type="text" name="tour_name" class="form-control" placeholder="Filter by Tour Name..."
                            value="{{ $tourName ?? '' }}">
                    </div>

                    {{-- Min Price --}}
                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Min Price</label>
                        <input type="number" name="min_price" class="form-control" placeholder="0"
                            value="{{ $minPrice ?? '' }}">
                    </div>

                    {{-- Max Price --}}
                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Max Price</label>
                        <input type="number" name="max_price" class="form-control" placeholder="9999"
                            value="{{ $maxPrice ?? '' }}">
                    </div>

                    {{-- Buttons aligned with inputs --}}
                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1 d-block">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary btn-sm flex-fill" type="submit" style="height: 38px;">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                            <a href="{{ route('booking.index') }}"
                                class="btn btn-outline-secondary btn-sm d-flex align-items-center justify-content-center"
                                style="height: 38px; width: 38px;">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </form>

            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">ID</th>
                                <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Customer Name
                                </th>
                                <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Customer Email
                                </th>
                                <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">People Count
                                </th>
                                <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Tour Name</th>
                                <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Tour Price</th>
                                <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Total Price
                                </th>
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
                                        <div class="d-flex flex-row gap-2 justify-content-center">
                                            <a class="btn btn-warning btn-sm"
                                                href="{{ route('booking.edit', $item->id) }}">
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm"
                                                href="{{ route('booking.delete', $item->id) }}">
                                                Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-3 mb-2">
                    {{ $index->appends([
                            'q' => request('q'),
                            'tour_name' => request('tour_name'),
                            'min_price' => request('min_price'),
                            'max_price' => request('max_price'),
                        ])->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
