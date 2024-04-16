<?php
include_once 'Conexion.php';

class Departamento{
	
	public $nombre_bd;
	public $strid_dpto;
	public $strid_pais;
	public $strdes_dpto;
	public $usu_host_bd;
	public $usu_bd;
	public $bol_estado_dpto;
	
	function Departamento($strid_dpto="",$strid_pais="",$strdes_dpto="",$bol_estado_dpto=""){
		$this->strid_dpto = $strid_dpto;
		$this->strid_pais = $strid_pais;
		$this->strdes_dpto = $strdes_dpto;
		$this->bol_estado_dpto = $bol_estado_dpto;
	}
	
	function guardarDepto(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "INSERT INTO tb_departamento (strid_dpto,strid_pais,strdes_dpto,bol_estado_dpto) VALUES ('".$this->strid_dpto."','".$this->strid_pais."','".$this->strdes_dpto."','1')";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->consultar($sql);
		$conn->liberarConsulta();
		$conn->desconectar();
	}
	
	function actualizarDepto($strid_dpto_anterior){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "UPDATE tb_departamento SET strdes_dpto = '".$this->strdes_dpto."' strid_pais = '".$this->strid_pais."' WHERE strid_dpto  = '".$strid_dpto_anterior."'";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->consultar($sql);
		$conn->liberarConsulta();
		$conn->desconectar();
	}
	
	function getDatosDepto(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "SELECT * FROM tb_departamento WHERE strid_dpto = '".$this->strid_dpto."'";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->consultar($sql);
		$datos_departamento = array(); 
		$datos = @mysql_fetch_array($resp);
		for($i=0;$i<=4;$i++){
			$datos_departamento[$i] = $datos[$i];
			$this->strid_dpto = $datos['strid_dpto'];
			$this->strid_pais = $datos['strid_pais'];
			$this->strdes_dpto = $datos['strdes_dpto'];
			$this->bol_estado_dpto = $datos['bol_estado_dpto'];
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $datos_departamento;
	}
	
	function buscarDepto($select,$palabra){
		$conn = new Conexion();
		$conn->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_departamento order by strid_pais";
		}else{
			$sql = "SELECT * from tb_departamento WHERE ".$select." LIKE '".$palabra."%' order by strid_pais";
		}
		//echo "<BR>SQL: ".$sql;
		$departamentos = array();
		$cont = 0;
		$resp = $conn->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$departamentos[$cont] = new Departamento($datos['strid_dpto'],$datos['strid_pais'],$datos['strdes_dpto'],$datos['bol_estado_dpto']);
			$cont++;
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $departamentos;
	}

	
	function activarDepto(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "UPDATE tb_departamento SET bol_estado_dpto= '1' WHERE strid_dpto = '".$this->strid_dpto."'";
		$resp = $conn->consultar($sql);
		//echo "<BR>SQL: ".$sql." respuesta a la consulta: ".$resp;
		$conn->liberarConsulta();
		$conn->desconectar();
		return $resp;
	}
	
	function desactivarDepto(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "UPDATE tb_departamento SET bol_estado_dpto = '0' WHERE strid_dpto = '".$this->strid_dpto."'";
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
	
	function getDepartamentos(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "SELECT * FROM tb_departamento";
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
}
?>