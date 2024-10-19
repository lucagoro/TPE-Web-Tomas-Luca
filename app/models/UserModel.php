<?php
include_once 'config.php';

class UserModel {
    private $db;

    function __construct() {
        $this->db = new PDO(
            "mysql:host=" . DB_HOST .
            ";dbname=" . DB_NAME . ";charset=utf8",
            DB_USER,
            DB_PASS
        );
        $this->_deploy();

    }

    function _deploy()
    {
        $query = $this->db->query('SHOW TABLES LIKE "usuarios"');
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $sql = <<<END
        CREATE TABLE `usuarios` (
            `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
            `usuario` varchar(100) NOT NULL,
            `contraseña` varchar(100) NOT NULL,
            PRIMARY KEY (`id_usuario`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
END;
            $this->db->query($sql);
            $this->insertUsuario('webadmin', $this->getPasswordAdmin());
        }
    }

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