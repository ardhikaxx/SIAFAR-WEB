@extends('layouts.adminlte')

@section('content')
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel=" stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">

                <h3 class="card-title">Data Detail Transaksi Keluar</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('admin.transactionOuts.index')}}" class="btn btn-dark mb-3">Kembali</a>
                <h3>Detail Transaksi Keluar</h3>
                <table class="table table-bordered">
                    <table class="table table-bordered">
                        <tr>
                            <th>Tanggal Transaksi</th>
                            <td>{{$transactionOut->transaction_out_date}}</td>
                        </tr>
                        <tr>
                            <th>Kode Transaksi</th>
                            <td>{{$transactionOut->transaction_out_code}}</td>
                        </tr>
                        <tr>
                            <th>Pembeli</th>
                            <td>{{$transactionOut->user->name}}</td>
                        </tr>
                        <tr>
                            <th>Status Pembayaran</th>
                            <td>{{$transactionOut->payment_status}}</td>
                        </tr>
                        <tr>
                            <th>Metode Pembayaran</th>
                            <td>{{$transactionOut->payment_method}} | {{$transactionOut->payment->payment_name}}</td>
                        </tr>
                        <tr>
                            <th>Bukti Pembayaran</th>
                            <td>
                                @if($transactionOut->proof_of_payment)
                                    <img style=" height: 300px;"
                                        src="{{ asset('storage/' . $transactionOut->proof_of_payment) }}"
                                        alt="{{ $transactionOut->payment_method }}">
                                @elseif($transactionOut->payment_method == "Cash")
                                    <span class="badge rounded-pill text-bg-danger">Pembayaran Cash</span>
                                @else
                                    <span class="badge rounded-pill text-bg-danger">Belum Ada Bukti Pembayaran</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Alamat Pengiriman</th>
                            <td>{{$transactionOut->shipping_address->address}},
                                {{$transactionOut->shipping_address->city}},
                                {{$transactionOut->shipping_address->province}},
                                {{$transactionOut->shipping_address->postal_code}}
                            </td>
                        </tr>
                        <tr>
                            <th>Metode Pengiriman</th>
                            <td>{{$transactionOut->shipping_method->name}}, {{$transactionOut->shipping_method->price}}
                            </td>
                        </tr>
                        <tr>
                            <th>Status Pesanan</th>
                            <td>{{$transactionOut->transaction_out_status}}</td>
                        </tr>

                        <tr>
                            <th colspan="3"></th>
                        </tr>
                        <table class="table table-bordered">
                            <tr>
                                <th>Nama Obat</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Jumlah Diskon</th>
                                <th>Total Jumlah</th>
                            </tr>
                            @foreach ($transactionOutDetails as $item)
                                <tr>
                                    <td>{{$item->medicine->name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>Rp.{{number_format($item->medicine->price, 0, ',', '.')}}</td>
                                    <td>{{ $item->discount_amount }}%</td>

                                    <td>Rp.{{ number_format($item->total_amount, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach

                            <tr>
                                <th colspan="4">Shipping Fee</th>
                                <td class="text-bold">
                                    Rp. {{ number_format($shippingFee, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr>
                                <th colspan="4">Total Diskon</th>
                                <td class="text-bold">
                                    Rp. {{ number_format($totalDiscount, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr>
                                <th colspan="4">Grand Total</th>
                                <td class="text-bold">Rp.
                                    {{ number_format($transactionOut->grand_total_amount, 0, ',', '.')}}
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3"></th>
                            </tr>
                        </table>

                        @if ($transactionOut->payment_status == 'Menunggu')
                            <form id="paymentStatusForm"
                                action="{{ route('admin.transactionOuts.update', $transactionOut->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="payment_status">
                                <button type="submit" class="btn btn-dark" id="approve">Approve Pembayaran</button>
                                <button type="submit" class="btn btn-danger" id="reject">Tolak</button>
                            </form>
                        @else
                            <div class="d-flex">
                                <div>
                                    <a href="{{route('admin.transactionOuts.print', $transactionOut->id)}}" target="_blank"
                                        class="btn btn-dark">Cetak</a>
                                </div>
                                <form
                                    action="{{ route('admin.transactionOutStatus.updateStatusOut', $transactionOut->id) }}"
                                    method="POST">
                                    @csrf
                                    @method("PUT")
                                    <select name="transaction_out_status" id="transaction_out_status" class="form-control">
                                        <option disabled selected>{{$transactionOut->transaction_out_status}}</option>
                                        <option value="Menunggu">Menunggu</option>
                                        <option value="Dikirim">Dikirim</option>
                                        <option value="Diterima">Diterima</option>
                                    </select>
                                    <button type="submit" class="btn btn-dark">Update Status Transaksi</button>
                                </form>
                                <form action="{{ route('admin.transactionOuts.whatsapp', $transactionOut->id) }}"
                                    method="post">
                                    @csrf
                                    <input type="hidden" name="phone" value="{{$transactionOut->user->phone}}">
                                    <button type="submit" class="btn btn-success">Kirim Notif Whatsapp</button>
                                </form>
                            </div>

                        @endif
                    </table>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {


        const approve = document.getElementById('approve');
        const reject = document.getElementById('reject');

        approve.addEventListener('click', function (event) {
            event.preventDefault();
            const status = document.querySelector('input[name="payment_status"]');

            status.value = 'Lunas';

            const form = document.getElementById('paymentStatusForm');
            form.submit();

            alert('Pembayaran berhasil disetujui!');
            console.log(status.value);
        })

        reject.addEventListener('click', function (event) {
            event.preventDefault();
            const status = document.querySelector('input[name="payment_status"]');

            status.value = 'Ditolak';
            const form = document.getElementById('paymentStatusForm');
            form.submit();
        })

    })
</script>
@endsection