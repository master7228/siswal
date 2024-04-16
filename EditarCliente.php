<?php
session_start();
	include_once 'Cliente.php';
	include_once 'ContactoCliente.php';
	include_once 'Pais.php';
	include_once 'Usuario.php';
	include_once 'Departamento.php';
	include_once 'Municipio.php';
	include_once 'Registro.php';
	include_once 'Documento.php';
	include_once 'Cupo.php';
	if ($_SESSION["autenticado"] == "1") {
		$fecha = date('Y-m-d H:i');
		$cliente=unserialize($_SESSION['cliente']);
		$cupo= new Cupo('','','');
		$cupos= $cupo->buscarCupo('*','');
		$pais = new Pais('','','');
		$paises = $pais->getPaises();
		if(!isset($_SESSION['var'])){
			$documento = new Documento('',$cliente->tipo_documento,'');
			$documentos = $documento->getDatosDocumento();
			$_SESSION['tipo_doc']=$documento->descripcion;
		}
		$dpto= new Departamento('','','','');
		$municipio= new Municipio('','','','');
		$vendedor = new Usuario('','','','','','','','','','','','','');
		$consulta = $vendedor->buscarUsuario('id_grupo_usuarios','2');
		$contacto = new ContactoCliente('','','','','','','','','','','');
		$respu = $contacto->buscarContacto($cliente->id);
		$_SESSION['contactos']= serialize($respu);
		$ver_contactos=1;
		$_SESSION['cont']='2';
				
				if(!empty($_POST['tarea']) && $_POST['tarea']!='activar' && $_POST['tarea']!='salir'){
				//--Convertir Campos a Mayusculas--
					$str = $_POST['nombre1'];
					$str = strtoupper($str);
					$_POST['nombre1']=$str;
					if($cliente->tipo_documento=='31'){
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
					$str = $_POST['nombre_representante'];					
					$str = strtoupper($str);
					$_POST['nombre_representante']=$str;
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
			
					if ($_POST['tarea'] == 'guardar'){
						$clientes = new Cliente('',$_POST['tipo_doc'],$_POST['documento'], $_POST['dv'], $_POST['cupo'],$_POST['nombre1'],$_POST['nombre2'],$_POST['apellido1'],$_POST['apellido2'],$_POST['nombre_representante'],$_POST['doc_representante'],$_POST['descuento'],$_POST['forma_pago'],$_POST['pais'],$_POST['departamento'],$_POST['municipio'],$_POST['barrio'],$_POST['direccion'],$_POST['telefono'],$_POST['email'],$_POST['observaciones'],$_POST['regimen'],$_POST['fuente'],$_POST['gran_contribuyente'],$_POST['ret_ica'],$_POST['id_vendedor'],'','1');
						$editar = $clientes->editarCliente($clientes->documento);
						if ($editar){
							$cliente_cre = $clientes->buscarCliente1('documento',$clientes->documento);
							$clientes = $cliente_cre[0];
							$registro= new Registro('',$_SESSION['id_usuario'],'EDITAR CLIENTE',$cliente->documento,$cliente->id,$fecha);
							$guardar_registro = $registro->guardarRegistro();
							echo "<script>alert ('El Cliente fue modificado con exito');</script>";
							$_SESSION['cliente']=serialize($clientes);
							$_SESSION['var']='1';
							echo "<script>window.location.href='EditarCliente.php';</script>";
						} else {
							echo "<script>alert ('No se pudo modificar el cliente, por favor intenta de nuevo');</script>";
						}
				}
		
		
			}
				
				
	
		if(!empty($_POST['tarea']) && $_POST['tarea'] == 'contactosed'){
				$cliente = new Cliente('',$_POST['tipo_doc'],$_POST['documento'], $_POST['dv'], $_POST['cupo'],$_POST['nombre1'],$_POST['nombre2'],$_POST['apellido1'],$_POST['apellido2'],$_POST['nombre_representante'],$_POST['doc_representante'],$_POST['descuento'],$_POST['forma_pago'],$_POST['pais'],$_POST['departamento'],$_POST['municipio'],$_POST['barrio'],$_POST['direccion'],$_POST['telefono'],$_POST['email'],$_POST['observaciones'],$_POST['regimen'],$_POST['fuente'],$_POST['gran_contribuyente'],$_POST['ret_ica'],$_POST['id_vendedor'],$fecha,'1');
				$editar = $cliente->editarCliente($_POST['documento']);
				if ($editar){
					$cliente_cre = $cliente->buscarCliente('documento',$_POST['documento']);
					$cliente = $cliente_cre[0];
					$_SESSION['cliente']=serialize($cliente);
					$_SESSION['funcion']='0';
					echo "<script>window.location.href='EditarContactosCliente.php';</script>";
				}
			}
			
		if(!empty($_POST['tarea']) && $_POST['tarea'] == 'id_cliente'){
				$cliente = new Cliente('',$_POST['tipo_doc'],$_POST['documento'], $_POST['dv'], $_POST['cupo'],$_POST['nombre1'],$_POST['nombre2'],$_POST['apellido1'],$_POST['apellido2'],$_POST['nombre_representante'],$_POST['doc_representante'],$_POST['descuento'],$_POST['forma_pago'],$_POST['pais'],$_POST['departamento'],$_POST['municipio'],$_POST['barrio'],$_POST['direccion'],$_POST['telefono'],$_POST['email'],$_POST['observaciones'],$_POST['regimen'],$_POST['fuente'],$_POST['gran_contribuyente'],$_POST['ret_ica'],$_POST['id_vendedor'],$fecha,'1');
				$_SESSION['cliente']=serialize($cliente);
				echo "<script>window.location.href='CambiarIdCliente.php';</script>";
			}
			
		if(!empty($_POST['tarea']) and $_POST['tarea']=='activar'){
			$est_cliente= new Cliente("", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "","","");
			$estado = $est_cliente->activarDesactivarCliente('1', $cliente->documento);
			$cliente->estado="1";
			if($estado){
				$cliente_cre = $cliente->buscarCliente1('documento',$cliente->documento);
				$clien_cre = $cliente_cre[0];
				$registro= new Registro('',$_SESSION['id_usuario'],'ACTIVAR CLIENTE',$clien_cre->documento,$clien_cre->id,$fecha);
				$_SESSION['cliente']=serialize($cliente);
				echo "<script>alert('El Cliente ha sido activado correctamente');</script> ";
				echo '<script>window.location="EditarCliente.php";</script>';
			}else{
				echo "<script>alert('El Cliente no pudo ser activado, intentelo nuevamente');</script> ";
				echo '<script>window.location="EditarCliente.php";</script>';
			}
		}
		
		if(!empty($_POST['tarea']) and $_POST['tarea']=='desactivar'){
			$est_cliente= new Cliente("", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "","","");
			$estado = $est_cliente->activarDesactivarCliente('2', $cliente->documento);
			$cliente->estado="2";
			if($estado){
				$cliente_cre = $est_cliente->buscarCliente1('documento',$_POST['documento']);
				$clien_cre = $cliente_cre[0];
				$registro= new Registro('',$_SESSION['id_usuario'],'DESACTIVAR CLIENTE',$clien_cre->documento,$clien_cre->id,$fecha);
				$_SESSION['cliente']=serialize($cliente);
				echo "<script>alert('El Cliente ha sido desactivado correctamente');</script> ";
				/*echo '<script>window.location="EditarCliente.php";</script>';*/
			}else{
				echo "<script>alert('El Cliente no pudo ser desactivado, intentelo nuevamente');</script> ";
				echo '<script>window.location="EditarCliente.php";</script>';
			}
		}
			
			if(!empty($_POST['tarea']) && $_POST['tarea'] == 'salir'){
				unset($_SESSION['tipo_doc']);
				unset ($_SESSION['var']);
				echo "<script>window.location.href='MenuCliente.php';</script>";
			}
			if(!empty($_POST['tarea']) && $_POST['tarea'] == 'nuevo'){
				unset($_SESSION['tipo_doc']);
				unset ($_SESSION['var']);
				unset($_SESSION['cliente']);
				unset($_SESSION['contactos']);
				echo "<script>window.location.href='ValidarCliente.php';</script>";
			}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Editar Cliente</title>
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
              <td><a href="javascript:valcliente('nuevo');"><img src="imagenes/nuevo_user.png" alt="nuevo" width="32" height="32" border="0" title="Crear Cliente"/></a></td>
              <td><?php 
			  		if($cliente->estado == 1){?>
                  <a href="javascript:tarea_editar_cliente('guardar')"><img src="imagenes/guardar.png" alt="guardar" width="32" height="32" border="0" title="Guardar Informaci&oacute;n"/></a>
                  <?php 
				    }else{?>
                  <img src="imagenes/guardar_opaco.png" alt="guardar" width="32" height="32" border="0" title="Guardar Informaci&oacute;n"/>
                  <?php }?>
              </td>
              <td><a href="BuscarCliente.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Cliente"/></a></td>
              <td><?php 
			  		if($cliente->estado == 2){?>
                  <a href="javascript:tarea_editar_usuario('activar')"><img src="imagenes/activar_user.png" alt="activar" width="32" height="32" border="0" title="Activar Cliente"/></a>
                  <?php 
				    }else{?>
                  <img src="imagenes/activar_user_opaco.png" alt="activar" width="32" height="32" border="0" title="Activar Cliente"/>
                  <?php }?>
              </td>
              <td><?php 
			  		if($cliente->estado == 1){?>
                <a href="javascript:tarea_editar_usuario('desactivar')"><img src="imagenes/desactivar_user.png" alt="desactivar" width="32" height="32" border="0" title="Desactivar Usuario" /></a>
                <?php 
				    }else{?>
                <img src="imagenes/desactivar_user_opaco.png" alt="desactivar" width="32" height="32" border="0" title="Desactivar Usuario" />
                <?php }?></td>
                 <td><a href="javascript:valcliente('salir');"><img src="imagenes/flecha.png" width="32" height="32" border="0" title="Salir" /></a></td>
          </table></td>
        </tr>
        <tr>
          <td align="center" valign="middle"><span class="style1">EDITAR CLIENTE </span></td>
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
									<td width="12" height="29%">&nbsp;</td>
									<td width="213" align="left">Tipo Documento </td>
									<td width="9">&nbsp;</td>
									<td width="251" align="left">Documento</td>
									<td width="10">&nbsp;</td>
									<td width="186" align="left"><strong>Fecha de Creaci&oacute;n</strong></td>
								  </tr>
								  <tr>
									<td height="39%" align="center">*</td>
									<td align="left"><input name="tipo_doc" type="text" id="tipo_doc" style="background-color:#CCCCCC; " value="<?php echo $_SESSION['tipo_doc']; ?> " size="30" readonly="true" <?php if($cliente->estado=='2'){echo 'disabled';} ?> />
								    <input type="hidden" name="tipoDoc" id="tipoDoc" value="<?php echo $cliente->tipo_documento; ?>"/></td>
									<td align="center">*</td>
									<td align="left"><input name="documento" type="text" id="documento"  value="<?php echo $cliente->documento; ?> " <?php if($cliente->estado=='2'){echo 'disabled';} ?> readonly="true" style="background-color:#CCCCCC; " />
-							      	  <input name="dv" id="dv" type="text" size="2" readonly="true" value="<?php echo $cliente->dv; ?>" style="background-color:#CCCCCC; "/></td>
									<td align="center">&nbsp;</td>
									<td align="left"><strong><?php echo $cliente->fecha_creacion; ?></strong></td>
								  </tr>
							  </table>
</div>                            
							<table width="700" border="0" align="center">
							  <tr>
								<td width="15" height="29%">&nbsp;</td>
								<td width="225" align="left"><div id="primernom">Primer Nombre</div><div id="razonso" style="display:none; ">Razon Social</div> </td>
								<td width="10" align="left">&nbsp;</td>
								<td align="left">Segundo Nombre </td>
								<td align="left">Cupo</td>
							  </tr>
							  <tr>
								<td height="39%" align="center">*</td>
								<td align="left"><input name="nombre1" type="text" class="campos_mayus" id="nombre1" onkeypress="javascript:return Letras(event)" value="<?php echo $cliente->nombre1; ?>" size="25" maxlength="20" <?php if($cliente->estado=='2'){echo 'disabled';} ?>/></td>
								<td align="left">&nbsp;</td>
								<td width="211" align="left"><input name="nombre2" type="text" class="campos_mayus" id="nombre2" onkeypress="javascript:return Letras(event)" value="<?php echo $cliente->nombre2; ?>" size="25" maxlength="50" <?php if($cliente->estado=='2' || $cliente->tipo_documento=='31'){echo 'disabled';} ?>/>
							    <input name="tarea" type="hidden" id="tarea" /></td>
								<td width="217" align="left"><select name="cupo" id="cupo"  <?php if($cliente->estado=='2'){echo 'disabled';} ?> class="campos_mayus">
								  <?php for($i=0; $i<=sizeof($cupos); $i++){
												$resp2=$cupos[$i];
												if($cliente->cupo == $resp2->valor ){
													echo "<option value=\"".$resp2->valor."\" selected>".$resp2->valor."</option>\n";
												}else{
													echo "<option value=\"".$resp2->valor."\">".$resp2->valor."</option>\n";
												}
								   } ?>
							    </select></td>
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
								<td align="left"><input name="apellido1" type="text" class="campos_mayus" id="apellido1"  onkeypress="javascript:return Letras(event)" value="<?php echo $cliente->apellido1; ?>" size="25" maxlength="20" <?php if($cliente->estado=='2' || $cliente->tipo_documento=='31'){echo 'disabled';} ?>/></td>
								<td align="left">&nbsp;</td>
								<td align="left"><input name="apellido2" type="text" class="campos_mayus" id="apellido2" onkeypress="javascript:return Letras(event)" value="<?php echo $cliente->apellido2; ?>" size="25" maxlength="20" <?php if($cliente->estado=='2' || $cliente->tipo_documento=='31'){echo 'disabled';} ?>/></td>
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
							  <select name="pais" id="pais" style="height: 25px; width: 150px;" class="campos_mayus" onchange="mostrarDepartamentos(this.value)" onBlur="mostrarMunicipios(this.value)"  <?php if($cliente->estado=='2'){echo 'disabled';} ?>>
								<?php 
										for($i=0;$i<sizeof($paises);$i+=2) {
										if($cliente->pais == $paises[$i]){
											echo "<option selected=\"selected\" value=\"".$paises[$i]."\">".$paises[$i+1]."</option>\n";
										}else{
											echo "<option value=\"".$paises[$i]."\">".$paises[$i+1]."</option>\n";
										}
									}
									$pais = $cliente->pais;
									
								
								?>
								</select>
								</div>
							</div>
								</td>
								<td align="center">*</td>
								<td align="left">
								<div id="departamentos">
								<select name="departamento" id="departamento" style="height: 25px; width: 150px;" class="campos_mayus" onChange="mostrarMunicipios(this.value)" <?php if($cliente->estado=='2'){echo 'disabled';} ?> >
									<?php 
									$deptos = $dpto->getDeptos($pais);
									if(sizeof($deptos) == 0){
										echo "<option value=\"NA01\">NA</option>\n";
									}else{
										for($i=0;$i<=sizeof($deptos);$i+=2) {
											if($cliente->departamento == $deptos[$i]){
												echo "<option selected=\"selected\" value=\"".$deptos[$i]."\">".$deptos[$i+1]."</option>\n";
											}else{
												echo "<option value=\"".$deptos[$i]."\">".$deptos[$i+1]."</option>\n";
											}
										}
									  }
									$depto = $cliente->departamento;
									?>
								</select>
								</div>
								</td>
								<td align="center">*</td>
								<td align="left">
								<div id="municipios">
								<select name="municipio" id="municipio" style="height: 25px; width: 150px;" class="campos_mayus" <?php if($cliente->estado=='2'){echo 'disabled';} ?>>
								<?php 
									$municipios = $municipio->getMpios($depto);
									if(sizeof($municipios) == 0){
										echo "<option value=\"NA01\">NA</option>\n";
									}else{
										for($i=0;$i<=sizeof($municipios);$i+=2) {
											if($cliente->municipio == $municipios[$i]){
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
                                <td align="left"><input name="barrio" type="text" class="campos_mayus" id="barrio" onkeypress="javascript:return Letras(event)" value="<?php echo $cliente->barrio; ?>" size="25" maxlength="20" <?php if($cliente->estado=='2'){echo 'disabled';} ?>/></td>
                                <td align="left">&nbsp;</td>
                                <td align="left"><input name="direccion" type="text" class="campos_mayus" id="direccion" value="<?php echo $cliente->direccion; ?>" size="40" maxlength="25" <?php if($cliente->estado=='2'){echo 'disabled';} ?>/></td>
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
                                <td align="left"><input name="telefono" type="text" id="telefono" onkeypress="javascript:return Numeros(event)" value="<?php echo $cliente->telefono; ?>" size="25" maxlength="15" <?php if($cliente->estado=='2'){echo 'disabled';} ?>/></td>
                                <td align="left">&nbsp;</td>
                                <td align="left"><input name="email" type="text" id="email" value="<?php echo $cliente->email; ?>" size="40" maxlength="25" <?php if($cliente->estado=='2'){echo 'disabled';} ?>  /></td>
                              </tr>
                            </table>							
							<table width="700" border="0" align="center">
							  <tr>
							    <td width="12" height="29%">&nbsp;</td>
							    <td width="246" align="left">Descuento</td>
							    <td width="5" align="left">&nbsp;</td>
							    <td width="337" align="left">Forma de Pago</td>
						      </tr>
							  <tr>
							    <td height="39%" align="center">&nbsp;</td>
							    <td align="left"><input name="descuento" type="text" id="descuento"  value="<?php echo $cliente->descuento; ?>" size="25" maxlength="5" <?php if($cliente->estado=='2'){echo 'disabled';} ?> onkeypress="javascript:return Numeros(event)"/></td>
							    <td align="left">&nbsp;</td>
							    <td align="left"><select name="forma_pago" id="forma_pago" <?php if($cliente->estado=='2'){echo 'disabled';} ?>>
							      <option></option>
							      <option value="CONTADO" <?php if($cliente->forma_pago == 'CONTADO'){ echo 'selected';  } ?>>CONTADO</option>
                                  <option value="15 DIAS" <?php if($cliente->forma_pago == '15 DIAS'){ echo 'selected';  }  ?>>15 DIAS</option>
                                  <option value="30 DIAS" <?php if($cliente->forma_pago == '30 DIAS'){ echo 'selected';  } ?>>30 DIAS</option>
							      </select></td>
						      </tr>
						    </table>
							<table width="700" border="0" align="center">
							  <tr>
							    <td width="12" height="29%">&nbsp;</td>
							    <td width="246" align="left">Nombre Representante Legal</td>
							    <td width="5" align="left">&nbsp;</td>
							    <td width="337" align="left">Documento Representante Legal</td>
						      </tr>
							  <tr>
							    <td height="39%" align="center">&nbsp;</td>
							    <td align="left"><input name="nombre_representante" type="text" class="campos_mayus" id="nombre_representante" onkeypress="javascript:return Letras(event)" value="<?php echo $cliente->nombre_representante; ?>" size="40" maxlength="50"  <?php if($cliente->estado=='2'){echo 'disabled';} ?>/></td>
							    <td align="left">&nbsp;</td>
							    <td align="left"><input name="doc_representante" type="text" class="campos_mayus" id="doc_representante" onkeypress="javascript:return Numeros(event)" value="<?php echo $cliente->doc_representante; ?>" size="40" maxlength="15"  <?php if($cliente->estado=='2'){echo 'disabled';} ?>/></td>
						      </tr>
						    </table>
							<table width="703" border="0" align="center">
                              <tr>
                                <td width="17" height="29%">&nbsp;</td>
                                <td width="139" align="left">Regimen </td>
                                <td width="6">&nbsp;</td>
                                <td width="146" align="left">Retiene Fuente</td>
                                <td width="6">&nbsp;</td>
                                <td colspan="2" align="left">Gran Contribuyente</td>
                                <td width="116" align="left">Retiene Ica</td>
                                <td width="126" align="left">Vendedor</td>
                              </tr>
                              <tr>
                                <td height="39%" align="center">*</td>
                                <td align="left"><select name="regimen" onchange="valcampoclie();" onFocus="valcampoclie();" id="regimen" <?php if($cliente->estado=='2'){echo 'disabled';} ?>>
									<option value=""></option>
                                  <option value="SIMPLIFICADO" onchange="valcampoclie();" onFocus="valcampoclie();" <?php if($cliente->clase_regimen == 'SIMPLIFICADO'){ echo 'selected'; }  ?>>SIMPLIFICADO</option>
                                  <option value="COMUN" <?php if($cliente->clase_regimen == 'COMUN'){ echo 'selected'; }  ?>>COMUN</option>
                                </select></td>
                                <td align="center">*</td>
                                <td align="left"><select name="fuente" id="fuente" onchange="valcampoclie();" onFocus="valcampoclie();" <?php if(($cliente->estado=='2')){echo 'disabled';} ?>>
								<option value=""></option>
                                  <option value="SI" <?php  if($cliente->retiene_fuente == 'SI'){ echo 'selected'; }  ?>>SI</option>
                                  <option value="NO" <?php if($cliente->retiene_fuente == 'NO'){ echo 'selected'; }  ?>>NO</option>
                                </select>
                                <input type="hidden" name="idfuente" id="idfuente" /></td>
                                <td align="center">*</td>
                                <td width="55" align="left"><select name="gran_contribuyente" id="gran_contribuyente" onchange="valcampoclie();" onFocus="valcampoclie();" <?php if(($cliente->estado=='2')){echo 'disabled';} ?>>
								<option value=""></option>
                                  <option value="SI" <?php  if($cliente->gran_contribuyente == 'SI'){ echo 'selected'; }  ?>>SI</option>
                                  <option value="NO" <?php if($cliente->gran_contribuyente == 'NO'){ echo 'selected'; }  ?>>NO</option>
                                </select></td>
                                <td width="54" align="left"><input type="hidden" name="id_gran_contribuyente" id="id_gran_contribuyente" /></td>
                                <td align="left"><select name="ret_ica" onchange="valcampoclie();" onFocus="valcampoclie();" <?php if(($cliente->estado=='2')){echo 'disabled';} ?> id="ret_ica">
                                  <option value=""></option>
                                  <option value="SI" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($cliente->retiene_ica == 'SI'){ echo 'selected'; } } ?>>SI</option>
                                  <option value="NO" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($cliente->retiene_ica == 'NO'){ echo 'selected'; } } ?>>NO</option>
                                </select>
                                <input type="hidden" name="id_ret_ica" id="id_ret_ica" /></td>
                                <td align="left"><select name="id_vendedor" id="id_vendedor" <?php if($cliente->estado=='2'){echo 'disabled';} ?> class="campos_mayus">
								   <?php for($i=0; $i<=sizeof($consulta); $i++){
								   		$resp3=$consulta[$i];
										if($resp3->documento_identidad==$cliente->vendedor){
											echo "<option value=\"".$resp3->documento_identidad."\" selected>".$resp3->nombres."</option>\n";
										}
										else{
											echo "<option value=\"".$resp3->documento_identidad."\">".$resp3->nombres."</option>\n";
										}
								   
								   } ?>
										
                                </select></td>
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
                                <td colspan="3" align="left"><textarea name="observaciones" cols="80" rows="5" id="observaciones" class="campos_mayus" <?php if($cliente->estado=='2'){echo 'disabled';} ?>><?php echo $cliente->observaciones; ?></textarea></td>
                              </tr>
                              <tr>
                                <td height="39%" align="center">&nbsp;</td>
                                <td colspan="3" align="left"><input type="button" name="contacto" value="Contactos" onclick="valcliente('contactosed');" <?php if($cliente->estado=='2'){echo 'disabled';} ?> /></td>
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
