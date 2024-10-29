<?php
require('../libs/fpdf/fpdf.php');
require('../include/connexion.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->Image('../../assets/logo10.png', 10, 6, 30);

        $this->SetFont('Arial', 'B', 15);

      
        $this->Ln(20);

   
        $this->Cell(0, 10, 'Lista de Productos', 0, 1, 'C');

        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);

        $this->SetFont('Arial', 'I', 8);

        $this->Cell(0, 10, $this->PageNo(), 0, 0, 'C');
    }

    function TableHeader()
    {
        $this->SetFont('Arial', 'B', 10);
        $this->SetFillColor(200, 200, 200);

        $this->SetX(10);

        $this->Cell(10, 10, '#', 1, 0, 'C', true);
        $this->Cell(70, 10, 'Nombre', 1, 0, 'C', true);
        $this->Cell(40, 10, 'Precio Venta', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Cantidad', 1, 0, 'C', true);
        $this->Cell(40, 10, 'Categoria', 1, 1, 'C', true);
    }

    function TableBody($data)
    {
        $this->SetFont('Arial', '', 10);

        foreach ($data as $row) {
            $this->SetX(10); 
            $this->Cell(10, 10, $row['id'], 1, 0, 'C');
            $this->Cell(70, 10, $row['nombre'], 1, 0, 'L'); 
            $this->Cell(40, 10, $row['precio_venta'], 1, 0, 'R'); 
            $this->Cell(30, 10, $row['cantidad_stock'], 1, 0, 'C'); 
            $this->Cell(40, 10, $row['categoria_nombre'], 1, 1, 'L'); 
        }
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetDrawColor(0, 0, 0); 
$pdf->TableHeader();

$req = $bd->query("SELECT p.*, c.nombre AS categoria_nombre FROM productos p, categorias c WHERE c.id = p.categoria_id");
$data = $req->fetchAll(PDO::FETCH_ASSOC);

$pdf->TableBody($data);

$pdf->Output();
?>
