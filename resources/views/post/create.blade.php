<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="text-center mb-6">
                        <h1 class="text-2xl font-bold">Create post</h1>
                    </div>
                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
                            <input type="text" value="{{ old('title') }}" class="form-control block w-full mt-1 p-2 border border-gray-300 rounded" name="title" required>
                        </div>
                        <div class="flex gap-4 w-full">
                            <div class="mb-4 w-1/2">
                                <label for="event-time" class="block text-sm font-medium text-gray-700">Date event:</label>
                                <input type="date" value="{{ old('date_event') }}" class="form-control block w-full mt-1 p-2 border border-gray-300 rounded" name="date_event" required>
                            </div>
                            <div class="mb-4 w-1/2">
                                <label for="time-event" class="block text-sm font-medium text-gray-700">Event time:</label>
                                <input type="time" value="{{ old('time_event') }}" class="form-control block w-full mt-1 p-2 border border-gray-300 rounded" name="time_event" id="time-event" required>
                            </div>

                            <div class="mb-4 w-1/2">
                                <label for="capacity" class="block text-sm font-medium text-gray-700">Event Capacity:</label>
                                <input type="number" value="{{ old('capacity') }}" class="form-control block w-full mt-1 p-2 border border-gray-300 rounded" name="capacity" min="1" step="1" required>
                            </div>
                            <div class="mb-4 w-1/2">
                                <label for="type-event" class="block text-sm font-medium text-gray-700">Type event:</label>
                                <select name="id_category" value="{{ old('id_category') }}" id="type-event" class="form-control block w-full mt-1 p-2 border border-gray-300 rounded" required>
                                    @foreach ($categories as $item)
                                    <option value="{{$item->id_category}}">{{$item->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                        <input id="description" type="hidden" name="description">
                        <trix-editor input="description" value="{{ old('description') }}" class="border border-gray-300 h-100 mb-4"></trix-editor>
                        <x-button>
                            {{ __('post') }}
                        </x-button>
                        <x-a-cancel href=" {{ route('posts.index') }}">
                            {{ __('Cancel') }}
                        </x-a-cancel>
                    </form>


                </div>
                @section('scripts')
                <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
                <script>
                    // Personalizar la barra de herramientas de Trix
                    document.addEventListener('trix-initialize', function(event) {
                        var toolbar = event.target.toolbarElement;

                        // Agregar un botón de imagen
                        var buttonImageHTML = '<button type="button" class="trix-button" data-trix-action="x-insert-image" title="Insertar imagen">Imagen</button>';
                        toolbar.querySelector('.trix-button-group').insertAdjacentHTML('beforeend', buttonImageHTML);

                        // Lógica para insertar imagen
                        toolbar.querySelector('[data-trix-action="x-insert-image"]').addEventListener('click', function() {
                            // Crear un input de tipo file
                            var input = document.createElement('input');
                            input.type = 'file';
                            input.accept = 'image/*'; // Aceptar solo imágenes

                            // Cuando se seleccione un archivo
                            input.addEventListener('change', function(event) {
                                var file = event.target.files[0]; // Obtener el archivo seleccionado

                                if (file) {
                                    var reader = new FileReader(); // Crear un lector de archivos

                                    // Cuando el archivo se haya leído correctamente
                                    reader.onload = function(e) {
                                        var imageUrl = e.target.result; // Obtener la URL de la imagen en Base64
                                        event.target.editor.insertHTML(`<img src="${imageUrl}" alt="Imagen" />`); // Insertar la imagen en el editor
                                    };

                                    reader.readAsDataURL(file); // Leer el archivo como URL de datos (Base64)
                                }
                            });

                            // Abrir el cuadro de diálogo de selección de archivos
                            input.click();
                        });

                        // Aquí puedes agregar más botones y lógica si es necesario
                    });
                </script>
                @endsection

            </div>
        </div>
    </div>
</x-app-layout>