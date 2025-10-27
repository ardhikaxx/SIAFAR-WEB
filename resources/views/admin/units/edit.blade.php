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

                <h3 class="card-title">Edit Data Satuan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('admin.units.index')}}" class="btn btn-dark mb-3">Kembali</a>
                <form action="{{route('admin.units.update', $unit->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <label for="name">Nama Satuan</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Nama Satuan"
                        aria-label="Nama Satuan" aria-describedby="basic-addon1" value="{{$unit->name}}">
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