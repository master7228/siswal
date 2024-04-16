<?php
require_once 'Conexion.php';

class Bodega{
	
	public $id;
	public $fecha_creacion;
	public $nombre;
	public $tipo;
	public $direccion;
	public $pais;
	public $departamento;
	public $municipio;
	public $barrio;
	public $observaciones;
	public $estado;
	
	public function Bodega($id, $fecha_creacion, $nombre, $tipo, $direccion, $pais, $departamento, $municipio, $barrio, $observaciones, $estado){
		$this->id=$id;
		$this->fecha_creacion=$fecha_creacion;
		$this->nombre=trim($nombre);
		$this->tipo=trim($tipo);
		$this->direccion=trim($direccion);
		$this->pais=trim($pais);
		$this->departamento=trim($departamento);
		$this->municipio=trim($municipio);
		$this->barrio=trim($barrio);
		$this->observaciones=trim($observaciones);
		$this->estado=$estado;
		
	}
	
	public function guardarBodega(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "insert into tb_bodega (id, fecha_creacion, nombre, tipo, direccion, pais, departamento, municipio, barrio, observaciones, estado) values ('','".$this->fecha_creacion."','".$this->nombre."','".$this->tipo."','".$this->direccion."','".$this->pais."','".$this->departamento."','".$this->municipio."','".$this->barrio."','".$this->observaciones."','".$this->estado."')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function existeBodega(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "select * from tb_bodega where nombre='".$this->nombre."'";
		$consul=$con->consultar($sql);
		$num_rows = mysql_num_rows($consul);
		$con->liberarConsulta();
		$con->desconectar();
		return $num_rows;
	}
	
	public function existeBodegaLocal(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "select * from tb_bodega where tipo='".$this->tipo."'";
		$consul=$con->consultar($sql);
		$num_rows = mysql_num_rows($consul);
		$con->liberarConsulta();
		$con->desconectar();
		return $num_rows;
	}
	
	
	public function buscarBodega($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_bodega ORDER BY fecha_creacion DESC ";
		}else{
			$sql = "SELECT * from tb_bodega WHERE ".trim($select)." LIKE '%".trim($palabra)."%' ORDER BY fecha_creacion DESC";
		}
		$bodegas = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$bodegas[$cont] = new Bodega($datos['id'],$datos['fecha_creacion'],$datos['nombre'],$datos['tipo'],$datos['direccion'],$datos['pais'] ,$datos['departamento'],$datos['municipio'],$datos['barrio'],$datos['observaciones'],$datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $bodegas;
	}
	
	public function buscarBodega1($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_bodega ORDER BY fecha_creacion DESC ";
		}else{
			$sql = "SELECT * from tb_bodega WHERE ".$select." = '".$palabra."'";
		}
		$bodegas = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$bodegas[$cont] = new Bodega($datos['id'],$datos['fecha_creacion'],$datos['nombre'],$datos['tipo'],$datos['direccion'],$datos['pais'],$datos['departamento'],$datos['municipio'],$datos['barrio'],$datos['observaciones'],$datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $bodegas;
	}
	
	public function editarBodega($nombre){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_bodega set nombre="'.$this->nombre.'",tipo="'.$this->tipo.'",direccion="'.$this->direccion.'",pais="'.$this->pais.'",departamento="'.$this->departamento.'",municipio="'.$this->municipio.'",barrio="'.$this->barrio.'", observaciones="'.$this->observaciones.'", estado="'.$this->estado.'" WHERE nombre="'.$nombre.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function cambiarIdBodega($nombre){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_bodega set nombre="'.$this->nombre.'" WHERE nombre="'.$nombre.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	public function activarDesactivarBodega($valor, $nombre){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_bodega set estado="'.$valor.'" where nombre="'.$nombre.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	public function getBodega(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "SELECT * FROM tb_bodega where estado='1'";
		$resp = $conn->consultar($sql);
		$bodega = array(); 
		$i = 0;
		while($datos = @mysql_fetch_array($resp)){
			$bodega[$i] = $datos[0];
			$i++;
			$bodega[$i] = $datos[2];
			$i++;
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $bodega;
	}
}
?>