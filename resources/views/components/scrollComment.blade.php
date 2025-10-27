<section class="px-6 lg:px-12 w-full py-20 flex flex-col items-center bg-gradient-to-br from-pink-50 to-gray-50">
    <h1 class="font-extrabold text-4xl text-gray-900 text-center mb-10">Feedback & Rating</h1>

    @if ($ratings->isEmpty())
        {{-- Jika belum ada rating --}}
        <div class="flex flex-col justify-center items-center text-center py-16 text-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="w-20 h-20 text-gray-400 mb-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 20.25c4.97 0 9-4.03 9-9s-4.03-9-9-9-9 4.03-9 9 4.03 9 9 9zm0 0v-3m0 0a3 3 0 003-3h-6a3 3 0 003 3z" />
            </svg>
            <h2 class="text-2xl font-semibold text-gray-800">Belum Ada Ulasan</h2>
            <p class="text-gray-500 mt-2 text-lg">Belum ada pengguna yang memberikan rating atau komentar.</p>
        </div>
    @else
        {{-- Carousel feedback --}}
        <div class="flex gap-6 p-4 w-full overflow-x-auto scrollbar-hide">
            @foreach ($ratings as $rating)
                <div
                    class="flex-shrink-0 bg-white rounded-2xl shadow-md hover:shadow-xl border border-gray-100 w-80 transition-transform transform hover:-translate-y-2">
                    <div class="p-5 space-y-3">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full overflow-hidden border border-gray-200">
                                    @if ($rating->user->image)
                                        <img src="{{ asset('storage/' . $rating->user->image) }}"
                                            alt="{{ $rating->user->name }}" class="object-cover w-full h-full" />
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 24 24" class="w-10 h-10 text-gray-400">
                                            <path fill-rule="evenodd"
                                                d="M18.685 19.097A9.723 9.723 0 0021.75 12a9.75 9.75 0 10-19.5 0 9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653ZM12 15a7.486 7.486 0 00-5.855 2.812A8.224 8.224 0 0012 20.25a8.224 8.224 0 005.855-2.438A7.486 7.486 0 0012 15Zm3.75-6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <h2 class="text-lg font-bold text-gray-900">{{ $rating->user->name }}</h2>
                                    <p class="text-sm text-gray-500">{{ $rating->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="flex gap-1">
                                @for ($i = 0; $i < $rating->rating; $i++)
                                    <span class="text-yellow-400 text-lg">★</span>
                                @endfor
                            </div>
                        </div>

                        <p class="text-gray-700 leading-relaxed">
                            {{ $rating->comment }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section>
