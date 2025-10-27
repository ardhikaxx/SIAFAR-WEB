@extends('layouts.login')

@section('content-login')
<div class="flex justify-center items-center w-full h-screen bg-neutral-100 text-neutral-950">
    <div class="card lg:card-side bg-neutral-100 text-neutral-950 outline-dashed shadow-xl w-8/12">
        <figure class="w-full p-4">
            <img class="w-full" src="{{ asset('images/forgot-password.svg') }}" alt="Album" />
        </figure>
        <div class="card-body">
            <div class="flex justify-center">
                <h2 class="card-title text-center">Apotek Cendana.</h2>
            </div>
            <h2 class="card-title text-center">Lupa Kata Sandi</h2>

            <div class="mb-4 text-sm text-neutral-950">
                {{ __('Lupa kata sandi? Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan tautan untuk menyetel ulang kata sandi yang akan memungkinkan Anda memilih kata sandi baru.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-control mb-4">
                    <label for="email" class="label">
                        <span class="label-text">{{ __('Email') }}</span>
                    </label>
                    <input id="email" class="input input-bordered border-1 border-neutral-950" type="email" name="email"
                        :value="old('email')" autofocus placeholder="example@gmail.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between flex-col w-full gap-3">
                    <div class="w-full">
                        <button class="btn btn-neutral text-neutral-200 w-full">
                            {{ __('Email Password Reset Link') }}
                        </button>
                    </div>
                    <h1>OR</h1>
                    <a class="link link-hover" href="{{ route('login') }}">
                        {{ __('Kembali ke login') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection