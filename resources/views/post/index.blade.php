<x-app-layout>


    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- SweetAlert para mostrar alertas -->
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: "{{ session('success') }}",
            timer: 3000,
            showConfirmButton: false
        });
    </script>
    @endif

    @if (session('alert'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "{{ session('alert') }}",
            timer: 3000,
            showConfirmButton: false
        });
    </script>
    @endif
    <div class="py-12">


        <body class="bg-gray-100">
            @foreach($posts as $item)
            <div class="max-w-4xl mx-auto p-6 lg:p-8 mt-8 bg-white border border-gray-200 rounded-xl">
                <section>
                    <div class="text-center">
                        <p class="text-2xl font-bold mb-4">{{$item->title}}</p>
                    </div>
                    {!! $item->description !!}
                    <!-- Datos de la publicación -->
                    <div class="mt-6 pb-6">
                        <p class="mt-4">📬 <strong>Dirección:</strong> {{$item->address}}</p>
                        <p>📅 <strong>Fecha: </strong>{{$item->date_event}} 🕓 <strong>Hora:</strong> {{$item->time_event}} hrs</p>
                        <p><strong>Límite de personas:</strong> {{$item->capacity}}</p>
                        <p><strong>Personas confirmadas:</strong> {{$item->confirmed}}</p>
                    </div>
                    <form action="{{route('reportPost.store',$item->id)}}" method="POST">
                        @csrf
                        <input type="hidden" id="id_post" name="id_post" value="{{ $item->id }}">
                        <input type="hidden" id="cause" name="cause">
                        <div class="flex justify-end gap-4">
                            <x-button class="reportButton">
                                <svg class="h-5 w-5" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <circle cx="12" cy="12" r="9" />
                                    <line x1="5.7" y1="5.7" x2="18.3" y2="18.3" />
                                </svg>
                                {{ __('Report') }}
                            </x-button>

                    </form>
                    <x-a-cancel href="{{route('attendEvent.show', $item->id)}}">
                        <svg class="h-5 w-5 text-white-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 11 12 14 22 4" />
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                        </svg>
                        {{ __('Participate') }}
                    </x-a-cancel>
            </div>
            </section>
    </div>
    @endforeach

   <!-- Incluir los archivos CSS y JS -->
   <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/home.js') }}"></script>
    </body>
    </div>
</x-app-layout>