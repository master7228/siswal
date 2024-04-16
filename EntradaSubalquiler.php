<?php
 session_start();
include_once 'EquipoSub.php';
include_once 'BodegaSub.php';
include_once 'EntradaSub.php';
if ($_SESSION["autenticado"] == "1") {
	$fecha = date('Y-m-d H:i');
	$equiposub=unserialize($_SESSION['equiposub']);
	$equipo = new EquipoSub('','','','','');
	$resp = $equipo->buscarEquipoSub($equiposub->id);
	$equip= $resp[0];
	
	$bodegasub = new BodegaSub('','','');
	$consulta = $bodegasub->buscarBodegaSub1('estado','1');
	
    if(!empty($_POST['tarea'])){
			$str = $_POST['nombre'];
			$str = strtoupper($str);
			$_POST['nombre']=$str;
			$str = $_POST['cantidad'];
			$str = strtoupper($str);
			$_POST['cantidad']=$str;
			if ($_POST['tarea'] == 'seleccionar'){
				$entradasub= new EntradaSub('','','','','','','');
				$Consultar=$entradasub->existeListado($equip->id,$_SESSION['id_usuario']);
				if(!$Consultar){
					$entradasub = new EntradaSub('',$equip->id,$_POST['nombre'],$_POST['id_bodega'],$fecha,$_POST['cantidad'],$_SESSION['id_usuario']);
					$guardar = $entradasub->guardarEntradaSub();
					if($guardar){
						//$equipoSub_sel = new EquipoSub('','','','','','');
						//$resp_equipoSub_sel = $equipoSub_sel->cambiarEstadoEquipoSub('T',$equiposub->id,$_SESSION['id_usuario']);
						//$equipo1 = new EquipoSub('','','','','','');
						//$resp1 = $equipo1->buscarEquipoSubSel1('transaccion','T',$_SESSION['id_usuario']);
						//$_SESSION['equiposub'] = serialize($resp1);
						//unset($_SESSION['equiposub']);
						echo "<script>window.opener.location.reload(); window.close();</script>";
					}
					else{
						echo "<script>alert ('Error al seleccionar el equipo');</script>";
					}
				}
				else{
					echo "<script>alert ('El equipo ".$equip->nombre." se encuentra en remisión');</script>";
				}
			}
	}
 	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="javascript">
ventanaX = 535;
ventanaY = 300; self.resizeTo(ventanaX,ventanaY);
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Entrada subalquiler</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script src="js/validaciones.js" language="JavaScript"></script>
<script src="js/reloj.js" language="JavaScript"></script>

<style type="text/css">
<!--
.style1 {font-size: 14px}

-->
</style>
</head>
<body bgcolor="#efecff" topmargin="0" onLoad="mueveReloj();">
<table width="53%" border="0" align="center" cellpadding="0" cellspacing="0">
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
                        <td align="right" valign="middle"><table width="97" border="0" align="right" cellpadding="2" cellspacing="2" >
                          <tr>
                            <th width="63" height="34" scope="col"><font id="cl"><strong> 0</strong></font></th>
                          </tr>
                        </table></td>
                        <td align="right" valign="middle">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="78%" align="right" valign="middle"><span class="Estilo6">Usuario: <?php echo $_SESSION["nombre"].' '.$_SESSION['apellido']; ?></span></td>
                        <td width="22%" align="center" valign="middle">&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="middle"><table width="71" border="0" cellspacing="0" cellpadding="0">
            <tr align="center" valign="middle">
              <td width="33" height="37"><a href="javascript:valequipsub('seleccionar')"><img src="imagenes/seleccionar.png" alt="guardar" width="32" height="32" border="0" title="Seleccionar" /></a></td>
              <td><a href="SeleccionarEquipoSub.php"><img src="imagenes/flecha.png" width="32" height="32" border="0"  title="Regresar"/></a></td>
              </tr>
            </table></td>
        </tr>
        </table>
      <table width="517" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left" valign="middle">&nbsp;</td>
          <td colspan="4" align="left">&nbsp;</td>
          <td align="left" valign="middle">&nbsp;</td>
          <td colspan="2" align="left">&nbsp;</td>
        </tr>
        <tr>
          <td width="7" align="left" valign="middle">&nbsp;</td>
          <td colspan="4" align="left">Nombre </td>
          <td width="18" align="left" valign="middle">&nbsp;</td>
          <td colspan="2" align="left">Cantidad</td>
        </tr>
        <tr>
          <td width="7" align="center" valign="middle">*</td>
          <td colspan="4" align="left"><input name="nombre" type="text" class="campos_mayus" id="nombre" onkeypress="javascript:return Letras(event)" value= '<?php echo $equip->nombre; ?>' size="50" maxlength="100" readonly="readonly"/></td>
          <td width="18" align="right" valign="middle"><div align="right">* </div></td>
          <?php if($equip->cantidad==1){?>
          <td colspan="2" align="left"><input name="cantidad" type="text" class="campos_mayus" id="cantidad" onkeypress="javascript:return Numeros(event)" value="<?php echo $equip->cantidad; ?>" size="7" maxlength="5"/>
             <?php }else{?>
             <td colspan="2" align="left"><input name="cantidad" type="text" class="campos_mayus" id="cantidad" onkeypress="javascript:return Numeros(event)" value="<?php echo '0'; ?>" size="7" maxlength="5"/>
            <?php }?>
            <div align="center"></div></td>
        </tr>
        <tr>
          <td width="7" align="left" valign="middle">&nbsp;</td>
          <td width="220" align="left">Bodega</td>
          <td width="78" align="left">&nbsp;</td>
          <td colspan="3" align="left">&nbsp;</td>
          <td width="102" align="left">&nbsp;</td>
          <td width="45" align="left">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" valign="middle">*</td>
          <td align="left"><select name="id_bodega" id="id_bodega">
            <?php for($i=0; $i<=sizeof($consulta); $i++){
							$resp=$consulta[$i];
							echo "<option value=\"".$resp->id."\">".$resp->nombre."</option>\n";
					        } ?>
          </select></td>
          <td align="center">&nbsp;</td>
          <td colspan="5" align="left"><input name="tarea" type="hidden" id="tarea" /></td>
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