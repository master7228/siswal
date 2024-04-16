<?php
 session_start();
include_once 'Cliente.php';
include_once 'ContactoCliente.php';
if ($_SESSION["autenticado"] == "1") {
    $fecha = date('Y-m-d H:i');
	$anno_actual = date('Y');
	$cliente=unserialize($_SESSION['cliente']);
	$contacto = new Contactocliente('','','','','','','','','','','');
	$resp = $contacto->buscarContacto($cliente->id);
	if($resp){
		$ver_contactos=1;
	}else{
		$ver_contactos=0;
	}
	if(!empty($_POST['tarea']) and $_POST['tarea']=='activar'){
			$contacto = new Contactocliente("", "", "", "", "", "", "", "", "", "","","","","");
			$estado = $contacto->activarDesactivarContacto('1', $_POST['id']);
			$contacto->estado="1";
			if($estado){
				/*echo "<script>alert('El Contaco ha sido activado correctamente');</script> ";*/
				echo '<script>window.location="ListadoContactosDesactivadoscliente.php";</script>';
			}else{
				echo "<script>alert('El Contacto no pudo ser activado, intentelo nuevamente');</script> ";
				echo '<script>window.location="ListadoContactosDesactivadoscliente.php";</script>';
			}
		}
 
 	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Editar Contactos del Cliente</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script src="js/validaciones.js" language="JavaScript"></script>
<script src="js/reloj.js" language="JavaScript"></script>
<style type="text/css">
<!--
.style1 {font-size: 14px}

-->
</style>
</head>

<body topmargin="0" onLoad="mueveReloj();" onKeyDown = "showDown(window.event)">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><form action="" method="post" name="form1" class="FormGeneral" id="form1" target="_parent" enctype="multipart/form-data">
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
                    <td width="7%" align="right" valign="middle"><a href="logout.php"><img src="imagenes/eqsl_exit.png" width="30" height="30" border="0" title="Salir" /></a></td>
                  </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="middle"><table width="100" border="0" cellspacing="0" cellpadding="0">
            <tr align="center" valign="middle">
             
              <td><a href="EditarContactoscliente.php"><img src="imagenes/flecha.png" width="32" height="32" border="0" title="Volver" /></a></td>
			  </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center" valign="middle"><span class="style1">CONTACTOS DESACTIVADOS DEL CLIENTE</span></td>
        </tr>
        <tr>
          <td align="left" valign="middle">&nbsp;</td>
        </tr>
      </table>
      <table width="800" height="auto" border="0" cellspacing="0" cellpadding="8" style="background:url(imagenes/fondo_form.png) no-repeat;">
        <tr>
          <td align="center"><table width="783" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="819" align="center"><table width="700" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td colspan="7" align="center">&nbsp;</td>
                </tr>
                <tr>
                  <td width="225" align="center"><input name="id" type="hidden" id="id"/>
                      <input name="funcion" type="hidden" id="funcion" />
                      <input name="tarea" type="hidden" id="tarea" /></td>
                  <td width="175">&nbsp;</td>
                  <td width="100" align="center" valign="middle">&nbsp;</td>
                  <td width="100" align="center" valign="middle">&nbsp;</td>
                  <td width="100" align="center" valign="middle">&nbsp;</td>
                </tr>
                <tr align="center">
                  <td width="225" bgcolor="#CCCCCC">Nombre</td>
                  <td width="175" bgcolor="#CCCCCC">Cargo </td>
                  <td width="100" valign="middle" bgcolor="#CCCCCC">Telefono</td>
                  <td width="100" valign="middle" bgcolor="#CCCCCC">Email</td>
                  <td width="100" valign="middle" bgcolor="#CCCCCC">Activar</td>
                </tr>
                <?php
						if(!empty($ver_contactos) && $ver_contactos == '1'){ 
							for ($i=0; $i<count($resp); $i++){
								$contacto = $resp[$i];
								if($contacto->estado == '0'){
						?>
                <tr align="left" class="TablaUsuarios">
                  <td width="225"><?php echo $contacto->nombre; ?></td>
                  <td width="175"><?php echo $contacto->cargo; ?></td>
                  <td width="100" align="center" valign="middle"><?php echo $contacto->telefono; ?></td>
                  <td width="100" align="center" valign="middle"><?php echo $contacto->email; ?></td>
                  <td width="100" align="center" valign="middle"><a href="javascript:enviar_form_edit_contactos('activar','<?php echo $contacto->id; ?>')"><img src="imagenes/activar_user.png" width="28" height="28" border="0" /></a></td>
                </tr>
                <?php 	} 
							} 
						}else{
							echo 'no hay contactos';
						} 
						?>
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
