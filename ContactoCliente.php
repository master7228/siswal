<?php
require_once 'Conexion.php';

class ContactoCliente{
	
	public $id;
	public $id_cliente;
	public $nombre;
	public $documento;
	public $cargo;
	public $telefono;
	public $celular;
	public $email;
	public $fecha_nacimiento;
	public $profesion;
	public $estado;
	
	
	public function ContactoCliente($id, $id_cliente, $nombre, $documento, $cargo, $telefono, $celular, $email, $fecha_nacimiento, $profesion, $estado){
		$this->id=trim($id);
		$this->id_cliente=trim($id_cliente);
		$this->nombre=trim($nombre);
		$this->documento=trim($documento);
		$this->cargo=trim($cargo);
		$this->telefono=trim($telefono);
		$this->celular=trim($celular);
		$this->email=trim($email);
		$this->fecha_nacimiento=$fecha_nacimiento;
		$this->profesion=trim($profesion);
		$this->estado=$estado;		
	}
	
	public function guardarContacto(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "insert into tb_contactos_clientes (id, id_cliente, nombre, documento, cargo, telefono, celular, email, fecha_nacimiento, profesion, estado) values ('','".$this->id_cliente."','".$this->nombre."','".$this->documento."','".$this->cargo."','".$this->telefono."','".$this->celular."','".$this->email."','".$this->fecha_nacimiento."','".$this->profesion."','1')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function buscarContacto($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($id == "*"){
			$sql = "SELECT * from tb_contactos_clientes ";
		}else{
			$sql = "SELECT * from tb_contactos_clientes WHERE id_cliente = '".$id."'";
		}
		$contactos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$contactos[$cont] = new ContactoCliente($datos['id'],$datos['id_cliente'],$datos['nombre'],$datos['documento'],$datos['cargo'],$datos['telefono'],$datos['celular'],$datos['email'],$datos['fecha_nacimiento'],$datos['profesion'],$datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $contactos;
	}
	
	public function buscarContactoId($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql = "SELECT * from tb_contactos_clientes WHERE id = '".$id."'";
		$contactos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$contactos[$cont] = new ContactoCliente($datos['id'],$datos['id_cliente'],$datos['nombre'],$datos['documento'],$datos['cargo'],$datos['telefono'],$datos['celular'],$datos['email'],$datos['fecha_nacimiento'],$datos['profesion'],$datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $contactos;
	}
	
	public function editarContacto($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_contactos_clientes set nombre="'.$this->nombre.'", documento="'.$this->documento.'", cargo="'.$this->cargo.'", telefono="'.$this->telefono.'",celular="'.$this->celular.'", email="'.$this->email.'",fecha_nacimiento="'.$this->fecha_nacimiento.'", profesion="'.$this->profesion.'", estado="'.$this->estado.'" WHERE id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
		echo $sql;
	}
	
	public function cambiarIdClienteContacto($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_contactos_clientes set id_cliente="'.$this->id_cliente.'" WHERE id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function activarDesactivarContacto($valor, $id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_contactos_clientes set estado="'.$valor.'" where id="'.$id.'"';
		//echo $sql;
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}

}
?>