<?php
 session_start();
include_once 'ConceptoReparacion.php';
include_once 'Registro.php';
if ($_SESSION["autenticado"] == "1") {
    $fecha = date('Y-m-d H:i');
	$concepto=unserialize($_SESSION['concepto']);
	if(!empty($_POST['tarea']) and $_POST['tarea']=='guardar'){
		$str = $_POST['descripcion'];
		$str = strtoupper($str);
		$_POST['descripcion']=$str;
			$edit_concepto= new ConceptoReparacion('',$_POST['descripcion'],$_POST['valor'],'1');
			if($concepto->descripcion!=$_POST['descripcion']){
				$cons=$edit_concepto->existeConceptoReparacion();
				if($cons!=0){			
					echo "<script>alert ('El Concepto de Reparacion que intenta ingresar ya se encuentra registrado, inténtalo de nuevo');</script> ";
				}else{
					$editar= $edit_concepto->editarConceptoReparacion($concepto->id);
					$_SESSION['concepto']=serialize($edit_concepto);
					if($editar){
						$consul = $concepto->buscarConceptoReparacion('descripcion',$_POST['descripcion']);
						$con=$consul[0];
						$registro= new Registro('',$_SESSION['id_usuario'],'EDITAR CONCEPTO REPARACION',$con->id,$con->descripcion,$fecha);
						$guardar_registro = $registro->guardarRegistro();
						echo "<script>alert('El Concepto de Reparacoin ha sido actualizado correctamente');</script> ";
						echo '<script>window.location="MenuConceptoReparacion.php";</script>';
					}else{
						echo "<script>alert('El Concepto de Reparacion no se pudo actualizar, intentelo nuevamente');</script> ";
						echo '<script>window.location="EditarConceptoReparacion.php";</script>';
					}				
				}		
			}else{
					$editar= $edit_concepto->editarConceptoReparacion($concepto->id);
					$_SESSION['concepto']=serialize($edit_concepto);
					if($editar){
						$consul = $concepto->buscarConceptoReparacion('descripcion',$_POST['descripcion']);
						$con=$consul[0];
						$registro= new Registro('',$_SESSION['id_usuario'],'EDITAR CONCEPTO REPARACION',$con->id,$con->descripcion,$fecha);
						$guardar_registro = $registro->guardarRegistro();
						echo "<script>alert('El Concepto de Reparacoin ha sido actualizado correctamente');</script> ";
						echo '<script>window.location="MenuConceptoReparacion.php";</script>';
					}else{
						echo "<script>alert('El Concepto de Reparacion no se pudo actualizar, intentelo nuevamente');</script> ";
						echo '<script>window.location="EditarConceptoReparacion.php";</script>';
					}				
				}		
		}
		
		if(!empty($_POST['tarea']) and $_POST['tarea']=='activar'){
			$est_concepto= new ConceptoReparacion("", "", "", "");
			$estado = $est_concepto->actDesConceptoReparacion('1', $concepto->id);
			$concepto->estado="1";
			if($estado){
				$consul = $concepto->buscarConceptoReparacion('descripcion',$concepto->descripcion);
				$con=$consul[0];
				$registro= new Registro('',$_SESSION['id_usuario'],'ACTIVAR CONCEPTO REPARACION',$con->id,$con->descripcion,$fecha);
				$guardar_registro = $registro->guardarRegistro();
				$_SESSION['concepto']=serialize($concepto);
				echo "<script>alert('El Concepto de Reparacion ha sido activado correctamente');</script> ";
			}else{
				echo "<script>alert('El Concepto de Reparacion no pudo ser activado, intentelo nuevamente');</script> ";
				echo '<script>window.location="EditarConceptoReparacion.php";</script>';
			}
		}
		
		if(!empty($_POST['tarea']) and $_POST['tarea']=='desactivar'){
			$est_concepto= new ConceptoReparacion("", "", "", "");
			$estado = $est_concepto->actDesConceptoReparacion('2', $concepto->id);
			$concepto->estado="2";
			if($estado){
				$consul = $concepto->buscarConceptoReparacion('descripcion',$concepto->descripcion);
				$con=$consul[0];
				$registro= new Registro('',$_SESSION['id_usuario'],'ACTIVAR CONCEPTO REPARACION',$con->id,$con->descripcion,$fecha);
				$guardar_registro = $registro->guardarRegistro();
				$_SESSION['concepto']=serialize($concepto);
				echo "<script>alert('El Concepto de Reparacion ha sido desactivado correctamente');</script> ";
			}else{
				echo "<script>alert('El Concepto de Reparacion no pudo ser desactivado, intentelo nuevamente');</script> ";
				echo '<script>window.location="EditarConceptoReparacion.php";</script>';
			}
		}
		
		if(!empty($_POST['tarea']) && $_POST['tarea'] == 'salir'){
				unset($_SESSION['concepto']);
				echo "<script>window.location.href='MenuConceptoReparacion.php';</script>";
		}
 	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Editar Concepto Reparacion</title>
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
              <td><a href="CrearClase.php"><img src="imagenes/nueva_bodega.png" width="32" height="32" title="Nueva Clase" /></a></td>
              <td><a href="javascript:valgrupo('guardar')"><img src="imagenes/guardar.png" alt="guardar" width="32" height="32" border="0" title="Guardar Información" /></a></td>
              <td><a href="BuscarClase.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Clase"/></a></td>
              <?php if($concepto->estado == '2'){ ?>
              			<td><a href="javascript:valgrupo('activar')"><img src="imagenes/activar_obra.png" alt="activar" width="32" height="32" border="0" title="Activar Clase" /></a></td>
              <?php }else{ ?>
              			<td><img src="imagenes/activar_obra_opaco.png" alt="activar" width="32" height="32" border="0" /></td>
              <?php } ?>
              <?php if($concepto->estado == '2'){ ?>
              			<td><img src="imagenes/desactivar_obra_opaco.png" alt="desactivar" width="32" height="32" border="0" /></td>
                <?php }else{ ?>
                		<td><a href="javascript:valgrupo('desactivar')"><img src="imagenes/desactivar_obra.png" alt="desactivar" width="32" height="32" border="0" title="Desactivar Clase"/></a></td>
                 <?php } ?>
              <td><a href="javascript:valgrupo('salir')"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="middle">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" valign="middle"><strong>EDITAR CONCEPTO DE REPARACION</strong></td>
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
                  <td width="176" align="center">Descripcion</td>
                  <td width="177" align="center">Valor</td>
                  </tr>
                <tr>
                  <td align="center" valign="middle">&nbsp;</td>
                  <td align="center"><input name="descripcion" type="text" id="descripcion" size="50" maxlength="50" class="campos_mayus" value="<?php echo $concepto->descripcion; ?>" <?php if($concepto->estado=='2'){ echo 'disabled';} ?> />                    <input name="tarea" type="hidden" id="tarea" class="campos_mayus" /></td>
                  <td align="center"><input name="valor" type="text" id="valor" size="20" maxlength="50" class="campos_mayus" onkeypress="javascript:return Numeros(event)" value="<?php echo $concepto->valor; ?>" <?php if($concepto->estado=='2'){ echo 'disabled';} ?> /></td>
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
