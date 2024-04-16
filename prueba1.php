
<?php
require('fpdf.php');

class PDF extends FPDF

{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('imagenes/logome.png',10,8,53);
    // Arial bold 15
    $this->SetFont('Arial','B',10);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,'BODEGA PBX: 444814',0,0,'C');
	$this->Cell(100,10,'REMISION No.',0,0,'C');
	$this->Ln(5);
	$this->Cell(75,10,'',0,0);
	$this->Cell(72,10,'NIT: 800042814-8',0,0);
	$this->Cell(40,10,'0001',0,0);
	
    // Salto de línea
	$this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8		
	$this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,1,'C');
}
}

// Creación del objeto de la clase heredada

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

	$pdf->SetFont('Times','B',10);
		$pdf->Cell(110,10,'CLIENTE',0,0);
		$pdf->Cell(40,10,'FECHA REMISION',0,0);
		$pdf->Cell(40,10,'FECHA IMPRESION',0,0);
		$pdf->Ln(5);
	$pdf->SetFont('Times','',10);
		$pdf->Cell(110,10,'MEGACONSTRUCCIONES Y CIA',0,0);
		$pdf->Cell(40,10,'17-01-2013',0,0);
		$pdf->Cell(40,10,'17-01-2013',0,0);
		$pdf->Ln(8);
	$pdf->SetFont('Times','B',10);
		$pdf->Cell(30,10,'DOCUMENTO',0,0);
		$pdf->Cell(90,10,'DESPACHADO A',0,0);
		$pdf->Cell(70,10,'OBRA',0,0);
		$pdf->Ln(5);
	$pdf->SetFont('Times','',10);
		$pdf->Cell(30,10,'800042812-8',0,0);
		$pdf->Cell(90,10,'CARLOS AUGUSTO CEBALLOS URIBE',0,0);
		$pdf->Cell(75,10,'URBANIZACION LAS FLORES',0,0);
		$pdf->Ln(8);
	$pdf->SetFont('Times','B',10);
		$pdf->Cell(120,10,'DIRECCION OFICINA',0,0);
		$pdf->Cell(90,10,'TELEFONO OFICINA',0,0);
		$pdf->Ln(5);
	$pdf->SetFont('Times','',10);	
		$pdf->Cell(120,10,'CRA 43A 45 23 OF 310 ED MONTREAL',0,0);
		$pdf->Cell(90,10,'2223498',0,0);
		$pdf->Ln(8);
	$pdf->SetFont('Times','B',10);
		$pdf->Cell(70,10,'DIRECCION OBRA',0,0);
		$pdf->Cell(50,10,'TELEFONO OBRA',0,0);
		$pdf->Cell(30,10,'VALOR TRANSPORTE',0,0);
		$pdf->Ln(5);
	$pdf->SetFont('Times','',10);	
		$pdf->Cell(70,10,'CIR 32 34 85',0,0);
		$pdf->Cell(50,10,'5783498',0,0);
		$pdf->Cell(30,10,'20000',0,0);
		$pdf->Ln(20);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(25,6,'REFERENCIA',1,0,'C');
	$pdf->Cell(95,6,'EQUIPO',1,0,'C');
	$pdf->Cell(20,6,'CANTIDAD',1,0,'C');
	$pdf->Cell(25,6,'VR. UNIT/DIA',1,0,'C');
	$pdf->Cell(27,6,'VR. ALQUILER',1,1,'C');
$pdf->SetFont('Times','',10);
for($i=1;$i<=34;$i++){
    $pdf->Cell(25,6,'01010200'.$i,1,0);
	$pdf->Cell(95,6,'EQUIPO ALQUILADO '.$i,1,0);
	$pdf->Cell(20,6,'2'.$i,1,0);
	$pdf->Cell(25,6,'200'.$i,1,0);
	$pdf->Cell(27,6,'1740'.$i,1,1);
}
$pdf->Ln(20);
	$pdf->SetFont('Times','B',10);
		$pdf->Cell(60,6,'DESPACHADO POR',1,0);
		$pdf->Cell(60,6,'RECIBIDO POR',1,0);
		$pdf->Cell(70,6,'OBSERVACIONES',1,0);
		$pdf->Ln(6);
		$pdf->Cell(60,20,'',1,0);
		$pdf->Cell(60,20,'',1,0);
		$pdf->Cell(70,20,'',1,0);
$pdf->Output();
?>