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

                <h3 class="card-title">Edit Data Metode Pengiriman</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('admin.shippings.index')}}" class="btn btn-dark mb-3">Kembali</a>
                <form action="{{route('admin.shippings.shipping_method.update', $shippingMethod->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Nama" aria-label="Nama"
                        aria-describedby="basic-addon1" value="{{$shippingMethod->name}}">

                    <label for="price">Harga</label>
                    <input type="number" id="price" name="price" class="form-control" placeholder="Harga"
                        aria-label="Harga" aria-describedby="basic-addon1" value="{{$shippingMethod->price}}">
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