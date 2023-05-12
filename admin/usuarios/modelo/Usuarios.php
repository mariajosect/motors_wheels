<?php

session_start();
require_once('../../configuracion/Conexion.php');

class Usuarios extends Conexion {

    public function __construct() {
        $this->db = parent::__construct();
    }

    public function iniciarSesion($Email, $Password){
        $statement = $this->db->prepare("SELECT * FROM usuarios WHERE CORREO = :Email AND Password = :Password");
        $statement->execute(array(':Email' => $Email, ':Password' => $Password));
        $result = $statement->fetch();

        if($statement->rowCount() > 0){
            $_SESSION['ID_USUARIO'] = $result['ID_USUARIO'];
            $_SESSION['NOMBRE']     = $result['NOMBRE'];
            $_SESSION['CORREO']     = $result['CORREO'];
            echo json_encode(array('status' => 'success', 'message' => 'Inicio de sesión exitoso'));
        }else{
            echo json_encode(array('status' => 'error', 'message' => 'Usuario o contraseña incorrectos'));
        }
    }
}