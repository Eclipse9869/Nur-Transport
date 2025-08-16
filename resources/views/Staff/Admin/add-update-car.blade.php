@extends('layouts.admin')

@section('content')
<div class="body-wrapper-inner">
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">
                    {{ isset($car) ? 'Edit Car' : 'Add New Car' }}
                </h4>

                <form 
                    action="{{ isset($car) ? route('cars.update', $car->id) : route('cars.store') }}" 
                    method="POST" 
                    enctype="multipart/form-data"
                >
                    @csrf
                    @if(isset($car))
                        @method('PUT')
                    @endif

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Car Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', $car->name ?? '') }}" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="price" class="form-label">Price (Rp)</label>
                            <input type="number" name="price" id="price" class="form-control" step="0.01"
                                value="{{ old('price', $car->price ?? '') }}" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="car_types_id" class="form-label">Car Type</label>
                            <select name="car_types_id" id="car_types_id" class="form-control" required>
                                <option value="" disabled {{ !isset($car) ? 'selected' : '' }}>-- Select Type --</option>
                                @foreach ($carTypes as $type)
                                    <option value="{{ $type->id }}"
                                        {{ old('car_types_id', $car->car_types_id ?? '') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="seat" class="form-label">Seat</label>
                            <input type="number" name="seat" id="seat" class="form-control" min="1"
                                value="{{ old('seat', $car->seat ?? 1) }}" required>
                        </div>

                        <div class="mb-3 col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="descriptions" id="description" class="form-control" rows="4" required>{{ old('descriptions', $car->descriptions ?? '') }}</textarea>
                        </div>

                        <div class="mb-3 col-md-12">
                            <label for="image" class="form-label">Car Image</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            @if(isset($car) && $car->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $car->image) }}" alt="Car Image" style="height: 150px; object-fit: cover;">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary">
                            {{ isset($car) ? 'Update Car' : 'Save Car' }}
                        </button>
                        <a href="{{ route('cars.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
