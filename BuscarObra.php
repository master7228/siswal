<?php
 session_start();
 if($_SESSION["autenticado"] == "1"){
	 include_once 'Obra.php';
	 include_once 'ContactoObra.php';
	 $ver_obras = 0;
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
	 if(!empty($_POST['select']) && !empty($_POST['palabra']) ){
		 $obra = new Obra("","","","","","","","","","","","","","","","","","","","","");
		 $resp = $obra->buscarObra($_POST['select'],$_POST['palabra'],'');
		 $_SESSION['obras'] = serialize($resp);
		 $ver_obras = 1;
	 }

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Buscar Obras</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script src="js/validaciones.js" language="JavaScript"></script>
<script src="js/reloj.js" language="JavaScript"></script>
</head>

<body onLoad="mueveReloj();" onKeyDown = "showDown(window.event)">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><form id="form1" name="form1" method="post" action="" class="TablaUsuarios">
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
                          <td width="50"><a href="logout.php"><img src="imagenes/eqsl_exit.png" width="30" height="30" border="0" title="salir" /></a></td>
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
                <td><a href="BuscarClienteObra.php"><img src="imagenes/nueva_obra.png" width="32" height="32" border="0" title="Nueva Obra" /></a></td>
                <td><a href="BuscarObra.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Obra"/></a></td>
                <td><img src="imagenes/editar.png" width="32" height="32" title="Editar Obra" /></td>
                <!--<td><a href="ListadoObrasExcel.php"><img src="imagenes/exportar_excel.png" width="32" height="32" border="0" title="Exportar a Excel" /></a></td>-->
                <td><a href="MenuObras.php" target="_parent"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center">
			<?php if($ver_obras == 0){?>
			<p>&nbsp;</p>
			<table width="350" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="middle"><table width="320" height="190" style="background-image:url(imagenes/fondo_buscar.png)" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="3" align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center" class="BuscarUsuario">BUSCAR OBRA </td>
                  </tr>
                  <tr>
                    <td colspan="3"><input name="tarea" type="hidden" id="tarea"/>
                      <input name="id" type="hidden" id="id"/></td>
                  </tr>
                  <tr>
                    <td width="47%"><span class="BuscarUsuario" >Criterio de busqueda: </span></td>
                    <td width="2%">&nbsp;</td>
                    <td width="51%"><label>
                      <select name="select" id="select" style="height: 20px; width: 150px;" onchange="valcampobusquedaObra(this.value);">
                        <option value="nombre">Nombre Obra</option>
                        <option value="nombre_cliente">Nombre Cliente</option>
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
                    <input name="palabra" type="text" class="campos_mayus" id="palabra" />
</label></td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center"><input type="submit" name="Submit" value="Buscar" /></td>
                    </tr>
                  <tr>
                    <td colspan="3" align="center">&nbsp;</td>
                  </tr>
                  
                </table></td>
              </tr>
            </table>
			<?php }else{
						if(sizeof($resp)!=0){
			?>
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
