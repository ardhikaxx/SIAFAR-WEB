@extends('layouts.app')

@section('content-customer')
<div class="container mx-auto p-12 w-full flex flex-col justify-center items-center bg-neutral-100 text-neutral-950">
    <h1 class="text-4xl font-bold mb-4">Detail Obat</h1>
    <div class="w-full flex justify-start">
        <a href="{{ route('customer.medicines.index') }}" class="btn btn-neutral btn-sm mb-4">
            Kembali</a>
    </div>
    <div class="flex flex-col gap-4">
        <x-card-view-medicine :image="asset('storage/' . $medicine->photo)" :name="$medicine->name"
            :description="$medicine->description" :price="$medicine->price" :medicine="$medicine"
            :unit="$medicine->unit->name" :discount="$discount" :category="$medicine->category->name"
            :stock="$medicine->stock" />

        <div role="tablist" class="tabs tabs-lifted">
            <a role="tab" id="deskripsi" class="tab tab-active">Deskripsi</a>
            <a role="tab" id="review" class="tab ">Review</a>
        </div>
    </div>
    <div id="deskripsiDetail" class="w-9/12 p-4 rounded-xl  bg-base-100 text-wrap text-justify">
        <p>{{ $medicine->description }}</p>
    </div>
    <div id="reviewDetail" class="hidden w-9/12 p-4 rounded-xl bg-base-100 text-wrap text-justify">
        <h1 class="font-bold">Rata-rata Penliaian</h1>
        <div class="flex gap-3 pb-3 justify-between">
            <div class="flex">
                <div class="stars">
                    <p>⭐ ⭐ ⭐ ⭐ ⭐ </p>
                    <p>⭐ ⭐ ⭐ ⭐</p>
                    <p>⭐ ⭐ ⭐ </p>
                    <p>⭐ ⭐ </p>
                    <p>⭐ </p>
                </div>
                <div class="rate">
                    <p>Sangat Baik</p>
                    <p>Baik</p>
                    <p>Cukup</p>
                    <p>Kurang</p>
                    <p>Sangat Kurang</p>
                </div>
            </div>
            <div class="rate-count">
                @for ($i = 0; $i < 5; $i++)
                    <p>x {{ $ratings->where('rating', $i + 1)->count() }}</p>
                @endfor
            </div>
        </div>
        <div class="comment">
            <form action="{{ route('customer.med-rates.storeRating', $medicine->id) }}" method="POST"
                class="flex flex-col gap-3">
                @csrf
                <input type="hidden" name="medicine_id" value="{{ $medicine->id }}">
                <div class="flex gap-3 flex-col">
                    <h3 class="font-bold">Rating Obat</h3>
                    <label for="apotek_rating_5" class="flex gap-2">
                        <input id="apotek_rating_5" class="radio" type="radio" name="rating" value="5">
                        <h1>⭐</h1>
                        <h1>⭐</h1>
                        <h1>⭐</h1>
                        <h1>⭐</h1>
                        <h1>⭐</h1>
                        <div>
                            <p>Sangat Baik</p>
                        </div>
                    </label>
                    <label for="apotek_rating_4" class="flex gap-2">
                        <input id="apotek_rating_4" class="radio" type="radio" name="rating" value="4">
                        <h1>⭐</h1>
                        <h1>⭐</h1>
                        <h1>⭐</h1>
                        <h1>⭐</h1>
                        <div>
                            <p>Baik</p>
                        </div>
                    </label>
                    <label for="apotek_rating_3" class="flex gap-2">
                        <input id="apotek_rating_3" class="radio" type="radio" name="rating" value="3">
                        <h1>⭐</h1>
                        <h1>⭐</h1>
                        <h1>⭐</h1>
                        <div>
                            <p>Cukup</p>
                        </div>
                    </label>
                    <label for="apotek_rating_2" class="flex gap-2">
                        <input id="apotek_rating_2" class="radio" type="radio" name="rating" value="2">
                        <h1>⭐</h1>
                        <h1>⭐</h1>
                        <div>
                            <p>Kurang</p>
                        </div>
                    </label>
                    <label for="apotek_rating_1" class="flex  gap-3">
                        <input id="apotek_rating_1" class="radio" type="radio" name="rating" value="1">
                        <h1>⭐</h1>
                        <div>
                            <p>Sangat Kurang</p>
                        </div>
                    </label>
                </div>
                <label for="comment" class="font-bold">Komentar</label>
                <textarea placeholder="Masukkan Komentar" class="textarea textarea-bordered" name="comment" id="comment"
                    cols="30" rows="10"></textarea>
                <button type="submit" class="btn btn-neutral">Kirim</button>
            </form>
            @foreach ($ratings as $rating)
                <div class="card-body w-full">
                    <div class="flex justify-between items-center gap-3">
                        <div class="flex items-center gap-3">
                            <div class="avatar flex gap-2">
                                <div class="w-8 rounded-full">
                                    @if ($rating->user->image)
                                        <img src="{{ asset('storage/' . $rating->user->image) }}"
                                            alt="{{ $rating->user->name }}" />
                                    @else
                                        <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" class="size-6">
                                            <path fill-rule="evenodd"
                                                d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </div>
                                <h2 class="card-title">{{ $rating->user->name }}</h2>
                            </div>
                            <div class="flex gap-1">
                                @for ($i = 0; $i < $rating->rating; $i++)
                                    <p>⭐</p>
                                @endfor
                            </div>
                        </div>
                        <div>
                            <p>{{ $rating->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <p>{{ $rating->comment }}</p>
                </div>
            @endforeach
        </div>
    </div>

</div>
<script>
    window.addEventListener('DOMContentLoaded', function () {
        const deskripsiTab = document.getElementById('deskripsi')
        const reviewTab = document.getElementById('review')


        deskripsiTab.addEventListener('click', function () {
            deskripsiTab.classList.add('tab-active')
            reviewTab.classList.remove('tab-active')
            const deskripsiDetail = document.getElementById('deskripsiDetail')
            deskripsiDetail.classList.remove('hidden')
            const reviewDetail = document.getElementById('reviewDetail')
            reviewDetail.classList.add('hidden')

        })

        reviewTab.addEventListener('click', function () {
            deskripsiTab.classList.remove('tab-active')
            reviewTab.classList.add('tab-active')
            const deskripsiDetail = document.getElementById('deskripsiDetail')
            deskripsiDetail.classList.add('hidden')
            const reviewDetail = document.getElementById('reviewDetail')
            reviewDetail.classList.remove('hidden')
        })
    })
</script>
@endsection