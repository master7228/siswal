<?php
require_once 'Conexion.php';

class Equipo{
	
	public $id;
	public $id_equipo_rel;
	public $electromecanico;
	public $bodega;
	public $referencia;
	public $nombre;
	public $cantidad;
	public $descripcion;
	public $minimo_dias;
	public $valor_dia;
	public $minimo_horas;
	public $valor_hora;
	public $minimo_metros;
	public $valor_metro;
	public $fecha_compra;
	public $id_proveedor;
	public $id_grupo;
	public $id_familia;
	public $id_clase;
	public $si_operador;
	public $no_operador;
	public $observaciones;
	public $estado;
	public $transaccion;
	public $valor_equipo_compra;
	public $id_usuario;
	public $remisionado;
	
	public function Equipo($id="", $id_equipo_rel="", $electromecanico="",$bodega="", $referencia="", $nombre="", $cantidad="", $descripcion="", $minimo_dias="", $valor_dia="", $minimo_horas="", $valor_hora="",$minimo_metros="", $valor_metro="", $fecha_compra="", $id_proveedor="", $id_grupo="", $id_familia="", $id_clase="", $si_operador="", $no_operador="", $observaciones="", $estado="", $transaccion="", $valor_equipo_compra="",$id_usuario="",$remisionado=""){
		$this->id=trim($id);
		$this->id_equipo_rel=trim($id_equipo_rel);
		$this->electromecanico=trim($electromecanico);
		$this->bodega=trim($bodega);
		$this->referencia=trim($referencia);
		$this->nombre=trim($nombre);
		$this->cantidad=trim($cantidad);
		$this->descripcion=trim($descripcion);
		$this->minimo_dias=trim($minimo_dias);
		$this->valor_dia=trim($valor_dia);
		$this->minimo_horas=trim($minimo_horas);
		$this->valor_hora=trim($valor_hora);
		$this->minimo_metros=trim($minimo_metros);
		$this->valor_metro=trim($valor_metro);
		$this->fecha_compra=trim($fecha_compra);
		$this->id_proveedor=trim($id_proveedor);
		$this->id_grupo=trim($id_grupo);
		$this->id_familia=trim($id_familia);
		$this->id_clase=trim($id_clase);
		$this->si_operador=trim($si_operador);
		$this->no_operador=trim($no_operador);
		$this->observaciones=trim($observaciones);
		$this->estado=$estado;
		$this->transaccion=trim($transaccion);
		$this->valor_equipo_compra=trim($valor_equipo_compra);
		$this->id_usuario=trim($id_usuario);
		$this->remisionado=trim($remisionado);
		
	}
	
	public function guardarEquipo(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "insert into tb_equipo (id, id_equipo_rel, electromecanico, bodega, referencia, nombre, cantidad, descripcion, minimo_dias, valor_dia, minimo_horas, valor_hora, minimo_metros, valor_metro, fecha_compra, id_proveedor, id_grupo, id_familia, id_clase, si_operador, no_operador, observaciones, estado, transaccion, valor_equipo_compra,id_usuario,remisionado) values ('','".$this->id_equipo_rel."','".$this->electromecanico."','".$this->bodega."','".$this->referencia."','".$this->nombre."','".$this->cantidad."','".$this->descripcion."','".$this->minimo_dias."','".$this->valor_dia."','".$this->minimo_horas."','".$this->valor_hora."','".$this->minimo_metros."','".$this->valor_metro."','".$this->fecha_compra."','".$this->id_proveedor."','".$this->id_grupo."','".$this->id_familia."','".$this->id_clase."','".$this->si_operador."','".$this->no_operador."','".$this->observaciones."','".$this->estado."','".$this->transaccion."','".$this->valor_equipo_compra."','".$this->id_usuario."','".$this->remisionado."')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function existeEquipo(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "select * from tb_equipo where referencia='".$this->referencia."'";
		$consul=$con->consultar($sql);
		$num_rows = mysql_num_rows($consul);
		$con->liberarConsulta();
		$con->desconectar();
		return $num_rows;
	}
	
	public function consultarUltimoId(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "select id from tb_equipo order by id DESC limit 1";
		$consul=$con->consultar($sql);
		if ($row = mysql_fetch_row($consul)) {
			$id = $row[0];
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $id;
	
	}
	
	public function buscarEquipo($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_equipo ";
		}else{
			$sql = "SELECT * from tb_equipo WHERE ".trim($select)." = '".trim($palabra)."'";
		}
		$equipos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$equipos[$cont] = new Equipo($datos['id'],$datos['id_equipo_rel'],$datos['electromecanico'],$datos['bodega'],$datos['referencia'],$datos['nombre'],$datos['cantidad'],$datos['descripcion'],$datos['minimo_dias'],$datos['valor_dia'],$datos['minimo_horas'],$datos['valor_hora'],$datos['minimo_metros'],$datos['valor_metro'],$datos['fecha_compra'],$datos['id_proveedor'],$datos['id_grupo'],$datos['id_familia'],$datos['id_clase'],$datos['si_operador'],$datos['no_operador'],$datos['observaciones'],$datos['estado'],$datos['transaccion'],$datos['valor_equipo_compra']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $equipos;
	}
	public function buscarEquipoEditar($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_equipo ";
		}else{
			$sql = "SELECT * from tb_equipo WHERE ".trim($select)." LIKE '%".trim($palabra)."%' and transaccion='B'";
		}
		$equipos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$equipos[$cont] = new Equipo($datos['id'],$datos['id_equipo_rel'],$datos['electromecanico'],$datos['bodega'],$datos['referencia'],$datos['nombre'],$datos['cantidad'],$datos['descripcion'],$datos['minimo_dias'],$datos['valor_dia'],$datos['minimo_horas'],$datos['valor_hora'],$datos['minimo_metros'],$datos['valor_metro'],$datos['fecha_compra'],$datos['id_proveedor'],$datos['id_grupo'],$datos['id_familia'],$datos['id_clase'],$datos['si_operador'],$datos['no_operador'],$datos['observaciones'],$datos['estado'],$datos['transaccion'],$datos['valor_equipo_compra']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $equipos;
	}
	
	public function buscarEquipoDescontinuar($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_equipo ";
		}else{
			$sql = "SELECT * from tb_equipo WHERE ".trim($select)." LIKE '%".trim($palabra)."%' and estado='1'";
		}
		$equipos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$equipos[$cont] = new Equipo($datos['id'],$datos['id_equipo_rel'],$datos['electromecanico'],$datos['bodega'],$datos['referencia'],$datos['nombre'],$datos['cantidad'],$datos['descripcion'],$datos['minimo_dias'],$datos['valor_dia'],$datos['minimo_horas'],$datos['valor_hora'],$datos['minimo_metros'],$datos['valor_metro'],$datos['fecha_compra'],$datos['id_proveedor'],$datos['id_grupo'],$datos['id_familia'],$datos['id_clase'],$datos['si_operador'],$datos['no_operador'],$datos['observaciones'],$datos['estado'],$datos['transaccion'],$datos['valor_equipo_compra']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $equipos;
	}
	public function buscarEquipo1($select,$palabra,$id_usuario){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_equipo ";
		}else{
			$sql = "SELECT * from tb_equipo WHERE ".trim($select)." LIKE '%".trim($palabra)."%' and id_usuario='".$id_usuario."' and remisionado='0'";
		}
		$equipos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$equipos[$cont] = new Equipo($datos['id'],$datos['id_equipo_rel'],$datos['electromecanico'],$datos['bodega'],$datos['referencia'],$datos['nombre'],$datos['cantidad'],$datos['descripcion'],$datos['minimo_dias'],$datos['valor_dia'],$datos['minimo_horas'],$datos['valor_hora'],$datos['minimo_metros'],$datos['valor_metro'],$datos['fecha_compra'],$datos['id_proveedor'],$datos['id_grupo'],$datos['id_familia'],$datos['id_clase'],$datos['si_operador'],$datos['no_operador'],$datos['observaciones'],$datos['estado'],$datos['transaccion'],$datos['valor_equipo_compra']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $equipos;
	}
	public function buscarEquipoSel($select,$palabra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "SELECT * from tb_equipo WHERE ((transaccion='B' AND electromecanico='0' OR transaccion='B' AND electromecanico='1') OR (transaccion='T' AND electromecanico='0')) ORDER BY nombre ASC";
		}else{
			$sql = "SELECT * from tb_equipo WHERE ".trim($select)." LIKE '%".trim($palabra)."%' AND ((transaccion='B' AND electromecanico='0' OR transaccion='B' AND electromecanico='1') OR (transaccion='T' AND electromecanico='0')) ORDER BY nombre ASC";
		}
		$equipos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$equipos[$cont] = new Equipo($datos['id'],$datos['id_equipo_rel'],$datos['electromecanico'],$datos['bodega'],$datos['referencia'],$datos['nombre'],$datos['cantidad'],$datos['descripcion'],$datos['minimo_dias'],$datos['valor_dia'],$datos['minimo_horas'],$datos['valor_hora'],$datos['minimo_metros'],$datos['valor_metro'],$datos['fecha_compra'],$datos['id_proveedor'],$datos['id_grupo'],$datos['id_familia'],$datos['id_clase'],$datos['si_operador'],$datos['no_operador'],$datos['observaciones'],$datos['estado'],$datos['transaccion'],$datos['valor_equipo_compra'],$datos['id_usuario'],$datos['remisionado']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $equipos;
	}
	
	public function editarEquipo($ref){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_equipo set id_equipo_rel="'.$this->id_equipo_rel.'", electromecanico="'.$this->electromecanico.'", bodega="'.$this->bodega.'", referencia="'.$this->referencia.'", nombre="'.$this->nombre.'",cantidad="'.$this->cantidad.'", descripcion="'.$this->descripcion.'",minimo_dias="'.$this->minimo_dias.'", valor_dia="'.$this->valor_dia.'",minimo_horas="'.$this->minimo_horas.'",valor_hora="'.$this->valor_hora.'",minimo_metros="'.$this->minimo_metros.'",valor_metro="'.$this->valor_metro.'",fecha_compra="'.$this->fecha_compra.'", id_proveedor="'.$this->id_proveedor.'", id_grupo="'.$this->id_grupo.'", id_familia="'.$this->id_familia.'",id_clase="'.$this->id_clase.'",si_operador="'.$this->si_operador.'", no_operador="'.$this->no_operador.'", observaciones="'.$this->observaciones.'",estado="'.$this->estado.'", transaccion="'.$this->transaccion.'", valor_equipo_compra="'.$this->valor_equipo_compra.'" WHERE referencia="'.$ref.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function editarBodegaEquipo($bodega){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_equipo set bodega="'.$bodega.'" WHERE referencia="'.$this->referencia.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	
	public function activarDesactivarEquipo($valor, $id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_equipo set estado="'.$valor.'" where id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function cambiarEstadoEquipo($valor, $id,$id_usuario){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_equipo set transaccion="'.$valor.'",id_usuario="'.$id_usuario.'" where id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	public function cambiarEstadoEquipo1($valor, $id_usuario){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_equipo set transaccion="'.$valor.'",id_usuario="0" where id_usuario="'.$id_usuario.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	public function cambiarEstadoEquipo2($id){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_equipo set transaccion="B",id_usuario="0",remisionado="0" where id="'.$id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	public function guardarEquipoSelecionado($id,$electromecanico){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "insert into tb_equipo_seleccionado (id,electromecanico,referencia,nombre,cantidad,valor_dia,valor_hora,valor_metro) values ('".$id."','".$electromecanico."','".$this->referencia."','".$this->nombre."','".$this->cantidad."','".$this->valor_dia."','".$this->valor_hora."','".$this->valor_metro."')";
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function buscarEquipos(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql = "SELECT * from tb_equipo_seleccionado";
		$equipos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$equipos[$cont] = new Equipo($datos['id'],$datos['electromecanico'],$datos['bodega'],$datos['referencia'],$datos['nombre'],$datos['cantidad'],$datos['valor_dia'],$datos['valor_hora'],$datos['valor_metro']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $equipos;
	}
	public function cambiarCantidad($cantidad, $id,$id_usuario){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_equipo set cantidad=cantidad-'.$cantidad.' where id='.$id.' and id_usuario='.$id_usuario.'';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function cambiarCantidad1(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_equipo set cantidad=cantidad+'.$this->cantidad.' where id='.$this->id.'';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	public function cambiarCantidad2($cantidad){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_equipo set cantidad=cantidad-'.$cantidad.' where id='.$this->id.'';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	public function cambiarEquiporemision($remisionado, $id,$id_usuario){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_equipo set remisionado='.$remisionado.' where id='.$id.' and id_usuario='.$id_usuario.'';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	public function cambiarEquiporemision1($id_usuario){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tb_equipo set remisionado="0", transaccion="B", id_usuario="0" where id_usuario='.$id_usuario.' and electromecanico="0"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	public function buscarEquipoSelDevolucion($select,$palabra,$id_cliente,$id_obra){
		$con= new Conexion();
		$conectar=$con->conectar();
		if($select == "*"){
			$sql = "select tb_equipo.id, tb_equipo.id_equipo_rel, tb_equipo.electromecanico, tb_equipo.bodega, tb_equipo.referencia, 
					tb_equipo.nombre, tb_equipo_rem.cantidad, tb_equipo.descripcion, tb_equipo.minimo_dias, tb_equipo.valor_dia, 
					tb_equipo.minimo_horas, tb_equipo.valor_hora, tb_equipo.minimo_metros, tb_equipo.valor_metro, tb_equipo.fecha_compra, 
					tb_equipo.id_proveedor, tb_equipo.id_grupo, tb_equipo.id_familia, tb_equipo.id_clase, tb_equipo.si_operador, 
					tb_equipo.no_operador, tb_equipo.observaciones, tb_equipo.estado, tb_equipo.transaccion, tb_equipo.valor_equipo_compra, 
					tb_equipo.id_usuario, tb_equipo.remisionado from tb_remision 
				inner join tb_equipo_rem on tb_remision.id=tb_equipo_rem.id_remision
				inner join tb_equipo on tb_equipo_rem.id_equipo=tb_equipo.id
				where tb_remision.id_cliente=".trim($id_cliente)."
				and tb_remision.id_obra=".trim($id_obra)."";
		}
		else{
			$sql = "select tb_equipo.id, tb_equipo.id_equipo_rel, tb_equipo.electromecanico, tb_equipo.bodega, tb_equipo.referencia, 
					tb_equipo.nombre, tb_equipo_rem.cantidad, tb_equipo.descripcion, tb_equipo.minimo_dias, tb_equipo.valor_dia, 
					tb_equipo.minimo_horas, tb_equipo.valor_hora, tb_equipo.minimo_metros, tb_equipo.valor_metro, tb_equipo.fecha_compra, 
					tb_equipo.id_proveedor, tb_equipo.id_grupo, tb_equipo.id_familia, tb_equipo.id_clase, tb_equipo.si_operador, 
					tb_equipo.no_operador, tb_equipo.observaciones, tb_equipo.estado, tb_equipo.transaccion, tb_equipo.valor_equipo_compra, 
					tb_equipo.id_usuario, tb_equipo.remisionado from tb_remision 
				inner join tb_equipo_rem on tb_remision.id=tb_equipo_rem.id_remision
				inner join tb_equipo on tb_equipo_rem.id_equipo=tb_equipo.id
				where tb_remision.id_cliente=".trim($id_cliente)."
				and tb_remision.id_obra=".trim($id_obra)."
				and tb_equipo.".trim($select)." LIKE '%".trim($palabra)."%'";
				
		}
		$equipos = array();
		$cont = 0;
		$resp = $con->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$equipos[$cont] = new Equipo($datos['id'],$datos['id_equipo_rel'],$datos['electromecanico'],$datos['bodega'],$datos['referencia'],$datos['nombre'],$datos['cantidad']);
			$cont++;
		}
		$con->liberarConsulta();
		$con->desconectar();
		return $equipos;
	}
}
?>