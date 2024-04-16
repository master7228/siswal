<?php
require_once 'Conexion.php';

class Devolucion{
	public $id;
	public $id_manual;
	public $id_cliente;
	public $id_obra;
	public $contacto;
	public $valor_transporte;
	public $transporte;
	public $observaciones;
	public $fecha_dev;
	public $id_usuario;
	
	public function Devolucion($id="",$id_manual="", $id_cliente="", $id_obra="", $contacto="", $valor_transporte="", $transporte="",$observaciones="", $fecha_dev="",$id_usuario=""){
		$this->id=trim($id);
		$this->id_manual=trim($id_manual);
		$this->id_cliente=trim($id_cliente);
		$this->id_obra=trim($id_obra);
		$this->contacto=trim($contacto);
		$this->valor_transporte=trim($valor_transporte);
		$this->transporte=trim($transporte);
		$this->observaciones=trim($observaciones);
		$this->fecha_dev=trim($fecha_dev);
		$this->id_usuario=trim($id_usuario);
	}
	
	public function guardarDevolucion(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "insert into tb_devolucion (id, id_manual, id_cliente, id_obra, contacto, valor_transporte, transporte, observaciones, fecha_dev, id_usuario) values ('','".$this->id_manual."','".$this->id_cliente."','".$this->id_obra."','".$this->contacto."','".$this->valor_transporte."','".$this->transporte."','".$this->observaciones."','".$this->fecha_dev."','".$this->id_usuario."')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
		echo $sql;
	}
	
		public function buscarDevolucion($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_devolucion ORDER BY id_manual DESC limit 1";
		}else{
			$sql = "SELECT * from tb_devolucion WHERE ".trim($select)." LIKE '".trim($palabra)."%' ORDER BY id_manual DESC limit 1";
		}
		$dev = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$dev[$cont] = new Devolucion($datos['id'],$datos['id_manual'],$datos['id_cliente'],$datos['id_obra'],$datos['contacto'],$datos['valor_transporte'],$datos['transporte'],$datos['observaciones'],$datos['fecha_dev'],$datos['id_usuario']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $dev;
	}
}
?>