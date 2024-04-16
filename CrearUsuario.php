<?php
 session_start();
include_once 'Usuario.php';
include_once 'Registro.php';
if ($_SESSION["autenticado"] == "1") {
    $fecha = date('Y-m-d H:i');

    if(!empty($_POST['tarea'])){
	$str = $_POST['nombres'];
	$str = strtoupper($str);
	$_POST['nombres']=$str;
	$str = $_POST['apellidos'];
	$str = strtoupper($str);
	$_POST['apellidos']=$str;
	$str = $_POST['tipo_doc'];
	$str = strtoupper($str);
	$_POST['tipo_doc']=$str;
    if ($_POST['tarea'] == 'guardar') {
        $usuario = new Usuario('',$_POST['tipo_usuario'],$_POST['tipo_doc'],$_POST['documento'],$_POST['nombres'],$_POST['apellidos'],$_POST['email'],$_POST['telefono'],$_POST['celular'],$_POST['pass'],$fecha,$fecha,'1');
        $ConsultarUsuario=$usuario->existeUsuario();
		if(!$ConsultarUsuario){
		$guardar = $usuario->guardarUsuario();
        if ($guardar) {
			$consul = $usuario->buscarUsuario('documento_identidad',$_POST['documento']);
			$usu=$consul[0];
			$registro= new Registro('',$_SESSION['id_usuario'],'CREAR USUARIO',$usu->documento_identidad,$usu->nombres,$fecha);
			$guardar_registro = $registro->guardarRegistro();
            echo "<script>alert ('El Usuario fue creado con exito');</script>";
            echo "<script>window.location.href='BuscarUsuario.php';</script>";
        } else {
            echo "<script>alert ('No se pudo crear el usuario, por favor intenta de nuevo');</script>";
            /*echo "<script>window.location.href='CrearUsuario.php';</script>";*/
        }
		}else{
			echo "<script>alert ('El usuario ya existe, verifica por favor');</script>";
			/*echo "<script>window.location.href='CrearUsuario.php';</script>";*/
		}
    } else if ($_POST['tarea'] == 'salir') {
        echo "<script>window.location.href='logout.php';</script>";
    }
    }
 	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Crear Usuario</title>
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
              <td><a href="AdminCrearUsuario.php" target="_parent"><img src="imagenes/nuevo_user.png" alt="nuevo" width="32" height="32" border="0" title="Crear Usuario"/></a></td>
              <td><a href="javascript:valadmin('guardar')"><img src="imagenes/guardar.png" alt="guardar" width="32" height="32" border="0" title="Guardar Informaci?n" onclick="return validarEmail(email,'email')"/></a></td>
              <td><a href="BuscarUsuarioEditar.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Usuario"/></a></td>
              <td><img src="imagenes/activar_user_opaco.png" alt="activar" width="32" height="32" border="0" /></td>
              <td><img src="imagenes/desactivar_user_opaco.png" alt="desactivar" width="32" height="32" border="0" /></td>
              <td><a href="MenuUsuarios.php" target="_parent"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="middle">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" valign="middle"><strong>CREAR USUARIO</strong></td>
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
                    <td width="718" height="524" valign="top"> <table width="718" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td colspan="7" align="left" valign="middle">&nbsp;</td>
                        </tr>
                      <tr>
                        <td width="4" align="left" valign="middle">&nbsp;</td>
                        <td width="200" align="left">Tipo de Identificaci&oacute;n </td>
                        <td width="4" align="left" valign="middle">&nbsp;</td>
                        <td width="144" align="left">Numero de Identificaci&oacute;n </td>
                        <td width="7" align="left" valign="middle">&nbsp;</td>
                        <td colspan="2" align="left">Tipo de Usuario </td>
                        </tr>
                      <tr>
                        <td width="4" align="center" valign="middle">*</td>
                        <td width="200" align="left">
						<select name="tipo_doc" id="tipo_doc" style="height: 25px; width: 200px;" class="campos_mayus">
                         <option value="Cedula">Cedula</option>
						 <option value="Cedula de xtranjeria">Cedula de extranjeria</option>
						 <option value="Otro">Otro</option>
                      	</select>							
						</td>
                        <td width="4" align="center" valign="middle">*</td>
                        <td width="144" align="left"><input name="documento" type="text" id="documento" maxlength="20" onKeyPress="javascript:return Numeros(event)"/></td>
                        <td width="7" align="left" valign="middle"><div align="center">* </div></td>
                        <td colspan="2" align="left"><select name="tipo_usuario" id="tipo_usuario" class="campos_mayus" style="height: 25px; width: 180px;" onchange="activarcampos(this);" >
                            <option value=""></option>
                            <option value="1">Administrador</option>
                            <option value="2">Visor</option>
                            <option value="3">Remisor</option>
                        </select>                          <div align="center"></div></td>
                        </tr>
                      <tr>
                        <td colspan="7" align="left" valign="middle">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="4" align="left" valign="middle">&nbsp;</td>
                        <td align="left">Nombres</td>
                        <td align="left">&nbsp;</td>
                        <td colspan="2" align="left">Apellidos</td>
                        <td align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        </tr>
                      <tr>
                        <td align="center" valign="middle">*</td>
                        <td align="left"><input name="nombres" type="text" id="nombres" size="30" maxlength="100" class="campos_mayus" onKeyPress="javascript:return Letras(event)"/></td>
                        <td align="center">*</td>
                        <td colspan="2" align="left"><input name="apellidos" type="text" id="apellidos" size="30" maxlength="100" class="campos_mayus" onKeyPress="javascript:return Letras(event)"/></td>
                        <td align="left">&nbsp;</td>
                        <td align="left"><input name="tarea" type="hidden" id="tarea" class="campos_mayus" /></td>
                      </tr>
                      <tr>
                        <td align="center" valign="middle">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        <td colspan="2" align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center" valign="middle">&nbsp;</td>
                        <td align="left">Telefono </td>
                        <td align="left">&nbsp;</td>
                        <td colspan="2" align="left">Celular</td>
                        <td align="left">&nbsp;</td>
                        <td align="left">E-mail</td>
                      </tr>
                      <tr>
                        <td align="center" valign="middle">*</td>
                        <td align="left"><input name="telefono" type="text" id="telefono"  class="campos_mayus" onKeyPress="javascript:return Numeros(event)"/></td>
                        <td align="left">&nbsp;</td>
                        <td colspan="2" align="left"><input name="celular" type="text" id="celular" class="campos_mayus" onKeyPress="javascript:return Numeros(event)"/></td>
                        <td align="center">*</td>
                        <td align="left"><input name="email" type="text" id="email" size="30" /></td>
                      </tr>
                      <tr>
                        <td align="center" valign="middle">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        <td colspan="2" align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center" valign="middle">&nbsp;</td>
                        <td align="left">Contrase&ntilde;a</td>
                        <td align="left">&nbsp;</td>
                        <td colspan="2" align="left">Verificar Contrase&ntilde;a </td>
                        <td align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="4" align="center" valign="middle">*</td>
                        <td align="left"><label>
                          <input name="pass" type="password" id="pass" />
                        </label></td>
                        <td align="center">*</td>
                        <td colspan="2" align="left"><input name="veri_pass" type="password" id="veri_pass" /></td>
                        <td align="center">&nbsp;</td>
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
