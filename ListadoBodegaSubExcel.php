<?php
 session_start();
 if($_SESSION["autenticado"] == "1"){
	 include_once 'BodegaSub.php';
	 $resp=unserialize($_SESSION['bodegas']);

	 	header("Content-Type: application/vnd.ms-excel");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("content-disposition: attachment;filename=BodegasSubalquiler.xls");
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

</head>

<body>
<table width="700" border="1" cellspacing="0" cellpadding="0">
			    <tr>
						    <td colspan="3" align="center"><span class="style1">REGISTROS ENCONTRADOS </span></td>
                </tr>
						  <tr>
						    <td height="10" colspan="3" align="center"><input name="tarea" type="hidden" id="tarea"/></td>
					      </tr>
						   
						  <tr>
                          <td width="204" align="center" bgcolor="#CCCCCC"><strong>Número de la Bodega</strong></td>
							<td width="460" align="center" bgcolor="#CCCCCC"><strong>Nombre Bodega</strong></td>
							<td width="228" align="center" valign="middle" bgcolor="#CCCCCC"><strong>Estado</strong></td>
						  </tr>
						 <?php
							for ($i=0; $i<count($resp); $i++){
								$bodega = $resp[$i];
							?>
							<tr align="left" class="TablaUsuarios">
                            <td width="204"><?php echo $bodega->id; ?></a></td>
								<td width="460"><?php echo $bodega->nombre; ?></a></td>
								<td width="228" align="left" valign="middle"> <?php if($bodega->estado==1){echo "ACTIVO";}else{echo "INACTIVO";} ?></td>                                
			                </tr>
												
						<?php } ?>
			  </table>
</body>
</html>
<?php 
 }else{
	echo "<script>alert ('No está autenticado en el sistema');</script>";
	echo "<script>window.location.href='index.php';</script>";

 }
?>
