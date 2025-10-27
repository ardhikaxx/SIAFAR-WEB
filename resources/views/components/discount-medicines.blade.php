<section class="p-12 flex gap-3 overflow-x-hidden flex-col lg:flex-row">
    <div class="flex flex-col gap-5 justify-between w-full lg:w-1/4">
        <h1 class="text-5xl font-bold">Promo Diskon!</h1>
        <p class="text-xl text-wrap">Beberapa list obat yang sedang promo!</p>
        <div>
            <a href="{{Auth::check() ? route('customer.medicines.index') : route('public.medicines.index') }}"
                class="btn outline outline-1 outline-neutral-950">Lihat Selengkapnya</a>
        </div>
    </div>
    <div class="flex gap-3 p-5 w-full lg:w-3/4 overflow-x-scroll">
        @foreach ($medicines as $medicine)
            @foreach ($discounts as $discount)
                @if ($discount->medicine_id == $medicine->id)

                    <div
                        class="flex-grow-0 flex-shrink-0 card card-compact bg-neutral-100 outline-dashed w-64 shadow-lg text-neutral-950">
                        <figure>
                            <img src="{{ asset('storage/' . $medicine->photo) }}" alt="{{ $medicine->name }}"
                                class="w-full h-48 object-cover" />
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title text-lg font-bold">{{ $medicine->name }}</h2>
                            <div class="flex pr-12">
                                <p class="text-lg font-semibold text-red-500 line-through">Rp
                                    {{ number_format($medicine->price, 0, ',', '.') }}
                                </p>

                                <p class="text-lg font-semibold text-green-600">Rp.
                                    {{ number_format($medicine->price - ($medicine->price * ($discount->discount_amount / 100)), 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="card-actions justify-end">
                                <div class="outline outline-1 outline-neutral-950 rounded-badge px-1">
                                    {{ $medicine->category->name }}</div>
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
                @endif
            @endforeach
        @endforeach
    </div>
</section>