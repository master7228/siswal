<?php
include_once 'Conexion.php';

class ConceptoReparacion{
	
	public $id;
	public $descripcion;
	public $valor;
	public $estado;
	
	function ConceptoReparacion($id="",$descripcion="",$valor="",$estado=""){
		$this->id = $id;
		$this->descripcion = $descripcion;
		$this->valor = $valor;
		$this->estado = $estado;
	}
	
	function guardarConceptoReparacion(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "INSERT INTO tb_conceptos_reparacion (id, descripcion, valor, estado) VALUES ('','".$this->descripcion."','".$this->valor."','1')";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->consultar($sql);
		$conn->liberarConsulta();
		$conn->desconectar();
		return $resp;
	}
	
	public function editarConceptoReparacion($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_conceptos_reparacion set descripcion="'.$this->descripcion.'", valor="'.$this->valor.'" WHERE id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function existeConceptoReparacion(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "select * from tb_conceptos_reparacion where descripcion='".$this->descripcion."'";
		$consul=$con->consultar($sql);
		$num_rows = mysql_num_rows($consul);
		$con->liberarConsulta();
		$con->desconectar();
		return $num_rows;
	}
	
	public function consultarUltimoId(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "select id from tb_conceptos_reparacion order by id DESC limit 1";
		$consul=$con->consultar($sql);
		if ($row = mysql_fetch_row($consul)) {
			$id = $row[0];
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $id;
	
	}
	
	public function actDesConceptoReparacion($valor, $id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_conceptos_reparacion set estado="'.$valor.'" where id="'.$id.'"';
		//echo $sql;
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	function getDatosConceptoReparacion(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "SELECT * FROM tb_conceptos_reparacion WHERE id = ".$this->id;
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
	
	function buscarConceptoReparacion($select,$palabra){
		$conn = new Conexion();
		//echo "<br>Host BD: ".$conn->ubicacion_servidor;
		//echo "<br>usuario BD: ".$conn->login;
		//echo "<br>nombre BD: ".$conn->nombre_bd;
		$conn->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_conceptos_reparacion ";
		}else{
			$sql = "SELECT * from tb_conceptos_reparacion WHERE ".$select." LIKE '%".$palabra."%'";
		}
		//echo "<BR>SQL: ".$sql;
		$clases = array();
		$cont = 0;
		$resp = $conn->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$conceptos[$cont] = new ConceptoReparacion($datos['id'],$datos['descripcion'],$datos['valor'],$datos['estado']);
			$cont++;
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		echo $sql;
		return $conceptos;
	}

	
	function getConceptoReparacion(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "SELECT * FROM tb_conceptos_reparacion";
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
	
	function buscarConceptoRep(){
		$conn = new Conexion();
		$conn->conectar();
	    $sql = "SELECT * from tb_conceptos_reparacion ORDER BY descripcion ASC";
		$clases = array();
		$cont = 0;
		$resp = $conn->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$conceptos[$cont] = new ConceptoReparacion($datos['id'],$datos['descripcion'],$datos['valor'],$datos['estado']);
			$cont++;
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $conceptos;
	}
	
	function buscarConceptoReparacion1($palabra){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "SELECT * from tb_conceptos_reparacion WHERE id='".$palabra."'";
		$clases = array();
		$cont = 0;
		$resp = $conn->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$conceptos[$cont] = new ConceptoReparacion($datos['id'],$datos['descripcion'],$datos['valor'],$datos['estado']);
			$cont++;
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $conceptos;
	}

}
?>