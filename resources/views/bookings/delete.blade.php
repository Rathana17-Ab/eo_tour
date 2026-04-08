@extends('layouts.dashboard')

@section('content')
    <div class="container my-4">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header">
                <h4 class="fw-bold text-dark text-center">Delete Booking</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('bookings.destroy', $data->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" class="form-control"
                                value="{{ old('customer_name', $data->customer_name) }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" class="form-control"
                                value="{{ old('customer_email', $data->customer_email) }}" readonly>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Tour Name</label>
                            <select class="form-control" disabled>
                                @foreach ($tour as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $data->tour_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }} - ${{ $item->price }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Number of People</label>
                            <input type="text" class="form-control"
                                value="{{ old('people_count', $data->people_count) }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Total Price</label>
                            <input type="text" class="form-control"
                                value="{{ old('total_price', $data->total_price) }}" readonly>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <a href="{{ route('booking.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection