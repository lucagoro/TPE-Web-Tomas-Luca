<?php
include_once 'app/models/model.php';

class MarcasModel extends Model{

    function getAllMarcas(){
        
        $query = $this->db->prepare("SELECT * FROM marcas");
        $query->execute();
    
        $marcas = $query->fetchAll(PDO::FETCH_OBJ);
        return $marcas;
    }
    function getMarca($id){
        
        $query =  $this->db->prepare('SELECT * FROM marcas WHERE id_marca=?');
        $query->execute([$id]);
    
        $marca = $query-> fetchALL(PDO::FETCH_OBJ);
        return $marca;
    }
    function insertMarca($marca, $sede, $foto){
        
    
        $query=  $this->db->prepare('INSERT INTO marcas(nombre, sede, foto)VALUES(?,?,?)');
        $query->execute([$marca, $sede, $foto]);
        
    }
    function deleteMarca($id){
        
        
        $query =$this->db->prepare("DELETE FROM marcas WHERE `marcas`.`id_marca` = ?");
        $query->execute([$id]);
        
    }
    function editMarca($nombre, $sede, $id_marca, $foto) {
        $query = $this->db->prepare("UPDATE marcas SET nombre = ?, sede = ?, foto = ? WHERE id_marca = ?");
        return $query->execute([$nombre, $sede, $foto, $id_marca]);
    }
    function getBotinesByMarca($id_marca){
        $query = $this->db->prepare("SELECT * FROM botines WHERE id_marca = ?");
        $query->execute([$id_marca]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function getMarcaById($id) {
        $query =  $this->db->prepare('SELECT * FROM marcas WHERE id_marca=?');
        $query->execute([$id]);
    
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
}