<?php
include_once 'Conexion.php';

class Documento{
	
	public $id;
	public $num_doc;
	public $descripcion;
	public $estado;
	
	function Documento($id="",$num_doc="",$descripcion="", $estado=""){
		$this->id = $id;
		$this->num_doc = $num_doc;
		$this->descripcion = $descripcion;
		$this->estado = $estado;
	}
	
	function guardarPais(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "INSERT INTO tb_documento (id, num_doc, descripcion, estado) VALUES ('','".$this->num_doc."','".$this->descripcion."','1')";
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
	
	function getDatosDocumento(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "SELECT * FROM tb_documento WHERE num_doc = ".$this->num_doc;
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->consultar($sql);
		$datos_documento = array(); 
		$datos = @mysql_fetch_array($resp);
		for($i=0;$i<=2;$i++){
			$datos_documento[$i] = $datos[$i];
			$this->num_doc = $datos['num_doc'];
			$this->descripcion = $datos['descripcion'];
			$this->estado = $datos['estado'];;
			//echo "<BR>datos[$i]: ".$datos[$i];
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $datos_documento;
	}
	
	function buscarDoscumento($select,$palabra){
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
	
	function getDocumentos(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "SELECT * FROM tb_documento";
		$resp = $conn->consultar($sql);
		$documentos = array(); 
		$i = 0;
		while($datos = @mysql_fetch_array($resp)){
			$documentos[$i] = $datos[1];
			$i++;
			$documentos[$i] = $datos[2];
			$i++;
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $documentos;
	}

}
?>