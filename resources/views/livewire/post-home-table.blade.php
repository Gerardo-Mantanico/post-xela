<div>
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-4 py-12">
        <div class="text-center pb-12">
            <h3 class="font-bold text-2xl md:text-4xl lg:text-5xl font-heading text-gray-900">
                ¡Descubre y comparte los mejores eventos en Xela! Publica el tuyo y no te pierdas la diversión.
            </h3>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-6">
            @foreach($post as $item)
            <div class="w-full bg-white rounded-lg shadow-lg overflow-hidden flex flex-col justify-center items-center">
                <div class="text-center py-8 sm:py-6">
                    <p class="text-xl text-gray-700 font-bold mb-2">{{$item->title}}</p>

                </div>
                <div>
                    {!! $item->description !!}
                </div>

            </div>
            @endforeach
        </div>
    </section>
    {{ $post->links() }} <!-- Paginación -->
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>

    <style>
        .swiper-button-next,
        .swiper-button-prev {
            color: white;
        }

        .swiper {
            width: 500px;
        }

        p {
            margin: 20px;
        }
    </style>
</div>