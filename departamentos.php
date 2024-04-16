<?php
 header('Content-Type: text/html; charset=iso-8859-1');
 session_start();
 include_once 'Departamento.php';
 $pais = $_GET['pais'];
 
 $departamento = new Departamento("","","","");
 $deptos = $departamento->getDeptos($pais);
?>
<select name="departamento" id="departamento" style="height: 25px; width: 150px;" onchange="mostrarMunicipios(this.value)">
  <?php	
	  if(sizeof($deptos) == 0){
		echo "<option value=\"NA01\">NA</option>\n";
	  }else{
	  	echo "<option value=\"\"></option>\n";
		for($i=0;$i<=sizeof($deptos);$i+=2) {
			echo "<option value=\"".$deptos[$i]."\">".$deptos[$i+1]."</option>\n";
		}
	  }
	?>
</select>