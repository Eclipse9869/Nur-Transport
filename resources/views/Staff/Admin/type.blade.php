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
                        <h4 class="card-title">All Tour Types</h4>
                    </div>
                    <div class="ms-auto mt-3 mt-md-0">
                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addTypeModal">
                            Add Type
                        </button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="addTypeModal" tabindex="-1" aria-labelledby="addTypeModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('type.store') }}" method="POST">
                            @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addTypeModalLabel">Add Type</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="typeName" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="typeName" name="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="typePrice" class="form-label">Price (Rp)</label>
                                            <input type="number" class="form-control" id="typePrice" name="price" step="0.01" min="0" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Type</button>
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
                        @forelse($types as $type)
                            <tr>
                                <td class="px-0">{{ $type->name }}</td>
                                <td class="px-0">Rp {{ number_format($type->price, 0, ',', '.') }}</td>
                                <td class="px-0 text-dark fw-medium">
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editTypeModal{{ $type->id }}">
                                        Edit
                                    </button>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editTypeModal{{ $type->id }}" tabindex="-1" aria-labelledby="editTypeModalLabel{{ $type->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('type.update', $type->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editTypeModalLabel{{ $type->id }}">Edit Type</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="typeName{{ $type->id }}" class="form-label">Name</label>
                                                            <input type="text" class="form-control" id="typeName{{ $type->id }}" name="name" value="{{ $type->name }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="typePrice{{ $type->id }}" class="form-label">Price (Rp)</label>
                                                            <input type="number" class="form-control" id="typePrice{{ $type->id }}" name="price" value="{{ $type->price }}" step="0.01" min="0" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update Type</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">No types found.</td>
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