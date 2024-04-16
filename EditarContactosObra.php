<?php
session_start();
include_once 'Obra.php';
include_once 'ContactoObra.php';
if ($_SESSION["autenticado"] == "1") {
    $fecha = date('Y-m-d H:i');
	$anno_actual = date('Y');
	$obra=unserialize($_SESSION['obra']);
	$contacto = new ContactoObra('','','','','','','','','','');
	$resp = $contacto->buscarContacto($obra->id);
	if($resp){
		$ver_contactos=1;
	}else{
		$ver_contactos=0;
	}
	$ver_contacto='0';
    if(!empty($_POST['tarea'])){
			$str = $_POST['nombre'];
			$str = strtoupper($str);
			$_POST['nombre']=$str;
			$str = $_POST['cargo'];
			$str = strtoupper($str);
			$_POST['cargo']=$str;
			$str = $_POST['profesion'];
			$str = strtoupper($str);
			$_POST['profesion']=$str;
			if ($_POST['tarea'] == 'guardar') {
				if($_SESSION['funcion']!='1'){
					$fecha_nac=$_POST['anno'].'-'.$_POST['mes'].'-'.$_POST['dia'];
					$contacto = new ContactoObra('',$obra->id,$_POST['nombre'],$_POST['cargo'],$_POST['telefono'],$_POST['celular'],$_POST['email'],$fecha_nac,$_POST['profesion'],'1');
					$guardar = $contacto->guardarContacto();
					if ($guardar) {
						$_SESSION['cont']='1';
						echo "<script>alert ('El Contacto fue creado con exito');</script>";
						echo "<script>window.location.href='EditarContactosObra.php';</script>";
					} else {
						$_SESSION['cont']='2';
						echo "<script>alert ('No se pudo crear el contacto, por favor intenta de nuevo');</script>";
						echo "<script>window.location.href='CrearCliente.php';</script>";
					}
				}
				if($_SESSION['funcion']=='1'){
					$conta = unserialize($_SESSION['conta']);
					$fecha_nac=$_POST['anno'].'-'.$_POST['mes'].'-'.$_POST['dia'];
					$contacto = new ContactoObra('',$obra->id,$_POST['nombre'],$_POST['cargo'],$_POST['telefono'],$_POST['celular'],$_POST['email'],$fecha_nac,$_POST['profesion'],'1');
					$edit = $contacto->editarContacto($conta->id);
					if ($edit) {
						unset ($_SESSION['id']);
						$_SESSION['cont']='1';
						$_SESSION['funcion']='2';
						echo "<script>alert ('El Contacto fue editado con exito');</script>";
						echo "<script>window.location.href='EditarContactosObra.php';</script>";
					} else {
						unset ($_SESSION['id']);
						$_SESSION['cont']='2';
						echo "<script>alert ('No se pudo editar el contacto, por favor intenta de nuevo');</script>";
						/*echo "<script>window.location.href='CrearCliente.php';</script>";*/
					}
				}
    	}
	
	if ($_POST['tarea'] == 'editar') {
		$fecha_nac=$_POST['anno'].'-'.$_POST['mes'].'-'.$_POST['dia'];
		$contacto = new ContactoObra('','',$_POST['nombre'],$_POST['cargo'],$_POST['telefono'],$_POST['celular'],$_POST['email'],$fecha_nac,$_POST['profesion'],'1');
		$resp1 = $contacto->buscarContactoId($_POST['id']);
		if ($resp1){
			$cont= $resp1[0];
			$_SESSION['conta']=serialize($cont);
			$date = strtotime($cont->fecha_nacimiento);
			$ver_contacto='1';
			$_SESSION['funcion']='1';
		}
	}
	
	if(!empty($_POST['tarea']) and $_POST['tarea']=='activar'){
			$conta = unserialize($_SESSION['conta']);
			$contacto = new ContactoCliente("", "", "", "", "", "", "", "", "", "");
			$estado = $contacto->activarDesactivarContacto('1', $conta->id);
			$contacto->estado="1";
			if($estado){
				$_SESSION['contacto']=serialize($contacto);
				/*echo "<script>alert('El Contaco ha sido activado correctamente');</script> ";*/
				echo '<script>window.location="EditarContactosCliente.php";</script>';
			}else{
				echo "<script>alert('El Contacto no pudo ser activado, intentelo nuevamente');</script> ";
				echo '<script>window.location="EditarContactosCliente.php";</script>';
			}
		}
		
		if(!empty($_POST['tarea']) and $_POST['tarea']=='desactivar'){
			$conta = unserialize($_SESSION['conta']);
			$contacto = new ContactoObra("", "", "", "", "", "", "", "", "", "");
			$estado = $contacto->activarDesactivarContacto('2', $conta->id);
			if($estado){
				$_SESSION['contacto']=serialize($contacto);
				/*echo "<script>alert('El Contacto ha sido desactivado correctamente');</script> ";*/
				echo '<script>window.location="EditarContactosObra.php";</script>';
			}
			else{
				echo "<script>alert('El Contacto no pudo ser desactivado, intentelo nuevamente');</script> ";
				echo '<script>window.location="EditarContactosObra.php";</script>';
			}
			$resppp = $contacto->buscarContactoActivado($obra->id);
			if(count($resppp)==0){
				$_SESSION['funcion']=2;
			}
		}
		
		if(!empty($_POST['tarea']) and $_POST['tarea']=='listado'){
			$conta = unserialize($_SESSION['conta']);
			$contacto = new ContactoObra("", "", "", "", "", "", "", "", "", "");
			$estado = $contacto->activarDesactivarContacto('2', $conta->id);
			$contacto->estado="0";
			if($estado){
				$_SESSION['contacto']=serialize($contacto);
				echo "<script>alert('El Contacto ha sido desactivado correctamente');</script> ";
				echo '<script>window.location="EditarContactosObra.php";</script>';
			}else{
				echo "<script>alert('El Contacto no pudo ser desactivado, intentelo nuevamente');</script> ";
				echo '<script>window.location="EditarContactosObra.php";</script>';
			}
		}
 }
 	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Editar Contactos Obra</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script src="js/validaciones.js" language="JavaScript"></script>
<script src="js/reloj.js" language="JavaScript"></script>
<style type="text/css">
<!--
.style1 {font-size: 14px}

-->
</style>
</head>

<body topmargin="0" onLoad="mueveReloj();" onKeyDown = "showDown(window.event)">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><form action="" method="post" name="form1" class="FormGeneral" id="form1" target="_parent" enctype="multipart/form-data">
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
                    <td width="97%" align="right" valign="middle"><span class="Estilo6">Usuario: <?php echo "".$_SESSION["nombre"].' '.$_SESSION['apellido']; ?> - <a href="logout.php"></a></span></td>
                    <td width="3%" align="center" valign="middle"><a href="logout.php"><img src="imagenes/eqsl_exit.png" width="30" height="30" border="0" title="Salir" /></a></td>
                  </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="middle"><table width="100" border="0" cellspacing="0" cellpadding="0">
            <tr align="center" valign="middle">
              <td><a href="javascript:valeditcontactos('guardar')"><img src="imagenes/guardar.png" alt="guardar" width="32" height="32" border="0" title="Guardar Informacion" /></a></td>
              <td><a href="BuscarObra.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Obra"/></a></td>
              <?php if(!empty($_SESSION['funcion']) && $_SESSION['funcion']=='1'){ ?>
			  		<td><a href="javascript:valeditcontactos('desactivar')"><img src="imagenes/desactivar_user.png" alt="activar" width="32" height="32" border="0" /></a></td>
				<?php } else {?>
					<td><img src="imagenes/desactivar_user_opaco.png" alt="activar" width="32" height="32" border="0" /></td>
				<?php } ?>
              <td><a href="EditarObra.php"><img src="imagenes/flecha.png" width="32" height="32" border="0" title="Volver a la Obra" /></a></td>
			  <td><a href="ListadoContactosDesactivadosObra.php"><img src="imagenes/desactivados1.png" width="34" height="36" border="0" title="Contactos Desactivados" /></a></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center" valign="middle"><span class="style1">EDITAR CONTACTOS DE LA OBRA </span></td>
        </tr>
        <tr>
          <td align="left" valign="middle">&nbsp;</td>
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
                    <td width="718" height="524" valign="top">  <table width="686" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td colspan="8" align="left" valign="middle">&nbsp;</td>
                        </tr>
                      <tr>
                        <td width="10" align="left" valign="middle">&nbsp;</td>
                        <td colspan="4" align="left">Nombre Completo</td>
                        <td width="64" align="left" valign="middle">&nbsp;</td>
                        <td colspan="2" align="left">Cargo</td>
                        </tr>
                      <tr>
                        <td width="10" align="center" valign="middle">*</td>
                        <td colspan="4" align="left"><input name="nombre" type="text" id="nombre" size="50" class="campos_mayus" <?php if($ver_contacto=='1'){ ?> value=  '<?php echo $cont->nombre;} ?>' />
                          <input type="hidden" name="valcont" id="valcont" value"<?php ?>" />
						</td>
                        <td width="64" align="right" valign="middle"><div align="right">* </div></td>
                        <td colspan="2" align="left"><input name="cargo" type="text" class="campos_mayus" id="cargo" <?php if($ver_contacto=='1'){ ?> value= "<?php echo $cont->cargo ; } ?>"/>                          
                          <div align="center"></div></td>
                        </tr>
                      <tr>
                        <td colspan="8" align="left" valign="middle">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="10" align="left" valign="middle">&nbsp;</td>
                        <td width="255" align="left">E-mail</td>
                        <td width="11" align="left">&nbsp;</td>
                        <td colspan="3" align="left">Telefono</td>
                        <td width="174" align="left">&nbsp;</td>
                        <td width="23" align="left">&nbsp;</td>
                        </tr>
                      <tr>
                        <td align="center" valign="middle">*</td>
                        <td align="left"><input name="email" type="text" id="email" size="30" maxlength="100" <?php if($ver_contacto=='1'){ ?> value='<?php echo $cont->email; } ?>' /></td>
                        <td align="center">*</td>
                        <td colspan="5" align="left"><input name="tarea" type="hidden" id="tarea" />
                          <input name="telefono" type="text" id="telefono" maxlength="100" class="campos_mayus" <?php if($ver_contacto=='1'){ ?> value='<?php echo $cont->telefono; } ?>' />
                          <input name="id" type="hidden" id="id"/>
                          <input name="funcion" type="hidden" id="funcion" /></td>
                        </tr>
                      <tr>
                        <td align="center" valign="middle">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        <td colspan="3" align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center" valign="middle">&nbsp;</td>
                        <td align="left">Celular</td>
                        <td align="left">&nbsp;</td>
                        <td colspan="3" align="left">Fecha de Nacimiento</td>
                        <td align="left">Profesion</td>
                        <td align="left">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center" valign="middle">&nbsp;</td>
                        <td align="left"><input name="celular" type="text" id="celular"  class="campos_mayus" <?php if($ver_contacto=='1'){ ?> value='<?php echo $cont->celular; } ?>'/></td>
                        <td align="left">&nbsp;</td>
                        <td colspan="3" align="left"><select name="dia" id="dia">
                          <option value="1" <?php if($ver_contacto=='1'){ if(date("Y", $date)==1){ echo 'selected'; }  } ?>>1</option>
                          <option value="2" <?php if($ver_contacto=='1'){ if(date("d", $date)=='2'){ echo 'selected'; }  } ?>>2</option>
                          <option value="3" <?php if($ver_contacto=='1'){ if(date("d", $date)=='3'){ echo 'selected'; }  } ?>>3</option>
                          <option value="4" <?php if($ver_contacto=='1'){ if(date("d", $date)=='4'){ echo 'selected'; }  } ?>>4</option>
                          <option value="5" <?php if($ver_contacto=='1'){ if(date("d", $date)=='5'){ echo 'selected'; }  } ?>>5</option>
                          <option value="6" <?php if($ver_contacto=='1'){ if(date("d", $date)=='5'){ echo 'selected'; }  } ?>>6</option>
                          <option value="7" <?php if($ver_contacto=='1'){ if(date("d", $date)=='7'){ echo 'selected'; }  } ?>>7</option>
                          <option value="8" <?php if($ver_contacto=='1'){ if(date("d", $date)=='8'){ echo 'selected'; }  } ?>>8</option>
                          <option value="9" <?php if($ver_contacto=='1'){ if(date("d", $date)=='9'){ echo 'selected'; }  } ?>>9</option>
                          <option value="10" <?php if($ver_contacto=='1'){ if(date("d", $date)=='10'){ echo 'selected'; }  } ?>>10</option>
                          <option value="11" <?php if($ver_contacto=='1'){ if(date("d", $date)=='11'){ echo 'selected'; }  } ?>>11</option>
                          <option value="12" <?php if($ver_contacto=='1'){ if(date("d", $date)=='12'){ echo 'selected'; }  } ?>>12</option>
                          <option value="13" <?php if($ver_contacto=='1'){ if(date("d", $date)=='13'){ echo 'selected'; }  } ?>>13</option>
                          <option value="14" <?php if($ver_contacto=='1'){ if(date("d", $date)=='14'){ echo 'selected'; }  } ?>>14</option>
                          <option value="15" <?php if($ver_contacto=='1'){ if(date("d", $date)=='15'){ echo 'selected'; }  } ?>>15</option>
                          <option value="16" <?php if($ver_contacto=='1'){ if(date("d", $date)=='16'){ echo 'selected'; }  } ?>>16</option>
                          <option value="17" <?php if($ver_contacto=='1'){ if(date("d", $date)=='17'){ echo 'selected'; }  } ?>>17</option>
                          <option value="18" <?php if($ver_contacto=='1'){ if(date("d", $date)=='18'){ echo 'selected'; }  } ?>>18</option>
                          <option value="19" <?php if($ver_contacto=='1'){ if(date("d", $date)=='19'){ echo 'selected'; }  } ?>>19</option>
                          <option value="20" <?php if($ver_contacto=='1'){ if(date("d", $date)=='20'){ echo 'selected'; }  } ?>>20</option>
                          <option value="21" <?php if($ver_contacto=='1'){ if(date("d", $date)=='21'){ echo 'selected'; }  } ?>>21</option>
                          <option value="22" <?php if($ver_contacto=='1'){ if(date("d", $date)=='22'){ echo 'selected'; }  } ?>>22</option>
                          <option value="23" <?php if($ver_contacto=='1'){ if(date("d", $date)=='23'){ echo 'selected'; }  } ?>>23</option>
                          <option value="24" <?php if($ver_contacto=='1'){ if(date("d", $date)=='24'){ echo 'selected'; }  } ?>>24</option>
                          <option value="25" <?php if($ver_contacto=='1'){ if(date("d", $date)=='25'){ echo 'selected'; }  } ?>>25</option>
                          <option value="26" <?php if($ver_contacto=='1'){ if(date("d", $date)=='26'){ echo 'selected'; }  } ?>>26</option>
                          <option value="27" <?php if($ver_contacto=='1'){ if(date("d", $date)=='27'){ echo 'selected'; }  } ?>>27</option>
                          <option value="28" <?php if($ver_contacto=='1'){ if(date("d", $date)=='28'){ echo 'selected'; }  } ?>>28</option>
                          <option value="29" <?php if($ver_contacto=='1'){ if(date("d", $date)=='29'){ echo 'selected'; }  } ?>>29</option>
                          <option value="30" <?php if($ver_contacto=='1'){ if(date("d", $date)=='30'){ echo 'selected'; }  } ?>>30</option>
                          <option value="31" <?php if($ver_contacto=='1'){ if(date("d", $date)=='31'){ echo 'selected'; }  } ?>>31</option>
                        </select> 
                          - 
                          <select name="mes" id="mes">
                            <option value="1" <?php if($ver_contacto=='1'){ if(date("m", $date)=='1'){ echo 'selected'; }  } ?>>1</option>
                            <option value="2" <?php if($ver_contacto=='1'){ if(date("m", $date)=='2'){ echo 'selected'; }  } ?>>2</option>
                            <option value="3" <?php if($ver_contacto=='1'){ if(date("m", $date)=='3'){ echo 'selected'; }  } ?>>3</option>
                            <option value="4" <?php if($ver_contacto=='1'){ if(date("m", $date)=='4'){ echo 'selected'; }  } ?>>4</option>
                            <option value="5" <?php if($ver_contacto=='1'){ if(date("m", $date)=='5'){ echo 'selected'; }  } ?>>5</option>
                            <option value="6" <?php if($ver_contacto=='1'){ if(date("m", $date)=='6'){ echo 'selected'; }  } ?>>6</option>
                            <option value="7" <?php if($ver_contacto=='1'){ if(date("m", $date)=='7'){ echo 'selected'; }  } ?>>7</option>
                            <option value="8" <?php if($ver_contacto=='1'){ if(date("m", $date)=='8'){ echo 'selected'; }  } ?>>8</option>
                            <option value="9" <?php if($ver_contacto=='1'){ if(date("m", $date)=='9'){ echo 'selected'; }  } ?>>9</option>
                            <option value="10" <?php if($ver_contacto=='1'){ if(date("m", $date)=='10'){ echo 'selected'; }  } ?>>10</option>
                            <option value="11" <?php if($ver_contacto=='1'){ if(date("m", $date)=='11'){ echo 'selected'; }  } ?>>11</option>
                            <option value="12" <?php if($ver_contacto=='1'){ if(date("m", $date)=='12'){ echo 'selected'; }  } ?>>12</option>
                          </select> 
                          - 
                          <select name="anno" id="anno">
						  <?php
						  	for($i=$anno_actual; $i>=1940; $i--){
								if($ver_contacto=='1' && $i== date("Y", $date)){
									echo '<option value="'.$i.'" selected >'.$i.'</option>';
								}
								echo '<option value="'.$i.'" >'.$i.'</option>';
							}
						  	
						   ?>
                          </select></td>
                        <td align="left"><input name="profesion" type="text" id="profesion" class="campos_mayus" <?php if($ver_contacto=='1'){ ?> value='<?php echo $cont->profesion; } ?>' /></td>
                        <td align="left">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center" valign="middle">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        <td width="82" align="left">Dia</td>
                        <td width="67" align="left"><div align="left">Mes</div></td>
                        <td align="left"><div align="left">A&ntilde;o</div></td>
                        <td align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="8" align="center" valign="middle">&nbsp;
						</td>
                        </tr>
                    </table>
                      <table width="600" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td colspan="7" align="center"><strong>CONTACTOS</strong></td>
                          </tr>
                        <tr>
                          <td width="225" align="center">&nbsp;</td><td width="175">&nbsp;</td>
                          <td width="100" align="center" valign="middle">&nbsp;</td>
                          <td width="100" align="center" valign="middle">&nbsp;</td>
                          <td width="100" align="center" valign="middle">&nbsp;</td>
                          </tr>
                        <tr align="center">
                          <td width="225" bgcolor="#CCCCCC">Nombre</td>
                          <td width="175" bgcolor="#CCCCCC">Cargo </td>
                          <td width="100" valign="middle" bgcolor="#CCCCCC">Telefono</td>
                          <td width="100" valign="middle" bgcolor="#CCCCCC">Email</td>
                          <td width="100" valign="middle" bgcolor="#CCCCCC">Editar</td>
                          </tr>
                        <?php
						if(!empty($ver_contactos) && $ver_contactos == '1'){ 
							for ($i=0; $i<count($resp); $i++){
								$contacto = $resp[$i];
								if($contacto->estado == '1'){
						?>
                        <tr align="left" class="TablaUsuarios">
                          <td width="225"><?php echo $contacto->nombre; ?></td>
                          <td width="175"><?php echo $contacto->cargo; ?></td>
                          <td width="100" align="center" valign="middle"><?php echo $contacto->telefono; ?></td>
                          <td width="100" align="center" valign="middle"><?php echo $contacto->email; ?></td>
                          <td width="100" align="center" valign="middle"><a href="javascript:enviar_form_edit_contactos('editar','<?php echo $contacto->id; ?>')"><img src="imagenes/editar.png" width="30" height="30" border="0" /></a></td>
                          </tr>
                        <?php 	} 
							} 
						}else{
							echo 'no hay contactos';
						} 
						?>
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