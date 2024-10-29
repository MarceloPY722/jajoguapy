<?php
require('../libs/fpdf/fpdf.php');
require('../include/connexion.php');

class PDF extends FPDF {
    function Header() {
        // Logo
        $this->Image('../../assets/logo10.png', 10, 6, 30);
        
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        
        // Center the title
        $this->Cell(0, 20, 'Lista de Usuarios', 0, 1, 'C');
        
        // Salto de línea for spacing
        $this->Ln(10);
    }

    function Footer() {
        // Posición a 1.5 cm del final
        $this->SetY(-15);
        
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        
        // Número de página
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }

    function TableHeader() {
        // Configuración de fuente y color de fondo
        $this->SetFont('Arial', 'B', 10);
        $this->SetFillColor(200, 200, 200);
        
        // Encabezado de la tabla
        $this->Cell(20, 10, 'ID', 1, 0, 'C', true);
        $this->Cell(50, 10, 'Usuario', 1, 0, 'C', true);
        $this->Cell(70, 10, 'Email', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Rol', 1, 1, 'C', true);
    }

    function TableBody($data) {
        // Fuente de texto normal
        $this->SetFont('Arial', '', 10);
        
        foreach($data as $row) {
            $this->Cell(20, 10, $row['id'], 1, 0, 'C');
            $this->Cell(50, 10, $row['usuario'], 1, 0, 'L');
            $this->Cell(70, 10, $row['correo'], 1, 0, 'L');
            $this->Cell(30, 10, $row['rol'], 1, 1, 'C');
        }
    }
}

// Creación y generación del PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetDrawColor(0, 0, 0); // Color del borde
$pdf->TableHeader();

// Obtener datos de la base de datos
$req = $bd->query("SELECT id, usuario, correo, rol FROM usuarios");
$data = $req->fetchAll(PDO::FETCH_ASSOC);

$pdf->TableBody($data);

$pdf->Output();