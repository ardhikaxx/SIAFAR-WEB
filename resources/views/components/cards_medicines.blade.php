@props(['image', 'name', 'price', 'medicine', 'category', 'unit'])

@php
    $medicineModel = App\Models\Medicine::where('id', $medicine->id)->first();
    $discount = App\Models\Discount::where('medicine_id', $medicineModel->id)->where('is_active', 1)->first();
@endphp

<div
    class="flex-shrink-0 bg-white rounded-2xl shadow-md hover:shadow-xl border border-gray-100 w-64 transition-transform transform hover:-translate-y-2">
    <figure class="relative">
        <img src="{{ asset('storage/' . $medicine->photo) }}" alt="{{ $medicine->name }}"
            class="w-full h-48 object-cover rounded-t-2xl">
        @if ($medicine->is_discount)
            <span
                class="absolute top-3 left-3 bg-gradient-to-r from-red-600 to-pink-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
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
