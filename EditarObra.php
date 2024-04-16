<?php
session_start();
include_once 'Cliente.php';
include_once 'Obra.php';
include_once 'ContactoObra.php';
include_once 'Usuario.php';
include_once 'Pais.php';
include_once 'Departamento.php';
include_once 'Municipio.php';
include_once 'ValorTransporte.php';
if ($_SESSION["autenticado"] == "1") {
    $fecha = date('Y-m-d H:i');
	$pais = new Pais('','','');
	$paises = $pais->getPaises();
	$dpto= new Departamento('','','','');
	$municipio= new Municipio('','','','');
	$cliente=unserialize($_SESSION['cliente']);
	$obra=unserialize($_SESSION['obra']);
	$vendedor = new Usuario('','','','','','','','','','','','','');
	$consulta = $vendedor->buscarUsuario('id_grupo_usuarios','2');
	$contacto = new ContactoObra('','','','','','','','','','');
	$respu = $contacto->buscarContacto($obra->id);
	if(empty($_SESSION['valor'])){
	$valort= new ValorTransporte('','','','');
	$valortransb = $valort->buscarValorTransporte('id',$obra->tarifa_transporte);
	$valtrans= $valortransb[0];
	}
	$ver_contactos=1;
	if(!empty($_SESSION['valor'])){
		$valortrans = unserialize($_SESSION['valor']);
	}
		if(!empty($_SESSION['cont']) && $_SESSION['cont']=='1'){
			
			$contacto = new ContactoObra('','','','','','','','','','');
			$respu = $contacto->buscarContacto($obra->id);
			$ver_contactos=1;
			$_SESSION['cont']='2';
		}else{
				if(!empty($_POST['tarea']) && $_POST['tarea']!='activar'){
					//--Convertir Campos a Mayusculas--
						$str = $_POST['nombre'];
						$str = strtoupper($str);
						$_POST['nombre']=$str;
						$str = $_POST['tipo_doc'];
						$str = strtoupper($str);
						$_POST['tipo_doc']=$str;
						$str = $_POST['nombre_y_o'];
						$str = strtoupper($str);
						$_POST['nombre_y_o']=$str;
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
						$str = $_POST['direccion_factura'];
						$str = strtoupper($str);
						$_POST['direccion_factura']=$str;
						$str = $_POST['observaciones'];
						$str = strtoupper($str);
						$_POST['observaciones']=$str;
						$str = $_POST['municipio'];
				
						if ($_POST['tarea'] == 'guardar') {
							$obras = new Obra('',$_POST['nombre'],$_POST['documento_cliente'],$_POST['nom_cliente'], $_POST['tipo_doc'],$_POST['documento'],$_POST['dv'],$_POST['nombre_y_o'],$_POST['pais'],$_POST['departamento'],$_POST['municipio'],$_POST['barrio'],$_POST['direccion'],$_POST['telefono'],$_POST['celular'],$valortrans->id,$_POST['direccion_factura'],$_POST['observaciones'],$_POST['id_vendedor'],$fecha,'1');
								$guardar = $obras->editarObraCrear($obra->id);
								if ($guardar){
								echo "<script>alert ('La Obra fue editada con exito');</script>";
								unset($_SESSION['cliente']);
								echo "<script>window.location.href='MenuObras.php';</script>";
							} else {
								echo "<script>alert ('No se pudo editar la obra, por favor intenta de nuevo');</script>";
								echo "<script>window.location.href='EditarObra.php';</script>";
							}
				}
			}
				
				
	}
		if(!empty($_POST['tarea']) && $_POST['tarea'] == 'contactos'){
				$obras = new Obra($obra->id,$_POST['nombre'],$_POST['documento_cliente'],$_POST['nom_cliente'], $_POST['tipo_doc'],$_POST['documento'],$_POST['dv'],$_POST['nombre_y_o'],$_POST['pais'],$_POST['departamento'],$_POST['municipio'],$_POST['barrio'],$_POST['direccion'],$_POST['telefono'],$_POST['celular'],$valtrans->id,$_POST['direccion_factura'],$_POST['observaciones'],$_POST['id_vendedor'],$fecha,'1');
				$guardar = $obras->editarObraCrear($obra->id);
				if ($guardar){
					$consulta = $obras->buscarObra('id_cliente',$cliente->id,$_SESSION["id_usuario"]);
					$resppp = $consulta[0];
					$_SESSION['obra']=serialize($resppp);
					$_SESSION['funcion']='0';
			    	echo "<script>window.location.href='EditarContactosObra.php';</script>";
				}
		}
			
		if(!empty($_POST['tarea']) and $_POST['tarea']=='activar'){
			$estado = $obra->activarDesactivarObra('1', $obra->id);
			$obra->estado="1";
			if($estado){
				$_SESSION['obra']=serialize($obra);
				echo "<script>alert('La Obra ha sido activada correctamente');</script> ";
				echo '<script>window.location="EditarObra.php";</script>';
			}else{
				echo "<script>alert('La Obra no pudo ser activada, intentelo nuevamente');</script> ";
				echo '<script>window.location="EditarObra.php";</script>';
			}
		}
		
		if(!empty($_POST['tarea']) and $_POST['tarea']=='desactivar'){
			$estado = $obra->activarDesactivarObra('2', $obra->id);
			$obra->estado="2";
			if($estado){
				$_SESSION['obra']=serialize($obra);
				echo "<script>alert('La Obra ha sido desactivada correctamente');</script> ";
				echo '<script>window.location="EditarObra.php";</script>';
			}else{
				echo "<script>alert('La Obra no pudo ser desactivada, intentelo nuevamente');</script> ";
				echo '<script>window.location="EditarObra.php";</script>';
			}
		}
			
			if(!empty($_POST['tarea']) && $_POST['tarea'] == 'salir'){
				unset ($_SESSION['obra']);
				unset ($_SESSION['valor']);
				echo "<script>window.location.href='MenuObras.php';</script>";
			}
   
	
	function calcularDV($nit) {
    if (! is_numeric($nit)) {
        return false;
    }
 
    $arr = array(1 => 3, 4 => 17, 7 => 29, 10 => 43, 13 => 59, 2 => 7, 5 => 19, 
    8 => 37, 11 => 47, 14 => 67, 3 => 13, 6 => 23, 9 => 41, 12 => 53, 15 => 71);
    $x = 0;
    $y = 0;
    $z = strlen($nit);
    $dv = '';
    
    for ($i=0; $i<$z; $i++) {
        $y = substr($nit, $i, 1);
        $x += ($y*$arr[$z-$i]);
    }
    
    $y = $x%11;
    
    if ($y > 1) {
        $dv = 11-$y;
        return $dv;
    } else {
        $dv = $y;
        return $dv;
    }
    
}
	
	
 	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Editar Obra</title>
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
 
 <script> 
var miPopup 
function abreVentanaValorTransporte(){ 
	miPopup = window.open("SeleccionarValorTransporte.php","miwin","width=700,height=600,scrollbars=yes") 
	miPopup.focus() 
} 
</script>
</head>

<body topmargin="0" onLoad="mostrarPaises(); mueveReloj(); calculoDV();" onKeyDown = "showDown(window.event)">

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" onMouseMove="calculoDV()">
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
                    <td width="3%" align="right" valign="middle"><a href="logout.php"><img src="imagenes/eqsl_exit.png" width="30" height="30" border="0" title="Salir" /></a></td>
                  </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="middle"><table width="100" border="0" cellspacing="0" cellpadding="0">
            <tr align="center" valign="middle">
              <td><a href="BuscarClienteObra.php" target="_parent"><img src="imagenes/nuevo_user.png" alt="nuevo" width="32" height="32" border="0" title="Crear Nuevo Cliente"/></a></td>
              <td><?php 
			  		if($obra->estado == '2'){?>
                  <img src="imagenes/guardar_opaco.png" alt="activar" width="32" height="32" border="0" title="Guardar Obra"/>
                  <?php 
				    }else{?>
                  <a href="javascript:valobra('guardar')"><img src="imagenes/guardar.png" alt="guardar" width="32" height="32" border="0" title="Guardar Información" /></a>
                  <?php }?></td>
              <td><a href="BuscarObra.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Cliente"/></a></td>
              <td><?php 
			  		if($obra->estado == '2'){?>
                  <a href="javascript:tarea_editar_usuario('activar')"><img src="imagenes/activar_obra.png" alt="activar" width="32" height="35" border="0" title="Activar Obra"/></a>
                  <?php 
				    }else{?>
                  <img src="imagenes/activar_obra_opaco.png" alt="activar" width="32" height="35" border="0" title="Activar Obra"/>
                  <?php }?></td>
              <td><?php 
			  		if($obra->estado == '1'){?>
                  <a href="javascript:tarea_editar_usuario('desactivar')"><img src="imagenes/desactivar_obra.png" alt="desactivar" width="32" height="35" border="0" title="Desactivar Obra"/></a>
                  <?php 
				    }else{?>
                  <img src="imagenes/desactivar_obra_opaco.png" alt="desactivar" width="32" height="35" border="0" title="Desactivar Obra"/>
                  <?php }?></td>
              <td><a href="javascript:valobra('salir')"><img src="imagenes/flecha.png" alt="volver" width="32" height="32" border="0" title="Volver" /></a></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center" valign="middle"><span class="style1">EDITAR OBRA </span></td>
        </tr>
        <tr>
          <td align="left" valign="middle">&nbsp;</td>
        </tr>
      </table>
      <table width="800" height="auto" border="0" cellspacing="0" cellpadding="8" style="background:url(imagenes/fondo_form_cliente.png) no-repeat;">
        <tr>
          <td align="center"  ><table width="800" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="819" align="center">&nbsp;</td>
              </tr>
            <tr>
              <td align="center"><div align="center">
                <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr align="center">
                        <td width="700" height="524" align="center" valign="top">  
						                                            
							
							
							
							<fieldset style="width: 670px; "><legend style="left:auto; ">Datos del Cliente</legend>
								<table width="700" border="0">
								
                                  <tr>
                                    <th width="15" align="left" scope="col">&nbsp;</th>
                                    <td align="left" scope="col">Nombre Cliente </td>
                                    <td width="303" align="left" scope="col">Documento</td>
                                  </tr>
                                  <tr>
                                    <td width="15">&nbsp;</td>
                                    <td width="372" align="left"><input name="nom_cliente" type="text" id="nom_cliente" size="40" readonly="true" value="<?php echo $cliente->nombre1.' '.$cliente->nombre2.' '.$cliente->apellido1.' '.$cliente->apellido2; ?>" /></td>
                                    <td align="left"><input name="documento_cliente" type="text" id="documento_cliente" readonly="true" onblur="CalcularDv()" value="<?php echo $cliente->documento; ?>" />
-
  <input name="dv_cliente" id="dv_cliente" type="text" size="2" readonly="true" value="<?php echo $cliente->dv; ?>" /></td>
                                  </tr>
								 
                            </table>
						    </fieldset>
								<div align="center">
								
								<table width="700" border="0" align="center">
								  <tr>
								    <td width="15" height="29%">&nbsp;</td>
								    <td align="left">&nbsp;</td>
								    <td>&nbsp;</td>
								    <td width="176" align="left">&nbsp;</td>
								    <td width="10">&nbsp;</td>
								    <td width="240" align="left">&nbsp;</td>
							      </tr>
								  <tr>
									<td width="15" height="29%">&nbsp;</td>
									<td width="225" align="left">Nombre de la Obra </td>
									<td width="9">&nbsp;</td>
									<td colspan="3" align="center">Tipo Documento del Y/O</td>
								  </tr>
								  <tr>
									<td width="15" height="39%" align="center">*</td>
									<td align="left"><input name="nombre" type="text" class="campos_mayus" id="nombre" onKeyPress="javascript:return Letras(event)" value="<?php echo $obra->nombre; ?>" size="40" maxlength="40" <?php if($obra->estado=='2'){echo 'disabled';} ?>/></td>
									<td align="center">&nbsp;</td>
									<td colspan="3" align="center"><select name="tipo_doc" id="tipo_doc" class="campos_mayus"  <?php if($obra->estado=='2'){echo 'disabled';} ?>>
									  <option value=""></option>
									  <option value="31"<?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($obra->tipo_doc_y_o == '31'){ echo 'selected'; } } ?>>NIT</option>
									  <option value="13"<?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($obra->tipo_doc_y_o == '13'){ echo 'selected'; } } ?>>CEDULA</option>
									  <option value="12"<?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($obra->tipo_doc_y_o == '12'){ echo 'selected'; } } ?>>TARJETA DE IDENTIDAD</option>
									  <option value="22"<?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($obra->tipo_doc_y_o == '22'){ echo 'selected'; } } ?>>CEDULA DE EXTRANJERIA</option>
									  <option value="21"<?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($obra->tipo_doc_y_o == '21'){ echo 'selected'; } } ?>>TARJETA DE EXTRANJERIA</option>
									  <option value="11"<?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($obra->tipo_doc_y_o == '11'){ echo 'selected'; } } ?>>REGISTRO CIVIL</option>
									  <option value="41"<?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($obra->tipo_doc_y_o == '41'){ echo 'selected'; } } ?>>PASAPORTE</option>
									  <option value="43"<?php if(!empty($ver_contactos) && $ver_contactos == '1'){ if($obra->tipo_doc_y_o == '43'){ echo 'selected'; } } ?>>OPERACIONES DEL EXTERIOR</option>
								    </select></td>
								  </tr>
							  </table>
                                <table width="700" border="0" align="center">
                                  <tr>
                                    <td width="12" height="29%">&nbsp;</td>
                                    <td width="196" align="left">Documento Y/O </td>
                                    <td width="8">&nbsp;</td>
                                    <td width="380" align="left">Nombre Y/O</td>
                                  </tr>
                                  <tr>
                                    <td width="12" height="39%" align="center">&nbsp;</td>
                                    <td align="left"><input name="documento" type="text" id="documento" onblur="CalcularDv()" onKeyPress="javascript:return Numeros(event)" value="<?php echo $obra->documento_y_o; ?>" maxlength="15" <?php if($obra->estado=='2'){echo 'disabled';} ?>/>
-
  <input name="dv" id="dv" type="text" size="1" readonly="true" onblur="CalcularDv()"   value="<?php echo $obra->dv_y_o; ?>" <?php if($obra->estado=='2'){echo 'disabled';} ?>/> </td>
                                    <td align="center">&nbsp;</td>
                                    <td align="left"><input name="nombre_y_o" type="text" class="campos_mayus" id="nombre_y_o" onKeyPress="javascript:return Letras(event)" value="<?php echo $obra->nombre_y_o; ?>" size="40" maxlength="40" <?php if($obra->estado=='2'){echo 'disabled';} ?>/></td>
                                  </tr>
                                </table>
                            </div>                            
							<table width="700" border="0" align="center">
							  <tr>
								<td width="11" height="29%">&nbsp;</td>
								<td width="178" align="left">Pais</td>
								<td width="7">&nbsp;</td>
								<td width="170" align="left">Departamento</td>
								<td width="7">&nbsp;</td>
								<td width="175" align="left">Municipio</td>
							  </tr>
							  <tr>
								<td width="11" height="39%" align="center">*</td>
								<td align="left">
								<div id="detalles1">
							  <div align="left">
								<select name="pais" id="pais" style="height: 25px; width: 150px;" class="campos_mayus" onchange="mostrarDepartamentos(this.value)" onBlur="mostrarMunicipios(this.value)" <?php if($obra->estado=='2'){ echo 'disabled'; } ?> >
								<?php 
										for($i=0;$i<sizeof($paises);$i+=2) {
										if($obra->pais == $paises[$i]){
											echo "<option selected=\"selected\" value=\"".$paises[$i]."\">".$paises[$i+1]."</option>\n";
										}else{
											echo "<option value=\"".$paises[$i]."\">".$paises[$i+1]."</option>\n";
										}
									}
									$pais = $obra->pais;
									
								
								?>
								</select>
								</div>
							</div>
								</td>
								<td align="center">*</td>
								<td align="left">
								<div id="departamentos">
								<select name="departamento" id="departamento" style="height: 25px; width: 150px;" class="campos_mayus" onChange="mostrarMunicipios(this.value)" <?php if($obra->estado=='2'){echo 'disabled';} ?> >
									<?php 
									$deptos = $dpto->getDeptos($pais);
									if(sizeof($deptos) == 0){
										echo "<option value=\"NA01\">NA</option>\n";
									}else{
										for($i=0;$i<=sizeof($deptos);$i+=2) {
											if($obra->departamento == $deptos[$i]){
												echo "<option selected=\"selected\" value=\"".$deptos[$i]."\">".$deptos[$i+1]."</option>\n";
											}else{
												echo "<option value=\"".$deptos[$i]."\">".$deptos[$i+1]."</option>\n";
											}
										}
									  }
									$depto = $obra->departamento;
									?>
								</select>
								</div>
								</td>
								<td align="center">*</td>
								<td align="left">
								<div id="municipios">
								<select name="municipio" id="municipio" style="height: 25px; width: 150px;" class="campos_mayus" <?php if($obra->estado=='2'){ echo 'disabled'; } ?>>
								<?php 
									$municipios = $municipio->getMpios($depto);
									if(sizeof($municipios) == 0){
										echo "<option value=\"NA01\">NA</option>\n";
									}else{
										for($i=0;$i<=sizeof($municipios);$i+=2) {
											if($obra->municipio == $municipios[$i]){
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
                                <td width="12" height="29%">&nbsp;</td>
                                <td width="201" align="left">Barrio</td>
                                <td width="7" align="left">&nbsp;</td>
                                <td width="377" align="left">Direccion
                                <input name="tarea" type="hidden" id="tarea" /></td>
                              </tr>
                              <tr>
                                <td width="12" height="39%" align="center">&nbsp;</td>
                                <td align="left"><input name="barrio" type="text" class="campos_mayus" id="barrio" onKeyPress="javascript:return Letras(event)" value="<?php echo $obra->barrio; ?>" size="25" maxlength="20" <?php if($obra->estado=='2'){echo 'disabled';} ?>/></td>
                                <td align="left">*</td>
                                <td align="left"><input name="direccion" type="text" class="campos_mayus" id="direccion" value="<?php echo $obra->direccion; ?>" size="40" maxlength="30" <?php if($obra->estado=='2'){echo 'disabled';} ?>/></td>
                              </tr>
                            </table>							
							<table width="700" border="0" align="center">
                              <tr>
                                <td width="11" height="29%">&nbsp;</td>
                                <td width="158" align="left">Telefono</td>
                                <td width="2" align="left">&nbsp;</td>
                                <td width="152" align="left">Celular</td>
                                <td width="245" align="left">Direccion env&iacute;o Factura </td>
                              </tr>
                              <tr>
                                <td width="11" height="39%" align="center">&nbsp;</td>
                                <td align="left"><input name="telefono" type="text" id="telefono" onKeyPress="javascript:return Numeros(event)" value="<?php echo $obra->telefono; ?>" maxlength="15" <?php if($obra->estado=='2'){echo 'disabled';} ?>/></td>
                                <td align="left">&nbsp;</td>
                                <td align="left"><input name="celular" type="text" id="celular" onKeyPress="javascript:return Numeros(event)"  value="<?php echo $obra->celular; ?>" maxlength="15" <?php if($obra->estado=='2'){echo 'disabled';} ?>/></td>
                                <td align="left"><input name="direccion_factura" type="text" class="campos_mayus" id="direccion_factura" value="<?php echo $obra->direccion_factura; ?>" maxlength="30" <?php if($obra->estado=='2'){ echo 'disabled'; } ?>/></td>
                              </tr>
                            </table>							
							<table width="703" border="0" align="center">
                              <tr>
                                <td width="11" height="29%">&nbsp;</td>
                                <td width="280" align="left">Tarifa del Transporte </td>
                                <td width="13">&nbsp;</td>
                                <td width="5" align="left">&nbsp;</td>
                                <td width="149" align="left">Vendedor</td>
                                <td width="93" align="left">&nbsp;</td>
                              </tr>
                              <tr>
                                <td width="11" height="39%" align="center">*</td>
                                <td align="left"><input name="tarifa_transporte" type="text" id="tarifa_transporte" onKeyPress="javascript:return Numeros(event)" value="<?php if(!empty($valortrans->valor)){ echo $valortrans->valor; } else if(!empty($ver_contactos) && $ver_contactos == '1'){ echo $valtrans->valor; } ?>" readonly="readonly" size="40" maxlength="15" <?php if($obra->estado=='2'){ echo 'disabled'; } ?>/><a onclick="abreVentanaValorTransporte();"><img src="imagenes/buscar.png" alt="" width="23" height="23" title="Seleccionar Valor Transporte" /></a></td>
                                <td align="center">&nbsp;</td>
                                <td align="left">&nbsp;</td>
                                <td align="left"><select name="id_vendedor" id="id_vendedor"  class="campos_mayus" <?php if($obra->estado=='2'){ echo 'disabled'; } ?>>
                                  <?php for($i=0; $i<=sizeof($consulta); $i++){
								   		$resp=$consulta[$i];
								   		echo "<option value=\"".$resp->documento_identidad."\">".$resp->nombres."</option>\n";
								   
								   } ?>
                                </select></td>
                                <td align="left">&nbsp;</td>
                              </tr>
                            </table>							
							<table width="700" border="0" align="center">
                              <tr>
                                <td width="13" height="29%">&nbsp;</td>
                                <td width="185" align="left">Observaciones</td>
                                <td width="9" align="left">&nbsp;</td>
                                <td width="341" align="left">&nbsp;</td>
                              </tr>
                              <tr>
                                <td width="13" height="39%" align="center">&nbsp;</td>
                                <td colspan="3" align="left"><textarea name="observaciones" cols="80" rows="5" id="observaciones" class="campos_mayus" <?php if($obra->estado=='2'){echo 'disabled';} ?>><?php echo $obra->observaciones; ?> </textarea></td>
                              </tr>
                              <tr>
                                <td width="13" height="39%" align="center">&nbsp;</td>
                                <td colspan="3" align="left">
								<?php if($obra->estado == '1'){ ?>
								<a href="javascript:valobra('contactos')"><img src="imagenes/contactos.png" alt="contactos" width="32" height="32" border="0" title="Agregar Contactos" /></a>
								<?php }else{?>
								<img src="imagenes/contactos_opaco.png" alt="contactos" width="32" height="32" border="0" title="Agregar Contactos" />
								<?php }?></td>
                              </tr>
                              <tr align="center">
                                <td width="13" height="39%">&nbsp;</td>
                                <td colspan="3">
								<?php if(!empty($ver_contactos) && $ver_contactos == '1'){ ?>							    <table width="601" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td colspan="6" align="center"><strong>CONTACTOS</strong></td>
                                    </tr>
                                  <tr>
                                    <td width="172" align="center">                                        <input name="id" type="hidden" id="id"/>                                      </td>
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
										if($contacto->estado == '1'){
									?>
                                  <tr align="left" class="TablaUsuarios">
                                    <td width="172"><?php echo $contacto->nombre; ?></td>
                                    <td width="135"><?php echo $contacto->cargo; ?></td>
                                    <td width="85" align="left" valign="middle"><?php echo $contacto->telefono; ?></td>
                                    <td width="80" align="left" valign="middle"><?php echo $contacto->email; ?></td>
                                  </tr>
                                  <?php
								  } 
								  } 
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
