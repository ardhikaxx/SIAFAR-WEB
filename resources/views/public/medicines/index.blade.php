@extends('layouts.app')

@section('content-customer')
<div class="container mx-auto p-4 w-full flex flex-col justify-center items-center bg-neutral-100 text-neutral-950">
    <h1 class="text-3xl font-bold mb-4">Daftar Obat</h1>

    <form action="{{ route('public.medicines.index') }}" method="GET"
        class="mb-4 flex flex-row justify-center gap-4 w-full">
        <input type="search" name="search" value="{{ $search }}" placeholder="Cari obat..."
            class="input input-bordered w-full max-w-xs bg-neutral-100 outline outline-1 outline-neutral-950">

        <select name="category" id="category" class="select w-44 bg-neutral-100 outline outline-1 outline-neutral-950">
            <option disabled selected>--Kategori--</option>
            @foreach ($categories as $category)
                <option value="{{ $category->name }}" {{ $category == request('category') ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <select name="unit" id="unit" class="select w-44 bg-neutral-100 outline outline-1 outline-neutral-950">
            <option disabled selected>--Satuan--</option>
            @foreach ($units as $unit)
                <option value="{{ $unit->name }}" {{ $unit == request('unit') ? 'selected' : '' }}>
                    {{ $unit->name }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-neutral text-neutral-200">Cari</button>

    </form>

    <div class="flex flex-row flex-wrap w-full justify-center items-center gap-6">
        @foreach ($medicines as $medicine)
            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 flex-shrink-0">
                <x-cards_medicines :image="asset('storage/' . $medicine->photo)" :name="$medicine->name"
                    :price="$medicine->price" :medicine="$medicine" :category="$medicine->category->name"
                    :unit="$medicine->unit->name" />
            </div>
        @endforeach
    </div>


    <div class="mt-8 flex justify-center">
        {{ $medicines->links() }}
    </div>
</div>
@endsection