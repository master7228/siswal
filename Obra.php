<?php
require_once 'Conexion.php';

class Obra{
	
	public $id;
	public $nombre;
	public $id_cliente;
	public $nombre_cliente;
	public $tipo_doc_y_o;
	public $documento_y_o;
	public $dv_y_o;
	public $nombre_y_o;
	public $pais;
	public $departamento;
	public $municipio;
	public $barrio;
	public $direccion;
	public $telefono;
	public $celular;
	public $tarifa_transporte;
	public $direccion_factura;
	public $observaciones;
	public $id_vendedor;
	public $fecha_creacion;	
	public $estado;
	
	public function Obra($id, $nombre, $id_cliente, $nombre_cliente, $tipo_doc_y_o, $documento_y_o, $dv_y_o, $nombre_y_o, $pais, $departamento,$municipio, $barrio, $direccion, $telefono, $celular, $tarifa_transporte, $direccion_factura, $observaciones, $id_vendedor, $fecha_creacion, $estado){
		$this->id=trim($id);
		$this->nombre=trim($nombre);
		$this->id_cliente=trim($id_cliente);
		$this->nombre_cliente=trim($nombre_cliente);
		$this->tipo_doc_y_o=trim($tipo_doc_y_o);
		$this->documento_y_o=trim($documento_y_o);
		$this->dv_y_o=trim($dv_y_o);
		$this->nombre_y_o=trim($nombre_y_o);
		$this->pais=trim($pais);
		$this->departamento=trim($departamento);
		$this->municipio=trim($municipio);
		$this->barrio=trim($barrio);
		$this->direccion=trim($direccion);
		$this->telefono=trim($telefono);
		$this->celular=trim($celular);
		$this->tarifa_transporte=trim($tarifa_transporte);
		$this->direccion_factura=trim($direccion_factura);
		$this->observaciones=trim($observaciones);
		$this->id_vendedor=trim($id_vendedor);
		$this->fecha_creacion=trim($fecha_creacion);
		$this->estado=trim($estado);
		
	}
	
	public function guardarObra($id_usuario){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "insert into tb_obras (id, nombre, id_cliente, nombre_cliente, tipo_doc_y_o, documento_y_o, dv_y_o, nombre_y_o,pais, departamento, municipio, barrio, direccion, telefono, celular, tarifa_transporte, direccion_factura, observaciones, id_vendedor, fecha_creacion, estado,id_usuario) values ('','".$this->nombre."','".$this->id_cliente."','".$this->nombre_cliente."','".$this->tipo_doc_y_o."','".$this->documento_y_o."','".$this->dv_y_o."','".$this->nombre_y_o."','".$this->pais."','".$this->departamento."','".$this->municipio."','".$this->barrio."','".$this->direccion."','".$this->telefono."','".$this->celular."','".$this->tarifa_transporte."','".$this->direccion_factura."','".$this->observaciones."','".$this->id_vendedor."','".$this->fecha_creacion."','".$this->estado."','".$id_usuario."')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	

	public function buscarObra($select,$palabra,$id_usuario){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_obras ";
		}else{
			$sql = "SELECT * from tb_obras WHERE ".trim($select)." LIKE '%".trim($palabra)."%' AND id_usuario='".$id_usuario."' ORDER BY id DESC LIMIT 1";
		}
		$obras = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$obras[$cont] = new Obra($datos['id'],$datos['nombre'],$datos['id_cliente'],$datos['nombre_cliente'],$datos['tipo_doc_y_o'],$datos['documento_y_o'],$datos['dv_y_o'],$datos['nombre_y_o'],$datos['pais'],$datos['departamento'],$datos['municipio'],$datos['barrio'],$datos['direccion'],$datos['telefono'],$datos['celular'],$datos['tarifa_transporte'],$datos['direccion_factura'],$datos['observaciones'],$datos['id_vendedor'],$datos['fecha_creacion'],$datos['estado'],$datos['id_usuario']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $obras;
	}
	
	public function buscarObraGeneral($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_obras ";
		}else{
			$sql = "SELECT * from tb_obras WHERE ".trim($select)." LIKE '%".trim($palabra)."%' ORDER BY id DESC LIMIT 1";
		}
		$obras = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$obras[$cont] = new Obra($datos['id'],$datos['nombre'],$datos['id_cliente'],$datos['nombre_cliente'],$datos['tipo_doc_y_o'],$datos['documento_y_o'],$datos['dv_y_o'],$datos['nombre_y_o'],$datos['pais'],$datos['departamento'],$datos['municipio'],$datos['barrio'],$datos['direccion'],$datos['telefono'],$datos['celular'],$datos['tarifa_transporte'],$datos['direccion_factura'],$datos['observaciones'],$datos['id_vendedor'],$datos['fecha_creacion'],$datos['estado'],$datos['id_usuario']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $obras;
	}
	
	public function buscarObrasActivas($select,$palabra,$id){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_obras where estado = '1' and id_cliente LIKE '".trim($id)."%'";
		}else{
			$sql = "SELECT * from tb_obras WHERE ".trim($select)." LIKE '".trim($palabra)."%' and estado = '1' and id_cliente LIKE '".trim($id)."%'";
		}
		$obras = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$obras[$cont] = new Obra($datos['id'],$datos['nombre'],$datos['id_cliente'],$datos['nombre_cliente'],$datos['tipo_doc_y_o'],$datos['documento_y_o'],$datos['dv_y_o'],$datos['nombre_y_o'],$datos['pais'],$datos['departamento'],$datos['municipio'],$datos['barrio'],$datos['direccion'],$datos['telefono'],$datos['celular'],$datos['tarifa_transporte'],$datos['direccion_factura'],$datos['observaciones'],$datos['id_vendedor'],$datos['fecha_creacion'],$datos['estado'],$datos['id_usuario']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $obras;
	}
	
	public function editarObraCrear($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_obras set nombre="'.$this->nombre.'", tipo_doc_y_o="'.$this->tipo_doc_y_o.'", documento_y_o="'.$this->documento_y_o.'",dv_y_o="'.$this->dv_y_o.'", nombre_y_o="'.$this->nombre_y_o.'", pais="'.$this->pais.'",departamento="'.$this->departamento.'",municipio="'.$this->municipio.'",barrio="'.$this->barrio.'",direccion="'.$this->direccion.'", telefono="'.$this->telefono.'",celular="'.$this->celular.'", tarifa_transporte="'.$this->tarifa_transporte.'", direccion_factura="'.$this->direccion_factura.'", observaciones="'.$this->observaciones.'", id_vendedor="'.$this->id_vendedor.'" WHERE id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	
	public function activarDesactivarObra($valor, $id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_obras set estado="'.$valor.'" where id="'.$id.'"';
		//echo $sql;
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
}
?>