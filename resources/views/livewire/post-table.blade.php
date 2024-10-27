<div>
    @foreach($post as $item)
    <div class="max-w-2xl   mx-auto p-6 lg:p-8 mt-8 bg-white  border border-gray-200 rounded-xl">
        <section>
            <div class="text-center">
                <p class="text-2xl font-bold mb-4">{{$item->title}}</p>
            </div>

            <div>
                {!! $item->description !!}
            </div>
            <!-- Datos de la publicación -->
            <div class="mt-6 pb-6">
                <p class="mt-4">📬 <strong>Dirección:</strong> {{$item->address}}</p>
                <p class="text-sm">📅 <strong>Fecha de evento: </strong>{{$item->date_event}} 🕓 <strong>Hora:</strong> {{$item->time_event}} hrs</p>
                <p class="text-sm"><strong>Límite de personas:</strong> {{$item->capacity}}</p>
                <p class="text-sm"><strong>Personas confirmadas:</strong> {{$item->confirmed}}</p>
                <p class="text-sm text-gray-600"> <strong>Publicado por </strong>{{ $item->name }} (ID: {{ $item->id_user }})</p>
                <p class="text-sm text-gray-500"><strong>Fecha de publicacion:</strong> {{ $item->created_at->format('d/m/Y H:i') }}</p>
                <p class="text-sm"> <strong>Categoria: </strong> <span class="font-medium">{{ $item->category }}</span></p>
                <p class="text-sm"><strong>Estado: </strong> <span class="font-medium">{{ $item->state_publication }}</span></p>
            </div>

            <div class="flex justify-end gap-4">
                <x-button wire:click="changeState({{ $item->id }}, 'ACTIVATED')">
                    {{ __('Accpet') }}
                </x-button>
                <x-button-cancel wire:click="changeState({{ $item->id }}, 'REFUSED')">
                    {{ __('reject') }}
                </x-button-cancel>
            </div>

        </section>
    </div>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 2,
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
    <script>
        document.getElementById('reportButton').addEventListener('click', function() {
            var userInput = prompt("Por favor ingresa el motivo del reporte:");
            if (userInput !== null && userInput.trim() !== "") {
                document.getElementById('cause').value = userInput;
                document.getElementById('reportForm').submit();
                alert('bien');
            } else {
                return;
            }
        });
    </script>
    <style>
        .swiper-button-next,
        .swiper-button-prev {
            color: white;
        }

        .swiper-slide {
            width: 200px;
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    @endforeach
</div>