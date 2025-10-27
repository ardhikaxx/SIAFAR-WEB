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
                <h3 class="card-title">Data Feedback & Rating Obat</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form class="d-flex gap-5 flex-row align-items-end" action="{{ route('admin.feedbacks.index') }}"
                    method="GET">
                    @csrf
                    <div class="d-flex flex-row gap-2 w-100 align-items-end">
                        <div class="w-100 ">
                            <label for="start_date_medicine">Dari tanggal</label>
                            <input type="date" name="start_date_medicine" id="start_date_medicine" class="form-control">
                        </div>
                        <div class="w-100 ">
                            <label for="end_date_medicine">Sampai tanggal</label>
                            <input type="date" name="end_date_medicine" id="end_date_medicine" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-dark">Cari</button>
                    </div>
                </form>
                <br>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Foto Profil</th>
                            <th>Nama User</th>
                            <th>Obat</th>
                            <th>Bintang</th>
                            <th>Komentar</th>
                            <th>Tanggal Posting</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($MedicineRatings as $MedicineRating)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img class="rounded-circle" style="width:50px;height:50px"
                                        src="{{ asset('storage/' . $MedicineRating->user->image) }}"
                                        alt="{{ $MedicineRating->user->name }}"></td>
                                <td>{{ $MedicineRating->user->name }}</td>
                                <td>{{ $MedicineRating->medicine->name }}</td>
                                <td>{{ $MedicineRating->rating }}</td>
                                <td>{{ $MedicineRating->comment }}</td>
                                <td>{{ $MedicineRating->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Foto Profil</th>
                            <th>Nama User</th>
                            <th>Obat</th>
                            <th>Bintang</th>
                            <th>Komentar</th>
                            <th>Tanggal Posting</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="card-header">
                <h3 class="card-title">Data Feedback & Rating Apotek</h3>
            </div>
            <!-- /.card-body -->
            <div class="card-body">
                <form class="d-flex gap-5 flex-row align-items-end" action="{{ route('admin.feedbacks.index') }}"
                    method="GET">
                    @csrf
                    <div class="d-flex flex-row gap-2 w-100 align-items-end">
                        <div class="w-100 ">
                            <label for="start_date_apotek">Dari tanggal</label>
                            <input type="date" name="start_date_apotek" id="start_date_apotek" class="form-control">
                        </div>
                        <div class="w-100 ">
                            <label for="end_date_apotek">Sampai tanggal</label>
                            <input type="date" name="end_date_apotek" id="end_date_apotek" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-dark">Cari</button>
                    </div>
                </form>
                <br>
                <table id="example3" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Foto Profil</th>
                            <th>Nama User</th>
                            <th>Bintang</th>
                            <th>Komentar</th>
                            <th>Tanggal Posting</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ApotekRatings as $ApotekRating)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img class="rounded-circle" style="width:50px;height:50px"
                                        src="{{ asset('storage/' . $ApotekRating->user->image) }}"
                                        alt="{{ $ApotekRating->user->name }}"></td>
                                <td>{{ $ApotekRating->user->name }}</td>
                                <td>{{ $ApotekRating->rating }}</td>
                                <td>{{ $ApotekRating->comment }}</td>
                                <td>{{ $ApotekRating->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Foto Profil</th>
                            <th>Nama User</th>
                            <th>Bintang</th>
                            <th>Komentar</th>
                            <th>Tanggal Posting</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>


@endsection