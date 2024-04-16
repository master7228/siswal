<?php
 session_start();
 if($_SESSION["autenticado"] == "1"){
	 include_once 'Usuario.php';
	
	 if(!empty($_POST['nuevo_pass'])){
		 $usuario= new Usuario("","","","","","","","","","","","","");
		 if($_POST['tarea']=='guardar'){
			 if(md5($_POST['pass_ant'])==$_SESSION['pass']){
				$cambio=$usuario->cambiarPassword($_POST['nuevo_pass'],$_SESSION['documento']);
				if($cambio!=0){
					echo "<script>alert('La contraseña ha sido cambiada correctamente')</script>";
					echo "<script>window.location.href='menu.php';</script>";
				}else{
					echo "<script>alert('La contraseña no pudo ser cambiada, intentelo nuevamente')</script>";
					echo "<script>window.location.href='CambiarContUsuario.php';</script>";
				}	
			}else{
				echo "<script>alert('La contraseña ingresada no es correcta, intentelo nuevamente')</script>";
				echo "<script>window.location.href='CambiarContUsuario.php';</script>";
			}
		}
	} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cambiar Contrase&ntilde;a de Usuarios</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script src="js/validaciones.js" language="JavaScript"></script>
<script src="js/reloj.js" language="JavaScript"></script>
<style type="text/css">
<!--
.Estilo9 {
	font-size: 14px;
	font-weight: bold;
	color: #FFFFFF;
}
.Estilo11 {font-size: 14}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.Estilo12 {
	font-size: 13px;
	font-weight: bold;
	color: #FFFFFF;
}
.Estilo6 {font-size: 11px}
-->
</style>
</head>

<body onLoad="mueveReloj();">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><form id="form1" name="form1" method="post" action="">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="middle"><table width="100%" height="35" border="0">
              <tr>
                <td width="196"><img src="imagenes/logoge.png" alt="Himed" width="200" height="40" /></td>
                <td align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr align="right" valign="middle">
                      <td colspan="2">
                      	<table width="128" border="0" align="right" cellpadding="2" cellspacing="2" > 
                    	<tr> 
                    		<th width="114" scope="col"><font id="cl"><strong>0</strong></font></th> 
                    	</tr> 
                    </table>
                      </td>
                      </tr>
                    <tr align="right" valign="middle">
                          <td><span class="Estilo6">Usuario: <?php echo $_SESSION["nombre"].' '.$_SESSION['apellido']; ?></span></td>
                          <td width="50"><a href="logout.php"><img src="imagenes/eqsl_exit.png" width="32" height="32" border="0" title="salir" /></a></td>
                        </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="left" valign="middle"><table width="100" border="0" cellspacing="0" cellpadding="0">
              <tr align="center" valign="middle">
                <td><a href="javascript:validar_pass_usuario('guardar')"><img src="imagenes/guardar.png" width="32" height="32" border="0"></a></td>
                <td><a href="menu.php" target="_parent"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center">
			
			<table width="349" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="323" align="center" valign="middle" background="imagenes/fondo_buscar_usuarios.jpg"><table width="334" height="204" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="3" align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center"><span class="Estilo9">CAMBIAR CONTRASE&Ntilde;A </span></td>
                  </tr>
                  <tr>
                    <td colspan="3">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="53%"><span class="Estilo12">Contrase&ntilde;a Anterior: </span></td>
                    <td width="7%">&nbsp;</td>
                    <td width="40%"><label>
                      <input name="pass_ant" type="password" id="pass_ant" style="height: 15px; width: 100px;"/>
                    </label></td>
                  </tr>
                  <tr>
                    <td height="20" colspan="3"><input name="tarea" type="hidden" id="tarea"></td>
                  </tr>
                  <tr>
                    <td height="25"><span class="Estilo12">Contrase&ntilde;a Nueva:</span></td>
                    <td>&nbsp;</td>
                    <td><input name="nuevo_pass" type="password" id="nuevo_pass" style="height: 15px; width: 100px;"/></td>
                  </tr>
                  <tr>
                    <td height="19">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><span class="Estilo12">Verificar Contrase&ntilde;a Nueva:</span></td>
                    <td>&nbsp;</td>
                    <td><label>
                      <input name="ver_pass" type="password" id="ver_pass" style="height: 15px; width: 100px;"/>
                    </label></td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="3" align="center">&nbsp;</td>
                  </tr>
                  
                </table></td>
              </tr>
            </table>

          </tr>
          <tr>
            <td align="center" valign="middle"><label></label></td>
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
	echo "<br>NO ESTA AUTENTICADO EN EL SISTEMA";
 }
?>

