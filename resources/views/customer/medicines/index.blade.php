@extends('layouts.app')

@section('content-customer')
<div class="min-h-screen bg-gradient-to-br from-red-50 to-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 mb-4">Daftar Obat</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Temukan obat yang Anda butuhkan dengan mudah. Berbagai pilihan obat tersedia untuk kesehatan Anda.
            </p>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 mb-8">
            <form action="{{ route('customer.medicines.index') }}" method="GET" 
                  class="flex flex-col lg:flex-row gap-4 items-center justify-center">
                <!-- Search Input -->
                <div class="relative flex-1 max-w-md">
                    <input type="search" name="search" value="{{ $search }}" placeholder="Cari obat..."
                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300 placeholder-gray-400">
                    <svg class="absolute right-3 top-3 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <!-- Category Select -->
                <select name="category" id="category" 
                        class="px-4 py-3 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300 w-full lg:w-44">
                    <option disabled selected>--Kategori--</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}" {{ $category->name == request('category') ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Unit Select -->
                <select name="unit" id="unit" 
                        class="px-4 py-3 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300 w-full lg:w-44">
                    <option disabled selected>--Satuan--</option>
                    @foreach ($units as $unit)
                        <option value="{{ $unit->name }}" {{ $unit->name == request('unit') ? 'selected' : '' }}>
                            {{ $unit->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Search Button -->
                <button type="submit" 
                        class="px-8 py-3 text-white font-semibold bg-gradient-to-r from-red-600 to-pink-600 rounded-xl shadow-md hover:shadow-lg hover:from-red-700 hover:to-pink-700 transform hover:-translate-y-1 transition-all duration-300 w-full lg:w-auto">
                    Cari
                </button>
            </form>
        </div>

        <!-- Medicines Grid -->
        <div class="flex flex-row flex-wrap justify-center gap-6 mb-8">
            @foreach ($medicines as $medicine)
                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 flex-shrink-0 transform hover:-translate-y-2 transition-transform duration-300">
                    <x-cards_medicines 
                        :image="asset('storage/' . $medicine->photo)" 
                        :name="$medicine->name"
                        :price="$medicine->price" 
                        :medicine="$medicine" 
                        :category="$medicine->category->name"
                        :unit="$medicine->unit->name" 
                    />
                </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if($medicines->isEmpty())
        <div class="text-center py-12">
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-8 max-w-md mx-auto">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Obat tidak ditemukan</h3>
                <p class="text-gray-600 mb-4">Coba ubah kata kunci pencarian atau filter yang Anda gunakan.</p>
                <a href="{{ route('customer.medicines.index') }}" 
                   class="inline-flex items-center px-6 py-3 text-white font-semibold bg-gradient-to-r from-red-600 to-pink-600 rounded-xl hover:from-red-700 hover:to-pink-700 transition-all duration-300">
                    Tampilkan Semua Obat
                </a>
            </div>
        </div>
        @endif

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                {{ $medicines->links() }}
            </div>
        </div>
    </div>
</div>
@endsection