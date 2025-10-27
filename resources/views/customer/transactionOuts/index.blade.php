@extends('layouts.app')

@section('content-customer')

<div
    class="container p-4 min-w-full min-h-screen flex flex-col justify-center items-center bg-neutral-100 text-neutral-950">
    <h1 class="text-3xl font-bold m-4">Transaksi Pemesanan</h1>
    <div class="card-body w-full">
        <form action="{{ route('customer.transactionOuts.index') }}" method="GET" class="flex justify-start gap-3">
            <input type="search" name="search" id="search"
                class="input input-bordered w-full max-w-xs bg-neutral-100 outline outline-1 outline-neutral-950"
                placeholder="Cari Transaksi..." value="{{ $search }}">

            <select name="transaction_out_status" id="transaction_out_status"
                class="select w-44 bg-neutral-100 outline outline-1 outline-neutral-950">
                <option disabled selected>--Status Pesanan--</option>
                <option value="Menunggu">Menunggu</option>
                <option value="Dikirim">Dikirim</option>
                <option value="Diterima">Diterima</option>
                <option value="Dibatalkan">Dibatalkan</option>
            </select>
            <button class="btn btn-neutral text-neutral-200">Cari</button>
        </form>
        <div class="overflow-x-scroll w-full mt-4">
            <table class="table table-auto min-w-full">
                <thead class="text-neutral-950">
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Tanggal Transaksi</th>
                        <th>Status Pembayaran</th>
                        <th>Bukti Pembayaran</th>
                        <th>Status Pesanan</th>
                        <th>Grand Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $transaction->transaction_out_code }}</td>
                                            <td>{{ $transaction->transaction_out_date }}</td>
                                            <td>
                                                @php
                                                    $statusPayment = '';
                                                    if ($transaction->payment_status == 'Menunggu') {
                                                        $statusPayment = 'badge-primary';
                                                    } elseif ($transaction->payment_status == 'Lunas') {
                                                        $statusPayment = 'badge-success';
                                                    } else {
                                                        $statusPayment = 'badge-error';
                                                    }
                                                @endphp
                                                <div class="badge {{ $statusPayment }}">{{ $transaction->payment_status }}</div>
                                            </td>
                                            <td>
                                                @if ($transaction->proof_of_payment)
                                                    <img src="{{ asset('storage/' . $transaction->proof_of_payment) }}" alt="Payment Proof"
                                                        class="w-16 h-16">
                                                @elseif ($transaction->proof_of_payment == null && $transaction->payment_method == 'Cash')
                                                    <div class="badge badge-success">Cash</div>
                                                @else
                                                    <div class="badge badge-error">Kosong</div>
                                                @endif
                                            </td>

                                            @php
                                                $statusClass = 'danger'; // Default value
                                                if ($transaction->transaction_out_status == 'Menunggu') {
                                                    $statusClass = 'badge-secondary';
                                                } elseif ($transaction->transaction_out_status == 'Dikirim') {
                                                    $statusClass = 'badge-warning';
                                                } elseif ($transaction->transaction_out_status == 'Diterima') {
                                                    $statusClass = 'badge-success';
                                                } elseif ($transaction->transaction_out_status == 'Dibatalkan') {
                                                    $statusClass = 'badge-error';
                                                }
                                            @endphp
                                            <td>
                                                <div class="badge {{ $statusClass }}">{{ $transaction->transaction_out_status }}</div>
                                            </td>
                                            <td>Rp. {{ number_format($transaction->grand_total_amount, 0, ',', '.') }}</td>
                                            <td class="flex flex-col gap-2">
                                                <a href="{{ route('customer.transactionOuts.show', $transaction->id) }}"
                                                    class="btn btn-sm btn-neutral text-neutral-200">Detail</a>
                                                @if ($transaction->payment_status == 'Lunas')
                                                    <a href="{{ route('customer.transactionOuts.print', $transaction->id) }}"
                                                        class="btn btn-sm btn-success" target="_blank">Cetak Invoice</a>
                                                @endif

                                            </td>
                                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
                {{ $transactions->links() }}
            </table>

        </div>
    </div>

</div>
@endsection