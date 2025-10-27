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
                <h3 class="card-title">Data Metode Pengiriman</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{ route('admin.shippings.shipping_method.create') }}" class="btn btn-dark mb-3">Tambah Metode
                    Pengiriman +</a>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pengiriman</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shippingMethods as $shippingMethod)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $shippingMethod->name }}</td>
                                <td>Rp. {{ number_format($shippingMethod->price, 2, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('admin.shippings.shipping_method.edit', $shippingMethod->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form
                                        action="{{ route('admin.shippings.shipping_method.destroy', $shippingMethod->id) }}"
                                        method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Pengiriman</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="card-header">
                <h3 class="card-title">Data Alamat Pengiriman</h3>
            </div>
            <!-- /.card-body -->
            <div class="card-body">
                <a href="{{ route('admin.shippings.shipping_address.create') }}" class="btn btn-dark mb-3">Tambah Alamat
                    Pengiriman +</a>
                <table id="example3" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama User</th>
                            <th>Alamat</th>
                            <th>Kota</th>
                            <th>Provinsi</th>
                            <th>Kode Pos</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shippingAddresses as $shippingAddress)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $shippingAddress->user->name }}</td>
                                <td>{{ $shippingAddress->address }}</td>
                                <td>{{ $shippingAddress->city }}</td>
                                <td>{{ $shippingAddress->province }}</td>
                                <td>{{ $shippingAddress->postal_code }}</td>
                                <td>
                                    <a href="{{ route('admin.shippings.shipping_address.edit', $shippingAddress->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form
                                        action="{{ route('admin.shippings.shipping_address.destroy', $shippingAddress->id) }}"
                                        method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama User</th>
                            <th>Alamat</th>
                            <th>Kota</th>
                            <th>Provinsi</th>
                            <th>Kode Pos</th>
                            <th>Aksi</th>
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