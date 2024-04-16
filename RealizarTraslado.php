<?php
 session_start();
include_once 'Traslado.php';
include_once 'Registro.php';
include_once 'Equipo.php';
include_once 'Bodega.php';
include_once 'Registro.php';
if ($_SESSION["autenticado"] == "1") {
    $fecha = date('Y-m-d H:i');
	$equipo= unserialize($_SESSION['equipo']);
	$bodega = new Bodega('','','','','','','','','','','');
	$bodegas=$bodega->getBodega();
	
    if(!empty($_POST['tarea'])){
	$str = $_POST['descripcion'];
	$str = strtoupper($str);
	$_POST['descripcion']=$str;
	
    if ($_POST['tarea'] == 'guardar') {}
		$traslado = new Traslado('',$equipo->bodega,$_POST['id_bodega'],$equipo->referencia,$equipo->nombre,$fecha);
		$guardar = $traslado->guardarTraslado();
		$editar_eq = $equipo->editarBodegaEquipo($_POST['id_bodega']);
		if($editar_eq){
			$ult_traslado= $traslado->consultarUltimoId();
			$id_traslado = $ult_traslado[0];
			$registro= new Registro('',$_SESSION['id_usuario'],'TRASLADO DE EQUIPO',$id_traslado,$equipo->nombre,$fecha);
			$guardar_registro = $registro->guardarRegistro();
			echo "<script>alert ('El traslado se realizó correctamente');</script>";
			echo "<script>window.location.href='MenuTraslados.php';</script>";	
		}else{
			echo "<script>alert ('El traslado no se realizo correctamente, verifica por favor');</script>";
		}
    }
 	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Realizar Traslado</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script src="js/validaciones.js" language="JavaScript"></script>
<script src="js/reloj.js" language="JavaScript"></script>
<style type="text/css">
<!--

-->
</style>
</head>

<body topmargin="0" onLoad="mueveReloj();">
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
              <td><a href="BuscarEquipoTraslado.php"><img src="imagenes/nueva_bodega.png" width="32" height="32" title="Nueva Clase" /></a></td>
              <td><a href="javascript:valtraslado('guardar')"><img src="imagenes/guardar.png" alt="guardar" width="32" height="32" border="0" title="Guardar Información" /></a></td>
              <td><a href="MenuTraslados.php" target="_parent"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="middle">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" valign="middle"><strong>REALIZAR TRASLADO DE EQUIPOS</strong></td>
        </tr>
      </table>
      <table width="800" height="auto" border="0" cellspacing="0" cellpadding="8" style="background:url(imagenes/fondo_form.png) no-repeat;">
        <tr>
          <td align="center" valign="top"><table width="783" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="819" align="center" valign="top">&nbsp;</td>
              </tr>
            <tr>
              <td height="132" align="center" valign="top"><table width="718" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="3" align="left" valign="middle">&nbsp;</td>
                  <td width="207" align="center">Referencia del Equipo</td>
                  <td width="442" align="center">Nombre del Equipo</td>
                  </tr>
                <tr>
                  <td align="center" valign="middle">&nbsp;</td>
                  <td align="center"><input name="ref" type="text" id="ref" size="20" maxlength="100" class="campos_mayus" value="<?php echo $equipo->referencia; ?>" disabled="disabled" /></td>
                  <td align="center"><input name="descripcion" type="text" id="descripcion" size="60" maxlength="100" class="campos_mayus" value="<?php echo $equipo->nombre; ?>" disabled="disabled" />
                    <input name="tarea" type="hidden" id="tarea" class="campos_mayus" /></td>
                </tr>
                <tr>
                  <td align="center" valign="middle">&nbsp;</td>
                  <td colspan="2" align="center">&nbsp;</td>
                </tr>
                <tr>
                  <td align="center" valign="middle">&nbsp;</td>
                  <td colspan="2" align="center">Seleccionar Bodega a Trasladar</td>
                </tr>
                <tr>
                  <td align="center" valign="middle">&nbsp;</td>
                  <td colspan="2" align="center"><label for="select"></label>
                    <select name="id_bodega" id="id_bodega" style="height: 25px; width: 300px;" class="campos_mayus">
                              <?php 
								echo "<option value=''></option>\n";
										for($z=0;$z<sizeof($bodegas);$z+=2) {										
										if($equipo->bodega == $bodegas[$z]){
											echo "<option selected=\"selected\" value=\"".$bodegas[$z]."\">".$bodegas[$z+1]."</option>\n";
										}else{
											echo "<option value=\"".$bodegas[$z]."\">".$bodegas[$z+1]."</option>\n";
										}
									}
									$bodega = $equipo->bodega;
								?>
                            </select></td>
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
