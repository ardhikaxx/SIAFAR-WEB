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

<div class="card bg-neutral-100 outline-dashed w-full h-full shadow-lg flex flex-row justify-between">
    <figure class="w-1/2">
        <img class="w-full h-96 rounded-2xl object-cover" src="{{ $image }}" alt="{{ $name }}" />
    </figure>
    <div class="card-body flex justify-between">
        <h2 class="card-title text-3xl font-bold">
            {{ $name }}
        </h2>
        @if ($discount && $discount->medicine_id == $medicine->id && $discount->is_active == 1)

            <div class="flex gap-2">
                <h2 class="text-xl font-semibold text-red-500 line-through">Rp
                    {{ number_format($medicine->price, 0, ',', '.') }}
                </h2>

                <h2 class="text-xl font-semibold text-green-600">Rp.
                    {{ number_format($medicine->price - ($medicine->price * ($discount->discount_amount / 100)), 0, ',', '.') }}
                </h2>
            </div>
        @else
            <h2 class="text-xl font-semibold">Rp {{ number_format($price, 0, ',', '.') }}</h2>
        @endif



        <div class="flex items-center gap-3">
            <h1 class="font-bold">Stok</h1>
            <div class="badge badge-accent font-bold">{{ $stock }}</div>
        </div>
        <div class="card-actions justify-end">
            <div class="badge badge-outline font-bold">{{ $category }}</div>
            <div class="badge badge-outline font-bold">{{ $unit }}</div>
        </div>
        <form action="{{ route('customer.carts.store') }}" method="POST" class="flex flex-row gap-2">
            @csrf


            @if ($medicine->stock > 0)
                <input type="hidden" name="medicine_id" value="{{ $medicine->id }}">
                <button type="button" id="decrement" class="btn btn-neutral btn-sm">-</button>
                <input type="number" id="qty" name="quantity" value="1" min="1"
                    class="input input-bordered input-sm w-20 text-center bg-neutral-200">
                <button type="button" id="increment" class="btn btn-sm btn-neutral">+</button>
                <div>
                    <button type="submit" class="btn btn-warning btn-sm">Add to Cart +</button>
                </div>
            @else
                <input type="hidden" name="medicine_id" value="{{ $medicine->id }}">

                <input disabled type="number" name="quantity" value="1" min="1" class="input input-bordered input-sm">
                <div>
                    <button disabled type="submit" class="btn btn-warning btn-sm">Add to Cart +</button>
                </div>
            @endif
        </form>
    </div>
</div>


<script>
    $(document).ready(function () {

        const decrement = $("#decrement")
        const increment = $("#increment")
        const qty = $("#qty")

        decrement.on("click", () => {
            currentQty = parseInt(qty.val())//ambil value qty sekarang

            if (currentQty > 1) {
                qty.val(currentQty - 1)
            }
        })


        increment.on("click", () => {
            currentQty = parseInt(qty.val())

            qty.val(currentQty + 1)
        })



    })
</script>