@props(['image', 'name', 'price', 'medicine'])

<div class="card card-compact bg-neutral-100 outline-dashed w-64 shadow-lg text-neutral-950">
    <figure>
        <img src="{{ $image }}" alt="{{ $name }}" class="w-full h-48 object-cover" />
    </figure>
    <div class="card-body">
        <h2 class="card-title text-lg font-bold">{{ $name }}</h2>
        @php
            $medicine = App\Models\Medicine::where('id', $medicine->id)->first();
            $discount = App\Models\Discount::where('medicine_id', $medicine->id)->where('is_active', 1)->first();
        @endphp
        @if ($discount && $discount->medicine_id == $medicine->id)
            <div class="flex pr-12">
                <p class="text-lg font-semibold text-red-500 line-through">Rp
                    {{ number_format($medicine->price, 0, ',', '.') }}
                </p>

                <p class="text-lg font-semibold text-green-600">Rp.
                    {{ number_format($medicine->price - ($medicine->price * ($discount->discount_amount / 100)), 0, ',', '.') }}
                </p>
            </div>
        @else
            <p class="text-lg font-semibold">Rp {{ number_format($price, 0, ',', '.') }}</p>
        @endif
        <div class="card-actions justify-end">
            <div class="outline outline-1 outline-neutral-950 rounded-badge px-1">{{ $medicine->category->name }}</div>
            <div class="badge badge-outline">{{ $medicine->unit->name }}</div>
        </div>
        <div class="card-actions justify-end">
            <a href="{{ Auth::check() ? route('customer.medicines.show', $medicine->id) : route('public.medicines.show', $medicine->id) }}"
                class="btn btn-neutral btn-sm text-neutral-200">
                View Detail
            </a>
        </div>
    </div>
</div>