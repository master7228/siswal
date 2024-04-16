<?php
require_once 'Conexion.php';

class BodegaSub{
	
	public $id;
	public $nombre;
	public $estado;
	
	public function BodegaSub($id, $nombre, $estado){
		$this->id=$id;
		$this->nombre=trim($nombre);
		$this->estado=$estado;
		
	}
	
	public function guardarBodegaSub(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "insert into tb_bodega_sub (id, nombre, estado) values ('','".$this->nombre."','".$this->estado."')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function existeBodegaSub(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "select * from tb_bodega_sub where nombre='".$this->nombre."'";
		$consul=$con->consultar($sql);
		$num_rows = mysql_num_rows($consul);
		$con->liberarConsulta();
		$con->desconectar();
		return $num_rows;
	}
	
	
	public function buscarBodegaSub($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_bodega_sub ORDER BY id ASC ";
		}else{
			$sql = "SELECT * from tb_bodega_sub WHERE ".trim($select)." LIKE '%".trim($palabra)."%' ORDER BY id ASC";
		}
		$bodegas = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$bodegas[$cont] = new BodegaSub($datos['id'],$datos['nombre'],$datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $bodegas;
	}
	
	public function buscarBodegaSub1($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_bodega_sub ORDER BY fecha_creacion DESC ";
		}else{
			$sql = "SELECT * from tb_bodega_sub WHERE ".$select." = '".$palabra."'";
		}
		$bodegas = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$bodegas[$cont] = new BodegaSub($datos['id'],$datos['nombre'],$datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $bodegas;
	}
	
	public function editarBodegaSub($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_bodega_sub set nombre="'.$this->nombre.'",estado="'.$this->estado.'" WHERE id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	public function activarDesactivarBodegaSub($valor, $id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_bodega_sub set estado="'.$valor.'" where id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
}
?>