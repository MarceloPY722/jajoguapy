<?php include './include/cnx.php'; $compraExitosa = true;  $numeroOrden = 'ORD-' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $compraExitosa ? 'Compra Exitosa' : 'Error en la Compra'; ?></title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #000;
            font-family: Arial, sans-serif;
            color: #fff;
        }
        .container {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
        }
        .icon {
            font-size: 80px;
            margin-bottom: 20px;
        }
        .success {
            color: #4CAF50;
        }
        .error {
            color: #f44336;
        }
        h1 {
            margin-top: 0;
            color: #fff;
        }
        p {
            margin-bottom: 20px;
            color: #fff;
        }
        .button-container {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #45a049;
        }
        .button.secondary {
            background-color: #3498db;
        }
        .button.secondary:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($compraExitosa): ?>
            <div class="icon success">&#10004;</div>
            <h1>¡Su compra ha sido exitosa!</h1>
            <p>Número de orden: <?php echo $numeroOrden; ?></p>
            <p>Gracias por su compra.</p>
            <div class="button-container">
                <a href="#" class="button" onclick="descargarPDF()">Descargar Comprobante (PDF)</a>
                <a href="index.php" class="button secondary">Volver al Inicio</a>
            </div>
        <?php else: ?>
            <div class="icon error">&#10008;</div>
            <h1>Error en la Compra</h1>
            <p>Lo sentimos, ha ocurrido un error al procesar su compra. Por favor, inténtelo de nuevo más tarde.</p>
            <a href="index.php" class="button">Volver al Inicio</a>
        <?php endif; ?>
    </div>
    
    <script>
        function descargarPDF() {
            // Aquí añadiremos la lógica para descargar el PDF en el futuro
            alert("La funcionalidad de descarga de PDF se implementará próximamente. Su número de orden es: <?php echo $numeroOrden; ?>");
        }
    </script>
</body>
</html>