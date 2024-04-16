<?php
require_once 'Conexion.php';

class EquipoRemisionSub{
	
	public $id;
	public $id_remision;
	public $id_equipo_sub;
	public $cantidad;
	public $valor;
	public $descuento;
	
	public function EquipoRemisionSub($id="", $id_remision="", $id_equipo_sub="", $cantidad="", $valor="", $descuento=""){
		$this->id=trim($id);
		$this->id_remision=trim($id_remision);
		$this->id_equipo_sub=trim($id_equipo_sub);
		$this->cantidad=trim($cantidad);
		$this->valor=trim($valor);
		$this->descuento=trim($descuento);
	}
	
	public function guardarEquipoRemisionSub(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "insert into tb_equipo_sub_rem (id, id_remision, id_equipo_sub, cantidad, valor, descuento) values ('','".$this->id_remision."','".$this->id_equipo_sub."','".$this->cantidad."','".$this->valor."','".$this->descuento."')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	public function buscarEquipoSub($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_equipo_sub_rem";
		}else{
			$sql = "SELECT * from tb_equipo_sub_rem WHERE ".trim($select)." = '".trim($palabra)."'";
		
		}
		$equipos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$equipos[$cont] = new EquipoRemisionSub($datos['id'],$datos['id_remision'],$datos['id_equipo_sub'],$datos['cantidad'],$datos['valor'],$datos['descuento']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $equipos;
	}
	public function buscarEquipoSubDev($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql = "SELECT * from tb_equipo_sub_rem WHERE ".trim($select)." LIKE '".trim($palabra)."'";
		$equipos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$equipos[$cont] = new EquipoRemisionSub($datos['id'],$datos['id_remision'],$datos['id_equipo_sub'],$datos['cantidad'],$datos['valor'],$datos['descuento']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $equipos;
	}
}
?>