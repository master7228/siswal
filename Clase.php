<?php
include_once 'Conexion.php';

class Clase{
	
	public $id;
	public $codigo;
	public $descripcion;
	public $estado;
	
	function Clase($id="",$codigo="",$descripcion="",$estado=""){
		$this->id = $id;
		$this->codigo = $codigo;
		$this->descripcion = $descripcion;
		$this->estado = $estado;
	}
	
	function guardarClase(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "INSERT INTO tb_clase_equipos (id, codigo, descripcion, estado) VALUES ('','".$this->codigo."','".$this->descripcion."','1')";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->consultar($sql);
		$conn->liberarConsulta();
		$conn->desconectar();
		return $resp;
	}
	
	public function editarClase($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_clase_equipos set descripcion="'.$this->descripcion.'" WHERE id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function existeClase(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "select * from tb_clase_equipos where descripcion='".$this->descripcion."'";
		$consul=$con->consultar($sql);
		$num_rows = mysql_num_rows($consul);
		$con->liberarConsulta();
		$con->desconectar();
		return $num_rows;
	}
	
	public function consultarUltimoId(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "select id from tb_clase_equipos order by id DESC limit 1";
		$consul=$con->consultar($sql);
		if ($row = mysql_fetch_row($consul)) {
			$id = $row[0];
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $id;
	
	}
	
	public function activarDesactivarClase($valor, $id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_clase_equipos set estado="'.$valor.'" where id="'.$id.'"';
		//echo $sql;
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	function getDatosClase(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "SELECT * FROM tb_clase_equipos WHERE id = ".$this->id;
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->consultar($sql);
		$datos_clase = array(); 
		$datos = @mysql_fetch_array($resp);
		for($i=0;$i<=2;$i++){
			$datos_clase[$i] = $datos[$i];
			$this->descripcion = $datos['descripcion'];
			$this->estado = $datos['estado'];;
			//echo "<BR>datos[$i]: ".$datos[$i];
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $datos_clase;
	}
	
	function buscarClase($select,$palabra){
		$conn = new Conexion();
		//echo "<br>Host BD: ".$conn->ubicacion_servidor;
		//echo "<br>usuario BD: ".$conn->login;
		//echo "<br>nombre BD: ".$conn->nombre_bd;
		$conn->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_clase_equipos ";
		}else{
			$sql = "SELECT * from tb_clase_equipos WHERE ".$select." LIKE '%".$palabra."%'";
		}
		//echo "<BR>SQL: ".$sql;
		$clases = array();
		$cont = 0;
		$resp = $conn->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$clases[$cont] = new Clase($datos['id'], $datos['codigo'],$datos['descripcion'],$datos['estado']);
			$cont++;
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $clases;
	}

	
	function getClases(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "SELECT * FROM tb_clase_equipos";
		$resp = $conn->consultar($sql);
		$clases = array(); 
		$i = 0;
		while($datos = @mysql_fetch_array($resp)){
			$clases[$i] = $datos[1];
			$i++;
			$clases[$i] = $datos[2];
			$i++;
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $clases;
	}

}
?>