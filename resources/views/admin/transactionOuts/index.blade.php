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
                <h3 class="card-title">Data Transaksi Keluar</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <!-- <form action="{{ route('admin.transactionOuts.index') }}" method="get" class="d-flex"
                    style="gap: 5px; align-items:center">
                    @csrf
                    <div>
                        <input type="checkbox" name="status[]" id="waiting" value="Menunggu">
                        <label for="waiting">Menunggu</label>
                    </div>
                    <div>
                        <input type="checkbox" name="status[]" id="process" value="Siap diambil">
                        <label for="pickup">Siap diambil</label>
                    </div>
                    <div>
                        <input type="checkbox" name="status[]" id="delivered" value="Sudah diambil">
                        <label for="completed">Sudah diambil</label>
                    </div>
                    <button type="submit" class="btn btn-sm btn-dark">Filter</button>
                </form> -->

                <form action="{{ route('admin.transactionOuts.index') }}" method="GET"
                    class="d-flex flex-column justify-content-center gap-3">
                    <div class="d-flex flex-row">
                        <div class="w-100">
                            <label for="transaction_out_status">Status Pesanan</label>
                            <select name="transaction_out_status" id="transaction_out_status"
                                class="form-control w-44 bg-neutral-100 outline outline-1 outline-neutral-950">
                                <option disabled selected>--Status Pesanan--</option>
                                <option value="Menunggu">Menunggu</option>
                                <option value="Dikirim">Dikirim</option>
                                <option value="Diterima">Diterima</option>
                                <option value="Dibatalkan">Dibatalkan</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex flex-row">
                        <div class="w-100 ">
                            <label for="start_date">Dari tanggal</label>
                            <input type="date" name="start_date" id="start_date" class="form-control">
                        </div>
                        <div class="w-100 ">
                            <label for="end_date">Sampai tanggal</label>
                            <input type="date" name="end_date" id="end_date" class="form-control">
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-dark">Cari</button>
                    </div>
                </form>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Transaksi</th>
                            <th>Tgl Transaksi</th>
                            <th>Pembeli</th>
                            <th>Metode Pembayaran</th>
                            <th>Status Pembayaran</th>
                            <th>Status Pesanan</th>
                            <th>Grand Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactionOuts as $transactionOut)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $transactionOut->transaction_out_code }}</td>
                                                    <td>{{ $transactionOut->transaction_out_date }}</td>
                                                    <td>{{ $transactionOut->user->name }}</td>
                                                    <td>{{ $transactionOut->payment_method }} | {{ $transactionOut->payment->payment_name }}
                                                    </td>
                                                    @php
                                                        $statusClass = 'danger'; // Default value
                                                        if ($transactionOut->transaction_out_status == 'Menunggu') {
                                                            $statusClass = 'secondary';
                                                        } elseif ($transactionOut->transaction_out_status == 'Dikirim') {
                                                            $statusClass = 'warning';
                                                        } elseif ($transactionOut->transaction_out_status == 'Diterima') {
                                                            $statusClass = 'success';
                                                        }

                                                        $statusPayment = 'danger';
                                                        if ($transactionOut->payment_status == 'Lunas') {
                                                            $statusPayment = 'success';
                                                        } elseif ($transactionOut->payment_status == 'Menunggu') {
                                                            $statusPayment = 'secondary';
                                                        }
                                                    @endphp
                                                    <td> <span
                                                            class="badge badge-{{ $statusPayment}}">{{ $transactionOut->payment_status  }}</span>
                                                    </td>


                                                    <td> <span
                                                            class="badge badge-{{ $statusClass }}">{{$transactionOut->transaction_out_status}}</span>
                                                    </td>
                                                    <td>Rp. {{ number_format($transactionOut->grand_total_amount, 0, ',', '.') }}</td>
                                                    <td>
                                                        <a href="{{route('admin.transactionOuts.show', $transactionOut->id)}}"
                                                            class="btn btn-sm btn-info">Detail</a>
                                                    </td>
                                                </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Kode Transaksi</th>
                            <th>Tgl Transaksi</th>
                            <th>Pembeli</th>
                            <th>Metode Pembayaran</th>
                            <th>Status Pembayaran</th>
                            <th>Status Pesanan</th>
                            <th>Grand Total</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>


        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>

@endsection