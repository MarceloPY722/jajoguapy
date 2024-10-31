// Obtiene los elementos del rango de precio máximo y su visualización
const precioMaxRange = document.getElementById("precio_max_range");
const precioMaxDisplay = document.getElementById("precio_max_display");

// Función para actualizar el campo de texto con el valor formateado
precioMaxRange.addEventListener("input", function () {
    requestAnimationFrame(() => {
        const formattedValue = new Intl.NumberFormat("es-ES").format(precioMaxRange.value);
        precioMaxDisplay.value = "Gs. " + formattedValue;
    });
});

// Inicializa el valor del campo de texto al valor actual del control deslizante
precioMaxDisplay.value = "Gs. " + new Intl.NumberFormat("es-ES").format(precioMaxRange.value);
