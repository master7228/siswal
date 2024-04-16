<?php
session_start();
include_once 'BodegaSub.php';
include_once 'Registro.php';
if($_SESSION["autenticado"] == "1"){
    $fecha = date('Y-m-d H:i');
	$bodega=unserialize($_SESSION['bodega']);
    if(!empty($_POST['tarea'])){
		/*<?php if($bodega->estado == '2'){ echo 'disabled'; } ?>*/
		if($bodega->estado == '1'){
			$str = $_POST['nombre'];
			$str = strtoupper($str);
			$_POST['nombre']=$str;
		}
		if($_POST['tarea'] == 'guardar'){
			$bodegasub = new BodegaSub('',$_POST['nombre'],'1');
			$ConsultarBodegaSub=$bodegasub->existeBodegaSub();
			if(!$ConsultarBodegaSub){
				$guardar = $bodegasub->editarBodegaSub($_POST['id']);
				if ($guardar){
					$consul = $bodegasub->buscarBodegaSub('nombre',$_POST['nombre']);
					$tran=$consul[0];
					$registro= new Registro('',$_SESSION['id_usuario'],'EDITAR BODEGA SUB',$tran->id,$tran->nombre,$fecha);
					$guardar_registro = $registro->guardarRegistro();
					$_SESSION['bodega']=serialize($consul[0]);
					echo "<script>alert ('La Bodega Subalquiler fue editada con exito');</script>";
					echo "<script>window.location.href='EditarBodegaSub.php';</script>";
				} else {
					echo "<script>alert ('No se pudo editar la Bodega Subalquiler, por favor intenta de nuevo');</script>";
					echo "<script>window.location.href='EditarBodegaSub.php';</script>";
				}
			}else{
				echo "<script>alert ('Este nombre ya la tiene otra Bodega Subalquiler, verifica por favor');</script>";
				echo "<script>window.location.href='EditarBodegaSub.php';</script>";
			}
		} 
		
		if($_POST['tarea']=='activar'){
			$est_bodega= new BodegaSub("", "", "");
			$estado = $est_bodega->activarDesactivarBodegaSub('1', $bodega->id);
			$bodega->estado="1";
			if($estado){
				$consul = $bodega->buscarBodegaSub('id',$bodega->id);
				$usu=$consul[0];
				$registro= new Registro('',$_SESSION['id_usuario'],'ACTIVAR BODEGA SUBALQUILER',$usu->id,$usu->nombre,$fecha);
				$guardar_registro = $registro->guardarRegistro();
				$_SESSION['bodega']=serialize($usu);
				echo "<script>alert('La Bodega Subalquiler ha sido activada correctamente');</script> ";
			}else{
				echo "<script>alert('La Bodega Subalquiler no pudo ser activado, intentelo nuevamente');</script> ";	
			}
			echo '<script>window.location="EditarBodegaSub.php";</script>';
		}
		
		if($_POST['tarea']=='desactivar'){
			$est_bodega= new BodegaSub("", "", "");
			$estado = $est_bodega->activarDesactivarBodegaSub('2', $bodega->id);
			$bodega->estado="2";
			if($estado){
				$consul = $bodega->buscarBodegaSub('id',$bodega->id);
				$usu=$consul[0];
				$registro= new Registro('',$_SESSION['id_usuario'],'DESACTIVAR BODEGA SUBALQUILER',$usu->id,$usu->nombre,$fecha);
				$guardar_registro = $registro->guardarRegistro();
				$_SESSION['bodega']=serialize($consul[0]);
				echo "<script>alert('La Bodega Subalquiler ha sido desactivada correctamente');</script> ";
			}else{
				echo "<script>alert('La Bodega Subalquiler no pudo ser desactivada, intentelo nuevamente');</script> ";
			}
			echo '<script>window.location="EditarBodegaSub.php";</script>';
		}
		
		if ($_POST['tarea'] == 'salir') {
			echo "<script>window.location.href='MenuBodegaSub.php';</script>";
		}
	}
 	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Editar Bodega Sublaquiler</title>
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
              <td><a href="CrearTransporte.php"><img src="imagenes/nueva_bodega.png" width="32" height="32" title="Nueva Bodega Subalquiler" /></a></td>
              <td><a href="javascript:valbodegaSub('guardar')"><img src="imagenes/guardar.png" alt="guardar" width="32" height="32" border="0" title="Guardar Información" /></a></td>
              <td><a href="BuscarBodegaSub.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Bodega Subalquiler"/></a></td>
              <?PHP if($bodega->estado == '1'){ ?>
              	<td><img src="imagenes/activar_obra_opaco.png" width="32" height="35" title="Activar Bodega Sublaquiler" /></td>
              <?php }else{?>
              	<td><a href="javascript:valbodegaSub('activar')"><img src="imagenes/activar_obra.png" width="32" height="35" title="Activar Bodega Sublaquiler" /></a></td>
              <?php }?>
              <?PHP if($bodega->estado == '1'){ ?>
              	<td><a href="javascript:valbodegaSub('desactivar')"><img src="imagenes/desactivar_obra.png" width="32" height="35" title="Desctivar Bodega Sublaquiler" /></a></td>
              <?php }else{?>
              	<td><img src="imagenes/desactivar_obra_opaco.png" width="32" height="35" title="Desctivar Bodega Sublaquiler" /></td>
              <?php }?>
             
              <td><a href="MenuBodegaSub.php" target="_parent"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="middle">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" valign="middle"><strong>EDITAR BODEGA SUBALQUILER</strong></td>
        </tr>
      </table>
      <table width="800" height="auto" border="0" cellspacing="0" cellpadding="8" style="background:url(imagenes/fondo_form.png) no-repeat;">
        <tr>
          <td align="center" valign="top"><table width="783" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="819" align="center" valign="top">&nbsp;</td>
              </tr>
            <tr>
              <td height="132" align="center" valign="top"><table width="744" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="67" align="left" valign="middle">&nbsp;</td>
                  <td align="center">Id</td>
                  <td align="center">&nbsp;</td>
                  <td align="center">Nombre</td>
                  <td align="center">&nbsp;</td>
                  </tr>
                <tr>
                  <td align="center" valign="middle">&nbsp;</td>
                  <td width="182" align="center"><input name="id" type="text" id="id" size="10" maxlength="100" class="campos_mayus" value="<?php echo $bodega->id; ?>" readonly="readonly" style="background:#999; text-align:center" <?php if($bodega->estado == '2'){ echo 'disabled'; } ?> />                    <input name="tarea" type="hidden" id="tarea" class="campos_mayus" /></td>
                  <td align="center">&nbsp;</td>
                  <td width="302" align="center"><input name="nombre" type="text" id="nombre" size="30" maxlength="30" class="campos_mayus" value="<?php echo $bodega->nombre; ?>" <?php if($bodega->estado == '2'){ echo 'disabled'; } ?> /></td>
                  <td width="66" align="center">&nbsp;</td>
                  </tr>
                <tr>
                  <td align="center" valign="middle">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                  <td width="21" align="left">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                  <td align="left">&nbsp;</td>
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
