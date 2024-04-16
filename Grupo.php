<?php
include_once 'Conexion.php';

class Grupo{
	
	public $id;
	public $codigo;
	public $descripcion;
	public $estado;
	
	function Grupo($id="",$codigo="",$descripcion="",$estado=""){
		$this->id = $id;
		$this->codigo=$codigo;
		$this->descripcion = $descripcion;
		$this->estado = $estado;
	}
	
	function guardarGrupo(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "INSERT INTO tb_grupo_equipos (id,codigo,descripcion, estado) VALUES ('','".$this->codigo."','".$this->descripcion."','1')";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->consultar($sql);
		$conn->liberarConsulta();
		$conn->desconectar();
		return $resp;
	}
	public function editarGrupo($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_grupo_equipos set descripcion="'.$this->descripcion.'" WHERE id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function consultarUltimoId(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "select id from tb_grupo_equipos order by id DESC limit 1";
		$consul=$con->consultar($sql);
		if ($row = mysql_fetch_row($consul)) {
			$id = $row[0];
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $id;
	
	}
	
	public function existeGrupo(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "select * from tb_grupo_equipos where descripcion='".$this->descripcion."'";
		$consul=$con->consultar($sql);
		$num_rows = mysql_num_rows($consul);
		$con->liberarConsulta();
		$con->desconectar();
		return $num_rows;
	}
	
	function buscarGrupo($select,$palabra){
		$conn = new Conexion();
		$conn->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_grupo_equipos ";
		}else{
			$sql = "SELECT * from tb_grupo_equipos WHERE ".$select." LIKE '%".$palabra."%'";
		}
		//echo "<BR>SQL: ".$sql;
		$grupos = array();
		$cont = 0;
		$resp = $conn->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$grupos[$cont] = new Grupo($datos['id'],$datos['codigo'],$datos['descripcion'],$datos['estado']);
			$cont++;
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $grupos;
	}
	
	function getGrupos(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "SELECT * FROM tb_grupo_equipos where estado=1";
		$resp = $conn->consultar($sql);
		$grupos = array(); 
		$i = 0;
		while($datos = @mysql_fetch_array($resp)){
			$grupos[$i] = $datos[1];
			$i++;
			$grupos[$i] = $datos[2];
			$i++;
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $grupos;
	}
	
	public function activarDesactivarGrupo($valor, $id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_grupo_equipos set estado="'.$valor.'" where id="'.$id.'"';
		//echo $sql;
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
}
?>