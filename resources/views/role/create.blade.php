@extends('layouts.dashboard')

@section('content')
    <div class="container my-4">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark mb-0">Create New Role</h4>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('role.store') }}" method="POST">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-10">

                            <div class="mb-4">
                                <label class="form-label fw-bold">Role Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" placeholder="e.g. manager, staff, guide, or editor" required
                                    value="{{ old('name') }}">

                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Give the role a unique name.</small>
                            </div>
                          @foreach ($permission as $value)
                            <div class="col-md-4 mb-2"> <!-- 2 items per row -->
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="permission[{{ $value->id }}]"
                                        value="{{ $value->id }}" id="permission{{ $value->id }}">

                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-5 gap-2 border-top pt-4">
                        <a href="{{ route('role.index') }}" class="btn btn-secondary px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-1"></i> Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
