@extends('layouts.dashboard')

@section('content')
    <div class="container my-4">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header">
                <h4 class="fw-bold text-dark text-center">Add Booking</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" class="form-control" name="customer_name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" class="form-control" name="customer_email" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Tour Name</label>
                            <select id="tourSelect" class="form-control" name="tour_id" required>
                                <option value="">Choose Tour</option>
                                @foreach ($tour as $item)
                                    <option value="{{ $item->id }}" data-price="{{ $item->price }}">
                                        {{ $item->name }} - ${{ $item->price }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Number of People</label>
                            <input type="text" id="peopleCount" class="form-control"
                                name="people_count" min="1" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Total Price</label>
                            <input type="text" id="tourPrice" class="form-control"
                                readonly name="total_price">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <a href="{{ route('booking.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function calculateTotal() {
            const selectedOption = document.getElementById('tourSelect').selectedOptions[0];
            const price = parseFloat(selectedOption?.dataset.price) || 0;
            const people = parseInt(document.getElementById('peopleCount').value) || 0;
            const total = price * people;
            document.getElementById('tourPrice').value = total > 0 ? total.toFixed(2) : '';
        }

        document.getElementById('tourSelect').addEventListener('change', calculateTotal);
        document.getElementById('peopleCount').addEventListener('input', calculateTotal);
    </script>
@endsection