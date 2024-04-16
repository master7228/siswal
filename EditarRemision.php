<?php
session_start();
include_once 'EquipoRemision.php';
include_once 'EquipoRemisionSub.php';
include_once 'Registro.php';
include_once 'Obra.php';
include_once 'Cliente.php';
include_once 'Equipo.php';
include_once 'ContactoObra.php';
include_once 'Municipio.php';
include_once 'Remision.php';
include_once 'Transporte.php';
include_once 'EquipoSub.php';
include_once 'EntradaSub.php';
include_once 'ValorTransporte.php';

if (!empty($_SESSION["autenticado"]) && $_SESSION["autenticado"] == "1"){
	$remision=unserialize($_SESSION['remision']);
	if(!empty($_POST['tarea']) && $_POST['tarea']=='quitar'){
		$id= $_POST['id'];
		$equipo = new Equipo('','','','','','','','','','','','','','','','','','','','','','','','','','','');
		$consultar = $equipo->buscarEquipo('id',$id);
		$cons=$consultar[0];
		if($cons->electromecanico!='1'){
			$equiporem = new EquipoRemision('','','','','','');
			$con_eq = $equiporem->buscarEquiposRemisionados('id_equipo',$id);
			$eqp=$con_eq[0];
			$equipo = new Equipo($id,'','','','','',$eqp->cantidad,'','','','','','','','','','','','','','','','','','','','');
			$editar = $equipo->cambiarCantidad1();
			$cambiar = $equipo->cambiarEstadoEquipo2($id);
			if($editar && $cambiar){
				$eliminar = $equiporem->EliminarEquipoRemision($id);
			}
		}else{
			$equiporem = new EquipoRemision('','','','','','');
			$eliminar = $equiporem->EliminarEquipoRemision($id);
			if($eliminar){
				$equipo = new Equipo($id,'','','','','','','','','','','','','','','','','','','','','','','','','','');
				$cambiar = $equipo->cambiarEstadoEquipo2($id);
			}
		}
	}
	if(!empty($_POST['tarea']) && $_POST['tarea']=='quitar1'){
		$id= $_POST['id'];
		$equiposub = new EquipoSub('','','','','');
		$elimina_equipo_sub = $equiposub->EliminarEquipoSubRem($_POST['id_remision'],$_POST['id']);
		if($elimina_equipo_sub){
			$entradasub = new EntradaSub('','','','','','','');
			$elimina_entrada = $entradasub->EliminarEntradaSub2($remision->id_usuario,$_POST['id']);
		}
	}
	
	$ver_equipos=1;
	$ver_equipos_sub=1;
	
	$Cliente = new Cliente("","","","","","","","","","","","","","","","","","","","","","","","","","","","");
	$cons_cliente=$Cliente->buscarCliente('id',$remision->id_cliente);
	$cliente=$cons_cliente[0];
	$Obra = new Obra("","","","","","","","","","","","","","","","","","","","","");
	$cons_obra=$Obra->buscarObraGeneral('id',$remision->id_obra);
	$obra=$cons_obra[0];
	$mun = new Municipio('','','','');
	$municipio = $mun->buscarMpioObra($obra->pais,$obra->departamento,$obra->municipio);
	$muni=$municipio[0];
	$contacto = new ContactoObra('','','','','','','','','','');
	$consulta1 = $contacto->getContactos($remision->id_obra);
	$consulta = $contacto->buscarContactoRemision($remision->id_obra,$remision->contacto);
	$equiporem = new EquipoRemision('','','','');
	$con_eq = $equiporem->buscarEquiposRemisionados('id_remision',$remision->id);
	$equipo = new Equipo('','','','','','','','','','','','','','','','','','','','','','','','','','','');
	$equiposubrem = new EquipoRemisionSub('','','','');
	$eqsubrem=$equiposubrem->buscarEquipoSub('id_remision',$remision->id);
	$entradasub = new EntradaSub('','','','','','','');
	$equiporemSub = new EquipoRemisionSub('','','','','','');
	
	$trasp = new Transporte('','','');
	$bustransporte = $trasp->getTransporte();
	
	$fecha = date('Y-m-d H:i');
	$fecha_rem = date('Y-m-d');
	
	if(!empty($_SESSION['cliente'])){
		$cliente = unserialize($_SESSION['cliente']);
	}
	if(!empty($_SESSION['obra'])){
		$obra = unserialize($_SESSION['obra']);
		$contacto = new ContactoObra('','','','','','','','','','');
		$consulta = $contacto->buscarContacto($obra->id);
		$mun = new Municipio($obra->municipio,'','','');
		$municipio = $mun->buscarMpio('mun','');
		$muni = $municipio[0];
	}
	if(!empty($_SESSION['valor'])){
		$valortrans = unserialize($_SESSION['valor']);
	}
	if(!empty($_POST['tarea']) && $_POST['tarea']=='quitar_ed'){
		$var_quitar = '1'; 
		$id= $_POST['id'];
		$equipo = new Equipo('','','','','','','','','','','','','','','','','','','','','','','','','','','');
		$cambiar = $equipo->cambiarEstadoEquipo('B',$_POST['id'],'NULL');
	}
	/*if(!empty($_POST['tarea']) && $_POST['tarea']=='quitar_ed1'){
		$var_quitar = '1';
		$id= $_POST['id'];
		$entradasub = new EntradaSub('','','','','','','');
		$elimina_entrada = $entradasub->EliminarEntradaSubedit($_POST['id']);
	}*/

	
	if(!empty($_POST['tarea']) && $_POST['tarea']=='quitar_ed'){
		$var_quitar = '1'; 
		$id= $_POST['id'];
		$equipo = new Equipo('','','','','','','','','','','','','','','','','','','','','','','','','','','');
		$cambiar = $equipo->cambiarEstadoEquipo('B',$_POST['id'],'NULL');
	}
	if(!empty($_POST['tarea']) && $_POST['tarea']=='quitar_ed1'){
		$var_quitar = '1';
		$id= $_POST['id'];
		$entradasub = new EntradaSub('','','','','','','');
		$elimina_entrada = $entradasub->EliminarEntradaSub($_SESSION['id_usuario'],$_POST['id']);
	}
	
	if(!empty($_SESSION['id_equipos']) || !empty($_SESSION['id_usuario'])){
		$equipo = new Equipo('','','','','','','','','','','','','','','','','','','','','','','','','','','');
		$resp1 = $equipo->buscarEquipo1('transaccion','T',$_SESSION['id_usuario']);
		$ver_equipos=1;
	}
	if(!empty($_SESSION['id_usuario'])){
				$equipo1 = new EntradaSub('','','','','','','');
				$respp = $equipo1->buscarEquiposSub($_SESSION['id_usuario']);
				$ver_equipos_sub=1;
	}
	
	if(!empty($_POST['tarea']) and $_POST['tarea']=='guardar'){
		$id_r=$remision->id;
		$remision = new Remision('',$_POST['remisionmanual'],$cliente->id,$obra->id,$_POST['id_contacto'],$_POST['valor_transporte'],$_POST['id_transporte'],$_POST['observaciones'],'','');
		$editar = $remision->editarRemision($id_r);
		if ($editar){
			for($i=0; $i<count($con_eq); $i++){
				$id_equipo=$con_eq[$i];
				$equipo_rem = $equipo->buscarEquipo('id', $id_equipo->id_equipo);
				$eq=$equipo_rem[0];
				if($eq->electromecanico == '1'){
						$equiporem = new EquipoRemision('',$id_r,$id_equipo->id_equipo,$id_equipo->cantidad,'',$_POST['descuento'.$i.'']);
						$editar = $equiporem->editarEquipoRemision();
				}else{
					if($id_equipo->cantidad != $_POST['cantidad'.$i.'']){
						$equipo = new Equipo($id_equipo->id_equipo,'','','','','',$id_equipo->cantidad,'','','','','','','','','','','','','','','','','','','','');
						$editar1 = $equipo->cambiarCantidad1();
						if($editar1){
							$editar2 = $equipo->cambiarCantidad2($_POST['cantidad'.$i.'']);
							if($editar2){
								$equiporem = new EquipoRemision('',$id_r,$id_equipo->id_equipo,$_POST['cantidad'.$i.''],'',$_POST['descuento'.$i.'']);
								$editar = $equiporem->editarEquipoRemision();
							}
						}
						
					}else{
						$equiporem = new EquipoRemision('',$id_r,$id_equipo->id_equipo,$_POST['cantidad'.$i.''],'',$_POST['descuento'.$i.'']);
						$editar = $equiporem->editarEquipoRemision();
					}
				}
			}
			if(sizeof($resp1)!=0){
				for($i=0; $i<count($resp1); $i++){
					$equip=$resp1[$i];
					if($equip->electromecanico == '1'){
						$cantidad=$equip->cantidad;
						$equipo = new Equipo('','','','','','','','','','','','','','','','','','','','','','','','','');
						$cambiarestadoremision=$equipo->cambiarEquiporemision(1,$equip->id,$_SESSION['id_usuario']);
						}else{
							$cantidad=$_POST['cantidad_ed'.$i.''];
							$equipo = new Equipo('','','','','','','','','','','','','','','','','','','','','','','','','');
							$cambiarCantidad=$equipo->cambiarCantidad($cantidad,$equip->id,$_SESSION['id_usuario']);
							$cambiarestadoremision1=$equipo->cambiarEquiporemision(0,$equip->id,0);
							$resp_equipo_sel = $equipo->cambiarEquiporemision1($_SESSION['id_usuario']);
						}
						if($equip->valor_dia != 0){
							$val_equipo=$equip->valor_dia;
						}else if($equip->valor_hora != 0){
							$val_equipo=$equip->valor_hora;
						}else if($equip->valor_metro != 0){
							$val_equipo=$equip->valor_metro;
						}
						$equiporemision = new EquipoRemision('',$id_r,$equip->id,$cantidad,$val_equipo,$_POST['descuento_ed'.$i.'']);
						$guardar_remequipo = $equiporemision->guardarEquipoRemision();
				}
			}
			if(sizeof($respp)!=0){
				for ($j=0; $j<count($respp); $j++){
					$equipo1=$respp[$j];
					$equiposubremision = new EquipoRemisionSub('',$id_r,$equipo1->id,$equipo1->cantidad,$_POST['valorSub_ed'.$j.''],$_POST['descuentoSub_ed'.$j.'']);
					$guardar_remequiposub = $equiposubremision->guardarEquipoRemisionSub();
					$equipoestado = new EntradaSub('','','','','','','');
					$estadoremision=$equipoestado->cambiarEquiporemisionsub('1',$equipo1->id,$_SESSION['id_usuario']);
				}
			}
			echo "<script>alert ('remisión modificada correctamente');</script>";
			echo "<script>window.location.href='EditarRemision.php';</script>";
			}else{
				echo "<script>alert ('Error al editar la remisión');</script>";
				echo "<script>window.location.href='EditarRemision.php';</script>";
			}
	}
	
	if(!empty($_POST['tarea']) and $_POST['tarea']=='salir'){

		$equipo = new Equipo('','','','','','','','','','','','','','','','','','','','','','','','','');
		$cambiar = $equipo->cambiarEstadoEquipo1('B',$_SESSION['id_usuario']);
		
		$entradasub = new EntradaSub('','','','','','','','');
		$elimina_entrada = $entradasub->EliminarEntradaSub1($_SESSION['id_usuario']);
		unset($_SESSION['remision']);
		unset($_SESSION['cliente']);
		unset($_SESSION['obra']);
		unset($_SESSION['valor']);
		unset($_SESSION['id_equipos']);
		echo "<script>window.location.href='MenuRemisiones.php';</script>";
		
	}
	
	if(!empty($_POST['tarea']) and $_POST['tarea']=='nuevo'){

		$equipo = new Equipo('','','','','','','','','','','','','','','','','','','','','','','','','');
		$cambiar = $equipo->cambiarEstadoEquipo1('B',$_SESSION['id_usuario']);
		
		$entradasub = new EntradaSub('','','','','','','','');
		$elimina_entrada = $entradasub->EliminarEntradaSub1($_SESSION['id_usuario']);
		unset($_SESSION['remision']);
		unset($_SESSION['cliente']);
		unset($_SESSION['obra']);
		unset($_SESSION['valor']);
		unset($_SESSION['id_equipos']);
		echo "<script>window.location.href='MenuRemisiones.php';</script>";
		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Editar Remision</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/jscal2.css" />
<script src="js/validaciones.js" language="JavaScript"></script>
<script src="js/salir.js" language="JavaScript"></script>
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
	miPopup = window.open("SeleccionarEquipo.php","miwin","width=800,height=600,scrollbars=yes") 
	miPopup.focus()
} 
</script>
<script> 
var miPopup 
function abreVentanaEquipoSub(){ 
	miPopup = window.open("SeleccionarEquipoSub.php","miwin","width=800,height=600,scrollbars=yes") 
	miPopup.focus() 
} 
</script>

</head>
<body topmargin="0" onLoad="mueveReloj();" onKeyDown = "showDown(window.event)" onBeforeUnload="return actualizar()" >
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
			  <td><a href="javascript:valcrearremision('nuevo')"><img src="imagenes/nueva_obra.png" width="32" height="34" title="Nueva Remision" /></a></td>
			  <td><a href="javascript:valremeditar('guardar',<?php echo count($con_eq); ?>,<?php echo count($eqsubrem); ?>,<?php echo count($resp1); ?>,<?php echo count($respp); ?>)"><img src="imagenes/guardar.png" alt="guardar" width="32" height="32" border="0" title="Guardar Información"/></a></td>
			  <td><a href="BuscarRemision.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Remision"/></a></td>
			  <td><a href="javascript:valcrearremision('salir')"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
			</tr>
		  </table></td>
		</tr>
		<tr>
		  <td align="left" valign="middle">&nbsp;</td>
		</tr>
		<tr>
		  <td align="center" valign="middle"><strong>EDITAR REMISION</strong></td>
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
						<td width="4" align="left" valign="middle">&nbsp;</td>
						<td colspan="2" align="left">Fecha</td>
						</tr>
					  <tr>
						<td align="center" valign="middle">*</td>
						<td align="left"><input name="remisionmanual" type="text" id="remisionmanual" value="<?php if(!empty($remision->id_manual)){echo $remision->id_manual;}?>" onkeypress="javascript:return Numeros(event)" size="40" maxlength="20"/></td>
						<td align="center" valign="middle">&nbsp;</td>
						<td align="left" valign="middle">&nbsp;</td>
						<td width="144" align="left"><input name="fecha_rem" type="text" id="fecha_rem" value="<?php if(!empty($remision->fecha_rem)){echo $remision->fecha_rem;} ?>" maxlength="20" readonly="readonly" />
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
						<td width="4" align="left" valign="middle">&nbsp;</td>
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
						  <td width="153" align="left">Documento </td>
						  <td width="1" align="left" valign="middle">&nbsp;</td>
						  <td width="124" colspan="2" align="left">&nbsp;</td>
						</tr>
						<tr>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left"><input name="nom_cliente" type="text" readonly="readonly" id="nom_cliente" size="40" value="<?php if(!empty($cliente->nombre1)){ echo $cliente->nombre1.' '.$cliente->nombre2.' '.$cliente->apellido1.' '.$cliente->apellido2; } ?>" /></td>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left"><input name="doc_cliente" type="text" readonly="readonly" id="doc_cliente" maxlength="20"  value="<?php if(!empty($cliente->documento)){ echo $cliente->documento; } ?>"/></td>
						  <td align="left" valign="middle">&nbsp;</td>
						  <td colspan="2" align="left"><a onclick="abreVentanaCliente(); javascript:valcrearremision('enc'); " ><img src="imagenes/buscar.png" width="23" height="23" title="Seleccionar Cliente" /></a></td>
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
                        <input name="id_remision" type="hidden" id="id_remision"/>
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
						  <td colspan="2" align="left"><a onclick="abreVentanaObra(); javascript:valcrearremision('enc'); "><img src="imagenes/buscar.png" width="23" height="23" title="Seleccionar Obra" /></a></td>
                          <?php }?>
						</tr>
						<tr>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left"><input name="dir_obra" type="text" id="dir_obra" readonly="readonly" size="40" value="<?php if(!empty($obra->direccion)){ echo $obra->direccion; } ?>" /></td>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left"><input name="mun_obra" type="text" id="mun_obra" readonly="readonly" maxlength="20" value="<?php if(!empty($muni->strdes_mpio)){ echo $muni->strdes_mpio; } ?>"  /></td>
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
						  <td align="center" valign="middle">*</td>
						  <td align="left"><select name="id_contacto" id="id_contacto"  class="campos_mayus">
								   <?php for($i=0; $i<=sizeof($consulta1); $i+=2){
										if($remision->contacto == $consulta1[$i]){
											echo "<option selected=\"selected\" value=\"".$consulta1[$i]."\">".$consulta1[$i+1]."</option>\n";
										}else{
											echo "<option value=\"".$consulta1[$i]."\">".$consulta1[$i+1]."</option>\n";
										}
									}
								   ?>
										
							  </select></td>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left"><select name="id_transporte" id="id_transporte"  class="campos_mayus">
								   <?php for($i=0; $i<=sizeof($bustransporte); $i+=2){
										if($remision->transporte == $bustransporte[$i+1]){
											echo "<option selected=\"selected\" value=\"".$bustransporte[$i+1]."\">".$bustransporte[$i+1]."</option>\n";
										}else{
											echo "<option value=\"".$bustransporte[$i+1]."\">".$bustransporte[$i+1]."</option>\n";
										}
								   
								   } ?>
							  </select></td>
						  <td align="left" valign="middle">&nbsp;</td>
						  <td colspan="2" align="left"><input name="valor_transporte" type="text" id="valor_transporte" maxlength="20" onkeypress="javascript:return Numeros(event)" value="<?php if($remision->valor_transporte!=''){ echo $remision->valor_transporte; } else{echo $valortrans->valor;}?>"/><a onclick="abreVentanaValorTransporte(); javascript:valcrearremision('enc'); "><img src="imagenes/buscar.png" width="23" height="23" title="Seleccionar Valor Transporte" /></a></td>
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
						  <td><textarea name="observaciones" cols="81" rows="5" id="observaciones" class="campos_mayus"><?php echo $remision->observaciones; ?></textarea></td>
						</tr>
					  </table>
					  
					  <table width="224" border="0" align="left">
						<tr>
						  <td width="181" align="center"><strong>Seleccionar Equipo Propio</strong></td>
						  <td width="23" align="left"><a onclick="abreVentanaEquipo(); javascript:valcrearremision('enc'); "><img src="imagenes/buscar.png" width="23" height="23" title="Seleccionar Equipo Propio" /></a></td>
						</tr>
					</table>
					  <table width="261" border="0" align="left">
					    <tr>
					      <td width="221" align="center"><strong>Seleccionar Equipo Subalquilado</strong></td>
					      <td width="30" align="left"><a onclick="abreVentanaEquipoSub(); javascript:valcrearremision('enc');"><img src="imagenes/buscar.png" width="23" height="23" title="Seleccionar Equipo Subalquilado" /></a></td>
					      </tr>
					    </table>
					  <p>&nbsp;</p>
					  <p>&nbsp;</p>

					  <table width="730" border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td colspan="11" align="center"><strong>REGISTROS ENCONTRADOS </strong></td>
						  </tr>
						  <tr>
							<td height="10" colspan="11" align="center">&nbsp;</td>
						  </tr>           
						   <tr bgcolor="#999999">
							<td width="106" align="center"><strong>Referencia Equipo</strong></td>
							<td width="209" align="center"><strong>Nombre del Equipo</strong></td>
							<td width="61" align="center" valign="middle"><strong>Cantidad</strong></td>
							<td width="55" align="center" valign="middle"><strong>Valor</strong></td>
							<td width="75" align="center" valign="middle"><strong>Descuento</strong></td>
							<td width="49" align="center" valign="middle"><strong>Quitar</strong></td>
						  </tr>
                       <?php
					   $total_cupo=0;
						if(sizeof($con_eq)!=0){ ?>
						  <?php
							for ($i=0; $i<count($con_eq); $i++){
									$id_equipo=$con_eq[$i];
									$equipo_rem = $equipo->buscarEquipo('id', $id_equipo->id_equipo);
									$eq=$equipo_rem[0];
									$total_cupo=$total_cupo+$eq->valor_equipo_compra;
							?>
						  
							<tr align="left" class="TablaUsuarios">
										<td width="106" align="center"><?php echo $eq->referencia; ?></a></td>
										<td width="209"><?php echo $eq->nombre;?>
                                        <input type="hidden" name="nomb_post" id="nomb_post<?php echo $i; ?>" value="<?php echo $eq->nombre; ?>"/></td>
										<?php if($eq->electromecanico == '1'){ $_POST['valida_campo']='1'; ?>
							  			<td width="61" align="center" valign="middle"><?php echo $id_equipo->cantidad; ?>
                   			  <input type="hidden" name="valcantidad1" id="valcantidad1<?php echo $i; ?>" value="<?php echo $id_equipo->cantidad; ?>" /></td>
										<?php }else{ ?>
							  <td width="55" align="center" valign="middle"><input type="text" value="<?php echo $id_equipo->cantidad; ?>" id="cantidad<?php echo $i; ?>" name="cantidad<?php echo $i; ?>" size="6px" onkeypress="javascript:return Numeros(event)" />
							  <input type="hidden" name="valcantidad" id="valcantidad<?php echo $i; ?>" value="<?php echo $eq->cantidad; ?>" />
                              <input type="hidden" name="cantidad_ac" id="cantidad_ac<?php echo $i; ?>" value="<?php echo $id_equipo->cantidad; ?>" /></td>
										<?php } ?>
									  	<?php if($eq->valor_dia != 0){ ?>
							  <td width="49" align="center" valign="middle"><?php echo $eq->valor_dia; ?>
						      			
										<?php }else if($eq->valor_hora != 0){?>
							  <td width="49" align="center" valign="middle"><?php echo $eq->valor_hora; ?></td>
										<?php }else if($eq->valor_metro != 0){ ?>
							  <td width="49" align="center" valign="middle"><?php echo $eq->valor_metro; ?></td>
                              <?php }?>
                                        <td width="55" align="center" valign="middle"><input type="text" id="descuento<?php echo $i; ?>" name="descuento<?php echo $i; ?>" value="<?php echo $id_equipo->descuento ?>" size="6px" onkeypress="javascript:return Numeros(event)" /></td>
										
						      <td width="57" align="center" valign="middle"><a href="javascript:enviar_form_clientes('quitar','<?php echo $eq->id; ?>')" ><img src="imagenes/cancelar.png" width="25" height="25" /></a></td>
                            </tr>
							<?php
								
						}
						}
						?>
                      
					    <?php
						if(sizeof($eqsubrem)!=0){ ?>
                        <?php
							for ($j=0; $j<count($eqsubrem); $j++){
									$equipos1=$eqsubrem[$j];
									$equipo_sub_rem = $entradasub->buscarequipoEntrada('id', $equipos1->id_equipo_sub);
									$eqsub=$equipo_sub_rem[0];
									$equipo_sub_rem1 = $equiporemSub->buscarEquipoSub('id_equipo_sub', $eqsub->id);
									$eqsub1=$equipo_sub_rem1[0];
							?>
						  
							<tr align="left" class="TablaUsuarios">
										<td width="106" align="center"><?php echo ' '; ?></a></td>
										<td width="209"><?php echo $eqsub->nombre; ?></td>
                                        <input type="hidden" name="nomb_post_sub" id="nomb_post_sub<?php echo $j; ?>" value="<?php echo $eqsub->nombre; ?>"/>
											<td width="61" align="center" valign="middle"><?php echo $eqsub->cantidad; ?></td>
											<td width="55" align="center" valign="middle"><input type="text" value="<?php echo $eqsub1->valor; ?>"id="valorSub<?php echo $j; ?>" name="valorSub<?php echo $j; ?>" size="6px" onkeypress="javascript:return Numeros(event)" />
                                            <td width="55" align="center" valign="middle"><input type="text" id="descuentoSub<?php echo $j; ?>" name="descuentoSub<?php echo $j; ?>" value="<?php echo $eqsub1->descuento; ?>" size="6px" onkeypress="javascript:return Numeros(event)" />
									   <td width="49" align="center" valign="middle"><a href="javascript:enviar_form_editar_remision('quitar1','<?php echo $eqsub->id; ?>','<?php echo $eqsub1->id_remision; ?>')" ><img src="imagenes/cancelar.png" width="25" height="25" /></a></td>
							</tr>
							<?php
					  }
						}
						?>
			 <?php if((sizeof($resp1)!=0) || (sizeof($respp)!=0)){ ?>
						<tr>
						  </tr>
						  <tr>
						  </tr>           
						   <tr bgcolor="#999999">
						  </tr>
                       <?php
					   $total_cupo_ed=0;
						if(sizeof($resp1)!=0){ ?>
						  <?php
							for ($i=0; $i<count($resp1); $i++){
									$equipo=$resp1[$i];
									$total_cupo_ed=$total_cupo_ed+$equipo->valor_equipo_compra;
							?>
						  
							<tr align="left" class="TablaUsuarios">
										<td width="106" align="center"><?php echo $equipo->referencia; ?></a></td>
										<td width="209"><?php echo $equipo->nombre;?>
                                        <input type="hidden" name="nomb_post_ed" id="nomb_post_ed<?php echo $i; ?>" value="<?php echo $equipo->nombre; ?>"/></td>
										<?php if($equipo->electromecanico == '1'){ $_POST['valida_campo']='1'; ?>
							  			<td width="61" align="center" valign="middle"><?php echo $equipo->cantidad; ?>
                   			  <input type="hidden" name="valcantidad1_ed" id="valcantidad1_ed<?php echo $i; ?>" value="<?php echo $equipo->cantidad; ?>" /></td>
										<?php }else{ ?>
							  <td width="55" align="center" valign="middle"><input type="text" id="cantidad_ed<?php echo $i; ?>" name="cantidad_ed<?php echo $i; ?>" size="6px" onkeypress="javascript:return Numeros(event)" />
							  <input type="hidden" name="valcantidad_ed" id="valcantidad_ed<?php echo $i; ?>" value="<?php echo $equipo->cantidad; ?>" /></td>
										<?php } ?>
									  	<?php if($equipo->valor_dia != 0){ ?>
							  <td width="49" align="center" valign="middle"><?php echo $equipo->valor_dia; ?>
						      			
										<?php }else if($equipo->valor_hora != 0){?>
							  <td width="49" align="center" valign="middle"><?php echo $equipo->valor_hora; ?></td>
										<?php }else if($equipo->valor_metro != 0){ ?>
							  <td width="49" align="center" valign="middle"><?php echo $equipo->valor_metro; ?></td>
                              <?php }?>
                                        <td width="55" align="center" valign="middle"><input type="text" id="descuento_ed<?php echo $i; ?>" name="descuento_ed<?php echo $i; ?>" value="<?php if(!empty($cliente->descuento)){ echo $cliente->descuento;} ?>" size="6px" onkeypress="javascript:return Numeros(event)" /></td>
										
						      <td width="57" align="center" valign="middle"><a href="javascript:enviar_form_clientes('quitar_ed','<?php echo $equipo->id; ?>')" ><img src="imagenes/cancelar1.png" width="25" height="25" /></a></td>
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
							?>
						  
							<tr align="left" class="TablaUsuarios">
										<td width="106" align="center"><?php echo ' '; ?></a></td>
										<td width="209"><?php echo $equipos1->nombre; ?></td>
                                        <input type="hidden" name="nomb_post_sub_ed" id="nomb_post_sub_ed<?php echo $j; ?>" value="<?php echo $equipos1->nombre; ?>"/>
											<td width="61" align="center" valign="middle"><?php echo $equipos1->cantidad; ?></td>
											<td width="55" align="center" valign="middle"><input type="text" id="valorSub_ed<?php echo $j; ?>" name="valorSub_ed<?php echo $j; ?>" size="6px" onkeypress="javascript:return Numeros(event)" />
                                            <td width="55" align="center" valign="middle"><input type="text" id="descuentoSub_ed<?php echo $j; ?>" name="descuentoSub_ed<?php echo $j; ?>" value="<?php if(!empty($cliente->descuento)){echo $cliente->descuento;} ?>" size="6px" onkeypress="javascript:return Numeros(event)" />
									   <td width="49" align="center" valign="middle"><a href="javascript:enviar_form_clientes('quitar_ed1','<?php echo $equipos1->id; ?>')" ><img src="imagenes/cancelar1.png" width="25" height="25" /></a></td>
							</tr>
							<?php
					  }
						}
						?>
			 <?php }?>
			</table>
			<input name="valor" type="hidden" id="valor" value="<?php echo count($resp1); ?>"/>
            <input name="valor1" type="hidden" id="valor1" value="<?php echo count($respp); ?>"/>
            <input name="valor2" type="hidden" id="valor2" value="<?php echo count($con_eq); ?>"/>
            <input name="valor3" type="hidden" id="valor3" value="<?php echo count($eqsubrem); ?>"/>
            <input type="hidden" name="valordia" id="valordia" value="<?php echo $total_cupo; ?>" />
            <input name="valordia_ed" type="hidden" id="valordia_ed" value="<?php echo $total_cupo_ed; ?>" />
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