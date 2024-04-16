<?php
 header('Content-Type: text/html; charset=iso-8859-1');
 session_start(); 
 include_once 'Municipio.php';
 $depto = $_GET['depto'];
 $municipio = new Municipio("","","");
 $municipios = $municipio->getMpios($depto);
?> 
<select name="municipio" id="municipio" style="height: 25px; width: 150px;">
  <?php 
  	if(sizeof($municipios) == 0){
		echo "<option value=\"NA01\">NA</option>\n";
	  }else{
		for($i=0;$i<=sizeof($municipios);$i+=2) {
			echo "<option value=\"".$municipios[$i]."\">".$municipios[$i+1]."</option>\n";
		}
	  }
	?>
</select>