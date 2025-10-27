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

                <h3 class="card-title">Data Detail Transaksi Masuk</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('apoteker.transactionIns.index')}}" class="btn btn-dark mb-3">Kembali</a>
                <h3>Detail Transaksi Masuk</h3>
                <table class="table table-bordered">
                    <tr>

                        <th>Kode Transaksi</th>
                        <td>{{$transactionIn->transaction_in_code}}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Transaksi</th>
                        <td>{{$transactionIn->transaction_in_date}}</td>
                    </tr>
                    <tr>
                        <th>Supplier</th>
                        <td>{{$transactionIn->supplier->name}}</td>
                    </tr>

                    <tr>
                        <th colspan="2"></th>
                    </tr>
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Obat</th>
                            <th>Jumlah Masuk</th>
                            <th>Stok Baru</th>
                            <th>Stok Lama</th>
                            <th>Harga Beli</th>
                            <th>Sub Total</th>
                        </tr>
                        @forelse ($transactionInDetails as $item)
                            <tr>
                                <td>{{$item->medicine->name}}</td>
                                <td>{{$item->added_quantity}}</td>
                                <td>{{$item->current_stock}}</td>
                                <td>{{$item->old_stock}}</td>
                                <td>Rp.{{number_format($item->buy_price, 0, ',', '.')}}</td>
                                <td>Rp.{{number_format($item->total_amount, 0, ',', '.')}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                        <tr>
                            <th colspan="5">Grand Total</th>
                            <td class="text-bold">Rp.
                                {{number_format($transactionIn->grand_total_amount, 0, ',', '.')}}
                            </td>
                        </tr>
                    </table>
                    <a href="{{ route('apoteker.transactionIns.print', $transactionIn->id) }}" class="btn btn-dark"
                        target="_blank">Cetak</a>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>

@endsection