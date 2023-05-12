<?php

require_once('../modelo/Productos.php');

$Productos = new Productos();

$Productos->getProductoTienda($_GET['Id']);