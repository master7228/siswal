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
include_once 'Vendedor.php';

if (!empty($_SESSION["autenticado"]) && $_SESSION["autenticado"] == "1") {
    $fecha = date('Y-m-d H:i');
	$pais = new Pais('','','');
	$paises = $pais->getPaises();
	$documento = new Documento('','','');
	$documentos = $documento->getDocumentos();
	$vendedor = new Vendedor('','','','','','','');
	$vendedores = $vendedor->getVendedores();
	$dpto= new Departamento('','','','');
	$municipio= new Municipio('','','','');
	$cupo= new Cupo('','','');
	$cupos= $cupo->buscarCupo('estado','1');
	$vendedor = new Usuario('','','','','','','','','','','','','');
	$consulta = $vendedor->buscarUsuario('id_grupo_usuarios','2');
	$gc='2';
	if(!empty($_SESSION['gcont'])){
		if($_SESSION['gcont']=='1'){
			$cliente=unserialize($_SESSION['cliente']);
			$contacto = new ContactoCliente('','','','','','','','','','','');
			$resp = $contacto->buscarContacto($cliente->id);
			$ver_contactos=1;
			$gc='1';
			$_SESSION['cont']='2';
		}else{	
			$ver_contactos=0;
			if(!empty($_POST['tarea'])){
			//--Convertir Campos a Mayusculas--
				$str = $_POST['nombre1'];
				$str = strtoupper($str);
				$_POST['nombre1']=$str;
				if($_POST['tipo_doc']=='13'){
					$str = $_POST['nombre2'];
					$str = strtoupper($str);
					$_POST['nombre2']=$str;
					$str = $_POST['apellido1'];
					$str = strtoupper($str);
					$_POST['apellido1']=$str;
					$str = $_POST['apellido2'];
					$str = strtoupper($str);
					$_POST['apellido2']=$str;			
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
					$str = $_POST['nombre_representante'];
					$str = strtoupper($str);
					$_POST['nombre_representante']=$str;
					$str = $_POST['departamento'];
					$str = strtoupper($str);
					$_POST['departamento']=$str;
				}
			}
		}
	}
	if(!empty($_POST['tarea']) && $_POST['tarea'] == 'guardar'){
		if($_POST['tipo_doc']=='31'){
			$_POST['nombre2'] = '';
			$_POST['apellido1'] = '';
			$_POST['apellido2'] = '';
		}
		$cliente = new Cliente('',$_POST['tipo_doc'],$_POST['documento'], $_POST['dv'], $_POST['cupo'],$_POST['nombre1'],$_POST['nombre2'],$_POST['apellido1'],$_POST['apellido2'],$_POST['nombre_representante'],$_POST['doc_representante'],$_POST['descuento'],$_POST['forma_pago'],$_POST['pais'],$_POST['departamento'],$_POST['municipio'],$_POST['barrio'],$_POST['direccion'],$_POST['telefono'],$_POST['email'],$_POST['observaciones'],$_POST['regimen'],$_POST['fuente'],$_POST['gran_contribuyente'],$_POST['ret_ica'],$_POST['vendedor'],$fecha,'1');
		$editar = $cliente->editarCliente($_POST['documento']);
		if($editar){
			unset($_SESSION['cliente']);
			unset($_SESSION['clientes']);
			unset($_SESSION['cont']);
			unset($_SESSION['gcont']);
			echo "<script>alert ('El Cliente fue creado con exito');</script>";
			echo "<script>window.location.href='MenuCliente.php';</script>";
		}else{
			echo "<script>alert ('No se pudo crear el cliente, por favor intenta de nuevo');</script>";
		}
	}
		if(!empty($_POST['tarea']) && $_POST['tarea'] == 'contactos'){
			if($_POST['tipo_doc']=='31'){
				$_POST['nombre2'] = '';
				$_POST['apellido1'] = '';
				$_POST['apellido2'] = '';
			}
			$cliente = new Cliente('',$_POST['tipo_doc'],$_POST['documento'], $_POST['dv'], $_POST['cupo'],$_POST['nombre1'],$_POST['nombre2'],$_POST['apellido1'],$_POST['apellido2'],$_POST['nombre_representante'],$_POST['doc_representante'],$_POST['descuento'],$_POST['forma_pago'],$_POST['pais'],$_POST['departamento'],$_POST['municipio'],$_POST['barrio'],$_POST['direccion'],$_POST['telefono'],$_POST['email'],$_POST['observaciones'],$_POST['regimen'],$_POST['fuente'],$_POST['gran_contribuyente'],$_POST['ret_ica'],$_POST['vendedor'],$fecha,'1');
			if(!empty($_SESSION['gcont']) && $_SESSION['gcont']=='1'){
				$editar = $cliente->editarCliente($_POST['documento']);
				if ($editar){
					$cliente_cre = $cliente->buscarCliente('documento',$_POST['documento']);
					$cliente = $cliente_cre[0];
					$_SESSION['cliente']=serialize($cliente);
					echo "<script>window.location.href='CrearContactosCliente.php';</script>";
					unset($_SESSION['gcont']);
				}
			}else{
				$guardar = $cliente->guardarCliente();
				if ($guardar){
					$cliente_cre = $cliente->buscarCliente('documento',$_POST['documento']);
					$clien_cre = $cliente_cre[0];
			    	$registro= new Registro('',$_SESSION['id_usuario'],'CREAR CLIENTE',$clien_cre->id,$clien_cre->documento,$fecha);
					$guardar_registro = $registro->guardarRegistro();
					$_SESSION['cliente']=serialize($clien_cre);
					echo "<script>window.location.href='CrearContactosCliente.php'</script>";
				}else{
					echo "<script>alert ('No se pudo crear el cliente, por favor intenta de nuevo');</script>";
				}
			}
		}
			
			if(!empty($_POST['tarea']) && $_POST['tarea'] == 'salir'){
				unset($_SESSION['cliente']);
				unset($_SESSION['clientes']);
				unset($_SESSION['cont']);
				unset($_SESSION['gcont']);
				echo "<script>window.location.href='MenuCliente.php';</script>";
			}
			if(!empty($_POST['tarea']) && $_POST['tarea'] == 'nuevo'){
				unset($_SESSION['cliente']);
				unset($_SESSION['clientes']);
				unset($_SESSION['cont']);
				unset($_SESSION['gcont']);
				echo "<script>window.location.href='ValidarCliente.php';</script>";
			}	
?>
<!doctype html>
<html>
<head>
<meta charset="iso-8859-1">
<title>Crear Cliente</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script language="javascript" src="js/validaciones.js" type="text/javascript"></script>
<script language="javascript" src="js/ajax.js" type="text/javascript"></script>
<script language="javascript" src ="js/digitov.js" type="text/javascript"></script> 
<script language="javascript" src="js/reloj.js" type="text/javascript"></script>
<script type="text/javascript">
</script>
<style type="text/css">
<!--
.style1 {
	font-size: 12px;
	font-weight: bold;
}
-->
</style>
</head>

<body topmargin="0" onLoad="mostrarPaises(); mueveReloj(); calculoDV();" onKeyDown = "showDown(window.event)">

<table width="100%" border="0" align="center" onMouseMove="calculoDV()" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><form action="" method="post" name="form1" class="FormGeneral" id="form1" target="_parent" enctype="multipart/form-data">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="middle"><table width="100%" height="35" border="0">
            <tr>
              <td width="196"><img src="imagenes/logoge.png" alt="Himed" width="200" height="40"></td>
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
                    <td width="3%" align="right"><a href="logout.php"><img src="imagenes/eqsl_exit.png" alt="" width="30" height="30" title="Salir" border="0"></a></td>
                  </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="middle"><table width="100" border="0" cellspacing="0" cellpadding="0">
            <tr align="center" valign="middle">
              <td><a href="javascript:valgeneral('nuevo')"><img src="imagenes/nuevo_user.png" alt="nuevo" width="32" height="32" border="0" title="Crear Nuevo Cliente"></a></td>
              <td><a href="javascript:valcliente('guardar','<?php echo $gc; ?>')"><img src="imagenes/guardar.png" alt="guardar" width="32" height="32" border="0" title="Guardar Información" onclick="return validarEmail(email,'email')"></a></td>
              <td><a href="BuscarCliente.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Cliente"></a></td>
              <td><img src="imagenes/activar_user_opaco.png" alt="activar" width="32" height="32" border="0"></td>
              <td><img src="imagenes/desactivar_user_opaco.png" alt="desactivar" width="32" height="32" border="0"></td>
              <td><a href="BuscarClienteEditar.php"><img src="imagenes/editar.png" width="33" height="32" border="0"></a></td>
              <td><a href="javascript:valgeneral('salir')"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver"></a></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center" valign="middle"><span class="style1">CREAR CLIENTE </span></td>
        </tr>
      </table>
      <table width="800" height="auto" border="0" cellspacing="0" cellpadding="8" style="background:url(imagenes/fondo_form_cliente.png) no-repeat;">
        <tr>
          <td align="center" id="tabla_cliente" ><table width="800" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="800" align="center">&nbsp;</td>
              </tr>
            <tr>
              <td align="center"><div align="center">
                <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr align="center">
                        <td width="800" height="524" align="center" valign="top">                                              
							<div align="center">
								<table width="700" border="0" align="center">
								  <tr>
									<td width="16" height="29%">&nbsp;</td>
									<td width="245" align="left">Tipo Documento </td>
									<td width="9">&nbsp;</td>
									<td colspan="3" align="left">Documento</td>
									<td width="98" align="left">Cupo</td>
								  </tr>
								  <tr>
									<td height="39%" align="center">*</td>
									<td align="left">
									<select name="tipo_doc" id="tipo_doc" class="campos_mayus"  onchange="valcamposcliente();" onFocus="valcamposcliente();" >
								<?php 
										for($i=1;$i<sizeof($documentos);$i+=2) {
										if($cliente->tipo_documento == $documentos[$i+1]){
											echo "<option selected=\"selected\" value=\"".$documentos[$i+1]."\">".$documentos[$i+2]."</option>\n";
										}else{
											echo "<option value=\"".$documentos[$i+1]."\">".$documentos[$i+2]."</option>\n";
										}
									}
									$documento = $cliente->documento;
								?>
								</select>
									</td>
									<td align="center">*</td>
									<td width="229" align="left"><div align="justify">
									  <input name="documento" type="text" id="documento" value="<?php echo $_SESSION['validaclie']; ?>" maxlength="15" readonly style="background-color:#CCCCCC; ">
									  -							      	  <input name="dv" id="dv" type="text" size="2" readonly>
									</div></td>
									<td width="71" align="left">&nbsp;</td>
									<td width="2" align="left">&nbsp;</td>
									<td align="left"><select name="cupo" id="cupo"  class="campos_mayus">
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
								<td align="left"><input name="nombre1" maxlength="100" type="text" id="nombre1" size="25" class="campos_mayus" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ ?> value="<?php echo $cliente->nombre1; ?>" <?php  } ?> onKeyPress="javascript:return Letras(event)"></td>
								<td align="left">&nbsp;</td>
								<td align="left"><input name="nombre2" type="text" id="nombre2" maxlength="100" size="25" class="campos_mayus" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ ?> value="<?php echo $cliente->nombre2; ?>" <?php  } ?> onKeyPress="javascript:return Letras(event)">
							    <label for="ddf"></label></tr>
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
								<td align="left"><input name="apellido1" type="text" id="apellido1" maxlength="100" size="25" class="campos_mayus" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ ?> value="<?php echo $cliente->apellido1; ?>" <?php  } ?> onKeyPress="javascript:return Letras(event)"></td>
								<td align="left">&nbsp;</td>
								<td align="left"><input name="apellido2" maxlength="100" type="text" id="apellido2" size="25" class="campos_mayus" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ ?> value="<?php echo $cliente->apellido2; ?>" <?php  } ?> onKeyPress="javascript:return Letras(event)">
							    <input type="hidden" name="tarea" id="tarea"></td>
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
								<select name="pais" id="pais" style="height: 25px; width: 150px;" class="campos_mayus" onChange="mostrarDepartamentos(this.value)" onblur="mostrarMunicipios(this.value)" >
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
								<select name="departamento" id="departamento" style="height: 25px; width: 150px;" class="campos_mayus" onchange="mostrarMunicipios(this.value)">
									<?php 
									$deptos = $dpto->getDeptos($pais);
									if(sizeof($deptos) == 0){
										echo "<option value=\"NA01\">NA</option>\n";
									}else{
										//echo "<option value=\"\"></option>\n";
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
								<select name="municipio" id="municipio" style="height: 25px; width: 150px;" class="campos_mayus">
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
                                <td align="left"><input name="barrio" maxlength="50" type="text" id="barrio" size="25" class="campos_mayus" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ ?> value="<?php echo $cliente->barrio; ?>" <?php  } ?> onKeyPress="javascript:return Letras(event)"></td>
                                <td align="left">&nbsp;</td>
                                <td align="left"><input name="direccion" type="text" id="direccion" maxlength="100" size="40" class="campos_mayus" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ ?> value="<?php echo $cliente->direccion; ?>" <?php  } ?>></td>
                              </tr>
                            </table>							
							<table width="700" border="0" align="center">
                              <tr>
                                <td width="15" height="29%">&nbsp;</td>
                                <td width="227" align="left">Telefono                                </td>
                                <td width="10" align="left">&nbsp;</td>
                                <td width="430" align="left">Email</td>
                              </tr>
                              <tr>
                                <td height="39%" align="center">*</td>
                                <td align="left"><input name="telefono" type="text" id="telefono" maxlength="20" size="25" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ ?> value="<?php echo $cliente->telefono; ?>" <?php  } ?> onKeyPress="javascript:return Numeros(event)"></td>
                                <td align="left">&nbsp;</td>
                                <td align="left"><input name="email" type="text" id="email" maxlength="50" size="40" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ ?> value="<?php echo $cliente->email; ?>" <?php  } ?>></td>
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
							    <td align="left"><input name="descuento" type="text" id="descuento" maxlength="20" size="25" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ ?> value="<?php echo $cliente->descuento; ?>" <?php  } ?> onKeyPress="javascript:return Numeros(event)"></td>
							    <td align="left">&nbsp;</td>
							    <td align="left"><select name="forma_pago" id="forma_pago">
                                	<option></option>
                                    <option value="CONTADO" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($cliente->forma_pago == 'CONTADO'){ echo 'selected'; } } ?>>CONTADO</option>
                                    <option value="15 DIAS" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($cliente->forma_pago == '15 DIAS'){ echo 'selected'; } } ?>>15 DIAS</option>
                                    <option value="30 DIAS" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($cliente->forma_pago == '30 DIAS'){ echo 'selected'; } } ?>>30 DIAS</option>
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
							    <td align="left"><input name="nombre_representante" maxlength="100" type="text" id="nombre_representante" class="campos_mayus" size="40" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ ?> value="<?php echo $cliente->nombre_representante; ?>" <?php  } ?> onKeyPress="javascript:return Letras(event)"></td>
							    <td align="left">&nbsp;</td>
							    <td align="left"><input name="doc_representante" type="text" id="doc_representante" maxlength="50" size="40" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ ?> value="<?php echo $cliente->doc_representante; ?>" <?php  } ?> onKeyPress="javascript:return Numeros(event)"></td>
						      </tr>
						    </table>
							<table width="703" border="0" align="center">
                              <tr>
                                <td width="16" height="29%">&nbsp;</td>
                                <td width="138" align="left">Regimen </td>
                                <td width="5">&nbsp;</td>
                                <td width="145" align="left">Retiene Fuente</td>
                                <td width="5">&nbsp;</td>
                                <td colspan="3" align="left">Gran Contribuyente</td>
                                <td width="83" align="left">Retiene Ica</td>
                                <td width="157" align="left">vendedor</td>
                              </tr>
                              <tr>
                                <td height="39%" align="center">*</td>
                                <td align="left"><select name="regimen" id="regimen" onchange="valcampoclie();" onFocus="valcampoclie();">
									<option value=""></option>
                                  <option value="SIMPLIFICADO" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($cliente->clase_regimen == 'SIMPLIFICADO'){ echo 'selected'; } } ?>>SIMPLIFICADO</option>
                                  <option value="COMUN" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($cliente->clase_regimen == 'COMUN'){ echo 'selected'; } } ?>>COMUN</option>
                                </select></td>
                                <td align="center">*</td>
                                <td align="left"><select name="fuente" id="fuente" onchange="valcampoclie();" onFocus="valcampoclie();">
								<option value="" selected="selected"></option>
                                  <option value="SI" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($cliente->retiene_fuente == 'SI'){ echo 'selected'; } } ?>>SI</option>
                                  <option value="NO" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($cliente->retiene_fuente == 'NO'){ echo 'selected'; } } ?>>NO</option>
                                </select>
                                <input type="hidden" name="idfuente" id="idfuente"></td>
                                <td align="center">*</td>
                                <td width="56" align="left"><select name="gran_contribuyente" id="gran_contribuyente" onchange="valcampoclie();" onFocus="valcampoclie();">
								<option value="" selected="selected"></option>
                                  <option value="SI" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($cliente->gran_contribuyente == 'SI'){ echo 'selected'; } } ?>>SI</option>
                                  <option value="NO" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($cliente->gran_contribuyente == 'NO'){ echo 'selected'; } } ?>>NO</option>
                                </select></td>
                                <td width="48" align="left"><input type="hidden" name="id_gran_contribuyente" id="id_gran_contribuyente"></td>
                                <td width="8" align="left">&nbsp;</td>
                                <td align="left"><select name="ret_ica" id="ret_ica" onchange="valcampoclie();" onFocus="valcampoclie();">
                                  <option value="" selected="selected"></option>
                                  <option value="SI" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($cliente->retiene_ica == 'SI'){ echo 'selected'; } } ?>>SI</option>
                                  <option value="NO" <?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($cliente->retiene_ica == 'NO'){ echo 'selected'; } } ?>>NO</option>
                                </select>
                                <input type="hidden" name="id_ret_ica" id="id_ret_ica"></td>
                                <td align="left">
                                <select name="vendedor" id="vendedor" class="campos_mayus"  onchange="valcamposcliente();" onFocus="valcamposcliente();" >
								<?php 
									for($h=0;$h<sizeof($vendedores);$h+=2) {
										if(empty($cliente->vendedor) and $cliente->vendedor == $vendedores[$h+1]){
											echo "<option selected=\"selected\" value=\"".$vendedores[$h]."\">".$vendedores[$h+1]."</option>\n";
										}else{
											echo "<option value=\"".$vendedores[$h]."\">".$vendedores[$h+1]."</option>\n";
										}
									}
									$vendedor = $cliente->vendedor;
								?>
								</select>
                                </td>
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
                                <td colspan="3" align="left"><textarea name="observaciones" cols="80" rows="5" id="observaciones" class="campos_mayus"><?php if(!empty($ver_contactos) && $ver_contactos == '1'){ echo $cliente->observaciones; } ?></textarea></td>
                              </tr>
                              <tr>
                                <td height="39%" align="center">*</td>
                                <td colspan="3" align="left"><input type="button" name="contacto" value="Contactos" onClick="valcliente('contactos');"></td>
                              </tr>
                              <tr align="center">
                                <td height="39%">&nbsp;</td>
                                <td colspan="3">
								<?php if(!empty($ver_contactos) && $ver_contactos == '1'){ ?>							    <table width="601" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td colspan="6" align="center"><strong>CONTACTOS</strong></td>
                                    </tr>
                                  <tr>
                                    <td width="172" align="center">                                        <input name="id" type="hidden" id="id"></td>
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
										  
											for ($j=0; $j<count($resp); $j++){
												$contact = $resp[$j];
											?>
                                  <tr align="left" class="TablaUsuarios">
                                    <td width="172"><?php echo $contact->nombre; ?></td>
                                    <td width="135"><?php echo $contact->cargo; ?></td>
                                    <td width="85" align="center" valign="middle"><?php echo $contact->telefono; ?></td>
                                    <td width="80" align="center" valign="middle"><?php echo $contact->email; ?></td>
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