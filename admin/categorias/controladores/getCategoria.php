<?php

require_once('../modelo/Categorias.php');

$Categorias = new Categorias();

$Categorias->getCategoria($_GET['Id']);