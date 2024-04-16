<?php
 session_start();
 if($_SESSION["autenticado"] == "1"){
	 include_once 'Vendedor.php';
	 $ver_vendedores = 0;
	 if(!empty ($_POST['select']) and $_POST['select'] == "*"){
		$_POST['palabra'] = "*";
	 }
	 if(!empty($_POST['select']) && !empty($_POST['palabra']) ){
		 $vendedor = new Vendedor("","","","","","","");
		 $resp = $vendedor->buscarVendedor($_POST['select'],$_POST['palabra']);
		 $_SESSION['vendedores'] = serialize($resp);
		 $ver_vendedores = 1;
	 }
	  
	 if(!empty($_POST['tarea']) and $_POST['tarea']=='editar' ){
	 	$vendedores=unserialize($_SESSION['vendedores']);
		for($i=0; $i<count($vendedores); $i++){
			$vendedor = $vendedores[$i];
			if($vendedor->id==$_POST['id']){
				$_SESSION['vendedor']=serialize($vendedor);
				unset($_SESSION['vendedores']);
				echo "<script> window.location.href='EditarVendedor.php';</script>";
			}
		}
	 }
	 if(!empty($_POST['tarea']) && $_POST['tarea'] == 'salir'){
				session_destroy('vendedor');
				echo "<script>window.location.href='MenuVendedores.php';</script>";
			}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Buscar Vendedor</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script src="js/validaciones.js" language="JavaScript"></script>
<script src="js/reloj.js" language="JavaScript"></script>
</head>

<body onLoad="mueveReloj();">
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
                <td><a href="CrearVendedor.php" target="_parent"><img src="imagenes/nuevo_user.png" alt="nuevo" width="32" height="32" border="0" title="Nuevo Vendedor" /></a></td>
                <td><a href="BuscarVendedor.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Vendedor"/></a></td>
                <td><a href="MenuVendedores.php" target="_parent"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center">
			<?php if($ver_vendedores == 0){?>
			<p>&nbsp;</p>
			<table width="350" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="middle"><table width="320" height="190" style="background-image:url(imagenes/fondo_buscar.png)" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="3" align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center" class="BuscarUsuario">BUSCAR VENDEDORES</td>
                  </tr>
                  <tr>
                    <td colspan="3"><input name="tarea" type="hidden" id="tarea"/>
                      <input name="id" type="hidden" id="id"/></td>
                  </tr>
                  <tr>
                    <td width="47%"><span class="BuscarUsuario" >Criterio de busqueda: </span></td>
                    <td width="2%">&nbsp;</td>
                    <td width="51%"><label>
                      <select name="select" id="select" style="height: 20px; width: 150px;" onchange="valcampobusquedaUsuario(this.value);">
                        <option value="documento">Identificación</option>
                        <option value="nombres">Nombre</option>
                        <option value="apellidos">Apellidos</option>
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
                    <input name="palabra" type="text" id="palabra" />
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
						<table width="700" border="1" cellspacing="0" cellpadding="0">
						  <tr>
						    <td colspan="7" align="center"><strong>REGISTROS ENCONTRADOS </strong></td>
				          </tr>
						  <tr>
						    <td width="161" align="center">
							<input name="tarea" type="hidden" id="tarea"/>
					        <input name="id" type="hidden" id="id"/></td>
						    <td width="305">&nbsp;</td>
						    <td width="133" align="center" valign="middle">&nbsp;</td>
                            <td width="91" align="center" valign="middle">&nbsp;</td>
                            <td width="91" align="center" valign="middle">&nbsp;</td>
					      </tr>
						  <tr>
							<td width="161" align="center" bgcolor="#CCCCCC"><strong>Nro. de Identificaci&oacute;n</strong></td>
							<td width="305" align="center" bgcolor="#CCCCCC"><strong>Nombre del Vendedor </strong></td>
                            <td width="133" align="center" bgcolor="#CCCCCC"><strong>Nro. de Celular </strong></td>
							<td width="91" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Estado</strong></td>
                            <td width="91" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Editar</strong></td>
						  </tr>
						  <?php
							for ($i=0; $i<count($resp); $i++){
								$vendedor = $resp[$i];
							?>
							<tr align="left" class="TablaUsuarios">
								<td width="161"><?php echo $vendedor->documento; ?></a></td>
								<td width="305"><?php echo ($vendedor->nombres."  ".$vendedor->apellidos); ?></td>
                                <td width="133"><?php echo $vendedor->celular; ?></td>
								<td width="91" align="left" valign="middle"><?php if($vendedor->estado==1){echo "ACTIVO";}else{echo "INACTIVO";} ?>	
                                <td width="100" align="center" valign="middle"><a href="javascript:eviar_form_usuarios('editar','<?php echo $vendedor->id; ?>')"><img src="imagenes/editar.png" width="30" height="30" /></a></td>						  </tr>
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
