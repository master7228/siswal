
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
	$equiposubrem = new EquipoRemisionSub('','','','');
	$eqsubrem=$equiposubrem->buscarEquipoSub('id_remision',$remision->id);
	$entradasub = new EntradaSub('','','','','','','');
	$fecha = date('Y-m-d H:i');
	$fecha_rem = date('Y-m-d');

class PDF extends FPDF{
		// Cabecera de página
		/*function Header(){
			$remision=unserialize($_SESSION['remision']);
			// Logo
			$this->Image('imagenes/logoae.png',10,12,60);
			// Arial bold 15
			$this->SetFont('Arial','B',6);
			// Movernos a la derecha
			$this->Cell(80);
			// Título
			$this->Cell(30,10,'BODEGA PBX: 2358708',0,0,'C');
			$this->Cell(100,10,'REMISION No.',0,0,'C');
			$this->Ln(5);
			$this->Cell(74,10,'',0,0);
			$this->Cell(73,10,'DEPOSITO: 4969908',0,0);
			$this->Cell(40,10,$remision->id,0,0);
			
			// Salto de línea
			$this->Ln(20);
		}*/

		// Pie de página
		function Footer(){
			// Posición: a 1,5 cm del final
			$this->SetY(-5);
			// Arial italic 8		
			$this->SetFont('Arial','I',8);
			// Número de página
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,1,array(311, 396));
		}
}

// Creación del objeto de la clase heredada 140,216

$pdf = new PDF();
$pdf = new FPDF('P','mm',array(311, 396));
$pdf->AliasNbPages();
$pdf->AddPage();

	$pdf->SetFont('Times','B',6);
		$pdf->Cell(60,10,'CLIENTE',0,0);
		$pdf->Cell(30,10,'FECHA REMISION',0,0);
		$pdf->Cell(40,10,'FECHA IMPRESION',0,0);
		$pdf->Ln(3);
	$pdf->SetFont('Times','',6);
		$pdf->Cell(60,10,$cliente_cons->nombre1.' '.$cliente_cons->nombre2.' '.$cliente_cons->apellido1.' '.$cliente_cons->apellido2,0,0);
		$pdf->Cell(30,10,$remision->fecha_rem,0,0);
		$pdf->Cell(40,10,$fecha,0,0);
		$pdf->Ln(3);
	$pdf->SetFont('Times','B',6);
		$pdf->Cell(30,10,'DOCUMENTO',0,0);
		$pdf->Cell(60,10,'SOLICITADO POR',0,0);
		$pdf->Cell(70,10,'OBRA',0,0);
		$pdf->Ln(3);
	$pdf->SetFont('Times','',6);
		$pdf->Cell(30,10,$cliente_cons->documento,0,0);
		$pdf->Cell(60,10,$cont_cons->nombre,0,0);
		$pdf->Cell(75,10,$obra_cons->nombre,0,0);
		$pdf->Ln(3);
	$pdf->SetFont('Times','B',6);
		$pdf->Cell(70,10,'DIRECCION OFICINA',0,0);
		$pdf->Cell(90,10,'TELEFONO OFICINA',0,0);
		$pdf->Ln(3);
	$pdf->SetFont('Times','',6);	
		$pdf->Cell(70,10,$cliente_cons->direccion,0,0);
		$pdf->Cell(90,10,$cliente_cons->telefono,0,0);
		$pdf->Ln(3);
	$pdf->SetFont('Times','B',6);
		$pdf->Cell(70,10,'DIRECCION OBRA',0,0);
		$pdf->Cell(50,10,'TELEFONO OBRA',0,0);
		$pdf->Cell(30,10,'VALOR TRANSPORTE',0,0);
		$pdf->Ln(3);
	$pdf->SetFont('Times','',6);	
		$pdf->Cell(70,10,$obra_cons->direccion,0,0);
		$pdf->Cell(50,10,$obra_cons->telefono,0,0);
		$pdf->Cell(30,10,$remision->valor_transporte,0,0);
		$pdf->Ln(20);
	$pdf->SetFont('Times','B',6);
	$pdf->Cell(20,6,'REFERENCIA',1,0);
	$pdf->Cell(80,6,'EQUIPO',1,0);
	$pdf->Cell(20,6,'CANTIDAD',1,0);
	$pdf->Cell(20,6,'VR. UNIT/DIA',1,0);
	$pdf->Cell(20,6,'VR. ALQUILER',1,1);
$pdf->SetFont('Times','',6);
/*for($i=1;$i<=34;$i++){
    $pdf->Cell(25,6,'01010200'.$i,1,0); //referencia
	$pdf->Cell(95,6,'EQUIPO ALQUILADO '.$i,1,0);//nombre
	$pdf->Cell(20,6,'2'.$i,1,0);//cantidad
	$pdf->Cell(25,6,'200'.$i,1,0);//valor unitario/día
	$pdf->Cell(27,6,'1740'.$i,1,1);//valor alquiler
}*/
for($i=0; $i<count($con_eq); $i++){
	$id_equipo=$con_eq[$i];
	$equipo_rem = $equipo->buscarEquipo('id', $id_equipo->id_equipo);
	$eq=$equipo_rem[0];
	$pdf->Cell(20,6,$eq->referencia,1,0); //referencia
	$pdf->Cell(80,6,$eq->nombre,1,0);//nombre
	$pdf->Cell(20,6,$id_equipo->cantidad,1,0);//cantidad
	if($eq->valor_dia != '0'){
		$pdf->Cell(20,6,$eq->valor_dia,1,0);//valor unitario/día
	}
	else if($eq->valor_hora != '0'){
		$pdf->Cell(20,6,$eq->valor_hora,1,0);//valor unitario/día
	}
	else if($eq->valor_metro != '0'){
		$pdf->Cell(20,6,$eq->valor_metro,1,0);//valor unitario/día
	}
	$total=$id_equipo->cantidad*$eq->valor_dia;
	$pdf->Cell(20,6,$total,1,1);//valor alquiler
}
for($j=0; $j<count($eqsubrem); $j++){
	$equipos1=$eqsubrem[$j];
	$equipo_sub_rem = $entradasub->buscarequipoEntrada('id', $equipos1->id_equipo_sub);
	$eqsub=$equipo_sub_rem[0];
	$pdf->Cell(20,6,'',1,0); //referencia
	$pdf->Cell(80,6,$eqsub->nombre,1,0);//nombre
	$pdf->Cell(20,6,$eqsub->cantidad,1,0);//cantidad
	$pdf->Cell(20,6,'',1,0);//valor unitario/día
	$pdf->Cell(20,6,'',1,1);//valor alquiler
}



$pdf->Ln(10);
	$pdf->SetFont('Times','B',6);
		$pdf->Cell(50,6,'DESPACHADO POR',1,0);
		$pdf->Cell(50,6,'RECIBIDO POR',1,0);
		$pdf->Cell(60,6,'OBSERVACIONES',1,0);
		$pdf->Ln(6);
		$pdf->Cell(50,20,'',1,0);
		$pdf->Cell(50,20,'',1,0);
		$pdf->Cell(60,20,'',1,0);
$pdf->Output();
}
?>