<?php
class Conexion{
	public $ubicacion_servidor="localhost";
	public $puerto='3306';
	public $login="root";
	public $password="";
	public $nombre_bd="db_siswalmega";
	public $respuesta;
	public $conn;
	
	function Conexion(){
		//echo "<br>Clase Conexion creada ".$this->ubicacion_servidor." ".$this->login." ".$this->password;
	}
	
	function conectar(){
		$this->conn = @mysql_connect($this->ubicacion_servidor,$this->login,$this->password);
		@mysql_select_db($this->nombre_bd, $this->conn); 
	}
	
	function desconectar(){
		@mysql_close($this->conn);
	}
	
	function liberarConsulta(){
    	@mysql_free_result($this->respuesta);
  	}
	
	function consultar($ssql){
		$this->respuesta = @mysql_query($ssql); 
		return $this->respuesta;
	}

}
?>