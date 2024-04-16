<?php
 session_start();
include_once 'Transporte.php';
include_once 'Registro.php';
if ($_SESSION["autenticado"] == "1") {
    $fecha = date('Y-m-d H:i');
	$transporte=unserialize($_SESSION['transporte']);
	if(!empty($_POST['tarea']) and $_POST['tarea']=='guardar'){
		$str = $_POST['placa'];
		$str = strtoupper($str);
		$_POST['placa']=$str;
			$edit_transporte= new Transporte('',$_POST['placa'],'1');
			if($transporte->placa!=$_POST['placa']){
				$cons=$edit_transporte->existeTransporte();
				if($cons!=0){			
					echo "<script>alert ('La placa que intenta ingresar ya se encuentra registrado con otro vehiculo, inténtalo de nuevo');</script> ";
				}else{
					$editar= $edit_transporte->editarTransporte($transporte->id);
					$_SESSION['transporte']=serialize($edit_transporte);
					if($editar){
						$consul = $transporte->buscarTransporte('placa',$_POST['placa']);
						$tran=$consul[0];
						$registro= new Registro('',$_SESSION['id_usuario'],'EDITAR TRANSPORTE',$tran->id,$tran->placa,$fecha);
						$guardar_registro = $registro->guardarRegistro();
						echo "<script>alert('El Transporte ha sido actualizado correctamente');</script> ";
						echo '<script>window.location="MenuTransporte.php";</script>';
					}else{
						echo "<script>alert('El Transporte no se pudo actualizar, intentelo nuevamente');</script> ";
						echo '<script>window.location="EditarTransporte.php";</script>';
					}				
				}		
			}else{
					$editar= $edit_transporte->editarTransporte($transporte->id);
					$_SESSION['transporte']=serialize($edit_transporte);
					if($editar){
						$consul = $transporte->buscarTransporte('placa',$_POST['placa']);
						$tran=$consul[0];
						$registro= new Registro('',$_SESSION['id_usuario'],'EDITAR TRANSPORTE',$tran->id,$tran->placa,$fecha);
						$guardar_registro = $registro->guardarRegistro();
						echo "<script>alert('El Transporter ha sido actualizado correctamente');</script> ";
						echo '<script>window.location="EditarTransporte.php";</script>';
					}else{
						echo "<script>alert('El Transporte no se pudo actualizar, intentelo nuevamente');</script> ";
						echo '<script>window.location="EditarTransporte.php";</script>';
					}	
			}
		}
		
		if(!empty($_POST['tarea']) and $_POST['tarea']=='activar'){
			$est_transporte= new Transporte("", "", "");
			$estado = $est_transporte->activarDesactivarTransporte('1', $transporte->id);
			$transporte->estado="1";
			if($estado){
				$consul = $transporte->buscarTransporte('placa',$transporte->placa);
				$usu=$consul[0];
				$registro= new Registro('',$_SESSION['id_usuario'],'ACTIVAR TRANSPORTE',$usu->id,$usu->placa,$fecha);
				$guardar_registro = $registro->guardarRegistro();
				$_SESSION['transporte']=serialize($transporte);
				echo "<script>alert('El Transporte ha sido activado correctamente');</script> ";
			}else{
				echo "<script>alert('El Transporte no pudo ser activado, intentelo nuevamente');</script> ";
				echo '<script>window.location="EditarTransporte.php";</script>';
			}
		}
		
		if(!empty($_POST['tarea']) and $_POST['tarea']=='desactivar'){
			$est_transporte= new Transporte("", "", "");
			$estado = $est_transporte->activarDesactivarTransporte('2', $transporte->id);
			$transporte->estado="2";
			if($estado){
				$consul = $transporte->buscarTransporte('placa',$_POST['placa']);
				$usu=$consul[0];
				$registro= new Registro('',$_SESSION['id_usuario'],'DESACTIVAR TRANSPORTE',$usu->id,$usu->placa,$fecha);
				$guardar_registro = $registro->guardarRegistro();
				$_SESSION['transporte']=serialize($transporte);
				echo "<script>alert('El Transporte ha sido desactivado correctamente');</script> ";
				echo '<script>window.location="EditarTransporte.php";</script>';
			}else{
				echo "<script>alert('El Transporte no pudo ser desactivado, intentelo nuevamente');</script> ";
				echo '<script>window.location="EditarTransporte.php";</script>';
			}
		}
		if(!empty($_POST['tarea']) && $_POST['tarea'] == 'salir'){
				unset($_SESSION['transporte']);
				echo "<script>window.location.href='MenuTransporte.php';</script>";
			}
 	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Editar Transporte</title>
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
          <td align="left" valign="middle"><a href="BuscarTransporte.php" target="_parent"></a>
            <table width="100%" height="35" border="0">
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
              <td><a href="CrearTransporte.php"><img src="imagenes/nueva_bodega.png" width="32" height="32" title="Nuevo Transporte" /></a></td>
              <td><a href="javascript:valtrans('guardar')"><img src="imagenes/guardar.png" alt="guardar" width="32" height="32" border="0" title="Guardar Información" /></a></td>
              <td><a href="BuscarTransporte.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Transporte"/></a></td>
              <?php if($transporte->estado == '2'){ ?>
              			<td><a href="javascript:valtrans('activar')"><img src="imagenes/activar_obra.png" alt="activar" width="32" height="32" border="0" /></a></td>
              <?php }else{ ?>
              			<td><img src="imagenes/activar_obra_opaco.png" alt="activar" width="32" height="32" border="0" /></td>
              <?php } ?>
              <?php if($transporte->estado == '2'){ ?>
              			<td><img src="imagenes/desactivar_obra_opaco.png" alt="desactivar" width="32" height="32" border="0" /></td>
                <?php }else{ ?>
                		<td><a href="javascript:valtrans('desactivar')"><img src="imagenes/desactivar_obra.png" alt="desactivar" width="32" height="32" border="0" /></a></td>
                 <?php } ?>
              <td><a href="javascript:valtrans('salir')"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="middle">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" valign="middle"><strong>EDITAR TRANSPORTE</strong></td>
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
                  <td width="4" align="left" valign="middle">&nbsp;</td>
                  <td colspan="5" align="center">Placa</td>
                  </tr>
                <tr>
                  <td align="center" valign="middle">&nbsp;</td>
                  <td colspan="5" align="center"><input name="placa" type="text" id="placa" size="30" maxlength="12" class="campos_mayus" value="<?php echo $transporte->placa; ?>" <?php if($transporte->estado=='2'){ echo 'disabled';} ?> />                    <input name="tarea" type="hidden" id="tarea" class="campos_mayus" /></td>
                  </tr>
                <tr>
                  <td align="center" valign="middle">&nbsp;</td>
                  <td width="200" align="left">&nbsp;</td>
                  <td width="4" align="left">&nbsp;</td>
                  <td width="151" align="left">&nbsp;</td>
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
