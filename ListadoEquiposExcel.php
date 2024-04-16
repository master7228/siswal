<?php
 session_start();
 if($_SESSION["autenticado"] == "1"){
	include_once 'Equipo.php';
	include_once 'Grupo.php';
	include_once 'Clase.php';
	include_once 'Familia.php';
	$resp=unserialize($_SESSION['equipos']);
	
	
	header("Content-Type: application/vnd.ms-excel");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=Equipos.xls");
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Listado Equipos</title>

</head>

<body>
<table width="800" border="1" cellspacing="0" cellpadding="0">
						  
						  <tr>
						    <td height="10" colspan="6" align="center">
							<input name="tarea" type="hidden" id="tarea"/>
					        <input name="id" type="hidden" id="id"/></td>
					      </tr>
                           <tr bgcolor="#999999">
							<td width="150" align="center"><strong>Nro. DE EQUIPO</strong></td>
							<td width="177" align="center"><strong>REFERENCIA EQUIPO </strong></td>
							<td width="153" align="center" valign="middle"><strong>NOMBRE DEL EQUIPO</strong></td>
                            <td width="153" align="center" valign="middle"><strong>GRUPO</strong></td>
                            <td width="153" align="center" valign="middle"><strong>FAMILIA</strong></td>
                            <td width="153" align="center" valign="middle"><strong>CLASE</strong></td>
							<td width="134" align="center" valign="middle"><strong>MINIMO DIAS</strong></td>
							<td width="112" align="center" valign="middle"><strong>VALOR DIA</strong></td>
							<td width="112" align="center" valign="middle"><strong>MINIMO HORAS</strong></td>
                            <td width="112" align="center" valign="middle"><strong>VALOR HORA</strong></td>
                            <td width="112" align="center" valign="middle"><strong>MINIMO METROS</strong></td>
                            <td width="112" align="center" valign="middle"><strong>VALOR METRO</strong></td>
                            <td width="112" align="center" valign="middle"><strong>FECHA DE COMPRA</strong></td>
                            <td width="112" align="center" valign="middle"><strong>NOMBRE DEL PROVEEDOR</strong></td>
                            <td width="112" align="center" valign="middle"><strong>DOCUMENTO DEL PROVEEDOR</strong></td>
                            <td width="112" align="center" valign="middle"><strong>SI OPERADOR</strong></td>
                            <td width="112" align="center" valign="middle"><strong>NO OPERADOR</strong></td>
                            <td width="112" align="center" valign="middle"><strong>OBSERVACIONES</strong></td>
                            <td width="112" align="center" valign="middle"><strong>ESTADO</strong></td>
                            <td width="112" align="center" valign="middle"><strong>TRANSACCIÓN</strong></td>
						  </tr>
						  <?php
							for ($i=0; $i<count($resp); $i++){
								$equipo = $resp[$i];
								if($equipo->id_grupo<10){ $palgrupo ='0'.$equipo->id_grupo; }else{ $palgrupo = $equipo->id_grupo; }
								if($equipo->id_familia<10){ $palfamilia ='0'.$equipo->id_familia; }else{ $palfamilia = $equipo->id_familia; }
								if($equipo->id_clase<10){ $palclase ='0'.$equipo->id_clase; }else{ $palclase = $equipo->id_clase; }
								$grupo = new Grupo($equipo->id_grupo,'','');
								$grupos = $grupo->buscarGrupo('codigo',$palgrupo);
								$clase = new Clase($equipo->id_clase,'','');
								$clases = $clase->buscarClase('codigo',$palclase);
								$familia = new Familia($equipo->id_familia,'','');
								$familias = $familia->buscarFamilia('codigo',$palfamilia);
								$gru=$grupos[0];
								$fam=$familias[0];
								$cla=$clases[0];
															
							?>						  
							<tr align="left" class="TablaUsuarios">
								<td width="150" align="center"><?php echo $equipo->id; ?></a></td>
								<td width="177"><?php echo $equipo->referencia; ?></td>
								<td width="153" align="left" valign="middle"><?php echo $equipo->nombre; ?></td>
                                <td width="153" align="left" valign="middle"><?php echo $gru->descripcion; ?></td>
                                <td width="153" align="left" valign="middle"><?php echo $fam->descripcion; ?></td>
                                <td width="153" align="left" valign="middle"><?php echo $cla->descripcion; ?></td>
							    <td width="134" align="left" valign="middle"><?php echo $equipo->minimo_dias; ?></td>
								<td width="112" align="left" valign="middle"><?php echo $equipo->valor_dia; ?></td>
						      	<td width="112" align="center" valign="middle"><?php echo $equipo->minimo_horas; ?></td>
								<td width="112" align="center" valign="middle"><?php echo $equipo->valor_hora; ?></td>
								<td width="112" align="center" valign="middle"><?php echo $equipo->minimo_metros; ?></td>
								<td width="112" align="center" valign="middle"><?php echo $equipo->valor_metro; ?></td>
							    <td width="134" align="left" valign="middle"><?php echo $equipo->fecha_compra; ?></td>
								<td width="112" align="left" valign="middle"><?php echo $equipo->nombre_proveedor; ?></td>
						      	<td width="112" align="center" valign="middle"><?php echo $equipo->doc_proveedor; ?></td>
						      	<td width="112" align="center" valign="middle"><?php if($equipo->si_operador=='1'){ echo 'X'; } ?></td>
								<td width="112" align="center" valign="middle"><?php if($equipo->no_operador=='1'){ echo 'X'; } ?></td>
								<td width="153" align="left" valign="middle"><?php echo $equipo->observaciones; ?></td>
							    <td width="134" align="left" valign="middle"><?php if($equipo->estado==1){echo "ACTIVO";}else{echo "INACTIVO";} ?></td>
								<td width="112" align="left" valign="middle"><?php echo $equipo->transaccion; ?></td>
						      	
                            </tr>
							  <?php
						}
						?>
			 
			</table>
</body>
</html>
<?php 
 }else{
	echo "<script>alert ('No está autenticado en el sistema');</script>";
	echo "<script>window.location.href='index.php';</script>";
 }
?>