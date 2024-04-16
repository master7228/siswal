<?php
session_start();
	include_once 'Equipo.php';
	include_once 'Bodega.php';
	include_once 'Usuario.php';
	include_once 'Grupo.php';
	include_once 'Clase.php';
	include_once 'Familia.php';
	include_once 'Usuario.php';
	include_once 'Registro.php';
	include_once 'Proveedor.php';
	include_once 'EquipoSub.php';


if (!empty($_SESSION["autenticado"]) && $_SESSION["autenticado"] == "1") {
    $fecha = date('Y-m-d H:i');
	$grupo = new Grupo('','','','');
	$grupos = $grupo->getGrupos();
	$clase = new Clase('','','');
	$clases = $clase->getClases();
	$familia = new Familia('','','');
	$familias = $familia->getFamilias();
	$bodega = new Bodega('','','','','','','','','','','');
	$bodegas=$bodega->getBodega();
	if(!empty($_SESSION['proveedor'])){
		$proveedor= unserialize($_SESSION['proveedor']);
	}
	$equipo = new Equipo('','','','','','','','','','','','','','','','','','','','','','','','','');
	$id= $equipo->consultarUltimoId();
	if($id != ''){
		$id_equipo = $id + 1;
	}else{
		$id_equipo = 1;
	}
	
	
    if(!empty($_POST['tarea'])){
		if($_POST['tarea'] != 'salir' && $_POST['tarea'] != 'activar'){
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
		$equipo_sel=unserialize($_SESSION['equiporel']);
		if ($_POST['tarea'] == 'guardar') {
			
			$equipo = new Equipo('',$equipo_sel->id,$_POST['electromecanic'],$_POST['id_bodega'],$_POST['referencia'],$_POST['nombre'],$_POST['cantidad'],$_POST['descripcion'],$_POST['min_dias'],$_POST['valor_dia'],$_POST['min_horas'],$_POST['valor_hora'],$_POST['min_metros'],$_POST['valor_metro'],$_POST['fec_compra'],$proveedor->id,$_POST['id_grupo'],$_POST['id_familia'],$_POST['id_clase'],$_POST['si_operador'],$_POST['no_operador'],$_POST['observaciones'],'1','B',$_POST['valor_equipo_compra'],'0','0');
			$equiposub = new EquipoSub('',$_POST['electromecanic'],$_POST['referencia'],$_POST['nombre'].' SUB',$_POST['cantidad']);
			$ConsultarEquipo=$equipo->existeEquipo();
			if(!$ConsultarEquipo){
				$guardar = $equipo->guardarEquipo();
				$guardar1 = $equiposub->guardarEquipoSub();
				if ($guardar && $guardar1){
					$registro = new Registro('',$_SESSION['id_usuario'],'CREAR EQUIPO',$equipo->nombre,$equipo->referencia,$fecha);
					$guardar_registro=$registro->guardarRegistro();
					echo "<script>alert ('El Equipo fue creado con exito');</script>";
					unset ($_SESSION['carp']);
					unset($_SESSION['proveedor']);
					echo "<script>window.location.href='MenuEquipos.php';</script>";
				} else {
					echo "<script>alert ('No se pudo crear el equipo, por favor intenta de nuevo');</script>";
					echo "<script>window.location.href='MenuEquipos.php';</script>";
				}
			}else{
				echo "<script>alert ('El equipo ya existe, verifica por favor');</script>";
				echo "<script>window.location.href='MenuEquipos.php';</script>";
			}
		}
		
		if ($_POST['tarea'] == 'salir') {
			unset($_SESSION['proveedor']);
			unset($_SESSION['equipo']);
			echo "<script>window.location.href='MenuEquipos.php';</script>";
		}
    }
 	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Crear Equipo</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/jscal2.css" />
<script src="js/validaciones.js" language="JavaScript"></script>
<script src="js/reloj.js" language="JavaScript"></script>
<script src="js/jscal2.js"></script>
<script src="js/lang/es.js"></script>
<style type="text/css">
<!--
.style1 {font-size: 14px}

-->
</style>
<script> 
var miPopup 
function abreVentana(){ 
   	miPopup = window.open("SeleccionarEquipoRel.php","miwin","width=700,height=600,scrollbars=yes") 
   	miPopup.focus() 
} 
</script>
<script>
function VentanaProveedorNuevo(){ 
   	miPopup = window.open("ValidarProveedor.php","miwin","width=900,height=500,scrollbars=yes") 
   	miPopup.focus() 
} 
</script>
<script> 
var miPopup 
function abreVentanaProveedor(){ 
   	miPopup = window.open("SeleccionarProveedor.php","miwin","width=700,height=600,scrollbars=yes") 
   	miPopup.focus() 
} 
</script> 
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
              <td><a onclick="VentanaProveedorNuevo();"><img src="imagenes/nueva_obra.png" width="32" height="32" title="Nuevo proveedor" /></a></td>
              <td><a href="javascript:valequipo('guardar')"><img src="imagenes/guardar.png" alt="guardar" width="32" height="32" border="0" title="Guardar Informaci?n" /></a></td>
              <td><a href="BuscarEquipo.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Equipo"/></a></td>
              <td><img src="imagenes/activar_obra_opaco.png" width="32" height="36"  title="Activar Equipo"/></td>
              <td><img src="imagenes/desactivar_obra_opaco.png" width="32" height="36" title="Desactivar Equipo"/></td>
              <td><a href="MenuEquipos.php" target="_parent"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center" valign="middle"><span class="style1">CREAR EQUIPO </span></td>
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
                        <td width="13" align="left" valign="middle">&nbsp;</td>
                        <td colspan="2" align="left">Referencia del equipo </td>
                        <td width="10" align="left" valign="middle">&nbsp;</td>
                        <td colspan="2" align="left">Nombre del equipo </td>
                        <td width="112" align="center">Electromecanico</td>
                        <td align="center">Cantidad</td>
                        <td align="left">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="13" align="center" valign="middle">&nbsp;</td>
                        <td colspan="2" align="left"><input name="referencia" type="text" id="referencia" maxlength="20" readonly="true" />
						</td>
                        <td width="10" align="center" valign="middle">*</td>
                        <td colspan="2" align="left"><input name="nombre" type="text" id="nombre" size="35" maxlength="30" class="campos_mayus"  />                          <div align="center"></div></td>
                        <td align="left">                          <div align="center">
                          <input type="checkbox" name="electromecanico" id="electromecanico" value="1" onclick="valcheckequipo();" />
                          <input name="electromecanic" type="hidden" id="electromecanic" />
                        </div></td>
                        <td width="72" align="left">*                          <input name="cantidad" id="cantidad" type="text" size="10" onkeypress="javascript:return Numeros(event)"/></td>
                        <td width="9" align="left">&nbsp;</td>
                        </tr>
                      <tr>
                        <td colspan="9" align="left" valign="middle">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="13" align="left" valign="middle">&nbsp;</td>
                        <td colspan="2" align="left">Descripcion</td>
                        <td align="left">&nbsp;</td>
                        <td colspan="2" align="left"><input name="tarea" type="hidden" id="tarea" class="campos_mayus" />
                          <input name="id_equipo" type="hidden" id="id_equipo" value="<?php if($id_equipo<10){echo '00'.$id_equipo; }else if($id_equipo<100){echo '0'.$id_equipo; }else{ echo $id_equipo; } ?>" /></td>
                        <td colspan="3" align="center">Valor Comercial Equipo</td>
                        </tr>
                      <tr>
                        <td align="center" valign="middle">&nbsp;</td>
                        <td colspan="5" align="left"><input name="descripcion" type="text" id="descripcion" size="69" class="campos_mayus" /></td>
                        <td colspan="3" align="center"><input type="text" name="valor_equipo_compra" id="valor_equipo_compra" onkeypress="javascript:return Numeros(event)"/></td>
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
                        <td align="center" valign="middle"></td>
                        <td width="78" align="left">M&iacute;nimo </td>
                        <td width="112" align="left"><input name="min_dias" type="text"  class="campos_mayus" id="min_dias" size="3" onkeypress="javascript:return Numeros(event);" onChange="limpiar()" onFocus="limpiar()" /></td>
                        <td align="left"></td>
                        <td width="155" align="center">M&iacute;nimo</td>
                        <td width="139" align="left"> <input name="min_horas" type="text"  class="campos_mayus" id="min_horas" size="3" onkeypress="javascript:return Numeros(event)" onFocus="limpiar1()"/></td>
                        <td align="left">M&iacute;nimo</td>
                        <td align="left"><input name="min_metros" type="text"  class="campos_mayus" id="min_metros" size="3" onkeypress="javascript:return Numeros(event)" onFocus="limpiar2()"/></td>
                        <td align="left">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center" valign="middle">&nbsp;</td>
                        <td align="left">Valor                          </td>
                        <td align="left"><input name="valor_dia" type="text" size="10" id="valor_dia" onkeypress="javascript:return Numeros(event)" onFocus="limpiar()"/></td>
                        <td align="left">&nbsp;</td>
                        <td width="155" align="center">Valor</td>
                        <td width="139" align="left"><input name="valor_hora" id="valor_hora" type="text" size="10" onkeypress="javascript:return Numeros(event)" onFocus="limpiar1()"/></td>
                        <td align="left">Valor</td>
                        <td align="left"><input name="valor_metro" id="valor_metro" type="text" size="10" onkeypress="javascript:return Numeros(event)" onFocus="limpiar2()"/></td>
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
                          <td colspan="2" align="left" scope="col"><select name="id_grupo" id="id_grupo" style="height: 25px; width: 150px;" class="campos_mayus" onchange="valselectequipo(this.value,'1');">
                            <?php 
								echo "<option value=''></option>\n";
										for($i=0;$i<sizeof($grupos);$i+=2) {										
										if($equipo->id_grupo == $grupos[$i]){
											echo "<option selected=\"selected\" value=\"".$grupos[$i]."\">".$grupos[$i+2]."</option>\n";
										}else{
											echo "<option value=\"".$grupos[$i]."\">".$grupos[$i+1]."</option>\n";
										}
									}
									$grupo = $equipo->id_grupo;
									
								
								?>
                          </select></td>
                          <th scope="col">*</th>
                          <td align="left" scope="col"><select name="id_familia" id="id_familia" style="height: 25px; width: 150px;" class="campos_mayus" onchange="valselectequipo(this.value,'2');" >
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
                          <td colspan="4" align="left" scope="col"><select name="id_clase" id="id_clase" style="height: 25px; width: 150px;" class="campos_mayus" onchange="valselectequipo(this.value,'3');" >
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
                          <td width="261" align="left" scope="col">Nombre Proveedor </td>
                          <th width="9" scope="col">&nbsp;</th>
                          <td colspan="4" align="left" scope="col">Documento Proveedor </td>
                        </tr>
                        <tr>
                       
                        
                        
                        
                          <td align="center">*</td>
                          <td width="144" align="left"><input type="text" id="fec_compra" name="fec_compra" readonly="readonly" ></td>
                          <td width="35" align="left"><img align="left" src="imagenes/calendario.jpg" alt="Cal" id="cal_1" name="cal_1" /></td>
                          <td align="center">*</td>
                           
                <script type="text/javascript">//<![CDATA[

					  var cal = Calendar.setup({
						  onSelect: function(cal) { cal.hide() },
						  showTime: true
					  });
					  cal.manageFields("cal_1", "fec_compra", "%Y-%m-%d");

					//]]></script>
                          
                          
                          <td align="left"><input name="nom_proveedor" type="text" readonly="readonly" class="campos_mayus" id="nom_proveedor" size="35" maxlength="20" />
                            <a onclick="abreVentanaProveedor();"><img src="imagenes/buscar.png" width="23" height="23" title="Seleccionar Proveedor" /></a></td>
                          <td align="center">*</td>
                          <td colspan="4" align="left"><input name="doc_proveedor" readonly="readonly" type="text" id="doc_proveedor" maxlength="20" /></td>
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
                          <td colspan="4" align="center"><div align="center">Operador</div></td>
                        </tr>
                        <tr>
                          <td rowspan="4">&nbsp;</td>
                          <td colspan="4" rowspan="4" align="left"><textarea name="observaciones" id="observaciones" cols="60" rows="5" class="campos_mayus"></textarea></td>
                          <td rowspan="3">&nbsp;</td>
                          <td width="20" align="right"><input type="checkbox" name="si_op" id="si_op" value="1" onclick="valcheckoperador();"/></td>
                          <td width="13" align="left">SI</td>
                          <td width="98" align="right"><input type="checkbox" name="no_op" id="no_op" value="1" onclick="valcheckoperador();"/></td>
                          <td width="62" align="left">NO
                            <input name="si_operador" type="hidden" id="si_operador" />                            <input name="no_operador" type="hidden" id="no_operador"/></td>
                        </tr>
                        <tr>
                          <td colspan="4" align="center">&nbsp;</td>
                          </tr>
                        <tr>
                          <td colspan="4" align="left">Bodega</td>
                        </tr>
                        <tr>
                          <td>*</td>
                          <td colspan="4" align="left"><label for="valor_equipo_compra"></label>
                            <select name="id_bodega" id="id_bodega" style="height: 25px; width: 150px;" class="campos_mayus">
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
                      </table> 
                      <fieldset><legend><strong>Seleccionar el Equipo al que Pertenece</strong></legend>                     
                      <table width="700" border="0">
                        <tr>
                          <td>Referencia del Equipo</td>
                          <td>Nombre del Equipo</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td width="170"><input name="ref_equipo_sel" type="text" id="ref_equipo_sel" size="25" readonly="readonly" nombre="ref_equipo_sel" /></td>
                          <td width="247"><input type="text" id="nom_equipo_sel" size="40" readonly="readonly" nombre="nom_equipo_sel" /> </td>
                          <td width="203"><a onclick="abreVentana();"><img src="imagenes/buscar.png" width="23" height="23" title="Seleccionar Equipo" /></a></td>
                        </tr>
                      </table>
                      </fieldset>
                      <p>&nbsp;</p>
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
