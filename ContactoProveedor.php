<?php
require_once 'Conexion.php';

class ContactoProveedor{
	
	public $id;
	public $id_proveedor;
	public $documento;
	public $nombre;
	public $cargo;
	public $telefono;
	public $celular;
	public $email;
	public $fecha_nacimiento;
	public $profesion;
	public $estado;
	
	public function ContactoProveedor($id, $id_proveedor,$documento, $nombre, $cargo, $telefono, $celular, $email, $fecha_nacimiento, $profesion, $estado){
		$this->id=$id;
		$this->id_proveedor=trim($id_proveedor);
		$this->documento=trim($documento);
		$this->nombre=trim($nombre);
		$this->cargo=trim($cargo);
		$this->telefono=trim($telefono);
		$this->celular=trim($celular);
		$this->email=($email);
		$this->fecha_nacimiento=$fecha_nacimiento;
		$this->profesion=trim($profesion);
		$this->estado=$estado;
	}
	
	public function guardarContacto(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "insert into tb_contactos_proveedor (id, id_proveedor,documento, nombre, cargo, telefono, celular, email, fecha_nacimiento, profesion, estado) values ('','".$this->id_proveedor."','".$this->documento."','".$this->nombre."','".$this->cargo."','".$this->telefono."','".$this->celular."','".$this->email."','".$this->fecha_nacimiento."','".$this->profesion."','1')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function buscarContacto($id_proveedor){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($id_proveedor == "*"){
			$sql = "SELECT * from tb_contactos_proveedor";
		}else{
			$sql = "SELECT * from tb_contactos_proveedor WHERE id_proveedor = '".trim($id_proveedor)."'";
		}
		$contactos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$contactos[$cont] = new ContactoProveedor($datos['id'],$datos['id_proveedor'],$datos['documento'],$datos['nombre'],$datos['cargo'],$datos['telefono'],$datos['celular'],$datos['email'],$datos['fecha_nacimiento'],$datos['profesion'],$datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $contactos;
	}
	
	public function buscarContactoId($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql = "SELECT * from tb_contactos_proveedor WHERE id = '".$id."'";
		$contactos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$contactos[$cont] = new ContactoProveedor($datos['id'],$datos['id_proveedor'],$datos['documento'],$datos['nombre'],$datos['cargo'],$datos['telefono'],$datos['celular'],$datos['email'],$datos['fecha_nacimiento'],$datos['profesion'],$datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $contactos;
	}
	
	public function editarContacto($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_contactos_proveedor set nombre="'.$this->nombre.'",documento="'.$this->documento.'", cargo="'.$this->cargo.'", telefono="'.$this->telefono.'",telefono="'.$this->celular.'", email="'.$this->email.'",fecha_nacimiento="'.$this->fecha_nacimiento.'", profesion="'.$this->profesion.'", estado="'.$this->estado.'" WHERE id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function cabiarIdProveedorContacto($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_contactos_proveedor set id_proveedor="'.$this->id_proveedor.'" WHERE id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function activarDesactivarContacto($valor, $id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_contactos_proveedor set estado="'.$valor.'" where id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}

}
?>