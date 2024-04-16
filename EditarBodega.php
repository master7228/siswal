<?php
 session_start();
	include_once 'Bodega.php';
	include_once 'ContactoBodega.php';
	include_once 'Pais.php';
	include_once 'Usuario.php';
	include_once 'Departamento.php';
	include_once 'Municipio.php';
	include_once 'Registro.php';
	if ($_SESSION["autenticado"] == "1") {
		$fecha = date('Y-m-d H:i');
		$bodega=unserialize($_SESSION['bodega']);
		$pais = new Pais('','','');
		$paises = $pais->getPaises();
		$dpto= new Departamento('','','','');
		$municipio= new Municipio('','','','');
		$vendedor = new Usuario('','','','','','','','','','','','','');
		$consulta = $vendedor->buscarUsuario('id_grupo_usuarios','2');
		$contacto = new ContactoBodega('','','','','','','','');
		$respu = $contacto->buscarContacto($bodega->id);
		$_SESSION['contactos']= serialize($respu);
		$ver_contactos=1;
		$_SESSION['cont']='2';
		
				
				if(!empty($_POST['tarea']) && $_POST['tarea']!='activar' && $_POST['tarea']!='salir'){
			//--Convertir Campos a Mayusculas--
				$str = $_POST['nombre'];
				$str = strtoupper($str);
				$_POST['nombre']=$str;
				$str = $_POST['pais'];
				$str = strtoupper($str);
				$_POST['pais']=$str;
				$str = $_POST['departamento'];
				$str = strtoupper($str);
				$_POST['departamento']=$str;
				$str = $_POST['municipio'];
				$str = strtoupper($str);
				$_POST['municipio']=$str;
				$str = $_POST['barrio'];
				$str = strtoupper($str);
				$_POST['barrio']=$str;
				$str = $_POST['direccion'];
				$str = strtoupper($str);
				$_POST['direccion']=$str;
				$str = $_POST['observaciones'];
				$str = strtoupper($str);
				$_POST['observaciones']=$str;
				$str = $_POST['pais'];
				$str = strtoupper($str);
				$_POST['pais']=$str;
				$str = $_POST['municipio'];
				$str = strtoupper($str);
				$_POST['municipio']=$str;
				$str = $_POST['departamento'];
				$str = strtoupper($str);
				$_POST['departamento']=$str;
			
					if ($_POST['tarea'] == 'guardar') {
						$bodegas = new Bodega('',$fecha,$_POST['nombre'],$_POST['tipo'],$_POST['direccion'],$_POST['pais'],$_POST['departamento'],$_POST['municipio'],$_POST['barrio'],$_POST['observaciones'],'1');
						$editar = $bodegas->editarBodega($bodega->nombre);
						if ($editar){
							$bodega_cre = $bodega->buscarBodega('*',$bodega->nombre);
							$bod_cre = $bodega_cre[0];
							$registro= new Registro('',$_SESSION['id_usuario'],'EDITAR BODEGA',$bod_cre->nombre,$bod_cre->id,$fecha);
							$guardar_registro = $registro->guardarRegistro();
							echo "<script>alert ('La bodega fue modificada con exito');</script>";
							$_SESSION['bodega']=serialize($bod_cre);
							$_SESSION['var']='1';
							echo "<script>window.location.href='EditarBodega.php';</script>";
						} else {
							echo "<script>alert ('No se pudo modificar la bodega, por favor intenta de nuevo');</script>";
						}
				}
		
		
			}
		if(!empty($_POST['tarea']) && $_POST['tarea'] == 'contactos'){
				$bodega = new Bodega('',$fecha,$_POST['nombre'],$_POST['tipo'],$_POST['direccion'],$_POST['pais'],$_POST['departamento'],$_POST['municipio'],$_POST['barrio'],$_POST['observaciones'],'1');
				$editar = $bodega->editarBodega($bodega->nombre);
				if ($editar){
					$bodega_cre = $bodega->buscarBodega('*',$bodega->nombre);
					$bod_cre = $bodega_cre[0];
					$_SESSION['bodega']=serialize($bod_cre);
					$_SESSION['funcion']='0';
					echo "<script>window.location.href='EditarContactosBodega.php';</script>";
				}
		}
		
		if(!empty($_POST['tarea']) && $_POST['tarea'] == 'id_bodega'){
				$bodega =new Bodega('',$fecha,$_POST['nombre'],$_POST['tipo'],$_POST['direccion'],$_POST['pais'],$_POST['departamento'],$_POST['municipio'],$_POST['barrio'],$_POST['observaciones'],'1');
				$_SESSION['bodega']=serialize($bodega);
				echo "<script>window.location.href='CambiarIdBodega.php';</script>";
		}
		if(!empty($_POST['tarea']) and $_POST['tarea']=='activar'){
			$est_bodega= new Bodega("", "","", "", "", "", "", "", "", "", "");
			$estado = $est_bodega->activarDesactivarBodega('1', $bodega->nombre);
			$bodega->estado="1";
			if($estado){
				$bodega_cre = $bodega->buscarbodega1('*',$bodega->nombre);
				$bod_cre = $bodega_cre[0];
				$registro= new Registro('',$_SESSION['id_usuario'],'ACTIVAR BODEGA',$bod_cre->nombre,$bod_cre->id,$fecha);
				$_SESSION['bodega']=serialize($bodega);
				echo "<script>alert('La bodega ha sido activada correctamente');</script> ";
				echo '<script>window.location="EditarBodega.php";</script>';
			}else{
				echo "<script>alert('La bodega no pudo ser activada, intentelo nuevamente');</script> ";
				echo '<script>window.location="EditarBodega.php";</script>';
			}
		}
		
		if(!empty($_POST['tarea']) and $_POST['tarea']=='desactivar'){
			$est_bodega= new Bodega("", "","", "", "", "", "", "", "", "", "");
			$estado = $est_bodega->activarDesactivarBodega('2', $bodega->nombre);
			$bodega->estado="2";
			if($estado){
				$bodega_cre = $est_bodega->buscarbodega1('*',$_POST['nombre']);
				$bod_cre = $bodega_cre[0];
				$registro= new Registro('',$_SESSION['id_usuario'],'DESACTIVAR BODEGA',$bod_cre->nombre,$bod_cre->id,$fecha);
				$_SESSION['bodega']=serialize($bodega);
				echo "<script>alert('La bodega ha sido desactivada correctamente');</script> ";
			}else{
				echo "<script>alert('La bodega no pudo ser desactivada, intentelo nuevamente');</script> ";
				echo '<script>window.location="EditarBodega.php";</script>';
			}
		}
			
			if(!empty($_POST['tarea']) && $_POST['tarea'] == 'salir'){
				unset($_SESSION['usuario']);
				unset($_SESSION['tipo_doc']);
				unset ($_SESSION['var']);
				echo "<script>window.location.href='MenuBodega.php';</script>";
			} 
			if(!empty($_POST['tarea']) && $_POST['tarea'] == 'nuevo'){
				unset($_SESSION['bodega']);
				unset($_SESSION['bodegas']);
				unset($_SESSION['cont']);
				unset($_SESSION['gcont']);
				echo "<script>window.location.href='ValidarBodega.php';</script>";
			}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Editar Bodega</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script src="js/validaciones.js" language="JavaScript"></script>
<script src="js/ajax.js" language="JavaScript"></script>
 <script language="JavaScript" src ="js/digitov.js"></script> 
<script src="js/reloj.js" language="JavaScript"></script>


 <style type="text/css">
<!--
.style1 {font-size: 14px}
-->
 </style>
</head>

<body topmargin="0" onLoad="mostrarPaises(); mueveReloj();" onKeyDown = "showDown(window.event)">

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
                    <td colspan="2" align="right" valign="top">
                    <table width="128" border="0" align="right" cellpadding="2" cellspacing="2" > 
                    	<tr> 
                    		<th width="114" scope="col"><font id="cl"><strong>0</strong></font></th> 
                    	</tr> 
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="93%" align="right" valign="middle"><span class="Estilo6">Usuario: <?php echo "".$_SESSION["nombre"].' '.$_SESSION['apellido']; ?> -</span></td>
                    <td width="7%" align="center" valign="middle"><a href="logout.php"><img src="imagenes/eqsl_exit.png" alt="" width="30" height="30" title="Salir" border="0" /></a></td>
                  </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="middle"><table width="100" border="0" cellspacing="0" cellpadding="0">
            <tr align="center" valign="middle">
              <td><a href="javascript:valgeneral('nuevo')"><img src="imagenes/nueva_obra.png" alt="nuevo" width="32" height="32" border="0" title="Crear Nueva Bodega"/></a></td>
              <td><?php 
			  		if($bodega->estado == 1){?>
                  <a href="javascript:tarea_editar_bodega('guardar')"><img src="imagenes/guardar.png" alt="guardar" width="32" height="32" border="0" title="Guardar Informaci&oacute;n" onclick="return validarEmail(email,'email')"/></a>
                  <?php 
				    }else{?>
                  <img src="imagenes/guardar_opaco.png" alt="guardar" width="32" height="32" border="0" title="Guardar Informaci&oacute;n"/>
                  <?php }?>
              </td>
              <td><a href="BuscarBodega.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Bodega"/></a></td>
              <td><?php 
			  		if($bodega->estado == 2){?>
                  <a href="javascript:tarea_editar_usuario('activar')"><img src="imagenes/activar_user.png" alt="activar" width="32" height="32" border="0" title="Activar Bodega"/></a>
                  <?php 
				    }else{?>
                  <img src="imagenes/activar_user_opaco.png" alt="activar" width="32" height="32" border="0" title="Activar Bodega"/>
                  <?php }?>
              </td>
              <td><?php 
			  		if($bodega->estado == 1){?>
                <a href="javascript:tarea_editar_usuario('desactivar')"><img src="imagenes/desactivar_user.png" alt="desactivar" width="32" height="32" border="0" title="Desactivar Bodega" /></a>
                <?php 
				    }else{?>
                <img src="imagenes/desactivar_user_opaco.png" alt="desactivar" width="32" height="32" border="0" title="Desactivar Bodega" />
                <?php }?></td>
                
                <td><?php 
			  		if($bodega->estado == 1){?>
                  <a href="javascript:valproveedor('id_bodega');"><img src="imagenes/cambiar_id_cliente.png" width="33" height="33" title="Cambiar el Nombre de la Bodega" border="0" /></a>
                  <?php 
				    }else{?>
                  <img src="imagenes/cambiar_id_cliente_opaco.png" width="33" height="33" title="Cambiar el Nombre de la Bodega" border="0" />
                  <?php }?></td>
                <td><a href="javascript:valproveedor('salir')" target="_parent"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center" valign="middle"><span class="style1">EDITAR BODEGA</span></td>
        </tr>
      </table>
      <table width="800" height="auto" border="0" cellspacing="0" cellpadding="8" style="background:url(imagenes/fondo_form_cliente.png) no-repeat;">
        <tr>
          <td align="center" id="tabla_cliente"><table width="800" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="819" align="center">&nbsp;</td>
              </tr>
            <tr>
              <td align="center"><div align="center">
                <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr align="center">
                        <td width="800" height="524" align="center" valign="top"><table width="700" border="0" align="center">
							  <tr>
								<td width="15" height="29%">&nbsp;</td>
								<td width="230" align="left"><div id="primernom">Nombre</div>
								  <div id="razonso" style="display:none; ">Razon Social</div> </td>
								<td width="10" align="left">&nbsp;</td>
								<td width="430" align="left">Tipo</td>
							  </tr>
							  <tr>
								<td height="39%" align="center">*</td>
								<td align="left"><input name="nombre" type="text" id="nombre1" size="25" class="campos_mayus" value="<?php echo $bodega->nombre; ?>" <?php if($bodega->estado=='2'){echo 'disabled';} ?> readonly="true" style="background-color:#CCCCCC;" onkeypress="javascript:return Letras(event)" /></td>
								<td align="left">&nbsp;</td>
								<td align="left"><select name="tipo" id="tipo" style="height: 25px; width: 150px;" class="campos_mayus" <?php if($bodega->estado=='2'){echo 'disabled';} ?>>
                                  <option value="LOCAL" <?php if($bodega->tipo == 'LOCAL'){ echo 'selected'; } ?>>LOCAL</option>
								  <option value="SUCURSAL" <?php if($bodega->tipo == 'SUCURSAL'){ echo 'selected'; } ?>>SUCURSAL</option>
							    </select></td>
							  </tr>
							</table>
                          <table width="700" border="0" align="center">
							  <tr>
								<td width="15" height="29%">&nbsp;</td>
								<td width="227" align="left">Pais
							    <input name="tarea" type="hidden" id="tarea" /></td>
								<td width="10">&nbsp;</td>
								<td width="207" align="left">Departamento</td>
								<td width="10">&nbsp;</td>
								<td width="205" align="left">Municipio</td>
							  </tr>
							  <tr>
								<td height="39%" align="center">&nbsp;</td>
								<td align="left">
								<div id="detalles1">
							  <div align="left">
							  <select name="pais" id="pais" style="height: 25px; width: 150px;" class="campos_mayus" onchange="mostrarDepartamentos(this.value)" onBlur="mostrarMunicipios(this.value)"  <?php if($bodega->estado=='2'){echo 'disabled';} ?>>
								<?php 
										for($i=0;$i<sizeof($paises);$i+=2) {
										if($bodega->pais == $paises[$i]){
											echo "<option selected=\"selected\" value=\"".$paises[$i]."\">".$paises[$i+1]."</option>\n";
										}else{
											echo "<option value=\"".$paises[$i]."\">".$paises[$i+1]."</option>\n";
										}
									}
									$pais = $bodega->pais;
									
								
								?>
								</select>
								</div>
							</div>
								</td>
								<td align="center">&nbsp;</td>
								<td align="left">
								<div id="departamentos">
								<select name="departamento" id="departamento" style="height: 25px; width: 150px;" class="campos_mayus" onChange="mostrarMunicipios(this.value)" <?php if($bodega->estado=='2'){echo 'disabled';} ?> >
									<?php 
									$deptos = $dpto->getDeptos($pais);
									if(sizeof($deptos) == 0){
										echo "<option value=\"NA01\">NA</option>\n";
									}else{
										for($i=0;$i<=sizeof($deptos);$i+=2) {
											if($bodega->departamento == $deptos[$i]){
												echo "<option selected=\"selected\" value=\"".$deptos[$i]."\">".$deptos[$i+1]."</option>\n";
											}else{
												echo "<option value=\"".$deptos[$i]."\">".$deptos[$i+1]."</option>\n";
											}
										}
									  }
									$depto = $bodega->departamento;
									?>
								</select>
								</div>
								</td>
								<td align="center">&nbsp;</td>
								<td align="left">
								<div id="municipios">
								<select name="municipio" id="municipio" style="height: 25px; width: 150px;" class="campos_mayus" <?php if($bodega->estado=='2'){echo 'disabled';} ?>>
								<?php 
									$municipios = $municipio->getMpios($depto);
									if(sizeof($municipios) == 0){
										echo "<option value=\"NA01\">NA</option>\n";
									}else{
										for($i=0;$i<=sizeof($municipios);$i+=2) {
											if($bodega->municipio == $municipios[$i]){
												echo "<option selected=\"selected\" value=\"".$municipios[$i]."\">".$municipios[$i+1]."</option>\n";
											}else{
												echo "<option value=\"".$municipios[$i]."\">".$municipios[$i+1]."</option>\n";
											}
										}
									}
								?>
								</select>
								</div>
								</td>
							  </tr>
							</table>                                                                                                                                                                                                                                                                                            
							<table width="700" border="0" align="center">
                              <tr>
                                <td width="15" height="29%">&nbsp;</td>
                                <td width="228" align="left">Barrio</td>
                                <td width="10" align="left">&nbsp;</td>
                                <td width="429" align="left">Direccion</td>
                              </tr>
                              <tr>
                                <td height="39%" align="center">&nbsp;</td>
                                <td align="left"><input name="barrio" type="text" id="barrio" size="25" class="campos_mayus" value="<?php echo $bodega->barrio; ?>" <?php if($bodega->estado=='2'){echo 'disabled';} ?> onkeypress="javascript:return Letras(event)"/></td>
                                <td align="left">*</td>
                                <td align="left"><input name="direccion" type="text" id="direccion" size="40" class="campos_mayus" value="<?php echo $bodega->direccion; ?>" <?php if($bodega->estado=='2'){echo 'disabled';} ?>/></td>
                              </tr>
                            </table>
							<table width="700" border="0" align="center">
                              <tr>
                                <td width="11" height="29%">&nbsp;</td>
                                <td width="185" align="left">Observaciones</td>
                                <td width="9" align="left">&nbsp;</td>
                                <td width="341" align="left">&nbsp;</td>
                              </tr>
                              <tr>
                                <td height="39%" align="center">&nbsp;</td>
                                <td colspan="3" align="left"><textarea name="observaciones" cols="80" rows="5" id="observaciones" class="campos_mayus" <?php if($bodega->estado=='2'){echo 'disabled';} ?>><?php echo $bodega->observaciones; ?></textarea></td>
                              </tr>
                              <tr>
                                <td height="39%" align="center">&nbsp;</td>
                                <td colspan="3" align="left"><input type="button" name="contacto" value="Contactos" onclick="valbodega('contactos');" <?php if($bodega->estado=='2'){echo 'disabled';} ?> /></td>
                              </tr>
                              <tr align="center">
                                <td height="39%">&nbsp;</td>
                                <td colspan="3">
								<?php if(!empty($ver_contactos) && $ver_contactos == '1'){ ?>							    <table width="601" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td colspan="6" align="center"><strong>CONTACTOS</strong></td>
                                    </tr>
                                  <tr>
                                    <td width="172" align="center">                                        <input name="id" type="hidden" id="id"/></td>
                                    <td width="135">&nbsp;</td>
                                    <td width="85" align="center" valign="middle">&nbsp;</td>
                                    <td width="80" align="center" valign="middle">&nbsp;</td>
                                  </tr>
                                  <tr align="center">
                                    <td width="172" bgcolor="#CCCCCC">Nombre</td>
                                    <td width="135" bgcolor="#CCCCCC">Cargo </td>
                                    <td width="85" valign="middle" bgcolor="#CCCCCC">Tel&eacute;fono</td>
                                    <td width="80" valign="middle" bgcolor="#CCCCCC">Email</td>
                                  </tr>
                                  <?php
										  
											for ($i=0; $i<count($respu); $i++){
												$contacto = $respu[$i];
											?>
                                  <tr align="left" class="TablaUsuarios">
                                    <td width="172"><?php echo $contacto->nombre; ?></td>
                                    <td width="135"><?php echo $contacto->cargo; ?></td>
                                    <td width="85" align="center" valign="middle"><?php echo $contacto->telefono; ?></td>
                                    <td width="80" align="center" valign="middle"><?php echo $contacto->email; ?></td>
                                  </tr>
                                  <?php } 
										}else{
											echo 'no hay contactos';
										}?>
                                </table></td>
                              </tr>
                            </table>
						  </td>
                      </tr>
                  </table>
              </div></td>
              </tr>
          </table></td>
        </tr>
      </table>
        </form>
		
		<script type="text/javascript">
			document.form1.tipo_doc.focus();
		</script>
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
