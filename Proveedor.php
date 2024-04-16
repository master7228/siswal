<?php
require_once 'Conexion.php';

class Proveedor{
	
	public $id;
	public $tipo_documento;
	public $documento;
	public $dv;
	public $nombre1;
	public $nombre2;
	public $apellido1;
	public $apellido2;
	public $pais;
	public $departamento;
	public $direccion;
	public $municipio;
	public $barrio;
	public $telefono;
	public $email;
	public $observaciones;
	public $fecha_creacion;	
	public $estado;
	public $clase_regimen;
	public $retenedor;
	public $iva;
	
	public function Proveedor($id, $tipo_documento, $documento, $dv, $nombre1, $nombre2, $apellido1, $apellido2,$pais, $departamento,$direccion, $municipio, $barrio, $telefono, $email, $observaciones, $fecha_creacion, $estado, $clase_regimen, $retenedor, $iva){
		$this->id=$id;
		$this->tipo_documento=$tipo_documento;
		$this->documento=trim($documento);
		$this->dv=$dv;
		$this->nombre1=trim($nombre1);
		$this->nombre2=trim($nombre2);
		$this->apellido1=trim($apellido1);
		$this->apellido2=trim($apellido2);
		$this->pais=$pais;
		$this->departamento=$departamento;
		$this->direccion=trim($direccion);
		$this->municipio=$municipio;
		$this->barrio=trim($barrio);
		$this->telefono=trim($telefono);
		$this->email=trim($email);
		$this->observaciones=trim($observaciones);
		$this->fecha_creacion=$fecha_creacion;
		$this->estado=$estado;
		$this->clase_regimen=$clase_regimen;
		$this->retenedor=$retenedor;
		$this->iva=$iva;
		
	}
	
	public function guardarProveedor(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "insert into tb_proveedor (id, tipo_documento, documento, dv, nombre1, nombre2, apellido1, apellido2, pais, departamento, direccion, municipio, barrio,  telefono, email, observaciones, fecha_creacion, estado, clase_regimen, retenedor, iva) values ('','".$this->tipo_documento."','".$this->documento."','".$this->dv."','".$this->nombre1."','".$this->nombre2."','".$this->apellido1."','".$this->apellido2."','".$this->pais."','".$this->departamento."','".$this->direccion."','".$this->municipio."','".$this->barrio."','".$this->telefono."','".$this->email."','".$this->observaciones."','".$this->fecha_creacion."','".$this->estado."','".$this->clase_regimen."','".$this->retenedor."','".$this->iva."')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function existeProveedor(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "select * from tb_proveedor where documento='".$this->documento."'";
		$consul=$con->consultar($sql);
		$num_rows = mysql_num_rows($consul);
		$con->liberarConsulta();
		$con->desconectar();
		return $num_rows;
	}
	
	
	public function buscarProveedor($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_proveedor ORDER BY fecha_creacion DESC ";
		}else{
			$sql = "SELECT * from tb_proveedor WHERE ".trim($select)." LIKE '%".trim($palabra)."%' ORDER BY fecha_creacion DESC";
		}
		$proveedores = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$proveedores[$cont] = new Proveedor($datos['id'],$datos['tipo_documento'],$datos['documento'],$datos['dv'],$datos['nombre1'],$datos['nombre2'],$datos['apellido1'],$datos['apellido2'],$datos['pais'],$datos['departamento'],$datos['direccion'],$datos['municipio'],$datos['barrio'],$datos['telefono'],$datos['email'],$datos['observaciones'],$datos['fecha_creacion'],$datos['estado'],$datos['clase_regimen'],$datos['retenedor'],$datos['iva']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $proveedores;
	}
	
	public function buscarProveedor1($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_proveedor ORDER BY fecha_creacion DESC ";
		}else{
			$sql = "SELECT * from tb_proveedor WHERE ".$select." = '".$palabra."'";
		}
		$proveedores = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$proveedores[$cont] = new Proveedor($datos['id'],$datos['tipo_documento'],$datos['documento'],$datos['dv'],$datos['nombre1'],$datos['nombre2'],$datos['apellido1'],$datos['apellido2'],$datos['pais'],$datos['departamento'],$datos['direccion'],$datos['municipio'],$datos['barrio'],$datos['telefono'],$datos['email'],$datos['observaciones'],$datos['fecha_creacion'],$datos['estado'],$datos['clase_regimen'],$datos['retenedor'],$datos['iva']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $proveedores;
	}
	
	public function editarProveedor($documento){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_proveedor set nombre1="'.$this->nombre1.'",nombre2="'.$this->nombre2.'", apellido1="'.$this->apellido1.'",apellido2="'.$this->apellido2.'",pais="'.$this->pais.'",departamento="'.$this->departamento.'",direccion="'.$this->direccion.'",municipio="'.$this->municipio.'",barrio="'.$this->barrio.'",telefono="'.$this->telefono.'", email="'.$this->email.'", observaciones="'.$this->observaciones.'", estado="'.$this->estado.'",clase_regimen="'.$this->clase_regimen.'", retenedor="'.$this->retenedor.'", iva="'.$this->iva.'" WHERE documento="'.$documento.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function cambiarIdProveedor($documento){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_proveedor set tipo_documento="'.$this->tipo_documento.'", documento="'.$this->documento.'", dv="'.$this->dv.'" WHERE documento="'.$documento.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	
	public function activarDesactivarProveedor($valor, $documento){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_proveedor set estado="'.$valor.'" where documento="'.$documento.'"';
		//echo $sql;
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
}
?>