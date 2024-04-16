<?php
 session_start();
 if($_SESSION["autenticado"] == "1"){
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Men&uacute; Principal</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script src="func_javascript.js" language="JavaScript"></script>
<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo6 {font-size: 11px}
-->
</style></head>

<body topmargin="0">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><table width="100%" height="35" border="0">
      <tr>
        <td align="left"><img src="imagenes/logoge.png" alt="Himed" width="200" height="80" /></td>
        <td align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
            <td colspan="2">
            </td>
            </tr>
            <tr>
              <td align="right" valign="middle"><span class="Estilo6">Usuario: <?php echo $_SESSION["nombre"].' '.$_SESSION["apellido"]; ?> </span></td>
              <td width="45" align="center" valign="middle"><span class="Estilo6"><a href="logout.php"><img src="imagenes/eqsl_exit.png" width="30" height="30" border="0"></a> </span></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><table width="1000"  border="0" cellspacing="0" cellpadding="0">
      <tr align="center">
        <td width="200">&nbsp;</td>
        <td width="200">&nbsp;</td>
        <td width="200">&nbsp;</td>
        <td width="200">&nbsp;</td>
        <td width="200">&nbsp;</td>
      </tr>
      <tr align="center" valign="middle">
        <td width="200" height="32" background="imagenes/fondo_menu.png">Remisiones</td>
        <td width="200" height="32" background="imagenes/fondo_menu.png">Devoluciones</td>
        <td width="200" height="32" background="imagenes/fondo_menu.png">Entrada Subalquiler</td>
        <td width="200" background="imagenes/fondo_menu.png">Salida Subalquiler</td>
        <td width="200" height="32" background="imagenes/fondo_menu.png">Bodega Subalquiler</td>
      </tr>
      <tr align="center" valign="top">
        <td width="200"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><a href="MenuRemisiones.php"><img src="imagenes/remisiones.png" width="128" height="128" border="0"></a></td>
          </tr>
        </table>
          </td>
        <td width="200"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center"><img src="imagenes/devoluciones_opaco.png" width="128" height="128"></td>
            </tr>
          </table>          </td>
        <td width="200"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><a href="MenuCliente.php"></a><img src="imagenes/entrada_sub_opaco.png" width="128" height="128"></td>
          </tr>
        </table>
          </td>
        <td width="200"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><a href="MenuObras.php"><img src="imagenes/salida_sub_opaco.png" width="128" height="128"></a></td>
          </tr>
        </table></td>
        <td width="200"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><a href="MenuBodegaSub.php"><img src="imagenes/bodega.png" width="128" height="128"></a><a href="MenuObras.php"></a></td>
          </tr>
        </table>
          </td>
      </tr>
      <tr align="center">
        <td height="23" colspan="5">&nbsp;</td>
        </tr>
      <tr align="center" valign="middle">
        <td height="32" background="imagenes/fondo_menu.png">Galer&iacute;a de Informes </td>
        <td height="32" background="imagenes/fondo_menu.png">Bodegas</td>
        <td height="32" background="imagenes/fondo_menu.png">Equipos</td>
        <td background="imagenes/fondo_menu.png">Administraci&oacute;n de Obras </td>
        <td height="32" background="imagenes/fondo_menu.png">Administraci&oacute;n de Usuarios </td>
      </tr>
      <tr align="center" valign="top">
        <td width="200"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><img src="imagenes/informes_opaco.png" width="128" height="128"></td>
          </tr>
        </table>
          </td>
        <td width="200"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><a href="MenuBodega.php"><img src="imagenes/bodega.png" width="128" height="128"></a></td>
          </tr>
        </table>
          </td>
        <td width="200"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td height="128" align="center">
			  <?php if($_SESSION["tipo"]=='1'){
			  echo '<img src="imagenes/equipos.png" width="128" height="128" border="0"  usemap="#Map2">';
			  } else {
			  echo '<img src="imagenes/equipos_opaco_menu.png" width="128" height="128" border="0" >';
			  }?>
			 </td>
          </tr>
        </table>
          </td>
        <td width="200"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><a href="MenuObras.php"><img src="imagenes/obras.png" width="128" height="128" border="0"></a></td>
          </tr>
        </table></td>
        <td width="200"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center">
			  <?php if($_SESSION["tipo"]=='1'){
			  echo '<img src="imagenes/usuarios.png" width="128" height="128" border="0"  usemap="#Map">';
			  } else {
			  echo '<img src="imagenes/usuarios.png" width="128" height="128" border="0" usemap="#Map1">';
			  }?>
			  </td>
            </tr>
          </table>          </td>
      </tr>
      <tr align="center" valign="middle">
        <td height="22" colspan="5">&nbsp;</td>
        </tr>
      <tr align="center" valign="middle">
        <td height="32" background="imagenes/fondo_menu.png">Proveedores</td>
        <td height="32" background="imagenes/fondo_menu.png">Facturaci&oacute;n</td>
        <td height="32" background="imagenes/fondo_menu.png">Transporte</td>
        <td background="imagenes/fondo_menu.png">Administraci&oacute;n de Clientes </td>
        <td height="32" background="imagenes/fondo_menu.png">Configuraci&oacute;n Siswal</td>
      </tr>
      <tr align="center" valign="middle">
        <td height="15">&nbsp;</td>
        <td height="15">&nbsp;</td>
        <td height="15">&nbsp;</td>
        <td>&nbsp;</td>
        <td height="15">&nbsp;</td>
      </tr>
      <tr align="center" valign="middle">
        <td height="52"><a href="MenuProveedor.php"><img src="imagenes/proveedores.png" width="128" height="128"></a></td>
        <td height="52"><img src="imagenes/facturacion_opaco.png" width="128" height="128"></td>
        <td height="52"><a href="MenuTransporte.php"><img src="imagenes/tranportadores.png" width="128" height="128"></a></td>
        <td><a href="MenuCliente.php"><img src="imagenes/clientes.png" width="128" height="128" border="0"></a></td>
        <td height="52"><img src="imagenes/configuracion_opaco.png" width="128" height="128"></td>
      </tr>
      <tr align="center" valign="middle">
        <td height="32">&nbsp;</td>
        <td height="32">&nbsp;</td>
        <td height="32">&nbsp;</td>
        <td>&nbsp;</td>
        <td height="32">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<map name="Map">
  <area shape="rect" coords="5,3,123,123" href="MenuUsuarios.php">
</map>
<map name="Map1">
  <area shape="rect" coords="5,3,123,123" href="CambiarContUsuario.php">
</map>
<map name="Map2">
  <area shape="rect" coords="5,3,123,123" href="MenuEquipos.php">
</map>
</body>
</html>
<?php 
 }else{
 	echo "<script>alert ('No está autenticado en el sistema');</script>";
	echo "<script>window.location.href='index.php';</script>";  
 }
?>