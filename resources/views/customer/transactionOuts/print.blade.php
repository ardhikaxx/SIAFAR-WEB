<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel=" stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
<title>Cetak Invoice Pemesanan</title>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="text-center d-flex flex-column justify-content-center">
                <h1>Apotek Cendana.</h1>
                <h3 class="card-title text-bold">Invoice Transaksi Pemesanan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Tanggal Transaksi</th>
                        <td>{{$transactionOut->transaction_out_date}}</td>
                    </tr>
                    <tr>
                        <th>Kode Transaksi</th>
                        <td>{{$transactionOut->transaction_out_code}}</td>
                    </tr>
                    <tr>
                        <th>Pembeli</th>
                        <td>{{$transactionOut->user->name}}</td>
                    </tr>
                    <tr>
                        <th>Status Pembayaran</th>
                        <td>
                            @php
                                $statusPayment = '';
                                if ($transactionOut->payment_status == 'Menunggu') {
                                    $statusPayment = 'badge-primary';
                                } elseif ($transactionOut->payment_status == 'Lunas') {
                                    $statusPayment = 'badge-success';
                                } else {
                                    $statusPayment = 'badge-error';
                                }
                            @endphp

                            <p class="badge {{ $statusPayment }}">{{$transactionOut->payment_status}}</p>
                        </td>
                    </tr>

                    <tr>
                        <th>Metode Pembayaran</th>
                        <td>{{$transactionOut->payment_method}} | {{$transactionOut->payment->payment_name}}</td>
                    </tr>
                    <tr>
                        <th>Bukti Pembayaran</th>
                        <td>
                            @if ($transactionOut->proof_of_payment)
                                <img class="w-50 h-50" src="{{ asset('storage/' . $transactionOut->proof_of_payment) }}"
                                    alt="{{ $transactionOut->payment_method }}">
                            @elseif ($transactionOut->proof_of_payment == null && $transactionOut->payment_method == 'Cash')
                                <div class="badge badge-success">Cash</div>
                            @else
                                <div class="badge badge-error">Kosong</div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Alamat Pengiriman</th>
                        <td>{{$transactionOut->shipping_address->address}}, {{$transactionOut->shipping_address->city}},
                            {{$transactionOut->shipping_address->province}},
                            {{$transactionOut->shipping_address->postal_code}}
                        </td>
                    </tr>
                    <tr>
                        <th>Metode Pengiriman</th>
                        <td>
                            {{$transactionOut->shipping_method->name}}, {{$transactionOut->shipping_method->price}}
                        </td>
                    </tr>
                    <tr>
                        <th>Status Pesanan</th>
                        <td>{{$transactionOut->transaction_out_status}}</td>
                    </tr>
                    <tr>
                        <th colspan="3"></th>
                    </tr>
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Obat</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Jumlah Diskon</th>
                            <th>Total Jumlah</th>
                        </tr>
                        @foreach ($transactionOutDetails as $item)
                            <tr>
                                <td>{{$item->medicine->name}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>Rp.{{number_format($item->medicine->price, 0, ',', '.')}}</td>
                                <td>{{ $item->discount_amount }}%</td>

                                <td>Rp.{{ number_format($item->total_amount, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="4">Shipping Fee</th>
                            <td class="text-bold">
                                Rp. {{ number_format($shippingFee, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <th colspan="4">Total Diskon</th>
                            <td class="text-bold">
                                Rp. {{ number_format($totalDiscount, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <th colspan="4">Grand Total</th>
                            <td class="text-bold">Rp.
                                {{ number_format($transactionOut->grand_total_amount, 0, ',', '.')}}
                            </td>
                        </tr>
                        <tr>
                            <th colspan="3"></th>
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
                        <h6>{{ Auth::user()->name }}</h6>
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