<?php
 session_start();
 if($_SESSION["autenticado"] == "1"){
	 include_once 'Bodega.php';
	 $ver_bodegas = 0;
	 if(!empty ($_POST['select']) and $_POST['select'] == "*"){
		$_POST['palabra'] = "*";
	 }
	 if(!empty($_POST['select']) && !empty($_POST['palabra']) ){
		 $bodega = new Bodega("","","","","","","","","","","");
		 $resp = $bodega->buscarBodega($_POST['select'],$_POST['palabra']);
		 $_SESSION['bodegas'] = serialize($resp);
		 $ver_bodegas = 1;
	 }
	  
	 if(!empty($_POST['tarea']) && $_POST['tarea']=='editar'){
	 	$bodegas=unserialize($_SESSION['bodegas']);
		for($i=0; $i<count($bodegas); $i++){
			$bodega = $bodegas[$i];
			if($bodega->id==$_POST['id']){
				$_SESSION['bodega']=serialize($bodega);
				unset($_SESSION['bodegas']);
				echo "<script> window.location.href='EditarBodega.php';</script>";
			}
		}
	 }
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Buscar Bodegas</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script src="js/validaciones.js" language="JavaScript"></script>

</head>

<body onKeyDown = "showDown(window.event)">
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
                <td><a href="ValidarBodega.php" target="_parent"><img src="imagenes/nueva_obra.png" alt="nuevo" width="32" height="32" border="0" title="Nueva Bodega" /></a></td>
                <td><a href="BuscarBodega.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Bodega"/></a></td>
                <td><a href="BuscarBodegaEditar.php"><img src="imagenes/editar.png" width="33" height="32" border="0" title="Editar Bodega" /></a></td>
                <td><a href="MenuBodega.php" target="_parent"><img src="imagenes/cancelar.png" alt="salir" width="32" height="32" border="0" title="Salir" /></a></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center">
			<?php if($ver_bodegas == 0){?>
			<p>&nbsp;</p>
			<table width="350" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="middle"><table style="background-image:url(imagenes/fondo_buscar.png)" width="320" height="190" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="3" align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center" class="BuscarUsuario">BUSCAR BODEGA PARA EDITAR </td>
                  </tr>
                  <tr>
                    <td colspan="3"><input name="tarea" type="hidden" id="tarea"/>
                      <input name="id" type="hidden" id="id"/></td>
                  </tr>
                  <tr>
                    <td width="47%"><span class="BuscarUsuario" >Criterio de busqueda: </span></td>
                    <td width="2%">&nbsp;</td>
                    <td width="51%"><label>
                      <select name="select" style="height: 20px; width: 150px;" id="select" onchange="valcampobusquedaProveedorEditar();">
                        <option value="nombre">Nombre</option>
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
			<p>
			  <?php }else{
						if(sizeof($resp)!=0){
			?>
			  </p>
			<table width="700" border="0" cellspacing="0" cellpadding="0">
			    <tr>
						    <td colspan="32" align="center"><strong>REGISTROS ENCONTRADOS </strong></td>
					      </tr>
						  <tr>
						    <td width="195" align="center">
							<input name="tarea" type="hidden" id="tarea"/>
					        <input name="id" type="hidden" id="id"/></td>
						    <td width="312">&nbsp;</td>
						    <td width="96" align="center" valign="middle">&nbsp;</td>
						    <td width="96" align="center" valign="middle">&nbsp;</td>
						    <td width="97" align="center" valign="middle">&nbsp;</td>
					      </tr>
						  <tr>
							<td width="195" align="center" bgcolor="#CCCCCC">Nombre Bodega</td>
							<td width="312" bgcolor="#CCCCCC"><div align="center">Direcci&oacute;n</div></td>
							<td width="96" align="center" valign="middle" bgcolor="#CCCCCC">Barrio</td>
							<td width="96" align="center" valign="middle" bgcolor="#CCCCCC">Estado</td>
							<td width="97" align="center" valign="middle" bgcolor="#CCCCCC">Editar</td>
						  </tr>
						  <?php
							for ($i=0; $i<count($resp); $i++){
								$bodega = $resp[$i];
							?>
							<tr align="left" class="TablaUsuarios">
								<td width="195"><?php echo $bodega->nombre; ?></a></td>
								<td width="312"><?php echo $bodega->direccion; ?></td>
								<td width="96" align="center" valign="middle"><?php if($bodega->estado==1){echo "ACTIVO";}else{echo "INACTIVO";} ?>                                
								<td width="96" align="center" valign="middle"><?php if($bodega->estado==1){echo "ACTIVO";}else{echo "INACTIVO";} ?>
							  <td width="97" align="center" valign="middle"><a href="javascript:enviar_form_clientes('editar','<?php echo $bodega->id; ?>')"><img src="imagenes/editar.png" width="28" height="28" /></a></td>
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