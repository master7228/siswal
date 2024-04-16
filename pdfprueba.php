<?
require('fpdf.php');

class PDF extends FPDF
{

//Pie de página
function Footer()
{

$this->SetY(-200);

$this->SetFont('Arial','I',8);

$this->Cell(40,50,'Page '.$this->PageNo().'/{nb}',10,20,'c');
   }
}

//Creación del objeto de la clase heredada
$pdf=new PDF();
$pdf = new FPDF('P','mm',array(311, 396));
$pdf->AddPage();
$pdf->SetFont('Times','',12);
//Aquí escribimos lo que deseamos mostrar
$pdf->Output();
?>