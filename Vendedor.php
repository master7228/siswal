<?php
require_once 'Conexion.php';

class Vendedor{
	
	public $id;
	public $tipo_doc;
	public $documento;
	public $nombres;
	public $apellidos;
	public $celular;
	public $estado;
	
	public function Vendedor($id, $tipo_doc, $documento, $nombres, $apellidos, $celular,$estado){
		$this->id=trim($id);
		$this->tipo_doc=trim($tipo_doc);
		$this->documento=trim($documento);
		$this->nombres=trim($nombres);
		$this->apellidos=trim($apellidos);
		$this->celular=trim($celular);
		$this->estado=trim($estado);		
	}

	public function guardarVendedor(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "insert into tb_vendedores (id, tipo_doc, documento, nombres, apellidos, celular, estado) values ('','".$this->tipo_doc."','".$this->documento."','".$this->nombres."','".$this->apellidos."','".$this->celular."','".$this->estado."')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function existeVendedor($documento){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "select * from tb_vendedores where documento='".$documento."'";
		$consul=$con->consultar($sql);
		$num_rows = mysql_num_rows($consul);
		$con->liberarConsulta();
		$con->desconectar();
		return $num_rows;
	}
	
	
	public function buscarVendedor($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_vendedores ";
		}else{
			$sql = "SELECT * from tb_vendedores WHERE ".trim($select)." LIKE '%".trim($palabra)."%'";
		}
		$vendedores = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$vendedores[$cont] = new Vendedor($datos['id'],$datos['tipo_doc'],$datos['documento'],$datos['nombres'],$datos['apellidos'],$datos['celular'],$datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $vendedores;
	}
	
	public function editarVendedor($doc_ant){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_vendedores set tipo_doc="'.$this->tipo_doc.'", documento="'.$this->documento.'", nombres="'.$this->nombres.'", apellidos="'.$this->apellidos.'", celular="'.$this->celular.'", estado="'.$this->estado.'" WHERE documento="'.$doc_ant.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	
	public function activarDesactivarVendedor($valor, $documento){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_vendedores set estado="'.$valor.'" where documento="'.$documento.'"';
		//echo $sql;
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	function getVendedores(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "SELECT * FROM tb_vendedores where estado = 1";
		$resp = $conn->consultar($sql);
		$vendedores = array(); 
		$i = 0;
		while($datos = @mysql_fetch_array($resp)){
			$vendedores[$i] = $datos[0];
			$i++;
			$vendedores[$i] = $datos[3].' '.$datos[4];
			$i++;
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $vendedores;
	}
}
?>