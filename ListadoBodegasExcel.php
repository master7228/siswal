<?php
 session_start();
 if($_SESSION["autenticado"] == "1"){
	 include_once 'Bodega.php';
	 include_once 'ContactoBodega.php';
	 $resp=unserialize($_SESSION['bodegas']);

	 	header("Content-Type: application/vnd.ms-excel");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("content-disposition: attachment;filename=Bodegas.xls");
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Buscar Bodegas</title>

</head>

<body>
<table width="1166" border="1" cellpadding="0" cellspacing="0">
						  <tr>
						    <td height="37" colspan="5" align="center"><span class="style1">REGISTROS ENCONTRADOS </span></td>
			              </tr>
  <tr>
						    <td height="10" colspan="5" align="center"><input name="tarea" type="hidden" id="tarea"/></td>
					      </tr>
						   <?php
							for ($i=0; $i<count($resp); $i++){
								$bodega = $resp[$i];
							?>
						  <tr>
							<td width="281" align="center" bgcolor="#CCCCCC"><strong>Nombre Bodega</strong></td>
							<td width="281" align="center" bgcolor="#CCCCCC"><strong>Fecha Creaci&oacute;n</strong></td>
							<td width="170" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Direcci&oacute;n</strong></td>
							<td width="150" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Barrio</strong></td>
							<td width="200" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Estado</strong></td>
						  </tr>
						 
							<tr align="left" class="TablaUsuarios">
							  <td><?php echo $bodega->nombre; ?></a></td>
								<td><?php echo $bodega->fecha_creacion; ?></td>
							    <td align="left" valign="middle"> <?php echo $bodega->direccion; ?></td>                               
					            <td align="left" valign="middle"> <?php echo $bodega->barrio; ?></td> 
								<td align="left" valign="middle"> <?php if($bodega->estado==1){echo "ACTIVO";}else{echo "INACTIVO";} ?></td>                                
                                </tr>
						
						<?php 
							$contacto= new ContactoBodega('','','','','','','','','','');
							$buscar_cont = $contacto->buscarContacto($bodega->nombre);
							if($buscar_cont){ ?>
  <tr><td colspan="5" align="center"><strong>CONTACTOS</strong></td>
  </tr>
							<tr bgcolor="#999999">
							<td align="center">Nombre Contacto</td>
							<td align="center">Cargo Contacto</td>
							<td align="center" valign="middle">Telefono Contacto </td>
							<td align="center" valign="middle">Email Contacto</td>
							<td align="center" valign="middle">Estado</td>
  </tr>
						  <?php 
							for($j=0; $j<count($buscar_cont); $j++){
								$contac=$buscar_cont[$j];
							 ?>
								<tr bgcolor="#CCCCCC">
								<td align="left"><?php echo $contac->nombre; ?></a></td>
								<td><?php echo $contac->cargo; ?></td>
								<td align="left" valign="middle"><?php echo $contac->telefono; ?></td>
							    <td align="left" valign="middle"><?php echo $contac->email; ?></td>
								<td align="left" valign="middle"><?php if($contac->estado==1){echo "ACTIVO";}else{echo "INACTIVO";} ?></td>
  </tr>
								
							
						<?php } 
						?> <tr>
						  <td colspan="5">&nbsp;</td>
						  </tr> 
						<?php 
						} 
						?> <tr>
						  <td colspan="5">&nbsp;</td>
						  </tr> 		
						
						
						<?php } ?>
</table>
</body>
</html>
<?php 
 }else{
	echo "<script>alert ('No está autenticado en el sistema');</script>";
	echo "<script>window.location.href='index.php';</script>";

 }
?>
