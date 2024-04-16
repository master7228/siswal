<?php
 session_start();
 if($_SESSION["autenticado"] == "1"){
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Menu familia Equipos</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script src="js/validaciones.js" language="JavaScript"></script>
<script src="js/reloj.js" language="JavaScript"></script>

</head>

<body onLoad="mueveReloj();" onKeyDown = "showDown(window.event)">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><form id="form1" name="form1" method="post" action="" class="TablaUsuarios">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="middle"><table width="100%" height="35" border="0">
              <tr>
                <td width="196"><img src="imagenes/logoge.png" alt="Himed" width="200" height="40" /></td>
                <td align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="right" valign="top"><table width="500" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                        <td colspan="2">
                          <table width="128" border="0" align="right" cellpadding="2" cellspacing="2" > 
                            <tr> 
                              <th width="114" scope="col"><font id="cl"><strong>0</strong></font></th> 
                              </tr> 
                            </table> 
                        </td>
                    </tr>
                        <tr align="right" valign="middle">
                          <td width="92%" valign="middle"><span class="Estilo6">Usuario: <?php echo $_SESSION["nombre"].' '.$_SESSION['apellido']; ?>-</span></td>
                          <td width="8%" valign="middle"><a href="logout.php"><img src="imagenes/eqsl_exit.png" alt="" width="30" height="30" title="salir" border="0" /></a></td>
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
                <td><a href="CrearFamilia.php"><img src="imagenes/nueva_bodega.png" width="32" height="32" title="Nueva Familia" /></a></td>
                <td><a href="BuscarFamilia.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Familia"/></a></td>
                <td><a href="menu.php" target="_parent"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center">
			<p><img src="imagenes/admin_opaco.png" width="300" height="301" /></p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p></td>
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
