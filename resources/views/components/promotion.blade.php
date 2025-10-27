<div class="carousel w-full">
    @foreach ($promoCodes as $index => $promoCode)
        <div id="slide{{ $index + 1 }}"
            class="carousel-item w-full relative flex flex-col items-center bg-gradient-to-r from-purple-500 to-indigo-500 text-white ">
            <div class="p-8">
                <h1 class="text-3xl font-bold mb-4">Promo Kilat!</h1>
                <p class="text-lg">
                    🎉 Diskon Spesial untuk Anda! Gunakan kode <b>{{ $promoCode->promo_code }}</b> di aplikasi kami
                    dan nikmati diskon <b>{{ $promoCode->discount_amount }}%</b>!
                    Berlaku hingga <b>{{ \Carbon\Carbon::parse($promoCode->end_date)->format('d M Y') }}</b>.
                </p>
                <button class="btn btn-primary mt-4" onclick="copyToClipboard('{{ $promoCode->promo_code }}')">Salin Kode
                    Promo</button>

            </div>
            <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                <a href="#slide{{ $index == 0 ? count($promoCodes) : $index }}" class="btn btn-circle">❮</a>
                <a href="#slide{{ $index + 2 > count($promoCodes) ? 1 : $index + 2 }}" class="btn btn-circle">❯</a>
            </div>
        </div>
    @endforeach
    <dialog id="my_modal_2" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Salin Kode Promo</h3>
            <p class="py-4" id="content-modal"></p>
            <div class="modal-action">
                <form method="dialog">
                    <!-- if there is a button in form, it will close the modal -->
                    <button class="btn btn-sm btn-neutral">Close</button>
                </form>
            </div>
        </div>
    </dialog>
</div>
<script>
    function copyToClipboard(code) {
        navigator.clipboard.writeText(code).then(() => {
            const contentModal = document.getElementById('content-modal');
            contentModal.textContent = `Kode Promo ${code} berhasil disalin!`;
            const my_modal_2 = document.getElementById('my_modal_2');
            my_modal_2.showModal();

        }).catch(() => {
            alert('Gagal menyalin kode promo.');
        });
    }
</script>