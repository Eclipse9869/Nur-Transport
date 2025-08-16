<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

  <title>Nur Trans - Tour and Transport</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Additional CSS Files -->
  <!-- <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}"> -->
  <link rel="stylesheet" href="{{ asset('assets/css/templatemo-villa-agency.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script type="text/javascript" src="{{config('midtrans.snap_url')}}" data-client-key="{{config('midtrans.client_key')}}"></script>

  <style>
    .step {
      transition: all 0.3s ease;
    }

    .step-active {
      border-color: #f35525;
      color: #f35525;
      transform: scale(1.05);
    }

    .step-completed {
      border-color: #f35525;
      color: #f35525;
    }

    .divider {
      flex: 1;
      height: 2px;
      background-color: #e5e7eb;
    }

    .divider-active {
      background-color: #f35525;
    }
  </style>
</head>

<body>

  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>

  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <a class="logo">
              <h1>nurtrans - {{ __('message.transaction') }}</h1>
            </a>
          </nav>
        </div>
      </div>
    </div>
  </header>

  <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-8">{{ __('message.Payment Proceess') }}</h1>

    <div class="flex items-center justify-between mb-12">
      <div class="flex flex-col items-center relative step step-active" id="step1">
        <div class="w-12 h-12 rounded-full border-2 flex items-center justify-center bg-white">
          <span class="font-medium">1</span>
        </div>
        <span class="mt-2 text-sm font-medium">{{ __('message.Review') }}</span>
      </div>
      <div class="divider"></div>
      <div class="flex flex-col items-center relative step" id="step2">
        <div class="w-12 h-12 rounded-full border-2 flex items-center justify-center bg-white">
          <span class="font-medium">2</span>
        </div>
        <span class="mt-2 text-sm font-medium">{{ __('message.Payment') }}</span>
      </div>
      <div class="divider"></div>
      <div class="flex flex-col items-center relative step" id="step3">
        <div class="w-12 h-12 rounded-full border-2 flex items-center justify-center bg-white">
          <span class="font-medium">3</span>
        </div>
        <span class="mt-2 text-sm font-medium">{{ __('message.Status') }}</span>
      </div>
    </div>

    <div id="content-area">
      <!-- Step 1 -->
      <div class="step-content active" id="step1-content">
        <h2 class="text-xl font-semibold mb-4">{{ __('message.Review Your Car') }}</h2>
        <div class="border rounded-lg p-4 mb-6">
          <div class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-4">
            <div class="w-full md:w-44 h-44 bg-gray-100 rounded-md overflow-hidden border border-black">
              <img src="{{ asset('storage/' . $transaction->transactionDetails->first()->carTour->car->image) }}" class="w-full h-full object-cover" />
            </div>
            <div class="flex-1 w-full">
              <div class="flex items-center justify-between flex-wrap gap-y-2">
                <h3 class="font-medium text-lg text-black leading-tight">
                  {{ $transaction->transactionDetails->first()->carTour->car->name }} - Rp{{ number_format($transaction->transactionDetails->first()->carTour->car->price, 0, ',', '.') }}
                </h3>
                <span class="inline-block bg-[#f35525] text-white text-xs font-semibold px-3 py-1 rounded-full">
                  {{ $transaction->transactionDetails->first()->carTour->car->carType->name }}
                </span>
              </div>
              <p class="text-black text-sm mt-1">
                {{ $transaction->transactionDetails->first()->carTour->type->name }} tour - Rp{{ number_format($transaction->transactionDetails->first()->carTour->type->price, 0, ',', '.') }}
              </p>
              <p class="text-black text-sm mt-1">
                {{ $transaction->transactionDetails->first()->carTour->location->name }} - Rp{{ number_format($transaction->transactionDetails->first()->carTour->location->price, 0, ',', '.') }}
              </p>
              <p class="text-black text-sm mt-1">{{ $transaction->qty }} {{ __('message.PAX') }}</p>
              <p class="text-black text-sm mt-1">
                {{ \Carbon\Carbon::parse($transaction->transactionDetails->first()->carTour->start_date)->format('d M Y') }}
              </p>
              <p class="text-black text-sm">
                {{ \Carbon\Carbon::parse($transaction->transactionDetails->first()->carTour->start_time)->format('H:i') }} ({{ __('message.Pick Up Time') }})
              </p>
              @php
                  $carPrice = $transaction->transactionDetails->first()->carTour->car->price;
                  $typePrice = $transaction->transactionDetails->first()->carTour->type->price;
                  $locationPrice = $transaction->transactionDetails->first()->carTour->location->price;
              @endphp
              <p class="font-medium mt-2" style="color: #f35525;">Rp{{ number_format($carPrice + $typePrice + $locationPrice, 0, ',', '.') }}</p>
            </div>
          </div>
        </div> 
        
        <div class="border-t pt-6">
            <div class="text-right font-bold">
                <span class="text-2xl">Rp{{ number_format($transaction->total, 0, ',', '.') }}</span>
            </div>
        </div>

        <button id="pay-button" class="mt-6 bg-[#f35525] text-white py-3 px-6 rounded-lg font-medium hover:bg-[#d94d1f] transition w-full" onclick="nextStep()">
          {{ __('message.Continue Payment') }}
        </button>
      </div>

      <!-- Step 2 -->
      <div class="step-content hidden" id="step2-content">
        <h2 class="text-xl font-semibold mb-4">{{ __('message.Payment') }}</h2>
        <div class="space-y-4 mb-6">
          <div id="snap-container" class="w-full max-w-4xl mx-auto min-h-[600px]">
            <div id="snap-loading" class="absolute inset-0 flex justify-center items-center bg-white bg-opacity-75 z-10">
              <svg class="animate-spin h-8 w-8 text-[#f35525]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
              </svg>
            </div>
          </div>
        </div>

        <div class="flex space-x-4">
          <button class="border border-gray-300 text-gray-700 py-3 px-6 rounded-lg font-medium hover:bg-gray-50 transition flex-1" onclick="prevStep()">{{ __('message.Back') }}</button>
          <!-- <button class="bg-[#f35525] text-white py-3 px-6 rounded-lg font-medium hover:bg-[#d94d1f] transition flex-1" onclick="nextStep()">Lanjutkan Pembayaran</button> -->
        </div>
      </div>

      <!-- Step 3 -->
      <div class="step-content hidden" id="step3-content">
        <div class="text-center py-8">
          @php
              $status = $transaction->status;
          @endphp

          @if($status === 'Paid')
            <!-- Icon sukses -->
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
            </div>
            <h2 class="text-xl text-black font-semibold mb-2">{{ __('message.Payment Successful!') }}</h2>
            <p class="text-black mb-6">{{ __('message.Your tour reservation will be processed shortly. Thank you for booking with us.') }}</p>

          @elseif($status === 'Pending Payment')
            <!-- Icon warning -->
            <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 5a7 7 0 110 14 7 7 0 010-14z" />
              </svg>
            </div>
            <h2 class="text-xl text-black font-semibold mb-2">{{ __('message.Payment Not Completed') }}</h2>
            <p class="text-black mb-6">{{ __('message.Your payment is still pending. Please complete your payment to secure your booking.') }}</p>

          @elseif($status === 'Cancelled')
            <!-- Icon failed -->
            <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </div>
            <h2 class="text-xl text-black font-semibold mb-2">{{ __('message.Unfortunately, your payment could not be processed. Please try again or contact our support team.') }}x</h2>
            <p class="text-black mb-6">{{ __('message.Unfortunately, your payment could not be processed. Please try again or contact our support team.') }}</p>
          @endif

          <!-- Transaction detail (tetap muncul untuk semua status) -->
          <div class="bg-[#fff5f0] border border-[#ffdacc] rounded-lg p-4 mb-6 text-left">
            <h3 class="text-black font-medium mb-2">{{ __('message.Transaction detail:') }}</h3>
            <p class="text-sm text-black mb-1">{{ __('message.Transaction ID:') }} NRT - {{ $transaction->id }}</p>
            <p class="text-sm text-black mb-1">{{ __('message.Name of car:') }} {{ $transaction->transactionDetails->first()->carTour->car->name }}</p>
            <p class="text-sm text-black mb-1">{{ __('message.Type of car:') }} {{ $transaction->transactionDetails->first()->carTour->car->carType->name }}</p>
            <p class="text-sm text-black mb-1">{{ __('message.Start Date:') }} {{ \Carbon\Carbon::parse($transaction->start_date)->format('d M Y') }}</p>
            <p class="text-sm text-black mb-1">{{ __('message.Pick up time:') }} {{ \Carbon\Carbon::parse($transaction->start_time)->format('H:i') }}</p>
            <p class="text-sm text-black">{{ __('message.Total:') }} Rp{{ number_format($transaction->total, 0, ',', '.') }}</p>
          </div>

          <!-- Button sesuai status -->
          @if($status === 'Paid')
            <a href="{{ route('customer.myTransactions') }}">
              <button class="bg-[#f35525] text-white py-3 px-6 rounded-lg font-medium hover:bg-[#d94d1f] transition">
                {{ __('message.View My Booking') }}
              </button>
            </a>
          @elseif($status === 'Pending Payment')
            <a href="{{ route('customer.order', $transaction->id) }}">
              <button class="bg-[#f35525] text-white py-3 px-6 rounded-lg font-medium hover:bg-[#d94d1f] transition">
                {{ __('message.Continue Payment') }}Continue Payment
              </button>
            </a>
          @elseif($status === 'Cancelled')
            <a href="{{ route('customer.index') }}">
              <button class="bg-[#f35525] text-white py-3 px-6 rounded-lg font-medium hover:bg-[#d94d1f] transition">
                {{ __('message.Home') }}
              </button>
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="col-lg-8">
        <p>Copyright © 2048 Villa Agency Co., Ltd.
          Design: <a rel="nofollow" href="https://templatemo.com" target="_blank">TemplateMo</a></p>
      </div>
    </div>
  </footer>

  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/isotope.min.js') }}"></script>
  <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
  <script src="{{ asset('assets/js/counter.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <script>
      let currentStep = 1;
      let snapAlreadyInitialized = false;
      let preventReload = true;

      // 🔹 Cek apakah kita perlu langsung ke step 3 setelah reload
      if (localStorage.getItem('goToStep3') === 'true') {
          currentStep = 3;
          localStorage.removeItem('goToStep3'); // hapus supaya nggak selalu ke step 3
      }

      function allowNavigation() {
          preventReload = false;
      }

      // 🔹 Event warning reload
      window.addEventListener('beforeunload', function (e) {
          if (preventReload) {
              e.preventDefault();
              e.returnValue = '';
          }
      });

      function updateSteps() {
          document.querySelectorAll('.step').forEach(step => {
              step.classList.remove('step-active', 'step-completed');

              const stepNumber = parseInt(step.id.replace('step', ''));
              const circle = step.querySelector('div.w-12');
              const label = step.querySelector('span.mt-2');

              circle.classList.remove('border-[#f35525]', 'text-[#f35525]', 'border-gray-300', 'text-gray-400');
              label.classList.remove('text-[#f35525]', 'text-gray-400');

              if (stepNumber < currentStep) {
                  step.classList.add('step-completed');
                  circle.classList.add('border-[#f35525]', 'text-[#f35525]');
                  label.classList.add('text-[#f35525]');
              } else if (stepNumber === currentStep) {
                  step.classList.add('step-active');
                  circle.classList.add('border-[#f35525]', 'text-[#f35525]');
                  label.classList.add('text-[#f35525]');
              } else {
                  circle.classList.add('border-gray-300', 'text-gray-400');
                  label.classList.add('text-gray-400');
              }

              if (currentStep === 3) {
                  allowNavigation();
              }
          });

          const dividers = document.querySelectorAll('.divider');
          dividers.forEach((divider, index) => {
              if (index < currentStep - 1) {
                  divider.classList.add('divider-active');
              } else {
                  divider.classList.remove('divider-active');
              }
          });

          document.querySelectorAll('.step-content').forEach(content => {
              content.classList.add('hidden');
              content.classList.remove('active');
          });
          document.getElementById(`step${currentStep}-content`).classList.remove('hidden');
          document.getElementById(`step${currentStep}-content`).classList.add('active');
      }

      function nextStep() {
          if (currentStep === 1) {
              currentStep++;
              updateSteps();

              if (!snapAlreadyInitialized) {
                  const loading = document.getElementById('snap-loading');
                  loading.style.display = 'flex';

                  setTimeout(() => {
                      if (window.snap && '{{ $snapToken }}') {
                          window.snap.embed('{{ $snapToken }}', {
                              embedId: 'snap-container',
                              onSuccess: function (result) {
                                  alert("payment success!");
                                  console.log(result);
                                  allowNavigation();
                                  localStorage.setItem('goToStep3', 'true'); // 🔹 simpan flag untuk reload ke step 3
                                  location.reload();
                              },
                              onPending: function (result) {
                                  alert("waiting your payment!");
                                  console.log(result);
                                  allowNavigation();
                                  localStorage.setItem('goToStep3', 'true');
                                  location.reload();
                              },
                              onError: function (result) {
                                  alert("payment failed!");
                                  console.log(result);
                                  allowNavigation();
                              },
                              onClose: function () {
                                  alert('you closed the popup without finishing the payment');
                              }
                          });

                          setTimeout(() => {
                              loading.style.display = 'none';
                              snapAlreadyInitialized = true;
                          }, 200);
                      }
                  }, 400);
              } else {
                  const loading = document.getElementById('snap-loading');
                  loading.style.display = 'none';
              }
          } else if (currentStep === 2) {
              currentStep++;
              updateSteps();
          }
      }

      function prevStep() {
          if (currentStep > 1) {
              currentStep--;
              updateSteps();
          }
      }

      window.addEventListener('beforeunload', function (e) {
          if (preventReload) {
              e.preventDefault();
              e.returnValue = '';
          }
      });

      function allowNavigation() {
          preventReload = false;
      }

      document.addEventListener("DOMContentLoaded", function () {
          updateSteps();
      });
  </script>
</body>

</html>
