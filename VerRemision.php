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

if (!empty($_SESSION["autenticado"]) && $_SESSION["autenticado"] == "1"){

	$remision=unserialize($_SESSION['remision']);
	$cliente = new Cliente("","","","","","","","","","","","","","","","","","","","","","","","","","","","");
	$cons_cliente=$cliente->buscarCliente('id',$remision->id_cliente);
	$cliente_cons=$cons_cliente[0];
	$obra = new Obra("","","","","","","","","","","","","","","","","","","","","");
	$cons_obra=$obra->buscarObraGeneral('id',$remision->id_obra);
	$obra_cons=$cons_obra[0];
	$mun = new Municipio('','','','');
	$municipio = $mun->buscarMpioObra($obra_cons->pais,$obra_cons->departamento,$obra_cons->municipio);
	$mun_cons=$municipio[0];
	$contacto = new ContactoObra('','','','','','','','','','');
	$consulta = $contacto->buscarContactoRemision($remision->id_obra,$remision->contacto);
	$cont_cons=$consulta[0];
	$equiporem = new EquipoRemision('','','','');
	$con_eq = $equiporem->buscarEquiposRemisionados('id_remision',$remision->id);
	$equipo = new Equipo('','','','','','','','','','','','','','','','','','','','','','','','','','','');
	$equiposubrem = new EquipoRemisionSub('','','','');
	$eqsubrem=$equiposubrem->buscarEquipoSub('id_remision',$remision->id);
	$entradasub = new EntradaSub('','','','','','','');
	$equiporemSub = new EquipoRemisionSub('','','','','','');
	
	$fecha = date('Y-m-d H:i');
	$fecha_rem = date('Y-m-d');	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ver Remision</title>
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
function abrePDF(){ 
	miPopup = window.open("PDFremision.php","miwin","width=700,height=600,scrollbars=yes") 
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
			  <td><a href="CrearRemision.php"><img src="imagenes/nueva_obra.png" width="32" height="34" title="Nueva Remision" /></a></td>			  <td><a href="BuscarRemision.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Remision"/></a></td>
			  <td><a href="PDFremision.php" TARGET="_blank"><img src="imagenes/imprimir.png" alt="buscar" width="33" height="33" border="0" title="Imprimir Remision"/></a></td>
			  <td><a href="MenuRemisiones.php"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
			</tr>
		  </table></td>
		</tr>
		<tr>
		  <td align="left" valign="middle">&nbsp;</td>
		</tr>
		<tr>
		  <td align="center" valign="middle"><strong> REMISION</strong></td>
		</tr>
	  </table>
	  <table width="640" height="auto" border="0" cellspacing="0" cellpadding="8" style="background:url(imagenes/fondo_form_600.png) no-repeat;">
		<tr>
		  <td align="center"><table width="630" border="0" cellpadding="0" cellspacing="0">
			<tr>
			  <td width="819" align="center">&nbsp;</td>
			  </tr>
			<tr>
			  <td align="center"><table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr align="center">
					<td width="718" height="524" valign="top"> <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
					  <tr>
						<td height="31" colspan="6" align="left" valign="middle">&nbsp;</td>
						</tr>
					  <tr>
						<td width="7" align="left" valign="middle">&nbsp;</td>
						<td width="202" align="left"><strong>Nro. Remision</strong></td>
						<td width="10" align="left" valign="middle">&nbsp;</td>
						<td width="215" align="left"><strong>Nro. Manual Remision</strong></td>
						<td width="4" align="left" valign="middle">&nbsp;</td>
						<td width="154" align="left"><strong>Fecha</strong></td>
					</tr>
					  <tr>
						<td align="center" valign="middle"></td>
						<td align="left"><?php echo $remision->id; ?></td>
						<td align="center" valign="middle">&nbsp;</td>
						<td align="left"><?php echo $remision->id_manual; ?></td>
						<td align="left" valign="middle">&nbsp;</td>
						<td colspan="2" align="left"><?php echo $remision->fecha_rem; ?>						  
						<script type="text/javascript">//<![CDATA[

					  var cal = Calendar.setup({
						  onSelect: function(cal) { cal.hide() },
						  showTime: true
					  });
					  cal.manageFields("cal_1", "fecha_rem", "%Y-%m-%d");

					//]]></script></tr>
					  <tr>
						</tr>
					</table>
					<fieldset><legend><strong> Cliente</strong></legend>
					  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
						</tr>
						<tr>
						  <td width="7" align="left" valign="middle">&nbsp;</td>
						  <td width="306" align="left"><strong>Nombre Cliente</strong></td>
						  <td width="1" align="left" valign="middle">&nbsp;</td>
						  <td width="153" align="left"><strong>Documento</strong> </td>
						  <td width="1" align="left" valign="middle">&nbsp;</td>
						  <td width="124" colspan="2" align="left">&nbsp;</td>
						</tr>
						<tr>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left"><?php echo $cliente_cons->nombre1.' '.$cliente_cons->nombre2.' '.$cliente_cons->apellido1.' '.$cliente_cons->apellido2; ?></td>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left"><?php echo $cliente_cons->documento; ?></td>
						  <td align="left" valign="middle">&nbsp;</td>
						  <td colspan="2" align="left">&nbsp;</td>
						</tr>
						<tr>
						</tr>
					  </table>
					  </fieldset>
					  
					  <fieldset ><legend><strong> Obra</strong></legend>
					  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
						</tr>
						<tr>
						  <td width="8" align="left" valign="middle">&nbsp;</td>
						  <td width="392" align="left"><strong>Nombre Obra</strong></td>
						  <td width="4" align="left" valign="middle">&nbsp;</td>
						  <td width="244" align="left"><strong>Telefono de la Obra</strong></td>
						  <td width="4" align="left" valign="middle">&nbsp;</td>
						  <td width="66" colspan="2" align="left">&nbsp;</td>
						</tr>
						<tr>
						  <td height="18" align="center" valign="middle">&nbsp;</td>
						  <td align="left"><?php echo $obra_cons->nombre; ?></td>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left"><?php echo $obra_cons->telefono; ?></td>
						  <td align="left" valign="middle">&nbsp;</td>
						  <td colspan="2" align="left">&nbsp;</td>
						  </tr>
						<tr>
						  <td height="16" align="center" valign="middle">&nbsp;</td>
						  <td align="left"><strong>Direccion de la Obra</strong></td>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left"><strong>Municipio de la Obra</strong></td>
						  <td align="left" valign="middle">&nbsp;</td>
						  <td colspan="2" align="left">&nbsp;</td>
						</tr>
						<tr>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left"><?php echo $obra_cons->direccion; ?></td>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left"><?php echo $mun_cons->strdes_mpio; ?></td>
						  <td align="left" valign="middle">&nbsp;</td>
						  <td colspan="2" align="left">&nbsp;</td>
						</tr>
						<tr>
						</tr>
					  </table>
					  </fieldset>
                      <fieldset>
					  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
						  <td width="8" align="left" valign="middle">&nbsp;</td>
						  <td width="307" align="left"><strong>Contacto</strong></td>
						  <td width="8" align="left" valign="middle">&nbsp;</td>
						  <td width="196" align="left"><strong>Transporte</strong></td>
						  <td width="4" align="left" valign="middle">&nbsp;</td>
						  <td width="199" align="left"><strong>Valor Transporte</strong></td>
						  </tr>
						<tr>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left"><?php echo $cont_cons->nombre; ?></td>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left"><?php echo $remision->transporte; ?></td>
						  <td align="left" valign="middle">&nbsp;</td>
						  <td align="left"><?php echo $remision->valor_transporte; ?></td>
						</tr>
						<tr>
						  
						  <td width="8" align="center" valign="middle">&nbsp;</td>
						  <td width="307" align="left"><strong>Observaciones</strong></td>
						  <td width="8" align="center" valign="middle">&nbsp;</td>
						  <td width="196" align="left">&nbsp;</td>
						  <td width="4" align="left" valign="middle">&nbsp;</td>
						  <td align="left">&nbsp;</td>
						  </tr>
						<tr>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td width="307" align="left"><?php echo $remision->observaciones; ?></td>
						  <td width="8" align="center" valign="middle">&nbsp;</td>
						  <td width="196" align="left">&nbsp;</td>
						  <td width="4" align="left" valign="middle">&nbsp;</td>
						  <td align="left">&nbsp;</td>
						  </tr>
						</table>
                      </fieldset>
					  <table width="615" border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td colspan="10" align="center"><strong>REGISTROS ENCONTRADOS </strong></td>
						  </tr>
						  <tr>
							<td height="10" colspan="10" align="center">&nbsp;</td>
						  </tr>           
						   <tr bgcolor="#999999">
							<td width="121" align="center"><strong>Referencia Equipo</strong></td>
							<td width="277" align="center"><strong>Nombre del Equipo</strong></td>
							<td width="64" align="center" valign="middle"><strong>Cantidad</strong></td>
							<td width="64" align="center" valign="middle"><strong>V. Base</strong></td>
                            <td width="64" align="center" valign="middle"><strong>V. Final</strong></td>
                            <td width="64" align="center" valign="middle"><strong>Desc %</strong></td>
						  </tr>
                        <?php
						if(sizeof($con_eq)!=0){ ?>
						  <?php
							for ($i=0; $i<count($con_eq); $i++){
									$id_equipo=$con_eq[$i];
									$equipo_rem = $equipo->buscarEquipo('id', $id_equipo->id_equipo);
									$eq=$equipo_rem[0];
						  ?>
							<tr align="left" class="TablaUsuarios">
										<td width="121" align="center"><?php echo $eq->referencia; ?></a></td>
										<td width="277"><?php echo $eq->nombre;?></td>
				  			  <td width="64" align="center" valign="middle"><?php echo $id_equipo->cantidad; ?>
								<?php if($eq->valor_dia != 0){ 
											$valorbase=$eq->valor_dia;
										}else if($eq->valor_hora != 0){
							  				$valorbase=$eq->valor_hora;
										}else if($eq->valor_metro != 0){
											$valorbase=$eq->valor_metro;
										} ?>
                             	<td width="64" align="center" valign="middle"><?php echo $valorbase; ?></td>
                                <td width="64" align="center" valign="middle"><?php echo $con_eq[$i]->valorfinal; ?></td>
                                <td width="64" align="center" valign="middle"><?php echo $con_eq[$i]->descuento; ?></td>
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
										<td width="121" align="center"><?php echo ' '; ?></a></td>
										<td width="277"><?php echo $eqsub->nombre; ?></td>
											<td width="64" align="center" valign="middle"><?php echo $eqsub->cantidad; ?></td>
                                            <td width="64" align="center" valign="middle"><?php echo $eqsub1->valor; ?></td>
							</tr>
							<?php
					  }
						}
						?>
			 
			</table>
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