<?php
require_once 'Conexion.php';

class Registro{
	
	public $id;
	public $id_usuario;
	public $accion;
	public $documento;
	public $id_documento;
	public $fecha_hora;
	
	
	public function Registro($id, $id_usuario, $accion, $documento, $id_documento, $fecha_hora){
		$this->id=$id;
		$this->id_usuario=$id_usuario;
		$this->accion=$accion;
		$this->documento=$documento;
		$this->id_documento=$id_documento;
		$this->fecha_hora=$fecha_hora;
		
	}
	
	public function guardarRegistro(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "insert into tb_registro (id, id_usuario, accion, documento, id_documento, fecha_hora) values ('','".$this->id_usuario."','".$this->accion."','".$this->documento."','".$this->id_documento."','".$this->fecha_hora."')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function buscarRegistro($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_registro ";
		}else{
			$sql = "SELECT * from tb_registro WHERE ".$select." LIKE '".$palabra."%'";
		}
		$registros = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$registros[$cont] = new Registro($datos['id'],$datos['id_usuario'],$datos['accion'],$datos['documento'],$datos['id_documento'],$datos['fecha_hora']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $registros;
	}

}
?>