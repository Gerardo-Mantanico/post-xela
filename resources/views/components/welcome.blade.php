<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto p-6 lg:p-8 mt-8 bg-white border border-gray-200 rounded-xl">
        <section>
            <div class="text-center">
                <p class="text-2xl font-bold mb-4">🎓 ¡Celebremos el Éxito! 🎓</p>
            </div>

            <!-- Slider de imágenes -->
            <div class="swiper mySwiper mb-6">
                <div class="swiper-wrapper">
                    <!-- Imagen 1 -->
                    <div class="swiper-slide">
                        <img src="https://ideogram.ai/assets/progressive-image/balanced/response/-75riiYKQKOBpyEA_-Mz0A"
                            class="w-full h-[500px] object-cover rounded-lg" alt="Slide 1">
                    </div>
                    <!-- Imagen 2 -->
                    <div class="swiper-slide">
                        <img src="https://ideogram.ai/assets/progressive-image/balanced/response/QAfyPZABRAKSpvuXh6hItg"
                            class="w-full h-[500px] object-cover rounded-lg" alt="Slide 2">
                    </div>
                    <!-- Imagen 3 -->
                    <div class="swiper-slide">
                        <img src="https://ideogram.ai/assets/progressive-image/balanced/response/aDXpryUpTGqctL9NXTA0yA"
                            class="w-full h-[500px] object-cover rounded-lg" alt="Slide 3">
                    </div>
                </div>
                <!-- Agregar botones de navegación -->
                <div class="swiper-button-next text-white"></div>
                <div class="swiper-button-prev text-white"></div>
                <!-- Paginación -->
                <div class="swiper-pagination"></div>
            </div>

            <!-- Datos de la publicación -->
            <div class="mt-6 pb-6">
                <p class="text-lg">Celebración para los graduados de la promoción 2023. La ceremonia incluirá discursos de autoridades académicas, entrega de diplomas y un momento especial para los graduados.</p>
                <p class="mt-4">📬 <strong>Dirección:</strong> Calle 14-25, Zona 3, Quetzaltenango</p>
                <p>📅 <strong>Fecha:</strong> 2024-11-07 🕓 <strong>Hora:</strong> 15:00 hrs</p>
                <p><strong>Límite de personas:</strong> 105</p>
                <p><strong>Personas confirmadas:</strong> 23</p>
                <p class="mt-4 text-lg">🎓 ¡Celebremos el Éxito! 🎓</p>
            </div>

            <!-- Botones de acción -->
            <div class="flex justify-end   gap-4 mt-6">
                <button class="bg-white  border-black  border-2  text-black py-2 px-4  rounded hover:bg-red-700 flex items-center justify-center gap-1">
                    <svg class="h-5 w-5" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <circle cx="12" cy="12" r="9" />
                        <line x1="5.7" y1="5.7" x2="18.3" y2="18.3" />
                    </svg>
                    Report
                </button>

                <button class="bg-black text-white py-2 px-4 rounded hover:bg-black-700 flex items-center justify-center gap-1">
                    <svg class="h-5 w-5 text-white-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 11 12 14 22 4" />
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                    </svg>
                    Participate
                </button>
            </div>
        </section>
    </div>

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
        /* Asegurando que las flechas sean visibles sobre el fondo */
        .swiper-button-next,
        .swiper-button-prev {
            color: white;
            /* Color de las flechas */
        }
    </style>
</body>