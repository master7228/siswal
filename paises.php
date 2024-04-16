<?php
 header('Content-Type: text/html; charset=iso-8859-1');
 session_start(); 
 include_once 'Pais.php';
 $pais = new Pais("","","");
 $paises = $pais->getPaises();

?> 
<select name="pais" id="pais" style="height: 25px; width: 150px;" onchange="mostrarDepartamentos(this.value)" onblur="mostrarMunicipios(this.value)">
  <?php 
  	echo "<option value=\"\"></option>\n";
  	for($i=0;$i<=sizeof($paises);$i+=2) { ?>
		<option value="<?php echo $paises[$i] ?>"><?php echo $paises[$i+1] ?></option>
  <?php	} ?>
</select>	
