@extends('layouts.main-auth')

@section('content')
  <div class="w-full max-w-md p-8 glass rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-center">Verify Your Email</h2>

    <p class="mb-6 text-sm text-gray-600 text-center">
      Thanks for signing up! Before getting started, please verify your email address by clicking the link we just emailed to you. 
      If you didn't receive the email, we will gladly send you another.
    </p>

    @if (session('status') == 'verification-link-sent')
      <div class="mb-4 text-green-600 text-sm text-center">
        A new verification link has been sent to the email address you provided during registration.
      </div>
    @endif

    <div class="flex items-center justify-between mt-6">
      <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit"
          class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition duration-200">
          Resend Verification Email
        </button>
      </form>

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
          class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400">
          Log Out
        </button>
      </form>
    </div>
  </div>
@endsection