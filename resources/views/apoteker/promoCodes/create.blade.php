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

                <h3 class="card-title">Tambah Data Kode Promo</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('admin.promoCodes.index')}}" class="btn btn-dark mb-3">Kembali</a>
                <form action="{{route('admin.promoCodes.store')}}" method="post">
                    @csrf
                    <label for="promo_code">Kode Promo</label>
                    <input type="text" id="promo_code" name="promo_code" class="form-control" placeholder="Kode Promo"
                        aria-label="Kode Promo" aria-describedby="basic-addon1">
                    <label for="discount_amount">Jumlah Diskon %</label>
                    <input type="text" id="discount_amount" name="discount_amount" class="form-control"
                        placeholder="Jumlah Diskon %" aria-label="Jumlah Diskon %" aria-describedby="basic-addon1">
                    <label for="start_date">Tanggal Mulai</label>
                    <input type="date" id="start_date" name="start_date" class="form-control"
                        placeholder="Tanggal Mulai" aria-label="Tanggal Mulai" aria-describedby="basic-addon1">
                    <label for="end_date">Tanggal Selesai</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" placeholder="Tanggal Selesai"
                        aria-label="Tanggal Selesai" aria-describedby="basic-addon1">

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