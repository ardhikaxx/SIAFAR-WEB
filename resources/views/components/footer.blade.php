<footer class="footer bg-gradient-to-br from-red-50 to-gray-50 text-gray-900 p-10 border-t border-red-100">
    <div class="max-w-7xl mx-auto w-full">
        <div class="flex flex-col lg:flex-row justify-between items-start gap-8">
            <!-- Brand Section -->
            <div class="flex flex-col gap-6">
                <h1 class="text-3xl font-bold bg-gradient-to-r from-red-600 to-pink-500 bg-clip-text text-transparent">SIAFAR</h1>
                <div class="space-y-2">
                    <h2 class="font-semibold text-gray-800 text-lg">Sistem Informasi Apotek dan Farmasi</h2>
                    <p class="text-gray-600 max-w-md">
                        Memberikan pelayanan terbaik dalam pemesanan obat dengan sistem yang modern dan terpercaya.
                    </p>
                </div>
                <div class="space-y-1">
                    <h3 class="font-semibold text-gray-800">Alamat</h3>
                    <p class="text-gray-600">Jember, Jawa Timur</p>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="flex flex-col gap-4">
                <h3 class="font-semibold text-gray-800 text-lg">Menu Cepat</h3>
                <nav class="flex flex-col gap-3">
                    <a href="{{ Auth::check() ? route('customer.index') : route('public.index') }}" 
                       class="hover:text-red-600 transition-colors duration-300 font-medium flex items-center gap-2 group">
                        <div class="w-1.5 h-1.5 bg-red-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        Home
                    </a>
                    <a href="{{ route('customer.transactionOuts.index')}}" 
                       class="hover:text-red-600 transition-colors duration-300 font-medium flex items-center gap-2 group">
                        <div class="w-1.5 h-1.5 bg-red-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        Transaksi Pemesanan
                    </a>
                    <a href="{{ Auth::check() ? route('customer.medicines.index') : route('public.medicines.index') }}" 
                       class="hover:text-red-600 transition-colors duration-300 font-medium flex items-center gap-2 group">
                        <div class="w-1.5 h-1.5 bg-red-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        Daftar Obat
                    </a>
                </nav>
            </div>

            <!-- Contact Info -->
            <div class="flex flex-col gap-4">
                <h3 class="font-semibold text-gray-800 text-lg">Kontak</h3>
                <div class="space-y-2 text-gray-600">
                    <p>📞 (0331) 123-456</p>
                    <p>📧 info@siafar.com</p>
                    <p>🕒 Buka 24/7</p>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-red-100 mt-8 pt-6 text-center">
            <p class="text-gray-600">Copyright &copy; 2025 SIAFAR - All rights reserved</p>
        </div>
    </div>
</footer>