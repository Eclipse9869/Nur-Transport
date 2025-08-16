@extends('layouts.user')
@section('content')
@if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

@if($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="#">{{ __('message.Home') }}</a>  /  {{ __('message.Contact Us') }}</span>
          <h3>{{ __('message.Contact Us') }}</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="contact-page section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="section-heading">
            <h6>| {{ __('message.Contact Us') }}</h6>
            <h2>{{ __('message.Get In Touch With Our Company') }}</h2>
          </div>
          <p>{{ __('message.We are ready to help you plan a safe, comfortable, and memorable journey. Contact us for tour package information, transportation bookings, or any inquiries. Our team will be happy to provide the best service to meet your travel needs.') }}</p>
          <div class="row">
            <div class="col-lg-12">
              <div class="item phone">
                <img src="assets/images/phone-icon.png" alt="" style="max-width: 52px;">
                <h6>010-020-0340<br><span>{{ __('message.Phone Number') }}</span></h6>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="item email">
                <img src="assets/images/email-icon.png" alt="" style="max-width: 52px;">
                <h6>info@villa.co<br><span>{{ __('message.Business Email') }}</span></h6>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
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
        <div class="col-lg-12">
          <div id="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3942.830249403837!2d115.2059748747779!3d-8.802013391250535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd2437f99e16675%3A0x76d64a42e4ad4ea2!2sBali%20Dive%20Adventure!5e0!3m2!1sen!2sid!4v1752239068570!5m2!1sen!2sid" width="100%" height="500px" frameborder="0" style="border:0; border-radius: 10px; box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.15);" allowfullscreen=""></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
