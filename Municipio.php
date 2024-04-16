<?php
include_once 'Conexion.php';

class Municipio{
	
	public $strid_mpio;
	public $strid_pais;
	public $strid_dpto;
	public $strdes_mpio;
	
	
	function Municipio($strid_mpio="",$strid_dpto="",$strid_pais="",$strdes_mpio=""){
		$this->strid_mpio = $strid_mpio;
		$this->strid_dpto = $strid_dpto;
		$this->strid_pais = $strid_pais;
		$this->strdes_mpio = $strdes_mpio;
	}
	
	function guardarMpio(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "INSERT INTO tb_municipio (strid_mpio,strid_dpto,strid_pais,strdes_mpio,bol_estado_mpio) VALUES ('".$this->strid_mpio."','".$this->strid_dpto."','".$this->strid_pais."','".$this->strdes_mpio."','1')";
		$resp = $conn->consultar($sql);
		$conn->liberarConsulta();
		$conn->desconectar();
		return $resp;
	}
	
	function actualizarMpio($strid_mpio_anterior){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "UPDATE tb_municipio SET strdes_mpio = '".$this->strdes_mpio."' WHERE strid_mpio  = '".$strid_mpio_anterior."'";
		$resp = $conn->consultar($sql);
		$conn->liberarConsulta();
		$conn->desconectar();
	}
	
	function getDatosMpio(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "SELECT * FROM tb_municipio WHERE strid_mpio = '".$this->strid_mpio."'";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->consultar($sql);
		$datos_municipio = array(); 
		$datos = @mysql_fetch_array($resp);
		for($i=0;$i<=6;$i++){
			$datos_municipio[$i] = $datos[$i];
			$this->strid_mpio = $datos['strid_mpio'];
			$this->strid_dpto = $datos['strid_dpto'];
			$this->strid_pais = $datos['strid_pais'];
			$this->strdes_mpio = $datos['strdes_mpio'];
			$this->bol_estado_mpio = $datos['bol_estado_mpio'];
		//	echo "<BR>datos[$i]: ".$datos[$i];
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $datos_municipio;
	}
	
	function buscarMpio($select,$palabra){
		$conn = new Conexion();
		$conn->conectar();
		if($select == "*"){
			$sql = "SELECT strid_mpio,strid_dpto,strid_pais,strdes_mpio,bol_estado_mpio from tb_municipio order by strid_pais";
		}else if($select == 'mun'){
			$sql = "SELECT * from tb_municipio WHERE strid_mpio = '".$this->strid_mpio."'";
		}else{
			$sql = "SELECT * from tb_municipio WHERE ".$select." LIKE '".$palabra."%' order by strid_pais";
		}
		//echo "<BR>SQL: ".$sql;
		$municipios = array();
		$cont = 0;
		$resp = $conn->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$municipios[$cont] = new Municipio($datos['strid_mpio'],$datos['strid_dpto'],$datos['strid_pais'],$datos['strdes_mpio']);
			//echo $datos['strid_mpio'].$datos['strid_dpto'].$datos['strid_pais'].$datos['strdes_mpio'].$datos['bol_estado_mpio'];
			$cont++;
		}
		//echo "<BR>SQL: ".$cont;
		$conn->liberarConsulta();
		$conn->desconectar();
		return $municipios;
	}
	
	function buscarMpioObra($pais,$departamento,$municipio){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "SELECT * from tb_municipio WHERE strid_mpio LIKE '".$municipio."%' AND strid_dpto LIKE '".$departamento."%' AND strid_pais LIKE '".$pais."%'";
		$municipios = array();
		$cont = 0;
		$resp = $conn->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$municipios[$cont] = new Municipio($datos['strid_mpio'],$datos['strid_dpto'],$datos['strid_pais'],$datos['strdes_mpio']);
			$cont++;
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $municipios;
	}
	
	function activarMpio(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "UPDATE tb_municipio SET bol_estado_mpio= '1' WHERE strid_mpio = '".$this->strid_mpio."'";
		$resp = $conn->consultar($sql);
		//echo "<BR>SQL: ".$sql." respuesta a la consulta: ".$resp;
		$conn->liberarConsulta();
		$conn->desconectar();
		return $resp;
	}
	
	function desactivarMpio(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "UPDATE tb_municipio SET bol_estado_mpio = '0' WHERE strid_mpio = '".$this->strid_mpio."'";
		$resp = $conn->consultar($sql);
		//echo "<BR>SQL: ".$sql." respuesta a la consulta: ".$resp;
		$conn->liberarConsulta();
		$conn->desconectar();
		return $resp;
	}
	
	/*function getPaises(){
		$conn = new Conexion();
		$conn->setHost($this->usu_host_bd);
		$conn->setNombreBD($this->nombre_bd);
		$conn->setLogin($this->usu_bd);
		$conn->conectar();
		$sql = "SELECT * FROM tb_pais";
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
	}*/
	
	function getDeptos($pais){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "SELECT * FROM tb_departamento WHERE strid_pais = ".$pais;
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->consultar($sql);
		$departamentos = array(); 
		$i = 0;
		while($datos = @mysql_fetch_array($resp)){
			$departamentos[$i] = $datos[0];
			$i++;
			$departamentos[$i] = $datos[2];
			$i++;
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $departamentos;
	}
	
	function getMpios($depto){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "SELECT * FROM tb_municipio WHERE strid_dpto = '".$depto."'";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->consultar($sql);
		$municipios = array(); 
		$i = 0;
		while($datos = @mysql_fetch_array($resp)){
			$municipios[$i] = $datos[0];
			$i++;
			$municipios[$i] = $datos[3];
			$i++;
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $municipios;
	}
	
	function getMunicipios(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "SELECT * FROM tb_municipio";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->consultar($sql);
		$municipios = array(); 
		$i = 0;
		while($datos = @mysql_fetch_array($resp)){
			$municipios[$i] = $datos[0];
			$i++;
			$municipios[$i] = $datos[3];
			$i++;
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $municipios;
	}
	
}
?>