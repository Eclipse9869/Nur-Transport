@extends('layouts.main-auth')

@section('content')
  <div class="w-full max-w-md p-8 glass rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-center">Reset Password</h2>

    <p class="mb-6 text-sm text-gray-600 text-center">
      Enter your email address, choose a new password, and confirm it to reset your account password.
    </p>

    <form method="POST" action="{{ route('password.store') }}">
      @csrf

      <!-- Password Reset Token -->
      <input type="hidden" name="token" value="{{ $request->route('token') }}">

      <!-- Email Address -->
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium mb-1">Email</label>
        <input id="email" type="email" name="email"
          value="{{ old('email', $request->email) }}" required autofocus
          class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400" />
        @error('email')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Password -->
      <div class="mb-4">
        <label for="password" class="block text-sm font-medium mb-1">Password</label>
        <input id="password" type="password" name="password" required
          class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400" />
        @error('password')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Confirm Password -->
      <div class="mb-6">
        <label for="password_confirmation" class="block text-sm font-medium mb-1">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required
          class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400" />
        @error('password_confirmation')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex items-center justify-end">
        <button type="submit"
          class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition duration-200">
          Reset Password
        </button>
      </div>
    </form>
  </div>
@endsection
