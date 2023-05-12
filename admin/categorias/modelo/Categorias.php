<?php

require_once('../../configuracion/Conexion.php');

class Categorias extends Conexion {

    public function __construct(){
        $this->db = parent::__construct();
    }

    public function getCategorias(){
        $statement = $this->db->prepare("SELECT * FROM categorias");
        $statement->execute();
        echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getCategoria($Id){
        $statement = $this->db->prepare("SELECT * FROM categorias WHERE ID_CATEGORIA = :Id");
        $statement->execute(array(':Id' => $Id));
        echo json_encode($statement->fetch());
    }

    public function registrarCategoria($Nombre, $Source){
        $Foto = $Nombre.'.png';

        move_uploaded_file($Source, '../imagenes/'.$Foto);

        $statement = $this->db->prepare("INSERT INTO categorias (CATEGORIA, IMAGEN) VALUES (:Nombre, :Foto)");
        $statement->execute(array(':Nombre' => $Nombre, ':Foto' => $Foto));
        
        echo json_encode(array('status' => 'success', 'message' => 'Categoría Registrada'));
    }

    public function editarCategoria($Id, $Nombre, $Source){
        $Foto = $_POST['foto_anterior'];

        if($_FILES['foto']['tmp_name'] !== ''){

            if(file_exists('../imagenes/'.$Foto)){
                unlink('../imagenes/'.$Foto);
            }
            
            $Foto = $Nombre.'.png';

            move_uploaded_file($Source, '../imagenes/'.$Foto);
        }

        $statement = $this->db->prepare("UPDATE categorias SET CATEGORIA = :Nombre, IMAGEN = :Foto WHERE ID_CATEGORIA = :Id");
        $statement->execute(array(':Id' => $Id, ':Nombre' => $Nombre, ':Foto' => $Foto));
        
        echo json_encode(array('status' => 'success', 'message' => 'Categoría Actualizada'));
    }

    public function getCategoriasTienda(){
        $statement = $this->db->prepare("SELECT DISTINCT c.ID_CATEGORIA, c.CATEGORIA, c.IMAGEN, COUNT(*) AS TOTAL FROM productos p INNER JOIN categorias c ON c.ID_CATEGORIA = p.ID_CATEGORIA GROUP BY c.ID_CATEGORIA;        ");
        $statement->execute();
        echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
    }
}
