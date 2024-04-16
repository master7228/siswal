<?php
require_once 'Conexion.php';

class Usuario{
	
	public $id;
	public $id_grupo_usuarios;
	public $tipo_doc;
	public $documento_identidad;
	public $nombres;
	public $apellidos;
	public $email;
	public $telefono;
	public $celular;
	public $password;
	public $creado;
	public $modificado;
	public $estado;
	
	
	public function Usuario($id, $id_grupo_usuarios, $tipo_doc, $documento_identidad, $nombres, $apellidos, $email, $telefono,$celular, $password, $creado, $modificado, $estado){
		$this->id=trim($id);
		$this->id_grupo_usuarios=trim($id_grupo_usuarios);
		$this->tipo_doc=trim($tipo_doc);
		$this->documento_identidad=trim($documento_identidad);
		$this->nombres=trim($nombres);
		$this->apellidos=trim($apellidos);
		$this->email=trim($email);
		$this->telefono=trim($telefono);
		$this->celular=trim($celular);
		$this->password=trim($password);
		$this->creado=trim($creado);
		$this->modificado=trim($modificado);
		$this->estado=trim($estado);
		
	}
	
	function autenticar(){
		$sql = "SELECT * FROM tb_usuarios WHERE documento_identidad  = '".$this->documento_identidad."' && pass = md5('".$this->password."') ";
		//echo "<br>SQL: ".$sql;
		$r = 0;
		$con = new Conexion();
		$con->conectar();
        $usuarios = array();
		$cont = 0;
		$resp = $con->consultar($sql);
                while ($datos = @mysql_fetch_array($resp)){
			$usuarios[$cont] = new Usuario($datos['id'],$datos['id_grupo_usuarios'],$datos['tipo_doc'],$datos['documento_identidad'],$datos['nombres'],$datos['apellidos'],$datos['email'],$datos['telefono'],$datos['celular'],$datos['pass'],$datos['creado'],$datos['modificado'],$datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $usuarios;
	}
	
	function autenticarPermiso($documento){
		$sql = "SELECT estado FROM tb_usuarios WHERE documento_identidad='".$documento."'";
		$con = new Conexion();
		$con->conectar();
		$resp = mysql_fetch_array($con->consultar($sql));
		$con->liberarConsulta();
		$con->desconectar();
		return $resp;
	}
	
	
	
	public function guardarUsuario(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "insert into tb_usuarios (id, id_grupo_usuarios, tipo_doc, documento_identidad, nombres, apellidos, email, telefono, celular, pass, creado, modificado, estado) values ('','".$this->id_grupo_usuarios."','".$this->tipo_doc."','".$this->documento_identidad."','".$this->nombres."','".$this->apellidos."','".$this->email."','".$this->telefono."','".$this->celular."',md5('".$this->password."'),'".$this->creado."','".$this->modificado."','".$this->estado."')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function existeUsuario(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "select * from tb_usuarios where documento_identidad='".$this->documento_identidad."'";
		$consul=$con->consultar($sql);
		$num_rows = mysql_num_rows($consul);
		$con->liberarConsulta();
		$con->desconectar();
		return $num_rows;
	}
	
	
	public function buscarUsuario($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_usuarios ";
		}else{
			$sql = "SELECT * from tb_usuarios WHERE ".trim($select)." LIKE '%".trim($palabra)."%'";
		}
		$usuarios = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$usuarios[$cont] = new Usuario($datos['id'],$datos['id_grupo_usuarios'],$datos['tipo_doc'],$datos['documento_identidad'],$datos['nombres'],$datos['apellidos'],$datos['email'],$datos['telefono'],$datos['celular'],$datos['pass'],$datos['creado'],$datos['modificado'],$datos['estado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $usuarios;
	}
	
	public function editarUsuario($doc_ant){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_usuarios set id_grupo_usuarios="'.$this->id_grupo_usuarios.'", tipo_doc="'.$this->tipo_doc.'", documento_identidad="'.$this->documento_identidad.'", nombres="'.$this->nombres.'", apellidos="'.$this->apellidos.'", email="'.$this->email.'", telefono="'.$this->telefono.'", celular="'.$this->celular.'", modificado="'.$this->modificado.'", estado="'.$this->estado.'" WHERE documento_identidad="'.$doc_ant.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	
	public function activarDesactivarUsuario($valor, $documento){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_usuarios set estado="'.$valor.'" where documento_identidad="'.$documento.'"';
		//echo $sql;
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function cambiarPassword($pass, $documento){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "UPDATE tb_usuarios set pass=md5('".trim($pass)."') where documento_identidad='".trim($documento)."'";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
}
?>