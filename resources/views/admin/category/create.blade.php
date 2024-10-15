<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="flex justify-center">
                        <div class="w-full max-w-md">
                            <div class="text-center mb-6">
                                <h1 class="text-2xl font-bold">Create Category</h1>
                            </div>
                            <div class="flex gap-2">
                                <form action="{{ route('categories.store') }}" method="POST">
                                    @csrf
                                    <div class="flex gap-4 w-full">
                                        @include('admin.category._form')
                                        <x-button class="h-10.50 mt-6">
                                            {{ __('Save') }}
                                        </x-button>
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