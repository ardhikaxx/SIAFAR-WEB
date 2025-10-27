<footer class="footer footer-center bg-content text-neutral-200 bg-neutral-950 p-10 flex h-80 justify-between">
    <aside class="flex flex-col justify-between h-56 p-5 items-start">
        <h1 class="text-3xl font-bold">Apotek Cendana.</h1>
        <div class="text-start text-md">
            <h1>Alamat</h1>
            <p> Jl. Tb. Ismail no. 94, Kavling Blok F, Cilegon – Banten</p>
        </div>
        <p class="text-md">Copyright &copy; 2024 - All right reserved</p>
    </aside>
    <aside>
        <ul>
            <li class="flex flex-col gap-3 justify-start items-start">
                <a href="{{ Auth::check() ? route('customer.index') : route('public.index') }}">Home</a>
                <a href="{{ route('customer.transactionOuts.index')}}">Transaksi Pemesanan</a>
                <a href="{{ Auth::check() ? route('customer.medicines.index') : route('public.medicines.index') }}">Daftar
                    Obat</a>
            </li>
        </ul>
    </aside>
</footer>