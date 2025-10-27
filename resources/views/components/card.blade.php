<div>
    <div class="row">
        <div class="{{Auth::user()->role == "admin" ? 'col-lg-3' : 'col-lg-4'}} col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $transactionOut }}</h3>

                    <p>Transaksi Keluar</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ Auth::user()->role == "admin" ? route('admin.transactionOuts.index') : route('apoteker.transactionOuts.index') }}"
                    class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="{{Auth::user()->role == "admin" ? 'col-lg-3' : 'col-lg-4'}}  col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $transactionIn }}</h3>

                    <p>Transaksi Masuk</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ Auth::user()->role == "admin" ? route('admin.transactionIns.index') : route('apoteker.transactionIns.index') }}"
                    class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        @if (Auth::user()->role == "admin")
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $users }}</h3>

                        <p>User</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="small-box-footer">Lihat <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $medicines }}</h3>

                        <p>Obat</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ route('admin.medicines.index') }}" class="small-box-footer">Lihat <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @else
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $medicines }}</h3>

                        <p>Obat</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ route('apoteker.medicines.index') }}" class="small-box-footer">Lihat <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endif
        <!-- ./col -->

        <!-- ./col -->
    </div>
</div>