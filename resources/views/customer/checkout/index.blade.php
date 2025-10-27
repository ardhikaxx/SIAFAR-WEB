@extends('layouts.app')

@section('content-customer')
<div
    class="container mx-auto p-4 w-full min-h-screen flex flex-col justify-center items-center bg-neutral-100 text-neutral-950">
    <h1 class="text-3xl font-bold m-10">Checkout</h1>
    <section class="w-full min-h-screen flex justify-center items-start gap-3">
        <div class=" card bg-neutral-950 text-neutral-200 w-7/12 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Checkout Items</h2>
                @if ($errors->has('payment_id'))
                    <div class="alert alert-error text-neutral-100 text-sm mt-4">
                        {{ $errors->first('payment_id') }}
                    </div>
                @endif
                @if (isset($error))
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endif
                <div class="card-actions w-full">
                    <div class="flex flex-col gap-2 w-full">
                        @php
                            $totalDiscount = 0;
                            $grandTotalAmount = 0;
                        @endphp
                        @forelse ($carts as $cart)
                                                @php

                                                    $discount = App\Models\Discount::where('medicine_id', $cart->medicine_id)->where('is_active', 1)->first();
                                                @endphp
                                                <div
                                                    class="rounded-xl bg-yellow-500 text-neutral-950 outline-neutral-100 outline-dashed p-2 flex items-center justify-between">
                                                    <div class="flex gap-3 items-center">
                                                        <img class="rounded-full w-10 h-10"
                                                            src="{{ asset('storage/' . $cart->medicine->photo) }}"
                                                            alt="{{ $cart->medicine->name }}" />
                                                        <div>
                                                            <h2 class="font-bold">{{ $cart->medicine->name }}</h2>
                                                            <p class="text-sm">x{{$cart->quantity}}</p>
                                                        </div>
                                                    </div>
                                                    @if ($discount && $discount->medicine_id == $cart->medicine_id)
                                                        <div>
                                                            <div class="flex justify-between">
                                                                <div class="flex gap-2">

                                                                    <h1 class="line-through">Rp.
                                                                        {{number_format($cart->medicine->price * $cart->quantity)}}
                                                                    </h1>
                                                                    <h1>Rp.
                                                                        {{number_format($cart->medicine->price * $cart->quantity - ($cart->medicine->price * $cart->quantity * ($discount->discount_amount / 100)))}}
                                                                    </h1>
                                                                </div>
                                                            </div>
                                                            <div class="flex flex-col justify-center  items-end">
                                                                <h1 id="discount" data-discount="{{ $discount->discount_amount }}">Diskon
                                                                    {{ $discount->discount_amount }}%
                                                                </h1>

                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="flex justify-between">
                                                            <div class="flex gap-2">
                                                                <h1>x{{$cart->quantity}}</h1>
                                                                <h1>Rp. {{number_format($cart->medicine->price * $cart->quantity)}}</h1>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
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
                        @empty
                            <div class="card card-side bg-neutral-100 shadow-lg outline-dashed w-full">
                                <div class="card-body">
                                    <h2 class="card-title text-md">Belum ada barang</h2>
                                </div>
                            </div>
                        @endforelse

                        @if ($carts->count() > 0)


                            <div class="border-t border-gray-700 my-4"></div>
                            <div class="flex justify-between">
                                <label for="shipping_address_id">Alamat</label>
                                <button class="btn btn-sm" onclick="my_modal_5.showModal()">Tambah Alamat +</button>
                            </div>
                            @foreach ($shippingAddresses as $shippingAddress)
                                <div class="form-control bg-success rounded-xl">
                                    <label class="label cursor-pointer">
                                        <div>
                                            <input type="radio" name="shipping_address_id" value="{{ $shippingAddress->id }}"
                                                class="radio" />
                                            <span class="label-text">{{ $shippingAddress->address }},
                                                {{ $shippingAddress->city }}, {{ $shippingAddress->province }},
                                                {{ $shippingAddress->postal_code }}</span>
                                        </div>

                                        <div class="flex gap-1">
                                            <button class="btn btn-sm"
                                                onclick="editAddress( '{{ $shippingAddress->address }}', '{{ $shippingAddress->city }}', '{{ $shippingAddress->province }}', '{{ $shippingAddress->postal_code }}')">Edit</button>
                                            <button class="btn btn-sm btn-error" onclick="my_modal_7.showModal()">Hapus</button>
                                            <form id="formDeleteAlamat"
                                                action="{{ route('customer.shippings.shipping_address.destroy', $shippingAddress->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                            <dialog id="my_modal_5" class="modal modal-bottom sm:modal-middle text-neutral-950">
                                <div class="modal-box">
                                    <h3 class="font-bold text-lg">Tambah Alamat</h3>
                                    <form id="formTambahAlamat"
                                        action="{{ route('customer.shippings.shipping_address.store') }}" method="post">
                                        @csrf
                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text">Alamat</span>
                                            </label>
                                            <input type="text" name="address" placeholder="Alamat"
                                                class="input input-bordered" />
                                        </div>
                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text">Kota</span>
                                            </label>
                                            <input type="text" name="city" placeholder="Kota"
                                                class="input input-bordered" />
                                        </div>
                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text">Provinsi</span>
                                            </label>
                                            <input type="text" name="province" placeholder="Provinsi"
                                                class="input input-bordered" />
                                        </div>
                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text">Kode Pos</span>
                                            </label>
                                            <input type="number" name="postal_code" placeholder="Kode Pos"
                                                class="input input-bordered" />
                                        </div>
                                    </form>
                                    <div class="modal-action">
                                        <form method="dialog">
                                            <button onclick="submitTambah()" class="btn btn-sm btn-neutral">Simpan</button>
                                            <button class="btn btn-sm btn-neutral">Batal</button>
                                        </form>
                                    </div>
                                </div>
                            </dialog>



                            <dialog id="my_modal_6" class="modal modal-bottom sm:modal-middle text-neutral-950">
                                <div class="modal-box">
                                    <h3 class="font-bold text-lg">Edit Alamat</h3>
                                    <form id="formEditAlamat"
                                        action="{{ route('customer.shippings.shipping_address.update', $shippingAddress->id) }}"
                                        method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text">Alamat</span>
                                            </label>
                                            <input type="text" name="address" placeholder="Alamat"
                                                class="input input-bordered" id="modalAddress"
                                                value="{{ $shippingAddress->address }}" />
                                        </div>
                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text">Kota</span>
                                            </label>
                                            <input type="text" name="city" placeholder="Kota" class="input input-bordered"
                                                id="modalCity" />
                                        </div>
                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text">Provinsi</span>
                                            </label>
                                            <input type="text" name="province" placeholder="Provinsi"
                                                class="input input-bordered" id="modalProvince" />
                                        </div>
                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text">Kode Pos</span>
                                            </label>
                                            <input type="number" name="postal_code" placeholder="Kode Pos"
                                                class="input input-bordered" id="modalPostalCode" />
                                        </div>

                                    </form>
                                    <div class="modal-action">

                                        <form method="dialog">
                                            <button onclick="submitEdit()" class="btn btn-sm btn-neutral">Simpan</button>
                                            <button class="btn btn-sm btn-neutral">Batal</button>
                                        </form>
                                    </div>
                                </div>
                            </dialog>


                            <dialog id="my_modal_7" class="modal modal-bottom sm:modal-middle text-neutral-950">
                                <div class="modal-box">
                                    <h3 class="font-bold text-lg">Hapus Alamat</h3>

                                    <div class="modal-action">
                                        <form method="dialog">
                                            <button onclick="submitHapus()" class="btn btn-sm btn-neutral">Yakin</button>
                                            <button class="btn btn-sm btn-neutral">Batal</button>
                                        </form>
                                    </div>
                                </div>
                            </dialog>

                            <label for="shipping_method_id">Metode Pengiriman</label>
                            <select name="select_shipping_method_id" id="select_shipping_method_id"
                                class="form-select select select-bordered w-full bg-neutral-900">
                                <option value="" disabled selected>--Pilih Pengiriman--</option>
                                @foreach ($shippingMethods as $shippingMethod)
                                    <option value="{{ $shippingMethod->id }}" data-shipping-cost="{{ $shippingMethod->price }}">
                                        {{ $shippingMethod->name }} |
                                        Rp. {{ number_format($shippingMethod->price, 2, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>

                            <div class="border-t border-gray-700 my-4"></div>

                            <div class="flex justify-between font-bold">
                                <h1>Shipping Fee</h1>
                                <h1><span id="shipping-fee"></span></h1>
                            </div>
                            <div class="flex justify-between font-bold">
                                <h1>Total Diskon</h1>
                                <h1><span id="diskon">Rp. {{ number_format($totalDiscount, 0, ',', '.') }}</span></h1>
                            </div>
                            <div class="flex justify-between font-bold">
                                <h1>Grand Total</h1>
                                <h1><span id="grand-total" data-grand-total="{{ $grandTotalAmount }}"
                                        data-grand-total-diskon="{{ $grandTotalAmount }}"></span>
                                </h1>
                            </div>


                            <form action="{{route('customer.transactionOuts.store')}}" method="post"
                                enctype="multipart/form-data" id="form-checkout">
                                @csrf
                                <input type="hidden" name="grand_total_amount" id="input-selected-grandTotal"
                                    value="{{$grandTotalAmount}}">
                                <!-- <input type="hidden" name="discount_amount" id="input-selected-discount"> -->
                                <!-- <input type="hidden" name="promo_code_id" id="input-selected-promo_code_id"-->
                                <input type="hidden" id="shipping_address_id" name="shipping_address_id">
                                <input type="hidden" id="shipping_method_id" name="shipping_method_id">
                                <input type="hidden" id="shipping_cost" name="shipping_cost">
                                <div class="flex gap-3 w-full flex-col">
                                    <label for="payment_id" class="font-bold">Metode Pembayaran</label>
                                    <div class="flex gap-3">
                                        <label for="payment_method-1"
                                            class="flex bg-blue-400 outline-dashed outline-blue-500 rounded-xl text-neutral-950 gap-2 p-3 w-full items-center">
                                            <input class="radio" type="radio" name="payment_method" value="Cash"
                                                id="payment_method-1">
                                            <h1>Cash</h1>
                                        </label>
                                        <label for="payment_method-2"
                                            class="flex bg-blue-400 outline-dashed outline-blue-500 rounded-xl text-neutral-950 gap-2 p-3 w-full items-center">
                                            <input class="radio" type="radio" name="payment_method" value="Transfer"
                                                id="payment_method-2">
                                            <h1>Transfer</h1>
                                        </label>
                                        <div>
                                            <select name="payment_id" id="payment_id"
                                                class="select select-bordered outline outline-1 outline-neutral-950 bg-neutral-900 text-neutral-200">
                                                <option value="" disabled selected>--Pilih Pembayaran Via--</option>
                                                @foreach ($payments as $payment)
                                                    <option value="{{$payment->id}}"
                                                        data-payment-address=" {{$payment->payment_address}}">
                                                        {{$payment->payment_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div>
                                                <h1>Alamat Pembayaran</h1>
                                                <div class="badge badge-ghost" id="view-payment-address"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <br>
                                <div class=" gap-3 w-full justify-between" id="child-bukti-bayar">

                                </div>

                                <br>
                                <button type="submit" class="btn btn-success w-full">Lanjutkan</button>
                            </form>

                        @else
                            <div class="flex justify-between font-bold">
                                <h1>Sub Total</h1>
                                <h1>Rp. 0</h1>
                            </div>
                            <button class="btn btn-warning" disabled>Lanjutkan</button>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection

<script>
    const submitTambah = () => {
        const form = document.getElementById('formTambahAlamat')
        form.submit()
    }


    const submitEdit = () => {
        const form = document.getElementById('formEditAlamat')
        form.submit()
    }

    const submitHapus = () => {
        const form = document.getElementById('formDeleteAlamat')
        form.submit()
    }


    const editAddress = (address, city, province, postalCode) => {
        my_modal_6.showModal();

        const modalAddress = document.getElementById('modalAddress');
        const modalCity = document.getElementById('modalCity');
        const modalProvince = document.getElementById('modalProvince');
        const modalPostalCode = document.getElementById('modalPostalCode');

        modalAddress.value = address;
        modalCity.value = city;
        modalProvince.value = province;
        modalPostalCode.value = postalCode;


    }
    document.addEventListener('DOMContentLoaded', function () {
        const shippingAddressId = document.querySelectorAll("input[name='shipping_address_id']");
        const shippingMethodId = document.querySelectorAll("select[name='select_shipping_method_id']");
        // jika di check maka console log
        const inputShippingAddressId = document.getElementById('shipping_address_id')

        const inputShippingMethodId = document.getElementById('shipping_method_id')
        const inputShippingCost = document.getElementById('shipping_cost')
        const shippingFee = document.getElementById('shipping-fee')



        const grandTotalId = document.getElementById('grand-total')
        const dataGrandTotal = grandTotalId.getAttribute('data-grand-total')

        const formatRupiah = (angka) => {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(angka);
        }
        shippingFee.textContent = 'Rp. 0'
        grandTotalId.textContent = formatRupiah(dataGrandTotal)


        shippingAddressId.forEach((address) => {
            address.addEventListener('change', () => {
                if (address.checked) {
                    inputShippingAddressId.value = address.value
                }
            })
        })

        shippingMethodId.forEach((shippingMethodId) => {
            shippingMethodId.addEventListener('change', () => {
                const shippingCostSelected = shippingMethodId.options[shippingMethodId.selectedIndex]
                const dataShippingCost = shippingCostSelected.getAttribute('data-shipping-cost')


                shippingFee.textContent = formatRupiah(dataShippingCost)


                const jumlahTotal = parseInt(dataGrandTotal) + parseInt(dataShippingCost)

                grandTotalId.textContent = formatRupiah(jumlahTotal)

                const inputGrandTotal = document.getElementById("input-selected-grandTotal")
                inputGrandTotal.value = jumlahTotal

                inputShippingCost.value = dataShippingCost
                inputShippingMethodId.value = shippingCostSelected.value
                // console.log(inputShippingMethodId.value)
            })
        })


        const decrement = $('.btn-content[id^=decrement-]')
        const increment = $(".btn-content[id^=increment-]")



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

        const selectPaymentId = document.getElementById('payment_id')
        const viewPaymentAddress = document.getElementById('view-payment-address')


        selectPaymentId.addEventListener("change", () => {
            const selectedPaymentId = selectPaymentId.value
            const paymentOption = selectPaymentId.querySelectorAll('option')
            const selectedOption = Array.from(paymentOption).find(option => option.value == selectedPaymentId)

            if (selectedOption) {
                const paymentAddress = selectedOption.getAttribute('data-payment-address')
                viewPaymentAddress.textContent = paymentAddress
            } else {
                viewPaymentAddress.textContent = 'Pilih Dulu Via Transfer'
            }
        })

        const formCheckout = document.getElementById('form-checkout')
        const childBuktiBayar = document.getElementById('child-bukti-bayar');
        const paymentMethodRadio = document.getElementById('payment_method-2');
        const paymentMethodRadio1 = document.getElementById('payment_method-1');

        let label, input;

        paymentMethodRadio.addEventListener('change', () => {
            if (paymentMethodRadio.checked) {
                if (!label && !input) {
                    label = document.createElement('label');
                    label.setAttribute('for', 'proof_of_payment');
                    label.classList.add('font-bold');
                    label.textContent = 'Bukti Pembayaran';

                    input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('name', 'proof_of_payment');
                    input.setAttribute('id', 'proof_of_payment');
                    input.classList.add('file-input', 'w-full', 'max-w-xs', 'bg-neutral-900', 'text-netural-100');

                    childBuktiBayar.appendChild(label);
                    childBuktiBayar.appendChild(input);
                }
            }
        });

        paymentMethodRadio1.addEventListener('change', () => {
            if (paymentMethodRadio1.checked) {
                if (label && input) {
                    childBuktiBayar.removeChild(label);
                    childBuktiBayar.removeChild(input);

                    label = null;
                    input = null;
                }
            }
        });



        const subTotalElement = document.getElementById("sub-total");
        const grandTotalElement = document.getElementById("grand-total");
        const inputGrandTotal = document.getElementById("input-selected-grandTotal")
        const subTotalDiskon = document.getElementById('sub-total-diskon')
        const getDiskon = document.getElementById("diskon")

        const singleSub = document.getElementById("single-sub")
        const cutSub = document.getElementById("cut-sub")
        const subTotalOriginal = document.getElementById("sub-total-original")

        const inputDiskon = document.getElementById("input-selected-discount")
        const dataDiskon = document.getElementById("discount")


        const hitungGrandTotal = () => {


            const grandTotal = grandTotalElement.getAttribute("data-grand-total-diskon")
            const grandTotalOriginal = grandTotalElement.getAttribute("data-grand-total")
            const diskon = dataDiskon.getAttribute("data-discount")

            grandTotalElement.textContent = formatRupiah(grandTotal)



            inputGrandTotal.value = parseFloat(grandTotal)

            inputDiskon.value = diskon


        }


        hitungGrandTotal()



        // function calculateTotals() {
        //     // Ambil semua elemen dengan atribut data-total-amount
        //     const totalAmountElements = document.querySelectorAll('[data-total-amount]');

        //     // Hitung total_amount
        //     let subTotal = 0;
        //     totalAmountElements.forEach(el => {
        //         subTotal += parseFloat(el.getAttribute('data-total-amount')) || 0;
        //     });

        //     const diskon = parseFloat(getDiskon.innerText) || 0
        //     const diskonAmount = (diskon / 100) * subTotal



        //     const grandTotal = subTotal - diskonAmount


        //     // Tampilkan total_amount
        //     subTotalOriginal.textContent = subTotal.toLocaleString('id-ID', { minimumFractionDigits: 0 }) || "0";
        //     subTotalDiskon.textContent = (subTotal - diskonAmount).toLocaleString('id-ID', { minimumFractionDigits: 0 }) || "0";

        //     subTotalElement.textContent = (subTotal.toLocaleString('id-ID', { minimumFractionDigits: 0 }) || "0")
        //     if (diskon > 0) {
        //         cutSub.classList.remove("hidden");
        //         singleSub.classList.add("hidden");
        //     } else {
        //         cutSub.classList.add("hidden");
        //         singleSub.classList.remove("hidden");
        //     }

        //     // Tampilkan grand total
        //     grandTotalElement.textContent = grandTotal.toLocaleString('id-ID', { minimumFractionDigits: 0 }) || 0;


        //     inputGrandTotal.value = grandTotal

        // }

        // // Panggil fungsi saat halaman dimuat
        // calculateTotals();

        // Tambahkan event listener untuk memperbarui grand total saat biaya pengiriman berubah
        shippingElement.addEventListener('DOMSubtreeModified', calculateTotals);

    });
</script>