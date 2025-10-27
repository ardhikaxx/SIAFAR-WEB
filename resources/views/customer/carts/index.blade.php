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
<div
    class="container mx-auto p-4 w-full min-h-screen flex flex-col justify-center items-center bg-neutral-100 text-neutral-950">
    <h1 class="text-3xl font-bold m-10">My Cart</h1>
    <section class="w-full min-h-screen flex justify-center items-start gap-3">

        <div class="flex flex-col gap-2 w-full">
            @forelse ($carts as $cart)
                        <div
                            class="rounded-xl bg-neutral-100 outline-dashed w-full shadow-lg p-5 flex items-center justify-between">
                            <div class="flex gap-3 items-center">
                                <img class="rounded-full w-20 h-20" src="{{ asset('storage/' . $cart->medicine->photo) }}"
                                    alt="{{ $cart->medicine->name }}" />
                                <h2 class="card-title text-md">{{ $cart->medicine->name }}</h2>
                            </div>

                            <div class="flex">
                                <form class="flex gap-2 items-center m-3" action="{{ route('customer.carts.update', $cart->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <button type="button" id="decrement-{{ $cart->id }}"
                                        class="btn btn-sm btn-neutral text-neutral-200">-</button>
                                    <input type="number" id="qty-{{ $cart->id }}" name="quantity" value="{{ $cart->quantity }}"
                                        min="1" max="{{ $cart->medicine->stock }}" class="input input-bordered input-sm w-20 text-center bg-neutral-200">
                                    <button type="button" id="increment-{{ $cart->id }}"
                                        class="btn btn-sm btn-neutral text-neutral-200">+</button>
                                    <button type="submit" id="submitForm-{{ $cart->id }}" class="hidden"></button>
                                </form>

                                <form class="flex items-center gap-3 m-3" action="{{ route('customer.carts.destroy', $cart->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    @php
                                        $discount = App\Models\Discount::where('medicine_id', $cart->medicine_id)->where('is_active', 1)->first();
                                    @endphp
                                    @if ($discount && $discount->medicine_id == $cart->medicine_id)
                                        <div class="flex flex-col">
                                            <h1 class="line-through">
                                                Rp. {{ number_format($cart->medicine->price, 0, ',', '.') }}
                                            </h1>
                                            <h1>Rp.
                                                {{number_format($cart->medicine->price - ($cart->medicine->price * ($discount->discount_amount / 100)))}}
                                            </h1>
                                        </div>
                                    @else
                                        <p>Rp. {{ number_format($cart->medicine->price, 0, ',', '.') }}</p>
                                    @endif

                                    <button class="btn btn-sm btn-neutral text-neutral-200">X</button>
                                </form>
                            </div>
                        </div>
            @empty
                <div class="card card-side bg-neutral-100 shadow-lg outline-dashed w-full">
                    <div class="card-body">
                        <h2 class="card-title text-md">Belum ada barang</h2>
                    </div>
                </div>
            @endforelse
        </div>


        <div class="card bg-neutral-950 text-neutral-200 w-96 shadow-xl">
            <div class="card bg-neutral-950 text-neutral-200 w-96 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title">Detail Cart</h2>

                    <div class="card-actions w-full">
                        <div class="flex flex-col gap-2 w-full">
                            @php
                                $totalDiscount = 0;
                                $grandTotalAmount = 0;
                            @endphp
                            @if ($carts->count() > 0)
                                <div class="border-t border-gray-700 my-4"></div>
                            @endif

                            @foreach ($carts as $cart)
                                                        @php
                                                            $discount = App\Models\Discount::where('medicine_id', $cart->medicine_id)->where('is_active', 1)->first();
                                                        @endphp
                                                        @if ($discount && $discount->medicine_id == $cart->medicine_id)
                                                            <div class="pb-3">
                                                                <div class="flex justify-between">
                                                                    <h1>{{$cart->medicine->name}}</h1>

                                                                    <div class="flex gap-2">
                                                                        <h1>x{{$cart->quantity}}</h1>
                                                                        <h1 class="line-through">Rp.
                                                                            {{number_format($cart->medicine->price * $cart->quantity)}}
                                                                        </h1>
                                                                    </div>


                                                                </div>
                                                                <div class="flex justify-between">
                                                                    <h1>Diskon {{ $discount->discount_amount }}%</h1>
                                                                    <h1>Rp.
                                                                        {{number_format($cart->medicine->price * $cart->quantity - ($cart->medicine->price * $cart->quantity * ($discount->discount_amount / 100)))}}
                                                                    </h1>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="flex justify-between">
                                                                <h1>{{$cart->medicine->name}}</h1>
                                                                <div class="flex gap-2">
                                                                    <h1>x{{$cart->quantity}}</h1>
                                                                    <h1>Rp. {{number_format($cart->medicine->price * $cart->quantity)}}</h1>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @php
                                                            $totalPrice = $cart->medicine->price * $cart->quantity;
                                                            $discountAmount = 0;
                                                            if ($discount && $discount->medicine_id == $cart->medicine_id) {
                                                                $discountAmount = $totalPrice * ($discount->discount_amount / 100);
                                                            }
                                                            $priceAfterDiscount = $totalPrice - $discountAmount;
                                                            $totalDiscount += $discountAmount;
                                                            $grandTotalAmount += $priceAfterDiscount;
                                                        @endphp
                            @endforeach



                            @if ($carts->count() > 0)
                                <div class="border-t border-gray-700 my-4"></div>
                                <div class="flex justify-between font-bold">
                                    <h1>Shipping Fee</h1>
                                    <h1><span id="diskon">Rp. 0</span>
                                    </h1>
                                </div>
                                <div class="flex justify-between font-bold">
                                    <h1>Total Diskon</h1>
                                    <h1><span id="diskon">Rp. {{ $totalDiscount }}</span>
                                    </h1>
                                </div>

                                <div class="flex justify-between font-bold">
                                    <h1>Grand Total</h1>
                                    <h1>Rp. {{ number_format($grandTotalAmount, 0, ',', '.') }}</h1>
                                </div>
                                <a href="{{route('customer.checkout.index')}}" class="btn btn-warning">Checkout</a>
                            @else
                                <div class="flex justify-between font-bold">
                                    <h1>Total</h1>
                                    <h1>Rp. 0</h1>
                                </div>
                                <button class="btn btn-warning" disabled>Checkout</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const decrement = $('.btn-neutral[id^=decrement-]')
        const increment = $(".btn-neutral[id^=increment-]")



        decrement.on("click", function () {
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


        increment.on("click", function () {
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