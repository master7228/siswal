<?php
 session_start();
 if($_SESSION["autenticado"] == "1"){
	 include_once 'Usuario.php';
	 $ver_usuarios = 0;
	 if(!empty ($_POST['select']) and $_POST['select'] == "*"){
		$_POST['palabra'] = "*";
	 }
	 if(!empty($_POST['select']) && !empty($_POST['palabra']) ){
		 $usuario = new Usuario("","","","","","","","","","","","","","");
		 $resp = $usuario->buscarUsuario($_POST['select'],$_POST['palabra']);
		 $_SESSION['usuarios'] = serialize($resp);
		 $ver_usuarios = 1;
	 }
	  
	 if(!empty($_POST['tarea'])){
	 	$usuarios=unserialize($_SESSION['usuarios']);
		for($i=0; $i<count($usuarios); $i++){
			$usuario = $usuarios[$i];
			if($usuario->id==$_POST['id']){
				$_SESSION['usuario']=serialize($usuario);
				unset($_SESSION['usuarios']);
				echo "<script> window.location.href='EditarUsuario.php';</script>";
			}
		}
	 }
	 if(!empty($_POST['tarea']) && $_POST['tarea'] == 'salir'){
				session_destroy('usuario');
				echo "<script>window.location.href='MenuUsuarios.php';</script>";
			}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Buscar Usuarios</title>
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
                <td><a href="CrearUsuario.php" target="_parent"><img src="imagenes/nuevo_user.png" alt="nuevo" width="32" height="32" border="0" title="Nuevo Usuario" /></a></td>
                <td><a href="BuscarUsuarioEditar.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Usuario"/></a></td>
                <td><a href="BuscarUsuarioEditar.php"><img src="imagenes/editar.png" width="32" height="32" border="0" title="Editar Usuario" /></a></td>
                <td><a href="MenuUsuarios.php" target="_parent"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center">
			<?php if($ver_usuarios == 0){?>
			<p>&nbsp;</p>
			<table width="350" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="middle"><table width="320" height="190" style="background-image:url(imagenes/fondo_buscar.png)" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="3" align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center" class="BuscarUsuario">BUSCAR USUARIOS</td>
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
                        <option value="documento_identidad">Identificación</option>
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
						<table width="600" border="1" cellspacing="0" cellpadding="0">
						  <tr>
						    <td colspan="7" align="center"><strong>REGISTROS ENCONTRADOS </strong></td>
				          </tr>
						  <tr>
						    <td width="225" align="center">
							<input name="tarea" type="hidden" id="tarea"/>
					        <input name="id" type="hidden" id="id"/></td>
						    <td width="175">&nbsp;</td>
						    <td width="100" align="center" valign="middle">&nbsp;</td>
					      </tr>
						  <tr>
							<td width="225" align="center" bgcolor="#CCCCCC"><strong>N&uacute;mero de Identificaci&oacute;n</strong></td>
							<td width="175" align="center" bgcolor="#CCCCCC"><strong>Nombre del Usuario </strong></td>
							<td width="100" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Estado</strong></td>
						  </tr>
						  <?php
							for ($i=0; $i<count($resp); $i++){
								$usuario = $resp[$i];
							?>
							<tr align="left" class="TablaUsuarios">
								<td width="225"><?php echo $usuario->documento_identidad; ?></a></td>
								<td width="175"><?php echo ($usuario->nombres."  ".$usuario->apellidos); ?></td>
							<td width="100" align="left" valign="middle"><?php if($usuario->estado==1){echo "ACTIVO";}else{echo "INACTIVO";} ?>							  </tr>
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
