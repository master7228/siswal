<?php
require_once 'Conexion.php';

class ReparacionEquipo{
	public $id;
	public $id_equipo;
	public $id_concepto;
	public $id_remision;
	
	public function ReparacionEquipo($id="",$id_equipo="", $id_concepto="",$id_remision=""){
		$this->id=trim($id);
		$this->id_equipo=trim($id_equipo);
		$this->id_concepto=trim($id_concepto);
		$this->id_remision=trim($id_remision);
	}
	
	public function guardarRepEq(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "insert into tb_reparacion_equipo(id, id_equipo, id_concepto,id_remision) values ('','".$this->id_equipo."','".$this->id_concepto."','".$this->id_remision."')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		echo $sql;
		return $consul;
	}
	
	public function buscarSelRep($id_equipo,$id_remision,$id_concepto){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql = "SELECT * from tb_reparacion_equipo where id_equipo='".$id_equipo."' and id_remision='".$id_remision."' and id_concepto='".$id_concepto."'";
		$equiposrep = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$equiposrep[$cont] = new ReparacionEquipo($datos['id'],$datos['id_equipo'],$datos['id_concepto'],$datos['id_remision']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $equiposrep;
	}
	
	public function buscarSelRepEq($id_remision,$id_equipo){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql = "SELECT * from tb_reparacion_equipo where id_remision='".$id_remision."' and id_equipo='".$id_equipo."'";
		$equiposrep = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$equiposrep[$cont] = new ReparacionEquipo($datos['id'],$datos['id_equipo'],$datos['id_concepto'],$datos['id_remision']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $equiposrep;
	}
	
	public function eliminar_equipoRep($id_concepto,$id_equipo,$id_remision){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'DELETE FROM tb_reparacion_equipo where id_concepto="'.$id_concepto.'" and id_equipo="'.$id_equipo.'" and id_remision="'.$id_remision.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
		echo $sql;
	}
}
?>