<?php
 session_start();
 if($_SESSION["autenticado"] == "1"){
	 include_once 'Cliente.php';
	 include_once 'ContactoCliente.php';
	 $resp=unserialize($_SESSION['clientes']);

	 	header("Content-Type: application/vnd.ms-excel");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("content-disposition: attachment;filename=Clientes.xls");
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Buscar Clientes</title>

</head>

<body>
<table width="1318" border="1" cellspacing="0" cellpadding="0">
						  <tr>
						    <td colspan="6" align="center"><span class="style1">REGISTROS ENCONTRADOS </span></td>
			              </tr>
						  <tr>
						    <td height="10" colspan="6" align="center"><input name="tarea" type="hidden" id="tarea"/></td>
					      </tr>
						   <?php
							for ($i=0; $i<count($resp); $i++){
								$cliente = $resp[$i];
							?>
						  <tr>
							<td width="290" align="center" bgcolor="#CCCCCC"><strong>Nro de Identificaci&oacute;n</strong></td>
							<td width="290" align="center" bgcolor="#CCCCCC"><strong>Nombre del Cliente </strong></td>
							<td width="180" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Direcci&oacute;n</strong></td>
							<td width="156" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Tel&eacute;fono</strong></td>
							<td width="270" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Email</strong></td>
							<td width="118" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Estado</strong></td>
						  </tr>
						 
							<tr align="left" class="TablaUsuarios">
							  <td><?php echo $cliente->documento; ?></a></td>
								<td><?php echo ($cliente->nombre1."  ".$cliente->nombre2."  ".$cliente->apellido1."  ".$cliente->apellido2); ?></td>
							    <td align="left" valign="middle"> <?php echo $cliente->direccion; ?></td>                               
					            <td align="left" valign="middle"> <?php echo $cliente->telefono; ?></td> 
								<td align="left" valign="middle"> <?php echo $cliente->email; ?></td>                                
			                <td align="center" valign="middle"><?php if($cliente->estado==1){echo "ACTIVO";}else{echo "INACTIVO";} ?>			                
							</tr>
						
						<?php 
							$contacto= new ContactoCliente('','','','','','','','','','','');
							$buscar_cont = $contacto->buscarContacto($cliente->documento);
							if($buscar_cont){ ?>
  <tr><td colspan="6" align="center"><strong>CONTACTOS</strong></td>
  </tr>
							<tr bgcolor="#999999">
							<td align="center">Nombre Contacto</td>
							<td align="center">Cargo Contacto</td>
							<td align="center" valign="middle">Telefono Contacto </td>
							<td align="center" valign="middle">Celular Contacto</td>
							<td colspan="2" align="center" valign="middle">Email Contacto</td>
			              </tr>
						  <?php 
							for($j=0; $j<count($buscar_cont); $j++){
								$contac=$buscar_cont[$j];
							 ?>
								<tr bgcolor="#CCCCCC">
								<td align="left"><?php echo $contac->nombre; ?></a></td>
								<td><?php echo $contac->cargo; ?></td>
								<td align="left" valign="middle"><?php echo $contac->telefono; ?></td>
							    <td align="left" valign="middle"><?php echo $contac->celular; ?></td>
								<td colspan="2" align="left" valign="middle"><?php echo $contac->email; ?></td>
								</tr>
								
							
						<?php } 
						?> <tr>
						  <td colspan="6">&nbsp;</td>
						</tr> 
						<?php 
						} 
						?> <tr>
						  <td colspan="6">&nbsp;</td>
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
