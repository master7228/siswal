<?php
 session_start();
 if($_SESSION["autenticado"] == "1"){
	 include_once 'Obra.php';
	 include_once 'ContactoObra.php';
	 $resp=unserialize($_SESSION['obras']);
	 $cont=unserialize($_SESSION['contactos']);

	 	header("Content-Type: application/vnd.ms-excel");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("content-disposition: attachment;filename=Obras.xls");
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Buscar Obras</title>

</head>

<body>
<table width="800" border="1" cellspacing="0" cellpadding="0">
						  <tr>
						    <td colspan="9" align="center"><strong>REGISTROS ENCONTRADOS </strong></td>
				          </tr>
						  <tr>
						    <td height="10" colspan="6" align="center">
							<input name="tarea" type="hidden" id="tarea"/>
					        <input name="id" type="hidden" id="id"/></td>
					      </tr>
						  <?php
							for ($i=0; $i<count($resp); $i++){
								$obra = $resp[$i];
							?>
						  <tr bgcolor="#999999">
							<td width="150" align="center"><strong>Nro. de Obra</strong></td>
							<td width="177" align="center"><strong>Nombre de la Obra </strong></td>
							<td width="153" align="center" valign="middle"><strong>Nombre del Cliente </strong></td>
							<td width="134" align="center" valign="middle"><strong>Direccion</strong></td>
							<td width="112" align="center" valign="middle"><strong>Telefono</strong></td>
							<td width="112" align="center" valign="middle"><strong>Estado</strong></td>
						  </tr>
						  
							<tr align="left" class="TablaUsuarios">
								<td width="150" align="center"><?php echo $obra->id; ?></a></td>
								<td width="177"><?php echo $obra->nombre; ?></td>
								<td width="153" align="left" valign="middle"><?php echo $obra->nombre_cliente; ?></td>
							    <td width="134" align="left" valign="middle"><?php echo $obra->direccion; ?></td>
								 <td width="112" align="left" valign="middle"><?php echo $obra->telefono; ?></td>
						      <td width="112" align="center" valign="middle"><?php if($obra->estado==1){echo "ACTIVO";}else{echo "INACTIVO";} ?></td>
							</tr>
							
							
			
							<?php 
							$contacto= new ContactoObra('','','','','','','','','','');
							$buscar_cont = $contacto->buscarContacto($obra->id);
							if($buscar_cont){ ?>
							<tr><td colspan="6" align="center"><strong>CONTACTOS</strong></td></tr>
							<tr bgcolor="#999999">
							<td width="150" align="center">Nombre Contacto</td>
							<td width="177" align="center">Cargo Contacto</td>
							<td width="153" align="center" valign="middle">Telefono Contacto </td>
							<td width="134" align="center" valign="middle">Celular Contacto</td>
							<td colspan="2" align="center" valign="middle">Email Contacto</td>
						  </tr>
						  <?php 
							for($j=0; $j<count($buscar_cont); $j++){
								$contac=$buscar_cont[$j];
							 ?>
								<tr bgcolor="#CCCCCC">
								<td width="150" align="center"><?php echo $contac->nombre; ?></a></td>
								<td width="177"><?php echo $contac->cargo; ?></td>
								<td width="153" align="left" valign="middle"><?php echo $contac->telefono; ?></td>
							    <td width="134" align="left" valign="middle"><?php echo $contac->celular; ?></td>
								<td colspan="2" align="left" valign="middle"><?php echo $contac->email; ?></td>
								</tr>
								
							
						<?php } 
						?> <tr>
						  <td colspan="6">&nbsp;</td>
						</tr> <?php 
						} 
						?> <tr>
						  <td colspan="6">&nbsp;</td>
						</tr>  <?php
						}
						?>
			 
			</table>
</body>
</html>
<?php 
 }else{
	echo "<script>alert ('No está autenticado en el sistema');</script>";
	echo "<script>window.location.href='index.php';</script>";
 }
?>