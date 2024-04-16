
<?php
session_start();
include_once 'EquipoRemision.php';
include_once 'EquipoRemisionSub.php';
include_once 'Registro.php';
include_once 'Obra.php';
include_once 'Cliente.php';
include_once 'Equipo.php';
include_once 'ContactoObra.php';
include_once 'Municipio.php';
include_once 'Remision.php';
include_once 'Transporte.php';
include_once 'EquipoSub.php';
include_once 'EntradaSub.php';
require('fpdf.php');

if (!empty($_SESSION["autenticado"]) && $_SESSION["autenticado"] == "1"){

	$remision=unserialize($_SESSION['remision']);
	$cliente = new Cliente("","","","","","","","","","","","","","","","","","","","","","","","","","","","");
	$cons_cliente=$cliente->buscarCliente('id',$remision->id_cliente);
	$cliente_cons=$cons_cliente[0];
	$obra = new Obra("","","","","","","","","","","","","","","","","","","","","");
	$cons_obra=$obra->buscarObraGeneral('id',$remision->id_obra);
	$obra_cons=$cons_obra[0];
	$mun = new Municipio('','','','');
	$municipio = $mun->buscarMpioObra($obra_cons->pais,$obra_cons->departamento,$obra_cons->municipio);
	$mun_cons=$municipio[0];
	$contacto = new ContactoObra('','','','','','','','','','');
	$consulta = $contacto->buscarContacto($obra_cons->id);
	$cont_cons=$consulta[0];
	$equiporem = new EquipoRemision('','','','');
	$con_eq = $equiporem->buscarEquiposRemisionados('id_remision',$remision->id);
	$equipo = new Equipo('','','','','','','','','','','','','','','','','','','','','','','','','','','');
	$fecha = date('Y-m-d H:i');
	$fecha_rem = date('Y-m-d');

class PDF extends FPDF

{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('imagenes/logoae.png',10,12,60);
    // Arial bold 15
    $this->SetFont('Arial','B',10);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,'BODEGA PBX: 2358708',0,0,'C');
	$this->Cell(100,10,'REMISION No.',0,0,'C');
	$this->Ln(5);
	$this->Cell(74,10,'',0,0);
	$this->Cell(73,10,'DEPOSITO: 4969908',0,0);
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
	$pdf->Cell(25,6,'REFERENCIA',1,0);
	$pdf->Cell(95,6,'EQUIPO',1,0);
	$pdf->Cell(20,6,'CANTIDAD',1,0);
	$pdf->Cell(25,6,'VR. UNIT/DIA',1,0);
	$pdf->Cell(27,6,'VR. ALQUILER',1,1);
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
}
?>