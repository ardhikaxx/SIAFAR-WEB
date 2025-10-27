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

                <h3 class="card-title">Data Promo Kode</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('admin.promoCodes.create')}}" class="btn btn-dark mb-3">Tambah Kode Promo +</a>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Promo</th>
                            <th>Jumlah Diskon</th>
                            <th>status</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($promoCodes as $promoCode)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$promoCode->promo_code }}</td>
                                <td>{{$promoCode->discount_amount }}%</td>
                                <td>{{$promoCode->is_active == 0 ? 'Tidak Aktif' : 'Aktif' }}</td>
                                <td>{{$promoCode->start_date }}</td>
                                <td>{{$promoCode->end_date }}</td>
                                <td>
                                    <a class="btn btn-sm btn-warning"
                                        href="{{route('admin.promoCodes.edit', $promoCode->id)}}">Edit</a>
                                    <form action="{{route('admin.promoCodes.destroy', $promoCode->id)}}" method="POST"
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
                            <th>Kode Promo</th>
                            <th>Jumlah Diskon</th>
                            <th>status</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
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