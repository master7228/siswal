<?php
 session_start();
 if(!empty($_SESSION["autenticado"]) && $_SESSION["autenticado"] == "1"){
	 include_once 'ConceptoReparacion.php';
	 include_once 'Usuario.php';
	 include_once 'ReparacionEquipo.php';

	 $conceptoreparacion = new ConceptoReparacion("","","","");
	 $resp = $conceptoreparacion->buscarConceptoRep();
	 
	 if(!empty($_POST['tarea']) && $_POST['tarea']=='seleccionar'){
		 for($i=0; $i<=count($resp); $i++){
			 if (!empty($_POST['seleccionar'.$i.''])){
				 $rep = $resp[$i];
				 $reparacionequipo = new ReparacionEquipo('',$_GET['id'],$rep->id,$_GET['idr']);
				 $resp_equipo_sel = $reparacionequipo->guardarRepEq();
			}
		 }
		 echo "<script>window.opener.location.reload(); window.close();</script>";
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
			
			<p>&nbsp;</p>
			<p>
			  <?php if(!empty($resp)){
			?>
			  </p>
			<table width="700">
			  <tr>
			    <td width="700" align="right"><a href="javascript:valequiposel('seleccionar');"><img src="imagenes/seleccionar.png" width="35" height="35" title="Aplicar Selección" /></a></td>
			    </tr>
			  </table>
			<table width="700" height="189" border="1" cellpadding="0" cellspacing="0">
			    <tr>
						    <td colspan="7" align="center"><strong>
						      <input name="tarea" type="hidden" id="tarea"/>
                              <input name="id" type="hidden" id="id"/>
                            REGISTROS ENCONTRADOS </strong></td>
		        </tr>
                           <tr bgcolor="" style="font-size:15px">
							<td width="318" align="center"><strong>Concepto Reparaci&oacute;n</strong></td>
							<td width="261" align="center"><strong>Valor</strong></td>
							<td width="113" align="center" valign="middle"><strong>Seleccionar</strong></td>
						  </tr>
						  <?php
							for ($i=0; $i<count($resp); $i++){
								$rep = $resp[$i]; 

								$equipoRep = new ReparacionEquipo("","","","");
								$lista = $equipoRep->buscarSelRep($_GET['id'],$_GET['idr'],$rep->id);
								if(!empty($lista)){
									$id = $lista[0];
									$val=$id->id_concepto;
								}else{
									$val=0;
								}

							?>
                            <?php if($rep->id!=$val){ ?>
                            <tr align="left" class="TablaUsuarios" style="background-color: #666; font-size:15px" >
							  <td width="318" align="left"><?php echo $rep->descripcion; ?></a></td>
							  <td width="261"><?php echo $rep->valor; ?></td>
                              <td width="113" align="center" valign="middle"><input type="checkbox" name="seleccionar<?php echo $i; ?>" id="seleccionar<?php echo $i; ?>" value="<?php echo $equipo->id;?>"/></td>
                           
							<?php }?>
                             </tr>
                            <?php }?>
						</table>
						<?php
						}else{
							echo "No hay resultados para esta consulta";
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
