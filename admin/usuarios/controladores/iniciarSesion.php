<?php

require_once('../modelo/Usuarios.php');

$Usuarios = new Usuarios();

$Email      = $_POST['email'];
$Password   = sha1($_POST['password']);

$Usuarios->iniciarSesion($Email, $Password);