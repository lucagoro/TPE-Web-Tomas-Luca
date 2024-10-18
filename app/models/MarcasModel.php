<?php
class MarcasModel{
    private function connect(){
        return new PDO('mysql:host=localhost;dbname=db_tareas;charset=utf8','root', '');
    }
    function getMarcas(){
        $db=$this->connect();
        $query = $db->prepare('SELECT * FROM tareas');
        $query->execute();
    
        $marcas = $query-> fetchALL(PDO::FETCH_OBJ);
        return $marcas;
    }
    function insertTask($title, $description, $priority){
        $db = $this-> connect();
    
        $query= $db ->prepare('INSERT INTO tareas(titulo, descripcion, prioridad)VALUES(?,?,?)');
        $query->execute([$title, $description, $priority]);
        return $db->lastInsertId();
    }
    function deleteTask($id){
        
        $db= $this-> connect();
        $query = $db->prepare('DELETE FROM tareas WHERE id=?');
        $query->execute([$id]);
        header('Location: ' . BASE_URL); 
      
    }
    function updateTask($id){
        $db = $this-> connect();
        $query = $db->prepare('UPDATE tareas SET finalizada = 1 WHERE id=? ');
        $query->execute([$id]);
     
    }
    
}