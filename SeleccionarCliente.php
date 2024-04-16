<?php
 session_start();
 if($_SESSION["autenticado"] == "1"){
	 include_once 'Cliente.php';
	 $ver_clientes = 0;
	 if(!empty ($_POST['select']) and $_POST['select'] == "*"){
		$_POST['palabra'] = "*";
	 }
	 if(!empty($_POST['select']) && !empty($_POST['palabra']) ){
		 $cliente = new Cliente("","","","","","","","","","","","","","","","","","","","","","","","","","","","","","");
		 $resp = $cliente->buscarClientesActivos($_POST['select'],$_POST['palabra']);
		 $_SESSION['clientes'] = serialize($resp);
		 $ver_clientes = 1;
	 }
	  
	  if(!empty($_POST['tarea']) && $_POST['tarea']=='seleccionar'){
	 	$clientes=unserialize($_SESSION['clientes']);
		for($i=0; $i<count($clientes); $i++){
			$cliente = $clientes[$i];
			if($cliente->id==$_POST['id']){
				$_SESSION['cliente']=serialize($cliente);
				unset($_SESSION['clientes']);
				unset($_SESSION['obra']);
				echo "<script>window.opener.location.reload(); window.close();</script>";
			}
		}
	 }
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Buscar Clientes</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script src="js/validaciones.js" language="JavaScript"></script>

</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><form id="form2" name="form2" method="post" action="" class="TablaUsuarios">
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
                          </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center">
			<?php if($ver_clientes == 0){?>
			<p>&nbsp;</p>
			<table width="350" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="middle"><table style="background-image:url(imagenes/fondo_buscar.png)" width="320" height="190" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="3" align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center" class="BuscarUsuario">BUSCAR CLIENTE A SELECCIONAR</td>
                  </tr>
                  <tr>
                    <td colspan="3"><input name="tarea" type="hidden" id="tarea"/>
                      <input name="id" type="hidden" id="id"/></td>
                  </tr>
                  <tr>
                    <td width="47%"><span class="BuscarUsuario" >Criterio de busqueda: </span></td>
                    <td width="2%">&nbsp;</td>
                    <td width="51%"><label>
                      <select name="select" style="height: 20px; width: 150px;" id="select" onchange="valcampobusquedaClienteEditar();">
                        <option value="documento">Identificación</option>
                        <option value="nombre1">Nombre</option>
                        <option value="apellido1">Apellidos</option>
                        <option value="*">Todos</option>
                      </select>
                    </label></td>
                  </tr>
                  <tr>
                    <td height="19" colspan="3">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="30"><span class="BuscarUsuario" >Informaci&oacute;n a buscar:</span></td>
                    <td>&nbsp;</td>
                    <td><label>
                    <input name="palabra" type="text" id="palabra" />
</label></td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center"><input type="submit" name="Submit" value="Buscar" /></td>
                    </tr>
                  <tr>
                    <td colspan="3" align="center">&nbsp;</td>
                  </tr>
                  
                </table></td>
              </tr>
            </table>
			<p>
			  <?php }else{
						if(sizeof($resp)!=0){
			?>
			  </p>
			<table width="600" border="1" cellspacing="0" cellpadding="0">
			    <tr>
						    <td colspan="7" align="center"><strong>
						      <input name="tarea" type="hidden" id="tarea"/>
                              <input name="id" type="hidden" id="id"/>
                            REGISTROS ENCONTRADOS </strong></td>
					      </tr>
						  <tr align="center">
							<td width="175" bgcolor="#CCCCCC"><strong>N&uacute;mero de Identificaci&oacute;n</strong></td>
							<td width="279" bgcolor="#CCCCCC"><strong>Nombre del Cliente </strong></td>
							<td width="78" valign="middle" bgcolor="#CCCCCC"><strong>Seleccionar</strong></td>
						  </tr>
						  <?php
							for ($i=0; $i<count($resp); $i++){
								$cliente = $resp[$i];
							?>
							<tr align="left" class="TablaUsuarios">
								<td width="175"><?php echo $cliente->documento; ?></a></td>
								<td width="279"><?php echo ($cliente->nombre1."  ".$cliente->nombre2."  ".$cliente->apellido1."  ".$cliente->apellido2); ?></td>
							  <td width="78" align="center" valign="middle"><a href="javascript:seleccionarCliente('seleccionar','<?php echo $cliente->id; ?>')"><img src="imagenes/seleccionar.png" width="28" height="28" title="Seleccionar Cliente" /></a></td>
							</tr>
						<?php } ?>
			  </table>
						<?php
						}else{
							echo "No hay resultados para esta consulta";
						}
					}
						?>			
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
