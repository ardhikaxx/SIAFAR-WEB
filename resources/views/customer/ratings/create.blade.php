@extends('layouts.app')

@section('content-customer')

<div
    class="container p-4 min-w-full min-h-screen flex flex-col justify-center items-center bg-neutral-100 text-neutral-950">
    <h1 class="text-3xl font-bold m-4">Penilaian dan Feedback</h1>
    @error('rating')
        <div class="alert alert-error text-neutral-100 text-sm mt-4">
            {{ $errors->first('rating') }}
        </div>
    @enderror
    <div class="card-body w-full">
        <div class=" w-full mt-4">
            <form class="flex flex-col gap-3" action="{{ route('customer.ratings.store', $transactionOut->id) }}"
                method="POST">
                @csrf
                <input type="hidden" name="transaction_out_id" value="{{ $transactionOut->id }}">

                <div class="flex gap-3 ">
                    <div class="flex gap-3 flex-col">
                        <h3 class="font-bold">Rating Kami</h3>
                        <label for="apotek_rating_5" class="flex gap-3">
                            <input id="apotek_rating_5" class="radio" type="radio" name="rating" value="5">
                            <h1>⭐</h1>
                            <h1>⭐</h1>
                            <h1>⭐</h1>
                            <h1>⭐</h1>
                            <h1>⭐</h1>
                        </label>
                        <label for="apotek_rating_4" class="flex gap-3">
                            <input id="apotek_rating_4" class="radio" type="radio" name="rating" value="4">
                            <h1>⭐</h1>
                            <h1>⭐</h1>
                            <h1>⭐</h1>
                            <h1>⭐</h1>
                        </label>
                        <label for="apotek_rating_3" class="flex gap-3">
                            <input id="apotek_rating_3" class="radio" type="radio" name="rating" value="3">
                            <h1>⭐</h1>
                            <h1>⭐</h1>
                            <h1>⭐</h1>
                        </label>
                        <label for="apotek_rating_2" class="flex gap-3">
                            <input id="apotek_rating_2" class="radio" type="radio" name="rating" value="2">
                            <h1>⭐</h1>
                            <h1>⭐</h1>
                        </label>
                        <label for="apotek_rating_1" class="flex gap-3">
                            <input id="apotek_rating_1" class="radio" type="radio" name="rating" value="1">
                            <h1>⭐</h1>
                        </label>
                    </div>

                    <label for="comment" class="font-bold">Feedback</label>
                    <textarea class="input input-bordered w-full h-80" name="comment" id="comment"
                        placeholder="Feedback (opsional)"></textarea>

                </div>

                <button type="submit" class="btn btn-neutral">Kirim</button>
            </form>
        </div>
    </div>

</div>
@endsection