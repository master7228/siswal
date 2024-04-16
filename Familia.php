<?php
include_once 'Conexion.php';

class Familia{
	
	public $id;
	public $codigo;
	public $descripcion;
	public $estado;
	
	function Familia($id="", $codigo="", $descripcion="",$estado=""){
		$this->id = $id;
		$this->codigo= $codigo;
		$this->descripcion = $descripcion;
		$this->estado = $estado;
	}
	
	function guardarFamilia(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "INSERT INTO tb_familia_equipos (id, codigo, descripcion, estado) VALUES ('','".$this->codigo."','".$this->descripcion."','1')";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->consultar($sql);
		$conn->liberarConsulta();
		$conn->desconectar();
		return $resp;
	}
	
	public function editarFamilia($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_familia_equipos set descripcion="'.$this->descripcion.'" WHERE id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function existeFamilia(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "select * from tb_familia_equipos where descripcion='".$this->descripcion."'";
		$consul=$con->consultar($sql);
		$num_rows = mysql_num_rows($consul);
		$con->liberarConsulta();
		$con->desconectar();
		return $num_rows;
	}
	
	public function consultarUltimoId(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "select id from tb_familia_equipos order by id DESC limit 1";
		$consul=$con->consultar($sql);
		if ($row = mysql_fetch_row($consul)) {
			$id = $row[0];
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $id;
	
	}

	function buscarFamilia($select,$palabra){
		$conn = new Conexion();
		$conn->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_familia_equipos ";
		}else{
			$sql = "SELECT * from tb_familia_equipos WHERE ".$select." LIKE '%".$palabra."%'";
		}
		//echo "<BR>SQL: ".$sql;
		$familias = array();
		$cont = 0;
		$resp = $conn->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$familias[$cont] = new Familia($datos['id'],$datos['codigo'],$datos['descripcion'],$datos['estado']);
			$cont++;
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $familias;
	}
	
	
	function getFamilias(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "SELECT * FROM tb_familia_equipos";
		$resp = $conn->consultar($sql);
		$familias = array(); 
		$i = 0;
		while($datos = @mysql_fetch_array($resp)){
			$familias[$i] = $datos[1];
			$i++;
			$familias[$i] = $datos[2];
			$i++;
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $familias;
	}
	
		public function activarDesactivarFamilia($valor, $id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_familia_equipos set estado="'.$valor.'" where id="'.$id.'"';
		//echo $sql;
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}

}
?>