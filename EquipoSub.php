<?php
require_once 'Conexion.php';

class EquipoSub{
	
	public $id;
	public $electromecanico;
	public $referencia;
	public $nombre;
	public $cantidad;
	
	public function EquipoSub($id="", $electromecanico="",$referencia="",$nombre="", $cantidad=""){
		$this->id=trim($id);
		$this->electromecanico=trim($electromecanico);
		$this->referencia=trim($referencia);
		$this->nombre=trim($nombre);
		$this->cantidad=trim($cantidad);
	}
	
	public function guardarEquipoSub(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "insert into tb_equipo_sub (id, electromecanico, referencia, nombre, cantidad) values ('','".$this->electromecanico."','".$this->referencia."','".$this->nombre."','".$this->cantidad."')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	public function editarEquipoSub($idref){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_equipo_sub set electromecanico="'.$this->electromecanico.'", referencia="'.$this->referencia.'", nombre="'.$this->nombre.'", cantidad="'.$this->cantidad.'" WHERE referencia="'.$idref.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
    public function buscarEquipoSubSel($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_equipo_sub";
		}else{
			$sql = "SELECT * from tb_equipo_sub WHERE ".trim($select)." LIKE '%".trim($palabra)."%'";
		
		/*$sql="select tb_equipo_sub.id, tb_equipo_sub.referencia, tb_equipo_sub.nombre, tb_entrada_sub.cantidad
              from tb_equipo_sub inner join tb_entrada_sub on tb_equipo_sub.id=tb_entrada_sub.id_nomsub
              where tb_equipo_sub. ".trim($select)." LIKE '%".trim($palabra)."%'";*/
		}
		$equipos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$equipos[$cont] = new EquipoSub($datos['id'],$datos['electromecanico'],$datos['referencia'],$datos['nombre'],$datos['cantidad']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		//echo $sql;
		return $equipos;
	}
	public function buscarEquipoSubSel1($select,$palabra,$id_usuario){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_equipo_sub";
		}else{
			//$sql = "SELECT * from tb_equipo_sub WHERE ".trim($select)." LIKE '%".trim($palabra)."%'";
		
		$sql="select tb_equipo_sub.id, tb_equipo_sub.referencia, tb_equipo_sub.nombre, tb_entrada_sub.cantidad
              from tb_equipo_sub inner join tb_entrada_sub on tb_equipo_sub.id=tb_entrada_sub.id_nomsub
              where tb_equipo_sub.".trim($select)." LIKE '%".trim($palabra)."%' and tb_equipo_sub.id_usuario='".$id_usuario."'";
		}
		$equipos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$equipos[$cont] = new EquipoSub($datos['id'],$datos['electromecanico'],$datos['referencia'],$datos['nombre'],$datos['cantidad'],$datos['transaccion']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $equipos;
	}
	public function cambiarEstadoEquipoSub($valor, $id,$id_usuario){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_equipo_sub set transaccion="'.$valor.'", id_usuario="'.$id_usuario.'" where id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	public function cambiarEstadoEquipoSub1($valor, $id_usuario){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_equipo_sub set transaccion="'.$valor.'", id_usuario="0" where id_usuario="'.$id_usuario.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	public function buscarEquipoSub($ID){
		$con= new Conexion();
		$conectar=$con->conectar();
		//if($select == "*"){
			//$sql = "SELECT * from tb_equipo_sub ";
		//}else{
			$sql = "SELECT * from tb_equipo_sub WHERE id='".trim($ID)."'";
		//}
		$equipos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$equipos[$cont] = new EquipoSub($datos['id'],$datos['electromecanico'],$datos['referencia'],$datos['nombre'],$datos['cantidad']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $equipos;
	}
	
	public function EliminarEquipoSubRem($id_remision,$id_equipo_sub){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "delete from tb_equipo_sub_rem where id_remision=".trim($id_remision)." and id_equipo_sub=".trim($id_equipo_sub)."";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
}
?>