<?php

class BotinModel {
    private $db;

    function __construct() {
        $this->db = $this->connection();
    }

    function connection() {
        return new PDO('mysql:host=localhost;dbname=marcas_botines;charset=utf8', 'root', '');
    }

    function getAll() {
        $sentencia = $this->db->prepare("SELECT * FROM botines");
        $sentencia->execute();

        $botines = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $botines;
    }

    function get($id) {
        $sentencia = $this->db->prepare("SELECT * FROM botines WHERE id_botin = ?");
        $sentencia->execute([$id]);
        $botin = $sentencia->fetch(PDO::FETCH_OBJ);
        return $botin;
    }

    function insert($modelo, $color, $talle, $gama, $precio, $id_marca) {
        $sentencia = $this->db->prepare("INSERT INTO botines(modelo, color, talle, gama, precio, id_marca) VALUES(?,?,?,?,?,?)");
        $sentencia->execute([$modelo, $color, $talle, $gama, $precio, $id_marca]);

        return $this->db->lastInsertId();
    }

    function delete($id) {
        $sentencia = $this->db->prepare('DELETE FROM botines WHERE id_botin = ?');
        $sentencia->execute([$id]);
    }

    function edit($modelo, $color, $talle, $gama, $precio, $id_marca, $idBotin) {
        $sentencia = $this->db->prepare("UPDATE botines SET modelo = ?, color = ?, talle = ?, gama = ?, precio = ?, id_marca = ? WHERE id_botin = ?");
        $editado = $sentencia->execute([$modelo, $color, $talle, $gama, $precio, $id_marca, $idBotin]);
        return $editado;
    }
}