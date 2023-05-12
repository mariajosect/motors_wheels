<?php

require_once('../modelo/Productos.php');

$Productos = new Productos();

$Productos->getProducto($_GET['Id']);