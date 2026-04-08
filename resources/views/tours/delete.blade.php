@extends('layouts.dashboard')

@section('content')
    <div class="container my-4">
        <div class="card border-0 shadow-lg rounded-4 p-3">
            <div class="card-header">
                <h4 class="fw-bold text-dark text-center">Delete Tour</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('tour.destroy', $data->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', $data->name) }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="description"
                                value="{{ old('description', $data->description) }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="start_date"
                                value="{{ old('start_date', $data->start_date) }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control" name="end_date"
                                value="{{ old('end_date', $data->end_date) }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Price</label>
                            <input type="text" class="form-control" name="price"
                                value="{{ old('price', $data->price) }}" readonly>
                        </div>
                        <div class="col-md-6 d-flex align-items-center gap-2 mt-2">
                            <label class="form-label mb-0">Status</label>
                            <input type="checkbox" class="form-check-input" name="status"
                                {{ old('status', $data->status) ? 'checked' : '' }} disabled>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <a href="{{ route('tour.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection