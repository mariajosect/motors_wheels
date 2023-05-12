<?php

require_once('../modelo/Categorias.php');

$Categorias = new Categorias();

$Id     = $_POST['id']; 
$Nombre = $_POST['nombre']; 
$Source = $_FILES['foto']['tmp_name'];

$Categorias->editarCategoria($Id, $Nombre, $Source);