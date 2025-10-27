@extends('layouts.app')

@section('content-customer')
<div class="container mx-auto p-4 w-full min-h-screen flex flex-col justify-center items-center bg-neutral-100">
    <h1 class="text-3xl font-bold mb-4">Detail Transaksi Pemesanan</h1>
    <div class="card-body flex flex-row gap-4">

        <div class="flex flex-col gap-4">
            <div class="">
                <a href="{{ route('customer.transactionOuts.index') }}"
                    class="btn btn-sm btn-neutral text-neutral-200">Kembali</a>

            </div>
            <div class="flex flex-col gap-2">
                <table class="table-auto w-full">
                    <tbody>
                        <tr>
                            <td class="font-bold">Tanggal Transaksi:</td>
                            <td>{{ $transactionOut->transaction_out_date }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold">Kode Transaksi:</td>
                            <td>{{ $transactionOut->transaction_out_code }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold">Metode Pembayaran:</td>
                            <td>
                                {{ $transactionOut->payment_method }}
                                @if($payment)
                                    | {{ $payment->payment_name }} - {{ $payment->payment_address }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="font-bold">Status Pembayaran:</td>
                            <td>
                                @php
                                    $statusPayment = '';
                                    if ($transactionOut->payment_status == 'Menunggu') {
                                        $statusPayment = 'badge-primary';
                                    } elseif ($transactionOut->payment_status == 'Lunas') {
                                        $statusPayment = 'badge-success';
                                    } else {
                                        $statusPayment = 'badge-error';
                                    }
                                @endphp

                                <p class="badge {{ $statusPayment }}">{{$transactionOut->payment_status}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-bold">Alamat Pengiriman:</td>
                            <td>{{ $transactionOut->shipping_address->address }},
                                {{ $transactionOut->shipping_address->city }},
                                {{ $transactionOut->shipping_address->province }},
                                {{ $transactionOut->shipping_address->postal_code }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-bold">Metode Pengiriman:</td>
                            <td>{{ $transactionOut->shipping_method->name }},
                                Rp. {{ number_format($transactionOut->shipping_method->price, 0, ',', '.') }}
                            </td>
                        </tr>

                        <tr>
                            <td class="font-bold">Status Pesanan:</td>
                            @php
                                $statusClass = 'danger'; // Default value
                                if ($transactionOut->transaction_out_status == 'Menunggu') {
                                    $statusClass = 'badge-secondary';
                                } elseif ($transactionOut->transaction_out_status == 'Dikirim') {
                                    $statusClass = 'badge-warning';
                                } elseif ($transactionOut->transaction_out_status == 'Diterima') {
                                    $statusClass = 'badge-success';
                                } elseif ($transactionOut->transaction_out_status == 'Dibatalkan') {
                                    $statusClass = 'badge-error';
                                }
                            @endphp
                            <td>
                                <div class="badge {{ $statusClass }}">{{ $transactionOut->transaction_out_status }}
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Obat</th>
                            <th>Nama Obat</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Jumlah Diskon</th>
                            <th>Total Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactionOutDetails as $detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $detail->medicine->medicine_code }}</td>
                                <td>{{ $detail->medicine->name }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>Rp. {{ number_format($detail->price, 0, ',', '.')}}</td>
                                <td>{{ $detail->discount_amount }}%</td>
                                <td>Rp. {{ number_format($detail->total_amount, 0, ',', '.')}}</td>

                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="6">Shipping Fee</td>
                            <td class="font-bold">
                                Rp.
                                {{ number_format($shippingFee, 0, ',', '.') ?? '0' }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">Total Diskon</td>
                            <td class="font-bold">
                                Rp.
                                {{ number_format($totalDiscount, 0, ',', '.') ?? '0' }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">Grand Total</td>
                            <td class="font-bold">Rp.
                                {{ number_format($transactionOut->grand_total_amount, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <div>
            <!-- payment proof -->
            <div class="flex flex-col gap-2">
                @if ($transactionOut->payment_method === "Transfer")
                    <label for="proof_of_payment" class="font-bold">Bukti Pembayaran</label>
                    <form class="hidden" action="{{ route('customer.transactionOuts.update', $transactionOut->id) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @if ($transactionOut->payment_method == "Transfer")
                            <input disabled type="file" id="proof_of_payment" name="proof_of_payment"
                                class="file-input w-full max-w-xs" required>
                            <button type="submit" disabled class="btn btn-sm btn-neutral text-neutral-200">Upload</button>
                        @else
                            <input type="file" id="proof_of_payment" name="proof_of_payment" class="file-input w-full max-w-xs"
                                required>
                            <button type="submit" class="btn btn-sm btn-neutral text-neutral-200">Upload</button>
                        @endif
                    </form>
                    @if ($transactionOut->proof_of_payment)
                        <img src="{{ asset('storage/' . $transactionOut->proof_of_payment) }}" alt="Payment Proof" class="w-80">
                    @else
                        <div class="flex justify-center items-center h-52">
                            <h1 class="text-md text-gray-500">Belum ada bukti Pembayaran</h1>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection