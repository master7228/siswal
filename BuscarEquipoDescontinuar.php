<?php
 session_start();
 if($_SESSION["autenticado"] == "1"){
	 include_once 'Equipo.php';
	 include_once 'Grupo.php';
	 include_once 'Familia.php';
	 include_once 'Clase.php';
	 $ver_equipos = 0;
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
	 if(!empty($_POST['select']) && !empty($_POST['palabra']) ){
		 $equipo = new Equipo("","","","","","","","","","","","","","","","","","","","","","","","");
		 $resp = $equipo->buscarEquipoDescontinuar($_POST['select'],$_POST['palabra']);
		 $_SESSION['equipos'] = serialize($resp);
		 $ver_equipos = 1;
	 }
	 if(!empty($_POST['tarea']) && $_POST['tarea']=='seleccionar'){
	 	$equipos=unserialize($_SESSION['equipos']);
		for($i=0; $i<count($equipos); $i++){
			$equipo = $equipos[$i];
			if($equipo->id==$_POST['id']){
				$_SESSION['equipo']=serialize($equipo);
				unset($_SESSION['equipos']);
				echo "<script> window.location.href='DescontinuarEquipo.php';</script>";
			}
		}
	 }

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Buscar Equipo</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script src="js/validaciones.js" language="JavaScript"></script>
<script src="js/reloj.js" language="JavaScript"></script>
</head>

<body onLoad="mueveReloj();">
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
                <td><a href="BuscarEquipoDescontinuar.php"><img src="imagenes/nueva_obra.png" width="32" height="32" border="0" title="Nuevo Equipo" /></a></td>
                <td><a href="MenuDiscontinuos.php" target="_parent"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center">
			<?php if($ver_equipos == 0){?>
			<p>&nbsp;</p>
			<table width="350" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="middle"><table width="320" height="190" style="background-image:url(imagenes/fondo_buscar.png)" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="3" align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center" class="BuscarUsuario">BUSCAR EQUIPO DESCONTINUAR</td>
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
                        <option value="nombre">Nombre</option>
                        <option value="referencia">Referencia</option>
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
						<table width="1000" border="1" cellspacing="0" cellpadding="0">
						  <tr>
						    <td colspan="10" align="center"><strong>REGISTROS ENCONTRADOS </strong></td>
				          </tr>
						  <tr>
						    <td height="10" colspan="10" align="center">
							<input name="tarea" type="hidden" id="tarea"/>
					        <input name="id" type="hidden" id="id"/></td>
					      </tr>
                           <tr bgcolor="#999999">
							<td width="121" align="center"><strong>Referencia Equipo</strong></td>
							<td width="277" align="center"><strong>Nombre del Equipo</strong></td>
							<td width="163" align="center" valign="middle"><strong>Grupo</strong></td>
							<td width="140" align="center" valign="middle"><strong>Familia</strong></td>
							<td width="107" align="center" valign="middle"><strong>Clase</strong></td>
							<td width="64" align="center" valign="middle"><strong>Cantidad</strong></td>
                            <td width="64" align="center" valign="middle"><strong>Seleccionar</strong></td>
						  </tr>
						  <?php
							for ($i=0; $i<count($resp); $i++){
								$equipo = $resp[$i];
								$grupo= new Grupo('','','','');
								$cons_grupo=$grupo->buscarGrupo('id',$equipo->id_grupo);
								$familia= new Familia('','','','');
								$cons_familia=$familia->buscarFamilia('id',$equipo->id_familia);
								$clase= new Clase('','','','');
								$cons_clase=$clase->buscarClase('id',$equipo->id_clase);
								$grup=$cons_grupo[0];
								$fam=$cons_familia[0];
								$cla=$cons_clase[0];
								
								 
							?>
						 
						  
							<tr align="left" class="TablaUsuarios">
								<td width="121" align="center"><?php echo $equipo->referencia; ?></a></td>
								<td width="277"><?php echo $equipo->nombre; ?></td>
								<td width="163" align="left" valign="middle"><?php echo $grup->descripcion; ?></td>
							    <td width="140" align="left" valign="middle"><?php echo $fam->descripcion; ?></td>
								 <td width="107" align="left" valign="middle"><?php echo $cla->descripcion; ?></td>
						      <td width="64" align="center" valign="middle"><?php echo $equipo->cantidad; ?></td>
                               <td width="64" align="center" valign="middle"><a href="javascript:enviar_form_clientes('seleccionar','<?php echo $equipo->id; ?>')"><img src="imagenes/seleccionar.png" width="30" height="30" /></a></td>
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
