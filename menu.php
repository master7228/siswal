<?php
 session_start();
 if(!empty($_SESSION["autenticado"]) && $_SESSION["autenticado"] == "1"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Menu Principal</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Clean, standards-friendly, modular framework for dropdown menus" />

<link href="css/menu.css" media="screen" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/validaciones.js" type="text/javascript"></script>
<style type="text/css">
.Estilo6 {font-size: 11px}
</style>
</head>
<body onKeyDown = "showDown(window.event)">
<table width="100%" align="center" onkeyup="return onkeyup()">
<tr>
<td>
<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><table width="100%" height="35" border="0">
      <tr>
        <td align="left"><img src="imagenes/logoge.png" alt="Himed" width="200" height="80" /></td>
        <td align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="2"></td>
          </tr>
          <tr>
            <td width="89%" align="right" valign="middle" style="font-size:14px;"><span>Usuario: <?php echo $_SESSION["nombre"].' '.$_SESSION["apellido"]; ?>-</span></td>
            <td width="11%" align="center" valign="middle"><span><a href="logout.php"><img src="imagenes/eqsl_exit.png" alt="" width="30" height="30" border="0" /></a></span></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</td>
</tr>
<tr>
<td align="center">

<table width="900" height="600" align="center">
<tr>
<td>
<ul class="mi-menu">
  <li class="menu_inicio"><a href="menu.php"> Inicio</a></li>
  <li>
    <a href="#"> Entradas y Salidas </a>
    <ul>
      <li><a href="MenuEquipos.php"> Equipos</a></li>
      <li><a href="MenuRemisiones.php"> Remision </a></li>
      <li><a href="MenuDevoluciones.php"> Devolucion </a></li>
      <li><a href="MenuTraslados.php"> Traslados </a></li>
      <li><a href="MenuDiscontinuos.php"> Discontinuos </a></li>
    </ul>
  </li>
  <li><a href="#"> Administracion </a>
  	<ul>
      <li><a href="MenuCliente.php"> Clientes</a></li>
      <li><a href="MenuObras.php"> Obras </a></li>
      <li><a href="MenuProveedor.php"> Proveedores </a></li>
      <li><a href="MenuBodega.php"> Bodegas </a></li>
      
    </ul>
  </li>
  <li><a href="#"> Configuracion </a>
  	<ul>
      <li><a href="MenuUsuarios.php"> Usuarios</a></li>
      <li><a href="MenuBodegaSub.php"> Bodega Subalquiler </a></li>
      <li><a href="MenuTransporte.php"> Transporte </a></li>
      <li><a href="MenuValorTransporte.php"> Valor Transporte </a></li>
      <li><a href="MenuVendedores.php"> Vendedores </a></li>
      <li><a href="MenuCupos.php"> Cupo Credito </a></li>
      <li><a href="MenuGrupoEquipos.php"> Grupo Equipos </a></li>
      <li><a href="MenuFamiliaEquipos.php"> Familia Equipos </a></li>
      <li><a href="MenuClaseEquipos.php"> Clase Equipos </a></li>
      <li><a href="MenuConceptoReparacion.php"> Conceptos de Reparacion </a></li>
    </ul>
  </li>
  <li><a href="#"> Informes</a></li>
  <li><a href="#"> Facturacion</a></li>
</ul>
<p>&nbsp;</p>
<p>&nbsp;</p>
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
<tr valign="top">
<td align="center"><table width="285" border="0">
  <tr>
    <th scope="col"><a href="MenuRemisiones.php"><img src="imagenes/remisiones.png" alt="" width="60" height="59" title="Remisiones" /></a></th>
    <th scope="col"><a href="MenuDevoluciones.php"><img src="imagenes/devoluciones.png" alt="" width="60" height="59" title="Devoluciones" /></a></th>
    <th scope="col"><a href="MenuCliente.php"><img src="imagenes/clientes.png" alt="" width="60" height="59" title="Clientes" /></a></th>
    <th scope="col"><a href="MenuObras.php"><img src="imagenes/obras.png" alt="" width="60" height="59" title="Obras" /></a></th>
    <th scope="col"><a href="MenuEquipos.php"><img src="imagenes/equipos.png" alt="" width="60" height="59" title="Equipos" /></a></th>
  </tr>
</table></td>
</tr>
</table>
</td>
</tr>
</body>
</html>
<?php 
 }else{
 	echo "<script>alert ('No está autenticado en el sistema');</script>";
	echo "<script>window.location.href='index.php';</script>";  
 }
?>