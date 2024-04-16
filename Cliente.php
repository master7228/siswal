<?php
require_once 'Conexion.php';

class Cliente{
	
	public $id;
	public $tipo_documento;
	public $documento;
	public $dv;
	public $cupo;
	public $nombre1;
	public $nombre2;
	public $apellido1;
	public $apellido2;
	public $nombre_representante;
	public $doc_representante;
	public $descuento;
	public $forma_pago;
	public $pais;
	public $departamento;
	public $municipio;
	public $barrio;
	public $direccion;
	public $telefono;
	public $email;
	public $observaciones;
	public $clase_regimen;
	public $retiene_fuente;
	public $gran_contribuyente;
	public $retiene_ica;
	public $vendedor;
	public $fecha_creacion;	
	public $estado;
	
	public function Cliente($id, $tipo_documento, $documento, $dv, $cupo, $nombre1, $nombre2, $apellido1, $apellido2, $nombre_representante, $doc_representante, $descuento, $forma_pago, $pais, $departamento,$municipio, $barrio, $direccion, $telefono, $email, $observaciones, $clase_regimen, $retiene_fuente, $gran_contribuyente,$retiene_ica, $vendedor, $fecha_creacion, $estado){
		$this->id=$id;
		$this->tipo_documento=$tipo_documento;
		$this->documento=trim($documento);
		$this->dv=$dv;
		$this->cupo=$cupo;
		$this->nombre1=trim($nombre1);
		$this->nombre2=trim($nombre2);
		$this->apellido1=trim($apellido1);
		$this->apellido2=trim($apellido2);
		$this->nombre_representante=trim($nombre_representante);
		$this->doc_representante=trim($doc_representante);
		$this->descuento=trim($descuento);
		$this->forma_pago=$forma_pago;
		$this->pais=$pais;
		$this->departamento=$departamento;
		$this->municipio=$municipio;
		$this->barrio=trim($barrio);
		$this->direccion=trim($direccion);
		$this->telefono=trim($telefono);
		$this->email=trim($email);
		$this->observaciones=trim($observaciones);
		$this->clase_regimen=$clase_regimen;
		$this->retiene_fuente=$retiene_fuente;
		$this->gran_contribuyente=$gran_contribuyente;
		$this->retiene_ica=$retiene_ica;
		$this->vendedor=$vendedor;
		$this->fecha_creacion=$fecha_creacion;
		$this->estado=$estado;
		
	}
	
	public function guardarCliente(){
		$con= new Conexion();
		$conectar=$con->conectar();
		//$sql= "insert into tb_clientes (id, tipo_documento, documento, dv, cupo, nombre1, nombre2, apellido1, apellido2, pais, departamento, municipio, barrio, direccion, telefono, email, observaciones, clase_regimen, retiene_fuente, gran_contribuyente, retiene_ica, vendedor, fecha_creacion, estado) values ('','".$this->tipo_documento."','".$this->documento."','".$this->dv."','".$this->cupo."','".$this->nombre1."','".$this->nombre2."','".$this->apellido1."','".$this->apellido2."','".$this->pais."','".$this->departamento."','".$this->municipio."','".$this->barrio."','".$this->direccion."','".$this->telefono."','".$this->email."','".$this->observaciones."','".$this->clase_regimen."','".$this->retiene_fuente."','".$this->gran_contribuyente."','".$this->retiene_ica."','".$this->vendedor."','".$this->fecha_creacion."','".$this->estado."')";
		$sql= "insert into tb_clientes (id, tipo_documento, documento, dv, cupo, nombre1, nombre2, apellido1, apellido2, nombre_representante, doc_representante, descuento, forma_pago, pais, departamento, municipio, barrio, direccion, telefono, email, observaciones, clase_regimen, retiene_fuente, gran_contribuyente, retiene_ica, vendedor, fecha_creacion, estado) values ('','".$this->tipo_documento."','".$this->documento."','".$this->dv."','".$this->cupo."','".$this->nombre1."','".$this->nombre2."','".$this->apellido1."','".$this->apellido2."','".$this->nombre_representante."','".$this->doc_representante."','".$this->descuento."','".$this->forma_pago."','".$this->pais."','".$this->departamento."','".$this->municipio."','".$this->barrio."','".$this->direccion."','".$this->telefono."','".$this->email."','".$this->observaciones."','".$this->clase_regimen."','".$this->retiene_fuente."','".$this->gran_contribuyente."','".$this->retiene_ica."','".$this->vendedor."','".$this->fecha_creacion."','".$this->estado."')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function existeCliente(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "select * from tb_clientes where documento='".$this->documento."'";
		$consul=$con->consultar($sql);
		$num_rows = mysql_num_rows($consul);
		$con->liberarConsulta();
		$con->desconectar();
		return $num_rows;
	}

	public function buscarCliente($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_clientes ORDER BY nombre1 ASC ";
		}else{
			$sql = "SELECT * from tb_clientes WHERE ".trim($select)." LIKE '%".trim($palabra)."%' ORDER BY ".trim($select)." ASC";
		}
		$clientes = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$clientes[$cont] = new Cliente($datos['id'],$datos['tipo_documento'],$datos['documento'],$datos['dv'],$datos['cupo'],$datos['nombre1'],$datos['nombre2'],$datos['apellido1'],$datos['apellido2'],$datos['nombre_representante'],$datos['doc_representante'],$datos['descuento'],$datos['forma_pago'],$datos['pais'],$datos['departamento'],$datos['municipio'],$datos['barrio'],$datos['direccion'],$datos['telefono'],$datos['email'],$datos['observaciones'],$datos['clase_regimen'],$datos['retiene_fuente'],$datos['gran_contribuyente'],$datos['retiene_ica'],$datos['vendedor'],$datos['fecha_creacion'], $datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $clientes;
	}
	
	public function buscarClientesActivos($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_clientes where estado = '1' ORDER BY fecha_creacion DESC ";
		}else{
			$sql = "SELECT * from tb_clientes WHERE ".trim($select)." LIKE '".trim($palabra)."%' and estado = '1' ORDER BY fecha_creacion DESC";
		}
		$clientes = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$clientes[$cont] = new Cliente($datos['id'],$datos['tipo_documento'],$datos['documento'],$datos['dv'],$datos['cupo'],$datos['nombre1'],$datos['nombre2'],$datos['apellido1'],$datos['apellido2'],$datos['nombre_representante'],$datos['doc_representante'],$datos['descuento'],$datos['forma_pago'],$datos['pais'],$datos['departamento'],$datos['municipio'],$datos['barrio'],$datos['direccion'],$datos['telefono'],$datos['email'],$datos['observaciones'],$datos['clase_regimen'],$datos['retiene_fuente'],$datos['gran_contribuyente'],$datos['retiene_ica'],$datos['vendedor'],$datos['fecha_creacion'], $datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $clientes;
	}
	
	public function buscarCliente1($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_clientes ORDER BY fecha_creacion DESC ";
		}else{
			$sql = "SELECT * from tb_clientes WHERE ".trim($select)." = '".trim($palabra)."'";
		}
		$clientes = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$clientes[$cont] = new Cliente($datos['id'],$datos['tipo_documento'],$datos['documento'],$datos['dv'],$datos['cupo'],$datos['nombre1'],$datos['nombre2'],$datos['apellido1'],$datos['apellido2'],$datos['nombre_representante'],$datos['doc_representante'],$datos['descuento'],$datos['forma_pago'],$datos['pais'],$datos['departamento'],$datos['municipio'],$datos['barrio'],$datos['direccion'],$datos['telefono'],$datos['email'],$datos['observaciones'],$datos['clase_regimen'],$datos['retiene_fuente'],$datos['gran_contribuyente'],$datos['retiene_ica'],$datos['vendedor'],$datos['fecha_creacion'], $datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $clientes;
	}
	
	public function editarCliente($documento){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_clientes set cupo="'.$this->cupo.'",nombre1="'.$this->nombre1.'",nombre2="'.$this->nombre2.'", apellido1="'.$this->apellido1.'",apellido2="'.$this->apellido2.'",nombre_representante="'.$this->nombre_representante.'",doc_representante="'.$this->doc_representante.'",descuento="'.$this->descuento.'",forma_pago="'.$this->forma_pago.'", pais="'.$this->pais.'",departamento="'.$this->departamento.'",municipio="'.$this->municipio.'",barrio="'.$this->barrio.'",direccion="'.$this->direccion.'", telefono="'.$this->telefono.'", email="'.$this->email.'", observaciones="'.$this->observaciones.'", clase_regimen="'.$this->clase_regimen.'",retiene_fuente="'.$this->retiene_fuente.'",gran_contribuyente="'.$this->gran_contribuyente.'",retiene_ica="'.$this->retiene_ica.'", vendedor="'.$this->vendedor.'", estado="'.$this->estado.'" WHERE documento="'.$documento.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function cambiarIdCliente($documento){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_clientes set tipo_documento="'.$this->tipo_documento.'", documento="'.$this->documento.'", dv="'.$this->dv.'" WHERE documento="'.$documento.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	
	public function activarDesactivarCliente($valor, $documento){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_clientes set estado="'.$valor.'" where documento="'.$documento.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
}
?>