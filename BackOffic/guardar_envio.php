<?php
// Incluir archivos necesarios
include './include/head.php';
include './include/cnx.php';
include './include/menu.php';

// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar que todos los campos necesarios estén definidos
    $requiredFields = ['direccion', 'ciudad', 'ciudad_nombre', 'telefono', 'datos_adicionales', 'usuario_id'];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field])) {
            die("Error: El campo '$field' no está definido.");
        }
    }

    // Obtener datos del formulario de envío
    $direccion = $_POST['direccion'];
    $ciudad_id = $_POST['ciudad'];
    $ciudad_nombre = $_POST['ciudad_nombre'];
    $telefono = $_POST['telefono'];
    $datos_adicionales = $_POST['datos_adicionales'];
    $usuario_id = $_POST['usuario_id'];

    // Insertar datos de envío en la tabla 'envios'
    $queryEnvio = "INSERT INTO envios (direccion_envio, departamento_id, ciudad, telef_contacto, datos_adicionales) VALUES (NULL, :direccion, :ciudad_id, :ciudad_nombre, :telefono, :datos_adicionales)";
    $stmtEnvio = $bd->prepare($queryEnvio);
    $stmtEnvio->execute([
        ':direccion' => $direccion,
        ':ciudad_id' => $ciudad_id,
        ':ciudad_nombre' => $ciudad_nombre,
        ':telefono' => $telefono,
        ':datos_adicionales' => $datos_adicionales
    ]);

    // Obtener el ID del envío recién insertado
    $envio_id = $bd->lastInsertId();

    // Redirigir a la página de confirmación o a donde corresponda
    header("Location: confirmacion.php");
    exit();
} else {
    // Si no se ha enviado el formulario, redirigir a la página de detalles de compra
    header("Location: shopping-details.php");
    exit();
}
?>