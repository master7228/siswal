<?php
 session_start();
include_once 'Cupo.php';
include_once 'Registro.php';
if ($_SESSION["autenticado"] == "1") {
    $fecha = date('Y-m-d H:i');

    if(!empty($_POST['tarea'])){
	$str = $_POST['valor'];
	$str = strtoupper($str);
	$_POST['valor']=$str;
	
    if ($_POST['tarea'] == 'guardar') {
        $cupo = new cupo('',$_POST['valor'],'1');
        $ConsultarCupo=$cupo->existeCupo();
		if(!$ConsultarCupo){
			$guardar = $cupo->guardarCupo();
			if ($guardar) {
				$consul = $cupo->buscarCupo('valor',$_POST['valor']);
				$cup=$consul[0];
				$registro= new Registro('',$_SESSION['id_usuario'],'CREAR CUPO',$cup->id,$cup->valor,$fecha);
				$guardar_registro = $registro->guardarRegistro();
				echo "<script>alert ('El Cupo fue creado con exito');</script>";
				echo "<script>window.location.href='MenuCupos.php';</script>";
			} else {
				echo "<script>alert ('No se pudo crear el cupo, por favor intenta de nuevo');</script>";
				echo "<script>window.location.href='CrearCupo.php';</script>";
			}
		}else{
			echo "<script>alert ('El cupo ya existe con este valor, verifica por favor');</script>";
			echo "<script>window.location.href='CrearCupo.php';</script>";
		}
    } else if ($_POST['tarea'] == 'salir') {
        echo "<script>window.location.href='MenuCupo.php';</script>";
    }
    }
 	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Crear Cupo</title>
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
              <td><a href="CrearCupo.php"><img src="imagenes/nueva_bodega.png" width="32" height="32" title="Nuevo Cupo" /></a></td>
              <td><a href="javascript:valcupo('guardar')"><img src="imagenes/guardar.png" alt="guardar" width="32" height="32" border="0" title="Guardar Información" /></a></td>
              <td><a href="BuscarCupo.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Cupo"/></a></td>
              <td><img src="imagenes/activar_obra_opaco.png" width="32" height="35" title="Activar Cupo" /></td>
              <td><img src="imagenes/desactivar_obra_opaco.png" width="31" height="35" title="Desactivar Cupo" /></td>
              <td><a href="MenuCupos.php" target="_parent"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="middle">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" valign="middle"><strong>CREAR CUPO</strong></td>
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
                  <td colspan="5" align="center">Valor</td>
                  </tr>
                <tr>
                  <td align="center" valign="middle">&nbsp;</td>
                  <td colspan="5" align="center"><input name="valor" type="text" id="valor" size="30" maxlength="12" class="campos_mayus" onKeyPress="javascript:return Numeros(event)"/>                    <input name="tarea" type="hidden" id="tarea" class="campos_mayus" /></td>
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
