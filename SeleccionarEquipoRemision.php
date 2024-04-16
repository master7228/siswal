<?php
session_start();
 if(!empty($_SESSION["autenticado"]) && $_SESSION["autenticado"] == "1"){
	 include_once 'Equipo.php';
	 include_once 'EquipoSub.php';
	 include_once 'Grupo.php';
	 include_once 'Familia.php';
	 include_once 'Clase.php';
	 include_once 'Usuario.php';
	 include_once 'Remision.php';
	 include_once 'EquipoRemision.php';
	 include_once 'EquipoRemisionSub.php';
	 include_once 'ContactoObra.php';
	 include_once 'EntradaSub.php';
	 include_once 'EquipoDevolucion.php';
	 include_once 'Cliente.php';
	 include_once 'Obra.php';
	 include_once 'EquipoDevolucionSub.php';
	 $ver_equipos = 0;
	 $cont = 0;
	 $cont0 = 0;
	 $cont01 = 0;
	 $cont1 = 0;
	 $ent=0;
	 $ent1=0;
	 $estado=0;
	 $estado1=0;
	 $R=0;
	 $T=0;
	 $cliente = unserialize($_SESSION['cliente']);
	 $obra = unserialize($_SESSION['obra']);
	 if(!empty($_SESSION['cliente']) && (!empty($_SESSION['obra']))){
		 $remision = new Remision("","","","","","","","","","");
		 $rem = $remision->Remision_Dev($cliente->id,$obra->id,$_SESSION['env_contacto']);
		 if(!empty($rem)){
		 	for($i=0; $i<count($rem); $i++){
				$remidev = $rem[$i];
				$equiporemision = new EquipoRemision("","","","","","");
				$resp = $equiporemision->buscarEquiposRemisionados('id_remision',$remidev->id);
				for($s=0; $s<count($resp); $s++){
					$equiporem = $resp[$s];
					$equipo2 = new Equipo("","","","","","","","","","","","","","","","","","","","","","","","");
		 			$resp2 = $equipo2->buscarEquipo('id',$equiporem->id_equipo);
					$equipo=$resp2[0];
					$cont0++;
					$ent=1;
				}
			}
			if(!empty($rem)){
				for($s=0; $s<count($rem); $s++){
					$remidev=$rem[$s];
					$equiporemisionsub = new EquipoRemisionSub("","","","","","");
					$respp = $equiporemisionsub->buscarEquipoSubDev('id_remision',$remidev->id);
					for ($i=0; $i<count($respp); $i++){
						$equiporemsub = $respp[$i];
						$entradasub = new EntradaSub("","","","","","","");
						$resp3 = $entradasub->buscarequipoEntrada('id',$equiporemsub->id_equipo_sub);
						$equipoentsub=$resp3[0];
						$cont01++;
						$ent1=1;
					}
				}
			}

			$ver_equipos = 1;
		 }
	 }

	 if(!empty($_POST['tarea']) && $_POST['tarea']=='seleccionar'){
		 if($ent==1){
			/* for($i=0; $i<=$cont0; $i++){
				 if (!empty($_POST['seleccionar'.$i.''])){
					 $equi = $resp[$i];
					 $equipo2 = new Equipo("","","","","","","","","","","","","","","","","","","","","","","","");
					 $resp2 = $equipo2->buscarEquipo('id',$equi->id_equipo);
					 $equipo=$resp2[0];
					 $EquipoDevolucion = new EquipoDevolucion('',$remidev->id,$equipo->id,$equi->cantidad);
					 $guardar = $EquipoDevolucion->guardarEquipoDevolucion();
					 if($guardar){
						 $estado=1;
					 }
				 }
			 }*/
			 
		 	 for($i=0; $i<count($rem); $i++){
				$remidev = $rem[$i];
				$equiporemision = new EquipoRemision("","","","","","");
				$resp = $equiporemision->buscarEquiposRemisionados('id_remision',$remidev->id);
				for($s=0; $s<count($resp); $s++){
					$R++;
					if (!empty($_POST['seleccionar'.$R.''])){
						$equiporem = $resp[$s];
						$equipo2 = new Equipo("","","","","","","","","","","","","","","","","","","","","","","","");
		 				$resp2 = $equipo2->buscarEquipo('id',$equiporem->id_equipo);
						$equipo=$resp2[0];
						$EquipoDevolucion = new EquipoDevolucion('',$remidev->id,$equipo->id,$equiporem->cantidad,$_SESSION['id_usuario']);
					 	$guardar = $EquipoDevolucion->guardarEquipoDevolucion();
					 	if($guardar){
						 	$estado=1;
						}
					}
				}
			 }
		 }
		 if($ent1==1){
			/* for($i=0; $i<=$cont01; $i++){
				 if (!empty($_POST['seleccionarsub'.$i.''])){
					 $entradasub = new EntradaSub("","","","","","","");
					 $rpta = $entradasub->buscarequipoEntrada('id_nomsub',$_POST['seleccionarsub'.$i.'']);
					 $equipo_entsub=$rpta[0];
					 $EquipoDevolucionsub = new EquipoDevolucionSub('',$remidev->id,$_POST['seleccionarsub'.$R.''],$equipo_entsub->cantidad);
					 $guardar = $EquipoDevolucionsub->guardarEquipoDevolucionSub();
					 if($guardar){
						 $estado1=1;
					 }
				 }
			 }*/
			 
			for($s=0; $s<count($rem); $s++){
					$remidev=$rem[$s];
					$equiporemisionsub = new EquipoRemisionSub("","","","","","");
					$respp = $equiporemisionsub->buscarEquipoSubDev('id_remision',$remidev->id);
					for ($i=0; $i<count($respp); $i++){
						$T++;
						if(!empty($_POST['seleccionarsub'.$T.''])){
							$equiporemsub = $respp[$i];
							$entradasub = new EntradaSub("","","","","","","");
							$resp3 = $entradasub->buscarequipoEntrada('id',$equiporemsub->id_equipo_sub);
							$equipoentsub=$resp3[0];
							
							$EquipoDevolucionsub = new EquipoDevolucionSub('',$remidev->id,$_POST['seleccionarsub'.$T.''],$equipoentsub->cantidad,$_SESSION['id_usuario']);
					 		$guardar = $EquipoDevolucionsub->guardarEquipoDevolucionSub();
					 		if($guardar){
						 		$estado1=1;
					 		}
						}
					}
			}
		 }
		 if($estado==1 || $estado1==1){
			 $_SESSION['idremision_ma']=serialize($remidev->id);
			 echo "<script>window.opener.location.reload(); window.close();</script>";
		 }
	 }
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Buscar Equipo</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script src="js/validaciones.js" language="JavaScript"></script>
<script src="js/reloj.js" language="JavaScript"></script>
</head>

<body onLoad="mueveReloj();">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><form id="form2" name="form2" method="post" action="" class="TablaUsuarios">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="middle"><table width="100%" height="35" border="0">
              <tr>
                <td width="196"><img src="imagenes/logoge.png" alt="Himed" width="200" height="40" /></td>
                <td align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="right" valign="top">
                    	<table width="128" border="0" align="right" cellpadding="2" cellspacing="2" > 
                    	<tr> 
                    		<th width="114" scope="col"><font id="cl"><strong>0</strong></font></th> 
                    	</tr> 
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr align="right" valign="middle">
                          <td><span class="Estilo6">Usuario: <?php echo $_SESSION["nombre"].' '.$_SESSION['apellido']; ?></span></td>
                          </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center">
			<?php if($ver_equipos == 0){ ?>
            
			<p>&nbsp;</p>
			<p>
			  <?php }else{
						if($resp!=0){
			?>
			  </p>
			<table width="700">
			  <tr>
			    <td width="700" align="right"><a href="javascript:valequiposel('seleccionar');"><img src="imagenes/seleccionar.png" width="35" height="35" title="Aplicar Selección" /></a></td>
			    </tr>
			  </table>
			<table width="700" border="1" cellspacing="0" cellpadding="0">
			    <tr>
						    <td colspan="7" align="center"><strong>
						      <input name="tarea" type="hidden" id="tarea"/>
                              <input name="id" type="hidden" id="id"/>
                            REGISTROS ENCONTRADOS </strong></td>
		        </tr>
                           <tr bgcolor="#999999">
							<td width="121" align="center"><strong>Referencia Equipo</strong></td>
							<td width="277" align="center"><strong>Nombre del Equipo</strong></td>
							<td width="64" align="center" valign="middle"><strong>Cantidad</strong></td>
                            <td width="64" align="center" valign="middle"><strong>Seleccionar</strong></td>
						  </tr>
						  <?php
						  if($ent!=0){
							  for($s=0; $s<count($rem); $s++){
								  $remidev=$rem[$s];
		 						  $equiporemision = new EquipoRemision("","","","","","");
		 						  $resp = $equiporemision->buscarEquiposRemisionados('id_remision',$remidev->id);
								  for ($i=0; $i<count($resp); $i++){
									  $equiporem = $resp[$i];
									  $equipo2 = new Equipo("","","","","","","","","","","","","","","","","","","","","","","","");
		 							  $resp2 = $equipo2->buscarEquipo('id',$equiporem->id_equipo);
									  $equipo=$resp2[0];
									  $cont++;
									  $equipodevolucion = new EquipoDevolucion("","","","");
									  $lista_dev = $equipodevolucion->buscarEquiposDevEst($remidev->id,$equipo->id);
									  if(!empty($lista_dev)){
										  $equipo_dev = $lista_dev[0];
										  $val=$equipo_dev->id_equipo;
									  }else{
										  $val=00;
								  	  }
							?>
							<tr align="left" class="TablaUsuarios" style="background-color:#CCC">
							<?php if($equipo->id==$val){?>
        							<tr>
        							</tr>
                            <?php }else{ ?>
                             <td width="121" align="center"><?php echo $equipo->referencia; ?></a></td>
							 <td width="277"><?php echo $equipo->nombre; ?></td>
							 <td width="64" align="center" valign="middle"><?php echo $equiporem->cantidad; ?></td>
                             <td width="64" align="center" valign="middle"><input type="checkbox" name="seleccionar<?php echo $cont; ?>" id="seleccionar<?php echo $cont; ?>" value="<?php echo $equipo->id;?>"/></td>
							<?php } ?>
                            </tr>
						<?php }}}?>
            			<?php
						if($ent1!=0){
							for($s=0; $s<count($rem); $s++){
								$remidev=$rem[$s];
								$equiporemisionsub = new EquipoRemisionSub("","","","","","");
		 						$respp = $equiporemisionsub->buscarEquipoSubDev('id_remision',$remidev->id);
								for ($i=0; $i<count($respp); $i++){
									$equiporemsub = $respp[$i];
									$entradasub = new EntradaSub("","","","","","","");
									$resp3 = $entradasub->buscarequipoEntrada('id',$equiporemsub->id_equipo_sub);
									$equipoentsub=$resp3[0];
									$cont1++;
									$equipodevolucion = new EquipoDevolucionSub("","","","");
	 								$lista_dev = $equipodevolucion->buscarEquiposSubDevEst($remidev->id,$equipoentsub->id_nomsub);
									if(!empty($lista_dev)){
										$equipo_dev = $lista_dev[0];
										$val=$equipo_dev->id_equipo;
									}else{
										$val=00;
								}
							?>
                            <tr align="left" class="TablaUsuarios" style="background-color:#CCC">
                            <?php if($equipoentsub->id_nomsub==$val){?>
        							<tr>
        							</tr>
                            <?php }else{ ?>
							<td width="121" align="center"><?php echo '' ?></a></td>
							<td width="277"><?php echo $equipoentsub->nombre; ?></td>
							<td width="64" align="center" valign="middle"><?php echo $equipoentsub->cantidad; ?></td>
                            <td width="64" align="center" valign="middle"><input type="checkbox" name="seleccionarsub<?php echo $cont1; ?>" id="seleccionarsub<?php echo $cont1; ?>" value="<?php echo $equipoentsub->id_nomsub;?>"/></td>
							<?php } ?>
                            </tr>
						<?php }}}?>
                        </table>
						<?php
						}else{
							echo "No hay resultados para esta consulta";
						}
					}
						?>			
			</td>
          </tr>
          <tr>
            <td align="center" valign="middle"></td>
          </tr>
        </table>
        <p>&nbsp;</p>
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