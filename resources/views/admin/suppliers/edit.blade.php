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

                <h3 class="card-title">Edit Data Supplier</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('admin.suppliers.index')}}" class="btn btn-dark mb-3">Kembali</a>
                <form action="{{route('admin.suppliers.update', $supplier->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <label for="supplier_code">Kode Supplier</label>
                    <input type="text" id="supplier_code" name="supplier_code" class="form-control"
                        placeholder="Kode Supplier" aria-label="Kode Supplier" aria-describedby="basic-addon1"
                        value="{{ $supplier->supplier_code }}" readonly>
                    <label for="name">Nama Supplier</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Nama Supplier"
                        aria-label="Nama Supplier" aria-describedby="basic-addon1" value="{{ $supplier->name }}">
                    <label for="address">Alamat</label>
                    <input type="text" id="address" name="address" class="form-control" placeholder="Alamat"
                        aria-label="Alamat" aria-describedby="basic-addon1" value="{{ $supplier->address }}">
                    <label for="phone">No. Telpon</label>
                    <input type="text" id="phone" name="phone" class="form-control" placeholder="No. Telpon"
                        aria-label="No. Telpon" aria-describedby="basic-addon1" value="{{ $supplier->phone }}">
                    <button type="submit" class="btn btn-dark mt-3">Simpan</button>
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