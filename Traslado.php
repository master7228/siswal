<?php
include_once 'Conexion.php';

class Traslado{
	
	public $id;
	public $bodega_ant;
	public $bodega_act;
	public $ref_equipo;
	public $nom_equipo;
	public $fecha;
	
	function Traslado($id="",$bodega_ant="",$bodega_act="",$ref_equipo="",$nom_equipo="",$fecha=""){
		$this->id = $id;
		$this->bodega_ant=$bodega_ant;
		$this->bodega_act = $bodega_act;
		$this->ref_equipo = $ref_equipo;
		$this->nom_equipo = $nom_equipo;
		$this->fecha = $fecha;
	}
	
	function guardarTraslado(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = "INSERT INTO tb_traslado (id,bodega_ant,bodega_act, ref_equipo, nom_equipo, fecha) VALUES ('','".$this->bodega_ant."','".$this->bodega_act."','".$this->ref_equipo."','".$this->nom_equipo."','".$this->fecha."')";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->consultar($sql);
		$conn->liberarConsulta();
		$conn->desconectar();
		return $resp;
	}
	
	public function consultarUltimoId(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "select id from tb_traslado order by id DESC limit 1";
		$consul=$con->consultar($sql);
		if ($row = mysql_fetch_row($consul)) {
			$id = $row[0];
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $id;
	
	}
}
?>