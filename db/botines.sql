-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2024 a las 23:21:50
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `marcas_botines`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `botines`
--

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `botines`
--
ALTER TABLE `botines`
  MODIFY `id_botin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `botines`
--
ALTER TABLE `botines`
  ADD CONSTRAINT `botines_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`Id_marca`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
