@extends('layouts.admin')
@section('content')
<div class="body-wrapper-inner">
    <div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        <div class="card">
            <div class="card-body">
                <div class="d-md-flex align-items-center">
                    <div>
                        <h4 class="card-title">All Tour Location</h4>
                    </div>
                    <div class="ms-auto mt-3 mt-md-0">
                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addLocationModal">
                            Add Location
                        </button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="addLocationModal" tabindex="-1" aria-labelledby="addLocationModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('location.store') }}" method="POST">
                            @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addLocationModalLabel">Add Location</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="locationName" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="locationName" name="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="locationPrice" class="form-label">Price (Rp)</label>
                                            <input type="number" class="form-control" id="locationPrice" name="price" step="0.01" min="0" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Location</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                        <thead>
                            <tr>
                                <th scope="col" class="px-0 text-muted">Name</th>
                                <th scope="col" class="px-0 text-muted">Price</th>
                                <th scope="col" class="px-0 text-muted">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($locations as $loc)
                            <tr>
                                <td class="px-0">{{ $loc->name }}</td>
                                <td class="px-0">Rp {{ number_format($loc->price, 0, ',', '.') }}</td>
                                <td class="px-0 text-dark fw-medium">
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editLocationModal{{ $loc->id }}">
                                        Edit
                                    </button>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editLocationModal{{ $loc->id }}" tabindex="-1" aria-labelledby="editLocationModalLabel{{ $loc->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('location.update', $loc->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editLocationModalLabel{{ $loc->id }}">Edit Location</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="locationName{{ $loc->id }}" class="form-label">Name</label>
                                                            <input type="text" class="form-control" id="locationName{{ $loc->id }}" name="name" value="{{ $loc->name }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="locationPrice{{ $loc->id }}" class="form-label">Price (Rp)</label>
                                                            <input type="number" class="form-control" id="locationPrice{{ $loc->id }}" name="price" value="{{ $loc->price }}" step="0.01" min="0" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update Location</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">No location found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection