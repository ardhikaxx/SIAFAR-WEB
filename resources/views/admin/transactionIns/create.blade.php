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

                <h3 class="card-title">Tambah Data Transaksi Masuk</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('admin.transactionIns.index')}}" class="btn btn-dark mb-3">Kembali</a>
                <form action="{{route('admin.transactionIns.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="transaction_in_code">Kode Transaksi</label>
                        <input type="text" name="transaction_in_code" class="form-control"
                            value="{{$transaction_in_code}}" readonly>

                        <label for="transaction_in_date">Tanggal Transaksi</label>
                        <input type="date" name="transaction_in_date" class="form-control" value="{{date('Y-m-d')}}"
                            readonly>
                        <label for="supplier_id">Supplier</label>
                        <select name="supplier_id" class="form-control">
                            <option value="" disabled selected>--Pilih Supplier--</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-dark">Simpan</button>
                </form>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->
</div>

@endsection