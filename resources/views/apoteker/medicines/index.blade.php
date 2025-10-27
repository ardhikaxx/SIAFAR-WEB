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

                <h3 class="card-title">Data Obat</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @foreach ($zeroStocks as $zeroStock)
                    <div class="alert alert-danger">
                        {{$zeroStock->medicine_code}} - {{ $zeroStock->name }} Sudah habis
                    </div>
                @endforeach
                <form action="{{ route('apoteker.medicines.index') }}" method="GET"
                    class="mb-4 d-flex flex-row justify-content-center gap-4 w-full">
                    <select name="category" id="category"
                        class="form-control w-44 outline outline-1 outline-neutral-950">
                        <option disabled selected>--Kategori--</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->name }}" {{ $category == request('category') ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <select name="unit" id="unit" class="form-control w-44 outline outline-1 outline-neutral-950">
                        <option disabled selected>--Satuan--</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->name }}" {{ $unit == request('unit') ? 'selected' : '' }}>
                                {{ $unit->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-dark btn-sm">Filter</button>

                </form>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Obat</th>
                            <th>Nama Obat</th>
                            <th>Foto</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Stok</th>
                            <th>Kategori</th>
                            <th>Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($medicines as $medicine)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $medicine->medicine_code }}</td>
                                <td>{{ $medicine->name }}</td>
                                <td><img class="w-25 h-25" src="{{ asset('storage/' . $medicine->photo) }}"
                                        alt="{{ $medicine->name }}"></td>
                                <td>{{ $medicine->price }}</td>
                                <td>{{ $medicine->description }}</td>
                                <td>{{ $medicine->stock }}</td>
                                <td>{{ $medicine->category->name }}</td>
                                <td>{{ $medicine->unit->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Kode Obat</th>
                            <th>Nama Obat</th>
                            <th>Foto</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Stok</th>
                            <th>Kategori</th>
                            <th>Satuan</th>
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