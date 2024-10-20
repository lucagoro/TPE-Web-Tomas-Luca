<?php
include_once 'app/models/model.php';

class UserModel extends Model {
   

    function getUserByUsername($usuario) {
        $sentencia = $this->db->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $sentencia->execute([$usuario]);

        $nombreUsuario = $sentencia->fetch(PDO::FETCH_OBJ);
        return $nombreUsuario;
    }

    function getPasswordAdmin(){
        $clave = "admin";
        $password_hashed = password_hash ($clave , PASSWORD_DEFAULT ); 
        
        return $password_hashed;
    }

    function insertUsuario($usuario, $contraseña)
    {
        $sentencia = $this->db->prepare('INSERT INTO usuarios (usuario, contraseña) VALUES (?, ?)');
        $sentencia->execute([$usuario, $contraseña]);
    }
}