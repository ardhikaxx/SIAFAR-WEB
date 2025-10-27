<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<div class="bg-white rounded-2xl shadow-xl border border-gray-100 w-full max-h-max overflow-hidden">
    <div class="flex flex-col lg:flex-row">
        <!-- Image Section -->
        <figure class="lg:w-1/2 p-6">
            <img class="w-full h-80 lg:h-96 rounded-2xl object-cover shadow-md" src="{{ $image }}" alt="{{ $name }}" />
        </figure>

        <!-- Content Section -->
        <div class="lg:w-1/2 p-6 flex flex-col justify-between">
            <!-- Header Info -->
            <div class="space-y-4">
                <h2 class="text-3xl font-bold text-gray-900 leading-tight">
                    {{ $name }}
                </h2>

                <!-- Price Section -->
                @if ($discount && $discount->medicine_id == $medicine->id && $discount->is_active == 1)
                    @php
                        $discountedPrice = $medicine->price - ($medicine->price * ($discount->discount_amount / 100));
                    @endphp
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-3">
                            <span class="bg-gradient-to-r from-red-600 to-pink-600 text-white text-sm font-semibold px-3 py-1 rounded-full shadow">
                                Diskon {{ $discount->discount_amount }}%
                            </span>
                        </div>
                        <div class="flex items-baseline gap-3">
                            <h2 class="text-xl text-gray-400 line-through">
                                Rp {{ number_format($medicine->price, 0, ',', '.') }}
                            </h2>
                            <h2 class="text-2xl font-bold text-red-600">
                                Rp {{ number_format($discountedPrice, 0, ',', '.') }}
                            </h2>
                        </div>
                    </div>
                @else
                    <h2 class="text-2xl font-bold text-gray-800">
                        Rp {{ number_format($price, 0, ',', '.') }}
                    </h2>
                @endif

                <!-- Stock Info -->
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-200">
                    <h1 class="font-semibold text-gray-700">Stok Tersedia</h1>
                    <div class="badge font-bold px-3 py-2 
                        {{ $stock > 0 ? 'bg-green-100 text-green-600 border-green-200' : 'bg-red-100 text-red-600 border-red-200' }}">
                        {{ $stock }} {{ $unit }}
                    </div>
                </div>

                <!-- Category and Unit -->
                <div class="flex flex-wrap gap-2">
                    <span class="text-sm bg-pink-100 text-pink-600 font-medium px-3 py-1.5 rounded-full border border-pink-200">
                        {{ $medicine->category->name }}
                    </span>
                    <span class="text-sm border border-gray-300 text-gray-600 font-medium px-3 py-1.5 rounded-full bg-gray-50">
                        {{ $medicine->unit->name }}
                    </span>
                </div>
            </div>

            <!-- Add to Cart Form -->
            <form action="{{ route('customer.carts.store') }}" method="POST" class=" mt-2">
                @csrf
                <input type="hidden" name="medicine_id" value="{{ $medicine->id }}">

                @if ($medicine->stock > 0)
                    <div class="flex flex-col sm:flex-row items-center gap-4">
                        <!-- Quantity Controls -->
                        <div class="flex items-center gap-2 bg-gray-50 rounded-xl p-1 border border-gray-200">
                            <button type="button" id="decrement" 
                                    class="w-10 h-10 flex items-center justify-center bg-white rounded-lg shadow-sm border border-gray-300 text-gray-700 hover:bg-red-50 hover:text-red-600 hover:border-red-300 transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                </svg>
                            </button>
                            <input type="number" id="qty" name="quantity" value="1" min="1" max="{{ $stock }}"
                                class="w-16 text-center bg-transparent border-0 text-lg font-semibold text-gray-900 focus:outline-none focus:ring-0">
                            <button type="button" id="increment" 
                                    class="w-10 h-10 flex items-center justify-center bg-white rounded-lg shadow-sm border border-gray-300 text-gray-700 hover:bg-red-50 hover:text-red-600 hover:border-red-300 transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </button>
                        </div>

                        <!-- Add to Cart Button -->
                        <button type="submit" 
                                class="flex-1 px-8 py-3 text-white font-semibold bg-gradient-to-r from-red-600 to-pink-600 rounded-xl shadow-lg hover:shadow-xl hover:from-red-700 hover:to-pink-700 transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2">
                            <svg class=" w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Stock Warning -->
                    @if($stock < 10)
                        <p class="text-sm text-amber-600 text-center">
                            ⚠️ Stok terbatas, hanya tersisa {{ $stock }} {{ $unit }}
                        </p>
                    @endif
                @else
                    <!-- Out of Stock State -->
                    <div class="text-center space-y-3">
                        <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                            <svg class="w-8 h-8 text-red-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            <p class="text-red-600 font-semibold">Stok Habis</p>
                            <p class="text-red-500 text-sm">Obat sedang tidak tersedia</p>
                        </div>
                        <button disabled 
                                class="w-full px-8 py-3 text-gray-400 font-semibold bg-gray-200 rounded-xl cursor-not-allowed flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Stok Habis
                        </button>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        const decrement = $("#decrement")
        const increment = $("#increment")
        const qty = $("#qty")
        const maxStock = {{ $medicine->stock }};

        decrement.on("click", () => {
            let currentQty = parseInt(qty.val());
            if (currentQty > 1) {
                qty.val(currentQty - 1);
            }
        });

        increment.on("click", () => {
            let currentQty = parseInt(qty.val());
            if (currentQty < maxStock) {
                qty.val(currentQty + 1);
            } else {
                // Optional: Show message when reaching max stock
                alert('Tidak dapat melebihi stok yang tersedia: ' + maxStock);
            }
        });

        // Validate input on change
        qty.on('change', function() {
            let value = parseInt($(this).val());
            if (isNaN(value) || value < 1) {
                $(this).val(1);
            } else if (value > maxStock) {
                $(this).val(maxStock);
                alert('Kuantitas tidak dapat melebihi stok yang tersedia: ' + maxStock);
            }
        });
    });
</script>