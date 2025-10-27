@extends('layouts.login')

@section('content-login')
<div class="flex justify-center items-center w-full h-screen bg-neutral-100">
    <div class="card lg:card-side bg-neutral-100 outline-dashed shadow-xl w-8/12">
        <figure class="w-1/2">
            <img class="w-full" src="{{ asset('images/my_password.svg') }}" alt="Album" />
        </figure>
        <div class="card-body">
            <div class="flex justify-center">
                <h2 class="card-title text-center">Apotek Cendana.</h2>
            </div>
            <h2 class="card-title text-center">Reset Password</h2>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="form-control mb-4">
                    <label for="email" class="label">
                        <span class="label-text">{{ __('Email') }}</span>
                    </label>
                    <input id="email" class="input input-bordered" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="form-control mb-4">
                    <label for="password" class="label">
                        <span class="label-text">{{ __('Password') }}</span>
                    </label>
                    <input id="password" class="input input-bordered" type="password" name="password" required
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="form-control mb-4">
                    <label for="password_confirmation" class="label">
                        <span class="label-text">{{ __('Confirm Password') }}</span>
                    </label>
                    <input id="password_confirmation" class="input input-bordered" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between flex-col w-full gap-3">
                    <div class="w-full">
                        <button class="btn btn-neutral text-neutral-200 w-full">
                            {{ __('Reset Password') }}
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