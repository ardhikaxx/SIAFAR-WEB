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
    <div class="card lg:card-side bg-white rounded-2xl shadow-2xl border border-gray-100 w-full max-w-4xl overflow-hidden">
        <!-- Image Section -->
        <figure class="lg:w-1/2 bg-gradient-to-br from-red-100 to-pink-100 p-8 flex items-center justify-center">
            <div class="text-center space-y-6">
                <img class="w-72 h-72 mx-auto transform hover:scale-105 transition-transform duration-500" 
                     src="{{ asset('images/forgot-password.svg') }}" alt="Forgot Password Illustration" />
                <div class="space-y-2">
                    <h1 class="text-2xl font-bold text-gray-900">Lupa Password?</h1>
                    <div class="text-3xl font-extrabold bg-gradient-to-r from-red-600 to-pink-600 bg-clip-text text-transparent">
                        SIAFAR
                    </div>
                    <p class="text-gray-600">Kami akan membantu Anda</p>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200">
                    <div class="flex items-center gap-2 text-amber-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                        <p class="text-sm font-medium">Tautan reset akan dikirim ke email Anda</p>
                    </div>
                </div>
            </div>
        </figure>

        <!-- Form Section -->
        <div class="lg:w-1/2 p-8 lg:p-12">
            <div class="card-body p-0 space-y-6">
                <!-- Header -->
                <div class="text-center space-y-2">
                    <h2 class="text-3xl font-extrabold text-gray-900">Reset Kata Sandi</h2>
                    <p class="text-gray-600">Masukkan email untuk mereset password Anda</p>
                </div>

                <!-- Instructions -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-blue-700">
                            {{ __('Lupa kata sandi? Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan tautan untuk menyetel ulang kata sandi yang akan memungkinkan Anda memilih kata sandi baru.') }}
                        </p>
                    </div>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
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
                                placeholder="example@gmail.com" 
                                required />
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full py-3 px-4 text-white font-semibold bg-gradient-to-r from-red-600 to-pink-600 rounded-xl shadow-lg hover:shadow-xl hover:from-red-700 hover:to-pink-700 transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        {{ __('Kirim Tautan Reset Password') }}
                    </button>

                    <!-- Success Message Placeholder -->
                    @if (session('status'))
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4 animate-pulse">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-sm text-green-700 font-medium">
                                Tautan reset password telah dikirim ke email Anda!
                            </p>
                        </div>
                    </div>
                    @endif

                    <!-- Divider -->
                    <div class="relative flex items-center justify-center">
                        <div class="border-t border-gray-300 flex-grow"></div>
                        <span class="mx-4 text-sm text-gray-500 bg-white px-2">ATAU</span>
                        <div class="border-t border-gray-300 flex-grow"></div>
                    </div>

                    <!-- Back to Login Link -->
                    <div class="text-center">
                        <a class="inline-flex items-center font-semibold text-red-600 hover:text-red-700 transition-colors duration-300 gap-2" 
                           href="{{ route('login') }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            {{ __('Kembali ke halaman login') }}
                        </a>
                    </div>
                </form>

                <!-- Additional Support -->
                <div class="text-center pt-4 border-t border-gray-200">
                    <p class="text-xs text-gray-500">
                        Butuh bantuan? 
                        <a href="#" class="text-red-600 hover:text-red-700 font-medium">Hubungi support</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Animation Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const button = form.querySelector('button[type="submit"]');
    
    form.addEventListener('submit', function() {
        // Add loading state
        button.disabled = true;
        button.innerHTML = `
            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Mengirim tautan...
        `;
    });
});
</script>
@endsection