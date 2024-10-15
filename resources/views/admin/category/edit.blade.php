<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold">Update category</h1>
            </div>
            <div class="flex gap-2">

            <form action="{{ route('categories.update', $category) }}" method="POST">
                                @csrf
                                @method('PUT') <!-- Aquí especificas el método PUT -->
                                
                                <div class="flex gap-4 w-full">
                                    <div class="flex gap-2 items-end">
                                        <div class="w-full">
                                            <label for="title" class="block text-sm font-medium text-gray-700">Category:</label>
                                            <input type="text" id="category" name="category" value="{{ $category->category }}" class="form-control block w-full mt-1 p-2 border border-gray-300 rounded" required>
                                        </div>                   
                                    </div>
                                    <x-button class="h-10.50 mt-6">
                            {{ __('Update') }}
                        </x-button>
                    </div>
                                </div>
                            </form>
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
</x-app-layout>



