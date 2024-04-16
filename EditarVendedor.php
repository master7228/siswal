<?php
 session_start();
include_once 'Vendedor.php';
include_once 'Registro.php';
include_once 'Documento.php';
if ($_SESSION["autenticado"] == "1") {
    $fecha = date('Y-m-d H:i');
	$vendedor=unserialize($_SESSION['vendedor']);
	$documento = new Documento('','','');
	$documentos = $documento->getDocumentos();
    if(!empty($_POST['tarea'])){
		if($vendedor->estado == '1'){
			$str = $_POST['nombres'];
			$str = strtoupper($str);
			$_POST['nombres']=$str;
			$str = $_POST['apellidos'];
			$str = strtoupper($str);
			$_POST['apellidos']=$str;
			$str = $_POST['tipo_doc'];
			$str = strtoupper($str);
			$_POST['tipo_doc']=$str;
		}
    if ($_POST['tarea'] == 'guardar') {
		if($vendedor->documento != $_POST['documento']){
			$ConsultarVendedor=$vendedor->existeVendedor($_POST['documento']);
			if(!$ConsultarVendedor){
				$vend = new Vendedor('', $_POST['tipo_doc'],$_POST['documento'],$_POST['nombres'],$_POST['apellidos'],$_POST['celular'],'1');
				$guardar = $vend->editarVendedor($vendedor->documento);
				if ($guardar) {
					$consul = $vend->buscarVendedor('documento',$_POST['documento']);
					$ven=$consul[0];
					$registro= new Registro('',$_SESSION['id_usuario'],'EDITAR VENDEDOR',$ven->documento,$ven->nombres,$fecha);
					$guardar_registro = $registro->guardarRegistro();
					echo "<script>alert ('El Vendedor fue editado con exito');</script>";
					echo "<script>window.location.href='MenuVendedores.php';</script>";
				} else {
					echo "<script>alert ('No se pudo editar el vendedor, por favor intenta de nuevo');</script>";
					/*echo "<script>window.location.href='CrearUsuario.php';</script>";*/
				}
			}else{
				echo "<script>alert ('El Vendedor con este documento ya existe, verifica por favor');</script>";
				echo "<script>window.location.href='EditarVendedor.php';</script>";
			}
		}else{
			$vend = new Vendedor('', $_POST['tipo_doc'],$_POST['documento'],$_POST['nombres'],$_POST['apellidos'],$_POST['celular'],'1');
			$guardar = $vend->editarVendedor($vendedor->documento);
			if ($guardar) {
				$consul = $vend->buscarVendedor('documento',$_POST['documento']);
				$ven=$consul[0];
				$registro= new Registro('',$_SESSION['id_usuario'],'EDITAR VENDEDOR',$ven->documento,$ven->nombres,$fecha);
				$guardar_registro = $registro->guardarRegistro();
				echo "<script>alert ('El Vendedor fue editado con exito');</script>";
				echo "<script>window.location.href='MenuVendedores.php';</script>";
			}else{
				echo "<script>alert ('No se pudo editar el vendedor, por favor intenta de nuevo');</script>";
			}
		}
	}
	
	if(!empty($_POST['tarea']) and $_POST['tarea']=='activar'){
		$est_vendedor= new Vendedor("", "", "", "", "", "", "");
		$estado = $est_vendedor->activarDesactivarVendedor('1', $vendedor->documento);
		$vendedor->estado="1";
		if($estado){
			$consul = $vendedor->buscarVendedor('documento',$vendedor->documento);
			$ven=$consul[0];
			$registro= new Registro('',$_SESSION['id_usuario'],'ACTIVAR VENDEDOR',$ven->documento,$ven->nombres,$fecha);
			$guardar_registro = $registro->guardarRegistro();
			$_SESSION['vendedor']=serialize($vendedor);
			echo "<script>alert('El Vendedor ha sido activado correctamente');</script> ";
			echo '<script>window.location="EditarVendedor.php";</script>';
		}else{
			echo "<script>alert('El Vendedor no pudo ser activado, intentelo nuevamente');</script> ";
			echo '<script>window.location="EditarVendedor.php";</script>';
		}
	}
	
	if(!empty($_POST['tarea']) and $_POST['tarea']=='desactivar'){
		$est_vendedor= new Vendedor("", "", "", "", "", "", "");
		$estado = $est_vendedor->activarDesactivarVendedor('2', $_POST['documento']);
		$vendedor->estado="2";
		if($estado){
			$consul = $vendedor->buscarVendedor('documento',$_POST['documento']);
			$ven=$consul[0];
			$registro= new Registro('',$_SESSION['id_usuario'],'DESACTIVAR VENDEDOR',$ven->documento,$ven->nombres,$fecha);
			$guardar_registro = $registro->guardarRegistro();
			$_SESSION['vendedor']=serialize($vendedor);
			echo "<script>alert('El Vendedor ha sido desactivado correctamente');</script> ";
			echo '<script>window.location="EditarVendedor.php";</script>';
		}else{
			echo "<script>alert('El Vendedor no pudo ser desactivado, intentelo nuevamente');</script> ";
			echo '<script>window.location="EditarVendedor.php";</script>';
		}
	}
	
	if ($_POST['tarea'] == 'salir') {
        echo "<script>window.location.href='logout.php';</script>";
    }
 }
 	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Editar Vendedor</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script src="js/validaciones.js" language="JavaScript"></script>
<script src="js/reloj.js" language="JavaScript"></script>
<style type="text/css">
<!--

-->
</style>
</head>

<body topmargin="0" onLoad="mueveReloj();" onKeyDown = "showDown(window.event)">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><form action="" method="post" name="form1" class="FormGeneral" id="form1">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="middle"><table width="100%" height="35" border="0">
            <tr>
              <td width="196"><img src="imagenes/logoge.png" alt="Himed" width="200" height="40" /></td>
              <td align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="2" align="right" valign="middle">
                    	<table width="128" border="0" align="right" cellpadding="2" cellspacing="2" > 
                    	<tr> 
                    		<th width="114" scope="col"><font id="cl"><strong>0</strong></font></th> 
                    	</tr> 
                    </table> 
                    </td>
                    </tr>
                  <tr>
                    <td width="93%" align="right" valign="middle"><span class="Estilo6">Usuario: <?php echo "".$_SESSION["nombre"].' '.$_SESSION['apellido']; ?> - <a href="logout.php"></a></span></td>
                    <td width="7%" align="center" valign="middle"><a href="logout.php"><img src="imagenes/eqsl_exit.png" width="30" height="30" border="0" title="Salir" /></a></td>
                  </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="middle"><table width="100" border="0" cellspacing="0" cellpadding="0">
            <tr align="center" valign="middle">
              <td><a href="CrearVendedor.php" target="_parent"><img src="imagenes/nuevo_user.png" alt="nuevo" width="32" height="32" border="0" title="Crear Vendedor"/></a></td>
              <td><a href="javascript:valvendedor('guardar')"><img src="imagenes/guardar.png" alt="guardar" width="32" height="32" border="0" title="Guardar Informacion" onclick="return validarEmail(email,'email')"/></a></td>
              <td><a href="BuscarVendedor.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Vendedor"/></a></td>
              <?php if($vendedor->estado == '1'){ ?>
              	<td><img src="imagenes/activar_user_opaco.png" alt="activar" width="32" height="32" border="0" /></td>
              <?php }else{ ?>
              	<td><a href="javascript:valvendedor('activar')"><img src="imagenes/activar_user.png" alt="activar" width="32" height="32" border="0" /></a></td>
              <?php } ?>
              <?php if($vendedor->estado == '2'){ ?> 
              <td><img src="imagenes/desactivar_user_opaco.png" alt="desactivar" width="32" height="32" border="0" /></td>
              <?php }else{ ?>
              <td><a href="javascript:valvendedor('desactivar')"><img src="imagenes/desactivar_user.png" alt="desactivar" width="32" height="32" border="0" /></a></td>
			  <?php } ?>
              <td><a href="MenuVendedores.php" target="_parent"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="middle">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" valign="middle"><strong>EDITAR VENDEDOR</strong></td>
        </tr>
      </table>
      <table width="630" height="auto" border="0" cellspacing="0" cellpadding="8" style="background:url(imagenes/fondo_form_600.png) no-repeat;">
        <tr>
          <td align="center"><table width="630" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="630" align="center">&nbsp;</td>
              </tr>
            <tr>
              <td align="center"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr align="center">
                    <td width="718" valign="top"> <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td colspan="7" align="left" valign="middle">&nbsp;</td>
                        </tr>
                      <tr>
                        <td width="7" align="left" valign="middle">&nbsp;</td>
                        <td width="211" align="left">Tipo de Identificaci&oacute;n </td>
                        <td width="7" align="left" valign="middle">&nbsp;</td>
                        <td width="146" align="left">Numero de Identificaci&oacute;n </td>
                        <td width="11" align="left" valign="middle">&nbsp;</td>
                        <td width="210" colspan="2" align="left">Celular </td>
                        </tr>
                      <tr>
                        <td width="7" align="center" valign="middle">*</td>
                        <td width="211" align="left">
						<select name="tipo_doc" id="tipo_doc" class="campos_mayus"  onchange="valcamposcliente();" onFocus="valcamposcliente();" <?php if($vendedor->estado=='2'){echo 'disabled';} ?> >
								<?php 
										for($i=1;$i<sizeof($documentos);$i+=2) {
										if($vendedor->tipo_doc == $documentos[$i+1]){
											echo "<option selected=\"selected\" value=\"".$documentos[$i+1]."\">".$documentos[$i+2]."</option>\n";
										}else{
											echo "<option value=\"".$documentos[$i+1]."\">".$documentos[$i+2]."</option>\n";
										}
									}
									$documento = $vendedor->documento;
								?>
								</select>							
						</td>
                        <td width="7" align="center" valign="middle">*</td>
                        <td width="146" align="left"><input name="documento" type="text" id="documento" maxlength="20" onKeyPress="javascript:return Numeros(event)" value="<?php echo $vendedor->documento; ?>" <?php if($vendedor->estado=='2'){echo 'disabled';} ?>/></td>
                        <td width="11" align="left" valign="middle"><div align="center">* </div></td>
                        <td colspan="2" align="left"><input name="celular" type="text" id="celular"  class="campos_mayus" onkeypress="javascript:return Numeros(event)" value="<?php echo $vendedor->celular; ?>" <?php if($vendedor->estado=='2'){echo 'disabled';} ?>/>
                          <input name="tarea" type="hidden" id="tarea" class="campos_mayus" /></td>
                        </tr>
                      <tr>
                        <td colspan="7" align="left" valign="middle">&nbsp;</td>
                      </tr>
                      </table>
                      <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="7" align="left" valign="middle">&nbsp;</td>
                        <td width="270" align="left">Nombres</td>
                        <td colspan="2" align="left">&nbsp;</td>
                        <td width="327" align="left">Apellidos</td>
                        <td width="6" align="left">&nbsp;</td>
                        </tr>
                      <tr>
                        <td align="center" valign="middle">*</td>
                        <td align="left"><input name="nombres" type="text" id="nombres" size="38" maxlength="100" class="campos_mayus" onKeyPress="javascript:return Letras(event)" value="<?php echo $vendedor->nombres; ?>" <?php if($vendedor->estado=='2'){echo 'disabled';} ?>/></td>
                        <td colspan="2" align="right">*</td>
                        <td align="left"><input name="apellidos" type="text" id="apellidos" size="38" maxlength="100" class="campos_mayus" onkeypress="javascript:return Letras(event)" value="<?php echo $vendedor->apellidos; ?>" <?php if($vendedor->estado=='2'){echo 'disabled';} ?>/></td>
                        <td align="left">&nbsp;</td>
                      </tr>
                    </table>
                      <p>&nbsp;</p></td>
                    </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
      </table>
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
