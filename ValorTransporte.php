<?php
require_once 'Conexion.php';

class ValorTransporte{
	
	public $id;
	public $ciudad;
	public $valor;
	public $estado;
	
	public function ValorTransporte($id, $ciudad, $valor, $estado){
		$this->id=trim($id);
		$this->ciudad=trim($ciudad);
		$this->valor=trim($valor);
		$this->estado=trim($estado);		
	}
	
	public function guardarValorTransporte(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "insert into tb_valor_transporte (id, ciudad, valor, estado) values ('','".$this->ciudad."','".$this->valor."','1')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function existeValorTransporte(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "select * from tb_valor_transporte where ciudad='".$this->ciudad."' and valor='".$this->valor."'";
		$consul=$con->consultar($sql);
		$num_rows = mysql_num_rows($consul);
		$con->liberarConsulta();
		$con->desconectar();
		return $num_rows;
	}
	
	
	public function buscarValorTransporte($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_valor_transporte ";
		}else{
			$sql = "SELECT * from tb_valor_transporte WHERE ".trim($select)." LIKE '%".trim($palabra)."%'";
		}
		$transportes = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$transportes[$cont] = new ValorTransporte($datos['id'],$datos['ciudad'],$datos['valor'],$datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $transportes;
	}
	
	public function buscarValorTransporteDos($palabra1,$palabra2){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql = "SELECT * from tb_valor_transporte WHERE ciudad = '".trim($palabra1)."' and valor = '".trim($palabra2)."'";
		$transportes = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$transportes[$cont] = new ValorTransporte($datos['id'],$datos['ciudad'],$datos['valor'],$datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $transportes;
	}
	
	public function editarValorTransporte($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_valor_transporte set ciudad="'.$this->ciudad.'", valor="'.$this->valor.'" WHERE id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	
	public function activarDesactivarValorTransporte($valor, $id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_valor_transporte set estado="'.$valor.'" where id="'.$id.'"';
		//echo $sql;
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
}
?>