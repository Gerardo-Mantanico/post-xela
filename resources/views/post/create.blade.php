<x-app-layout>
</x-app-layout>

<div class="py-12 mt-11">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                <div class="text-center mb-6">
                    <h1 class="text-2xl font-bold">Create post</h1>
                </div>
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
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
                                <option value="{{$item->id}}">{{$item->category}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700">Address:</label>
                        <input type="text" value="{{ old('address') }}" class="form-control block w-full mt-1 p-2 border border-gray-300 rounded" name="address" required>
                    </div>

                    <label for="">Description:</label>
                    <textarea name="description" value="{{ old('description') }}" id="description" cols="30" rows="10"></textarea>
                    <x-button>
                        {{ __('Post') }}
                    </x-button>
                    <x-a-cancel href="{{ route('posts.index') }}">
                        {{ __('Cancel') }}
                    </x-a-cancel>
                </form>
            </div>
            @section('scripts')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
            @endsection
        </div>
    </div>
</div>




<head>
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>

<body>
    <script>
        $('#description').summernote({
            placeholder: 'description...',
            tabsize: 2,
            height: 300
        });
    </script>
</body>