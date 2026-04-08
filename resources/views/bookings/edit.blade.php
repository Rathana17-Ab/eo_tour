@extends('layouts.dashboard')

@section('content')
    <div class="container my-4">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header">
                <h4 class="fw-bold text-dark text-center">Edit Booking</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('booking.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" class="form-control" name="customer_name"
                                value="{{ old('customer_name', $data->customer_name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" class="form-control" name="customer_email"
                                value="{{ old('customer_email', $data->customer_email) }}" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Tour Name</label>
                            <select id="tourSelect" class="form-control" name="tour_id" required>
                                <option value="">Choose Tour</option>
                                @foreach ($tour as $item)
                                    <option value="{{ $item->id }}" data-price="{{ $item->price }}"
                                        {{ old('tour_id', $data->tour_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }} - ${{ $item->price }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Number of People</label>
                            <input type="text" id="peopleCount" class="form-control"
                                name="people_count" min="1"
                                value="{{ old('people_count', $data->people_count) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Total Price</label>
                            <input type="text" id="tourPrice" class="form-control"
                                name="total_price"
                                value="{{ old('total_price', $data->total_price) }}" readonly>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <a href="{{ route('booking.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const tourSelect = document.getElementById('tourSelect');
        const peopleCount = document.getElementById('peopleCount');
        const tourPrice = document.getElementById('tourPrice');

        function calculateTotal() {
            const selectedOption = tourSelect.options[tourSelect.selectedIndex];
            const pricePerPerson = parseFloat(selectedOption.dataset.price) || 0;
            const people = parseInt(peopleCount.value) || 0;
            const total = pricePerPerson * people;
            tourPrice.value = total ? total.toFixed(2) : '';
        }

        tourSelect.addEventListener('change', calculateTotal);
        peopleCount.addEventListener('input', calculateTotal);
    </script>
@endsection