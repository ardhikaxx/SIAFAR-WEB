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

                <h3 class="card-title">Tambah Data Obat</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('admin.medicines.index')}}" class="btn btn-dark mb-3">Kembali</a>
                <form action="{{route('admin.medicines.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <label for="medicine_code">Kode Obat</label>
                    <input type="text" id="medicine_code" name="medicine_code" class="form-control"
                        placeholder="Kode Obat" aria-label="Kode Obat" aria-describedby="basic-addon1"
                        value="{{$medicineCode}}" readonly>
                    <label for="name">Nama Obat</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Nama Obat"
                        aria-label="Nama Obat" aria-describedby="basic-addon1">

                    <label for="photo">Foto</label>
                    <input type="file" id="photo" name="photo" class="form-control" placeholder="Foto" aria-label="Foto"
                        aria-describedby="basic-addon1">


                    <label for="price">Harga</label>
                    <input type="number" id="price" name="price" class="form-control" placeholder="Harga"
                        aria-label="Harga" aria-describedby="basic-addon1">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" class="form-control" placeholder="Deskripsi"
                        aria-label="Deskripsi" aria-describedby="basic-addon1"></textarea>


                    <label for="category_id">Kategori</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <label for="unit_id">Satuan</label>
                    <select name="unit_id" id="unit_id" class="form-control">
                        <option value="">Pilih Satuan</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                        @endforeach
                    </select>
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