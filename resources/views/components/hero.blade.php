<div class="hero bg-neutral-100 min-h-screen w-full px-10">
    <section class="hero-content flex-col lg:flex-row-reverse w-full">
        <div class="w-full lg:w-1/2">
            <img src="{{ asset('assets/images/hero_logo.svg') }}" alt="Hero Logo" />
        </div>
        <div class="text-justify text-wrap text-neutral-950 w-full lg:w-1/2">
            <h1 class="text-5xl font-bold">Apotek Cendana</h1>
            <h3 class="py-6 text-xl">
                Apotek Cendana menyediakan sistem informasi pemesanan obat yang dapat memudahkan pengguna untuk
                melakukan pemesanan obat dengan mudah dan cepat. Sistem ini juga dapat melakukan pelayanan
                pembelian obat dengan mudah dan cepat.
            </h3>
            <a href="{{ Auth::check() ? route('customer.medicines.index') : route('public.medicines.index') }}"
                class="btn btn-neutral text-neutral-200">Pesan
                Sekarang!</a>
        </div>
    </section>
</div>