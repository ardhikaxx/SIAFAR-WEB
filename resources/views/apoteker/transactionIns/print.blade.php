<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel=" stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
<title>Cetak Transaksi Masuk</title>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="d-flex flex-column justify-content-center text-center">
                <h1>Apotek Cendana.</h1>
                <h3 class="card-title text-bold">Laporan Data Transaksi Masuk</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
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
                        <th>Supplier</th>
                        <td>{{$transactionIn->supplier->name}}</td>
                    </tr>
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
                        </tr>
                        @foreach ($transactionInDetails as $item)
                            <tr>
                                <td>{{$item->medicine->name}}</td>
                                <td>{{$item->added_quantity}}</td>
                                <td>{{$item->current_stock}}</td>
                                <td>{{$item->old_stock}}</td>
                                <td>Rp.{{number_format($item->buy_price, 0, ',', '.')}}</td>
                                <td>Rp.{{number_format($item->total_amount, 0, ',', '.')}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="5">Grand Total</th>
                            <td class="text-bold">Rp.
                                {{number_format($transactionIn->grand_total_amount, 0, ',', '.')}}
                            </td>
                        </tr>
                    </table>

                </table>

            </div>
            <!-- /.card-body -->
            <div class="d-flex w-full justify-content-end p-4">
                <div class="text-center">
                    <div>
                        <p>Serang, {{ now()->format('d F Y') }}</p>
                    </div>
                    <br><br><br>
                    <div>
                        <h6>Administrator</h6>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>

<script>
    window.onload = function () {
        window.print();
    }
</script>