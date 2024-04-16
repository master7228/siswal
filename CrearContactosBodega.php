<?php
session_start();
include_once 'Bodega.php';
include_once 'ContactoBodega.php';
if (!empty($_SESSION["autenticado"]) && $_SESSION["autenticado"] == "1") {
    $fecha = date('Y-m-d H:i');
	$anno_actual = date('Y');
	$bodega=unserialize($_SESSION['bodega']);
	$contac = new ContactoBodega('','','','','','','','');
	$resp = $contac->buscarContacto($bodega->id);
	$_SESSION['cont']='1';
	$_SESSION['gcont']= '1';
	if($resp){
		$ver_contactos=1;
	}else{
		$ver_contactos=0;
	}
    if(!empty($_POST['tarea'])){
			$str = $_POST['nombre'];
			$str = strtoupper($str);
			$_POST['nombre']=$str;
			$str = $_POST['documento'];
			$str = strtoupper($str);
			$_POST['documento']=$str;
			$str = $_POST['email'];
			$str = strtoupper($str);
			$_POST['email']=$str;
			$str = $_POST['telefono'];
			$str = strtoupper($str);
			$_POST['telefono']=$str;
			$str = $_POST['cargo'];
			$str = strtoupper($str);
			$_POST['cargo']=$str; 
			if ($_POST['tarea'] == 'guardar') {
				echo $bodega->id;
				$contacto = new ContactoBodega('',$bodega->id,$_POST['documento'],$_POST['nombre'],$_POST['cargo'],$_POST['telefono'],$_POST['email'],'1');
				$guardar = $contacto->guardarContacto();
				if ($guardar) {
				$_SESSION['cont']='1';
				$_SESSION['gcont']= '1';
					echo "<script>alert ('El contacto fue creado con exito');</script>";
					echo "<script>window.location.href='CrearContactosBodega.php';</script>";
				} else {
					echo "<script>alert ('No se pudo crear el contacto, por favor intenta de nuevo');</script>";
				}
				
    }
 }
 	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Crear Contactos Bodega</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script src="js/validaciones.js" language="JavaScript"></script>
<script src="js/reloj.js" language="JavaScript"></script>
<style type="text/css">
<!--

-->
</style>
</head>

<body topmargin="0" onload="mueveReloj();">
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
                    <td colspan="2" align="right" valign="top">
                    	<table width="128" border="0" align="right" cellpadding="2" cellspacing="2" > 
                    	<tr> 
                    		<th width="114" scope="col"><font id="cl"><strong>0</strong></font></th> 
                    	</tr> 
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="97%" align="right" valign="middle"><span class="Estilo6">Usuario: <?php echo "".$_SESSION["nombre"].' '.$_SESSION['apellido']; ?> - <a href="logout.php"></a></span></td>
                    <td width="3%" align="right" valign="top"><a href="logout.php"><img src="imagenes/eqsl_exit.png" alt="" width="30" height="30" title="Salir" border="0" /></a></td>
                  </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="middle"><table width="100" border="0" cellspacing="0" cellpadding="0">
            <tr align="center" valign="middle">
              <td><a href="javascript:valcontactosbodega('guardar')"><img src="imagenes/guardar.png" alt="guardar" width="32" height="32" border="0" title="Guardar Informaci&oacute;n" onClick="return validarEmail(email,'email')"/></a></td>
              <td><a href="BuscarBodega.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Bodega"/></a></td>
              <td><img src="imagenes/activar_user_opaco.png" alt="activar" width="32" height="32" border="0" /></td>
              <td><img src="imagenes/desactivar_user_opaco.png" alt="desactivar" width="32" height="32" border="0" /></td>
              <td><a href="CrearBodega.php"><img src="imagenes/flecha.png" width="32" height="32" border="0" title="Regresar a Bodega" /></a></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="middle"><div align="center"></div></td>
        </tr>
      </table>
      <table width="800" border="0" align="center" cellpadding="8" cellspacing="0" style="background:url(imagenes/fondo_form.png) no-repeat; width:700px;">
        <tr>
          <td align="center" ><table width="783" border="0" cellpadding="0" cellspacing="0">
            
            <tr>
              <td align="center"><div align="center">
                <table width="744" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr align="center">
                    <td width="718" height="524" valign="top">  <table width="714" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td colspan="8" align="left" valign="middle">&nbsp;</td>
                        </tr>
                      <tr>
                        <td width="7" align="left" valign="middle">&nbsp;</td>
                        <td colspan="4" align="left">Nombre Completo</td>
                        <td width="181" align="left" valign="middle">&nbsp;&nbsp;&nbsp; Documento</td>
                        <td align="left">Cargo</td>
                        <td align="left">&nbsp;</td>
                        </tr>
                      <tr>
                        <td width="7" align="center" valign="middle">*</td>
                        <td colspan="4" align="left"><input name="nombre" type="text" class="campos_mayus" id="nombre" onkeypress="javascript:return Letras(event)" size="50" maxlength="40"/>
                          </td>
                        <td width="181" align="left" class="campos_mayus">&nbsp;
&nbsp;
  <input name="documento" type="text" id="documento" onkeypress="javascript:return Numeros(event)" maxlength="15"/></td>
                        <td align="left"> <span class="campos_mayus">
                          <input name="cargo" type="text" id="cargo" onkeypress="javascript:return Letras(event)" maxlength="20"/>
                        </span></td>
                        <td align="left">&nbsp;</td>
                        </tr>
                      <tr>
                        <td colspan="8" align="left" valign="middle">&nbsp;</td>
                        </tr>
                      <tr>
                        <td width="7" align="left" valign="middle">&nbsp;</td>
                        <td width="208" align="left">E-mail</td>
                        <td width="127" align="left">&nbsp;</td>
                        <td colspan="3" align="left"> &nbsp;&nbsp;&nbsp; Tel&eacute;fono</td>
                        <td width="172" align="left">&nbsp;</td>
                        <td width="16" align="left">&nbsp;</td>
                        </tr>
                      <tr>
                        <td height="27" align="center" valign="middle">*</td>
                        <td align="left"><input name="email" type="text" id="email" size="30" maxlength="30" />
                          <input name="tarea" type="hidden" id="tarea" /></td>
                        <td align="center">&nbsp;</td>
                        <td colspan="3" align="left">&nbsp;*
                          <input name="telefono" type="text" id="telefono" maxlength="15" class="campos_mayus" onkeypress="javascript:return Numeros(event)"/></td>
                        <td align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        </tr>
                      </table>
                      <table width="600" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td colspan="6" align="center"><strong>CONTACTOS</strong></td>
                          </tr>
                        <tr>
                          <td width="225" align="center">                                <input name="id" type="hidden" id="id"/></td><td width="175">&nbsp;</td>
                          <td width="100" align="center" valign="middle">&nbsp;</td>
                          <td width="100" align="center" valign="middle">&nbsp;</td>
                          </tr>
                        <tr align="center">
                          <td width="225" bgcolor="#CCCCCC">Nombre</td>
                          <td width="175" bgcolor="#CCCCCC">Cargo </td>
                          <td width="100" valign="middle" bgcolor="#CCCCCC">Telefono</td>
                          <td width="100" valign="middle" bgcolor="#CCCCCC">Email</td>
                          </tr>
                        <?php
							if(!empty($ver_contactos) && $ver_contactos == '1'){ 
								for ($i=0; $i<count($resp); $i++){
								$contacto = $resp[$i];
						?>
                        <tr align="left" class="TablaUsuarios">
                          <td width="225"><?php echo $contacto->nombre; ?></td>
                          <td width="175"><?php echo $contacto->cargo; ?></td>
                          <td width="100" align="center" valign="middle"><?php echo $contacto->telefono; ?></td>
                          <td width="100" align="center" valign="middle"><?php echo $contacto->email; ?></td>
                          </tr>
                        <?php } 
										}else{
											echo 'no hay contactos';
										}?>
                        </table>                      
                      <p>&nbsp;</p></td>
                    
                    </tr>
                </table>
              </div></td>
              </tr>
          </table></td>
        </tr>
      </table>
    </form></td>
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
