@extends('layouts.login')

@section('content-login')
<style>
    html[data-theme="dark"] input:-webkit-autofill {
        background-color: #1f2937 !important;
        -webkit-box-shadow: 0 0 0px 1000px #1f2937 inset !important;
        color: #ffffff !important;
    }

    html[data-theme="light"] input:-webkit-autofill {
        background-color: #fef2f2 !important;
        -webkit-box-shadow: 0 0 0px 1000px #fef2f2 inset !important;
        color: #1a202c !important;
    }

    .gradient-bg {
        background: linear-gradient(135deg, #fef2f2 0%, #f3f4f6 50%, #fef2f2 100%);
    }
</style>

<div class="flex justify-center items-center min-h-screen bg-gradient-to-br from-red-50 to-gray-50 p-4">
    <div class="card lg:card-side bg-white rounded-2xl shadow-2xl border border-gray-100 w-full max-w-5xl overflow-hidden">
        <!-- Image Section -->
        <figure class="lg:w-1/2 bg-gradient-to-br from-red-100 to-pink-100 p-8 flex items-center justify-center">
            <div class="text-center space-y-6">
                <img class="w-80 h-80 mx-auto transform hover:scale-105 transition-transform duration-500" 
                     src="{{ asset('images/login-icon.svg') }}" alt="Login Illustration" />
                <div class="space-y-2">
                    <h1 class="text-2xl font-bold text-gray-900">Selamat Datang di</h1>
                    <div class="text-3xl font-extrabold bg-gradient-to-r from-red-600 to-pink-600 bg-clip-text text-transparent">
                        SIAFAR
                    </div>
                    <p class="text-gray-600">Sistem Informasi Apotek dan Farmasi</p>
                </div>
            </div>
        </figure>

        <!-- Form Section -->
        <div class="lg:w-1/2 p-8 lg:p-12">
            <div class="card-body p-0 space-y-6">
                <!-- Header -->
                <div class="text-center space-y-2">
                    <h2 class="text-3xl font-extrabold text-gray-900">Masuk ke Akun Anda</h2>
                    <p class="text-gray-600">Silakan masuk untuk melanjutkan</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-semibold text-gray-700">
                            {{ __('Alamat Email') }}
                        </label>
                        <div class="relative">
                            <input id="email"
                                class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300 placeholder-gray-400 text-gray-900"
                                type="email" 
                                name="email" 
                                :value="old('email')" 
                                autofocus 
                                autocomplete="email"
                                placeholder="example@gmail.com" />
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-semibold text-gray-700">
                            {{ __('Password') }}
                        </label>
                        <div class="relative">
                            <input id="password"
                                class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300 placeholder-gray-400 text-gray-900"
                                type="password" 
                                name="password" 
                                autocomplete="current-password" 
                                placeholder="Masukkan password" />
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input id="remember_me" 
                                   type="checkbox" 
                                   name="remember"
                                   class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 focus:ring-2" />
                            <span class="text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-red-600 hover:text-red-700 transition-colors duration-300 font-medium" 
                               href="{{ route('password.request') }}">
                                {{ __('Lupa password?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button type="submit" 
                            class="w-full py-3 px-4 text-white font-semibold bg-gradient-to-r from-red-600 to-pink-600 rounded-xl shadow-lg hover:shadow-xl hover:from-red-700 hover:to-pink-700 transform hover:-translate-y-1 transition-all duration-300">
                        {{ __('MASUK') }}
                    </button>

                    <!-- Divider -->
                    <div class="relative flex items-center justify-center">
                        <div class="border-t border-gray-300 flex-grow"></div>
                        <span class="mx-4 text-sm text-gray-500 bg-white px-2">ATAU</span>
                        <div class="border-t border-gray-300 flex-grow"></div>
                    </div>

                    <!-- Register Link -->
                    <div class="text-center">
                        <p class="text-gray-600">
                            {{ __('Belum punya akun?') }}
                            <a class="font-semibold text-red-600 hover:text-red-700 transition-colors duration-300" 
                               href="{{ route('register') }}">
                                {{ __('Daftar di sini') }}
                            </a>
                        </p>
                    </div>
                </form>

                <!-- Additional Info -->
                <div class="text-center pt-4 border-t border-gray-200">
                    <p class="text-xs text-gray-500">
                        Dengan masuk, Anda menyetujui 
                        <a href="#" class="text-red-600 hover:text-red-700">Syarat & Ketentuan</a> 
                        dan 
                        <a href="#" class="text-red-600 hover:text-red-700">Kebijakan Privasi</a> 
                        kami.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection