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

                <h3 class="card-title">Data Detail Transaksi Masuk</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('admin.transactionIns.index')}}" class="btn btn-dark mb-3">Kembali</a>
                <h3>Detail Transaksi Masuk</h3>
                <table class="table table-bordered">
                    <tr>

                        <th>Kode Transaksi</th>
                        <td>{{$transactionIn->transaction_in_code}}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Transaksi</th>
                        <td>{{$transactionIn->transaction_in_date}}</td>
                    </tr>
                    <tr>
                        <th colspan="2"></th>
                    </tr>
                    @if ($transactionIn->is_saved == 0)
                        <form action="{{route('admin.transactionInDetails.store')}}" method="POST">
                            @csrf
                            <input type="hidden" name="transaction_in_id" value="{{$transactionIn->id}}">
                            <tr>
                                <th>Nama Obat</th>
                                <td>
                                    <select name="medicine_id" class="form-control" required>
                                        <option value="" selected disabled>--Pilih Obat--</option>
                                        @foreach ($medicines as $medicine)
                                            <option value="{{$medicine->id}}">{{$medicine->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Jumlah Stok Masuk</th>
                                <td>
                                    <input type="number" name="added_quantity" class="form-control" min="1">
                                </td>
                            </tr>
                            <tr>
                                <th>Harga Beli</th>
                                <td>
                                    <input type="number" name="buy_price" class="form-control" min="1">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="btn btn-dark">Tambah Obat +</button>
                                </td>
                            </tr>
                        </form>
                    @endif
                    <tr>
                        <th colspan="2"></th>
                    </tr>
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Obat</th>
                            <th>Jumlah Masuk</th>
                            <th>Stok Baru</th>
                            <th>Stok Lama</th>
                            <th>Harga Beli</th>
                            <th>Sub Total</th>
                            <th>Aksi</th>
                        </tr>
                        @forelse ($transactionInDetails as $item)
                            <tr>
                                <td>{{$item->medicine->name}}</td>
                                <td>
                                    @if ($transactionIn->is_saved == 0)
                                        <form class="flex gap-2"
                                            action="{{route('admin.transactionInDetails.update', $item->id)}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="added_quantity" value="{{$item->added_quantity}}"
                                                class="form-control" min="1">
                                            <button type="submit" class="btn btn-sm btn-dark">Update Jumlah</button>
                                        </form>
                                    @else
                                        {{$item->added_quantity}}
                                    @endif
                                </td>
                                <td>{{$item->current_stock}}</td>
                                <td>{{$item->old_stock}}</td>
                                <td>Rp.{{number_format($item->buy_price, 0, ',', '.')}}</td>
                                <td>Rp.{{number_format($item->total_amount, 0, ',', '.')}}</td>
                                <td>
                                    @if ($transactionIn->is_saved == 0)
                                        <form action="{{route('admin.transactionInDetails.destroy', $item->id)}}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>

                                    @else
                                        <button type="button" class="btn btn-sm btn-danger disabled">Hapus</button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                        <tr>
                            <th colspan="5">Grand Total</th>
                            <td class="text-bold" colspan="2">Rp.
                                {{number_format($transactionIn->grand_total_amount, 0, ',', '.')}}
                            </td>
                        </tr>
                    </table>


                    @if ($transactionIn->is_saved == 0)
                        <form action="{{route('admin.transactionIns.update', $transactionIn->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-dark">Simpan Transaksi</button>
                        </form>
                    @else
                        <a href="{{ route('admin.transactionIns.print', $transactionIn->id) }}" class="btn btn-dark"
                            target="_blank">Cetak</a>
                    @endif

                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>

@endsection