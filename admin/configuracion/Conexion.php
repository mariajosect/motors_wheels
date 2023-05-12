<?php

class Conexion {

    protected $db;
    
    private $driver = "mysql";
    private $host = "localhost";
    private $bd = "motors_wheels";
    private $usuario = "root";
    private $contrasena = "";
    private $charset = "utf8";

    public function __construct(){
        try {
			$db = new PDO("{$this->driver}:host={$this->host};dbname={$this->bd};charset={$this->charset}", 
            $this->usuario, $this->contrasena);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $db;
		} catch (PDOException $e) {
			echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . 
            $e->getMessage();
			exit;
		}
    }
}