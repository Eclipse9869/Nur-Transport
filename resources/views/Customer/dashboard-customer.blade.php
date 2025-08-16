@extends('layouts.user')
@section('content')
  <style>
    .icon-fixed {
      min-width: 20px; /* atur sesuai ukuran ideal */
      display: inline-block;
      text-align: center;
    }
  </style>

  <div class="main-banner">
    <div class="owl-carousel owl-banner">
      <div class="item item-1">
        <div class="header-text">
          <span class="category">Innova Zenix, <em>MPV car</em></span>
          <h2>{{ __('message.Spacious 6-seater') }}<br>{{ __('message.Perfect for family trips') }}</h2>
        </div>
      </div>
      <div class="item item-2">
        <div class="header-text">
          <span class="category">Hiace, <em>Big van car</em></span>
          <h2>{{ __('message.Seats up to 13') }}<br>{{ __('message.Ideal for group travel') }}</h2>
        </div>
      </div>
      <div class="item item-3">
        <div class="header-text">
          <span class="category">Innova Reborn, <em>MPV car</em></span>
          <h2>{{ __('message.Powerful and spacious') }}<br>{{ __('message.Great for long journeys') }}</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="featured section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="left-image">
            <img src="assets/images/7.png" alt="">
            <a><img src="assets/images/6.png" alt="" style="max-width: 60px; padding: 0px;"></a>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="section-heading">
            <h6>| {{ __('message.Our Services') }}</h6>
            <h2>{{ __('message.Reliable Ride') }} &amp; {{ __('message.Island Guide') }}</h2>
          </div>
          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  {{ __('message.What services do we offer?') }}
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  {{ __('message.We provide comfortable vehicles for customized sightseeing tours tailored to your preferences or our curated options. Each trip includes a private driver to ensure a smooth and enjoyable experience. Your comfort and satisfaction are our top priorities.') }}
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  {{ __('message.How to book a ride or tour?') }}
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  {{ __("message.You can book a ride or tour through our website by selecting your preferred car, tour type, pickup point, and start time. Payment can be made according to the website's terms or directly by contacting us via phone or email.") }}
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  {{ __('message.Why choose our transport service?') }}
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  {{ __("message.We offer safe and comfortable transportation with a modern, well-maintained fleet, driven by friendly and experienced drivers. With competitive rates, punctual service, and flexible trip options, we're here to make every journey more enjoyable.") }}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="info-table">
            <ul>
              <li>
                <img src="assets/images/1.png" alt="" style="max-width: 52px;">
                <h4>{{ __('message.Fleet') }}<br><span>{{ __('message.Various Vehicles') }}</span></h4>
              </li>
              <li>
                <img src="assets/images/5.png" alt="" style="max-width: 52px;">
                <h4>{{ __('message.Booking') }}<br><span>{{ __('message.Fast & easy process') }}</span></h4>
              </li>
              <li>
                <img src="assets/images/3.png" alt="" style="max-width: 52px;">
                <h4>{{ __('message.Payment') }}<br><span>{{ __('message.Flexible methods') }}</span></h4>
              </li>
              <li>
                <img src="assets/images/4.png" alt="" style="max-width: 52px;">
                <h4>{{ __('message.Safety') }}<br><span>{{ __('message.Trusted drivers') }}</span></h4>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="section best-deal">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="section-heading">
            <h6>| {{ __('message.Best Tour') }}</h6>
            <h2>{{ __('message.Find the Perfect Tour For You!') }}</h2>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="tabs-content">
            <div class="row">
              <div class="nav-wrapper ">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="appartment-tab" data-bs-toggle="tab" data-bs-target="#appartment" type="button" role="tab" aria-controls="appartment" aria-selected="true">Check In/Out</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="villa-tab" data-bs-toggle="tab" data-bs-target="#villa" type="button" role="tab" aria-controls="villa" aria-selected="false">Half Day Tour</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="penthouse-tab" data-bs-toggle="tab" data-bs-target="#penthouse" type="button" role="tab" aria-controls="penthouse" aria-selected="false">Full Day Tour</button>
                  </li>
                </ul>
              </div>              
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="appartment" role="tabpanel" aria-labelledby="appartment-tab">
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="info-table">
                        <ul>
                          <li>{{ __('message.Duration') }} <span>{{ __('message.1-2 Hours') }}</span></li>
                          <li>{{ __('message.Area') }} <span>{{ __('message.All Bali Areas') }}</span></li>
                          <li>{{ __('message.Price') }} <span>Rp {{ number_format($types[2]->price, 0, ',', '.') }}</span></li>
                          <li>{{ __('message.Pickup Point') }} <span>{{ __('message.Flexible') }}</span></li>
                          <li>{{ __('message.Payment Process') }} <span>{{ __('message.Variable') }}</span></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <img src="assets/images/8-1.png" alt="">
                    </div>
                    <div class="col-lg-3">
                      <h4>{{ __('message.Detail Info About Check In/Out') }}</h4>
                      <p>{{ __('message.Our Check In/Out service provides reliable and comfortable transport to or from the airport, hotel, or any location across Bali. With clean, air-conditioned vehicles and professional drivers, we ensure a smooth and stress-free journey.') }} 
                      <br><br>{{ __('message.The service runs 24/7 and is tailored to your flight schedule, including up to 90 minutes of free waiting time for pickups. Perfect for arrivals or departures with peace of mind.') }}</p>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="villa" role="tabpanel" aria-labelledby="villa-tab">
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="info-table">
                        <ul>
                          <li>{{ __('message.Duration') }} <span>{{ __('message.6 Hours') }}</span></li>
                          <li>{{ __('message.Area') }} <span>{{ __('message.All Bali Areas') }}</span></li>
                          <li>{{ __('message.Price') }} <span>Rp {{ number_format($types[0]->price, 0, ',', '.') }}</span></li>
                          <li>{{ __('message.Pickup Point') }} <span>{{ __('message.Flexible') }}</span></li>
                          <li>{{ __('message.Payment Process') }} <span>{{ __('message.Variable') }}</span></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <img src="assets/images/9-1.png" alt="">
                    </div>
                    <div class="col-lg-3">
                      <h4>{{ __('message.Detail Info About Half Day') }}</h4>
                      <p>{{ __("message.Our Half Day Tour (4-6 hours) is perfect for those who want to explore Bali's highlights in a short time. Visit temples, beaches, or local markets based on your preferences.") }} 
                      <br><br>{{ __("message.With a private vehicle and a friendly driver, you'll enjoy a comfortable and flexible trip—ideal for a relaxed morning or afternoon adventure.") }}</p>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="penthouse" role="tabpanel" aria-labelledby="penthouse-tab">
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="info-table">
                        <ul>
                          <li>{{ __('message.Duration') }} <span>{{ __('message.12 Hours') }}</span></li>
                          <li>{{ __('message.Area') }} <span>All Bali Areas</span></li>
                          <li>{{ __('message.Price') }} <span>Rp {{ number_format($types[1]->price, 0, ',', '.') }}</span></li>
                          <li>{{ __('message.Pickup Point') }} <span>{{ __('message.Flexible') }}</span></li>
                          <li>{{ __('message.Payment Process') }} <span>{{ __('message.Variable') }}</span></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <img src="assets/images/10.png" alt="">
                    </div>
                    <div class="col-lg-3">
                      <h4>{{ __('message.Detail Info About Full Day') }}</h4>
                      <p>{{ __('message.Explore Bali to the fullest with our 12-hour Full Day Tour. Visit top destinations like temples, waterfalls, beaches, and cultural sites—all in one trip.') }}
                      <br><br>{{ __('message.Enjoy a private vehicle, flexible itinerary, and a local driver who will guide you comfortably throughout the day. Perfect for those who want to see and experience more of Bali in one go.') }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="properties section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 offset-lg-4">
          <div class="section-heading text-center">
            <h6>| {{ __('message.Our Cars') }}</h6>
            <h2>{{ __('message.We Provide the Best Cars for You') }}</h2>
          </div>
        </div>
      </div>
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
    </div>
  </div>

  <div class="video section">
    <div class="container">
      <div class="section-heading-v">
        <h6>| {{ __('message.About Us') }}</h6>
        <h2>{{ __('message.Our Journey') }}</h2>
      </div>

      <div class="steps-list">
        <div class="step-item left">
          <div class="step-number">2017</div>
          <div class="step-content">
            <h3>{{ __('message.Company Founded') }}</h3>
            <p>{{ __('message.Our dynamic transport company began operations, offering private and comfortable transportation services with various vehicle types to meet customer needs.') }}</p>
          </div>
        </div>

        <div class="step-item right">
          <div class="step-number">2019</div>
          <div class="step-content">
            <h3>{{ __('message.Facing Global Challenges') }}</h3>
            <p>{{ __('message.The COVID-19 pandemic brought unexpected challenges, but we remained committed to serving our clients with safety as our top priority.') }}</p>
          </div>
        </div>

        <div class="step-item left">
          <div class="step-number">2021</div>
          <div class="step-content">
            <h3>{{ __('message.Recovery & Service Improvement') }}</h3>
            <p>{{ __('message.After surviving the pandemic, we focused on upgrading our services and ensuring our customers enjoy reliable and stress-free transportation.') }}</p>
          </div>
        </div>

        <div class="step-item right">
          <div class="step-number">2023</div>
          <div class="step-content">
            <h3>{{ __('message.Expanding Customer Experience') }}</h3>
            <p>{{ __('message.Introduced flexible travel options, allowing customers to choose their own routes or enjoy our recommended itineraries.') }}</p>
          </div>
        </div>

        <div class="step-item left">
          <div class="step-number">2025</div>
          <div class="step-content">
            <h3>{{ __('message.Sustainable Future') }}</h3>
            <p>{{ __('message.Moving forward, we continue to improve our services and invest in eco-friendly transportation to support responsible travel.') }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="fun-facts">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="wrapper">
            <div class="row">
              <div class="col-lg-4">
                <div class="counter">
                  <h2 class="timer count-title count-number" data-to="340" data-speed="1000"></h2>
                  <p class="count-text">{{ __('message.Successful') }}<br>{{ __('message.Trips') }}</p>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="counter">
                  <h2 class="timer count-title count-number" data-to="12" data-speed="1000"></h2>
                  <p class="count-text">{{ __('message.Years of') }}<br>{{ __('message.Experience') }}</p>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="counter">
                  <h2 class="timer count-title count-number" data-to="500" data-speed="1000"></h2>
                  <p class="count-text">{{ __('message.Happy') }}<br>{{ __('message.Customers') }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="contact section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 offset-lg-4">
          <div class="section-heading text-center">
            <h6>| {{ __('message.Contact Us') }}</h6>
            <h2>{{ __('message.Get In Touch With Our Company') }}</h2>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="contact-content">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
          <div id="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3942.830249403837!2d115.2059748747779!3d-8.802013391250535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd2437f99e16675%3A0x76d64a42e4ad4ea2!2sBali%20Dive%20Adventure!5e0!3m2!1sen!2sid!4v1752239068570!5m2!1sen!2sid" width="100%" height="500px" frameborder="0" style="border:0; border-radius: 10px; box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.15);" allowfullscreen=""></iframe>          
          </div>
          <div class="row">
            <div class="col-lg-5">
              <div class="item phone">
                <img src="assets/images/phone-icon.png" alt="" style="max-width: 52px;">
                <h6>+628113962226<br><span>{{ __('message.Phone Number') }}</span></h6>
              </div>
            </div>
            <div class="col-lg-7">
              <div class="item email">
                <img src="assets/images/email-icon.png" alt="" style="max-width: 52px;">
                <h6>bali.tauchen@gmail.com<br><span>{{ __('message.Business Email') }}</span></h6>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <form id="contact-form" action="{{ route('customer.send') }}" method="POST">
          @csrf
            <div class="row">
              <div class="col-lg-12">
                <fieldset>
                  <label for="name">{{ __('message.Full Name') }}</label>
                  <input type="name" name="name" id="name" placeholder="{{ __('message.Full Name') }}..." autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="email">{{ __('message.Email Address') }}</label>
                  <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="{{ __('message.Email Address') }}..." required="">
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="subject">{{ __('message.Subject') }}</label>
                  <input type="subject" name="subject" id="subject" placeholder="{{ __('message.Subject') }}..." autocomplete="on" >
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="phone">{{ __('message.Phone Number') }}</label>
                  <input type="phone" name="phone" id="phone" placeholder="{{ __('message.Phone Number') }}..." autocomplete="on" >
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="message">{{ __('message.Message') }}</label>
                  <textarea name="message" id="message" placeholder="{{ __('message.Message') }}..."></textarea>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <button type="submit" id="form-submit" class="orange-button">{{ __('message.Send Message') }}</button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection