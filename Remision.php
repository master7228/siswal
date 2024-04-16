<?php
require_once 'Conexion.php';

class Remision{
	public $id;
	public $id_manual;
	public $id_cliente;
	public $id_obra;
	public $contacto;
	public $valor_transporte;
	public $transporte;
	public $observaciones;
	public $fecha_rem;
	public $id_usuario;
	
	public function Remision($id="",$id_manual="", $id_cliente="", $id_obra="", $contacto="", $valor_transporte="", $transporte="",$observaciones="", $fecha_rem="",$id_usuario=""){
		$this->id=trim($id);
		$this->id_manual=trim($id_manual);
		$this->id_cliente=trim($id_cliente);
		$this->id_obra=trim($id_obra);
		$this->contacto=trim($contacto);
		$this->valor_transporte=trim($valor_transporte);
		$this->transporte=trim($transporte);
		$this->observaciones=trim($observaciones);
		$this->fecha_rem=trim($fecha_rem);
		$this->id_usuario=trim($id_usuario);
	}
	
	public function guardarRemision(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "insert into tb_remision (id, id_manual, id_cliente, id_obra, contacto, valor_transporte, transporte, observaciones, fecha_rem, id_usuario) values ('','".$this->id_manual."','".$this->id_cliente."','".$this->id_obra."','".$this->contacto."','".$this->valor_transporte."','".$this->transporte."','".$this->observaciones."','".$this->fecha_rem."','".$this->id_usuario."')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function buscarRemision($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_remision ORDER BY id DESC limit 1";
		}else{
			$sql = "SELECT * from tb_remision WHERE ".trim($select)." = '".trim($palabra)."%' ORDER BY id DESC limit 1";
		}
		$remi = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$remi[$cont] = new Remision($datos['id'],$datos['id_manual'],$datos['id_cliente'],$datos['id_obra'],$datos['contacto'],$datos['valor_transporte'],$datos['transporte'],$datos['observaciones'],$datos['fecha_rem'],$datos['id_usuario']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $remi;
	}
	
	public function verRemision($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_remision";
		}else{
			$sql = "SELECT * from tb_remision WHERE ".trim($select)." LIKE '".trim($palabra)."%'";
		}
		$remi = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$remi[$cont] = new Remision($datos['id'],$datos['id_manual'],$datos['id_cliente'],$datos['id_obra'],$datos['contacto'],$datos['valor_transporte'],$datos['transporte'],$datos['observaciones'],$datos['fecha_rem'],$datos['id_usuario']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $remi;
	}
	public function imp_Remision($idmanual){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql = "SELECT * from tb_remision where id_manual='".$idmanual."' order by id_manual DESC limit 1";
		$remi = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$remi[$cont] = new Remision($datos['id'],$datos['id_manual'],$datos['id_cliente'],$datos['id_obra'],$datos['contacto'],$datos['valor_transporte'],$datos['transporte'],$datos['observaciones'],$datos['fecha_rem'],$datos['id_usuario']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $remi;
	}
	public function existeRemision(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "SELECT * from tb_remision where id_manual='".$this->id_manual."'";
		$consul=$con->consultar($sql);
		$num_rows = mysql_num_rows($consul);
		$con->liberarConsulta();
		$con->desconectar();
		return $num_rows;
	}
	
	public function editarRemision($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_remision set id_manual="'.$this->id_manual.'", id_cliente="'.$this->id_cliente.'", id_obra="'.$this->id_obra.'", contacto="'.$this->contacto.'", valor_transporte="'.$this->valor_transporte.'", transporte="'.$this->transporte.'", observaciones="'.$this->observaciones.'" WHERE id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function Remision_Dev($idcliente,$idobra,$contacto){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql = "SELECT * from tb_remision where id_cliente='".$idcliente."' and id_obra='".$idobra."' and contacto='".$contacto."'";
		$remi = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$remi[$cont] = new Remision($datos['id'],$datos['id_manual'],$datos['id_cliente'],$datos['id_obra'],$datos['contacto'],$datos['valor_transporte'],$datos['transporte'],$datos['observaciones'],$datos['fecha_rem'],$datos['id_usuario']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $remi;
	}

	public function buscarRemisionDev($palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql = "SELECT * from tb_remision WHERE id = '".trim($palabra)."'";
		$remi = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$remi[$cont] = new Remision($datos['id'],$datos['id_manual'],$datos['id_cliente'],$datos['id_obra'],$datos['contacto'],$datos['valor_transporte'],$datos['transporte'],$datos['observaciones'],$datos['fecha_rem'],$datos['id_usuario']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $remi;
	}
}
?>