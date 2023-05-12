<?php

require_once('../../configuracion/Conexion.php');

class Productos extends Conexion {

    public function __construct() {
        $this->db = parent::__construct();
    }

    public function getProductos(){
        $statement = $this->db->prepare("SELECT c.ID_CATEGORIA, c.CATEGORIA, c.IMAGEN AS IMAGEN_CATEGORIA, p.ID_PRODUCTO, 
        p.NOMBRE, p.PRECIO, P.STOCK, p.IMAGEN AS IMAGEN_PRODUCTO 
        FROM productos p 
        INNER JOIN categorias c ON p.ID_CATEGORIA = c.ID_CATEGORIA;
        ");
        $statement->execute();
        echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getProducto($Id){
        $statement = $this->db->prepare("SELECT c.ID_CATEGORIA, c.CATEGORIA, c.IMAGEN AS IMAGEN_CATEGORIA, p.ID_PRODUCTO, 
        p.NOMBRE, p.PRECIO, P.STOCK, p.IMAGEN AS IMAGEN_PRODUCTO, p.DESCRIPCION, p.PRECIO_PROMOCION
        FROM productos p 
        INNER JOIN categorias c ON p.ID_CATEGORIA = c.ID_CATEGORIA WHERE p.ID_PRODUCTO = :Id");
        $statement->execute(array(':Id' => $Id));
        echo json_encode($statement->fetch(PDO::FETCH_ASSOC));
    }

    public function registrarProducto($nombre, $categoria, $descripcion, $precio, $precio_promocion, $stock, $source){
        $foto = $nombre.'.png';

        move_uploaded_file($source, '../imagenes/'.$foto);

        $statement = $this->db->prepare("INSERT INTO productos 
        (NOMBRE, ID_CATEGORIA, DESCRIPCION, PRECIO, PRECIO_PROMOCION, STOCK, IMAGEN)
        VALUES 
        (:nombre, :categoria, :descripcion, :precio, :precio_promocion, :stock, :foto)");
        $statement->execute(array(
            ':nombre'           => $nombre,
            ':categoria'        => $categoria,
            ':descripcion'      => $descripcion,
            ':precio'           => $precio,
            ':precio_promocion' => $precio_promocion,
            ':stock'            => $stock,
            ':foto'             => $foto
        ));

        echo json_encode(array('status' => 'success', 'message' => 'Producto Registrado'));
    }

    public function editarProducto($id, $nombre, $categoria, $descripcion, $precio, $precio_promocion, $stock, $source){
        $foto = $_POST['foto_anterior'];

        if($_FILES['foto']['tmp_name'] !== ''){

            if(file_exists('../imagenes/'.$foto)){
                unlink('../imagenes/'.$foto);
            }
            
            $foto = $nombre.'.png';

            move_uploaded_file($source, '../imagenes/'.$foto);
        }

        $statement = $this->db->prepare("UPDATE productos SET NOMBRE = :nombre, ID_CATEGORIA = :categoria, DESCRIPCION = :descripcion, PRECIO = :precio, PRECIO_PROMOCION = :precio_promocion, STOCK = :stock, IMAGEN= :foto WHERE ID_PRODUCTO = :id");
        $statement->execute(array(':id' => $id, ':nombre' => $nombre, ':categoria' => $categoria, ':descripcion' => $descripcion, ':precio' => $precio, ':precio_promocion' => $precio_promocion, ':stock' => $stock, ':foto' => $foto));

        echo json_encode(array('status' => 'success', 'message' => 'Producto Actualizado'));

    }
    
    public function getProductosTienda(){
        $statement = $this->db->prepare("SELECT c.ID_CATEGORIA, c.CATEGORIA, c.IMAGEN AS IMAGEN_CATEGORIA, p.ID_PRODUCTO, 
        p.NOMBRE, p.PRECIO, P.STOCK, p.IMAGEN AS IMAGEN_PRODUCTO 
        FROM productos p 
        INNER JOIN categorias c ON p.ID_CATEGORIA = c.ID_CATEGORIA;
        ");
        $statement->execute();
        echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getProductoTienda($Id){
        $statement = $this->db->prepare("SELECT c.ID_CATEGORIA, c.CATEGORIA, c.IMAGEN AS IMAGEN_CATEGORIA, p.ID_PRODUCTO, 
        p.NOMBRE, p.PRECIO, P.STOCK, p.IMAGEN AS IMAGEN_PRODUCTO, p.DESCRIPCION, p.PRECIO_PROMOCION
        FROM productos p 
        INNER JOIN categorias c ON p.ID_CATEGORIA = c.ID_CATEGORIA WHERE p.ID_PRODUCTO = :Id");
        $statement->execute(array(':Id' => $Id));
        echo json_encode($statement->fetch(PDO::FETCH_ASSOC));
    }
}