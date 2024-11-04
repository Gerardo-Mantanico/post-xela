
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 2,
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


document.getElementById('reportButton').addEventListener('click', function() {
    var userInput = prompt("Por favor ingresa el motivo del reporte:");
    if (userInput !== null && userInput.trim() !== "") {
        document.getElementById('cause').value = userInput;
        document.getElementById('reportForm').submit();
        alert('bien');
    } else {
        return;
    }
});
