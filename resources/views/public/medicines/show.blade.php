@extends('layouts.app')

@section('content-customer')
<div class="min-h-screen bg-gradient-to-br from-red-50 to-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header and Back Button -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <h1 class="text-4xl font-extrabold text-gray-900">Detail Obat</h1>
            <a href="{{ route('public.medicines.index') }}" 
               class="inline-flex items-center px-6 py-3 text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 hover:border-red-300 hover:text-red-600 transition-all duration-300 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Daftar Obat
            </a>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left Column - Medicine Card -->
            <div class="lg:w-3/3">
                <x-card-view-medicine 
                    :image="asset('storage/' . $medicine->photo)" 
                    :name="$medicine->name"
                    :description="$medicine->description" 
                    :price="$medicine->price" 
                    :medicine="$medicine"
                    :unit="$medicine->unit->name" 
                    :discount="$discount" 
                    :category="$medicine->category->name"
                    :stock="$medicine->stock" 
                />
            </div>

            <!-- Right Column - Tabs Content -->
            <div class="lg:w-2/5">
                <!-- Tabs Navigation -->
                <div class="flex border-b border-gray-200 mb-6">
                    <button role="tab" id="deskripsi" 
                            class="tab-button active px-6 py-3 font-semibold border-b-2 border-red-600 text-red-600 transition-all duration-300">
                        Deskripsi
                    </button>
                    <button role="tab" id="review" 
                            class="tab-button px-6 py-3 font-semibold text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300 transition-all duration-300">
                        Review
                    </button>
                </div>

                <!-- Tab Content -->
                <div id="deskripsiDetail" class="tab-content active">
                    <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Deskripsi Obat</h2>
                        <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                            <p class="whitespace-pre-line">{{ $medicine->description }}</p>
                        </div>
                    </div>
                </div>

                <div id="reviewDetail" class="tab-content hidden">
                    <!-- Average Rating -->
                    <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 mb-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Rata-rata Penilaian</h2>
                        <div class="flex flex-col lg:flex-row gap-6">
                            <!-- Rating Distribution -->
                            <div class="flex-1">
                                @for ($i = 5; $i >= 1; $i--)
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="flex items-center gap-1 w-20">
                                            @for ($j = 0; $j < $i; $j++)
                                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            @endfor
                                        </div>
                                        <div class="flex-1 bg-gray-200 rounded-full h-2">
                                            <div class="bg-red-600 h-2 rounded-full" 
                                                 style="width: {{ $ratings->where('rating', $i)->count() / max($ratings->count(), 1) * 100 }}%">
                                            </div>
                                        </div>
                                        <span class="text-sm text-gray-600 w-8">
                                            x{{ $ratings->where('rating', $i)->count() }}
                                        </span>
                                    </div>
                                @endfor
                            </div>
                            
                            <!-- Rating Labels -->
                            <div class="flex flex-col justify-center gap-1">
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 bg-red-600 rounded-full"></div>
                                    <span class="text-sm text-gray-600">Sangat Baik</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                    <span class="text-sm text-gray-600">Baik</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                    <span class="text-sm text-gray-600">Cukup</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
                                    <span class="text-sm text-gray-600">Kurang</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 bg-gray-400 rounded-full"></div>
                                    <span class="text-sm text-gray-600">Sangat Kurang</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reviews List -->
                    <div class="space-y-4">
                        @forelse ($ratings as $rating)
                            <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="w-10 h-10 rounded-full border-2 border-red-100">
                                                @if ($rating->user->image)
                                                    <img src="{{ asset('storage/' . $rating->user->image) }}"
                                                         alt="{{ $rating->user->name }}" 
                                                         class="w-full h-full object-cover rounded-full" />
                                                @else
                                                    <div class="w-full h-full bg-gradient-to-br from-red-100 to-pink-100 rounded-full flex items-center justify-center">
                                                        <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-900">{{ $rating->user->name }}</h3>
                                            <div class="flex items-center gap-1">
                                                @for ($i = 0; $i < $rating->rating; $i++)
                                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-sm text-gray-500">{{ $rating->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-600 leading-relaxed">{{ $rating->comment }}</p>
                            </div>
                        @empty
                            <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-8 text-center">
                                <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada review</h3>
                                <p class="text-gray-600">Jadilah yang pertama memberikan review untuk obat ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.tab-button {
    position: relative;
    transition: all 0.3s ease;
}

.tab-button.active {
    color: #dc2626;
    border-bottom-color: #dc2626;
}

.tab-button:hover:not(.active) {
    color: #374151;
    border-bottom-color: #d1d5db;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
    animation: fadeIn 0.3s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<script>
window.addEventListener('DOMContentLoaded', function () {
    const deskripsiTab = document.getElementById('deskripsi');
    const reviewTab = document.getElementById('review');
    const deskripsiDetail = document.getElementById('deskripsiDetail');
    const reviewDetail = document.getElementById('reviewDetail');

    function switchTab(activeTab, activeContent) {
        // Remove active state from all tabs
        [deskripsiTab, reviewTab].forEach(tab => tab.classList.remove('active'));
        [deskripsiDetail, reviewDetail].forEach(content => {
            content.classList.remove('active');
            content.classList.add('hidden');
        });

        // Add active state to selected tab and content
        activeTab.classList.add('active');
        activeContent.classList.add('active');
        activeContent.classList.remove('hidden');
    }

    deskripsiTab.addEventListener('click', function () {
        switchTab(deskripsiTab, deskripsiDetail);
    });

    reviewTab.addEventListener('click', function () {
        switchTab(reviewTab, reviewDetail);
    });
});
</script>
@endsection