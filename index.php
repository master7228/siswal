<?php
 session_start();
	include_once 'Usuario.php';

	if (isset($_GET['error'])) {
    	$mensaje = $_GET['error'];
    	if ($mensaje == 2) {
        	$mensaje = "Usuario o Clave Incorrectos";
    	}
	} else {
    	$mensaje = '';
	}
	if (isset($_POST["documento"]) && isset($_POST["pass"])) {
    	$usuario = new Usuario("", "", "", $_POST['documento'], "", "", "" , "", "", $_POST['pass'],"","","");
    	if (!empty($usuario->documento_identidad) && !empty($usuario->password)) {
        	$resp1 = $usuario->autenticar();
        	$_SESSION['usuario'] = serialize($resp1);
        	$usuarios = unserialize($_SESSION['usuario']);
        	for ($i = 0; $i < count($usuarios); $i++) {
            	$usuario1 = $usuarios[$i];
        	}
			
        	if (count($usuarios) != '') {
			$validacion=$usuario1->autenticarPermiso($usuario1->documento_identidad);
			if($validacion['estado'] == '1'){
				$_SESSION["autenticado"] = 1;
				$_SESSION["id_usuario"] = $usuario1->id;
				$_SESSION["documento"]= $usuario1->documento_identidad;
				$_SESSION["nombre"] = $usuario1->nombres;
				$_SESSION["apellido"] = $usuario1->apellidos;
				$_SESSION["tipo"] = $usuario1->id_grupo_usuarios;
				$_SESSION["pass"]= $usuario1->password;
            	//header('Location: menu.php');
            	echo"<script language='javascript'>window.location='menu.php'</script>";
				}else{
					echo "<script>alert('Este usuario está desactivado, pongase en contacto con el administrador del sistema');</script> ";
					echo '<script>window.location="index.php";</script>';
				}
        	} else {
				//echo "<br>EL USUARIO NO SE ENCUENTRA REGISTRADO";
				//header('Location: index.php?error=2');
				echo"<script language='javascript'>window.location='index.php?error=2'</script>";
        }
		
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/js/validaciones.js"></script>
<title>Autenticaci&oacute;n de usuario</title>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="middle"><div align="center"><img src="imagenes/logoge.png" alt="himed" width="200" height="80" /></div></td>
  </tr>
  <tr>
    <td height="300" align="center" valign="middle">
	<form id="form1" name="form1" method="POST" action="">
	  <div align="center">
	    <table width="350" height="200" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td align="center" background="imagenes/fondo_login.jpg"><table width="250" border="0" cellpadding="0" cellspacing="0">
                <tr>
               <td colspan="2" align="center" class="Estilo1"><img src="imagenes/login.png" width="242" height="195"/></td>
                  </tr>
                <tr>
                  <td class="Estilo4">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left" class="Estilo4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="3">&nbsp;</td>
                      <td width="82" align="left" class="Estilo4"><span class="style1">Usuario: </span></td>
                    </tr>
                  </table></td>
                  <td align="left"><label>
                    <input name="documento" type="text" id="documento" />
                  </label></td>
                </tr>
                <tr>
                  <td colspan="2" align="center">&nbsp;</td>
                </tr>
                <tr>
                  <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="10">&nbsp;</td>
                      <td width="138" align="left"><span class="style2">Clave: </span></td>
                    </tr>
                  </table></td>
                  <td align="left"><input name="pass" type="password" id="pass" /></td>
                </tr>
                <tr>
                  <td colspan="2" align="center">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" align="center"><input type="submit" name="Submit" value="Entrar" /></td>
                </tr>
                <tr>
                  <td colspan="2" align="center">&nbsp;</td>
                </tr>
              </table>
              <label></label></td>
            </tr>
        </table>
	    </div>
	</form>    </td>
  </tr>
  <tr>
    <td align="center" valign="middle"><div align="center"></div></td>
  </tr>
  <tr>
    <td align="center" valign="middle" class="Estilo1"><div align="center"><?php echo $mensaje;?></div></td>
  </tr>
</table>
</body>
</html>

