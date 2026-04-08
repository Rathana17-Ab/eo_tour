@extends('layouts.dashboard')

@section('content')
    <div class="container my-4">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header">
                <h4 class="fw-bold text-dark text-center">Add New Tour</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('tour.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tour Name</label>
                            <input type="text" class="form-control" name="name"
                                placeholder="Input Tour Name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Description</label>
                            <input type="text" class="form-control" name="description">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Start Date</label>
                            <input type="date" class="form-control" name="start_date" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">End Date</label>
                            <input type="date" class="form-control" name="end_date">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tour Price</label>
                            <input type="text" class="form-control" name="price"
                                placeholder="Input Price" required>
                        </div>
                        <div class="col-md-6 d-flex align-items-center gap-2 mt-4">
                            <label class="form-label mb-0 fw-semibold">Status</label>
                            <input type="checkbox" class="form-check-input" name="status" value="1">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <a href="{{ route('tour.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection