<?php
require_once 'Conexion.php';

class EquipoRemision{
	
	public $id;
	public $id_remision;
	public $id_equipo;
	public $cantidad;
	public $valorbase;
	public $valorfinal;
	public $descuento;
	
	public function EquipoRemision($id="", $id_remision="", $id_equipo="", $cantidad="", $valorbase="", $valorfinal="", $descuento=""){
		$this->id=trim($id);
		$this->id_remision=trim($id_remision);
		$this->id_equipo=trim($id_equipo);
		$this->cantidad=trim($cantidad);
		$this->valorbase=trim($valorbase);
		$this->valorfinal=trim($valorfinal);
		$this->descuento=trim($descuento);
	}
	
	public function guardarEquipoRemision(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "insert into tb_equipo_rem (id, id_remision, id_equipo, cantidad, valorbase, valorfinal, descuento) values ('','".$this->id_remision."','".$this->id_equipo."','".$this->cantidad."','".$this->valorbase."','".$this->valorfinal."','".$this->descuento."')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	public function buscarEquiposRemision($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_equipo_rem ORDER BY id DESC limit 1";
		}else{
			$sql = "SELECT * from tb_equipo_rem WHERE ".trim($select)." LIKE '".trim($palabra)."%' ORDER BY id DESC limit 1";
		}
		$equipo_rem = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$equipo_rem[$cont] = new EquipoRemision($datos['id'],$datos['id_remision'],$datos['id_equipo'],$datos['cantidad'],$datos['valorbase'],$datos['valorfinal'],$datos['descuento']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $equipo_rem;
	}
	public function buscarEquiposRemisionados($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql = "SELECT * from tb_equipo_rem WHERE ".trim($select)." = '".trim($palabra)."'";
		$equipo_rem = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$equipo_rem[$cont] = new EquipoRemision($datos['id'],$datos['id_remision'],$datos['id_equipo'],$datos['cantidad'],$datos['valorbase'],$datos['valorfinal'],$datos['descuento']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $equipo_rem;
	}
	public function buscarEquiposRemisionCompleto($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_equipo_rem ORDER BY id DESC limit 1";
		}else{
			$sql = "SELECT * from tb_equipo_rem WHERE ".trim($select)." LIKE '".trim($palabra)."%' ORDER BY id DESC limit 1";
		}
		$equipo_rem = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$equipo_rem[$cont] = new EquipoRemision($datos['id'],$datos['id_remision'],$datos['id_equipo'],$datos['cantidad'],$datos['valorbase'],$datos['valorfinal'],$datos['descuento']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $equipo_rem;
	}
	
	public function editarEquipoRemision(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_equipo_rem set cantidad="'.$this->cantidad.'",valorfinal="'.$this->valorfinal.'",descuento="'.$this->descuento.'" WHERE id_remision="'.$this->id_remision.'" and id_equipo="'.$this->id_equipo.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	public function EliminarEquipoRemision($id_equip){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'DELETE FROM tb_equipo_rem where id_equipo="'.$id_equip.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
}
?>