<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full focus:border-red-500 focus:ring-red-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full focus:border-red-500 focus:ring-red-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full focus:border-red-500 focus:ring-red-500"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full focus:border-red-500 focus:ring-red-500"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="text-sm font-semibold text-gray-600" href="{{ route('login') }}">
                {{ __('Sudah Daftar?') }}
            </a>

            <!-- Tombol diganti style-nya menjadi merah -->
            <x-primary-button class="ms-4 bg-red-600 hover:bg-red-700 focus:bg-red-700 active:bg-red-800 ring-red-500">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 flex justify-center">
        <a href="{{ url('/') }}"
        class="inline-flex items-center text-sm font-bold text-black-600 hover:text-red-700 transition group">
            <span class="mr-1 group-hover:-translate-x-1 transition"></span>
             ← Kembali ke Beranda
        </a>
    </div>
    
</x-guest-layout>