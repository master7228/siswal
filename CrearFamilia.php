<?php
 session_start();
include_once 'Familia.php';
include_once 'Registro.php';
if ($_SESSION["autenticado"] == "1") {
    $fecha = date('Y-m-d H:i');

    if(!empty($_POST['tarea'])){
	$str = $_POST['descripcion'];
	$str = strtoupper($str);
	$_POST['descripcion']=$str;
	
    if ($_POST['tarea'] == 'guardar') {
		$familias = new Familia('','','','');
		$id = $familias->consultarUltimoId();
		if($id != ''){
			$id_familia = $id + 1;
		}else{
			$id_familia = 1;
		}
		if($id_familia < 10){
			$codigo='0'.$id_familia;	
		}else{
			$codigo = $id_familia;
		}
		$familia = new Familia('',$codigo,$_POST['descripcion'],'1');
        $ConsultarFamilia=$familia->existeFamilia();
		if(!$ConsultarFamilia){
			$guardar = $familia->guardarFamilia();
			if ($guardar) {
				$consul = $familia->buscarFamilia('descripcion',$_POST['descripcion']);
				$fam=$consul[0];
				$registro= new Registro('',$_SESSION['id_usuario'],'CREAR FAMILIA EQUIPOS',$fam->id,$fam->descripcion,$fecha);
				$guardar_registro = $registro->guardarRegistro();
				echo "<script>alert ('La Familia fue creada con exito');</script>";
				echo "<script>window.location.href='MenuFamiliaEquipos.php';</script>";
			} else {
				echo "<script>alert ('No se pudo crear la Familia, por favor intenta de nuevo');</script>";
				echo "<script>window.location.href='CrearFamilia.php';</script>";
			}
		}else{
			echo "<script>alert ('La Familia ya existe, verifica por favor');</script>";
			echo "<script>window.location.href='CrearFamilia.php';</script>";
		}
    } else if ($_POST['tarea'] == 'salir') {
        echo "<script>window.location.href='MenuFamiliaEquipos.php';</script>";
    }
    }
 	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Crear Familia</title>
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
              <td><a href="CrearFamilia.php"><img src="imagenes/nueva_bodega.png" width="32" height="32" title="Nuevo Familia" /></a></td>
              <td><a href="javascript:valgrupo('guardar')"><img src="imagenes/guardar.png" alt="guardar" width="32" height="32" border="0" title="Guardar Información" /></a></td>
              <td><a href="BuscarFamilia.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Familia"/></a></td>
              <td><img src="imagenes/activar_obra_opaco.png" width="32" height="35" title="Activar Familia" /></td>
              <td><img src="imagenes/desactivar_obra_opaco.png" width="31" height="35" title="Desactivar Familia" /></td>
              <td><a href="MenuFamiliaEquipos.php" target="_parent"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="middle">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" valign="middle"><strong>CREAR FAMILIA EQUIPOS</strong></td>
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
                  <td colspan="5" align="center">Descripción</td>
                  </tr>
                <tr>
                  <td align="center" valign="middle">&nbsp;</td>
                  <td colspan="5" align="center"><input name="descripcion" type="text" id="descripcion" size="50" maxlength="50" class="campos_mayus" />                    <input name="tarea" type="hidden" id="tarea" class="campos_mayus" /></td>
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
