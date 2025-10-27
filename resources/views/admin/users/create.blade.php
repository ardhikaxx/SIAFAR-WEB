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
                <h3 class="card-title">Tambah Data User</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('admin.users.index')}}" class="btn btn-dark mb-3">Kembali</a>
                <form action="{{route('admin.users.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div>
                        <label for="name">Nama</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Nama User"
                            aria-label="Nama" aria-describedby="basic-addon1">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email"
                            aria-label="Email" aria-describedby="basic-addon1">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password"
                            aria-label="Password" aria-describedby="basic-addon1">
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="phone">Nomor Telepon</label>
                        <input type="number" min="0" id="phone" name="phone" class="form-control"
                            placeholder="Nomor Telepon" aria-label="Phone" aria-describedby="basic-addon1">
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Foto Profil</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">
                                    Pilih file | jpeg,png,jpg,gif maksimal 2mb
                                </label>
                            </div>
                        </div>
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control">
                            <option value="" disabled>Pilih Role</option>
                            <option value="customer">Customer</option>
                            <option value="apoteker">Apoteker</option>
                        </select>
                        @error('role')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
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