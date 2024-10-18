<?php
class MarcasModel{
    private $db;

    function __construct() {
        $this->db = $this->connect();
    }

    private function connect(){
        return new PDO('mysql:host=localhost;dbname=marcas_botines;charset=utf8', 'root', '');
    }
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
    function insertMarca($marca, $sede){
        $db = $this-> connect();
    
        $query=  $this->db->prepare('INSERT INTO marcas(nombre, sede)VALUES(?,?)');
        $query->execute([$marca, $sede]);
        return $db->lastInsertId();
        header('Location: ' . BASE_URL);
    }
    function deleteMarca($id){
        
        $db= $this-> connect();
        $query = $db->prepare('DELETE FROM marcas WHERE id_marca=?');
        $query->execute($id);
        
      
    }
    function editMarca($marca, $sede, $id_marca){
        $query = $this->db->prepare("UPDATE marcas SET nombre = ?, sede = ?  WHERE id_marca = ?");
        $editado = $query->execute([$marca, $sede]);
        return $editado;
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