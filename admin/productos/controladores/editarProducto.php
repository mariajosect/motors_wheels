<?php

require_once('../modelo/Productos.php');

$Productos = new Productos();

$id                 = $_POST['id'];
$nombre             = $_POST['nombre'];
$categoria          = $_POST['categoria'];
$descripcion        = $_POST['descripcion'];
$precio             = $_POST['precio'];
$precio_promocion   = $_POST['precio_promocion'];
$stock              = $_POST['stock'];
$source             = $_FILES['foto']['tmp_name'];

$Productos->editarProducto($id, $nombre, $categoria, $descripcion, $precio, $precio_promocion, $stock, $source);