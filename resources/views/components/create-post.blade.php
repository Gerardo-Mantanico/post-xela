<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold">Create post</h1>
            </div>
            <form action="/post" method="post">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
                    <input type="text" class="form-control block w-full mt-1 p-2 border border-gray-300 rounded" name="title" required>
                </div>
                <div class="flex gap-4">
                    <div class="mb-4 w-1/4">
                        <label for="event-time" class="block text-sm font-medium text-gray-700">Date event:</label>
                        <input type="date" class="form-control block w-full mt-1 p-2 border border-gray-300 rounded" name="date-event" required>
                    </div>
                    <div class="mb-4 w-1/4">
                        <label for="time-event" class="block text-sm font-medium text-gray-700">Event time:</label>
                        <input type="time" class="form-control block w-full mt-1 p-2 border border-gray-300 rounded" name="time-event" id="time-event" required>
                    </div>
                    
                    <div class="mb-4 w-1/4">
                        <label for="capacity" class="block text-sm font-medium text-gray-700">Event Capacity:</label>
                        <input type="number" class="form-control block w-full mt-1 p-2 border border-gray-300 rounded" name="capacity" required>
                    </div>
                    <div class="mb-4 w-1/4">
                        <label for="type-event" class="block text-sm font-medium text-gray-700">Type event:</label>
                        <select name="type-event" id="type-event" class="form-control block w-full mt-1 p-2 border border-gray-300 rounded" required>
                            <option value="1">1</option>
                        </select>
                    </div>
                </div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                <input id="description" type="hidden" name="description">
                <trix-editor input="description" class="border border-gray-300 h-100 mb-4"></trix-editor>
                <x-button class="ms-4">
                    {{ __('post') }}
                </x-button>
            </form>
        </div>
    </div>
</div>
    @section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
        <script>
            // Personalizar la barra de herramientas de Trix
            document.addEventListener('trix-initialize', function(event) {
                var toolbar = event.target.toolbarElement;
                // Agregar un botón de imagen
                var buttonHTML = '<button type="button" class="trix-button" data-trix-action="x-insert-image" title="Insertar imagen">Imagen</button>';
                toolbar.querySelector('.trix-button-group').insertAdjacentHTML('beforeend', buttonHTML);

                // Lógica para insertar imagen
                toolbar.querySelector('[data-trix-action="x-insert-image"]').addEventListener('click', function() {
                    var imageUrl = prompt('Ingrese la URL de la imagen:');
                    if (imageUrl) {
                        event.target.editor.insertHTML(`<img src="${imageUrl}" alt="Imagen" />`);
                    }
                });
            });
        </script>
    @endsection


