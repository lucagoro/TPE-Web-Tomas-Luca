<?php
class UserModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=marcas_botines;charset=utf8', 'root', ''); // esta bien esta bd?¿
    }

    function getUserByUsername($usuario) {
        $sentencia = $this->db->prepare("SELECT * FROM usuarios WHERE usuario = ?"); // creo q va usuario y no id
        $sentencia->execute([$usuario]);

        $nombreUsuario = $sentencia->fetch(PDO::FETCH_OBJ);
        return $nombreUsuario;
    }
}