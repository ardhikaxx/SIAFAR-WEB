<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel=" stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
<title>Cetak Laporan Transaksi Keluar</title>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="d-flex justify-content-center align-items-center text-bold flex-column">
                <h1>Apotek Cendana.</h1>
                <h3 class="card-title text-bold">Laporan Transaksi Keluar</h3>
                <p>{{$startDateOut}} - {{$endDateOut}}</p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Transaksi</th>
                            <th>Tgl Transaksi</th>
                            <th>Pembeli</th>
                            <th>Metode Pembayaran</th>
                            <th>Status Pembayaran</th>
                            <!-- <th>Status Antrian</th> -->
                            <th>Status Pesanan</th>
                            <th>Grand Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactionsOut as $transaction)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $transaction->transaction_out_code }}</td>
                                                    <td>{{ $transaction->transaction_out_date }}</td>
                                                    <td>{{ $transaction->user->name }}</td>
                                                    <td>{{ $transaction->payment_method }} | {{ $transaction->payment->payment_name }}</td>
                                                    @php
                                                        $statusClass = 'danger'; // Default value
                                                        if ($transaction->transaction_out_status == 'Menunggu') {
                                                            $statusClass = 'secondary';
                                                        } elseif ($transaction->transaction_out_status == 'Dikirim') {
                                                            $statusClass = 'warning';
                                                        } elseif ($transaction->transaction_out_status == 'Diterima') {
                                                            $statusClass = 'success';
                                                        }
                                                        $statusPayment = 'danger';
                                                        if ($transaction->payment_status == 'Lunas') {
                                                            $statusPayment = 'success';
                                                        } elseif ($transaction->payment_status == 'Menunggu') {
                                                            $statusPayment = 'secondary';
                                                        }

                                                        $statusAntri = '';
                                                        if ($transaction->queue_status == 'Aktif') {
                                                            $statusAntri = 'success';
                                                        } else {
                                                            $statusAntri = 'secondary';
                                                        }
                                                    @endphp
                                                    <td>
                                                        <span class="badge badge-{{ $statusPayment }}">
                                                            {{ $transaction->payment_status }}
                                                        </span>
                                                    </td>
                                                    <!-- <td><span class="badge badge-{{ $statusAntri }}">{{ $transaction->queue_status }}</span>
                                                                                                                                                                                                                                                    </td> -->
                                                    <td> <span
                                                            class="badge badge-{{ $statusClass }}">{{ $transaction->transaction_out_status }}</span>
                                                    </td>
                                                    <td>Rp. {{ number_format($transaction->grand_total_amount, 0, ',', '.') }}</td>

                                                </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    <p>Tidak ada data yang ditampilkan</p>
                                </td>
                            </tr>
                        @endforelse
                        <tr>
                            @php
                                $total = 0;
                                $total += $grandTotal
                            @endphp
                            <td colspan="7" class="text-right"><strong>Total :</strong></td>
                            <td><strong>Rp. {{ number_format($total, 0, ',', '.') }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class=" d-flex w-full justify-content-end p-4">
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