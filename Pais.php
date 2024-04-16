<?php
include_once 'Conexion.php';

class Pais{
	
	public $strid_pais;
	public $strdes_pais;
	public $bol_estado_pais;
	
	function Pais($strid_pais="",$strdes_pais="",$bol_estado_pais=""){
		$this->strid_pais = $strid_pais;
		$this->strdes_pais = $strdes_pais;
		$this->bol_estado_pais = $bol_estado_pais;
	}
	
	function guardarPais(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "INSERT INTO tb_pais (strid_pais,strdes_pais,bol_estado_pais) VALUES ('".$this->strid_pais."','".$this->strdes_pais."','1')";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->consultar($sql);
		$conn->liberarConsulta();
		$conn->desconectar();
	}
	
	function actualizarPais($strid_pais_anterior){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "UPDATE tb_pais SET strdes_pais = '".$this->strdes_pais."', strid_pais  = '".$this->strid_pais."' WHERE strid_pais  = '".$strid_pais_anterior."'";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->consultar($sql);
		$conn->liberarConsulta();
		$conn->desconectar();
	}
	
	function getDatosPais(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "SELECT * FROM tb_pais WHERE strid_pais = ".$this->strid_pais;
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->consultar($sql);
		$datos_pais = array(); 
		$datos = @mysql_fetch_array($resp);
		for($i=0;$i<=2;$i++){
			$datos_pais[$i] = $datos[$i];
			$this->strdes_pais = $datos['strdes_pais'];
			$this->bol_estado_pais = $datos['bol_estado_pais'];;
			//echo "<BR>datos[$i]: ".$datos[$i];
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $datos_pais;
	}
	
	function buscarPais($select,$palabra){
		$conn = new Conexion();
		//echo "<br>Host BD: ".$conn->ubicacion_servidor;
		//echo "<br>usuario BD: ".$conn->login;
		//echo "<br>nombre BD: ".$conn->nombre_bd;
		$conn->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_pais ";
		}else{
			$sql = "SELECT * from tb_pais WHERE ".$select." LIKE '".$palabra."%'";
		}
		//echo "<BR>SQL: ".$sql;
		$paises = array();
		$cont = 0;
		$resp = $conn->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$paises[$cont] = new Pais($datos['strid_pais'],$datos['strdes_pais'],$datos['bol_estado_pais']);
			$cont++;
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $paises;
	}
	
	
	function activarPais(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "UPDATE tb_pais SET bol_estado_pais = '1' WHERE strid_pais = '".$this->strid_pais."'";
		$resp = $conn->consultar($sql);
		//echo "<BR>SQL: ".$sql." respuesta a la consulta: ".$resp;
		$conn->liberarConsulta();
		$conn->desconectar();
		return $resp;
	}
	
	function desactivarPais(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "UPDATE tb_pais SET bol_estado_pais = '0' WHERE strid_pais = '".$this->strid_pais."'";
		$resp = $conn->consultar($sql);
		//echo "<BR>SQL: ".$sql." respuesta a la consulta: ".$resp;
		$conn->liberarConsulta();
		$conn->desconectar();
		return $resp;
	}
	
	function getPaises(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "SELECT * FROM tb_pais ORDER BY strdes_pais";
		$resp = $conn->consultar($sql);
		$paises = array(); 
		$i = 0;
		while($datos = @mysql_fetch_array($resp)){
			$paises[$i] = $datos[0];
			$i++;
			$paises[$i] = $datos[1];
			$i++;
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $paises;
	}

}
?>