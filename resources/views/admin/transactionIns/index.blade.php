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

                <h3 class="card-title">Data Transaksi Masuk</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('admin.transactionIns.create')}}" class="btn btn-dark mb-3">Tambah Transaksi Masuk
                    +</a>
                <form class="d-flex gap-5 flex-row align-items-end" action="{{ route('admin.transactionIns.index') }}"
                    method="GET">
                    @csrf
                    <div class="d-flex flex-row gap-2 w-100 align-items-end">
                        <div class="w-100 ">
                            <label for="start_date">Dari tanggal</label>
                            <input type="date" name="start_date" id="start_date" class="form-control">
                        </div>
                        <div class="w-100 ">
                            <label for="end_date">Sampai tanggal</label>
                            <input type="date" name="end_date" id="end_date" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-dark">Cari</button>
                    </div>
                </form>
                <br>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Transaksi</th>
                            <th>Tgl Transaksi</th>
                            <th>Supplier</th>
                            <th>Grand Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactionIns as $transactionIn)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transactionIn->transaction_in_code }}</td>
                                <td>{{ $transactionIn->transaction_in_date }}</td>
                                <td>{{ $transactionIn->supplier->name }}</td>
                                <td>{{ $transactionIn->grand_total_amount }}</td>
                                <td>
                                    <a href="{{route('admin.transactionIns.show', $transactionIn->id)}}"
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
                            <th>Supplier</th>
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