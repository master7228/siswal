<?php
 session_start();
	include_once 'Proveedor.php';
	include_once 'ContactoProveedor.php';
	include_once 'Pais.php';
	include_once 'Usuario.php';
	include_once 'Departamento.php';
	include_once 'Municipio.php';
	include_once 'Registro.php';
	include_once 'Documento.php';
	if ($_SESSION["autenticado"] == "1") {
		$fecha = date('Y-m-d H:i');
		$proveedor=unserialize($_SESSION['proveedor']);
		$pais = new Pais('','','');
		$paises = $pais->getPaises();
		if(!isset($_SESSION['var'])){
			$documento = new Documento('',$proveedor->tipo_documento,'');
			$documentos = $documento->getDatosDocumento();
			$_SESSION['tipo_doc']=$documento->descripcion;
		}
		$dpto= new Departamento('','','','');
		$municipio= new Municipio('','','','');
		$vendedor = new Usuario('','','','','','','','','','','','','');
		$consulta = $vendedor->buscarUsuario('id_grupo_usuarios','2');
		$contacto = new ContactoProveedor('','','','','','','','','','','','','','');
		$respu = $contacto->buscarContacto($proveedor->id);
		$_SESSION['contactos']= serialize($respu);
		$ver_contactos=1;
		$_SESSION['cont']='2';
		
				
				if(!empty($_POST['tarea']) && $_POST['tarea']!='activar' && $_POST['tarea']!='salir'){
			//--Convertir Campos a Mayusculas--
					$str = $_POST['nombre1'];
					$str = strtoupper($str);
					$_POST['nombre1']=$str;
					if($proveedor->tipo_documento=='31'){
						$_POST['nombre2']='';
						$_POST['apellido1']='';
						$_POST['apellido1']='';
						$_POST['apellido2']='';
						$_POST['apellido2']='';
					}
					else{
						$str = $_POST['nombre2'];
						$str = strtoupper($str);
						$_POST['nombre2']=$str;
						$str = $_POST['apellido1'];
						$str = strtoupper($str);
						$_POST['apellido1']=$str;
						$str = $_POST['apellido2'];
						$str = strtoupper($str);
						$_POST['apellido2']=$str;
					}
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
						$proveedores = new Proveedor('',$_POST['tipo_doc'],$_POST['documento'], $_POST['dv'],$_POST['nombre1'],$_POST['nombre2'],$_POST['apellido1'],$_POST['apellido2'],$_POST['pais'],$_POST['departamento'],$_POST['direccion'],$_POST['municipio'],$_POST['barrio'],$_POST['telefono'],$_POST['email'],$_POST['observaciones'],$fecha,'1',$_POST['clase_regimen'],$_POST['retenedor'],$_POST['iva']);
							$editar = $proveedores->editarProveedor($proveedor->documento);
							if ($editar){
							$proveedor_cre = $proveedor->buscarProveedor('documento',$proveedor->documento);
							$prov_cre = $proveedor_cre[0];
							$registro= new Registro('',$_SESSION['id_usuario'],'EDITAR PROVEEDOR',$prov_cre->documento,$prov_cre->id,$fecha);
							$guardar_registro = $registro->guardarRegistro();
							echo "<script>alert ('El proveedor fue modificado con exito');</script>";
							$_SESSION['proveedor']=serialize($prov_cre);
							$_SESSION['var']='1';
							echo "<script>window.location.href='EditarProveedor.php';</script>";
						} else {
							echo "<script>alert ('No se pudo modificar el proveedor, por favor intenta de nuevo');</script>";
							/*echo "<script>window.location.href='CrearUsuario.php';</script>";*/
						}
				}
		
		
			}
				
				
	
		if(!empty($_POST['tarea']) && $_POST['tarea'] == 'contactosed'){
				$proveedor = new Proveedor('',$_POST['tipo_doc'],$_POST['documento'], $_POST['dv'],$_POST['nombre1'],$_POST['nombre2'],$_POST['apellido1'],$_POST['apellido2'],$_POST['pais'],$_POST['departamento'],$_POST['direccion'],$_POST['municipio'],$_POST['barrio'],$_POST['telefono'],$_POST['email'],$_POST['observaciones'],$fecha,'1',$_POST['clase_regimen'],$_POST['retenedor'],$_POST['iva']);
				$editar = $proveedor->editarProveedor($proveedor->documento);
				if($editar){
					$proveedor_cre = $proveedor->buscarProveedor('documento',$proveedor->documento);
					$prov_cre = $proveedor_cre[0];
					$_SESSION['proveedor']=serialize($prov_cre);
					$_SESSION['funcion']='0';
					$_SESSION['var']='1';
					echo "<script>window.location.href='EditarContactosProveedor.php';</script>";
				}else{
					echo "<script>alert ('No se pudo modificar el proveedor, por favor intenta de nuevo');</script>";
				}
		}
			
		if(!empty($_POST['tarea']) && $_POST['tarea'] == 'id_proveedor'){
				$proveedor =new Proveedor('',$_POST['tipo_doc'],$_POST['documento'], $_POST['dv'],$_POST['nombre1'],$_POST['nombre2'],$_POST['apellido1'],$_POST['apellido2'],$_POST['pais'],$_POST['departamento'],$_POST['direccion'],$_POST['municipio'],$_POST['barrio'],$_POST['telefono'],$_POST['email'],$_POST['observaciones'],$fecha,'1',$_POST['clase_regimen'],$_POST['retenedor'],$_POST['iva']);
				$_SESSION['proveedor']=serialize($proveedor);
				echo "<script>window.location.href='CambiarIdProveedor.php';</script>";
			}
			
		if(!empty($_POST['tarea']) and $_POST['tarea']=='activar'){
			$est_proveedor= new Proveedor("", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");
			$estado = $est_proveedor->activarDesactivarProveedor('1', $proveedor->documento);
			$proveedor->estado="1";
			if($estado){
				$proveedor_cre = $proveedor->buscarProveedor1('documento',$proveedor->documento);
				$prov_cre = $proveedor_cre[0];
				$registro= new Registro('',$_SESSION['id_usuario'],'ACTIVAR PROVEEDOR',$prov_cre->documento,$prov_cre->id,$fecha);
				$_SESSION['proveedor']=serialize($proveedor);
				echo "<script>alert('El proveedor ha sido activado correctamente');</script> ";
				echo '<script>window.location="EditarProveedor.php";</script>';
			}else{
				echo "<script>alert('El proveedor no pudo ser activado, intentelo nuevamente');</script> ";
				echo '<script>window.location="EditarProveedor.php";</script>';
			}
		}
		
		if(!empty($_POST['tarea']) and $_POST['tarea']=='desactivar'){
			$est_proveedor= new Proveedor("", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");
			$estado = $est_proveedor->activarDesactivarProveedor('2', $proveedor->documento);
			$proveedor->estado="2";
			if($estado){
				$proveedor_cre = $est_proveedor->buscarProveedor1('documento',$_POST['documento']);
				$prov_cre = $proveedor_cre[0];
				$registro= new Registro('',$_SESSION['id_usuario'],'DESACTIVAR PROVEEDOR',$prov_cre->documento,$prov_cre->id,$fecha);
				$_SESSION['proveedor']=serialize($proveedor);
				echo "<script>alert('El proveedor ha sido desactivado correctamente');</script> ";
			}else{
				echo "<script>alert('El proveedor no pudo ser desactivado, intentelo nuevamente');</script> ";
				echo '<script>window.location="EditarProveedor.php";</script>';
			}
		}
			
			if(!empty($_POST['tarea']) && $_POST['tarea'] == 'salir'){
				unset($_SESSION['usuario']);
				unset($_SESSION['tipo_doc']);
				unset ($_SESSION['var']);
				echo "<script>window.location.href='MenuProveedor.php';</script>";
			}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Editar Proveedor</title>
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

<body topmargin="0" onLoad="mostrarPaises(); mueveReloj(); valcamposclientedit();" onKeyDown = "showDown(window.event)">

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
              <td><a href="ValidarProveedor.php" target="_parent"><img src="imagenes/nuevo_user.png" alt="nuevo" width="32" height="32" border="0" title="Crear Proveedor"/></a></td>
              <td><?php 
			  		if($proveedor->estado == 1){?>
                  <a href="javascript:tarea_editar_proveedor('guardar')"><img src="imagenes/guardar.png" alt="guardar" width="32" height="32" border="0" title="Guardar Informaci&oacute;n" onClick="return validarEmail(email,'email' )"/></a>
                  <?php 
				    }else{?>
                  <img src="imagenes/guardar_opaco.png" alt="guardar" width="32" height="32" border="0" title="Guardar Informaci&oacute;n"/>
                  <?php }?>
              </td>
              <td><a href="BuscarProveedor.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Proveedor"/></a></td>
              <td><?php 
			  		if($proveedor->estado == 2){?>
                  <a href="javascript:tarea_editar_usuario('activar')"><img src="imagenes/activar_user.png" alt="activar" width="32" height="32" border="0" title="Activar Proveedor"/></a>
                  <?php 
				    }else{?>
                  <img src="imagenes/activar_user_opaco.png" alt="activar" width="32" height="32" border="0" title="Activar Proveedor"/>
                  <?php }?>
              </td>
              <td><?php 
			  		if($proveedor->estado == 1){?>
                <a href="javascript:tarea_editar_usuario('desactivar')"><img src="imagenes/desactivar_user.png" alt="desactivar" width="32" height="32" border="0" title="Desactivar Proveedor" /></a>
                <?php 
				    }else{?>
                <img src="imagenes/desactivar_user_opaco.png" alt="desactivar" width="32" height="32" border="0" title="Desactivar Proveedor" />
                <?php }?></td>
                <td><a href="javascript:valproveedor('salir')" target="_parent"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center" valign="middle"><span class="style1">EDITAR PROVEEDOR</span></td>
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
                        <td width="800" height="524" align="center" valign="top">                                              
							<div align="center">
								<table width="700" border="0" align="center">
								  <tr>
									<td width="15" height="29%">&nbsp;</td>
									<td width="226" align="left">Tipo Documento </td>
									<td width="10">&nbsp;</td>
									<td width="225" align="left">Documento</td>
									<td width="10">&nbsp;</td>
									<td width="191" align="left">&nbsp;</td>
								  </tr>
								  <tr>
									<td height="39%" align="center">*</td>
									<td align="left"><input name="tipo_doc" type="text" id="tipo_doc" style="background-color:#CCCCCC; " value="<?php echo $_SESSION['tipo_doc']; ?> " size="30" readonly="true" <?php if($proveedor->estado=='2'){echo 'disabled';} ?> />
								    <input type="hidden" name="tipoDoc" id="tipoDoc" value="<?php echo $proveedor->tipo_documento; ?>" /></td>
									<td align="center">*</td>
									<td align="left"><input name="documento" type="text" id="documento"  value="<?php echo $proveedor->documento; ?>" <?php if($proveedor->estado=='2'){echo 'disabled';} ?> readonly="true" style="background-color:#CCCCCC; " />
-							      	  <input name="dv" id="dv" type="text" size="2" readonly="true" value="<?php echo $proveedor->dv; ?>" style="background-color:#CCCCCC; "/></td>
									<td align="center">&nbsp;</td>
									<td align="left">&nbsp;</td>
								  </tr>
							  </table>
</div>                            
							<table width="700" border="0" align="center">
							  <tr>
								<td width="15" height="29%">&nbsp;</td>
								<td width="225" align="left"><div id="primernom">Primer Nombre</div><div id="razonso" style="display:none; ">Razon Social</div> </td>
								<td width="10" align="left">&nbsp;</td>
								<td width="432" align="left">Segundo Nombre </td>
							  </tr>
							  <tr>
								<td height="39%" align="center">*</td>
								<td align="left"><input name="nombre1" type="text" class="campos_mayus" id="nombre1" onkeypress="javascript:return Letras(event)" value="<?php echo $proveedor->nombre1; ?>" size="25" maxlength="40" <?php if($proveedor->estado=='2'){echo 'disabled';} ?> /></td>
								<td align="left">&nbsp;</td>
								<td align="left"><input name="nombre2" type="text" class="campos_mayus" id="nombre2" onkeypress="javascript:return Letras(event)" value="<?php echo $proveedor->nombre2; ?>" size="25" maxlength="40" <?php if($proveedor->estado=='2'|| $proveedor->tipo_documento=='31'){echo 'disabled';} ?>/>
							    <input name="tarea" type="hidden" id="tarea" /></td>
							  </tr>
							</table>
							<table width="700" border="0" align="center">
							  <tr>
								<td width="15" height="29%">&nbsp;</td>
								<td width="226" align="left">Primer Apellido</td>
								<td width="10" align="left">&nbsp;</td>
								<td width="431" align="left">Segundo Apellido </td>
							  </tr>
							  <tr>
								<td height="39%" align="center">*</td>
								<td align="left"><input name="apellido1" type="text" class="campos_mayus" id="apellido1"  onkeypress="javascript:return Letras(event)" value="<?php echo $proveedor->apellido1; ?>" size="25" maxlength="40" <?php if($proveedor->estado=='2'|| $proveedor->tipo_documento=='31'){echo 'disabled';} ?>/></td>
								<td align="left">*</td>
								<td align="left"><input name="apellido2" type="text" class="campos_mayus" id="apellido2" onkeypress="javascript:return Letras(event)" value="<?php echo $proveedor->apellido2; ?>" size="25" maxlength="40" <?php if($proveedor->estado=='2' || $proveedor->tipo_documento=='31'){echo 'disabled';} ?>/></td>
							  </tr>
							</table>                            
							<table width="700" border="0" align="center">
							  <tr>
								<td width="15" height="29%">&nbsp;</td>
								<td width="227" align="left">Pais</td>
								<td width="10">&nbsp;</td>
								<td width="207" align="left">Departamento</td>
								<td width="10">&nbsp;</td>
								<td width="205" align="left">Municipio</td>
							  </tr>
							  <tr>
								<td height="39%" align="center">*</td>
								<td align="left">
								<div id="detalles1">
							  <div align="left">
							  <select name="pais" id="pais" style="height: 25px; width: 150px;" class="campos_mayus" onchange="mostrarDepartamentos(this.value)" onBlur="mostrarMunicipios(this.value)"  <?php if($proveedor->estado=='2'){echo 'disabled';} ?>>
								<?php 
										for($i=0;$i<sizeof($paises);$i+=2) {
										if($proveedor->pais == $paises[$i]){
											echo "<option selected=\"selected\" value=\"".$paises[$i]."\">".$paises[$i+1]."</option>\n";
										}else{
											echo "<option value=\"".$paises[$i]."\">".$paises[$i+1]."</option>\n";
										}
									}
									$pais = $proveedor->pais;
									
								
								?>
								</select>
								</div>
							</div>
								</td>
								<td align="center">*</td>
								<td align="left">
								<div id="departamentos">
								<select name="departamento" id="departamento" style="height: 25px; width: 150px;" class="campos_mayus" onChange="mostrarMunicipios(this.value)" <?php if($proveedor->estado=='2'){echo 'disabled';} ?> >
									<?php 
									$deptos = $dpto->getDeptos($pais);
									if(sizeof($deptos) == 0){
										echo "<option value=\"NA01\">NA</option>\n";
									}else{
										for($i=0;$i<=sizeof($deptos);$i+=2) {
											if($proveedor->departamento == $deptos[$i]){
												echo "<option selected=\"selected\" value=\"".$deptos[$i]."\">".$deptos[$i+1]."</option>\n";
											}else{
												echo "<option value=\"".$deptos[$i]."\">".$deptos[$i+1]."</option>\n";
											}
										}
									  }
									$depto = $proveedor->departamento;
									?>
								</select>
								</div>
								</td>
								<td align="center">*</td>
								<td align="left">
								<div id="municipios">
								<select name="municipio" id="municipio" style="height: 25px; width: 150px;" class="campos_mayus" <?php if($proveedor->estado=='2'){echo 'disabled';} ?>>
								<?php 
									$municipios = $municipio->getMpios($depto);
									if(sizeof($municipios) == 0){
										echo "<option value=\"NA01\">NA</option>\n";
									}else{
										for($i=0;$i<=sizeof($municipios);$i+=2) {
											if($proveedor->municipio == $municipios[$i]){
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
                                <td height="39%" align="center">*</td>
                                <td align="left"><input name="barrio" type="text" class="campos_mayus" id="barrio" onkeypress="javascript:return Letras(event)" value="<?php echo $proveedor->barrio; ?>" size="25" maxlength="40" <?php if($proveedor->estado=='2'){echo 'disabled';} ?>/></td>
                                <td align="left">*</td>
                                <td align="left"><input name="direccion" type="text" class="campos_mayus" id="direccion" value="<?php echo $proveedor->direccion; ?>" size="40" maxlength="40" <?php if($proveedor->estado=='2'){echo 'disabled';} ?>/></td>
                              </tr>
                            </table>							
							<table width="700" border="0" align="center">
                              <tr>
                                <td width="15" height="29%">&nbsp;</td>
                                <td width="227" align="left">Telefono</td>
                                <td width="10" align="left">&nbsp;</td>
                                <td width="430" align="left">Email</td>
                              </tr>
                              <tr>
                                <td height="39%" align="center">*</td>
                                <td align="left"><input name="telefono" type="text" id="telefono" onkeypress="javascript:return Numeros(event)" value="<?php echo $proveedor->telefono; ?>" size="25" maxlength="15" <?php if($proveedor->estado=='2'){echo 'disabled';} ?>/></td>
                                <td align="left">&nbsp;</td>
                                <td align="left"><input name="email" type="text" id="email" value="<?php echo $proveedor->email; ?>" size="40" maxlength="30" <?php if($proveedor->estado=='2'){echo 'disabled';} ?>  /></td>
                              </tr>
                            </table>
                            <table width="703" border="0" align="center">
                              <tr>
                                <td width="15" height="29%">&nbsp;</td>
                                <td width="137" align="left">Regimen </td>
                                <td width="7">&nbsp;</td>
                                <td width="143" align="left">Retiene Fuente</td>
                                <td width="7">&nbsp;</td>
                                <td colspan="3" align="left">IVA</td>
                                <td width="118" align="left">&nbsp;</td>
                              </tr>
                              <tr>
                                <td height="39%" align="center">*</td>
                                <td align="left"><select name="clase_regimen" id="clase_regimen" onchange="valcampopro();" onFocus="valcampopro();">
									<option value=""></option>
                                  <option value="SIMPLIFICADO" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($proveedor->clase_regimen == 'SIMPLIFICADO'){ echo 'selected'; } } ?>>SIMPLIFICADO</option>
                                  <option value="COMUN" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($proveedor->clase_regimen == 'COMUN'){ echo 'selected'; } } ?>>COMUN</option>
                                </select></td>
                                <td align="center">*</td>
                                <td align="left"><select name="retenedor" id="retenedor" onchange="valcampopro();" onFocus="valcampopro();">
								<option value="" selected="selected"></option>
                                  <option value="SI" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($proveedor->retenedor == 'SI'){ echo 'selected'; } } ?>>SI</option>
                                  <option value="NO" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($proveedor->retenedor == 'NO'){ echo 'selected'; } } ?>>NO</option>
                                </select>
                                <input type="hidden" name="idfuente" id="idfuente"></td>
                                <td align="center">*</td>
                                <td width="55" align="left"><select name="iva" id="iva" onchange="valcampopro();" onFocus="valcampopro();">
								<option value="" selected="selected"></option>
                                  <option value="SI" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($proveedor->iva == 'SI'){ echo 'selected'; } } ?>>SI</option>
                                  <option value="NO" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($proveedor->iva == 'NO'){ echo 'selected'; } } ?>>NO</option>
                                </select></td>
                                <td width="47" align="left"><input type="hidden" name="id_gran_contribuyente" id="id_gran_contribuyente"></td>
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
                                <td colspan="3" align="left"><textarea name="observaciones" cols="80" rows="5" id="observaciones" class="campos_mayus" <?php if($proveedor->estado=='2'){echo 'disabled';} ?>><?php echo $proveedor->observaciones; ?></textarea></td>
                              </tr>
                              <tr>
                                <td height="39%" align="center">&nbsp;</td>
                                <td colspan="3" align="left"><input type="button" name="contacto" value="Contactos" onclick="valproveedor('contactosed');" <?php if($proveedor->estado=='2'){echo 'disabled';} ?> /></td>
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
                                    <td width="85" valign="middle" bgcolor="#CCCCCC">Telefono</td>
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
