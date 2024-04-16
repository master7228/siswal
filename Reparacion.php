<?php
require_once 'Conexion.php';

class Reparacion{
	public $id;
	public $id_remision;
	public $id_equipo;
	public $cantidad;
	
	
	public function Reparacion($id="",$id_remision="", $id_equipo="",$cantidad=""){
		$this->id=trim($id);
		$this->id_remision=trim($id_remision);
		$this->id_equipo=trim($id_equipo);
		$this->cantidad=trim($cantidad);
	}
	
	public function guardarRepEq(){
		//$con= new Conexion();
		//$conectar=$con->conectar();
		$sql= "insert into tb_reparacion(id, id_remision, id_equipo,cantidad) values ('','".$this->id_remision."','".$this->id_equipo."','".$this->cantidad."')";
		//$consul=$con->consultar($sql);
		//$con->liberarConsulta();
		//$con->desconectar();
		echo $sql;
		//return $consul;
	}
}
?>