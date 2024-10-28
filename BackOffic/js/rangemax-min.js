const precioMaxRange = document.getElementById("precio_max_range");
const precioMaxDisplay = document.getElementById("precio_max_display");

// Actualizar el valor mostrado al mover la barra
precioMaxRange.addEventListener("input", function () {
    const formattedValue = new Intl.NumberFormat("es-ES").format(precioMaxRange.value);
    precioMaxDisplay.value = formattedValue;
});