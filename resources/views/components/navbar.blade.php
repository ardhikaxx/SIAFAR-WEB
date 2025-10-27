<div>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="button" id="logoutButton" class="btn btn-danger btn-sm mt-1">Logout</button>
                </form>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        @if (Auth::user()->role == 'admin')
            <a href={{ route('admin.index') }} class="brand-link">
                <img src="{{asset('assets/dist/img/S Logo.webp')}}" alt="S Logo" class="brand-image img-circle elevation-3"
                    style="opacity: 0.8" />
                <span class="brand-text font-weight-light">Apotek Cendana</span>
            </a>
        @else
            <a href={{ route('apoteker.index') }} class="brand-link">
                <img src="{{asset('assets/dist/img/S Logo.webp')}}" alt="S Logo" class="brand-image img-circle elevation-3"
                    style="opacity: 0.8" />
                <span class="brand-text font-weight-light">Apotek Cendana</span>
            </a>

        @endif

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    @if(Auth::user()->image)
                        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="{{ Auth::user()->name }}"
                            class="rounded-circle" style="width:30px;height:30px">
                    @endif
                </div>
                <div class="info">
                    <a href="{{ Auth::user()->role == "admin" ? route('admin.profiles.edit', Auth::id()) : route('apoteker.profiles.edit', Auth::id()) }}"
                        class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                        aria-label="Search" />
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                    @if (Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a href='{{route('admin.index')}}' class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href='{{route('apoteker.index')}}' class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">

                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Data Master
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            @if(Auth::user()->role == 'admin')
                                <li class="nav-item">
                                    <a href='{{route('admin.medicines.index')}}' class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Obat</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href='{{route('admin.categories.index')}}' class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Kategori</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href='{{route('admin.units.index')}}' class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Satuan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href='{{route('admin.payments.index')}}' class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Payment</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href='{{route('admin.suppliers.index')}}' class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Supplier</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href='{{route('admin.shippings.index')}}' class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Pengiriman</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href='{{route('admin.users.index')}}' class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data User</p>
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href='{{route('apoteker.medicines.index')}}' class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Obat</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Transaksi
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        @if (Auth::user()->role == 'admin')
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href='{{route('admin.transactionIns.index')}}' class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Transaksi Masuk</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href='{{route('admin.transactionOuts.index')}}' class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Transaksi Keluar</p>
                                    </a>
                                </li>
                            </ul>
                        @else
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href='{{route('apoteker.transactionIns.index')}}' class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Transaksi Masuk</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href='{{route('apoteker.transactionOuts.index')}}' class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Transaksi Keluar</p>
                                    </a>
                                </li>
                            </ul>
                        @endif
                    </li>

                    @if (Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a href='{{route('admin.token.index')}}' class="nav-link">
                                <i class="nav-icon fas fa-plus-square"></i>
                                <p>Token Whatsapp</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='{{route('admin.feedbacks.index')}}' class="nav-link">
                                <i class="nav-icon fas fa-plus-square"></i>
                                <p>Feedback & Rating</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='{{route('admin.discounts.index')}}' class="nav-link">
                                <i class="nav-icon fas fa-plus-square"></i>
                                <p>Diskon</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='{{route('admin.reports.index')}}' class="nav-link">
                                <i class="nav-icon fas fas fa-copy"></i>
                                <p>Laporan</p>
                            </a>
                        </li>

                    @elseif (Auth::user()->role == 'apoteker')
                        <li class="nav-item">
                            <a href='{{route('apoteker.feedbacks.index')}}' class="nav-link">
                                <i class="nav-icon fas fa-plus-square"></i>
                                <p>Feedback & Rating</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='{{route('apoteker.discounts.index')}}' class="nav-link">
                                <i class="nav-icon fas fa-plus-square"></i>
                                <p>Diskon</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='{{route('apoteker.reports.index')}}' class="nav-link">
                                <i class="nav-icon fas fas fa-copy"></i>
                                <p>Laporan</p>
                            </a>
                        </li>
                    @endif

                </ul>


            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const logoutForm = document.getElementById("logoutForm")
        const logoutButton = document.getElementById("logoutButton")

        logoutButton.addEventListener("click", function () {
            if (confirm("Apakah anda yakin ingin logout?")) {
                logoutForm.submit()
            } else {
                return false
            }
        })
    })
</script>