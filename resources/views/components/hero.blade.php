<div
    class="hero-section bg-gradient-to-br from-red-50 to-gray-50 min-h-screen w-full px-4 sm:px-6 lg:px-8 flex items-center">
    <section class="max-w-7xl mx-auto w-full">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-12">

            <!-- Text Content -->
            <div class="w-full lg:w-1/2 text-center lg:text-left space-y-8">
                <!-- Badge -->
                <div
                    class="inline-flex items-center gap-2 bg-white px-4 py-2 rounded-full shadow-sm border border-red-200">
                    <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                    <span class="text-sm font-medium text-red-600">Sistem Terintegrasi</span>
                </div>

                <!-- Heading -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                    <span class="bg-gradient-to-r from-red-600 to-pink-500 bg-clip-text text-transparent">
                        SIAFAR
                    </span>
                    <br>
                    <span class="text-2xl sm:text-3xl lg:text-4xl text-gray-700 font-semibold">
                        Sistem Informasi Apotek dan Farmasi
                    </span>
                </h1>

                <!-- Description -->
                <p class="text-lg sm:text-xl text-gray-600 leading-relaxed max-w-2xl">
                    SIAFAR membantu Anda memesan obat dengan mudah, cepat, dan terpercaya.
                    Nikmati pengalaman berbelanja obat yang praktis dan efisien dengan layanan modern kami.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="{{ Auth::check() ? route('customer.medicines.index') : route('public.medicines.index') }}"
                        class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-red-600 to-pink-600 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 hover:from-red-700 hover:to-pink-700">
                        <span class="relative z-10">Pesan Sekarang!</span>
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                        <div
                            class="absolute inset-0 bg-white/20 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </a>

                    <!-- Secondary Button -->
                    <a href="#features"
                        class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-red-600 border-2 border-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all duration-300">
                        Pelajari Lebih Lanjut
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-6 pt-8 max-w-md">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-red-600">500+</div>
                        <div class="text-sm text-gray-500">Jenis Obat</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-red-600">24/7</div>
                        <div class="text-sm text-gray-500">Layanan</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-red-600">100%</div>
                        <div class="text-sm text-gray-500">Terpercaya</div>
                    </div>
                </div>
            </div>

            <!-- Image/Illustration -->
            <div class="w-full lg:w-1/2 relative">
                <div class="relative">
                    <div class="bg-white rounded-2xl p-8 shadow-2xl border border-gray-100">
                        <img src="{{ asset('assets/images/hero_logo.svg') }}" alt="SIAFAR - Sistem Informasi Apotek"
                            class="w-full h-auto max-w-md mx-auto transform hover:scale-105 transition-transform duration-500">
                    </div>

                    <!-- Floating Elements -->
                    <div class="absolute -top-4 -right-4 w-20 h-20 bg-pink-400 rounded-full opacity-20 animate-pulse">
                    </div>
                    <div
                        class="absolute -bottom-6 -left-6 w-16 h-16 bg-red-400 rounded-full opacity-20 animate-pulse delay-1000">
                    </div>
                    <div
                        class="absolute top-1/2 -right-8 w-12 h-12 bg-rose-400 rounded-full opacity-20 animate-pulse delay-500">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>