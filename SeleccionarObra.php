<?php
session_start();
if($_SESSION["autenticado"] == "1"){
	 include_once 'Obra.php';
	 include_once 'Cliente.php';
	 include_once 'Municipio.php';
	 $ver_obras = 0;
	 $cliente = unserialize($_SESSION['cliente']);
	 if(!empty ($_POST['select']) and $_POST['select'] == "*"){
		$_POST['palabra'] = "*";
	 }
	  if(!empty ($_POST['select']) and $_POST['select'] == "1"){
		$_POST['select'] = "estado";
		$_POST['palabra'] = "1";
	 }
	  if(!empty ($_POST['select']) and $_POST['select'] == "2"){
		$_POST['select'] = "estado";
		$_POST['palabra'] = "2";
	 }
	 if(!empty($_POST['select']) && !empty($_POST['palabra'])){
		 $obra = new Obra("","","","","","","","","","","","","","","","","","","","","");
		 $resp = $obra->buscarObrasActivas($_POST['select'],$_POST['palabra'],$cliente->id);
		 $_SESSION['obras'] = serialize($resp);
		 $ver_obras = 1;
	 }
	 
	 if(!empty($_POST['tarea']) && $_POST['tarea']=='seleccionar'){
	 	$obras=unserialize($_SESSION['obras']);
		for($i=0; $i<count($obras); $i++){
			$obra = $obras[$i];
			if($obra->id==$_POST['id']){
				$_SESSION['obra']=serialize($obra);
				unset($_SESSION['obras']);
				echo "<script>window.opener.location.reload(); window.close();</script>";
			}
		}
	 }
	 

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Buscar Obras</title>
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
			<?php if($ver_obras == 0){?>
			<p>&nbsp;</p>
			<table width="350" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="middle"><table width="320" height="190" style="background-image:url(imagenes/fondo_buscar.png)" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="3" align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center" class="BuscarUsuario">BUSCAR OBRA </td>
                  </tr>
                  <tr>
                    <td colspan="3"><input name="tarea" type="hidden" id="tarea"/>
                      <input name="id" type="hidden" id="id"/></td>
                  </tr>
                  <tr>
                    <td width="47%"><span class="BuscarUsuario" >Criterio de busqueda: </span></td>
                    <td width="2%">&nbsp;</td>
                    <td width="51%"><label>
                      <select name="select" id="select" style="height: 20px; width: 150px;" onchange="valcampobusquedaObra(this.value);">
                        <option value="nombre">Nombre Obra</option>
                        <option value="nombre_cliente">Nombre Cliente</option>
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
			<?php }else{
						if(sizeof($resp)!=0){
			?>
						<table width="700" border="1" cellspacing="0" cellpadding="0">
						  <tr>
						    <td colspan="8" align="center"><strong>REGISTROS ENCONTRADOS </strong>
							  <input name="tarea" type="hidden" id="tarea"/>
					          <input name="id" type="hidden" id="id"/></td>
					      </tr>
						  <tr>
							<td width="78" align="center" bgcolor="#CCCCCC"><strong>Nro. de Obra</strong></td>
							<td width="156" align="center" bgcolor="#CCCCCC"><strong>Nombre de la Obra </strong></td>
							<td width="218" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Nombre del Cliente </strong></td>
							<td width="62" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Municipio</strong></td>
							<td width="78" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Seleccionar</strong></td>
						  </tr>
						  <?php
							for ($i=0; $i<count($resp); $i++){
								$obra = $resp[$i];
								$mun = new Municipio($obra->municipio,'','','');
								$municipio = $mun->buscarMpio('mun','');
								$muni = $municipio[0];
							?>
							<tr align="left" class="TablaUsuarios">
								<td width="78" align="center"><?php echo $obra->id; ?></a></td>
								<td width="156"><?php echo $obra->nombre; ?></td>
								<td width="218" align="left" valign="middle"><?php echo $obra->nombre_cliente; ?></td>
								<td width="62" align="center" valign="middle"><?php echo $muni->strdes_mpio; ?></td>
						      <td width="78" align="center" valign="middle"><a href="javascript:seleccionarObra('seleccionar','<?php echo $obra->id; ?>')"><img src="imagenes/seleccionar.png" width="28" height="28" title="Seleccionar Obra" /></a></td>
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