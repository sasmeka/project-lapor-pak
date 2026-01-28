<x-guest-layout>

    <style>
        .akun-text {
            font-size: 0.90rem;
        }
        @media (max-width: 576px) {
            .akun-text {
                font-size: 0.8rem;
            }
        }
    </style>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email"
                class="block mt-1 w-full focus:border-red-500 focus:ring-red-500"
                type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password"
                class="block mt-1 w-full focus:border-red-500 focus:ring-red-500"
                type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600">Remember me</span>
            </label>
        </div>

        <!-- Forgot password -->
        {{-- @if (Route::has('password.request'))
            <div class="mt-4 text-right">
                <a href="{{ route('password.request') }}"
                    class="text-sm text-gray-600">
                    Forgot your password?
                </a>
            </div>
        @endif --}}

        <!-- Tombol Login -->
        <x-primary-button 
            class="w-full justify-center py-3 text-base font-semibold mt-4
                   bg-red-600 hover:bg-red-700 focus:bg-red-700 active:bg-red-800 ring-red-500">
            {{ __('Log in') }}
        </x-primary-button>

        <!-- Link Register (STYLE SAMA KAYA REGISTER PAGE) -->
        <div class="text-center mt-4 akun-text">
            <a href="{{ route('register') }}"
               class="text-gray-600">
                Belum Punya Akun? <span class="font-semibold">Daftar Sekarang</span>
            </a>
        </div>

    </form>

    <div class="mt-6 flex justify-center">
        <a href="{{ url('/') }}"
        class="inline-flex items-center text-sm font-medium text-black-600 fw-bold hover:text-red-700 transition group">
            <span class="mr-1 group-hover:-translate-x-1 transition"></span>
             ← Kembali ke Beranda
        </a>
    </div>

</x-guest-layout>


