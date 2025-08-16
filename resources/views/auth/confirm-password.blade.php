@extends('layouts.main-auth')

@section('content')
  <div class="w-full max-w-md p-8 glass rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-center">Confirm Password</h2>

    <p class="mb-6 text-sm text-gray-600 text-center">
      This is a secure area of the application. Please confirm your password before continuing.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
      @csrf

      <!-- Password -->
      <div class="mb-6">
        <label for="password" class="block text-sm font-medium mb-1">Password</label>
        <input id="password" type="password" name="password" required
          class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400"
          autocomplete="current-password" />
        @error('password')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex items-center justify-end">
        <button type="submit"
          class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition duration-200">
          Confirm
        </button>
      </div>
    </form>
  </div>
@endsection