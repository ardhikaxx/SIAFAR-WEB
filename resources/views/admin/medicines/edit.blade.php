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

                <h3 class="card-title">Edit Data Obat</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('admin.medicines.index')}}" class="btn btn-dark mb-3">Kembali</a>
                <form action="{{route('admin.medicines.update', $medicine->id)}}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <label for="medicine_code">Kode Obat</label>
                    <input type="text" id="medicine_code" name="medicine_code" class="form-control"
                        placeholder="Kode Obat" aria-label="Kode Obat" aria-describedby="basic-addon1"
                        value="{{ $medicine->medicine_code }}" readonly>
                    <label for="name">Nama Obat</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Nama Obat"
                        aria-label="Nama Obat" aria-describedby="basic-addon1" value="{{ $medicine->name }}">

                    <div class="form-group">
                        <label for="photo">Foto Produk</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="photo" name="photo" accept="image/*">
                                <label class="custom-file-label" for="photo">
                                    {{ $medicine->photo ? basename($medicine->photo) : 'Pilih file' }}
                                </label>
                            </div>
                        </div>
                        @if($medicine->photo)
                            <small class="form-text text-muted">
                                File saat ini: {{ basename($medicine->photo) }}
                            </small>
                            <img src="{{ asset('storage/' . $medicine->photo) }}" alt="{{ $medicine->name }}"
                                class="img-thumbnail mt-2" style="max-height: 200px;">
                        @endif
                    </div>


                    <label for="price">Harga</label>
                    <input type="number" id="price" name="price" class="form-control" placeholder="Harga"
                        aria-label="Harga" aria-describedby="basic-addon1" value="{{ $medicine->price }}">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" class="form-control" placeholder="Deskripsi"
                        aria-label="Deskripsi" aria-describedby="basic-addon1">{{ $medicine->description }}</textarea>


                    <label for="category_id">Kategori</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            @if ($category->id == $medicine->category_id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>


                    <label for="unit_id">Satuan</label>
                    <select name="unit_id" id="unit_id" class="form-control">
                        <option value="">Pilih Satuan</option>
                        @foreach ($units as $unit)
                            @if ($unit->id == $medicine->unit_id)
                                <option value="{{ $unit->id }}" selected>{{ $unit->name }}</option>
                            @else
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                            @endif
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