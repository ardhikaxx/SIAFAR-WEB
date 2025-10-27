@extends('layouts.login')

@section('content-login')
<div class="flex justify-center items-center w-full h-screen bg-neutral-100 text-neutral-950">
    <div class="card lg:card-side bg-neutral-100 outline-dashed shadow-xl w-8/12">
        <figure class="w-1/2">
            <img class="w-2/3" src="{{ asset('images/register-icon.svg') }}" alt="Album" />
        </figure>
        <div class="card-body">
            <div class="flex justify-center">
                <h2 class="card-title text-center">Apotek Cendana.</h2>
            </div>
            <h2 class="card-title text-center">REGISTER</h2>
            <x-auth-session-status class="mb-4" :status="session('status')" />

           <form class="grid grid-cols-2 gap-2" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <!-- Name -->
                <div class="form-control mb-4">
                    <label for="name" class="label">
                        <span class="label-text">{{ __('Nama') }}</span>
                    </label>
                    <input id="name" class="input input-sm  input-bordered" type="text" name="name"
                        :value="old('name')"  autofocus autocomplete="name" placeholder="Nama" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="form-control mb-4">
                    <label for="email" class="label">
                        <span class="label-text">{{ __('Email') }}</span>
                    </label>
                    <input id="email" class="input input-sm input-bordered" type="email" name="email"
                        :value="old('email')"  autocomplete="email" placeholder="example@gmail.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="form-control mb-4">
                    <label for="password" class="label">
                        <span class="label-text">{{ __('Password') }}</span>
                    </label>
                    <input id="password" class="input input-sm input-bordered" type="password" name="password"
                         autocomplete="new-password" placeholder="Password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="form-control mb-4">
                    <label for="password_confirmation" class="label">
                        <span class="label-text">{{ __('Konfirmasi Password') }}</span>
                    </label>
                    <input id="password_confirmat input-sm ion" class="input input-sm input-bordered" type="password"
                        name="password_confirmation"  autocomplete="new-password" placeholder="Konfirmasi Password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="form-control mb-4">
                    <label for="phone" class="label">
                        <span class="label-text">{{ __('Nomor Telepon') }}</span>
                    </label>
                    <input id="phone" class="input input-sm  input-bordered" type="number" name="phone"
                        :value="old('phone')"  autofocus autocomplete="phone" min="0" placeholder="+62" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>


                <div class="form-control mb-4">
                    <label for="image" class="label">
                        <span class="label-text">{{ __('Foto Profil') }}</span>
                    </label>
                    <input id="image" class="file-input input-sm file-input-bordered" type="file" name="image"
                        :value="old('image')"  autofocus autocomplete="image" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>



                <div class="flex flex-col col-span-2 items-center justify-between w-full gap-3">
                    <div class="w-full">
                        <button class="btn btn-sm btn-neutral text-neutral-200 w-full">
                            {{ __('REGISTER') }}
                        </button>
                    </div>
                    <h1>OR</h1>
                    <a class="link link-hover" href="{{ route('login') }}">
                        {{ __('Sudah registrasi? Login') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection