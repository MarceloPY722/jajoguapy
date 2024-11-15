<?php
require('../libs/fpdf/fpdf.php');
require('../include/connexion.php');

class PDF extends FPDF {
    protected $tableWidth = 150; // Ancho total de la tabla

    function Header() {
        $this->Image('../../assets/logo10.png', 10, 6, 30);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 20, 'Factura de Pago', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }

    function TableHeader() {
        $pageWidth = $this->GetPageWidth() - $this->lMargin - $this->rMargin;
        $startX = ($pageWidth - $this->tableWidth) / 2 + $this->lMargin;
        $this->SetX($startX);

        $this->SetFont('Arial', 'B', 10);
        $this->SetFillColor(200, 200, 200);
        $this->Cell(60, 10, 'Producto', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Precio', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Cantidad', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Subtotal', 1, 1, 'C', true);
    }

    function TableBody($data) {
        $this->SetFont('Arial', '', 10);
        $total = 0;
        
        $pageWidth = $this->GetPageWidth() - $this->lMargin - $this->rMargin;
        $startX = ($pageWidth - $this->tableWidth) / 2 + $this->lMargin;
        $this->SetX($startX);

        foreach($data as $row) {
            $subtotal = $row['precio_venta'] * $row['cantidad'];
            $total += $subtotal;

            $this->Cell(60, 10, $row['nombre'], 1, 0, 'L');
            $this->Cell(30, 10, 'G ' . number_format($row['precio_venta'], 0, ',', '.'), 1, 0, 'R');
            $this->Cell(30, 10, $row['cantidad'], 1, 0, 'C');
            $this->Cell(30, 10, 'G ' . number_format($subtotal, 0, ',', '.'), 1, 1, 'R');
            
            $this->SetX($startX);
        }

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(120, 10, 'Monto Total', 1, 0, 'R', true);
        $this->SetFont('Arial', '', 10);
        $this->Cell(30, 10, 'G ' . number_format($total, 0, ',', '.'), 1, 1, 'R', true);
    }

    function BuyerDetails($user) {
        $this->SetFillColor(240, 240, 240);
        $this->Rect(10, $this->GetY(), 190, 60, 'F');

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Datos de Comprador:', 0, 1, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 10, 'Nombre: ' . $user['nombre'], 0, 1, 'L');
        $this->Cell(0, 10, 'Apellido: ' . $user['apellido'], 0, 1, 'L');
        $this->Cell(0, 10, 'Metodo de Pago: Tarjeta D/C', 0, 1, 'L');
        $this->Cell(0, 10, 'Telefono: ' . $user['telefono'], 0, 1, 'L');
        $this->Cell(0, 10, 'Direccion de Envio: ' . $user['direccion_envio'], 0, 1, 'L');
        $this->Ln(10);
    }

    function AdditionalNotes() {
        $this->Ln(10); // Espacio adicional entre la tabla y las notas
        $this->SetFont('Arial', '', 10);
        
        // Texto alineado a la derecha
        $this->Cell(0, 10, 'Los Envios Son realizados de Lunes a Viernes de 8:00 a 17:00', 0, 1, 'R');
        $this->Cell(0, 10, 'Se le contactara via WhatsApp o Correo para ultimar Detalles', 0, 1, 'R');
        $this->Cell(0, 10, 'del Envio con el Courrier que trabaja junto a la Empresa', 0, 1, 'R');
    }
}

// Verificar la existencia del parámetro usuario_id
if (!isset($_GET['usuario_id'])) {
    die("Error: usuario_id no está definido.");
}

$usuario_id = $_GET['usuario_id'];

// Obtener datos del usuario
$req_user = $bd->prepare("SELECT nombre, apellido, telefono, direccion_envio FROM usuarios WHERE id = :usuario_id");
$req_user->execute(['usuario_id' => $usuario_id]);
$user = $req_user->fetch(PDO::FETCH_ASSOC);

// Obtener datos de la base de datos
$req = $bd->prepare("
    SELECT 
        p.nombre, 
        p.precio_venta, 
        c.cantidad
    FROM 
        pedidos_productos c
    JOIN 
        productos p ON c.producto_id = p.id
    JOIN 
        pedidos m ON c.pedido_id = m.id
    WHERE 
        m.usuario_id = :usuario_id
");
$req->execute(['usuario_id' => $usuario_id]);
$data = $req->fetchAll(PDO::FETCH_ASSOC);

// Creación y generación del PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetDrawColor(0, 0, 0); // Color del borde
$pdf->BuyerDetails($user);
$pdf->Ln(20); // Espacio adicional entre los datos del comprador y la tabla
$pdf->TableHeader();
$pdf->TableBody($data);
$pdf->AdditionalNotes(); // Llamada a las notas adicionales

$pdf->Output();
?>
