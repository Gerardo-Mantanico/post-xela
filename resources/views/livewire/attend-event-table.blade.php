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


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const rows = document.querySelectorAll("tr[data-date]");

        rows.forEach(row => {
            const eventDateStr = row.getAttribute("data-date");
            const eventDate = new Date(eventDateStr.replace(" ", "T")); // Convierte a formato ISO para compatibilidad

            if (isNaN(eventDate)) {
                console.error(`Fecha u hora inválida en la fila con ID: ${row.getAttribute("data-id")}`);
                row.querySelector(".countdown").innerText = "Fecha u hora inválida";
                return;
            }

            const countdownElement = row.querySelector(".countdown");

            function updateCountdown() {
                const now = new Date();
                const timeDifference = eventDate - now;

                if (timeDifference <= 0) {
                    countdownElement.innerText = "Evento finaliado";
                    return;
                }

                const daysLeft = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
                const hoursLeft = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutesLeft = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));

                countdownElement.innerText = `Faltan: ${daysLeft} días, ${hoursLeft} hrs, y ${minutesLeft} mins`;
            }

            updateCountdown();
            setInterval(updateCountdown, 60000); // Actualiza cada minuto
        });
    });
</script>