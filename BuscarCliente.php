<?php
 session_start();
 if($_SESSION["autenticado"] == "1"){
	 include_once 'Cliente.php';
	 include_once 'ContactoCliente.php';
	 $ver_clientes = 0;
	 if(!empty ($_POST['select']) and $_POST['select'] == "*"){
		$_POST['palabra'] = "*";
	 }
	  if(!empty ($_POST['select']) and $_POST['select'] == "1"){
		$_POST['select'] = "estado";
		$_POST['palabra'] = "1";
	 }
	  if(!empty ($_POST['select']) and $_POST['select'] == "2"){
		$_POST['select'] = "estado";
		$_POST['palabra'] = "2";
	 }
	 if(!empty($_POST['select'])){
		 $cliente = new Cliente("","","","","","","","","","","","","","","","","","","","","","","","","","","","");
		 $resp = $cliente->buscarCliente($_POST['select'],$_POST['palabra']);
		 $_SESSION['clientes'] = serialize($resp);
		 $ver_clientes = 1;
	 }
	 
	 /* if(!empty($_POST['tarea']) && $_POST['tarea'] == 'exportar'){
	 	header("Content-Type: application/vnd.ms-excel");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("content-disposition: attachment;filename=CLIENTES.xls");
	 }*/
	 if(!empty($_POST['tarea']) && $_POST['tarea'] == 'salir'){
		unset($_SESSION['cliente']);
		unset($_SESSION['clientes']);
		echo "<script>window.location.href='MenuCliente.php';</script>";
	}
	 
	 
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Buscar Clientes</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script src="js/validaciones.js" language="JavaScript"></script>
<script src="js/reloj.js" language="JavaScript"></script>
<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
</head>

<body onLoad="mueveReloj();" onKeyDown = "showDown(window.event)">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><form id="form1" name="form1" method="post" action="" class="TablaUsuarios">
    <input name="tarea" type="hidden" id="tarea"/> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="middle"><table width="100%" height="35" border="0">
              <tr>
                <td width="196"><img src="imagenes/logoge.png" alt="Himed" width="200" height="40" /></td>
                <td align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="right" valign="top">
                    	<table width="128" border="0" align="right" cellpadding="2" cellspacing="2" > 
                    	<tr> 
                    		<th width="114" scope="col"><font id="cl"><strong>0</strong></font></th> 
                    	</tr> 
                    </table>
                    
                    </td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr align="right" valign="middle">
                          <td><span class="Estilo6">Usuario: <?php echo $_SESSION["nombre"].' '.$_SESSION['apellido']; ?></span></td>
                          <td width="50"><a href="logout.php"><img src="imagenes/eqsl_exit.png" width="32" height="32" border="0" title="salir" /></a></td>
                        </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="left" valign="middle"><table width="100" border="0" cellspacing="0" cellpadding="0">
              <tr align="center" valign="middle">
                <td><a href="ValidarCliente.php" target="_parent"><img src="imagenes/nuevo_user.png" alt="nuevo" width="32" height="32" border="0" title="Nuevo Cliente" /></a></td>
                <td><a href="BuscarCliente.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Cliente"/></a></td>
                <td><a href="BuscarClienteEditar.php"><img src="imagenes/editar.png" width="33" height="32" border="0" title="Editar Cliente" /></a></td>
                <!--<td><a href="ListadoClientesExcel.php"><img src="imagenes/exportar_excel.png" width="32" height="32" border="0" title="Exportar a Excel" /></a></td>-->
                <td><a href="javascript:valgeneral('salir')"><img src="imagenes/flecha.png" alt="salir" width="32" height="32" border="0" title="Volver" /></a></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center">
			<?php if($ver_clientes == 0){?>
			<p>&nbsp;</p>
			<table width="350" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="middle"><table width="320" height="190" style="background-image:url(imagenes/fondo_buscar.png)" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="3" align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center" class="BuscarUsuario">BUSCAR CLIENTES</td>
                  </tr>
                  <tr>
                    <td colspan="3">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="47%"><span class="BuscarUsuario" >Criterio de busqueda: </span></td>
                    <td width="2%">&nbsp;</td>
                    <td width="51%"><label>
                      <select name="select" id="select" style="height: 20px; width: 140px;" onchange="valcampobusquedaCliente();">
                        <option value="documento">Identificación</option>
                        <option value="nombre1">Nombre</option>
                        <option value="apellido1">Apellidos</option>
						<option value="1">Activos</option>
						<option value="2">Inactivos</option>
                        <option value="*">Todos</option>
                      </select>
                    </label></td>
                  </tr>
                  <tr>
                    <td height="19" colspan="3">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="30"><span class="BuscarUsuario" >Informaci&oacute;n a buscar:</span></td>
                    <td>&nbsp;</td>
                    <td><label>
                    <input name="palabra" type="text" id="palabra" size="18" />
</label></td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center">                     <input type="submit" name="buscar" id="buscar" value="Buscar"/></td>
                    </tr>
                  <tr>
                    <td colspan="3" align="center">&nbsp;</td>
                  </tr>
                  
                </table></td>
              </tr>
            </table>
			<p>
			  <?php }else{
						if(sizeof($resp)!=0){
			?>
			  </p>
			<table width="900" border="1" cellspacing="0" cellpadding="0">
			    <tr>
						    <td colspan="9" align="center"><span class="style1">REGISTROS ENCONTRADOS </span></td>
			              </tr>
						  <tr>
						    <td height="10" colspan="9" align="center">&nbsp;</td>
					      </tr>
						   <?php
							for ($i=0; $i<count($resp); $i++){
								$cliente = $resp[$i];
							?>
						  <tr>
							<td width="143" align="center" bgcolor="#CCCCCC"><strong>Nro de Identificaci&oacute;n</strong></td>
							<td width="191" align="center" bgcolor="#CCCCCC"><strong>Nombre del Cliente </strong></td>
							<td width="87" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Direcci&oacute;n</strong></td>
							<td width="87" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Tel&eacute;fono</strong></td>
							<td width="87" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Email</strong></td>
							<td width="86" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Estado</strong></td>
						  </tr>
						 
							<tr align="left" class="TablaUsuarios">
								<td width="143"><?php echo $cliente->documento; ?></a></td>
								<td width="191"><?php echo ($cliente->nombre1."  ".$cliente->nombre2."  ".$cliente->apellido1."  ".$cliente->apellido2); ?></td>
							    <td width="87" align="left" valign="middle"> <?php echo $cliente->direccion; ?></td>                               
					            <td width="87" align="left" valign="middle"> <?php echo $cliente->telefono; ?></td> 
								<td width="87" align="left" valign="middle"> <?php echo $cliente->email; ?></td>                                
			                <td width="86" align="center" valign="middle"><?php if($cliente->estado==1){echo "ACTIVO";}else{echo "INACTIVO";} ?>							  </tr>
						
						<?php 
							$contacto= new ContactoCliente('','','','','','','','','','','');
							$buscar_cont = $contacto->buscarContacto($cliente->id);
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
								<td width="150" align="left"><?php echo $contac->nombre; ?></a></td>
								<td width="177" align="left"><?php echo $contac->cargo; ?></td>
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
						</tr> 		
						
						
						<?php } ?>
			  </table>
			<?php
						}else{
							echo "No hay resultados para esta consulta";
						}
					}
						?>			
			</td>
          </tr>
          <tr>
            <td align="center" valign="middle"></td>
          </tr>
        </table>
        <p>&nbsp;</p>
    </form>
    </td>
  </tr>
</table>
</body>
</html>
<?php 
 }else{
	echo "<script>alert ('No está autenticado en el sistema');</script>";
	echo "<script>window.location.href='index.php';</script>";
 }
?>
