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

                <h3 class="card-title">Edit Data Metode Pembayaran</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('admin.payments.index')}}" class="btn btn-dark mb-3">Kembali</a>
                <form action="{{route('admin.payments.update', $payment->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <label for="payment_name">Nama Metode Pembayaran</label>
                    <input type="text" id="payment_name" name="payment_name" class="form-control"
                        placeholder="Nama Metode Pembayaran" aria-label="Nama Metode Pembayaran"
                        aria-describedby="basic-addon1" value="{{ $payment->payment_name }}">
                    <label for="payment_address">Alamat Pembayaran</label>
                    <input type="text" id="payment_address" name="payment_address" class="form-control"
                        aria-label="Alamat Pembayaran" aria-describedby="basic-addon1"
                        value="{{ $payment->payment_address }}">
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