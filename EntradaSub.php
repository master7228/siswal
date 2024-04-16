<?php
require_once 'Conexion.php';

class EntradaSub{
	
	public $id;
	public $id_nomsub;
	public $nombre;
	public $id_bodega;
	public $fecha;
	public $cantidad;
	public $id_usuario;
	
	public function EntradaSub($id, $id_nomsub, $nombre, $id_bodega, $fecha, $cantidad, $id_usuario){
		$this->id=$id;
		$this->id_nomsub=trim($id_nomsub);
		$this->nombre=trim($nombre);
		$this->id_bodega=trim($id_bodega);
		$this->fecha=trim($fecha);
		$this->cantidad=trim($cantidad);
 	    $this->id_usuario=trim($id_usuario);
		
	}
	
	public function guardarEntradaSub(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "insert into tb_entrada_sub (id, id_nomsub, nombre, id_bodega, fecha, cantidad, id_usuario) values ('','".$this->id_nomsub."','".$this->nombre."','".$this->id_bodega."','".$this->fecha."','".$this->cantidad."','".$this->id_usuario."')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	public function EliminarEntradaSub($id_usuario,$id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "delete from tb_entrada_sub where id_usuario=".trim($id_usuario)." and id=".trim($id)." and remisionado='0'";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	public function EliminarEntradaSub1($id_usuario){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "delete from tb_entrada_sub where id_usuario=".trim($id_usuario)." and remisionado='0'";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	public function EliminarEntradaSub2($id_usuario,$id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "delete from tb_entrada_sub where id_usuario=".trim($id_usuario)." and id=".trim($id)." and remisionado='1'";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	public function EliminarEntradaSubedit($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "delete from tb_entrada_sub where id=".trim($id)."";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	    public function buscarEquiposSub($id_usuario){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql = "SELECT * from tb_entrada_sub where id_usuario=".trim($id_usuario)." AND remisionado='0'";
		$equiposSub = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$equiposSub[$cont] = new EntradaSub($datos['id'],$datos['id_nomsub'],$datos['nombre'],$datos['id_bodega'],$datos['fecha'],$datos['cantidad'],$datos['id_usuario']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $equiposSub;
	}
	public function existeListado($id_nomsub,$id_usuario){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "select * from tb_entrada_sub where id_nomsub='".$id_nomsub."' and id_usuario='".$id_usuario."' and remisionado='0'";
		$consul=$con->consultar($sql);
		$num_rows = mysql_num_rows($consul);
		$con->liberarConsulta();
		$con->desconectar();
		return $num_rows;
	}
	public function cambiarEquiporemisionsub($remisionado,$id,$id_usuario){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_entrada_sub set remisionado='.$remisionado.' where id='.$id.' and id_usuario='.$id_usuario.'';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	public function buscarequipoEntrada($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_entrada_sub";
		}else{
			$sql = "SELECT * from tb_entrada_sub WHERE ".trim($select)." LIKE '".trim($palabra)."'";
		
		}
		$equipos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$equipos[$cont] = new EntradaSub($datos['id'],$datos['id_nomsub'],$datos['nombre'],$datos['id_bodega'],$datos['fecha'],$datos['cantidad'],$datos['id_usuario'],$datos['remisionado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $equipos;
	}
}
?>