<?php
 session_start();
 if($_SESSION["autenticado"] == "1"){
	 include_once 'Proveedor.php';
	 include_once 'ContactoProveedor.php';
	 include_once 'Documento.php';
		$proveedor= unserialize($_SESSION['proveedor']);
		$contactos = unserialize($_SESSION['contactos']);
		$documento = new Documento('','','');
		$documentos = $documento->getDocumentos();
		
		if(!empty($_POST['tarea']) && $_POST['tarea']=='guardar'){
			$proveedor1= new Proveedor('',$_POST['tipo_doc'],$_POST['documento'],$_POST['dv'],'','','','','','','','','','','','','','','','','','');
			$ConsultarProveedor=$proveedor1->existeProveedor();
					if(!$ConsultarProveedor){
						$cambiarId= $proveedor1->cambiarIdProveedor($proveedor->documento);
					if ($cambiarId) {
						$cont = new ContactoProveedor('',$_POST['documento'],'','','','','','','','','','','','');
						for($i=0; $i<count($contactos); $i++){
							$contacto=$contactos[$i];
							$contId= $cont->cabiarIdProveedorContacto($contacto->id);
						}
						unset($_SESSION['proveedor']);
						$consulta= $proveedor1->buscarProveedor('documento',$_POST['documento']);
						$proveedor_nuevo=$consulta[0];
						$_SESSION['proveedor']=serialize($proveedor_nuevo);
						serialize($_SESSION['proveedor']);
						echo "<script>alert ('El Documento del proveedor ha sido modificado correctamente');</script>";
						echo "<script>window.location.href='EditarProveedor.php';</script>";
					} else {
						echo "<script>alert ('No se pudo cambiar el documento del proveedor, por favor intenta de nuevo');</script>";
						/*echo "<script>window.location.href='CrearUsuario.php';</script>";*/
					}
				}else{
					echo "<script>alert ('Este docuemento nuevo ya existe con otro proveedor, verifica por favor');</script>";
					/*echo "<script>window.location.href='CrearUsuario.php';</script>";*/
				}
		}
		
			function calcularDV($nit) {
    if (! is_numeric($nit)) {
        return false;
    }
 
    $arr = array(1 => 3, 4 => 17, 7 => 29, 10 => 43, 13 => 59, 2 => 7, 5 => 19, 
    8 => 37, 11 => 47, 14 => 67, 3 => 13, 6 => 23, 9 => 41, 12 => 53, 15 => 71);
    $x = 0;
    $y = 0;
    $z = strlen($nit);
    $dv = '';
    
    for ($i=0; $i<$z; $i++) {
        $y = substr($nit, $i, 1);
        $x += ($y*$arr[$z-$i]);
    }
    
    $y = $x%11;
    
    if ($y > 1) {
        $dv = 11-$y;
        return $dv;
    } else {
        $dv = $y;
        return $dv;
    }
    
}
		
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cambio de Documento del Proveedor</title>
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
                <td><a href="javascript:valIdProveedor('guardar')"><img src="imagenes/guardar.png" width="32" height="32" title="Guardar Informaci�n" /></a></td>
                <td><a href="EditarProveedor.php"><img src="imagenes/flecha.png" width="32" height="32" border="0"  title="Regresar sin guardar"/></a></td>
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
                <td align="center" valign="middle" style="background-image:url(imagenes/fondo_buscar_usuarios.png); background-repeat:no-repeat; backface-visibility: !important" ><table width="400" height="201" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="3" align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center" class="BuscarUsuario">CAMBIO DEL DOCUMENTO PROVEEDOR </td>
                  </tr>
                  <tr>
                    <td colspan="3"><input name="tarea" type="hidden" id="tarea"/>
                      </td>
                  </tr>
                  <tr>
                    <td height="30"><span class="BuscarUsuario" >Documento Actual </span></td>
                    <td>&nbsp;</td>
                    <td><input name="documento_ant" type="text" disabled id="documento_ant" value="<?php echo $proveedor->documento; ?>" size="15" /> 
                    - 
                      <input name="dv1" type="text" size="1" id="dv1" disabled  value="<?php echo $proveedor->dv; ?>" /></td>
                  </tr>
                  <tr>
                    <td height="30">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="30"><span class="BuscarUsuario" >Tipo Documento </span></td>
                    <td>&nbsp;</td>
                    <td><select name="tipo_doc" id="tipo_doc" class="campos_mayus"  onchange="valcamposproveedor();" onfocus="valcamposproveedor();" >
								<?php 
										for($i=1;$i<sizeof($documentos);$i+=2) {
										if($proveedor->documento == $documentos[$i]){
											echo "<option selected=\"selected\" value=\"".$documentos[$i+1]."\">".$documentos[$i+2]."</option>\n";
										}else{
											echo "<option value=\"".$documentos[$i+1]."\">".$documentos[$i+2]."</option>\n";
										}
									}
									$documento = $proveedor->documento;
								?>
								</select></td>
                  </tr>
                  <tr>
                    <td width="32%" height="30"><span class="BuscarUsuario" >Documento Nuevo</span></td>
                    <td width="1%">&nbsp;</td>
                    <td width="67%"><label>
                    <input name="documento" onblur="CalcularDv()" type="text" id="documento" size="15" /> 
                    - 
                    <input name="dv" type="text" size="1" id="dv" readonly="true"/>
</label></td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center">&nbsp;</td>
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
	echo "<script>alert ('No est� autenticado en el sistema');</script>";
	echo "<script>window.location.href='index.php';</script>";
 }
?>
