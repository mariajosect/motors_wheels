<?php

require_once('../modelo/Ordenes.php');

$Ordenes = new Ordenes();

$Orden   = $_POST['datosCliente'];
$Carrito = $_POST['productosCarrito'];

$Ordenes->registrarOrden($Orden, $Carrito);