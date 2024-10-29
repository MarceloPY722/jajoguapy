const precioMinRange = document.getElementById("precio_min_range");
const precioMinDisplay = document.getElementById("precio_min_display");
const precioMaxRange = document.getElementById("precio_max_range");
const precioMaxDisplay = document.getElementById("precio_max_display");

// Actualizar el valor mostrado al mover la barra para precio mínimo
precioMinRange.addEventListener("input", function () {
    // Solo mostrar el valor formateado si el valor del rango es mayor que 0
    const formattedValue = new Intl.NumberFormat("es-ES").format(precioMinRange.value);
    precioMinDisplay.value = formattedValue || ''; // Muestra vacío si no hay valor
});

// Inicializar el valor mínimo a 0
precioMinDisplay.value = new Intl.NumberFormat("es-ES").format(precioMinRange.value);

// Actualizar el valor mostrado al mover la barra para precio máximo
precioMaxRange.addEventListener("input", function () {
    const formattedValue = new Intl.NumberFormat("es-ES").format(precioMaxRange.value);
    precioMaxDisplay.value = formattedValue;
});