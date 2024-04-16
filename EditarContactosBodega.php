<?php
session_start();
include_once 'Bodega.php';
include_once 'ContactoBodega.php';
if ($_SESSION["autenticado"] == "1") {
    $fecha = date('Y-m-d H:i');
	$_SESSION['var']='1';
	$anno_actual = date('Y');
	$bodega=unserialize($_SESSION['bodega']);
	$contacto = new ContactoBodega('','','','','','','','','','');
	$resp = $contacto->buscarContacto($bodega->id);
	if($resp){
		$ver_contactos=1;
	}else{
		$ver_contactos=0;
	}
	
    if(!empty($_POST['tarea'])){
			$str = $_POST['nombre'];
			$str = strtoupper($str);
			$_POST['nombre']=$str;
			$str = $_POST['cargo'];
			$str = strtoupper($str);
			$_POST['cargo']=$str;
			$str = $_POST['email'];
			$str = strtoupper($str);
			$_POST['email']=$str;
			
			if ($_POST['tarea'] == 'guardar'){
			if($_SESSION['funcion']!='1'){
				$contacto = new ContactoBodega('',$bodega->id,$_POST['documento'],$_POST['nombre'],$_POST['cargo'],$_POST['telefono'],$_POST['email'],'1');
				$guardar = $contacto->guardarContacto();
				unset($_SESSION['funcion']);
				if ($guardar) {
					$_SESSION['cont']='1';
					echo "<script>alert ('El Contacto fue creado con exito');</script>";
					echo "<script>window.location.href='EditarContactosBodega.php';</script>";
				} else {
					$_SESSION['cont']='2';
					echo "<script>alert ('No se pudo crear el contacto, por favor intenta de nuevo');</script>";
				}
			}
			if($_SESSION['funcion']=='1'){
				$conta = unserialize($_SESSION['conta']);
				$contacto = new ContactoBodega('','',$_POST['documento'],$_POST['nombre'],$_POST['cargo'],$_POST['telefono'],$_POST['email'],'1');
				$edit = $contacto->editarContacto($conta->id);
				unset($_SESSION['funcion']);
				if ($edit) {
					$_SESSION['cont']='1';
					echo "<script>alert ('El Contacto fue editado con exito');</script>";
					echo "<script>window.location.href='EditarContactosBodega.php';</script>";
				} else {
					$_SESSION['cont']='2';
					echo "<script>alert ('No se pudo editar el contacto, por favor intenta de nuevo');</script>";
				}
			}
    }
	
	if ($_POST['tarea'] == 'editar') {
		$contacto = new ContactoBodega('','',$_POST['documento'],$_POST['nombre'],$_POST['cargo'],$_POST['telefono'],$_POST['email'],'1');
		$resp1 = $contacto->buscarContactoId($_POST['id']);
		if ($resp1){
			$cont= $resp1[0];
			$_SESSION['conta']=serialize($cont);
			$ver_contacto='1';
			$_SESSION['funcion']='1';
		}
	}
	
	if(!empty($_POST['tarea']) and $_POST['tarea']=='activar'){
			$conta = unserialize($_SESSION['conta']);
			$contacto = new ContactoBodega("", "", "", "", "", "", "", "");
			$estado = $contacto->activarDesactivarContacto('1', $conta->id);
			$contacto->estado="1";
			if($estado){
				$_SESSION['contacto']=serialize($contacto);
				echo "<script>alert('El Contaco ha sido activado correctamente');</script> ";
				echo '<script>window.location="EditarContactosBodega.php";</script>';
			}else{
				echo "<script>alert('El Contacto no pudo ser activado, intentelo nuevamente');</script> ";
				echo '<script>window.location="EditarContactosBodega.php";</script>';
			}
		}
		
		if(!empty($_POST['tarea']) and $_POST['tarea']=='desactivar'){
			$conta = unserialize($_SESSION['conta']);
			$contacto = new ContactoBodega("", "", "", "", "", "", "", "");
			$estado = $contacto->activarDesactivarContacto('0', $conta->id);
			$contacto->estado="0";
			if($estado){
				$_SESSION['contacto']=serialize($contacto);
				/*echo "<script>alert('El Contacto ha sido desactivado correctamente');</script> ";*/
				echo '<script>window.location="EditarContactosBodega.php";</script>';
			}else{
				echo "<script>alert('El Contacto no pudo ser desactivado, intentelo nuevamente');</script> ";
				echo '<script>window.location="EditarContactosBodega.php";</script>';
			}
			$resppp = $contacto->buscarContacto($conta->id);
			$cont= $resppp[0];
			if($cont->estado==0){
				$_SESSION['funcion']=2;
			}
		}
		
		if(!empty($_POST['tarea']) and $_POST['tarea']=='listado'){
			$conta = unserialize($_SESSION['conta']);
			$contacto = new ContactoBodega("", "", "", "", "", "", "", "");
			$estado = $contacto->activarDesactivarContacto('0', $conta->id);
			$contacto->estado="0";
			if($estado){
				$_SESSION['contacto']=serialize($contacto);
				echo "<script>alert('El Contacto ha sido desactivado correctamente');</script> ";
				echo '<script>window.location="EditarContactosBodega.php";</script>';
			}else{
				echo "<script>alert('El Contacto no pudo ser desactivado, intentelo nuevamente');</script> ";
				echo '<script>window.location="EditarContactosBodega.php";</script>';
			}
		}
 }
 	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Editar Contactos de la Bodega</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script src="js/validaciones.js" language="JavaScript"></script>
<script src="js/reloj.js" language="JavaScript"></script>

<style type="text/css">
<!--
.style1 {font-size: 14px}

-->
</style>
</head>

<body bgcolor="#efecff" topmargin="0" onLoad="mueveReloj();" onKeyDown = "showDown(window.event)">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><form action="" method="post" name="form1" class="FormGeneral" id="form1" target="_parent" enctype="multipart/form-data">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="middle"><table width="100%" height="35" border="0">
            <tr>
              <td width="196"><img src="imagenes/logoge.png" alt="Himed" width="200" height="40" /></td>
              <td align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td colspan="2" align="right" valign="middle"><table width="128" border="0" align="right" cellpadding="2" cellspacing="2" >
                          <tr>
                            <th width="114" scope="col"><font id="cl"><strong>0</strong></font></th>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td width="93%" align="right" valign="middle"><span class="Estilo6">Usuario: <?php echo "".$_SESSION["nombre"].' '.$_SESSION['apellido']; ?> - <a href="logout.php"></a></span></td>
                        <td width="7%" align="center" valign="middle"><a href="logout.php"><img src="imagenes/eqsl_exit.png" width="30" height="30" border="0" title="Salir" /></a></td>
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
              <td><a href="javascript:valeditcontactosbodega('guardar')"><img src="imagenes/guardar.png" alt="guardar" width="32" height="32" border="0" title="Guardar Informacion" onclick="return validarEmail(email,'email')"/></a></td>
              <td><a href="BuscarBodega.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Bodega"/></a></td>
              <?php if(!empty($_SESSION['funcion']) && $_SESSION['funcion']=='1'){ ?>
			  		<td><a href="javascript:valeditcontactos('desactivar')"><img src="imagenes/desactivar_user.png" alt="activar" width="32" height="32" border="0" /></a></td>
				<?php } else {?>
					<td><img src="imagenes/desactivar_user_opaco.png" alt="activar" width="32" height="32" border="0" /></td>
				<?php } ?>
              <td><a href="EditarBodega.php"><img src="imagenes/flecha.png" width="32" height="32" border="0" title="Volver a Bodega" /></a></td>
			  <td><a href="ListadoContactosDesactivadosBodega.php"><img src="imagenes/desactivados1.png" width="34" height="36" border="0" title="Contactos Desactivados" /></a></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center" valign="middle"><span class="style1">EDITAR CONTACTOS DE LA BODEGA</span></td>
        </tr>
        <tr>
          <td align="left" valign="middle">&nbsp;</td>
        </tr>
      </table>
      <table width="800" height="auto" border="0" cellspacing="0" cellpadding="8" style="background:url(imagenes/fondo_form.png) no-repeat;">
        <tr>
          <td align="center"><table width="783" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="819" align="center">&nbsp;</td>
              </tr>
            <tr>
              <td align="center"><table width="744" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr align="center">
                    <td width="718" height="524" valign="top">  <table width="707" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td colspan="8" align="left" valign="middle">&nbsp;</td>
                        </tr>
                      <tr>
                        <td width="12" align="left" valign="middle">&nbsp;</td>
                        <td colspan="4" align="left">Nombre Completo</td>
                        <td width="209" align="left" valign="middle">Documento</td>
                        <td colspan="2" align="left">Cargo</td>
                        </tr>
                      <tr>
                        <td width="12" align="center" valign="middle">*</td>
                        <td colspan="4" align="left"><input name="nombre" type="text" id="nombre" size="50" class="campos_mayus" <?php if(!empty($ver_contacto) && $ver_contacto=='1'){ ?> value=  '<?php echo $cont->nombre;} ?>' onkeypress="javascript:return Letras(event)"/>
						</td>
                        <td width="209" align="left" valign="middle"><input name="documento" type="text" id="documento" maxlength="100" class="campos_mayus" <?php if(!empty($ver_contacto) && $ver_contacto=='1'){ ?> value='<?php echo $cont->documento; } ?>' onkeypress="javascript:return Numeros(event)"/></td>
                        <td colspan="2" align="left"><input name="cargo" type="text" class="campos_mayus" id="cargo" <?php if(!empty($ver_contacto) && $ver_contacto=='1'){ ?> value= "<?php echo $cont->cargo ; } ?>" onkeypress="javascript:return Letras(event)"/>                          
                          <div align="center"></div></td>
                        </tr>
                      <tr>
                        <td colspan="8" align="left" valign="middle">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="12" align="left" valign="middle">&nbsp;</td>
                        <td width="285" align="left">E-mail</td>
                        <td width="23" align="left">&nbsp;</td>
                        <td colspan="3" align="left"> &nbsp;&nbsp;&nbsp;&nbsp; Tel&eacute;fono</td>
                        <td width="117" align="left">&nbsp;</td>
                        <td width="43" align="left">&nbsp;</td>
                        </tr>
                      <tr>
                        <td align="center" valign="middle">*</td>
                        <td align="left"><input name="email" type="text" id="email" size="30" maxlength="100" <?php if(!empty($ver_contacto) && $ver_contacto=='1'){ ?> value='<?php echo $cont->email; } ?>' />
                          <input name="tarea" type="hidden" id="tarea" /></td>
                        <td align="center">&nbsp;</td>
                        <td colspan="5" align="left">&nbsp;&nbsp;*      <input name="telefono" type="text" id="telefono" maxlength="100" class="campos_mayus" <?php if(!empty($ver_contacto) && $ver_contacto=='1'){ ?> value='<?php echo $cont->telefono; } ?>' onkeypress="javascript:return Numeros(event)"/></td>
                        </tr>
                      <tr>
                        <td align="center" valign="middle">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        <td colspan="3" align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                      </tr>
                    </table>
                      <table width="600" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td colspan="7" align="center"><strong>CONTACTOS</strong></td>
                          </tr>
                        <tr>
                          <td width="225" align="center">                                <input name="id" type="hidden" id="id"/>
                            <input name="funcion" type="hidden" id="funcion" /></td><td width="175">&nbsp;</td>
                          <td width="100" align="center" valign="middle">&nbsp;</td>
                          <td width="100" align="center" valign="middle">&nbsp;</td>
                          <td width="100" align="center" valign="middle">&nbsp;</td>
                          </tr>
                        <tr align="center">
                          <td width="225" bgcolor="#CCCCCC">Nombre</td>
                          <td width="175" bgcolor="#CCCCCC">Cargo </td>
                          <td width="100" valign="middle" bgcolor="#CCCCCC">Telefono</td>
                          <td width="100" valign="middle" bgcolor="#CCCCCC">Email</td>
                          <td width="100" valign="middle" bgcolor="#CCCCCC">Editar</td>
                          </tr>
                        <?php
						if(!empty($ver_contactos) && $ver_contactos == '1'){ 
							for ($i=0; $i<count($resp); $i++){
								$contacto = $resp[$i];
								if($contacto->estado == '1'){
						?>
                        <tr align="left" class="TablaUsuarios">
                          <td width="225"><?php echo $contacto->nombre; ?></td>
                          <td width="175"><?php echo $contacto->cargo; ?></td>
                          <td width="100" align="center" valign="middle"><?php echo $contacto->telefono; ?></td>
                          <td width="100" align="center" valign="middle"><?php echo $contacto->email; ?></td>
                          <td width="100" align="center" valign="middle"><a href="javascript:enviar_form_edit_contactos_bodega('editar','<?php echo $contacto->id; ?>')"><img src="imagenes/editar.png" width="28" height="28" border="0" /></a></td>
                          </tr>
                        <?php 	} 
							} 
						}else{
							echo 'no hay contactos';
						} 
						?>
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
