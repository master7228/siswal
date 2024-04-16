<?php
 session_start();
 if($_SESSION["autenticado"] == "1"){
	 include_once 'Bodega.php';
	 include_once 'ContactoBodega.php';
	 $bodega= unserialize($_SESSION['bodega']);
	 $contactos = unserialize($_SESSION['contactos']);
		
		if(!empty($_POST['tarea']) && $_POST['tarea']=='guardar'){
			$bodega1= new Bodega('','',$_POST['nombre'],'','','','','','','');
			$ConsultarBodega=$bodega1->existeBodega();
					if(!$ConsultarBodega){
						$cambiarId = $bodega1->cambiarIdBodega($bodega->nombre);
					if ($cambiarId){
						$cont = new ContactoBodega('',$_POST['nombre'],'','','','','','');
						for($i=0; $i<count($contactos); $i++){
							$contacto=$contactos[$i];
							$contId= $cont->cambiarIdBodegaContacto($contacto->id);
						}
						unset($_SESSION['bodega']);
						$consulta= $bodega1->buscarBodega('*',$_POST['nombre']);
						$bodega_nuevo=$consulta[0];
						$_SESSION['bodega']=serialize($bodega_nuevo);
						serialize($_SESSION['bodega']);
						echo "<script>alert ('El nombre de la bodega ha sido modificado correctamente');</script>";
						echo "<script>window.location.href='EditarBodega.php';</script>";
					} else {
						echo "<script>alert ('No se pudo cambiar el nombre de la bodega, por favor intenta de nuevo');</script>";
					}
				}else{
					echo "<script>alert ('El nombre nuevo ya esta asignado para otra bodega, verifica por favor');</script>";
				}
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cambiar el Nombre de la Bodega</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script src="js/validaciones.js" language="JavaScript"></script>
 <script language="JavaScript" src ="js/digitov.js"></script> 

</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><form id="form1" name="form1" method="post" action="" class="TablaUsuarios">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="middle"><table width="100%" height="35" border="0">
              <tr>
                <td width="196"><img src="imagenes/logoge.png" alt="Himed" width="200" height="40" /></td>
                <td align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr align="right" valign="middle">
                          <td><span class="Estilo6">Usuario: <?php echo $_SESSION["nombre"].' '.$_SESSION['apellido']; ?></span></td>
                          <td width="50"><a href="logout.php"><img src="imagenes/eqsl_exit.png" width="32" height="32" border="0" title="salir" /></a></td>
                        </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="left" valign="middle"><table width="100" border="0" cellspacing="0" cellpadding="0">
              <tr align="center" valign="middle">
                <td><a href="javascript:valIdBodega('guardar')"><img src="imagenes/guardar.png" width="32" height="32" title="Guardar Información" /></a></td>
                <td><a href="EditarBodega.php"><img src="imagenes/flecha.png" width="32" height="32" border="0"  title="Regresar sin guardar"/></a></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center">
			<p>&nbsp;</p>
			<table width="400" height="225px" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="center" valign="middle" style="background-image:url(imagenes/fondo_buscar_usuarios.png); background-repeat:no-repeat; backface-visibility: !important" ><table width="400" height="188" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="3" align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="24" colspan="3" align="center" class="BuscarUsuario">CAMBIO DEL NOMBRE DE LA BODEGA</td>
                  </tr>
                  <tr>
                    <td height="22" colspan="3"><input name="tarea" type="hidden" id="tarea"/>
                      </td>
                  </tr>
                  <tr>
                    <td height="30"><span class="BuscarUsuario" >Nombre Actual </span></td>
                    <td>&nbsp;</td>
                    <td><input name="nombre_ant" type="text" disabled id="nombre_ant" value="<?php echo $bodega->nombre; ?>" size="15" /></td>
                  </tr>
                  <tr>
                    <td height="30">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="30"><span class="BuscarUsuario">Nuevo Nombre</span></td>
                    <td>&nbsp;</td>
                    <td><input name="nombre" type="text" id="nombre" size="15" /></td>
                  </tr>
                  <tr>
                    <td width="32%" height="30">&nbsp;</td>
                    <td width="1%">&nbsp;</td>
                    <td width="67%">&nbsp;</td>
                  </tr>
                  </table></td>
              </tr>
            </table>
			
            </td>
          </tr>
          <tr>
            <td align="center" valign="middle"></td>
          </tr>
        </table>
        <p>&nbsp;</p>
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
