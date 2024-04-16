<?php
 session_start();
 if($_SESSION["autenticado"] == "1"){
	 include_once 'Remision.php';
	 include_once 'Cliente.php';
	 include_once 'Obra.php';
	 $ver_remisiones = 0;
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
		 $str = $_POST['palabra'];
		 $str = strtoupper($str);
		 $_POST['palabra']=$str;
		 $equipo = new Remision("","","","","","","","","","");
		 $resp = $equipo->verRemision($_POST['select'],$_POST['palabra']);
		 //$remision = $resp[0];
		 $_SESSION['remisiones'] = serialize($resp);
		 $ver_remisiones = 1;
	 }
	 if(!empty($_POST['tarea']) && $_POST['tarea']=='ver'){
	 	$remisiones=unserialize($_SESSION['remisiones']);
		for($i=0; $i<count($remisiones); $i++){
			$remision = $remisiones[$i];
			if($remision->id==$_POST['id']){
				$_SESSION['remision']=serialize($remision);
				unset($_SESSION['remisiones']);
				echo "<script> window.location.href='EditarRemision.php';</script>";
			}
		}
	 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Buscar Remision</title>
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
                <td><a href="CrearRemision.php"><img src="imagenes/nueva_obra.png" width="32" height="32" border="0" title="Nueva Remision" /></a></td>
                <td><a href="BuscarRemision.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Remision"/></a></td>
                <td><a href="BuscarRemisionEditar.php"><img src="imagenes/editar.png" width="32" height="32" title="Editar Remision" /></a></td>
               <!-- <td><a href="ListadoRemionesExcel.php"><img src="imagenes/exportar_excel.png" width="32" height="32" border="0" title="Exportar a Excel" /></a></td>-->
                <td><a href="MenuRemisiones.php" target="_parent"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center">
			<?php if($ver_remisiones == 0){?>
			<p>&nbsp;</p>
			<table width="350" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="middle"><table width="320" height="190" style="background-image:url(imagenes/fondo_buscar.png)" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="3" align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center" class="BuscarUsuario">BUSCAR REMISION</td>
                  </tr>
                  <tr>
                    <td colspan="3"><input name="tarea" type="hidden" id="tarea"/>
                      <input name="id" type="hidden" id="id"/></td>
                  </tr>
                  <tr>
                    <td width="47%"><span class="BuscarUsuario" >Criterio de busqueda: </span></td>
                    <td width="2%">&nbsp;</td>
                    <td width="51%"><label>
                      <select name="select" id="select" style="height: 20px; width: 150px;" onchange="verremision(this.value);">
                        <option value="id">Nro. Remision</option>
                        <option value="id_manual">Nro. Manual Remision</option>
                        <option value="*">Todas</option>
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
                    <input name="palabra" type="text" id="palabra"  class="campos_mayus" />
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
						<table width="1000" border="1" cellspacing="0" cellpadding="0">
						  <tr>
						    <td colspan="10" align="center"><strong>REGISTROS ENCONTRADOS </strong></td>
				          </tr>
						  <tr>
						    <td height="10" colspan="7" align="center">
							<input name="tarea" type="hidden" id="tarea"/>
					        <input name="id" type="hidden" id="id"/></td>
					      </tr>
                           <tr bgcolor="#999999">
							<td width="123" align="center"><strong>Nro. Remision</strong></td>
							<td width="171" align="center"><strong>Nro. Manual Remision</strong></td>
							<td width="258" align="center" valign="middle"><strong>Cliente</strong></td>
							<td width="233" align="center" valign="middle"><strong>Obra</strong></td>
							<td width="132" align="center" valign="middle"><strong>Fecha Remision</strong></td>
							<td width="69" align="center" valign="middle"><strong>Ver</strong></td>
						  </tr>
						  <?php
							for ($i=0; $i<count($resp); $i++){
								$remision = $resp[$i];
								$cliente = new Cliente("","","","","","","","","","","","","","","","","","","","","","","","","","","","");
								$cons_cliente=$cliente->buscarCliente('id',$remision->id_cliente);
								$obra = new Obra("","","","","","","","","","","","","","","","","","","","","");
								$cons_obra=$obra->buscarObraGeneral('id',$remision->id_obra);
								$cli=$cons_cliente[0];
								$obr=$cons_obra[0];
								 
							?>
						 
						  
							<tr align="left" class="TablaUsuarios">
								<td width="123" align="center"><?php echo $remision->id; ?></a></td>
								<td width="171"><?php echo $remision->id_manual; ?></td>
								<td width="258" align="left" valign="middle"><?php echo $cli->nombre1.' '.$cli->nombre2.' '.$cli->apellido1.' '.$cli->apellido2; ?></td>
							    <td width="233" align="left" valign="middle"><?php echo $obr->nombre; ?></td>
								 <td width="132" align="left" valign="middle"><?php echo $remision->fecha_rem; ?></td>
						      <td width="69" align="center" valign="middle"><a href="javascript:enviar_form_clientes('ver','<?php echo $remision->id; ?>')"><img src="imagenes/buscar.png" width="28" height="28" /></td>
							</tr>
							
							 
						<?php
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
