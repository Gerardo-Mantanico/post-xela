<div>
    <table class="min-w-full border-collapse border border-gray-200 p-6 mt-8">
        <thead>
            <tr>
                <th class="border border-gray-200 px-4 py-2">Info</th>
                <th class="border border-gray-200 px-4 py-2">Event date</th>
                <th class="border border-gray-200 px-4 py-2">Days Left</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($event as $item)
            <tr data-date="{{ $item->date_event }} {{ $item->time_event }}" data-id="{{ $item->id }}">
                <td class="border border-gray-200 px-4 py-2">
                    <div class="mt-6 pb-6">
                        <p class="mt-4"><strong>Title:</strong> {{$item->title}}</p>
                        <p>📬 <strong>Dirección:</strong> {{$item->address}}</p>
                        <p>📁 <strong>Category: </strong>{{ $item->category }}</p>
                        <p><strong>Límite de personas:</strong> {{$item->capacity}}</p>
                        <p><strong>Personas confirmadas:</strong> {{$item->confirmed}}</p>
                    </div>
                </td>
                <td class="border border-gray-200 text-lg px-4 py-2 text-center">
                    <p>📅 {{$item->date_event}} 🕓 {{$item->time_event}} hrs</p>
                </td>
                <td class="border border-gray-200 text-lg px-4 py-2 text-center countdown">
                </td>
                <td class="border border-gray-200 px-4 py-2 text-center">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $event->links() }} <!-- Paginación -->
</div>

<script src="{{ asset('js/time.js') }}"></script>