<?php
 session_start();
include_once 'ValorTransporte.php';
include_once 'Registro.php';
if ($_SESSION["autenticado"] == "1") {
    $fecha = date('Y-m-d H:i');
	$valorTransporte= unserialize($_SESSION['valortransporte']);
    if(!empty($_POST['tarea'])){
		if($valorTransporte->estado=='1'){
			$str = $_POST['ciudad'];
			$str = strtoupper($str);
			$_POST['ciudad']=$str;
		}
		
		if ($_POST['tarea'] == 'guardar') {
			$valortransporte = new ValorTransporte('',$_POST['ciudad'],$_POST['valor'],'1');
			$ConsultarValorTransporte=$valortransporte->existeValorTransporte();
			if(!$ConsultarValorTransporte){
				$guardar = $valortransporte->editarValorTransporte($valorTransporte->id);
				if ($guardar) {
					$consul = $valortransporte->buscarValorTransporteDos($_POST['ciudad'],$_POST['valor']);
					$tran=$consul[0];
					$registro= new Registro('',$_SESSION['id_usuario'],'EDITAR VALOR TRANSPORTE',$tran->id,$tran->valor,$fecha);
					$guardar_registro = $registro->guardarRegistro();
					echo "<script>alert ('El Valor Transporte fue editado con exito');</script>";
					echo "<script>window.location.href='MenuValorTransporte.php';</script>";
				} else {
					echo "<script>alert ('No se pudo editar el valor transporte, por favor intenta de nuevo');</script>";
					echo "<script>window.location.href='EditarValorTransporte.php';</script>";
				}
			}else{
				echo "<script>alert ('El valor transporte ya existe con estas especificaciones, verifica por favor');</script>";
				echo "<script>window.location.href='EditarValorTransporte.php';</script>";
			}
		} 
		
		if(!empty($_POST['tarea']) and $_POST['tarea']=='activar'){
			$est_transporte= new ValorTransporte("", "", "", "");
			$estado = $est_transporte->activarDesactivarValorTransporte('1', $valorTransporte->id);
			$valorTransporte->estado="1";
			if($estado){
				$consul = $valorTransporte->buscarValorTransporteDos($valorTransporte->ciudad,$valorTransporte->valor);
				$usu=$consul[0];
				$registro= new Registro('',$_SESSION['id_usuario'],'ACTIVAR VALOR TRANSPORTE',$usu->id,$usu->valor,$fecha);
				$guardar_registro = $registro->guardarRegistro();
				$_SESSION['valortransporte']=serialize($valorTransporte);
				echo "<script>alert('El Valor Transporte ha sido activado correctamente');</script> ";
			}else{
				echo "<script>alert('El Valor Transporte no pudo ser activado, intentelo nuevamente');</script> ";
				echo '<script>window.location="EditarValorTransporte.php";</script>';
			}
		}
		
		if(!empty($_POST['tarea']) and $_POST['tarea']=='desactivar'){
			$est_transporte= new ValorTransporte("", "", "", "");
			$estado = $est_transporte->activarDesactivarValorTransporte('2', $valorTransporte->id);
			$valorTransporte->estado="2";
			if($estado){
				$consul = $valorTransporte->buscarValorTransporteDos($_POST['ciudad'],$_POST['valor']);
				$usu=$consul[0];
				$registro= new Registro('',$_SESSION['id_usuario'],'DESACTIVAR VALOR TRANSPORTE',$usu->id,$usu->valor,$fecha);
				$guardar_registro = $registro->guardarRegistro();
				$_SESSION['valortransporte']=serialize($valorTransporte);
				echo "<script>alert('El Valor Transporte ha sido desactivado correctamente');</script> ";
				echo '<script>window.location="EditarValorTransporte.php";</script>';
			}else{
				echo "<script>alert('El Valor Transporte no pudo ser desactivado, intentelo nuevamente');</script> ";
				echo '<script>window.location="EditarValorTransporte.php";</script>';
			}
		}
		
		if ($_POST['tarea'] == 'salir') {
			echo "<script>window.location.href='MenuValorTransporte.php';</script>";
		}
    }
 	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Editar Valor Transporte</title>
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
              <td><a href="CrearValorTransporte.php"><img src="imagenes/nueva_bodega.png" width="32" height="32" title="Nuevo Valor Transporte" /></a></td>
              <td><a href="javascript:valvalortrans('guardar')"><img src="imagenes/guardar.png" alt="guardar" width="32" height="32" border="0" title="Guardar Información" /></a></td>
              <td><a href="BuscarValorTransporte.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Valor Transporte"/></a></td>
              <?php if($valorTransporte->estado=='1'){ ?>
              <td><img src="imagenes/activar_obra_opaco.png" width="32" height="35" title="Activar Valor Transporte" /></td>
              <?php }else{ ?>
              <td><a href="javascript:valvalortrans('activar')"><img src="imagenes/activar_obra.png" width="32" height="35" title="Activar Valor Transporte" /></a></td>
              <?php }?>
              <?php if($valorTransporte->estado=='2'){ ?>
              <td><img src="imagenes/desactivar_obra_opaco.png" width="31" height="35" title="Desactivar Valor Transporte" /></td>
              <?php }else{ ?>
               <td><a href="javascript:valvalortrans('desactivar')"><img src="imagenes/desactivar_obra.png" width="31" height="35" title="Desactivar Valor Transporte" /></a></td>
               <?php }?>
              <td><a href="MenuValorTransporte.php" target="_parent"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="middle">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" valign="middle"><strong>EDITAR VALOR TRANSPORTE</strong></td>
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
                  <td align="center">Ciudad</td>
                  <td align="center">Valor</td>
                  </tr>
                <tr>
                  <td align="center" valign="middle">&nbsp;</td>
                  <td width="345" align="center"><input name="ciudad" type="text" id="ciudad" size="30" maxlength="25" class="campos_mayus" value="<?php echo $valorTransporte->ciudad; ?>" <?php if($valorTransporte->estado=='2'){ echo 'disabled'; } ?> onKeyPress="javascript:return Letras(event)"/>                    <input name="tarea" type="hidden" id="tarea" class="campos_mayus" /></td>
                  <td width="303" align="center"><input name="valor" type="text" id="valor" size="30" maxlength="12" class="campos_mayus" value="<?php echo $valorTransporte->valor; ?>" <?php if($valorTransporte->estado=='2'){ echo 'disabled'; } ?> onKeyPress="javascript:return Numeros(event)"/></td>
                  </tr>
                <tr>
                  <td align="center" valign="middle">&nbsp;</td>
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
