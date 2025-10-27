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

                <h3 class="card-title">Laporan Transaksi Obat Masuk</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form class="d-flex gap-5 flex-row align-items-end" action="{{ route('admin.reports.reportIn') }}"
                    method="GET" target="_blank">
                    @csrf
                    <div class="d-flex flex-row gap-2 w-100 align-items-end">
                        <div class="w-100 ">
                            <label for="start_date_in">Dari tanggal</label>
                            <input type="date" name="start_date_in" id="start_date_in" class="form-control">
                        </div>
                        <div class="w-100 ">
                            <label for="end_date_in">Sampai tanggal</label>
                            <input type="date" name="end_date_in" id="end_date_in" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-dark">Cetak</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="card">
            <div class="card-header">

                <h3 class="card-title">Laporan Transaksi Obat Keluar</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form class="d-flex gap-5 flex-column align-items-end" action="{{ route('admin.reports.reportOut') }}"
                    method="GET" target="_blank">
                    @csrf
                    <div class="d-flex" style="gap: 5px;">
                        <div>
                            <input type="checkbox" name="status[]" id="waiting" value="Menunggu">
                            <label for="waiting">Menunggu</label>
                        </div>
                        <div>
                            <input type="checkbox" name="status[]" id="delivered" value="Dikirim">
                            <label for="delivered">Dikirim</label>
                        </div>
                        <div>
                            <input type="checkbox" name="status[]" id="received" value="Diterima">
                            <label for="received">Diterima</label>
                        </div>
                        <div>
                            <input type="checkbox" name="status[]" id="canceled" value="Dibatalkan">
                            <label for="canceled">Dibatalkan</label>
                        </div>
                    </div>
                    <div class="d-flex flex-row gap-2 w-100 align-items-end">
                        <div class="w-100 ">
                            <label for="start_date_out">Dari tanggal</label>
                            <input type="date" name="start_date_out" id="start_date_out" class="form-control">
                        </div>
                        <div class="w-100 ">
                            <label for="end_date_in">Sampai tanggal</label>
                            <input type="date" name="end_date_out" id="end_date_in" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-dark">Cetak</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>

@endsection