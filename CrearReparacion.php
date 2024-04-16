<?php
session_start();
include_once 'Equipo.php';
include_once 'EquipoDevolucion.php';
include_once 'Reparacion.php';
include_once 'Usuario.php';
include_once 'Registro.php';
include_once 'ReparacionEquipo.php';
include_once 'ConceptoReparacion.php';
if(!empty($_SESSION["autenticado"]) && $_SESSION["autenticado"] == "1"){

	$fecha = date('Y-m-d H:i');
	$id_val=$_GET['usu1'];
	if(!empty($_POST['tarea']) && $_POST['tarea']=='quitar'){
		$id= $_POST['id'];
		$equipo = new ReparacionEquipo('','','','');
		$quitar = $equipo->eliminar_equipoRep($id,$id_val,$_GET['var']);
	}

	$equipodevolucion = new EquipoDevolucion('','','','');
	$resp1 = $equipodevolucion->buscarEquiposReparacion($_SESSION["id_eq_dev"],$id_val);
	$equi=$resp1[0];
	$equipo2 = new Equipo("","","","","","","","","","","","","","","","","","","","","","","","");
	$resp2 = $equipo2->buscarEquipo('id',$equi->id_equipo);
	$equipo=$resp2[0];
	
	$equipoRep = new ReparacionEquipo("","","","");
	$lista = $equipoRep->buscarSelRepEq($_GET['var'],$id_val);
	
	if(!empty($_POST['tarea']) and $_POST['tarea']=='guardar'){
		$reparacion = new Reparacion('',$_GET['var'],$equi->id_equipo,$_POST['cantidad']);
		$guardar = $reparacion->guardarRepEq();
		if($guardar){
			echo "<script>window.opener.location.reload(); window.close();</script>";
		}else{
			echo "<script>alert ('Error al crear la reparacion, por favor intenta de nuevo');</script>";
			echo "<script>window.location.href='CrearReparacion.php';</script>";
		}
	
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Crear Bodega</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script src="js/validaciones.js" language="JavaScript"></script>
<script src="js/ajax.js" language="JavaScript"></script>
 <script language="JavaScript" src ="js/digitov.js"></script> 
<script src="js/reloj.js" language="JavaScript"></script>


 <style type="text/css">
<!--
.style1 {
	font-size: 12px;
	font-weight: bold;
}
-->
 </style>
<script> 
var Popup 
function abreVentanaSeleccion(val1,val2){ 
	Popup = window.open("SeleccionarReparacion.php? id="+val1+"&idr="+val2+"","miwin1","width=700,height=600,scrollbars=yes")
	Popup.focus()
} 
</script> 
</head>

<body topmargin="0" onLoad="mostrarPaises(); mueveReloj();" onKeyDown = "showDown(window.event)">

<table width="51%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="305" align="center" valign="top"><form action="" method="post" name="form1" class="FormGeneral" id="form1" target="_parent" enctype="multipart/form-data">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="middle"><table width="100%" height="57" border="0">
            <tr>
              <td width="264" height="53"><img src="imagenes/logoge.png" alt="Himed" width="200" height="40" /></td>
              <td width="254" align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                  <td colspan="2">
                  	<table width="128" border="0" align="right" cellpadding="2" cellspacing="2" > 
                    	<tr> 
                    		<th width="114" scope="col"><font id="cl"><strong>0</strong></font></th> 
                    	</tr> 
                    </table> 
                  </td>
                  </tr>
                  <tr valign="middle">
                    <td width="97%" align="right"><span class="Estilo6">Usuario: <?php echo "".$_SESSION["nombre"].' '.$_SESSION['apellido']; ?> - <a href="logout.php"></a></span></td>
                    <td width="3%" align="right">&nbsp;</td>
                  </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="middle"><table width="188" border="0" cellspacing="0" cellpadding="0">
            <tr align="center" valign="middle">
              <td width="58" height="29%">&nbsp;</td>
              <td width="32"><a href="javascript:valreparacion('guardar')"><img src="imagenes/guardar.png" alt="guardar" width="32" height="32" border="0" title="Guardar Informaci&oacute;n" onclick="return validarEmail(email,'email' )"/></a></td>
              <td width="32"><a href="javascript:valgeneral('salir')"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td height="18" align="center" valign="middle"><span class="style1">REPARACI&Oacute;N 
            <input type="hidden" name="tarea" id="tarea" />
            <input type="hidden" name="id" id="id" />
          </span></td>
        </tr>
      </table>
      <table width="570" height="auto" border="0" cellspacing="0" cellpadding="8" >
        <tr>
          <td width="354" height="198" align="center" id="tabla_cliente" ><div align="center">
            <table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr align="center">
                <td width="200" height="90" align="center" valign="top"><div align="center">
                  <table width="334" border="0" align="center">
                    <tr>
                      <td width="13" height="29%">&nbsp;</td>
                      <td width="240" align="left">Nombre Equipo</td>
                      <td width="9">&nbsp;</td>
                      <td width="122" align="left">Cantidad</td>
                    </tr>
                    <tr>
                      <td height="39%" align="center">&nbsp;</td>
                      <td align="left"><?php echo $equipo->nombre;?></td>
                      <td align="center"><input type="hidden" name="valcantidad" id="valcantidad" value="<?php echo $equi->cantidad; ?>"/></td>
                      <?php if($equipo->electromecanico == '1'){?>
                      <td width="73" align="center" valign="middle"><?php echo $equi->cantidad; ?>
                     <?php }else{?>
                     <td align="left"><input name="cantidad" type="text" class="campos_mayus" id="cantidad" value="<?php echo $equi->cantidad; ?>" size="20" maxlength="30" onkeypress="javascript:return Numeros(event)"/></td>
                     <?php }?>
					</tr>
                  </table>
                </div>
                  <div align="center">
                    <table width="466" border="0" align="center">
                      <tr>
                        <td width="27" height="27">&nbsp;</td>
                        <td width="221" align="left">Seleccionar Concepto Reparaci&oacute;n</td>
                        <td width="168"><a onclick="abreVentanaSeleccion(<?php echo $id_val ?>,<?php echo $_GET['var']; ?>);" ><img src="imagenes/buscar.png" width="23" height="23" title="Seleccionar Cliente" /></a></td>
                        <td width="32" align="left">&nbsp;</td>
                      </tr>
                    </table>
                  </div></td>
              </tr>
            </table>
         
            <?php if((sizeof($lista)!=0)){ ?>
            <table width="632" border="1" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="11" align="center"><strong>REGISTROS ENCONTRADOS </strong></td>
              </tr>
              <tr>
                <td height="10" colspan="11" align="center">&nbsp;</td>
              </tr>
              <tr bgcolor="#999999">
                <td width="230" align="center"><strong>Concepto Reparacion</strong></td>
                <td width="388" align="center"><strong>Valor</strong></td>
                <td width="91" align="center" valign="middle"><strong>Quitar</strong></td>
              </tr>
              <?php
							for ($i=0; $i<count($lista); $i++){
									$equi=$lista[$i];
									$eqrep = new ConceptoReparacion("","","","");
									$resp2 = $eqrep->buscarConceptoReparacion1($equi->id_concepto);
									$equiporep=$resp2[0];
							?>
              <tr align="left" class="TablaUsuarios">
                <td width="230" align="center"><?php echo $equiporep->descripcion; ?></a></td>
                <td width="388"><?php echo $equiporep->valor;?></td>
                <td width="91" align="center" valign="middle"><a href="javascript:enviar_form_clientes('quitar','<?php echo $equi->id_concepto; ?>')"></a><a href="javascript:enviar_form_clientes('quitar','<?php echo $equi->id_concepto; ?>')"><img src="imagenes/cancelar.png" width="25" height="25" /></a></td>
              </tr>
              <?php }}?>
        </table>
          </div></td>
        </tr>
    </table>
        </form>
		<script type="text/javascript">
			document.form1.tipo_doc.focus();
		</script>
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
