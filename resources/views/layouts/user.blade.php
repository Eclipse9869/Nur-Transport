<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons/css/flag-icons.min.css">

  <title>Nur Trans - Tour and Transport</title>

  <style>
    .dropdown-menu {
      display: none;
      left: auto;
      right: 0; /* Biar dropdown nempel ke kanan toggle */
      min-width: 200px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .dropdown-menu.show {
      display: block;
    }

    @media (max-width: 992px) {
      .dropdown-menu {
        position: static; /* biar aman di mobile layout */
        box-shadow: none;
      }

      .language-mobile a {
        color: inherit; /* ikut warna teks parent */
        text-decoration: none; /* hilangin underline */
        font-weight: 500; /* biar sama tebalnya seperti menu lainnya */
      }

      .language-mobile a:hover {
        color: #f35525; /* efek hover sama kayak menu */
      }
    }

    .hover-orange:hover {
      color: #f35525 !important;
    }

    .hover-orange-wrapper:hover .hover-orange {
      color: #f35525 !important;
    }
  </style>
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/templatemo-villa-agency.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/my-transaction.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
  <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
</head>

<body>
  <!-- ***** Preloader Start ***** -->
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
  <!-- ***** Preloader End ***** -->

  <div class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8">
          <ul class="info">
            <li><i class="fa fa-envelope"></i> bali.tauchen@gmail.com</li>
            <li><i class="fa fa-map"></i> Jl. Wisma Nusa Permai No.C7, Nusa Dua, Bali 80363</li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-4">
          <ul class="social-links">
            <li><a href="#"><i class="fab fa-facebook"></i></a></li>
            <li><a href="#" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{ route('customer.index') }}" class="logo">
                        <h1>nurtrans</h1>
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                      <li>
                        <a href="{{ route('customer.index') }}" 
                          class="{{ request()->routeIs('customer.index') ? 'active' : '' }}">
                          {{ __('message.Home') }}
                        </a>
                      </li>
                      <li>
                        <a href="{{ route('customer.cars') }}" 
                          class="{{ request()->routeIs('customer.cars') ? 'active' : '' }}">
                          {{ __('message.Cars') }}
                        </a>
                      </li>
                      <li style="position: relative; font-family: 'Poppins', sans-serif;">
                        <a href="javascript:void(0);" style="pointer-events: none; cursor: not-allowed; opacity: 0.85; position: relative; color: #888;">
                          {{ __('message.Packages') }}
                          <span style="
                            position: absolute;
                            top: -8px;
                            right: -12px;
                            color: #f35525;
                            font-size: 9px;
                            font-weight: 900;
                            text-transform: uppercase;
                            transform: rotate(15deg);
                            white-space: nowrap;
                            letter-spacing: 1px;
                            text-shadow: 0 1px 1px rgba(0,0,0,0.15);
                            opacity: 0.95;
                          ">
                            {{ __('message.Coming Soon!') }}
                          </span>
                        </a>
                      </li>
                      <li>
                        <a href="{{ route('customer.contact') }}" 
                          class="{{ request()->routeIs('customer.contact') ? 'active' : '' }}">
                          {{ __('message.Contact Us') }}
                        </a>
                      </li>

                      <!-- Language Selector -->
                      <li class="dropdown d-none d-lg-block">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-globe-asia me-1"></i> {{ strtoupper(app()->getLocale()) }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="{{ route('setLanguage', 'en') }}">
                            <span class="fi fi-gb me-2"></span>English - EN
                          </a>
                          <a class="dropdown-item" href="{{ route('setLanguage', 'ru') }}">
                            <span class="fi fi-ru me-2"></span>Russia - RU
                          </a>
                        </div>
                      </li>

                      {{-- TAMPILAN DESKTOP SAJA --}}
                      <li class="d-none d-lg-block">
                        @guest
                          <a href="{{ route('login') }}">
                            <i class="fa fa-user me-2"></i>{{ __('message.Login/Signup') }}
                          </a>
                        @else
                          <li class="dropdown d-none d-lg-block">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-user me-1"></i><strong> {{ Auth::user()->name }}</strong>
                            </a>
                            <div class="dropdown-menu">
                              <a href="{{ route('customer.myTransactions') }}" class="dropdown-item">
                                <i class="fa fa-list"></i> {{ __('message.My Transactions') }}
                              </a>
                              <form method="POST" action="{{ route('logout') }}" class="dropdown-item">
                                @csrf
                                <x-responsive-nav-link :href="route('logout')"
                                  class="btn d-block text-center"
                                  onclick="event.preventDefault(); this.closest('form').submit();">
                                  <i class="fa fa-sign-out-alt"></i> {{ __('message.Log Out') }}
                                </x-responsive-nav-link>
                              </form>
                            </div>
                          </li>
                        @endguest
                      </li>
                      
                      {{-- TAMPILAN MOBILE KALAU BELUM LOGIN --}}
                      @guest
                      <li class="d-block d-lg-none border-top">
                        <a href="{{ route('login') }}">
                          <i class="fa fa-user me-2"></i>{{ __('message.Login/Signup') }}
                        </a>
                      </li>
                      @endguest

                      {{-- BAGIAN INI TAMPIL DI MOBILE KALAU SUDAH LOGIN --}}
                      @auth
                      <li class="d-block d-lg-none border-top auth-mobile-item">
                        <div class="d-flex align-items-center px-3" style="height: 50px;">

                          {{-- Username + Icon --}}
                          <div class="d-flex align-items-center hover-orange-wrapper" style="flex: 1; min-width: 0;">
                            <i class="fa fa-user me-2 hover-orange text-dark"></i>
                            <span class="fw-bold text-dark text-truncate hover-orange">{{ Auth::user()->name }}</span>
                          </div>

                          {{-- My Transactions --}}
                          <div class="d-flex justify-content-center" style="flex: 1;">
                            @php
                              $isMyTransactionActive = request()->routeIs('customer.myTransactions');
                            @endphp
                            <a href="{{ route('customer.myTransactions') }}"
                              class="text-decoration-none text-nowrap fw-bold {{ $isMyTransactionActive ? '' : 'text-dark' }}"
                              @if($isMyTransactionActive)
                                style="color: #f35525; font-weight: 900;"
                              @endif>
                              {{ __('message.My Transactions') }}
                            </a>
                          </div>

                          {{-- Logout --}}
                          <div class="d-flex justify-content-end" style="flex: 1; min-width: 0;">
                            <form method="POST" action="{{ route('logout') }}">
                              @csrf
                              <button type="submit" class="btn btn-sm px-2 py-1" style="background: none; border: none; color: #000;">
                                <i class="fa fa-sign-out-alt hover-orange"></i>
                              </button>
                            </form>
                          </div>

                        </div>
                      </li>
                    @endauth
                    </ul>
                    
                  <!-- Toggle bahasa mobile -->
                  <div class="d-block d-lg-none language-mobile" style="position:absolute; top:28px; right:75px;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-globe-asia me-1"></i> {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="{{ route('setLanguage', 'en') }}">
                        <span class="fi fi-gb me-2"></span>English - EN
                      </a>
                      <a class="dropdown-item" href="{{ route('setLanguage', 'ru') }}">
                        <span class="fi fi-ru me-2"></span>Russia - RU
                      </a>
                    </div>
                  </div>

                  <!-- Hamburger menu -->
                  <a class="menu-trigger"><span>{{ __('message.Menu') }}</span></a>
                  <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->
  @yield('content')

  <footer>
    <div class="container">
      <div class="col-lg-8">
        <p>Copyright © 2025 Nur Trans Co., Ltd. All rights reserved. 
        
        Design: <a rel="nofollow" href="https://templatemo.com" target="_blank">TemplateMo</a></p>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/isotope.min.js') }}"></script>
  <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
  <script src="{{ asset('assets/js/counter.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      document.querySelectorAll(".dropdown-toggle").forEach(function(toggle) {
        const menu = toggle.nextElementSibling; // dropdown di sebelahnya

        toggle.addEventListener("click", function (e) {
          e.preventDefault();
          menu.classList.toggle("show");
        });

        document.addEventListener("click", function (e) {
          if (!toggle.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.remove("show");
          }
        });
      });
    });
  </script>

  </body>
</html>