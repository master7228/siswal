<?php
require_once 'Conexion.php';

class EquipoDevolucionSub{
	
	public $id;
	public $id_devolucion;
	public $id_equipo;
	public $cantidad;
	public $id_usuario;
	
	public function EquipoDevolucionSub($id="", $id_devolucion="", $id_equipo="",$cantidad="",$id_usuario=""){
		$this->id=trim($id);
		$this->id_devolucion=trim($id_devolucion);
		$this->id_equipo=trim($id_equipo);
		$this->cantidad=trim($cantidad);
		$this->id_usuario=trim($id_usuario);
		
	}
	
	public function guardarEquipoDevolucionSub(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "insert into tb_equipo_sub_dev(id, id_devolucion, id_equipo, cantidad, id_usuario) values ('','".$this->id_devolucion."','".$this->id_equipo."','".$this->cantidad."','".$this->id_usuario."')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	public function buscarEquiposSubDev($idusuario){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql = "SELECT * from tb_equipo_sub_dev where id_usuario='".$idusuario."'";
		$equipos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$equipos[$cont] = new EquipoDevolucionSub($datos['id'],$datos['id_devolucion'],$datos['id_equipo'],$datos['cantidad'],$datos['id_usuario']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $equipos;
	}

	public function buscarEquiposSubDevEst($id_devolucion,$id_equipo){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql = "SELECT * from tb_equipo_sub_dev where id_devolucion='".$id_devolucion."' and id_equipo='".$id_equipo."'";
		$equipos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$equipos[$cont] = new EquipoDevolucionSub($datos['id'],$datos['id_devolucion'],$datos['id_equipo'],$datos['cantidad'],$datos['id_usuario']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $equipos;
	}
	
	public function eliminar_equipo_SubDev($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'DELETE FROM tb_equipo_sub_dev where id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
}
?>