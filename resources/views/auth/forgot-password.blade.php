@extends('layouts.main-auth')

@section('content')
  <div class="w-full max-w-md p-8 glass rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-center">Forgot Password</h2>
    
    <p class="mb-6 text-sm text-gray-600 text-center">
      Forgot your password? No problem. Just let us know your email address and we'll send you a password reset link.
    </p>

    <!-- Session Status -->
    @if (session('status'))
      <div class="mb-4 text-green-600 text-sm">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
      @csrf

      <!-- Email Address -->
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium mb-1">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
          class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400" />
        @error('email')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex items-center justify-end mt-6">
        <button type="submit"
          class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition duration-200">
          Email Password Reset Link
        </button>
      </div>
    </form>
  </div>
@endsection
