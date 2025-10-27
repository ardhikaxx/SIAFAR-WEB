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
            <!-- images/2XVHibyaaxKgImYXDXbKF5Q6zxT0A23TagJuat4a.png -->
            <div class="card-body">
                <a href="{{route('admin.medicines.create')}}" class="btn btn-dark mb-3">Tambah Obat +</a>
                @foreach ($zeroStocks as $zeroStock)
                    <div class="alert alert-danger">
                        {{$zeroStock->medicine_code}} - {{ $zeroStock->name }} Sudah habis
                    </div>
                @endforeach
                <form action="{{ route('admin.medicines.index') }}" method="GET"
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
                @if (Auth::user()->role === "admin")
                    <form action="{{ route('admin.medicines.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file" name="file">
                                    <label class="custom-file-label" for="file">
                                        Pilih file | csv,xls,xlsx
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success" type="submit">Import</button>
                    </form>
                @endif
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
                            <th>Aksi</th>
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
                                <td>
                                    <a href="{{route('admin.medicines.edit', $medicine->id)}}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{route('admin.medicines.destroy', $medicine->id)}}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</button>
                                    </form>
                                </td>
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
                            <th>Aksi</th>
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