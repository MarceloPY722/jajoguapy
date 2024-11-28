<?php
require('../libs/fpdf/fpdf.php');
require('../include/connexion.php');

class PDF extends FPDF {
    // Cabecera de página
    function Header() {
        // Logo
        $this->Image('../../assets/logo10.png', 10, 8, 33);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30, 10, 'Informe de Actividades', 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);
    }

    // Pie de página
    function Footer() {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(10, 10, '#', 1, 0, 'C');
$pdf->Cell(40, 10, 'Usuario', 1, 0, 'C');
$pdf->Cell(40, 10, 'Accion', 1, 0, 'C');
$pdf->Cell(60, 10, 'Detalle', 1, 0, 'C');
$pdf->Cell(40, 10, 'Hora', 1, 1, 'C');

include '../include/connexion.php';
$req = $bd->query("
    (SELECT 'Usuario Creado' AS accion, u.nombre AS usuario, u.fecha_creacion AS hora, 'Usuario creado' AS detalle
     FROM usuarios u
     ORDER BY u.fecha_creacion DESC
     LIMIT 10)
    UNION
    (SELECT 'Pedido Realizado' AS accion, u.nombre AS usuario, p.fecha_creacion AS hora, CONCAT('Pedido #', p.id) AS detalle
     FROM pedidos p
     JOIN usuarios u ON p.usuario_id = u.id
     ORDER BY p.fecha_creacion DESC
     LIMIT 10)
    UNION
    (SELECT 'Producto Agregado' AS accion, 'Admin' AS usuario, pr.fecha_creacion AS hora, pr.nombre AS detalle
     FROM productos pr
     ORDER BY pr.fecha_creacion DESC
     LIMIT 10)
    UNION
    (SELECT 'Proveedor Agregado' AS accion, 'Admin' AS usuario, prov.fecha_creacion AS hora, prov.nombre AS detalle
     FROM proveedores prov
     ORDER BY prov.fecha_creacion DESC
     LIMIT 10)
    UNION
    (SELECT 'Producto en Pedido' AS accion, 'Admin' AS usuario, pp.fecha_creacion AS hora, CONCAT('Producto #', pp.producto_id, ' en Pedido #', pp.pedido_id) AS detalle
     FROM pedidos_productos pp
     ORDER BY pp.fecha_creacion DESC
     LIMIT 10)
    ORDER BY hora DESC
    LIMIT 10
");

$actividades = $req->fetchAll();
$contador = 1;

foreach ($actividades as $data) {
    $pdf->Cell(10, 10, $contador, 1, 0, 'C');
    $pdf->Cell(40, 10, $data['usuario'], 1, 0, 'C');
    $pdf->Cell(40, 10, $data['accion'], 1, 0, 'C');
    $pdf->Cell(60, 10, $data['detalle'], 1, 0, 'C');
    $pdf->Cell(40, 10, $data['hora'], 1, 1, 'C');
    $contador++;
}

// Salida del PDF
$pdf->Output();
?>