
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
