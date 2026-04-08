@extends('layouts.dashboard')

@section('content')
    <div class="container my-4">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header">
                <h4 class="fw-bold text-dark text-center">Edit Tour</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('tour.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Tour Name</label>
                            <input type="text" class="form-control" name="name"
                                placeholder="Enter tour name"
                                value="{{ old('name', $data->name) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="description"
                                value="{{ old('description', $data->description) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="start_date"
                                value="{{ old('start_date', $data->start_date) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control" name="end_date"
                                value="{{ old('end_date', $data->end_date) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Price</label>
                            <input type="text" class="form-control" name="price"
                                placeholder="Input price"
                                value="{{ old('price', $data->price) }}">
                        </div>
                        <div class="col-md-6 d-flex align-items-center gap-2 mt-4">
                            <label class="form-label mb-0">Status</label>
                            <input type="checkbox" class="form-check-input" name="status"
                                {{ old('status', $data->status) ? 'checked' : '' }}>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <a href="{{ route('tour.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection