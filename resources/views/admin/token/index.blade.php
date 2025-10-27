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

                <h3 class="card-title">Data Token Whatsapp</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ $token ? route('admin.token.update', $token->id) : route('admin.token.store') }}"
                    method="post">
                    @csrf
                    @if($token)
                        @method('PUT')
                    @endif
                    <label for="name">Token Whatsapp</label>
                    <input type="text" id="name" name="number_token" class="form-control" placeholder="Masukkan Token"
                        aria-label="Token Whatsapp" aria-describedby="basic-addon1"
                        value="{{ $token->number_token ?? '' }}">
                    <button type="submit" class="btn btn-dark mt-3">Simpan</button>
                </form>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nomor Token</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tokens as $token)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $token->number_token }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama Kategori</th>
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