<?php
require_once 'Conexion.php';

class ContactoObra{
	
	public $id;
	public $id_obra;
	public $nombre;
	public $cargo;
	public $telefono;
	public $celular;
	public $email;
	public $fecha_nacimiento;
	public $profesion;
	public $estado;
	
	public function ContactoObra($id, $id_obra, $nombre, $cargo, $telefono, $celular, $email, $fecha_nacimiento, $profesion, $estado){
		$this->id=$id;
		$this->id_obra=trim($id_obra);
		$this->nombre=trim($nombre);
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
		$sql= "insert into tb_contactos_obras (id, id_obra, nombre, cargo, telefono, celular, email, fecha_nacimiento, profesion, estado) values ('','".$this->id_obra."','".$this->nombre."','".$this->cargo."','".$this->telefono."','".$this->celular."','".$this->email."','".$this->fecha_nacimiento."','".$this->profesion."','1')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function buscarContacto($id_obra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($id_obra == "*"){
			$sql = "SELECT * from tb_contactos_obras ";
		}else{
			$sql = "SELECT * from tb_contactos_obras WHERE id_obra = '".$id_obra."'";
		}
		$contactos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$contactos[$cont] = new ContactoObra($datos['id'],$datos['id_obra'],$datos['nombre'],$datos['cargo'],$datos['telefono'],$datos['celular'],$datos['email'],$datos['fecha_nacimiento'],$datos['profesion'],$datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $contactos;
	}
	public function buscarContactoRemision($id_obra,$contacto){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql = "SELECT * from tb_contactos_obras WHERE id_obra = '".$id_obra."' and id='".$contacto."'";
		$contactos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$contactos[$cont] = new ContactoObra($datos['id'],$datos['id_obra'],$datos['nombre'],$datos['cargo'],$datos['telefono'],$datos['celular'],$datos['email'],$datos['fecha_nacimiento'],$datos['profesion'],$datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $contactos;
	}
	public function buscarContactoActivado($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($id == "*"){
			$sql = "SELECT * from tb_contactos_obras ";
		}else{
			$sql = "SELECT * from tb_contactos_obras WHERE id_obra = '".$id."' and estado='1' ";
		}
		$contactos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$contactos[$cont] = new ContactoObra($datos['id'],$datos['id_obra'],$datos['nombre'],$datos['cargo'],$datos['telefono'],$datos['celular'],$datos['email'],$datos['fecha_nacimiento'],$datos['profesion'],$datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $contactos;
	}
	public function buscarContactoId($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql = "SELECT * from tb_contactos_obras WHERE id = '".trim($id)."'";
		$contactos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$contactos[$cont] = new ContactoObra($datos['id'],$datos['id_obra'],$datos['nombre'],$datos['cargo'],$datos['telefono'],$datos['celular'],$datos['email'],$datos['fecha_nacimiento'],$datos['profesion'],$datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $contactos;
	}
	
	public function editarContacto($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_contactos_obras set nombre="'.$this->nombre.'", cargo="'.$this->cargo.'", telefono="'.$this->telefono.'",celular="'.$this->celular.'", email="'.$this->email.'",fecha_nacimiento="'.$this->fecha_nacimiento.'", profesion="'.$this->profesion.'", estado="'.$this->estado.'" WHERE id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function activarDesactivarContacto($valor, $id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_contactos_obras set estado="'.$valor.'" where id="'.$id.'"';
		//echo $sql;
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	function getContactos($idobra){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "SELECT * FROM tb_contactos_obras where id_obra='".$idobra."' order by nombre";
		$resp = $conn->consultar($sql);
		$obras = array(); 
		$i = 0;
		while($datos = @mysql_fetch_array($resp)){
			$obras[$i] = $datos[0];
			$i++;
			$obras[$i] = $datos[2];
			$i++;
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $obras;
	}

}
?>