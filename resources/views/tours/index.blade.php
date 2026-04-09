@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="mb-4 text-center">Tour Management</h2>

            @if (session('success'))
                <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
            @endif

            <a href="{{ route('tour.create') }}" class="btn btn-primary mb-3">
                Create New Tour
            </a>

            {{-- Filter Form --}}
            <form action="{{ route('tour.index') }}" method="GET" class="mb-3">
                <div class="row g-2 align-items-end">

                    {{-- Search --}}
                    <div class="col-md-3">
                        <label class="form-label small text-muted mb-1">Search</label>
                        <input type="text" name="q" class="form-control" placeholder="Search tours..."
                            value="{{ $q ?? '' }}">
                    </div>

                    {{-- Status --}}
                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Status</label>
                        <select name="status" class="form-control">
                            <option value="">-- All Status --</option>
                            <option value="active" {{ ($status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ ($status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    {{-- Min Price --}}
                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Min Price</label>
                        <input type="number" name="min_price" class="form-control" placeholder="0"
                            value="{{ $minPrice ?? '' }}">
                    </div>

                    {{-- Max Price --}}
                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Max Price</label>
                        <input type="number" name="max_price" class="form-control" placeholder="9999"
                            value="{{ $maxPrice ?? '' }}">
                    </div>

                    {{-- Buttons --}}
                    <div class="col-md-3">
                        <label class="form-label small text-muted mb-1 d-block">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary flex-fill" type="submit">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                            <a href="{{ route('tour.index') }}"
                                class="btn btn-outline-secondary d-flex align-items-center justify-content-center"
                                style="width: 38px;">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </form>

            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">ID</th>
                                <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Name</th>
                                <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Description
                                </th>
                                <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Price</th>
                                <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Start Date</th>
                                <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">End Date</th>
                                <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Status</th>
                                <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tour as $item)
                                <tr>
                                    <td class="text-center align-middle">{{ $item->id }}</td>
                                    <td class="align-middle">{{ $item->name }}</td>
                                    <td class="align-middle">{{ $item->description }}</td>
                                    <td class="align-middle">{{ $item->price }}</td>
                                    <td class="align-middle">{{ $item->start_date }}</td>
                                    <td class="align-middle">{{ $item->end_date }}</td>
                                    <td class="align-middle">
                                        @if ($item->status == 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="d-flex flex-row gap-2 justify-content-center">
                                            <a class="btn btn-warning btn-sm"
                                                href="{{ route('tour.edit', $item->id) }}">
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm"
                                                href="{{ route('tour.delete', $item->id) }}">
                                                Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-3 mb-2">
                    {{ $tour->appends([
                            'q' => request('q'),
                            'status' => request('status'),
                            'min_price' => request('min_price'),
                            'max_price' => request('max_price'),
                        ])->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
