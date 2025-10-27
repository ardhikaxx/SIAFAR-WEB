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
                <h3 class="card-title">Data Diskon Obat</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form class="d-flex gap-5 flex-row align-items-end pb-3"
                    action="{{ route('apoteker.discounts.index') }}" method="GET">
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
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Obat</th>
                            <th>Harga Asli</th>
                            <th>Harga Diskon</th>
                            <th>Jumlah Diskon</th>
                            <th>Status</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($discounts as $discount)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $discount->medicine->name }}</td>
                                <td>Rp. {{ number_format($discount->medicine->price, 0, ',', '.') }}</td>
                                <td>Rp.
                                    {{ number_format($discount->medicine->price - ($discount->medicine->price * ($discount->discount_amount / 100)), 0, ',', '.') }}
                                </td>
                                <td>{{ $discount->discount_amount }} %</td>
                                <td>{{ $discount->is_active === 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                                <td>{{ date_format(date_create($discount->start_date), 'Y-m-d') }}</td>
                                <td>{{ date_format(date_create($discount->end_date), 'Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama Obat</th>
                            <th>Harga Asli</th>
                            <th>Harga Diskon</th>
                            <th>Jumlah Diskon</th>
                            <th>Status</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
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