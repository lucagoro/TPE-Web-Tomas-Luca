<?php
require_once 'config.php';
class Model {
    protected $db;

    function __construct() {
        // Conectarse al servidor sin especificar una base de datos
        $this->db = new PDO('mysql:host='. DB_HOST .';charset=utf8', DB_USER, DB_PASS);

        // Crear la base de datos si no existe
        $this->createDatabase();

        // Ahora conectarse a la base de datos
        $this->db = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME .';charset=utf8', DB_USER, DB_PASS);

        // Desplegar las tablas si es necesario
        $this->deploy();
    }

    function createDatabase() {
        // Crear la base de datos si no existe
        $sql = 'CREATE DATABASE IF NOT EXISTS ' . DB_NAME . ' CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci';
        $this->db->exec($sql);
    }

    function deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();

        if (count($tables) == 0) {
            $sql =<<<END
                CREATE TABLE `botines` (
                `id_botin` int(11) NOT NULL,
                `modelo` varchar(50) NOT NULL,
                `color` varchar(50) NOT NULL,
                `talle` double NOT NULL,
                `gama` varchar(30) NOT NULL,
                `precio` float NOT NULL,
                `id_marca` int(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `botines`
                --

                INSERT INTO `botines` (`id_botin`, `modelo`, `color`, `talle`, `gama`, `precio`, `id_marca`) VALUES
                (1, 'tempo', 'negro', 42, 'alta', 120000, 1),
                (2, 'tempo', 'blanco', 44, 'media', 110000, 2);

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `marcas`
                --

                CREATE TABLE `marcas` (
                `id_marca` int(11) NOT NULL,
                `nombre` varchar(50) NOT NULL,
                `sede` varchar(50) NOT NULL,
                `foto` varchar(200) DEFAULT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `marcas`
                --

                INSERT INTO `marcas` (`id_marca`, `nombre`, `sede`, `foto`) VALUES
                (1, 'Puma', 'Tandil', NULL),
                (2, 'Nikoo', 'Argentina', ' https://tse3.mm.bing.net/th?id=OIP.ZnOtPr085U5DoYcm35ogrQHaFj&pid=Api&P=0&h=180'),
                (17, 'kike', 'rusia', NULL),
                (20, 'Reebok', 'Chile', 'https://tse2.mm.bing.net/th?id=OIP.PBH2xzzwlHBfX-t6TpZRZgHaHC&pid=Api&P=0&h=180'),
                (21, 'umbro', 'arg', 'https://tse4.mm.bing.net/th?id=OIP.6F5ct7NgaEBFlIyBLCuBbwHaEz&pid=Api&P=0&h=180'),
                (23, 'Reebok', 'Mexico', 'https://tse2.mm.bing.net/th?id=OIP.DNufu8T6OFbofuln9-EhrAHaGB&pid=Api&P=0&h=180');

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `usuarios`
                --

                CREATE TABLE `usuarios` (
                `id_usuario` int(11) NOT NULL,
                `usuario` varchar(200) NOT NULL,
                `contraseña` char(60) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `usuarios`
                --

                --
                -- Índices para tablas volcadas
                --

                --
                -- Indices de la tabla `botines`
                --
                ALTER TABLE `botines`
                ADD PRIMARY KEY (`id_botin`),
                ADD KEY `fk_id_marca` (`id_marca`);

                --
                -- Indices de la tabla `marcas`
                --
                ALTER TABLE `marcas`
                ADD PRIMARY KEY (`id_marca`);

                --
                -- Indices de la tabla `usuarios`
                --
                ALTER TABLE `usuarios`
                ADD PRIMARY KEY (`id_usuario`);

                --
                -- AUTO_INCREMENT de las tablas volcadas
                --

                --
                -- AUTO_INCREMENT de la tabla `botines`
                --
                ALTER TABLE `botines`
                MODIFY `id_botin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

                --
                -- AUTO_INCREMENT de la tabla `marcas`
                --
                ALTER TABLE `marcas`
                MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

                --
                -- AUTO_INCREMENT de la tabla `usuarios`
                --
                ALTER TABLE `usuarios`
                MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

                --
                -- Restricciones para tablas volcadas
                --

                --
                -- Filtros para la tabla `botines`
                --
                ALTER TABLE `botines`
                ADD CONSTRAINT `botines_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`);
                COMMIT;

            END;
            $this->db->exec($sql);
            $this->admin();
        }
    }
    function admin() {
        $query = $this->db->prepare('INSERT INTO usuarios (id_usuario, contraseña, usuario) VALUES
        (1, "$2a$12$XGQ84TQbuo7Y5UrFLF92SuVohzeZodL1r0MSYc4rB6g7SMZlFKvyC", "webadmin")');
        $query->execute();
    }
}