<?php
require_once 'Conexion.php';

class ContactoBodega{
	
	public $id;
	public $id_bodega;
	public $documento;
	public $nombre;
	public $cargo;
	public $telefono;
	public $email;
	public $estado;
	
	public function ContactoBodega($id, $id_bodega,$documento, $nombre, $cargo, $telefono, $email,$estado){
		$this->id=$id;
		$this->id_bodega=trim($id_bodega);
		$this->documento=trim($documento);
		$this->nombre=trim($nombre);
		$this->cargo=trim($cargo);
		$this->telefono=trim($telefono);
		$this->email=($email);
		$this->estado=$estado;
	}
	
	public function guardarContacto(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "insert into tb_contactos_bodega (id, id_bodega,documento, nombre, cargo, telefono, email, estado) values ('','".$this->id_bodega."','".$this->documento."','".$this->nombre."','".$this->cargo."','".$this->telefono."','".$this->email."','".$this->estado."')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function buscarContacto($id_bodega){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($id_bodega == "*"){
			$sql = "SELECT * from tb_contactos_bodega ";
		}else{
			$sql = "SELECT * from tb_contactos_bodega WHERE id_bodega = '".trim($id_bodega)."'";
		}
		$contactos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$contactos[$cont] = new ContactoBodega($datos['id'],$datos['id_bodega'],$datos['documento'],$datos['nombre'],$datos['cargo'],$datos['telefono'],$datos['email'],$datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $contactos;
	}
	
	public function buscarContactoId($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql = "SELECT * from tb_contactos_bodega WHERE id = '".$id."'";
		$contactos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$contactos[$cont] = new ContactoBodega($datos['id'],$datos['id_bodega'],$datos['documento'],$datos['nombre'],$datos['cargo'],$datos['telefono'],$datos['email'],$datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $contactos;
	}
	
	public function editarContacto($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_contactos_bodega set nombre="'.$this->nombre.'",documento="'.$this->documento.'", cargo="'.$this->cargo.'", email="'.$this->email.'",telefono="'.$this->telefono.'", estado="'.$this->estado.'" WHERE id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function cambiarIdBodegaContacto($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_contactos_Bodega set id_bodega="'.$this->id_bodega.'" WHERE id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	public function activarDesactivarContacto($valor, $id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_contactos_bodega set estado="'.$valor.'" where id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}

}
?>