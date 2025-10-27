@extends('layouts.adminlte')

@section('content')
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel=" stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
<div class="row">
    <div class="col-12">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <div>
                    {{ session('success') }}
                </div>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger" role="alert">
                <div>
                    {{ session('error') }}
                </div>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">My Profile</h3>
            </div>

            <!-- /.card-header -->
            <div class="card-body">

                <form action="{{route('apoteker.profiles.update', $user->id)}}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Nama"
                        aria-label="Nama Obat" aria-describedby="basic-addon1" value="{{ $user->name }}">

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email"
                        aria-label="Email" aria-describedby="basic-addon1" value="{{ $user->email }}">

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password"
                        aria-label="Password" aria-describedby="basic-addon1">

                    <label for="phone">Nomor Telepon</label>
                    <input type="number" min="0" id="phone" name="phone" class="form-control"
                        placeholder="Nomor Telepon" aria-label="Phone" aria-describedby="basic-addon1"
                        value="{{ $user->phone }}">

                    <div class="form-group">
                        <label for="image">Foto Profil</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                                <label class="custom-file-label" for="image">
                                    {{ $user->image ? basename($user->image) : 'Pilih file' }}
                                </label>
                            </div>
                        </div>
                        @if($user->image)
                            <small class="form-text text-muted">
                                File saat ini: {{ basename($user->image) }}
                            </small>
                            <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}"
                                class="img-thumbnail mt-2" style="max-height: 200px;">
                        @endif
                    </div>

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