@extends('layouts.dashboard')

@section('content')
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="display-4 fw-bold text-primary" style="letter-spacing:2px;">
                Tour Management
            </h1>
            <a href="{{ route('tour.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Add New Tour
            </a>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">ID</th>
                        <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Name</th>
                        <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Description</th>
                        <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Price</th>
                        <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Start Date</th>
                        <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">End Date</th>
                        <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Status</th>
                        <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tour as $item)
                        <tr id="tour-{{ $item->id }}">
                            <td class="text-center align-middle">{{ $item->id }}</td>
                            <td class="align-middle">{{ $item->name }}</td>
                            <td class="align-middle">{{ $item->description }}</td>
                            <td class="align-middle">{{ $item->price }}</td>
                            <td class="align-middle">{{ $item->start_date }}</td>
                            <td class="align-middle">{{ $item->end_date }}</td>
                            <td class="text-center align-middle">
                                @if ($item->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                <div class="d-flex flex-column gap-1 align-items-center">
                                    <a class="btn btn-sm btn-outline-primary w-100"
                                        href="{{ route('tour.edit', $item->id) }}">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <a class="btn btn-sm btn-outline-danger w-100"
                                        href="{{ route('tour.delete', $item->id) }}">
                                        <i class="fas fa-trash me-1"></i> Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
