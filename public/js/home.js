var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});


document.querySelectorAll('.reportButton').forEach(button => {
    button.addEventListener('click', function() {
        var userInput = prompt("Por favor ingresa el motivo del reporte:");
        if (userInput !== null && userInput.trim() !== "") {
            var form = button.closest('form'); // Encuentra el formulario relacionado
            form.querySelector('input[name="cause"]').value = userInput;
            form.submit(); // Envía el formulario

        } else {
            return;
        }
    });
});