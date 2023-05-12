<?php

require_once('../../configuracion/Conexion.php');

class Ordenes extends Conexion {

    public function __construct() {
        $this->db = parent::__construct();
    }

    public function registrarOrden($Orden, $Carrito){

        $Orden      = json_decode($Orden);

        $nombres    = $Orden->nombres;
        $apellidos  = $Orden->apellidos;
        $correo     = $Orden->email;
        $celular    = $Orden->celular; 
        $direccion  = $Orden->direccion;
        $pais       = $Orden->pais;

        $statement = $this->db->prepare("INSERT INTO ordenes (
            NOMBRE, APELLIDO, CORREO, CELULAR, DIRECCION, PAIS, ESTADO_ORDEN, TOTAL_ORDEN
        ) VALUES (
            :nombres, :apellidos, :correo, :celular, :direccion, :pais, 'Aprobado', 0
        )");
        $statement->execute(array(':nombres' => $nombres, ':apellidos' => $apellidos, ':correo' => $correo, ':celular' => $celular, ':direccion' => $direccion, ':pais' => $pais));
        
        $IdOrden = $this->db->lastInsertId();
            
        $this->registrarProductosOrden($Carrito, $IdOrden);
        
        echo json_encode(array('status' => 'success', 'message' => 'Orden registrada correctamente'));
    }

    public function registrarProductosOrden($Carrito, $Orden){
        $Carrito = json_decode($Carrito);

        $Productos = $Carrito->productos;

        foreach($Productos as $Producto){
            if($Producto->cantidad > 0)
                $this->insertarProductos($Producto->id, $Producto->precio, $Producto->cantidad, $Orden);
        }

    }

    public function insertarProductos($Producto, $Precio, $Cantidad, $Orden){
        $statement = $this->db->prepare("INSERT INTO productos_orden (ID_ORDEN, ID_PRODUCTO, PRECIO, CANTIDAD)
        VALUES
        (:Orden, :Producto, :Precio, :Cantidad)");
        $statement->execute(array(':Orden' => $Orden, ':Producto' => $Producto, ':Precio' => $Precio, ':Cantidad' => $Cantidad));
        $this->actualizarTotal($Orden, $Precio * $Cantidad);
    }

    public function actualizarTotal($Orden, $Total){
        $statement = $this->db->prepare("UPDATE ordenes SET TOTAL_ORDEN = :Total + TOTAL_ORDEN WHERE ID_ORDEN = :Orden");
        $statement->execute(array(':Total' => $Total, ':Orden' => $Orden));
    }

    public function listarOrdenes(){
        $statement = $this->db->prepare("SELECT * FROM ordenes");
        $statement->execute();
        echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
    }
}