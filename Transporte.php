<?php
require_once 'Conexion.php';

class Transporte{
	
	public $id;
	public $placa;
	public $estado;
	
	public function Transporte($id, $placa, $estado){
		$this->id=trim($id);
		$this->placa=trim($placa);
		$this->estado=trim($estado);		
	}
	
	public function guardarTransporte(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "insert into tb_transporte (id, placa, estado) values ('','".$this->placa."','1')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function existeTransporte(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "select * from tb_transporte where placa='".$this->placa."'";
		$consul=$con->consultar($sql);
		$num_rows = mysql_num_rows($consul);
		$con->liberarConsulta();
		$con->desconectar();
		return $num_rows;
	}
	
	
	public function buscarTransporte($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_transporte ";
		}else{
			$sql = "SELECT * from tb_transporte WHERE ".trim($select)." LIKE '%".trim($palabra)."%'";
		}
		$transportes = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$transportes[$cont] = new Transporte($datos['id'],$datos['placa'],$datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $transportes;
	}
	
	public function editarTransporte($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_transporte set placa="'.$this->placa.'" WHERE id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	
	public function activarDesactivarTransporte($valor, $id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_transporte set estado="'.$valor.'" where id="'.$id.'"';
		//echo $sql;
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	function getTransporte(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "SELECT * FROM tb_transporte WHERE estado='1' ORDER BY placa";
		$resp = $conn->consultar($sql);
		$trans = array(); 
		$i = 0;
		while($datos = @mysql_fetch_array($resp)){
			$trans[$i] = $datos[0];
			$i++;
			$trans[$i] = $datos[1];
			$i++;
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $trans;
	}
}
?>