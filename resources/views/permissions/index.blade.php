@extends('layouts.dashboard')

@section('content')
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-middle mb-4">
                <h2 class="fw-bold text-dark mb-0">Permission Management</h2>
                {{-- ប៊ូតុងនេះនឹងនាំទៅកាន់ទំព័រ Create Permission --}}
                <a href="{{ route('permissions.create') }}" class="btn btn-primary px-4">
                    <i class="fas fa-plus me-1"></i> Create New Permission
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="text-center py-3" style="background:#0d6efd; color:#fff; width: 100px;">ID</th>
                            <th class="py-3" style="background:#0d6efd; color:#fff;">Permission Name</th>
                            <th class="text-center py-3" style="background:#0d6efd; color:#fff; width: 250px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td class="text-center fw-bold">{{ $permission->id }}</td>
                                <td><span class="badge bg-info text-dark px-3">{{ $permission->name }}</span></td>
                                <td class="text-center">
                                    <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-outline-primary px-3">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>

                                    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-outline-danger px-3">
                                            <i class="fas fa-trash me-1"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $permissions->links() }}
            </div>
        </div>
    </div>
@endsection