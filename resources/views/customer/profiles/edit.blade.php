@extends('layouts.app')


@section('content-customer')
<section class="bg-neutral-100 p-12 flex flex-col gap-3">
    @if (session('success'))
        <div role="alert" class="alert alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>
                {{ session('success') }}
            </span>
        </div>
    @elseif (session('error'))
        <div role="alert" class="alert alert-error">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>
                {{ session('error') }}
            </span>
        </div>
    @endif
    <h1 class="text-center font-bold text-xl">My Profile</h1>
    <div class="flex justify-center items-center min-h-screen">
        <form action="{{ route('customer.profiles.update', $user->id) }}" method="post"
            class="grid grid-cols-2 gap-4 w-1/2" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="form-control col-span-2">
                <label for="name" class="label">
                    <span class="label-text">Nama</span>
                </label>
                <input type="text" id="name" placeholder="Nama" name="name" value="{{ Auth::user()->name }}"
                    class="input input-bordered input-md w-full" />
            </div>

            <!-- Email -->
            <div class="form-control col-span-2">
                <label for="email" class="label">
                    <span class="label-text">Email</span>
                </label>
                <input type="email" id="email" placeholder="Email" name="email" value="{{ Auth::user()->email }}"
                    class="input input-bordered input-md w-full" />
            </div>

            <!-- Password -->
            <div class="form-control col-span-2">
                <label for="password" class="label">
                    <span class="label-text">Password</span>
                </label>
                <input type="password" id="password" placeholder="Password" name="password"
                    class="input input-bordered input-md w-full" />
            </div>

            <!-- Nomor Telepon -->
            <div class="form-control col-span-2">
                <label for="phone" class="label">
                    <span class="label-text">Nomor Telepon</span>
                </label>
                <input type="number" id="phone" min="0" name="phone" placeholder="Nomor Telepon"
                    value="{{ Auth::user()->phone }}" class="input input-bordered input-md w-full" />
            </div>

            <!-- Foto Profil -->
            <div class="form-control col-span-2">
                <label for="image" class="label">
                    <span class="label-text">Foto Profil</span>
                </label>
                <input type="file" class="file-input w-full" id="image" name="image" accept="image/*" />
                @if($user->image)
                    <small class="form-text text-muted">
                        File saat ini: {{ basename($user->image) }}
                    </small>
                    <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}"
                        class="img-thumbnail mt-2 w-24 h-24">
                @endif
            </div>

            <!-- Tombol Simpan -->
            <div class="form-control col-span-2">
                <button type="submit" class="btn btn-neutral text-neutral-200 w-full">
                    Simpan
                </button>
            </div>
        </form>
    </div>


</section>
@endsection