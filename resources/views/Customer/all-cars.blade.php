@extends('layouts.user')
@section('content')
  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="{{ route('customer.index') }}">{{ __('message.Home') }}</a> / {{ __('message.Cars') }}</span>
          <h3>{{ __('message.Our Cars') }}</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="section properties">
    <div class="container">

      <!-- Filter buttons -->
      <ul class="properties-filter">
        <li>
          <a class="{{ request('type') == 'all' || request('type') == null ? 'is_active' : '' }}"
            href="{{ route('customer.cars', ['type' => 'all']) }}"
            data-filter="*">
            Show All
          </a>
        </li>
        @foreach($carTypes as $type)
          <li>
            <a class="{{ Str::slug(request('type')) == Str::slug($type->name) ? 'is_active' : '' }}"
              href="{{ route('customer.cars', ['type' => $type->name]) }}"
              data-filter=".type-{{ Str::slug($type->name) }}">
              {{ $type->name }}
            </a>
          </li>
        @endforeach
      </ul>

      <!-- Car cards -->
      <div class="row">
      @forelse ($cars as $car)
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="item">
            <a href="#">
              <img 
                src="{{ asset('storage/' . $car->image) }}" 
                alt="{{ $car->name }}" 
                style="height: 238px; width: 100%; object-fit: contain; border-radius: 10px; background-color: #f5f5f5;">
            </a>
              <span class="category">{{ $car->carType->name ?? 'Unknown Type' }}</span>
              <h6>Rp {{ number_format($car->price, 0, ',', '.') }}</h6>
              <h4><a href="#">{{ $car->name }}</a></h4>

              <div class="row gx-4 gy-2 mt-3">
                <div class="col-6">
                  <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-user-tie text-muted icon-fixed me-2"></i>
                    <span>{{ __('message.Driver Included') }}</span>
                  </div>
                  <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-users text-muted icon-fixed me-2"></i>
                    <span>{{ $car->seat }}-{{ __('message.Seater') }}</span>
                  </div>
                  <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-wind text-muted icon-fixed me-2"></i>
                    <span>{{ __('message.Full AC') }}</span>
                  </div>
                </div>
                <div class="col-6">
                  <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-car-side text-muted icon-fixed me-2"></i>
                    <span>{{ __('message.Well Maintained') }}</span>
                  </div>
                  <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-bolt text-muted icon-fixed me-2"></i>
                    <span>{{ __('message.Charger Port') }}</span>
                  </div>
                  <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-wine-bottle text-muted icon-fixed me-2"></i>
                    <span>{{ __('message.Free Water') }}</span>
                  </div>
                </div>
              </div>

              <div class="main-button mt-2">
                <a href="{{ route('customer.detailCar', $car->id) }}">{{ __('message.Book Now!') }}</a>
              </div>
              
            </div>
          </div>
        @empty
          <div class="col-12 text-center">
            <p>{{ __('message.No cars available at the moment.') }}</p>
          </div>
        @endforelse
      </div>

      <!-- Pagination -->
      @if ($cars instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="row">
          <div class="col-lg-12">
            <ul class="pagination">
              @if ($cars->onFirstPage())
                <li><a href="#" class="disabled">&laquo;</a></li>
              @else
                <li><a href="{{ $cars->previousPageUrl() }}">&laquo;</a></li>
              @endif

              @for ($i = 1; $i <= $cars->lastPage(); $i++)
                @if ($i == $cars->currentPage())
                  <li><a class="is_active" href="#">{{ $i }}</a></li>
                @else
                  <li><a href="{{ $cars->url($i) }}">{{ $i }}</a></li>
                @endif
              @endfor

              @if ($cars->hasMorePages())
                <li><a href="{{ $cars->nextPageUrl() }}">&raquo;</a></li>
              @else
                <li><a href="#" class="disabled">&raquo;</a></li>
              @endif
            </ul>
          </div>
        </div>
      @endif

    </div>
  </div>
@endsection
