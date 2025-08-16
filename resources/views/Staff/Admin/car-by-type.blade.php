@extends('layouts.admin')

@section('content')
<div class="body-wrapper-inner">
    <div class="container-fluid">
        <h4 class="card-title mb-4">{{ $carType->name }}s</h4>

        <div class="row">
            @forelse ($cars as $car)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $car->image) }}" 
                            class="card-img-top" 
                            alt="{{ $car->name }}" 
                            style="height: 300px; object-fit: cover;">

                        <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-sm btn-warning position-absolute top-0 end-0 m-2" title="Edit">
                            <i class="ti ti-pencil"></i>
                        </a>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $car->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $car->carType->name ?? 'Unknown Type' }}</h6>
                            <p class="mb-2">Seat : {{ $car->seat }}</p>
                            <p class="mb-2">Rp {{ number_format($car->price, 0, ',', '.') }}</p>
                            <p class="card-text flex-grow-1">{{ $car->descriptions }}</p>
                            <a href="#" class="btn btn-primary mt-auto">View</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">No cars available for this type.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
