<?php
session_start();
include_once 'EquipoRemision.php';
include_once 'EquipoRemisionSub.php';
include_once 'Registro.php';
include_once 'Obra.php';
include_once 'Remision.php';
include_once 'Cliente.php';
include_once 'Equipo.php';
include_once 'ContactoObra.php';
include_once 'Municipio.php';
include_once 'Remision.php';
include_once 'Transporte.php';
include_once 'EquipoSub.php';
include_once 'EntradaSub.php';
include_once 'ValorTransporte.php';
include_once 'Remision.php';
include_once 'EquipoDevolucion.php';
include_once 'EquipoDevolucionSub.php';

if (!empty($_SESSION["autenticado"]) && $_SESSION["autenticado"] == "1"){
	$fecha = date('Y-m-d H:i');
	$ver_equipos=0;
	$trasporte = new Transporte('','','');
	$bustransporte = $trasporte->buscarTransporte('estado','1');

	if(!empty($_POST['tarea']) && $_POST['tarea']=='quitar'){
		$id= $_POST['id'];
		$equipodev = new EquipoDevolucion('','','','');
		$eliminar = $equipodev->eliminar_equipoDev($id);
	}
	if(!empty($_POST['tarea']) && $_POST['tarea']=='quitar1'){
		$id= $_POST['id'];
		$equiposubdev = new EquipoDevolucionSub('','','','');
		$eliminar = $equiposubdev->eliminar_equipo_SubDev($id);
	}
	if(!empty($_SESSION['cliente'])){
		$cliente = unserialize($_SESSION['cliente']);
		$ver_equipos=0;
		$ver_equipos_sub=0;
		$_SESSION['env_cliente']=$cliente->id;
	}
	
	if(!empty($_SESSION['obra'])){
		$obra = unserialize($_SESSION['obra']);
		$contacto = new ContactoObra('','','','','','','','','','');
		$consulta = $contacto->buscarContacto($obra->id);
		$cons=$consulta[0];
		$mun = new Municipio($obra->municipio,'','','');
		$municipio = $mun->buscarMpio('mun','');
		$_SESSION['env_obra']=$obra->id;
		$_SESSION['env_contacto']=$cons->id;
	}
	
	if(!empty($_SESSION['valor'])){
		$valortrans = unserialize($_SESSION['valor']);
	}
	
	if(!empty($_POST['tarea']) and $_POST['tarea']=='enc'){
		unset($_SESSION['dev_manual']);
		$_SESSION['dev_manual']=$_POST['remisionmanual'];
	}
	if(!empty($_SESSION['cliente']) || !empty($_SESSION['id_usuario']) || !empty($_SESSION['obra'])){
		$equipodevolucion = new EquipoDevolucion('','','','');
		$resp1 = $equipodevolucion->buscarEquiposDev($_SESSION['id_usuario']);

	    $equipodevolucionsub = new EquipoDevolucionSub('','','','');
		$respp = $equipodevolucionsub->buscarEquiposSubDev($_SESSION['id_usuario']);
		$ver_equipos=1;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Crear Devoluci&oacute;n</title>
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
function abreVentanaCliente(){ 
	miPopup = window.open("SeleccionarCliente.php","miwin","width=700,height=600,scrollbars=yes")
	miPopup.focus()
	
} 
</script> 
<script> 
var miPopup 
function abreVentanaValorTransporte(){
	miPopup = window.open("SeleccionarValorTransporte.php","miwin","width=700,height=600,scrollbars=yes") 
	miPopup.focus() 
} 
</script>
<script> 
var miPopup 
function abreVentanaObra(){ 
	miPopup = window.open("SeleccionarObra.php","miwin","width=800,height=600,scrollbars=yes") 
	miPopup.focus() 
} 
</script>
<script> 
var miPopup 
function abreVentanaEquipo(){ 
	miPopup = window.open("SeleccionarEquipoRemision.php","miwin","width=800,height=600,scrollbars=yes") 
	miPopup.focus() 
} 
</script>
<script> 
var miPopup 
function abreVentanaReparacion(val2,val3){
	//alert(val1+' '+val2);
	miPopup = window.open("CrearReparacion.php? usu1="+val2+"&var="+val3+"","miwin","width=600,height=510,scrollbars=yes") 
	miPopup.focus() 
} 
</script>
</head>
<body topmargin="0" onLoad="mueveReloj();" onKeyDown = "showDown(window.event)">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
	<td align="center" valign="top"><form action="" method="post" name="form1" class="FormGeneral" id="form1" enctype="multipart/form-data">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		  <td align="left" valign="middle"><table width="100%" height="35" border="0">
			<tr>
			  <td width="196"><img src="imagenes/logoge.png" alt="Himed" width="200" height="40" /></td>
			  <td align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td colspan="2" align="right" valign="middle">
						<table width="128" border="0" align="right" cellpadding="2" cellspacing="2" > 
						<tr> 
							<th width="114" scope="col"><font id="cl"><strong>0</strong></font></th> 
						</tr> 
					</table> 
					</td>
					</tr>
				  <tr>
					<td width="93%" align="right" valign="middle"><span class="Estilo6">Usuario: <?php echo "".$_SESSION["nombre"].' '.$_SESSION['apellido']; ?> - <a href="logout.php"></a></span></td>
					<td width="7%" align="center" valign="middle"><a href="logout.php"><img src="imagenes/eqsl_exit.png" width="30" height="30" border="0" title="Salir" /></a></td>
				  </tr>
			  </table></td>
			</tr>
		  </table></td>
		</tr>
		<tr>
		  <td align="left" valign="middle"><table width="100" border="0" cellspacing="0" cellpadding="0">
			<tr align="center" valign="middle">
			  <td><a href="CrearDevolucion.php"><img src="imagenes/nueva_obra.png" width="32" height="34" title="Nueva Remision" /></a></td>
			  <td><a href="javascript:valcreardevolucion('guardar',<?php echo count($resp1); ?>,<?php echo count($respp); ?>)"><img src="imagenes/guardar.png" alt="guardar" width="32" height="32" border="0" title="Guardar Información"/></a></td>
			  <td><a href="BuscarRemision.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Remision"/></a></td>
			  <td><a href="javascript:valcreardevolucion('salir')"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
			</tr>
		  </table></td>
		</tr>
		<tr>
		  <td align="left" valign="middle">&nbsp;</td>
		</tr>
		<tr>
		  <td align="center" valign="middle"><strong>CREAR DEVOLUCI&Oacute;N</strong></td>
		</tr>
	  </table>
	  <table width="800" height="auto" border="0" cellspacing="0" cellpadding="8" style="background:url(imagenes/fondo_form.png) no-repeat;">
		<tr>
		  <td align="center"><table width="783" border="0" cellpadding="0" cellspacing="0">
			<tr>
			  <td width="819" align="center">&nbsp;</td>
			  </tr>
			<tr>
			  <td align="center"><table width="744" border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr align="center">
					<td width="718" height="524" valign="top"> <table width="718" border="0" align="center" cellpadding="0" cellspacing="0">
					  <tr>
						<td colspan="7" align="left" valign="middle">&nbsp;</td>
						</tr>
					  <tr>
						<td width="7" align="left" valign="middle">&nbsp;</td>
						<td width="240" align="left">Remisi&oacute;n</td>
						<td width="7" align="left" valign="middle">&nbsp;</td>
						<td width="180" align="left">&nbsp;</td>
						<td colspan="3" align="left" valign="middle">Fecha</td>
						</tr>
					  <tr>
						<td align="center" valign="middle">*</td>
						<td align="left"><input name="remisionmanual" type="text" id="remisionmanual" value="<?php if(!empty($_SESSION['dev_manual'])){echo $_SESSION['dev_manual'];}?>" onkeypress="javascript:return Numeros(event)" size="40" maxlength="20"/></td>
						<td align="center" valign="middle">&nbsp;</td>
						<td align="left" valign="middle">&nbsp;</td>
						<td width="144" align="left"><input name="fecha_rem" type="text" id="fecha_rem" maxlength="20" readonly="readonly" />
						<td width="126" align="left"><img align="left" src="imagenes/calendario.jpg" alt="Cal" id="cal_1" name="cal_1" />                        
						<td width="10" align="left">&nbsp;</td>
						<script type="text/javascript">//<![CDATA[

					  var cal = Calendar.setup({
						  onSelect: function(cal) { cal.hide() },
						  showTime: true
					  });
					  cal.manageFields("cal_1", "fecha_rem", "%Y-%m-%d");

					//]]></script>
					  </tr>
					  <tr>
						<td width="7" align="center" valign="middle">&nbsp;</td>
						<td width="240" align="left">&nbsp;</td>
						<td width="7" align="center" valign="middle">&nbsp;</td>
						<td width="180" align="left">&nbsp;</td>
						<td width="144" align="left" valign="middle">&nbsp;</td>
						<td colspan="2" align="left">&nbsp;</td>
						</tr>
					</table>
					<fieldset><legend><strong>Seleccionar el Cliente</strong></legend>
					  <table width="718" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
						  <td colspan="7" align="left" valign="middle">&nbsp;</td>
						</tr>
						<tr>
						  <td width="7" align="left" valign="middle">&nbsp;</td>
						  <td width="306" align="left">Nombre Cliente</td>
						  <td width="1" align="left" valign="middle">&nbsp;</td>
						  <td width="153" align="left">Documento</td>
						  <td width="1" align="left" valign="middle">&nbsp;</td>
						  <td width="124" colspan="2" align="left">&nbsp;</td>
						</tr>
						<tr>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left"><input name="nom_cliente" type="text" readonly="readonly" id="nom_cliente" size="40" value="<?php if(!empty($cliente->nombre1)){ echo $cliente->nombre1.' '.$cliente->nombre2.' '.$cliente->apellido1.' '.$cliente->apellido2; } ?>" /></td>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left"><input name="doc_cliente" type="text" readonly="readonly" id="doc_cliente" maxlength="20"  value="<?php if(!empty($cliente->documento)){ echo $cliente->documento; } ?>"/></td>
						  <td align="left" valign="middle">&nbsp;</td>
						  <td colspan="2" align="left"><a onclick="abreVentanaCliente(); javascript:valcreardevolucion('enc');" ><img src="imagenes/buscar.png" width="23" height="23" title="Seleccionar Cliente" /></a></td>
						</tr>
						<tr>
						  <td width="7" align="center" valign="middle">&nbsp;</td>
						  <td width="306" align="left">&nbsp;</td>
						  <td width="1" align="center" valign="middle">&nbsp;</td>
						  <td width="153" align="left">&nbsp;</td>
						  <td width="1" align="left" valign="middle">&nbsp;</td>
						  <td colspan="2" align="left">&nbsp;</td>
						</tr>
					  </table>
					  </fieldset>
					  <p>
						<input name="tarea" type="hidden" id="tarea"/>
						<input name="id" type="hidden" id="id"/>
					    <input type="hidden" name="cupo" id="cupo" value="<?php echo $cliente->cupo; ?>"/>
					  </p>
					  <fieldset ><legend><strong>Seleccionar la Obra</strong></legend>
					  <table width="718" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
						  <td colspan="7" align="left" valign="middle">&nbsp;</td>
						</tr>
						<tr>
						  <td width="7" align="left" valign="middle">&nbsp;</td>
						  <td width="327" align="left">Nombre Obra</td>
						  <td width="1" align="left" valign="middle">&nbsp;</td>
						  <td width="144" align="left">Telefono de la Obra</td>
						  <td width="1" align="left" valign="middle">&nbsp;</td>
						  <td width="112" colspan="2" align="left">&nbsp;</td>
						</tr>
						<tr>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left"><input name="nom_obra" type="text" readonly="readonly" id="nom_obra" size="40" value="<?php if(!empty($obra->nombre)){ echo $obra->nombre; } ?>" /></td>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left"><input name="tel_obra" type="text" id="tel_obra" readonly="readonly" maxlength="20" value="<?php if(!empty($obra->telefono)){ echo $obra->telefono; } ?>" /></td>
						  <td align="left" valign="middle">&nbsp;</td>
						  <td colspan="2" align="left">&nbsp;</td>
						</tr>
						<tr>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left">Direccion de la Obra</td>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left">Municipio de la Obra</td>
						  <td align="left" valign="middle">&nbsp;</td>
                          <?php
						  if(!empty($_SESSION['cliente'])){?>
						  <td colspan="2" align="left"><a onclick="abreVentanaObra(); javascript:valcreardevolucion('enc');"><img src="imagenes/buscar.png" width="23" height="23" title="Seleccionar Obra" /></a></td>
                          <?php }?>
						</tr>
						<tr>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left"><input name="dir_obra" type="text" id="dir_obra" readonly="readonly" size="40" value="<?php if(!empty($obra->direccion)){ echo $obra->direccion; } ?>" /></td>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left"><input name="mun_obra" type="text" id="mun_obra" readonly="readonly" maxlength="20" value="<?php if(!empty($municipio[0]->strdes_mpio)){ echo $municipio[0]->strdes_mpio; } ?>"  /></td>
						  <td align="left" valign="middle">&nbsp;</td>
						  <td colspan="2" align="left">&nbsp;</td>
						</tr>
						<tr>
						  <td width="7" align="center" valign="middle">&nbsp;</td>
						  <td width="327" align="left">&nbsp;</td>
						  <td width="1" align="center" valign="middle">&nbsp;</td>
						  <td width="144" align="left">&nbsp;</td>
						  <td width="1" align="left" valign="middle">&nbsp;</td>
						  <td colspan="2" align="left">&nbsp;</td>
						</tr>
					  </table>
					  </fieldset>
					  <table width="718" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
						  <td colspan="7" align="left" valign="middle">&nbsp;</td>
						</tr>
						<tr>
						  <td width="8" align="left" valign="middle">&nbsp;</td>
						  <td width="307" align="left">Contacto</td>
						  <td width="4" align="left" valign="middle"></td>
						  <td width="196" align="left">Transporte</td>
						  <td width="4" align="left" valign="middle">&nbsp;</td>
						  <td width="199" colspan="2" align="left">Valor Transporte</td>
						</tr>
						<tr>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left"><?php if(!empty($cons->nombre)){echo $cons->nombre;} ?></td>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left"><select name="id_transporte" id="id_transporte"  class="campos_mayus">
								   <?php for($i=0; $i<=sizeof($bustransporte); $i++){
										$resp2=$bustransporte[$i];
										echo "<option value=\"".$resp2->placa."\">".$resp2->placa."</option>\n";
								   
								   } ?>
							  </select></td>
						  <td align="left" valign="middle">&nbsp;</td>
						  <td colspan="2" align="left"><input name="valor_transporte" type="text" id="valor_transporte" maxlength="20" onkeypress="javascript:return Numeros(event)" value="<?php if(!empty($valortrans->valor)){ echo $valortrans->valor; } else if(!empty($obra->nombre)){ echo $obra->tarifa_transporte; }  ?>"/><a onclick="abreVentanaValorTransporte(); javascript:valcrearremision('enc');"><img src="imagenes/buscar.png" width="23" height="23" title="Seleccionar Valor Transporte" /></a></td>
						</tr>
						<tr>
						  
						  <td width="8" align="center" valign="middle">&nbsp;</td>
						  <td width="307" align="left">Observaciones</td>
						  <td width="4" align="center" valign="middle">&nbsp;</td>
						  <td width="196" align="left">&nbsp;</td>
						  <td width="4" align="left" valign="middle">&nbsp;</td>
						  <td colspan="2" align="left">&nbsp;</td>
						</tr>
						</table>
					  <table width="718" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
						  <td>&nbsp;</td>
						</tr>
					  </table>
					  
					  <table width="199" border="0" align="left">
						<tr>
						  <td width="153" align="left">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Seleccionar Equipo</strong></td>
						  <td width="36" align="left"><a onclick="abreVentanaEquipo(); javascript:valcrearremision('enc');"><img src="imagenes/buscar.png" width="23" height="23" title="Seleccionar Equipo Propio" /></a></td>
						</tr>
					</table>
					  <p>&nbsp;</p>
					  <p>&nbsp;</p>
					  <?php if($ver_equipos == 0){ ?>
					  <?php }else{
						if((sizeof($resp1)!=0) || (sizeof($respp)!=0)){ /*echo "<script>alert ('siiiiiiiiiiiii');</script>";*/ ?>
					  <table width="730" border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td colspan="11" align="center"><strong>REGISTROS ENCONTRADOS </strong></td>
						  </tr>
						  <tr>
							<td height="10" colspan="11" align="center">&nbsp;</td>
						  </tr>           
						   <tr bgcolor="#999999">
							<td width="122" align="center"><strong>Referencia Equipo</strong></td>
							<td width="214" align="center"><strong>Nombre del Equipo</strong></td>
							<td width="73" align="center" valign="middle"><strong>Cantidad</strong></td>
							<td width="141" align="center" valign="middle"><strong>N&uacute;mero de Remisi&oacute;n</strong></td>
							<td width="82" align="center" valign="middle"><strong>Reparaci&oacute;n</strong></td>
							<td width="46" align="center" valign="middle"><strong>Quitar</strong></td>
						  </tr>
                       <?php
						if(sizeof($resp1)!=0){ ?>
						  <?php
							for ($i=0; $i<count($resp1); $i++){
									$equi=$resp1[$i];
									$equipo2 = new Equipo("","","","","","","","","","","","","","","","","","","","","","","","");
									$resp2 = $equipo2->buscarEquipo('id',$equi->id_equipo);
									$equipo=$resp2[0];
									
									$remision = new Remision("","","","","","","","","","");
									$remi = $remision->buscarRemisionDev($equi->id_devolucion);
									$bus_rem=$remi[0];
							?>
						  
							<tr align="left" class="TablaUsuarios">
										<td width="122" align="center"><?php echo $equipo->referencia; ?></a></td>
										<td width="214"><?php echo $equipo->nombre;?>
                                        <input type="hidden" name="nomb_post" id="nomb_post<?php echo $i; ?>" value="<?php echo $equipo->nombre; ?>"/></td>
										<?php if($equipo->electromecanico == '1'){ $_POST['valida_campo']='1'; ?>
							  			<td width="73" align="center" valign="middle"><?php echo $equi->cantidad; ?>
                   			  <input type="hidden" name="valcantidad1" id="valcantidad1<?php echo $i; ?>" value="<?php echo $equi->cantidad; ?>" /></td>
										<?php }else{ ?>
							  <td width="141" align="center" valign="middle"><input type="text" id="cantidad<?php echo $i; ?>" name="cantidad<?php echo $i; ?>" size="6px" value="<?php if(!empty($equi->cantidad)){ echo $equi->cantidad;} ?>" onkeypress="javascript:return Numeros(event)" />
							  <input type="hidden" name="valcantidad" id="valcantidad<?php echo $i; ?>" value="<?php echo $equi->cantidad; ?>" /></td>
										<?php } ?>
									  	
							            <td width="82" align="center" valign="middle"><?php echo $bus_rem->id_manual; ?>
	                          <td width="46" align="center" valign="middle"><a onclick="abreVentanaReparacion('<?php $_SESSION["id_eq_dev"]=$equi->id; ?>','<?php echo $equipo->id; ?>','<?php echo $bus_rem->id; ?>');"><img src="imagenes/reparacion.png" width="25" height="25" /></a></td>
										
							  <td width="36" align="center" valign="middle"><a href="javascript:enviar_form_clientes('quitar','<?php echo $equi->id; ?>')"><img src="imagenes/cancelar.png" width="25" height="25" /></a></td>
                            </tr>
							<?php
								
						}
						}
						?>
					    <?php
						if(sizeof($respp)!=0){ ?>
                        						  <?php
							for ($j=0; $j<count($respp); $j++){
									$equipos1=$respp[$j];
									$entradasub = new EntradaSub("","","","","","","");
									$rpta = $entradasub->buscarequipoEntrada('id_nomsub',$equipos1->id_equipo);
									$equipo_entsub=$rpta[0];
									
									$remision = new Remision("","","","","","","","","","");
									$remi = $remision->buscarRemisionDev($equipos1->id_devolucion);
									$bus_rem=$remi[0];
							?>
						  
							<tr align="left" class="TablaUsuarios">
										<td width="98" align="center"><?php echo ' '; ?></a></td>
										<td width="174"><?php echo $equipo_entsub->nombre; ?></td>
                                        <input type="hidden" name="nomb_post_sub" id="nomb_post_sub<?php echo $j; ?>" value="<?php echo $equipos1->nombre; ?>"/>
											<td width="59" align="center" valign="middle"><?php echo $equipo_entsub->cantidad; ?></td>
											<td width="90" align="center" valign="middle"><?php echo $bus_rem->id_manual; ?>
										    <td width="90" align="center" valign="middle">
					          <td width="44" align="center" valign="middle"><a href="javascript:enviar_form_clientes('quitar1','<?php echo $equipos1->id; ?>')"><img src="imagenes/cancelar.png" width="25" height="25" /></a></td>
							</tr>
							<?php
					  }
						}
						?>

			 
			</table>
			<?php }else{
					echo 'NO HA SELECCIONADO EQUIPOS';
				} }?>
			<input name="valor" type="hidden" id="valor" value="<?php echo count($resp1); ?>"/>
            <input name="valor1" type="hidden" id="valor1" value="<?php echo count($respp); ?>"/>
            <input type="hidden" name="valordia" id="valordia" value="<?php echo $total_cupo; ?>" />
            <p>&nbsp;</p>
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