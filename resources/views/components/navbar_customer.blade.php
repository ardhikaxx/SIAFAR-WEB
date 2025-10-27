@php
    use App\Models\Cart;
@endphp
<div class="navbar bg-neutral-100 text-neutral-950 px-10">
    <div class="flex-1">
        <a class="btn btn-ghost text-xl"
            href="{{ Auth::check() ? route('customer.index') : route('public.index') }}">Apotek Cendana.</a>
    </div>
    <div class="flex-none">
        <div class="hidden lg:block">
            <ul class="menu menu-horizontal px-1">
                <li><a href="{{ Auth::check() ? route('customer.index') : route('public.index') }}">Home</a></li>
                <li class="{{ Auth::check() ? 'block' : "hidden" }}"><a
                        href="{{ route('customer.transactionOuts.index') }}">Transaksi Pemesanan</a></li>
                <li><a href="{{ Auth::check() ? route('customer.medicines.index') : route('public.medicines.index') }}">Daftar
                        Obat</a></li>
            </ul>
        </div>
        @php
            $cartCount = Cart::where('user_id', Auth::id())->count();
        @endphp
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                <div class="indicator">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    @if ($cartCount > 0)
                        <span class="badge badge-sm indicator-item">{{ $cartCount }}</span>
                    @else
                        <span class="badge badge-sm indicator-item">0</span>
                    @endif
                </div>
            </div>
            <div tabindex="0" class="card card-compact dropdown-content bg-neutral-100 z-[1] mt-3 w-52 shadow">
                <div class="card-body">

                    @if ($cartCount > 0)
                        <span class="text-lg font-bold">{{ $cartCount }} Items</span>
                    @else
                        <span class="text-lg font-bold">0 Items</span>
                    @endif
                    <div class="card-actions">
                        <a href="{{ route('customer.carts.index') }}"
                            class="btn btn-neutral text-neutral-200 btn-block">View cart</a>
                    </div>
                </div>
            </div>
        </div>
        @if (Route::has('login'))
            <nav class=" flex flex-1 justify-end">
                @auth
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                            <div class="w-10 rounded-full">
                                @if(Auth::user()->image)
                                    <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="{{ Auth::user()->name }}">
                                @else
                                    <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="currentColor" class="size-6">
                                        <path fill-rule="evenodd"
                                            d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                @endif
                            </div>
                        </div>
                        <ul tabindex="0"
                            class="menu menu-sm dropdown-content bg-neutral-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                            <div class="block lg:hidden">
                                <li><a href="{{ Auth::check() ? route('customer.index') : route('public.index') }}">Home</a>
                                </li>
                                <li class="{{ Auth::check() ? 'block' : "hidden" }}"><a
                                        href="{{ route('customer.transactionOuts.index') }}">Transaksi Pemesanan</a></li>
                                <li><a
                                        href="{{ Auth::check() ? route('customer.medicines.index') : route('public.medicines.index') }}">Daftar
                                        Obat</a></li>

                            </div>
                            <li><a href="{{ route('customer.profiles.edit', Auth::id()) }}">Profile</a></li>

                            <li>
                                <button type="button" class="nav-link" onclick="my_modal_1.showModal()">
                                    <p>Logout</p>
                                </button>
                            </li>

                        </ul>
                    </div>
                @else
                    <div>
                        <a href="{{ route('login') }}" class="btn btn-sm outline outline-1 btn-outline-neutral">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-sm btn-neutral text-neutral-200">
                                Register
                            </a>
                        @endif
                    </div>
                @endauth
            </nav>
        @endif
    </div>
</div>
<dialog id="my_modal_1" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Logout</h3>
        <p class="py-4">Apakah anda yakin ingin melakukan logout?</p>
        <div class="modal-action">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-neutral text-neutral-200 nav-link">
                    <p>Yakin</p>
                </button>
            </form>
            <form method="dialog">

                <button class="btn" onclick="my_modal_1.close()">Batal</button>
            </form>
        </div>
    </div>
</dialog>