document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        const message = document.querySelector(".message");
        if (message) {
            message.style.transition = "opacity 1s ease"; // Añade una transición
            message.style.opacity = "0"; // Desvanece el mensaje
            setTimeout(function () {
                message.remove(); // Elimina el mensaje del DOM
            }, 1000); // Tiempo para la transición (0.5 segundos)
        }
    }, 1000); // Espera de 1 segundo
});
