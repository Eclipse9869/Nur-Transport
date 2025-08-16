@extends('layouts.user')
@section('content')
<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <span class="breadcrumb"><a href="#">{{ $car->carType->name }}</a> / {{ $car->name }}</span>
        <h3>{{ $car->name }}</h3>
      </div>
    </div>
  </div>
</div>

<div class="single-property section">
  <div class="container">
  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif
    <div class="row align-items-start">
      <div class="col-lg-8 mb-4 mb-lg-0">
        <div class="main-image mb-4">
          <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}" 
               style="width: 100%; max-width: 800px; aspect-ratio: 4 / 3; object-fit: cover; border-radius: 10px;">
        </div>
        <div class="main-content">
          <span class="category">{{ $car->carType->name }}</span>
          <h4>{{ $car->name }}</h4>
          <div class="row gx-4 gy-2 mt-4">
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
          <p>{{ $car->descriptions }}</p>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="single-property-contact-form my-4">
          <form id="contact-form" action="{{ route('customer.booking') }}" method="POST">
            @csrf
            <input type="hidden" name="cars_id" value="{{ $car->id }}">
            <input type="hidden" name="types_id" id="types_id">
            <input type="hidden" name="locations_id" id="locations_id">

            <div class="mb-3">
              <label for="name">{{ __('message.Full Name') }}</label>
              <input type="text" name="name" id="name"
                     value="{{ old('name', Auth::user()->name ?? '') }}"
                     placeholder="{{ __('message.Full Name') }}..." required>
            </div>

            <div class="mb-3">
              <label for="email">{{ __('message.Email Address') }}</label>
              <input type="email" name="email" id="email"
                     value="{{ old('email', Auth::user()->email ?? '') }}"
                     placeholder="{{ __('message.Email Address') }}..." required>
            </div>

            <div class="mb-3">
              <label for="phone">{{ __('message.Phone Number') }}</label>
              <input type="text" name="phone" id="phone"
                     value="{{ old('phone', Auth::user()->phone ?? '') }}"
                     placeholder="{{ __('message.Phone Number') }}..." required>
            </div>

            <div class="d-flex gap-2 mb-3">
              <input type="text" value="{{ $car->name }}" readonly class="form-control"
                     style="background-color: #f6f6f6; color: #3a3a3a; flex: 1;">
              <input type="text" value="Rp{{ number_format($car->price, 0, ',', '.') }}" readonly class="form-control"
                     style="font-weight: bold; background-color: #f6f6f6; color: #3a3a3a; width: 140px;">
            </div>

            <div class="mb-3">
              <label for="subject">{{ __('message.Choose Tour Type') }}</label>
              <select name="types_id" id="tour_type" class="custom-select" required>
                <option value="" disabled selected>-- {{ __('message.Choose Tour Type') }} --</option>
                @foreach ($types as $type)
                  <option value="{{ $type->id }}" 
                          data-price="{{ $type->price }}">
                    {{ $type->name }} - Rp{{ number_format($type->price, 0, ',', '.') }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="subject">{{ __('message.Choose Tour Location') }}</label>
              <select name="locations_id" id="tour_location" class="custom-select" required>
                <option value="" disabled selected>-- {{ __('message.Choose Tour Location') }} --</option>
                @foreach ($locations as $loc)
                  <option value="{{ $loc->id }}" 
                          data-price="{{ $loc->price }}">
                    {{ $loc->name }} - Rp{{ number_format($loc->price, 0, ',', '.') }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="mb-3 mt-3">
              <label for="qty">{{ __('message.Total Pax') }}</label>
              <input type="number" name="qty" id="qty" class="form-control" 
                     value="1" min="1" required oninput="validity.valid||(value='1')">
            </div>

            <!-- Tanggal (start_date) -->
            <div class="mb-3">
              <label for="start_date">{{ __('message.Tour Date') }}</label>
              <input type="date" name="start_date" id="start_date" class="form-control" 
                    value="{{ old('start_date') }}" required>
            </div>

            <!-- Jam (start_time) -->
            <div class="mb-3">
              <label for="start_time">{{ __('message.Pick Up Time') }}</label>
              <input type="time" name="start_time" id="start_time" class="form-control" 
                    value="{{ old('start_time') }}" required>
            </div>

            <div class="mb-3">
              <label for="desc">{{ __('message.Note (Optional)') }}</label>
              <textarea name="desc" id="desc" rows="4" placeholder="...">{{ old('desc') }}</textarea>
            </div>

            <div id="total-container" class="mt-3 mb-4 text-end d-none">
              <span style="font-weight: bold; font-size: 24px; color: #f35525;">
                <span id="total-price">Rp0</span>
              </span>
            </div>

            <div class="d-grid">
              <button type="button" id="book-btn" class="orange-button">{{ __('message.Book Now!') }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  new Choices('#tour_type', {
    searchEnabled: false,
    itemSelectText: '',
    shouldSort: false,
  });

  new Choices('#tour_location', {
    searchEnabled: false,
    itemSelectText: '',
    shouldSort: false,
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const dateInput = document.getElementById('start_date');
    const today = new Date();
    today.setDate(today.getDate() + 1); // Minimal besok

    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');
    const minDate = `${yyyy}-${mm}-${dd}`;
    dateInput.setAttribute('min', minDate);

    const tourTypeSelect = document.getElementById('tour_type');
    const tourLocationSelect = document.getElementById('tour_location');
    const locationIdInput = document.getElementById('locations_id');
    const typeIdInput = document.getElementById('types_id');
    const totalContainer = document.getElementById('total-container');
    const totalPrice = document.getElementById('total-price');
    const carPrice = parseInt(@json($car->price));
    const qtyInput = document.getElementById('qty');

    // Update harga saat tour type berubah
    tourTypeSelect.addEventListener('change', updateTotal);
    // Update harga saat lokasi berubah
    tourLocationSelect.addEventListener('change', updateTotal);
    // Update harga saat jumlah pax diubah
    qtyInput.addEventListener('input', updateTotal);

    function updateTotal() {
      const tourOption = tourTypeSelect.options[tourTypeSelect.selectedIndex];
      const locOption = tourLocationSelect.options[tourLocationSelect.selectedIndex];

      const tourPrice = parseInt(tourOption?.dataset.price || 0);
      const locationPrice = parseInt(locOption?.dataset.price || 0);
      const qty = parseInt(qtyInput.value) || 1;

      const selectedTypeId = tourOption?.value || '';
      const selectedLocationId = locOption?.value || '';

      // Update hidden input
      typeIdInput.value = selectedTypeId;
      locationIdInput.value = selectedLocationId;

      const total = (carPrice + tourPrice + locationPrice) * qty;

      if (tourPrice || locationPrice) {
        totalPrice.textContent = formatRupiah(total);
        totalContainer.classList.remove('d-none');
      } else {
        totalPrice.textContent = 'Rp0';
        totalContainer.classList.add('d-none');
      }
    }

    function formatRupiah(angka) {
      return 'Rp' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
  });
</script>


<script>
  document.getElementById('book-btn').addEventListener('click', function () {
    // Hapus semua pesan error dulu
    document.querySelectorAll('.text-danger').forEach(el => el.remove());

    const fields = [
      { id: 'name', label: 'Full Name' },
      { id: 'email', label: 'Email Address' },
      { id: 'phone', label: 'Phone Number' },
      { id: 'tour_type', label: 'Tour Type' },
      { id: 'tour_location', label: 'Tour Location' },
      { id: 'qty', label: 'Total Pax' },
      { id: 'start_date', label: 'Tour Date' },
      { id: 'start_time', label: 'Pick Up Time' },
    ];

    let isValid = true;

    fields.forEach(field => {
      const input = document.getElementById(field.id);
      const value = input.value.trim();

      if (!value) {
        const error = document.createElement('small');
        error.className = 'text-danger';
        error.innerText = "{{ __('message.This field cannot be empty.') }}";
        input.insertAdjacentElement('afterend', error);
        isValid = false;
      }
    });

    if (isValid) {
      Swal.fire({
        title: "{{ __('message.Are you sure you want to place this order?') }}",
        text: "{{ __('message.The data will be processed and cannot be modified!') }}",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#aaa',
        confirmButtonText: "{{ __('message.Yes, Continue!') }}",
        cancelButtonText: "{{ __('message.No') }}"
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('contact-form').submit();
        }
      });
    }
  });
</script>


@endsection
