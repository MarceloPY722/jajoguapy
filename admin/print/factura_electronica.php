<?php
require('../libs/fpdf/fpdf.php');
require('../include/connexion.php');

class PDF extends FPDF {
    function Header() {
        $this->Image('../../assets/logo10.png', 10, 6, 30);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 20, 'Factura de Pago', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
    }

    function TableHeader() {
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

        foreach($data as $row) {
            $precio_con_descuento = $row['precio_venta'] * (1 - $row['descuentos']);
            $subtotal = $precio_con_descuento * $row['cantidad'];
            $total += $subtotal;

            $this->Cell(60, 10, $row['nombre'], 1, 0, 'L');
            $this->Cell(30, 10, 'G ' . number_format($precio_con_descuento, 0, ',', '.'), 1, 0, 'R');
            $this->Cell(30, 10, $row['cantidad'], 1, 0, 'C');
            $this->Cell(30, 10, 'G ' . number_format($subtotal, 0, ',', '.'), 1, 1, 'R');
        }

        $this->Cell(120, 10, 'Monto Total', 1, 0, 'R', true);
        $this->Cell(30, 10, 'G ' . number_format($total, 0, ',', '.'), 1, 1, 'R');
    }

    function BuyerDetails($user) {
        $this->SetFillColor(240, 240, 240);
        $this->Rect(10, $this->GetY(), 190, 80, 'F');
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Datos de Comprador:', 0, 1, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 10, 'Nombre: ' . $user['nombre'], 0, 1, 'L');
        $this->Cell(0, 10, 'Apellido: ' . $user['apellido'], 0, 1, 'L');
        $this->Cell(0, 10, 'Metodo de Pago: Tarjeta D/C', 0, 1, 'L');
        $this->Cell(0, 10, 'Telefono: ' . $user['telefono'], 0, 1, 'L');
        $this->Ln(10);
    }

    function ShippingNotice() {
        $this->Ln(10); 
        $this->SetFont('Arial', 'I', 10);
        $this->SetTextColor(100, 100, 100); 
        $this->MultiCell(0, 10, "Aviso: El envio de los productos se realizara dentro de los proximos 3 a 5 dias habiles. 
        Para cualquier consulta sobre el estado del envio, comuniquese con nuestro servicio de atencion al cliente.
        No olvide Enviar este Documento mas la direccion de envio al WhatsApp +595 994 275 953");
    }
}

if (!isset($_GET['usuario_id'])) {
    die("Error: usuario_id no está definido.");
}

$usuario_id = $_GET['usuario_id'];
$req_user = $bd->prepare("SELECT nombre, apellido, telefono FROM usuarios WHERE id = :usuario_id");
$req_user->execute(['usuario_id' => $usuario_id]);
$user = $req_user->fetch(PDO::FETCH_ASSOC);

$req = $bd->prepare("
    SELECT 
        p.nombre, 
        p.precio_venta, 
        c.cantidad,
        cat.descuentos
    FROM 
        pedidos_productos c
    JOIN 
        productos p ON c.producto_id = p.id
    JOIN 
        pedidos m ON c.pedido_id = m.id
    JOIN 
        categorias cat ON p.categoria_id = cat.id
    WHERE 
        m.usuario_id = :usuario_id
");
$req->execute(['usuario_id' => $usuario_id]);
$data = $req->fetchAll(PDO::FETCH_ASSOC);

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetDrawColor(0, 0, 0); 
$pdf->BuyerDetails($user);
$pdf->Ln(20); 
$pdf->TableHeader();
$pdf->TableBody($data);
$pdf->ShippingNotice();

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="factura_usuario_' . $usuario_id . '.pdf"');
header('Pragma: no-cache');
header('Expires: 0');

$pdf->Output('D', 'factura_usuario_' . $usuario_id . '.pdf');
exit();