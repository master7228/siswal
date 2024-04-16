<?php
 session_start();
 if($_SESSION["autenticado"] == "1"){
	 include_once 'Proveedor.php';
	 $ver_proveedores = 0;
	 $a=false;
	 if(!empty ($_POST['select']) and $_POST['select'] == "*"){
		$_POST['palabra'] = "*";
	 }
	 if(!empty($_POST['select']) && !empty($_POST['palabra']) ){
		 $str = $_POST['palabra'];
		 $str = strtoupper($str);
		 $_POST['palabra']=$str;
		 $proveedor = new Proveedor("","","","","","","","","","","","","","","","","","","","","");
		 $resp = $proveedor->buscarProveedor($_POST['select'],$_POST['palabra']);
		 $_SESSION['proveedores'] = serialize($resp);
		 $ver_proveedores = 1;
	 }
	 if(!empty($_POST['tarea']) && $_POST['tarea']=='seleccionar'){
	 	$proveedores=unserialize($_SESSION['proveedores']);
		for($i=0; $i<count($proveedores); $i++){
			$proveedor = $proveedores[$i];
			if($proveedor->id==$_POST['id']){
				$_SESSION['proveedor']=serialize($proveedor);
				unset($_SESSION['proveedores']);
				echo "<script>window.close() </script>";
			}
		}
	 }

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Buscar Equipo a Seleccionar</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script src="js/validaciones.js" language="JavaScript"></script>
<script src="js/reloj.js" language="JavaScript"></script>

</head>

<body onLoad="mueveReloj();">
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
                    <td align="right" valign="top">
                    	<table width="128" border="0" align="right" cellpadding="2" cellspacing="2" > 
                    	<tr> 
                    		<th width="114" scope="col"><font id="cl"><strong>0</strong></font></th> 
                    	</tr> 
                    </table>
                    </td>
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
			<?php if($ver_proveedores == 0){?>
			<p>&nbsp;</p>
			<table width="350" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="middle"><table width="320" height="190" style="background-image:url(imagenes/fondo_buscar.png)" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="3" align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center" class="BuscarUsuario">BUSCAR PROVEEDOR A SELECCIONAR</td>
                  </tr>
                  <tr>
                    <td colspan="3"><input name="tarea" type="hidden" id="tarea"/>
                      <input name="id" type="hidden" id="id"/></td>
                  </tr>
                  <tr>
                    <td width="47%"><span class="BuscarUsuario" >Criterio de busqueda: </span></td>
                    <td width="2%">&nbsp;</td>
                    <td width="51%"><label>
                      <select name="select" id="select" style="height: 20px; width: 140px;" onchange="valcampobusquedaproveedor();">
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
                    <input name="palabra" type="text" id="palabra" class="campos_mayus" />
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
			<?php }else{
						if(sizeof($resp)!=0){
			?>
			  <table width="600" border="1" cellspacing="0" cellpadding="0">
						  <tr>
						    <td colspan="6" align="center"><strong>REGISTROS ENCONTRADOS </strong></td>
					      </tr>
						  <tr>
						    <td height="10" colspan="6" align="center">
							<input name="tarea" type="hidden" id="tarea"/>
					        <input name="id" type="hidden" id="id"/></td>
					      </tr>
                           <tr bgcolor="#999999">
							<td width="136" align="center"><strong>Rocumento del Proveedor</strong></td>
							<td width="319" align="center"><strong>Nombre del Proveedor</strong></td>
							<td width="77" align="center" valign="middle"><strong>Seleccionar</strong></td>
						  </tr>
						  <?php
							for ($i=0; $i<count($resp); $i++){
								$proveedor = $resp[$i];							
								 
							?>
						 
						  
				<tr align="left" class="TablaUsuarios">
								<td width="136" align="center"><?php echo $proveedor->documento; ?></a></td>
								<td width="319"><?php echo $proveedor->nombre1.' '.$proveedor->nombre2.' '.$proveedor->apellido1.' '.$proveedor->apellido2; ?></td>
							  <td width="77" align="center" valign="middle"><a href="javascript:seleccionarPro('<?php echo $proveedor->nombre1.' '.$proveedor->nombre2.' '.$proveedor->apellido1.' '.$proveedor->apellido2; ?>','<?php echo $proveedor->documento; ?>','seleccionar','<?php echo $proveedor->id; ?>')"><img src="imagenes/seleccionar.png" width="28" height="28" /></a></td>
				  </tr>
							
							 
				<?php
						}
						?>
			 
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
