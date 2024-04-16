<?php
 session_start();
 if(!empty($_SESSION["autenticado"]) && $_SESSION["autenticado"] == "1"){
	 include_once 'ValorTransporte.php';
	 $ver_clientes = 0;
	 if(!empty ($_POST['select']) and $_POST['select'] == "*"){
		$_POST['palabra'] = "*";
	 }
	 if(!empty($_SESSION["autenticado"]) && $_SESSION["autenticado"] == "1"){
		 $valortransporte = new ValorTransporte("","","","");
		 $resp = $valortransporte->buscarValorTransporte("*","*");
		 $_SESSION['valores'] = serialize($resp);
		 $ver_clientes = 1;
	 }
	  
	  if(!empty($_POST['tarea']) && $_POST['tarea']=='seleccionar'){
	 	$valores=unserialize($_SESSION['valores']);
		for($i=0; $i<count($valores); $i++){
			$valor = $valores[$i];
			if($valor->id==$_POST['id']){
				$_SESSION['valor']=serialize($valor);
				unset($_SESSION['valores']);
				echo "<script>window.opener.location.reload(); window.close();</script>";
			}
		}
	 }
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Buscar Valor Transporte</title>
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
                    <td colspan="3" align="center" class="BuscarUsuario">BUSCAR VALOR TRANSPORTE</td>
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
                        <option value="ciudad">Ubicacion</option>
                        <option value="valor">Valor</option>
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
							<td width="225" bgcolor="#CCCCCC"><strong>Ubicaci&oacute;n</strong></td>
							<td width="229" bgcolor="#CCCCCC"><strong>Valor</strong></td>
							<td width="78" valign="middle" bgcolor="#CCCCCC"><strong>Seleccionar</strong></td>
						  </tr>
						  <?php
							for ($i=0; $i<count($resp); $i++){
								$valor = $resp[$i];
							?>
							<tr align="left" class="TablaUsuarios">
								<td width="225"><?php echo $valor->ciudad; ?></a></td>
								<td width="229"><?php echo $valor->valor; ?></td>
							  <td width="78" align="center" valign="middle"><a href="javascript:seleccionarValorTransporte('seleccionar','<?php echo $valor->id; ?>')"><img src="imagenes/seleccionar.png" width="28" height="28" title="Seleccionar Valor Transporte" /></a></td>
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
