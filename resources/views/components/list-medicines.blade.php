<section class="py-20 px-6 lg:px-12 flex flex-col lg:flex-row gap-10 items-start bg-gradient-to-br from-red-50 to-gray-50">
    <!-- Deskripsi -->
    <div class="flex flex-col gap-5 w-full lg:w-1/4">
        <div class="space-y-3">
            <h1 class="text-5xl font-extrabold text-gray-900">List Obat</h1>
            <p class="text-lg text-gray-600 leading-relaxed">
                Beberapa daftar obat pilihan yang tersedia untuk Anda. Temukan obat yang Anda butuhkan dengan mudah.
            </p>
        </div>

        <div>
            <a href="{{ Auth::check() ? route('customer.medicines.index') : route('public.medicines.index') }}"
               class="inline-flex items-center justify-center px-6 py-3 mt-4 text-lg font-semibold text-white bg-gradient-to-r from-red-600 to-pink-600 rounded-xl shadow-md hover:shadow-lg hover:from-red-700 hover:to-pink-700 transform hover:-translate-y-1 transition-all duration-300">
                Lihat Selengkapnya
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- List Obat -->
    <div class="flex gap-6 p-4 w-full overflow-x-auto scrollbar-hide">
        @foreach ($medicines as $medicine)
            <div class="flex-shrink-0 bg-white rounded-2xl shadow-md hover:shadow-xl border border-gray-100 w-64 transition-transform transform hover:-translate-y-2">
                <figure class="relative">
                    <img src="{{ asset('storage/' . $medicine->photo) }}" 
                         alt="{{ $medicine->name }}" 
                         class="w-full h-48 object-cover rounded-t-2xl">
                    @if ($medicine->is_discount)
                        <span class="absolute top-3 left-3 bg-gradient-to-r from-red-600 to-pink-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                            Diskon
                        </span>
                    @endif
                </figure>

                <div class="p-4 space-y-2">
                    <h2 class="text-lg font-bold text-gray-900 truncate">{{ $medicine->name }}</h2>

                    @if ($medicine->is_discount)
                        <div class="flex flex-wrap gap-2 items-baseline">
                            <p class="text-sm text-gray-400 line-through">
                                Rp {{ number_format($medicine->original_price, 0, ',', '.') }}
                            </p>
                            <p class="text-lg font-semibold text-red-600">
                                Rp {{ number_format($medicine->discount_price, 0, ',', '.') }}
                            </p>
                        </div>
                    @else
                        <p class="text-lg font-semibold text-gray-800">
                            Rp {{ number_format($medicine->price, 0, ',', '.') }}
                        </p>
                    @endif

                    <div class="flex justify-center flex-col items-end pt-2 gap-2">
                        <span class="text-sm bg-pink-100 text-pink-600 font-medium px-2.5 py-0.5 rounded-full">
                            {{ $medicine->category->name }}
                        </span>
                        <span class="text-sm border border-gray-300 text-gray-600 px-2.5 py-0.5 rounded-full">
                            {{ $medicine->unit->name }}
                        </span>
                    </div>

                    <div class="pt-3">
                        <a href="{{ Auth::check() ? route('customer.medicines.show', $medicine->id) : route('public.medicines.show', $medicine->id) }}"
                           class="inline-flex w-full justify-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-red-600 to-pink-600 rounded-xl hover:from-red-700 hover:to-pink-700 transition-all duration-300">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>