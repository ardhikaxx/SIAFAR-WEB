<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel=" stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
<title>Cetak Laporan Transaksi Masuk</title>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="d-flex justify-content-center align-items-center text-bold flex-column">
                <h1>Apotek Cendana.</h1>
                <h3 class="card-title text-bold">Laporan Transaksi Masuk</h3>
                <p>{{ $startDateIn }} - {{ $endDateIn }}</p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Transaksi</th>
                            <th>Tgl Transaksi</th>
                            <th>Supplier</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactionsIn as $transaction)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transaction->transaction_in_code }}</td>
                                <td>{{ $transaction->transaction_in_date }}</td>
                                <td>{{ $transaction->supplier->name }}</td>
                                <td>Rp. {{ number_format($transaction->grand_total_amount, 0, ',', '.')}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    <p>Tidak ada data yang ditampilkan</p>
                                </td>
                            </tr>
                        @endforelse
                        <tr>
                            <td colspan="4" class="text-right"><strong>Total :</strong></td>
                            <td><strong>Rp. {{ number_format($grandTotal, 0, ',', '.') }}</strong></td>
                        </tr>
                    </tbody>
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
                        <h6>{{Auth::user()->name}}</h6>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>

<script>
    window.print()
</script>