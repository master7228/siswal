<?php
 session_start();
 if(!empty($_SESSION["autenticado"]) && $_SESSION["autenticado"] == "1"){
	 include_once 'Equipo.php';
	 include_once 'Grupo.php';
	 include_once 'Familia.php';
	 include_once 'Clase.php';
	 include_once 'Usuario.php';
	 $ver_equipos = 0;
	 $cont = 0;
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
		 $equipo = new Equipo("","","","","","","","","","","","","","","","","","","","","","","","","","","");
		 $resp = $equipo->buscarEquipoSel($_POST['select'],$_POST['palabra']);
		 $_SESSION['equipos'] = serialize($resp);
		 $ver_equipos = 1;
	 }
	 
	 if(!empty($_POST['tarea']) && $_POST['tarea']=='seleccionar'){
		if(empty($_SESSION['conta'])){
			$conta=0;
			for($i=0; $i<=$_SESSION['cont']; $i++){
				if (!empty($_POST['seleccionar'.$i.''])){
					$id_equipos[$conta]=$_POST['seleccionar'.$i.''];
					$conta ++;
					$equipo_sel = new Equipo('','','','','','','','','','','','','','','','','','','','','','','','','');
					$resp_equipo_sel = $equipo_sel->cambiarEstadoEquipo('T',$_POST['seleccionar'.$i.''],$_SESSION['id_usuario']);
				}
			}
			$_SESSION['conta']= $conta;
			$_SESSION['id_equipos']=serialize($id_equipos);
			unset($_SESSION['cont']);
			echo "<script>window.opener.location.reload(); window.close();</script>";
		 }else{
			$conta=$_SESSION['conta'];
			$id_equipos=unserialize($_SESSION['id_equipos']);
			for($i=0; $i<=$_SESSION['cont']; $i++){
				if (!empty($_POST['seleccionar'.$i.''])){
					$id_equipos[$conta]=$_POST['seleccionar'.$i.''];
					$conta ++;
					$equipo_sel = new Equipo('','','','','','','','','','','','','','','','','','','','','','','','','');
					$resp_equipo_sel = $equipo_sel->cambiarEstadoEquipo('T',$_POST['seleccionar'.$i.''],$_SESSION['id_usuario']);
				}
			}
			$_SESSION['conta']= $conta;
			$_SESSION['id_equipos']=serialize($id_equipos);
			unset($_SESSION['cont']);
			echo "<script>window.opener.location.reload(); window.close();</script>";
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
			<?php if($ver_equipos == 0){?>
			<p>&nbsp;</p>
			<table width="350" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="middle"><table width="320" height="190" style="background-image:url(imagenes/fondo_buscar.png)" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="3" align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center" class="BuscarUsuario">BUSCAR EQUIPO A SELECCIONAR</td>
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
			<p>
			  <?php }else{
						if(sizeof($resp)!=0){
			?>
			  </p>
			<table width="700">
			  <tr>
			    <td width="700" align="right"><a href="javascript:valequiposel('seleccionar');"><img src="imagenes/seleccionar.png" width="35" height="35" title="Aplicar Selección" /></a></td>
			    </tr>
			  </table>
			<table width="700" height="189" border="1" cellpadding="0" cellspacing="0">
			    <tr>
						    <td colspan="7" align="center"><strong>
						      <input name="tarea" type="hidden" id="tarea"/>
                              <input name="id" type="hidden" id="id"/>
                            REGISTROS ENCONTRADOS </strong></td>
		        </tr>
                           <tr bgcolor="" style="font-size:15px">
							<td width="121" align="center"><strong>Referencia Equipo</strong></td>
							<td width="277" align="center"><strong>Nombre del Equipo</strong></td>
							<td width="64" align="center" valign="middle"><strong>Cantidad</strong></td>
                            <td width="64" align="center" valign="middle"><strong>Seleccionar</strong></td>
						  </tr>
						  <?php
							for ($i=0; $i<count($resp); $i++){
								$cont ++;
								$equipo = $resp[$i];
								$grupo= new Grupo($equipo->id_grupo,'','');
								$cons_grupo=$grupo->getGrupos();
								$familia= new Familia($equipo->id_familia,'','');
								$cons_familia=$familia->getFamilias();
								$clase= new Clase($equipo->id_clase,'','');
								$cons_clase=$clase->getDatosClase();
								$equipo2 = new Equipo("","","","","","","","","","","","","","","","","","","","","","","","");
		 						$resp2 = $equipo2->buscarEquipo('id_equipo_rel',$equipo->id);
								$_SESSION['equipos2'] = serialize($resp2);	 
							?>
						 
						  
							<tr align="left" class="TablaUsuarios" style="background-color: #666; font-size:15px" >
								<td width="121" align="center"><?php echo $equipo->referencia; ?></a></td>
								<td width="277"><?php echo $equipo->nombre; ?></td>
							  <td width="64" align="center" valign="middle"><?php echo $equipo->cantidad; ?></td>
                              <?php if(($equipo->cantidad==0 && $equipo->electromecanico==0)||($equipo->electromecanico==0 && $equipo->transaccion=='T' && $equipo->id_usuario!='0')){ ?>
                               <td width="64" align="center" valign="middle"><input type="checkbox" name="seleccionar<?php echo $cont; ?>" disabled="disabled" id="seleccionar<?php echo $cont; ?>" value="<?php echo $equipo->id;?>"/></td>
							<?php }else{ ?>
                            <td width="64" align="center" valign="middle"><input type="checkbox" name="seleccionar<?php echo $cont; ?>" id="seleccionar<?php echo $cont; ?>" value="<?php echo $equipo->id;?>"/></td>
                            <?php } ?>
                            </tr>
							<?php
							for ($j=0; $j<count($resp2); $j++){
								$cont ++;
								$equipo2 = $resp2[$j];
								$grupo= new Grupo($equipo2->id_grupo,'','');
								$cons_grupo=$grupo->getGrupos();
								$familia= new Familia($equipo2->id_familia,'','');
								$cons_familia=$familia->getFamilias();
								$clase= new Clase($equipo2->id_clase,'','');
								$cons_clase=$clase->getDatosClase();
									 
							?>
                            <tr align="left" class="TablaUsuarios" style="background-color: #999; font-size:15px">
								<td width="121" align="center"><?php echo $equipo2->referencia; ?></a></td>
								<td width="277"><?php echo $equipo2->nombre; ?></td>
							  <td width="64" align="center" valign="middle"><?php echo $equipo2->cantidad; ?></td>
                               <?php if(($equipo->cantidad==0 && $equipo->electromecanico==0)||($equipo->electromecanico==0 && $equipo->transaccion=='T' && $equipo->id_usuario!='0')){ ?>
                               <td width="64" align="center" valign="middle"><input type="checkbox" name="seleccionar<?php echo $cont; ?>" disabled="disabled" id="seleccionar<?php echo $cont; ?>" value="<?php echo $equipo2->id;?>" /></td>
							<?php }else{ ?>
                            <td width="64" align="center" valign="middle"><input type="checkbox" name="seleccionar<?php echo $cont; ?>" id="seleccionar<?php echo $cont; ?>" value="<?php echo $equipo2->id;?>" /></td>
							<?php } ?>
                            </tr>
                            
                            <?php
						}
						?>
						<!--<tr style="background-color:#FFF" height="10px"><td height="32" colspan="4">&nbsp;</td></tr>-->
				<?php
						}
						$_SESSION['cont']=$cont;
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
