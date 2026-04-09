@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="mb-4 text-center">Role Management</h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <a href="{{ route('role.create') }}" class="btn btn-primary mb-3">
                Create New Role
            </a>
            <form action="{{ route('role.index') }}" method="GET" class="mb-3">
                <div class="input-group" style="max-width: 400px;">
                    <input type="text" name="q" class="form-control" placeholder="Search roles..."
                        value="{{ $q ?? '' }}">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="fas fa-search"></i> Search
                    </button>
                    @if (!empty($q))
                        <a href="{{ route('role.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i> Clear
                        </a>
                    @endif
                </div>
            </form>
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th width="50" style="background:#0d6efd; color:#fff;">ID</th>
                                <th style="background:#0d6efd; color:#fff;">
                                    Name</th>
                                <th style="background:#0d6efd; color:#fff;">
                                    Permission Name</th>
                                <th width="220" style="background:#0d6efd; color:#fff;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($index as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        {{-- បង្ហាញ permissions --}}
                                        @foreach ($role->permissions as $permission)
                                            <span class="badge bg-primary">{{ $permission->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a class="btn btn-warning btn-sm"
                                            href="{{ route('role.edit', $role->id) }}">Edit</a>
                                        <form action="{{ route('role.destroy', $role->id) }}" method="POST"
                                            style="display:inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $index->appends(['q' => request('q')])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
