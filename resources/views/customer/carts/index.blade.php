@extends('layouts.app')

@section('content-customer')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>

    <div class="min-h-screen bg-gradient-to-br from-red-50 to-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Keranjang Belanja</h1>
                <p class="text-lg text-gray-600">Kelola item dalam keranjang belanja Anda</p>
            </div>

            <div class="flex flex-col lg:flex-row gap-8 items-start">
                <!-- Cart Items Section -->
                <div class="flex-1 w-full">
                    @forelse ($carts as $cart)
                        <div
                            class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 mb-4 transition-all duration-300 hover:shadow-lg">
                            <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
                                <!-- Product Info -->
                                <div class="flex items-center gap-4 flex-1">
                                    <img class="rounded-xl w-20 h-20 object-cover border border-gray-200"
                                        src="{{ asset('storage/' . $cart->medicine->photo) }}"
                                        alt="{{ $cart->medicine->name }}" />
                                    <div class="flex-1">
                                        <h2 class="text-lg font-semibold text-gray-900">{{ $cart->medicine->name }}</h2>
                                        <div class="flex flex-wrap gap-2 mt-2">
                                            <span
                                                class="text-sm bg-pink-100 text-pink-600 font-medium px-2.5 py-0.5 rounded-full">
                                                {{ $cart->medicine->category->name }}
                                            </span>
                                            <span
                                                class="text-sm border border-gray-300 text-gray-600 px-2.5 py-0.5 rounded-full">
                                                {{ $cart->medicine->unit->name }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Quantity Controls & Price -->
                                <div class="flex flex-col sm:flex-row items-center gap-4">
                                    <!-- Quantity Controls -->
                                    <form class="flex items-center gap-2"
                                        action="{{ route('customer.carts.update', $cart->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="button" id="decrement-{{ $cart->id }}"
                                            class="w-8 h-8 flex items-center justify-center bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 hover:border-red-300 transition-all duration-300">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 12H4" />
                                            </svg>
                                        </button>
                                        <input type="number" id="qty-{{ $cart->id }}" name="quantity"
                                            value="{{ $cart->quantity }}" min="1" max="{{ $cart->medicine->stock }}"
                                            class="w-16 text-center bg-white border border-gray-300 rounded-lg py-1 text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                        <button type="button" id="increment-{{ $cart->id }}"
                                            class="w-8 h-8 flex items-center justify-center bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 hover:border-red-300 transition-all duration-300">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                        </button>
                                        <button type="submit" id="submitForm-{{ $cart->id }}" class="hidden"></button>
                                    </form>

                                    <!-- Price & Delete -->
                                    <form class="flex items-center gap-4"
                                        action="{{ route('customer.carts.destroy', $cart->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        @php
    // Ganti dengan query langsung
    $discount = App\Models\Discount::where('medicine_id', $cart->medicine_id)
        ->where('is_active', 1)
        ->first();
@endphp

                                        <div class="text-right">
                                            @if ($discount && $discount->medicine_id == $cart->medicine_id)
                                                <div class="flex flex-col items-end">
                                                    <p class="text-sm text-gray-400 line-through">
                                                        Rp
                                                        {{ number_format($cart->medicine->price * $cart->quantity, 0, ',', '.') }}
                                                    </p>
                                                    <p class="text-lg font-semibold text-red-600">
                                                        Rp
                                                        {{ number_format(($cart->medicine->price - $cart->medicine->price * ($discount->discount_amount / 100)) * $cart->quantity, 0, ',', '.') }}
                                                    </p>
                                                    <span
                                                        class="text-xs bg-gradient-to-r from-red-600 to-pink-600 text-white px-2 py-1 rounded-full mt-1">
                                                        Diskon {{ $discount->discount_amount }}%
                                                    </span>
                                                </div>
                                            @else
                                                <p class="text-lg font-semibold text-gray-800">
                                                    Rp
                                                    {{ number_format($cart->medicine->price * $cart->quantity, 0, ',', '.') }}
                                                </p>
                                            @endif
                                        </div>

                                        <button type="submit"
                                            class="w-8 h-8 flex items-center justify-center bg-white border border-red-200 rounded-lg text-red-600 hover:bg-red-600 hover:text-white transition-all duration-300"
                                            onclick="return confirm('Hapus item dari keranjang?')">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Empty Cart State -->
                        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-12 text-center">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Keranjang Kosong</h3>
                            <p class="text-gray-600 mb-6">Belum ada barang di keranjang belanja Anda</p>
                            <a href="{{ route('customer.medicines.index') }}"
                                class="inline-flex items-center px-6 py-3 text-white font-semibold bg-gradient-to-r from-red-600 to-pink-600 rounded-xl hover:from-red-700 hover:to-pink-700 transition-all duration-300">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Mulai Belanja
                            </a>
                        </div>
                    @endforelse
                </div>

                <!-- Order Summary Section -->
                <div class="w-full lg:w-96">
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 sticky top-8">
                        <div class="p-6">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">Ringkasan Pesanan</h2>

                            @if ($carts->count() > 0)
                                <!-- Order Items -->
                                <div class="space-y-4 mb-6">
                                    @php
                                        $totalDiscount = 0;
                                        $grandTotalAmount = 0;
                                    @endphp

                                    @foreach ($carts as $cart)
                                        @php
                                            $discount = App\Models\Discount::where('medicine_id', $cart->medicine_id)
                                                ->where('is_active', 1)
                                                ->first();
                                            $totalPrice = $cart->medicine->price * $cart->quantity;
                                            $discountAmount = 0;

                                            if ($discount && $discount->medicine_id == $cart->medicine_id) {
                                                $discountAmount = $totalPrice * ($discount->discount_amount / 100);
                                            }
                                            $priceAfterDiscount = $totalPrice - $discountAmount;
                                            $totalDiscount += $discountAmount;
                                            $grandTotalAmount += $priceAfterDiscount;
                                        @endphp

                                        <div class="flex justify-between items-start pb-3 border-b border-gray-200">
                                            <div class="flex-1">
                                                <p class="font-medium text-gray-900">{{ $cart->medicine->name }}</p>
                                                <p class="text-sm text-gray-500">x{{ $cart->quantity }}
                                                    {{ $cart->medicine->unit->name }}</p>
                                                @if ($discount && $discount->medicine_id == $cart->medicine_id)
                                                    <span
                                                        class="text-xs bg-gradient-to-r from-red-600 to-pink-600 text-white px-2 py-1 rounded-full mt-1 inline-block">
                                                        Diskon {{ $discount->discount_amount }}%
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="text-right">
                                                @if ($discount && $discount->medicine_id == $cart->medicine_id)
                                                    <p class="text-sm text-gray-400 line-through">
                                                        Rp {{ number_format($totalPrice, 0, ',', '.') }}
                                                    </p>
                                                    <p class="font-semibold text-red-600">
                                                        Rp {{ number_format($priceAfterDiscount, 0, ',', '.') }}
                                                    </p>
                                                @else
                                                    <p class="font-semibold text-gray-800">
                                                        Rp {{ number_format($totalPrice, 0, ',', '.') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Pricing Breakdown -->
                                <div class="space-y-3 border-t border-gray-200 pt-4">
                                    <div class="flex justify-between text-gray-600">
                                        <span>Subtotal</span>
                                        <span>Rp
                                            {{ number_format($grandTotalAmount + $totalDiscount, 0, ',', '.') }}</span>
                                    </div>

                                    <div class="flex justify-between text-green-600">
                                        <span>Total Diskon</span>
                                        <span>- Rp {{ number_format($totalDiscount, 0, ',', '.') }}</span>
                                    </div>

                                    <div class="flex justify-between text-gray-600">
                                        <span>Biaya Pengiriman</span>
                                        <span>Rp 0</span>
                                    </div>

                                    <div
                                        class="flex justify-between text-lg font-bold text-gray-900 border-t border-gray-200 pt-3">
                                        <span>Total Pembayaran</span>
                                        <span>Rp {{ number_format($grandTotalAmount, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <!-- Checkout Button -->
                                <a href="{{ route('customer.checkout.index') }}"
                                    class="w-full mt-6 py-3 px-4 text-white font-semibold bg-gradient-to-r from-red-600 to-pink-600 rounded-xl shadow-lg hover:shadow-xl hover:from-red-700 hover:to-pink-700 transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Lanjut ke Checkout
                                </a>
                            @else
                                <!-- Empty Cart Summary -->
                                <div class="text-center py-8">
                                    <p class="text-gray-500 mb-4">Keranjang belanja masih kosong</p>
                                    <div class="text-2xl font-bold text-gray-900">Rp 0</div>
                                    <button
                                        class="w-full mt-4 py-3 px-4 text-gray-400 font-semibold bg-gray-200 rounded-xl cursor-not-allowed"
                                        disabled>
                                        Checkout
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const decrement = $('button[id^=decrement-]')
        const increment = $("button[id^=increment-]")

        decrement.on("click", function() {
            const cartId = $(this).attr("id").split("-")[1];
            const qty = $(`#qty-${cartId}`)
            const submitForm = $(`#submitForm-${cartId}`)
            let currentQty = parseInt(qty.val())

            if (currentQty > 1) {
                qty.val(currentQty - 1)
                setTimeout(() => {
                    submitForm.trigger("click")
                }, 200);
            }
        })

        increment.on("click", function() {
            const cartId = $(this).attr("id").split("-")[1];
            const qty = $(`#qty-${cartId}`)
            const submitForm = $(`#submitForm-${cartId}`)
            let currentQty = parseInt(qty.val())

            qty.val(currentQty + 1)
            setTimeout(() => {
                submitForm.trigger("click")
            }, 200);
        })
    });
</script>
