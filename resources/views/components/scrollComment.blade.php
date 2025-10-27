<div class="w-full flex justify-center flex-col">
    <h1 class="font-bold text-center p-4 text-4xl">Feedback & Rating</h1>
    <div class="carousel rounded-box  m-12">
        @foreach ($ratings as $rating)
            <div class="carousel-item w-full lg:w-2/6">
                <div class="card w-96 bg-base-100 ">
                    <div class="card-body">
                        <div class="flex justify-between items-center gap-3">
                            <div class="avatar flex gap-3">
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
                            <div class="flex flex-col gap-2 justify-end items-end">
                                <div>
                                    <p>{{ $rating->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="flex gap-1">

                                    @for ($i = 0; $i < $rating->rating; $i++)
                                        <p>⭐</p>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p>{{ $rating->comment }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>