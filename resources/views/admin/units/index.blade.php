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

                <h3 class="card-title">Data Satuan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('admin.units.create')}}" class="btn btn-dark mb-3">Tambah Satuan +</a>
                @if (Auth::user()->role === "admin")
                    <form action="{{ route('admin.units.import') }}" method="POST" enctype="multipart/form-data">
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
                            <th>Nama Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($units as $unit)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $unit->name }}</td>
                                <td>
                                    <a class="btn btn-sm btn-warning"
                                        href="{{route('admin.units.edit', $unit->id)}}">Edit</a>
                                    <form action="{{route('admin.units.destroy', $unit->id)}}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama Satuan</th>
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