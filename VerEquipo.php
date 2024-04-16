<?php
 session_start();
	include_once 'Equipo.php';
	include_once 'Proveedor.php';
	include_once 'Usuario.php';
	include_once 'Bodega.php';
	include_once 'Grupo.php';
	include_once 'Clase.php';
	include_once 'Familia.php';
	include_once 'Usuario.php';
	include_once 'Bodega.php';


if ($_SESSION["autenticado"] == "1") {
    $fecha = date('Y-m-d H:i');
	$equipo= unserialize($_SESSION['equipo']);
	$grupo = new Grupo('','','');
	$grupos = $grupo->getGrupos();
	$clase = new Clase('','','');
	$clases = $clase->getClases();
	$familia = new Familia('','','');
	$familias = $familia->getFamilias();
	$bodega = new Bodega('','','','','','','','','','','');
	$bodegas=$bodega->getBodega();
	$prov = new Proveedor('','','','','','','','','','','','','','','','','','','','','','');
	$proveedor = $prov->buscarProveedor('id',$equipo->id_proveedor);
	$prove=$proveedor[0];
		
    if(!empty($_POST['tarea'])){
		if($_POST['tarea'] != 'activar'){
			$str = $_POST['nombre'];
			$str = strtoupper($str);
			$_POST['nombre']=$str;
			$str = $_POST['descripcion'];
			$str = strtoupper($str);
			$_POST['descripcion']=$str;
			$str = $_POST['observaciones'];
			$str = strtoupper($str);
			$_POST['observaciones']=$str;
			$str = $_POST['nom_proveedor'];
			$str = strtoupper($str);
			$_POST['nom_proveedor']=$str;
		}
		
		if ($_POST['tarea'] == 'guardar') {
			$equipo = new Equipo('',$_POST['equipo'],$_POST['electromecanico'],$_POST['referencia'],$_POST['nombre'],$_POST['cantidad'],$_POST['descripcion'],$_POST['min_dias'],$_POST['valor_dia'],$_POST['min_horas'],$_POST['valor_hora'],$_POST['min_metros'],$_POST['valor_metro'],$_POST['fec_compra'],$_POST['nom_proveedor'],$_POST['doc_proveedor'],$_POST['id_grupo'],$_POST['id_familia'],$_POST['id_clase'],$_POST['si_op'],$_POST['si_op'],$_POST['observaciones'],$fecha,'1','BODEGA');
			$guardar = $equipo->editarEquipo();
			if ($guardar) {
				$_SESSION['equipo']=serialize($equipo);
				if(is_dir("Archivos/".$_POST['referencia']."")){ 
					if (!empty($_FILES["archivos"])){	
						$tot = count($_FILES["archivos"]["name"]);
						for ($i = 0; $i < $tot; $i++){
							$tmp_name = $_FILES["archivos"]["tmp_name"][$i];
							$name = $_FILES["archivos"]["name"][$i];
							$destino =  "Archivos/".$_POST['referencia']."/".$name;
							copy($_FILES['archivos']['tmp_name'][$i],$destino);            
						}
					}
					
				}else{
					$carpeta = mkdir("Archivos/".$_POST['referencia']."", 0777);
					if (!empty($_FILES["archivos"])){	
						$tot = count($_FILES["archivos"]["name"]);
						for ($i = 0; $i < $tot; $i++){
							$tmp_name = $_FILES["archivos"]["tmp_name"][$i];
							$name = $_FILES["archivos"]["name"][$i];
							$destino =  "Archivos/".$_POST['referencia']."/".$name;
							copy($_FILES['archivos']['tmp_name'][$i],$destino);            
						}
					}
				}
				echo "<script>alert ('El Equipo fue editado con exito');</script>";
				echo "<script>window.location.href='EditarEquipo.php';</script>";
			} else {
				echo "<script>alert ('No se pudo crear el equipo, por favor intenta de nuevo');</script>";
				/*echo "<script>window.location.href='CrearUsuario.php';</script>";*/
			}
			
		}
		
		if(!empty($_POST['tarea']) and $_POST['tarea']=='activar'){
				$estado = $equipo->activarDesactivarEquipo('1', $equipo->id);
				$equipo->estado="1";
				if($estado){
					$_SESSION['equipo']=serialize($equipo);
					echo "<script>alert('El Equipo ha sido activado correctamente');</script> ";
					echo '<script>window.location="EditarEquipo.php";</script>';
				}else{
					echo "<script>alert('El Equipo no pudo ser activado, intentelo nuevamente');</script> ";
					echo '<script>window.location="EditarEquipo.php";</script>';
				}
			}
			
			if(!empty($_POST['tarea']) and $_POST['tarea']=='desactivar'){
				$estado = $equipo->activarDesactivarEquipo('2', $equipo->id);
				$equipo->estado="2";
				if($estado){
					$_SESSION['equipo']=serialize($equipo);
					echo "<script>alert('El equipo ha sido desactivado correctamente');</script> ";
					echo '<script>window.location="EditarEquipo.php";</script>';
				}else{
					echo "<script>alert('El equipo no pudo ser desactivado, intentelo nuevamente');</script> ";
					echo '<script>window.location="EditarEquipo.php";</script>';
				}
			}
		
		if ($_POST['tarea'] == 'salir') {
			unset ($_SESSION['equipo']);
			echo "<script>window.location.href='MenuEquipos.php';</script>";
		}
    }
 	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ver Equipo</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/jscal2.css" />
<script src="js/validaciones.js" language="JavaScript"></script>
<script src="js/reloj.js" language="JavaScript"></script>
<script src="js/jscal2.js"></script>
<script src="js/lang/es.js"></script>
<script type="text/javascript">
function ver_equipo(url) {
	popupWindow = window.open(
		url,'popUpWindow','height=350,width=500,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
}
</script>
<style type="text/css">
<!--
.style1 {font-size: 14px}

-->
</style>



</head>

<body topmargin="0" onLoad="mueveReloj();" onKeyDown = "showDown(window.event)">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><form action="" method="post" name="form1" class="FormGeneral" id="form1" enctype="multipart/form-data">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="middle"><table width="100%" height="35" border="0">
            <tr>
              <td width="196"><img src="imagenes/logoge.png" alt="Himed" width="200" height="40" /></td>
              <td align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
              <td colspan="2">
					<table width="128" border="0" align="right" cellpadding="2" cellspacing="2" > 
                    <tr> 
                    	<th width="114" scope="col"><font id="cl"><strong>0</strong></font></th> 
                    </tr> 
                    </table> 
              </td>
              </tr>
                  <tr valign="middle">
                    <td width="97%" align="right"><span class="Estilo6">Usuario: <?php echo "".$_SESSION["nombre"].' '.$_SESSION['apellido']; ?> - <a href="logout.php"></a></span></td>
                    <td width="3%" align="right"><a href="logout.php"><img src="imagenes/eqsl_exit.png" alt="Salir de la aplicaci&oacute;n" width="30" height="30" title="Salir" border="0" /></a></td>
                  </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="middle"><table width="100" border="0" cellspacing="0" cellpadding="0">
            <tr align="center" valign="middle">
              <td><a href="CrearEquipo.php" target="_parent"><img src="imagenes/nueva_obra.png" alt="nuevo" width="32" height="32" border="0" title="Crear Nuevo Equipo"/></a></td>
              <td><img src="imagenes/guardar_opaco.png" alt="activar" width="32" height="32" border="0" title="Guardar Equipo"/>
                  </td>
              <td><a href="BuscarEquipo.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Equipo"/></a></td>
              <td><img src="imagenes/activar_obra_opaco.png" alt="activar" width="32" height="35" border="0" title="Activar Equipo"/>
                  </td>
              <td><img src="imagenes/desactivar_obra_opaco.png" alt="desactivar" width="32" height="35" border="0" title="Desactivar Equipo"/>
                  </td>
              <td><a href="javascript:valequipo('salir')"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center" valign="middle"><span class="style1">INFORMACIÓN DEL EQUIPO </span></td>
        </tr>
      </table>
      
      <table width="800" height="auto" border="0" cellspacing="0" cellpadding="8" style="background:url(imagenes/fondo_form.png) no-repeat;">
        <tr>
          <td align="center" ><table width="783" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="819" align="center">&nbsp;</td>
              </tr>
            <tr>
              <td align="center"><table width="744" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr align="center">
                    <td width="718" height="524" valign="top"> <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td colspan="9" align="left" valign="middle">&nbsp;</td>
                        </tr>
                      <tr>
                        <td width="7" align="left" valign="middle">&nbsp;</td>
                        <td colspan="2" align="left">Referencia del equipo </td>
                        <td width="7" align="left" valign="middle">&nbsp;</td>
                        <td colspan="2" align="left">Nombre del equipo </td>
                        <td width="20" align="center">Electromecanico</td>
                        <td align="center">Cantidad</td>
                        <td align="left">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="7" align="center" valign="middle">&nbsp;</td>
                        <td colspan="2" align="left"><input name="referencia" type="text" id="referencia" maxlength="20" readonly="true" value="<?php echo $equipo->referencia; ?>" disabled />
						</td>
                        <td width="7" align="center" valign="middle">*</td>
                        <td colspan="2" align="left"><input name="nombre" type="text" id="nombre" size="35" maxlength="30" class="campos_mayus" value="<?php echo $equipo->nombre; ?>" disabled  />                          <div align="center"></div></td>
                        <td align="left">                          <div align="center">
                          <input type="checkbox" name="electromecanico" id="electromecanico" value="1" onclick="valcheckequipo();" <?php if($equipo->electromecanico=='1'){ echo 'checked'; } ?> disabled />
                        </div></td>
                        <td width="60" align="left"><input name="cantidad" id="cantidad" type="text" size="10" value="<?php echo $equipo->cantidad; ?>" disabled  /></td>
                        <td width="1" align="left">&nbsp;</td>
                        </tr>
                      <tr>
                        <td colspan="9" align="left" valign="middle">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="7" align="left" valign="middle">&nbsp;</td>
                        <td colspan="2" align="left">Descripcion</td>
                        <td align="left">&nbsp;</td>
                        <td colspan="2" align="left">&nbsp;</td>
                        <td colspan="3" align="left">Valor Comercial Equipo
                          <input name="tarea" type="hidden" id="tarea" class="campos_mayus" />
                          <input name="id_equipo" type="hidden" id="id_equipo" value="<?php if($id_equipo<10){echo '00'.$id_equipo; }else if($id_equipo<100){echo '0'.$id_equipo; }else{ echo $id_equipo; } ?>" /></td>
                        </tr>
                      <tr>
                        <td align="center" valign="middle">&nbsp;</td>
                        <td colspan="5" align="left"><input name="descripcion" type="text" id="descripcion" size="69" class="campos_mayus" value="<?php echo $equipo->descripcion; ?>" disabled /></td>
                        <td colspan="3" align="left"><input type="text" name="valor_equipo_compra" id="valor_equipo_compra" value="<?php echo $equipo->valor_equipo_compra; ?>" disabled onkeypress="javascript:return Numeros(event)"/></td>
                        </tr>
                      <tr>
                        <td align="center" valign="middle">&nbsp;</td>
                        <td colspan="2" align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        <td colspan="2" align="left">&nbsp;</td>
                        <td colspan="3" align="left">&nbsp;</td>
                        </tr>
                      <tr>
                        <td align="center" valign="middle">&nbsp;</td>
                        <th align="right">Dias</th>
                        <th align="center">&nbsp;</th>
                        <td align="left">&nbsp;</td>
                        <th align="right">Horas</th>
                        <th align="center">&nbsp;</th>
                        <th colspan="2" align="center">Metros</th>
                        <th align="center">&nbsp;</th>
                      </tr>
                      <tr>
                        <td align="center" valign="middle">&nbsp;</td>
                        <td width="56" align="left">M&iacute;nimo </td>
                        <td width="75" align="left"><input name="min_dias" type="text"  class="campos_mayus" id="min_dias" size="3" value="<?php echo $equipo->minimo_dias; ?>" disabled /></td>
                        <td align="left">&nbsp;</td>
                        <td width="103" align="center">M&iacute;nimo</td>
                        <td width="93" align="left"> <input name="min_horas" type="text"  class="campos_mayus" id="min_horas" size="3" value="<?php echo $equipo->minimo_horas; ?>" disabled/></td>
                        <td align="left">M&iacute;nimo</td>
                        <td align="left"><input name="min_metros" type="text"  class="campos_mayus" id="min_metros" size="3" value="<?php echo $equipo->minimo_metros; ?>" disabled/></td>
                        <td align="left">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center" valign="middle">&nbsp;</td>
                        <td align="left">Valor                          </td>
                        <td align="left"><input name="valor_dia" type="text" size="10" id="valor_dia" value="<?php echo $equipo->valor_dia;  ?>" disabled /></td>
                        <td align="left">&nbsp;</td>
                        <td width="103" align="center">Valor</td>
                        <td width="93" align="left"><input name="valor_hora" id="valor_hora" type="text" size="10" value="<?php echo $equipo->valor_hora; ?>" disabled /></td>
                        <td align="left">Valor</td>
                        <td align="left"><input name="valor_metro" id="valor_metro" type="text" size="10" value="<?php echo $equipo->valor_metro; ?>" disabled /></td>
                        <td align="left">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center" valign="middle">&nbsp;</td>
                        <td colspan="2" align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        <td colspan="2" align="left">&nbsp;</td>
                        <td colspan="3" align="left">&nbsp;</td>
                        </tr>
                    </table>
                      <table width="700" border="0">
                        <tr>
                          <th scope="col">&nbsp;</th>
                          <td colspan="2" align="left" scope="col">Grupo</td>
                          <th scope="col">&nbsp;</th>
                          <td align="left" scope="col">Familia</td>
                          <th scope="col">&nbsp;</th>
                          <td colspan="4" align="left" scope="col">Clase</td>
                        </tr>
                        <tr>
                          <th scope="col">*</th>
                          <td colspan="2" align="left" scope="col"><select name="id_grupo" id="id_grupo" style="height: 25px; width: 150px;" class="campos_mayus" onchange="valselectequipo(this.value,'1');" disabled >
                            <?php 
								echo "<option value=''></option>\n";
										for($i=0;$i<sizeof($grupos);$i+=2) {										
										if($equipo->id_grupo == $grupos[$i]){
											echo "<option selected=\"selected\" value=\"".$grupos[$i]."\">".$grupos[$i+1]."</option>\n";
										}else{
											echo "<option value=\"".$grupos[$i]."\">".$grupos[$i+1]."</option>\n";
										}
									}
									$grupo = $equipo->id_grupo;
									
								
								?>
                          </select></td>
                          <th scope="col">*</th>
                          <td align="left" scope="col"><select name="id_familia" id="id_familia" style="height: 25px; width: 150px;" class="campos_mayus" onchange="valselectequipo(this.value,'2');" disabled >
                            <?php 
								echo "<option value=''></option>\n";
										for($i=0;$i<sizeof($familias);$i+=2) {										
										if($equipo->id_familia == $familias[$i]){
											echo "<option selected=\"selected\" value=\"".$familias[$i]."\">".$familias[$i+1]."</option>\n";
										}else{
											echo "<option value=\"".$familias[$i]."\">".$familias[$i+1]."</option>\n";
										}
									}
									$familia = $equipo->id_familia;
									
								
								?>
                          </select></td>
                          <th scope="col">*</th>
                          <td colspan="4" align="left" scope="col"><select name="id_clase" id="id_clase" style="height: 25px; width: 150px;" class="campos_mayus" onchange="valselectequipo(this.value,'3');" disabled >
                            <?php 
								echo "<option value=''></option>\n";
										for($i=0;$i<sizeof($clases);$i+=2) {										
										if($equipo->id_clase == $clases[$i]){
											echo "<option selected=\"selected\" value=\"".$clases[$i]."\">".$clases[$i+1]."</option>\n";
										}else{
											echo "<option value=\"".$clases[$i]."\">".$clases[$i+1]."</option>\n";
										}
									}
									$clase = $equipo->id_clase;
									
								
								?>
                          </select></td>
                        </tr>
                        <tr>
                          <th scope="col">&nbsp;</th>
                          <td colspan="2" align="left" scope="col">&nbsp;</td>
                          <th scope="col">&nbsp;</th>
                          <td align="left" scope="col">&nbsp;</td>
                          <th scope="col">&nbsp;</th>
                          <td colspan="4" align="left" scope="col">&nbsp;</td>
                        </tr>
                        <tr>
                          <th width="8" scope="col">&nbsp;</th>
                          <td colspan="2" align="left" scope="col">Fecha de compra </td>
                          <th width="8" scope="col">&nbsp;</th>
                          <td width="229" align="left" scope="col">Nombre Proveedor </td>
                          <th width="9" scope="col">&nbsp;</th>
                          <td colspan="4" align="left" scope="col">Documento Proveedor </td>
                        </tr>
                        <tr>
                       
                        
                        
                        
                          <td align="center">*</td>
                          <td width="144" align="left"><input type="text" id="fec_compra" name="fec_compra" readonly="readonly" value="<?php echo $equipo->fecha_compra; ?>" disabled ></td>
                          <td width="67" align="left"><img align="left" src="imagenes/calendario.jpg" alt="Cal" id="cal_1" name="cal_1" /></td>
                          <td align="center">*</td>
                           
                		<?php if($equipo->estado=='1'){ ?>
						<script type="text/javascript">//<![CDATA[

					  var cal = Calendar.setup({
						  onSelect: function(cal) { cal.hide() },
						  showTime: true
					  });
					  cal.manageFields("cal_1", "fec_compra", "%Y-%m-%d");

					//]]></script>
                         
                        <?php } ?>  
                          
                          <td align="left"><input name="nom_proveedor" type="text" disabled class="campos_mayus" id="nom_proveedor" value="<?php echo $prove->nombre1.' '.$prove->nombre2.' '.$prove->apellido1.' '.$prove->apellido2; ?>" size="35" maxlength="20" /></td>
                          <td align="center">*</td>
                          <td colspan="4" align="left"><input name="doc_proveedor" type="text" id="doc_proveedor" maxlength="20" value="<?php echo $prove->documento; ?>" disabled /></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td colspan="2">&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td colspan="4" align="left">Observaciones</td>
                          <td align="left">&nbsp;</td>
                          <td colspan="4" align="center">Operador</td>
                        </tr>
                        <tr>
                          <td rowspan="5">&nbsp;</td>
                          <td colspan="4" rowspan="5" align="left"><textarea name="observaciones" id="observaciones" cols="60" rows="4" class="campos_mayus" disabled><?php echo $equipo->observaciones; ?></textarea></td>
                          <td rowspan="3">&nbsp;</td>
                          <td width="20" align="right"><input type="checkbox" name="si_op" id="si_op" value="1" <?php if($equipo->si_operador=='1'){ echo 'checked'; } ?> disabled/></td>
                          <td width="13" align="left">SI</td>
                          <td width="98" align="right"><input type="checkbox" name="no_op" id="no_op" value="1" <?php if($equipo->no_operador=='1'){ echo 'checked'; } ?> disabled/></td>
                          <td width="62" align="left">NO</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td colspan="3" align="left">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="4">Bodega</td>
                          </tr>
                        <tr>
                          <td>*&nbsp;</td>
                          <td colspan="4"><select name="id_bodega" id="id_bodega" style="height: 25px; width: 150px;" class="campos_mayus" disabled>
                            <?php 
								echo "<option value=''></option>\n";
										for($z=0;$z<sizeof($bodegas);$z+=2) {										
										if($equipo->bodega == $bodegas[$z]){
											echo "<option selected=\"selected\" value=\"".$bodegas[$z]."\">".$bodegas[$z+1]."</option>\n";
										}else{
											echo "<option value=\"".$bodegas[$z]."\">".$bodegas[$z+1]."</option>\n";
										}
									}
									$bodega = $equipo->bodega;
								?>
                          </select></td>
                          </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td colspan="4"> &nbsp;&nbsp;                            </td>
                          </tr>
                        </table>                      
                      <p>&nbsp;</p></td>
                    </tr>
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
