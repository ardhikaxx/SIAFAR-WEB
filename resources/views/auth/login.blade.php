@extends('layouts.login')


@section('content-login')
<style>
    html[data-theme="dark"] input:-webkit-autofill {
        background-color: #1f2937 !important;
        -webkit-box-shadow: 0 0 0px 1000px #1f2937 inset !important;
        color: #ffffff !important;
    }

    html[data-theme="light"] input:-webkit-autofill {
        background-color: #f3f4f6 !important;
        -webkit-box-shadow: 0 0 0px 1000px #f3f4f6 inset !important;
        color: #1a202c !important;
    }
</style>
<div class="flex justify-center items-center w-full h-screen bg-neutral-100 text-neutral-950">
    <div class="card lg:card-side bg-neutral-100 outline-dashed shadow-xl w-8/12">
        <figure class="w-1/2">
            <img class="w-full " src="{{ asset('images/login-icon.svg') }}" alt="Album" />
        </figure>
        <div class="card-body">
            <div class="flex justify-center">
                <h2 class="card-title text-center">Apotek Cendana.</h2>
            </div>
            <h2 class="card-title text-center">LOGIN</h2>
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email Address -->
                <div class="form-control mb-4">
                    <label for="email" class="label">
                        <span class="label-text text-neutral-950">{{ __('Email') }}</span>
                    </label>
                    <input id="email"
                        class="input input-bordered bg-neutral-100 border-1 border-neutral-950 text-neutral-950"
                        type="email" name="email" :value="old('email')" autofocus autocomplete="email"
                        placeholder="example@gmail.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="form-control mb-4">
                    <label for="password" class="label">
                        <span class="label-text text-neutral-950">{{ __('Password') }}</span>
                    </label>
                    <input id="password"
                        class="input input-bordered bg-neutral-100 border-1 border-neutral-950 text-neutral-950"
                        type="password" name="password" autocomplete="current-password" placeholder="Password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="form-control mb-4">
                    <label class="cursor-pointer label flex justify-start gap-3">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="checkbox bg-neutral-100 border-1 border-neutral-950 text-neutral-950" />
                        <span class="label-text text-neutral-950">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between flex-col w-full gap-3">
                    <div class="w-full">
                        <button class="btn btn-neutral text-neutral-200 w-full">
                            {{ __('LOGIN') }}
                        </button>
                    </div>
                    <h1>OR</h1>
                    <a class="link link-hover" href="{{ route('register') }}">
                        {{ __('Belum punya akun? Register') }}
                    </a>
                    @if (Route::has('password.request'))
                        <a class="link link-hover" href="{{ route('password.request') }}">
                            {{ __('Lupa password?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection