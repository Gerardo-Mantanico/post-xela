<div class=" p-6">
    <h2 class="text-lg font-bold mb-4 text-center">Category</h2>
    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
    <div class="bg-green-500 text-white p-2 rounded">
        {{ session('message') }}
    </div>
    @endif


    <!-- Modal para agregar categoría -->
    @if ($isOpen)
    <div class="fixed inset-0 flex items-center justify-center z-50  sm:rounded-lg ">
        <div class="bg-white p-6 rounded shadow-lg">
            <h2 class="text-lg font-bold mb-4">Add category</h2>
            <input type="text" wire:model="categoryName" placeholder="Nombre de la categoría" class="mb-4 p-2 border border-gray-300 rounded">
            <div>
                @if ($isEditMode)
                <x-button wire:click="updateCategory">
                    Update
                </x-button>
                @else
                <x-button wire:click="addCategory">
                    Save
                </x-button>
                @endif
                <x-button-cancel wire:click="closeModal">
                    Cancel
                </x-button-cancel>
            </div>
        </div>
    </div>
    @endif

    <div class="flex justify-between items-center mt-6">
        <x-button wire:click="openModal">
            Add category
        </x-button>
        <input type="text" wire:model="search" placeholder="Buscar categorías..." class="mb-4 p-2 border border-gray-300 rounded">
    </div>


    <table class="min-w-full border-collapse border border-gray-200 p-6 mt-6">
        <thead>
            <tr>
                <th class="border border-gray-200 px-4 py-2">ID</th>
                <th class="border border-gray-200 px-4 py-2">Nombre</th>
                <th class="border border-gray-200 px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td class="border border-gray-200 px-4 py-2 text-center">{{ $category->id }}</td>
                <td class="border border-gray-200 px-4 py-2 text-center">{{ $category->category }}</td>
                <td class="border border-gray-200 px-4 py-2 text-center">
                    <x-button-edit wire:click="edit({{ $category->id }})">
                        Edit
                    </x-button-edit>
                    <x-button-delete wire:click="delete({{ $category->id }})">
                        Delete
                    </x-button-delete>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $categories->links() }} <!-- Paginación -->
</div>