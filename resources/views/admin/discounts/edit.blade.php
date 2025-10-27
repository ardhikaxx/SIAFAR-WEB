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

                <h3 class="card-title">Edit Data Diskon Obat</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('admin.discounts.index')}}" class="btn btn-dark mb-3">Kembali</a>
                <form action="{{route('admin.discounts.update', $discount->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <label for="medicine_id">Nama Obat</label>
                    <select name="medicine_id" id="medicine_id" class="form-control">
                        <option value="{{ $discount->medicine_id }}">{{ $discount->medicine->name }}</option>
                        @foreach ($medicines as $medicine)
                            <option value="{{$medicine->id}}">{{$medicine->name}}</option>
                        @endforeach
                    </select>
                    <label for="discount_amount">Jumlah Diskon %</label>
                    <input type="number" min="0" id="discount_amount" name="discount_amount" class="form-control"
                        value="{{ $discount->discount_amount }}" placeholder="Jumlah diskon %"
                        aria-label="Jumlah Diskon %" aria-describedby="basic-addon1">
                    <label for="start_date">Tanggal Mulai</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" placeholder="Alamat"
                        value="{{ date_format(date_create($discount->start_date), 'Y-m-d')}}" aria-label="Tanggal Mulai"
                        aria-describedby="basic-addon1">
                    <label for="end_date">Tanggal Selesai</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" placeholder="No. Telpon"
                        value="{{ date_format(date_create($discount->end_date), 'Y-m-d') }}"
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