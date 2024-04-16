<?php
require_once 'Conexion.php';

class Cupo{
	
	public $id;
	public $valor;
	public $estado;
	
	public function Cupo($id, $valor, $estado){
		$this->id=trim($id);
		$this->valor=trim($valor);
		$this->estado=trim($estado);		
	}
	
	public function guardarCupo(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "insert into tb_cupo (id, valor, estado) values ('','".$this->valor."','1')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function existeCupo(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "select * from tb_cupo where valor='".$this->valor."'";
		$consul=$con->consultar($sql);
		$num_rows = mysql_num_rows($consul);
		$con->liberarConsulta();
		$con->desconectar();
		return $num_rows;
	}
	
	
	public function buscarCupo($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_cupo ";
		}else{
			$sql = "SELECT * from tb_cupo WHERE ".trim($select)." LIKE '%".trim($palabra)."%'";
		}
		$cupos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$cupos[$cont] = new Cupo($datos['id'],$datos['valor'],$datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $cupos;
	}
	
	public function editarCupo($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_cupo set valor="'.$this->valor.'" WHERE id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	
	public function activarDesactivarCupo($valor, $id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_cupo set estado="'.$valor.'" where id="'.$id.'"';
		//echo $sql;
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
}
?>