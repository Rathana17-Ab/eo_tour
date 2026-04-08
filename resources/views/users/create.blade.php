@extends('layouts.dashboard')

@section('content')
    <div class="container my-4">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header">
                <h4 class="fw-bold text-dark text-center">Create New User</h4>
            </div>
            <div class="card-body p-4">
                {{-- 1. Action changed to store, Method is POST --}}
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Input Full Name" required
                                value="{{ old('name') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">User Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Input User Email"
                                required value="{{ old('email') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter password"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Repeat password" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Assign Role</label>
                            <select name="role" class="form-select" required>
                                <option value="" selected disabled>Select a role</option>

                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
