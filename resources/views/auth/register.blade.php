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
</style>

<div class="flex justify-center items-center min-h-screen bg-gradient-to-br from-red-50 to-gray-50 p-4">
    <div class="card lg:card-side bg-white rounded-2xl shadow-2xl border border-gray-100 w-full max-w-6xl overflow-hidden">
        <!-- Image Section -->
        <figure class="lg:w-2/5 bg-gradient-to-br from-red-100 to-pink-100 p-8 flex items-center justify-center">
            <div class="text-center space-y-6">
                <img class="w-64 h-64 mx-auto transform hover:scale-105 transition-transform duration-500" 
                     src="{{ asset('images/register-icon.svg') }}" alt="Register Illustration" />
                <div class="space-y-2">
                    <h1 class="text-2xl font-bold text-gray-900">Bergabung dengan</h1>
                    <div class="text-3xl font-extrabold bg-gradient-to-r from-red-600 to-pink-600 bg-clip-text text-transparent">
                        SIAFAR
                    </div>
                    <p class="text-gray-600">Sistem Informasi Apotek dan Farmasi</p>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200">
                    <p class="text-sm text-gray-600">
                        Daftar sekarang untuk mendapatkan akses penuh ke semua fitur dan layanan kami.
                    </p>
                </div>
            </div>
        </figure>

        <!-- Form Section -->
        <div class="lg:w-3/5 p-8 lg:p-12">
            <div class="card-body p-0 space-y-6">
                <!-- Header -->
                <div class="text-center space-y-2">
                    <h2 class="text-3xl font-extrabold text-gray-900">Buat Akun Baru</h2>
                    <p class="text-gray-600">Isi data diri Anda untuk mulai menggunakan layanan</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <!-- Name -->
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-semibold text-gray-700">
                                {{ __('Nama Lengkap') }}
                            </label>
                            <div class="relative">
                                <input id="name" 
                                    class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300 placeholder-gray-400 text-gray-900"
                                    type="text" 
                                    name="name"
                                    :value="old('name')" 
                                    autofocus 
                                    autocomplete="name" 
                                    placeholder="Masukkan nama lengkap" />
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

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
                                    autocomplete="new-password" 
                                    placeholder="Masukkan password" />
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="space-y-2">
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">
                                {{ __('Konfirmasi Password') }}
                            </label>
                            <div class="relative">
                                <input id="password_confirmation" 
                                    class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300 placeholder-gray-400 text-gray-900"
                                    type="password" 
                                    name="password_confirmation"
                                    autocomplete="new-password" 
                                    placeholder="Konfirmasi password" />
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- Phone Number -->
                        <div class="space-y-2">
                            <label for="phone" class="block text-sm font-semibold text-gray-700">
                                {{ __('Nomor Telepon') }}
                            </label>
                            <div class="relative">
                                <input id="phone" 
                                    class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300 placeholder-gray-400 text-gray-900"
                                    type="number" 
                                    name="phone"
                                    :value="old('phone')" 
                                    autocomplete="tel" 
                                    min="0" 
                                    placeholder="+62" />
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <!-- Profile Image -->
                        <div class="space-y-2 lg:col-span-2">
                            <label for="image" class="block text-sm font-semibold text-gray-700">
                                {{ __('Foto Profil') }}
                            </label>
                            <div class="relative">
                                <input id="image" 
                                    class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100"
                                    type="file" 
                                    name="image"
                                    :value="old('image')" 
                                    accept="image/*" />
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, JPEG (Maks. 2MB)</p>
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Register Button -->
                    <button type="submit" 
                            class="w-full py-3 px-4 text-white font-semibold bg-gradient-to-r from-red-600 to-pink-600 rounded-xl shadow-lg hover:shadow-xl hover:from-red-700 hover:to-pink-700 transform hover:-translate-y-1 transition-all duration-300">
                        {{ __('DAFTAR SEKARANG') }}
                    </button>

                    <!-- Divider -->
                    <div class="relative flex items-center justify-center">
                        <div class="border-t border-gray-300 flex-grow"></div>
                        <span class="mx-4 text-sm text-gray-500 bg-white px-2">ATAU</span>
                        <div class="border-t border-gray-300 flex-grow"></div>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center">
                        <p class="text-gray-600">
                            {{ __('Sudah punya akun?') }}
                            <a class="font-semibold text-red-600 hover:text-red-700 transition-colors duration-300" 
                               href="{{ route('login') }}">
                                {{ __('Masuk di sini') }}
                            </a>
                        </p>
                    </div>
                </form>

                <!-- Additional Info -->
                <div class="text-center pt-4 border-t border-gray-200">
                    <p class="text-xs text-gray-500">
                        Dengan mendaftar, Anda menyetujui 
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