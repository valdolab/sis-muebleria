-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 23-11-2022 a las 19:14:42
-- Versión del servidor: 10.5.16-MariaDB
-- Versión de PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id17012782_dbmuebleria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE IF NOT EXISTS `zonas` (
  `idzona` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `zona` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idzona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `zonas`
--

INSERT INTO `zonas` (`idzona`, `zona`, `creado_en`) VALUES
('b12cf2d9-65e7-11ed-8a78-feed01260033', 'VILLAFLORES', '2022-11-16 19:48:50'),
('bc2b8b27-65d4-11ed-8a78-feed01260033', 'CHIAPA DE CORZO', '2022-11-16 17:33:08'),
('d590531d-65da-11ed-8a78-feed01260033', 'SUCHIAPA', '2022-11-16 18:16:47'),
('f23461b0-65de-11ed-8a78-feed01260033', 'EMILIANO ZAPATA', '2022-11-16 18:46:13');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
