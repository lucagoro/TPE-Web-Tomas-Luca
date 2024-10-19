<?php
include_once 'config.php';

class BotinModel {
    private $db;

    function __construct() {
        $this->db = $this->connection();
        $this->_deploy();
    }

    function _deploy() {
        $query = $this->db->query('SHOW TABLES LIKE "botines"');
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $sql = <<<END
        CREATE TABLE `botines` (
            `id_botin` int(11) NOT NULL AUTO_INCREMENT,
            `modelo` varchar(50) NOT NULL,
            `color` varchar(50) NOT NULL,
            `talle` double NOT NULL,
            `gama` varchar(30) NOT NULL,
            `precio` float NOT NULL,
            `id_marca` int(11) NOT NULL,
            PRIMARY KEY (`id_botin`),
            KEY `fk_id_marca` (`id_marca`),
            CONSTRAINT `botines_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`Id_marca`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
END;
            $this->db->query($sql);

            $this->insert('mercurial', 'rojo', 40, 'alta', 300000, 2);
            $this->insert('tempo', 'negro', 42, 'alta', 350000, 1);
    }
}

    function connection() {
        return new PDO(
            "mysql:host=" . DB_HOST .
            ";dbname=" . DB_NAME . ";charset=utf8",
            DB_USER,
            DB_PASS
        );
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