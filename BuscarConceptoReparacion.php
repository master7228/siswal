<?php
 session_start();
 if($_SESSION["autenticado"] == "1"){
	 include_once 'ConceptoReparacion.php';
	 $ver_conceptos = 0;
	 if(!empty ($_POST['select']) and $_POST['select'] == "*"){
		$_POST['palabra'] = "*";
	 }
	 if(!empty($_POST['select']) && !empty($_POST['palabra']) ){
		 $concepto = new ConceptoReparacion("","","","");
		 $resp = $concepto->buscarConceptoReparacion($_POST['select'],$_POST['palabra']);
		 $_SESSION['conceptos'] = serialize($resp);
		 $ver_conceptos= 1;
	 }
	  
	 if(!empty($_POST['tarea']) && $_POST['tarea'] == 'editar'){
	 	$conceptos=unserialize($_SESSION['conceptos']);
		for($i=0; $i<count($conceptos); $i++){
			$concepto = $conceptos[$i];
			if($concepto->id==$_POST['id']){
				$_SESSION['concepto']=serialize($concepto);
				unset($_SESSION['conceptos']);
				echo "<script> window.location.href='EditarConceptoReparacion.php';</script>";
			}
		}
	 }
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Buscar Concepto Reparacion</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script src="js/validaciones.js" language="JavaScript"></script>
<script src="js/reloj.js" language="JavaScript"></script>
</head>

<body onLoad="mueveReloj();" onKeyDown = "showDown(window.event)">
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
                          <td width="50"><a href="logout.php"><img src="imagenes/eqsl_exit.png" width="30" height="30" border="0" title="salir" /></a></td>
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
                <td><a href="CrearConceptoReparacion.php"><img src="imagenes/nueva_bodega.png" width="32" height="32" title="Nuevo Concepto de Reparacion" /></a></td>
                <td><a href="BuscarConceptoReparacion.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Concepto de Reparacion"/></a></td>
                <td><a href="MenuConceptoReparacion.php"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center">
			<?php if($ver_conceptos == 0){?>
			<p>&nbsp;</p>
			<table width="350" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="middle"><table width="320" height="190" style="background-image:url(imagenes/fondo_buscar.png)" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="3" align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center" class="BuscarUsuario">BUSCAR CONCEPTO DE REPARACION</td>
                  </tr>
                  <tr>
                    <td colspan="3"><input name="tarea" type="hidden" id="tarea"/>
                      <input name="id" type="hidden" id="id"/></td>
                  </tr>
                  <tr>
                    <td width="47%"><span class="BuscarUsuario" >Criterio de busqueda: </span></td>
                    <td width="2%">&nbsp;</td>
                    <td width="51%"><label>
                      <select name="select" id="select" style="height: 20px; width: 150px;" onchange="valcampobusquedaGrupo(this.value);">
                        <option value="descripcion">Descripcion</option>
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
						    <td colspan="7" align="center"><strong>REGISTROS ENCONTRADOS </strong></td>
				          </tr>
						  <tr>
						    <td width="80" align="center"><input name="tarea" type="hidden" id="tarea"/>						      <input name="id" type="hidden" id="id"/></td>
						    <td width="413">&nbsp;</td>
						    <td width="112" align="center" valign="middle">&nbsp;</td>
                            <td width="85" align="center" valign="middle">&nbsp;</td>
                            <td width="85" align="center" valign="middle">&nbsp;</td>
					      </tr>
						  <tr>
                            <td width="80" align="center" valign="middle" bgcolor="#CCCCCC"><strong>ID</strong></td>
							<td width="413" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Descripcion </strong></td>
                            <td width="100" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Valor </strong></td>
							<td width="112" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Estado</strong></td>
                            <td width="85" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Editar</strong></td>
						  </tr>
						  <?php
							for ($i=0; $i<count($resp); $i++){
								$concepto = $resp[$i];
							?>
							<tr align="left" class="TablaUsuarios">
                            	<td width="80" align="center"><?php echo ($concepto->id); ?></td>
								<td width="413"><?php echo ($concepto->descripcion); ?></td>
                                <td width="100"><?php echo ($concepto->valor); ?></td>
							  	<td width="112" align="left" valign="middle"><?php if($concepto->estado==1){echo "ACTIVO";}else{echo "INACTIVO";} ?></td>
                                <td width="85" align="center" valign="middle"><a href="javascript:enviar_form_clientes('editar','<?php echo $concepto->id; ?>')"><img src="imagenes/editar.png" width="32" height="32" /></a></td>
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
	echo "<script>alert ('No est� autenticado en el sistema');</script>";
	echo "<script>window.location.href='index.php';</script>";
 }
?>
