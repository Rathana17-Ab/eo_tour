@extends('layouts.dashboard')

@section('content')
    <div class="container my-4">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header">
                <h4 class="fw-bold text-dark text-center">Edit User</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Input Full Name" required
                                value="{{ old('name', $user->name) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">User Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Input User Email"
                                required value="{{ old('email', $user->email) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control" name="password"
                                placeholder="Leave blank to keep current password">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Leave blank to keep current password">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Assign Role</label>
                            <select name="role" class="form-select" required>
                                <option value="" disabled {{ !$user->roles->first() ? 'selected' : '' }}>Select a role
                                </option>

                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select" required>
                                {{-- We check the current user status to pre-select it --}}
                                <option value="1" {{ old('status', $user->status) == '1' ? 'selected' : '' }}>Active
                                </option>
                                <option value="0" {{ old('status', $user->status) == '0' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                        </div>

                    </div>
                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
