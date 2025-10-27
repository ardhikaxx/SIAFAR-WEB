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

                <h3 class="card-title">Edit Data Alamat Pengiriman</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('admin.shippings.index')}}" class="btn btn-dark mb-3">Kembali</a>
                <form action="{{route('admin.shippings.shipping_address.update', $shippingAddress->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <label for="user_id">User</label>
                    <select name="user_id" id="user_id" class="form-control">
                        <option value="{{ $shippingAddress->user->id }}">{{$shippingAddress->user->name}}</option>
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                    <label for="address">Alamat</label>
                    <input type="text" id="address" name="address" class="form-control" placeholder="Alamat"
                        aria-label="Alamat" aria-describedby="basic-addon1" value="{{ $shippingAddress->address }}">

                    <label for="city">Kota</label>
                    <input type="text" id="city" name="city" class="form-control" placeholder="Kota" aria-label="Kota"
                        aria-describedby="basic-addon1" value="{{ $shippingAddress->city }}">

                    <label for="province">Provinsi</label>
                    <input type="text" id="province" name="province" class="form-control" placeholder="Provinsi"
                        aria-label="Provinsi" aria-describedby="basic-addon1" value="{{ $shippingAddress->province }}">

                    <label for="postal_code">Kode Pos</label>
                    <input type="number" id="postal_code" name="postal_code" class="form-control" placeholder="Kode Pos"
                        aria-label="Kode Pos" aria-describedby="basic-addon1"
                        value="{{ $shippingAddress->postal_code }}">
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