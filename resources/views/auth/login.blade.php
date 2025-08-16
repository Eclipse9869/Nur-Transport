@extends('layouts.main-auth')
@section('content')
  <!-- Need Help? di pojok kanan atas -->
  <a href="https://wa.me/628113962226" target="_blank" rel="noopener noreferrer"
    class="absolute top-6 right-16 text-[#f35525] font-semibold text-sm md:text-base hover:underline cursor-pointer z-50">
    {{ __('message.Contact Us') }}.
  </a>
  <div class="flex w-full min-h-screen flex-col lg:flex-row items-center justify-center px-6 lg:-translate-x-14">
    <!-- Left Side Image -->
    <div class="hidden lg:flex w-[40%] items-center">
      <img src="{{ asset('image/bg-login.png') }}" alt="Background" class="w-full h-auto max-h-full object-contain">
    </div>

    <!-- Right Side Panel -->
    <div class="relative w-full max-w-xl h-[640px] rounded-3xl overflow-hidden shadow-[0_0_25px_rgba(0,0,0,0.1)] glass mt-10 md:mt-10">
      <!-- Panel Container -->
      <div class="w-[200%] h-full flex slide-panel" id="panelWrapper">
        <!-- Login Panel -->
        <div class="w-1/2 h-full flex flex-col justify-center items-center px-10">
          <h2 class="text-4xl font-bold mb-4 text-[#f35525]">{{ __('message.Login') }}</h2>
          @if ($errors->any() && session('form') === 'login')
              <div class="mb-4 text-red-400 text-sm space-y-1">
                  @foreach ($errors->all() as $error)
                      <div>{{ $error }}</div>
                  @endforeach
              </div>
          @endif
          <form method="POST" action="{{ route('login') }}" class="w-full space-y-4">
            @csrf
            <input type="hidden" name="form_type" value="login">
            <input type="email" name="email" placeholder="{{ __('message.Email') }}" class="w-full bg-white px-4 py-2 rounded-xl text-[#111827] placeholder-gray-400 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#f35525]" required>
            <input type="password" name="password" placeholder="{{ __('message.Password') }}" class="w-full bg-white px-4 py-2 rounded-xl text-[#111827] placeholder-gray-400 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#f35525]" required>
            <div class="flex justify-between items-center text-sm">
              <label class="inline-flex items-center text-[#f35525]">
                <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 text-blue-500 rounded bg-white/20 border-white/30 focus:ring-blue-400">
                <span class="ml-2">{{ __('message.Remember me') }}</span>
              </label>
              @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="underline text-[#f35525] hover:text-orange-500">{{ __('message.Forgot Password?') }}</a>
              @endif
            </div>
            <button type="submit" class="w-full bg-[#f35525] text-white font-semibold py-2 rounded-xl hover:bg-orange-500 transition">{{ __('message.Login') }}</button>
          </form>

          <!-- Link to switch to Register -->
          <p class="text-sm text-center mt-4">
            {{ __("message.Don't have an account?") }}
            <button type="button" id="switchToRegister" class="text-[#f35525] underline hover:text-orange-500 ml-1">{{ __('message.Sign Up') }}</button>
          </p>
        </div>

        <!-- Register Panel -->
        <div class="w-1/2 h-full flex flex-col justify-center items-center px-10">
          <h2 class="text-4xl font-bold mb-4 text-[#f35525]">{{ __('message.Sign Up') }}</h2>
          @if ($errors->any() && session('form') === 'register')
              <div class="mb-4 text-red-400 text-sm">
                  <div>{{ $errors->first() }}</div>
              </div>
          @endif
          <form method="POST" action="{{ route('register') }}" class="w-full space-y-4">
            @csrf
            <input type="hidden" name="form_type" value="register">
            <input type="text" name="name" placeholder="{{ __('message.Full Name') }}" class="w-full bg-white px-4 py-2 rounded-xl text-[#111827] placeholder-gray-400 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#f35525]" required>
            <input type="email" name="email" placeholder="{{ __('message.Email') }}" class="w-full bg-white px-4 py-2 rounded-xl text-[#111827] placeholder-gray-400 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#f35525]" required>
            <input type="text" name="phone" placeholder="{{ __('message.Phone Number') }}" class="w-full bg-white px-4 py-2 rounded-xl text-[#111827] placeholder-gray-400 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#f35525]" required>
            <input type="password" name="password" placeholder="{{ __('message.Password') }}" class="w-full bg-white px-4 py-2 rounded-xl text-[#111827] placeholder-gray-400 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#f35525]" required>
            <ul id="passwordRules" class="text-sm space-y-1 mt-1">
              <li class="flex items-center text-gray-400" data-rule="length">
                <span class="inline-block min-w-[240px]">{{ __('message.At least 8 characters') }}</span>
                <span class="check-icon hidden text-[#f35525] text-sm ml-1">✔</span>
              </li>
              <li class="flex items-center text-gray-400" data-rule="uppercase">
                <span class="inline-block min-w-[240px]">{{ __('message.At least one uppercase letter') }}</span>
                <span class="check-icon hidden text-[#f35525] text-sm ml-1">✔</span>
              </li>
              <li class="flex items-center text-gray-400" data-rule="lowercase">
                <span class="inline-block min-w-[240px]">{{ __('message.At least one lowercase letter') }}</span>
                <span class="check-icon hidden text-[#f35525] text-sm ml-1">✔</span>
              </li>
              <li class="flex items-center text-gray-400" data-rule="number">
                <span class="inline-block min-w-[240px]">{{ __('message.At least one number') }}</span>
                <span class="check-icon hidden text-[#f35525] text-sm ml-1">✔</span>
              </li>
            </ul>
            <input type="password" name="password_confirmation" placeholder="{{ __('message.Confirm Password') }}" class="w-full bg-white px-4 py-2 rounded-xl text-[#111827] placeholder-gray-400 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#f35525]" required>
            <div class="flex items-start gap-2 text-sm text-[#111827]">
              <input type="checkbox" id="terms" name="terms" required class="mt-1 h-4 w-4 text-[#f35525] border-gray-300 rounded focus:ring-[#f35525]">
              <label for="terms">
                {{ __('message.I agree to the') }} 
                <button type="button" class="text-[#f35525] underline hover:text-orange-500" onclick="document.getElementById('termsModal').classList.remove('hidden')">
                  {{ __('message.Terms and Conditions') }}
                </button>
              </label>
            </div>
            <button type="submit" class="w-full bg-[#f35525] text-white font-semibold py-2 rounded-xl hover:bg-orange-500 transition">Sign Up</button>
          </form>

          <!-- Link to switch to Login -->
          <p class="text-sm text-center mt-4">
            {{ __('message.Already have an account?') }}
            <button type="button" id="switchToLogin" class="text-[#f35525] underline hover:text-orange-500 ml-1">{{ __('message.Login') }}</button>
          </p>
        </div>
      </div>
    </div>

    <!-- Terms and Conditions Modal -->
    <div id="termsModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 hidden">
      <div class="bg-white max-w-xl w-full rounded-2xl p-6 shadow-lg relative">
        <!-- Close Button -->
        <button class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-xl font-bold" onclick="document.getElementById('termsModal').classList.add('hidden')">&times;</button>

        <h2 class="text-2xl font-bold text-[#f35525] mb-4">{{ __('message.Terms and Conditions') }}</h2>
        <div class="text-sm text-gray-700 space-y-3 max-h-[60vh] overflow-y-auto pr-2">
          <p>{{ __('message.By creating an account, you agree to the following terms:') }}</p>
          <ul class="list-disc list-inside space-y-2">
            <li>{{ __('message.You must provide accurate and complete information.') }}</li>
            <li>{{ __('message.You are responsible for maintaining the confidentiality of your account credentials.') }}</li>
            <li>{{ __('message.Use of the platform must comply with applicable laws and must not be used for fraudulent purposes.') }}</li>
            <li>{{ __('message.We reserve the right to suspend or terminate accounts that violate our policies.') }}</li>
            <li>{{ __('message.Your data may be used for service improvement and analytics in accordance with our privacy policy.') }}</li>
            <li>{{ __('message.We may update these terms from time to time; continued use constitutes agreement to the changes.') }}</li>
          </ul>
          <p>{{ __('message.If you do not agree with these terms, please do not register an account.') }}</p>
        </div>

        <!-- Close Modal Button -->
        <div class="mt-6 text-right">
          <button onclick="document.getElementById('termsModal').classList.add('hidden')" class="bg-[#f35525] text-white px-4 py-2 rounded-xl hover:bg-orange-500 transition">
            {{ __('message.Close') }}
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Script -->
  <script>
    const wrapper = document.getElementById('panelWrapper');
    const currentForm = "{{ session('form') }}";

    // Inisialisasi posisi saat load
    if (currentForm === 'register') {
        wrapper.style.transform = 'translateX(-50%)';
    } else {
        wrapper.style.transform = 'translateX(0%)';
    }

    // Manual toggle
    document.getElementById('switchToRegister')?.addEventListener('click', () => {
        wrapper.style.transform = 'translateX(-50%)';
    });

    document.getElementById('switchToLogin')?.addEventListener('click', () => {
        wrapper.style.transform = 'translateX(0%)';
    });
  </script>
  <script>
    const registerPasswordInput = document.querySelector(`form[action="{{ route('register') }}"] input[name="password"]`);
    const rules = {
      length: /.{8,}/,
      uppercase: /[A-Z]/,
      lowercase: /[a-z]/,
      number: /\d/,
    };

    if (registerPasswordInput) {
      registerPasswordInput.addEventListener('input', () => {
        Object.entries(rules).forEach(([rule, regex]) => {
          const ruleItem = document.querySelector(`[data-rule="${rule}"]`);
          const checkIcon = ruleItem.querySelector('.check-icon');

          if (regex.test(registerPasswordInput.value)) {
            ruleItem.classList.remove('text-gray-400');
            ruleItem.classList.add('text-[#f35525]');
            checkIcon.classList.remove('hidden');
          } else {
            ruleItem.classList.add('text-gray-400');
            ruleItem.classList.remove('text-[#f35525]');
            checkIcon.classList.add('hidden');
          }
        });
      });
    }
  </script>
@endsection
