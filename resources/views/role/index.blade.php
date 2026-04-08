@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h2 class="mb-4">Role Management</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('role.create') }}" class="btn btn-primary mb-3">
            Create New Role
        </a>

        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th width="50" style="background:#0d6efd; color:#fff;">ID</th>
                    <th style="background:#0d6efd; color:#fff;">Name</th>
                    <th width="220" style="background:#0d6efd; color:#fff;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->permissions->name }}</td>
                        <td>
                            {{-- <a class="btn btn-info btn-sm"
                       href="{{ route('r.show',$permission->id) }}">View</a> --}}
                            <a class="btn btn-warning btn-sm" href="{{ route('role.edit', $role->id) }}">Edit</a>

                            <form action="{{ route('role.destroy', $role->id) }}" method="POST"
                                style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this permission?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $roles->links() }}
    </div>
@endsection
