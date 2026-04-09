@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="mb-4 text-center">Permission Management</h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <a href="{{ route('permissions.create') }}" class="btn btn-primary mb-3">
                Create New Permission
            </a>

            @if (session('success'))
                <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center py-3" style="background:#0d6efd; color:#fff; width: 100px;">ID</th>
                                <th class="py-3" style="background:#0d6efd; color:#fff;">Permission Name</th>
                                <th class="text-center py-3" style="background:#0d6efd; color:#fff; width: 250px;">Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td class="text-center fw-bold">{{ $permission->id }}</td>
                                    <td><span class="badge bg-info text-dark px-3">{{ $permission->name }}</span></td>
                                    <td class="text-center">
                                        <a href="{{ route('permissions.edit', $permission->id) }}"
                                            class="btn btn-sm btn-outline-primary px-3">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>

                                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?')"
                                                class="btn btn-sm btn-outline-danger px-3">
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
    </div>
@endsection
