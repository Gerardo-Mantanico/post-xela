<div class=" p-6">
    <h2 class="text-lg font-bold mb-4 text-center">Report Post</h2>
    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
    <div class="bg-green-500 text-white p-2 rounded">
        {{ session('message') }}
    </div>
    @endif


    <!-- Modal para agregar categoría -->
    @if ($isOpen)
    <div class="fixed inset-0 flex items-center justify-center z-50 mt-6 sm:rounded-lg ">
        <div class="bg-white p-6 rounded shadow-lg">
            <p class="mt-4 text-center">{{$repo->title}}</p>

            <div>
                {!! $repo->description !!}
            </div>

            <div class="mt-6 pb-6">
                <p class="mt-4">📬 <strong>Dirección:</strong> {{$repo->address}}</p>
                <p class="text-sm">📅 <strong>Fecha de evento: </strong>{{$repo->date_event}} 🕓 <strong>Hora:</strong> {{$repo->time_event}} hrs</p>
                <p class="text-sm"><strong>Límite de personas:</strong> {{$repo->capacity}}</p>
                <p class="text-sm"><strong>Personas confirmadas:</strong> {{$repo->confirmed}}</p>
                <p class="text-sm text-gray-600"> <strong>Publicado por </strong>{{ $repo->name }} (ID: {{ $repo->id_user }})</p>
                <p class="text-sm text-gray-500"><strong>Fecha de publicacion:</strong> {{ $repo->created_at->format('d/m/Y H:i') }}</p>
                <p class="text-sm"> <strong>Categoria: </strong> <span class="font-medium">{{ $repo->category }}</span></p>
                @foreach ($userReport as $user)
                <div class="mt-3">
                    <p class="text-sm text-blue-600"> <strong>Reportado por </strong>{{ $user->name}} (ID: {{ $user->id_user}})</p>
                    <p class="text-sm"><strong>Motivo :</strong> {{$user->cause}}</p>

                </div>
                @endforeach

            </div>
            <div class="mt-2">
                <x-button-edit wire:click="changeState({{ $repo->id }}, 'APPROVED')">
                    Approved
                </x-button-edit>
                <x-button-delete wire:click="changeState({{ $repo->id }}, 'REFUSED')">
                    Refused
                </x-button-delete>
                <x-button wire:click="closeModal">
                    Cancel
                </x-button>
            </div>
        </div>
    </div>
    @endif


    <table class="min-w-full border-collapse border border-gray-200 p-6">
        <thead>
            <tr>
                <th class="border border-gray-200 px-4 py-2">Title</th>
                <th class="border border-gray-200 px-4 py-2">Data</th>
                <th class="border border-gray-200 px-4 py-2">User who reported</th>
                <th class="border border-gray-200 px-4 py-2">Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($report as $item)
            <tr>

                <td class="border border-gray-200 px-4 py-2 text-center">
                    {{$item->title}}
                </td>
                <td class="border border-gray-200 px-4 py-2 ">
                    <div class="mt-6 pb-6">
                        <p class="mt-4">📬 <strong>Dirección:</strong> {{$item->address}}</p>
                        <p class="text-sm">📅 <strong>Fecha de evento: </strong>{{$item->date_event}} 🕓 <strong>Hora:</strong> {{$item->time_event}} hrs</p>
                        <p class="text-sm"><strong>Límite de personas:</strong> {{$item->capacity}}</p>
                        <p class="text-sm"><strong>Personas confirmadas:</strong> {{$item->confirmed}}</p>
                        <p class="text-sm text-gray-600"> <strong>Publicado por </strong>{{ $item->name }} (ID: {{ $item->id_user }})</p>
                        <p class="text-sm text-gray-500"><strong>Fecha de publicacion:</strong> {{ $item->created_at->format('d/m/Y H:i') }}</p>
                        <p class="text-sm"> <strong>Categoria: </strong> <span class="font-medium">{{ $item->category }}</span></p>
                    </div>
                </td>
                <td class="border border-gray-200 px-4 py-2 text-center">
                    <p class="text-sm text-gray-600"> <strong>Reportado por </strong>{{ $item->name_report }} (ID: {{ $item->id_user_report }})</p>
                </td>
                <td class="border border-gray-200 px-4 py-2 text-center">
                    <x-button wire:click="details({{ $item->id }})">
                        details
                    </x-button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $report->links() }} <!-- Paginación -->

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 'auto',
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
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</div>