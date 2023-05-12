<?php

require_once('../modelo/Categorias.php');

$Categorias = new Categorias();

$Nombre = $_POST['nombre']; 
$Source = $_FILES['foto']['tmp_name'];

$Categorias->registrarCategoria($Nombre, $Source);