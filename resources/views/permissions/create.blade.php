@extends('layouts.dashboard')

@section('content')
    <div class="container my-4">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark mb-0">Create New Permission</h4>
                <a href="{{ route('permissions.index') }}" class="btn btn-secondary px-4">
                    <i class="fas fa-arrow-left me-1"></i> Back to List
                </a>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('permissions.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label fw-bold">Permission Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                               placeholder="e.g. edit-post, delete-user" required value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-center gap-2 border-top pt-4">
                        <button type="submit" class="btn btn-primary px-5">
                            <i class="fas fa-save me-1"></i> Save Permission
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection