-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 23-11-2022 a las 19:15:12
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
-- Estructura de tabla para la tabla `subzonas`
--

CREATE TABLE IF NOT EXISTS `subzonas` (
  `idsubzona` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `subzona` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `idzona` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idsubzona`),
  KEY `pertenece` (`idzona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `subzonas`
--

INSERT INTO `subzonas` (`idsubzona`, `subzona`, `idzona`, `creado_en`) VALUES
('00bff561-65df-11ed-8a78-feed01260033', '20 DE NOVIEMBRE', 'f23461b0-65de-11ed-8a78-feed01260033', '2022-11-16 18:46:38'),
('01d3e8b1-65f6-11ed-8a78-feed01260033', 'LIBRAMIENTO SUR', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-16 21:31:18'),
('01de812e-65d7-11ed-8a78-feed01260033', 'GALECIO NARCIA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-16 17:49:24'),
('05638eed-677c-11ed-8a78-feed01260033', 'BENITO JUAREZ', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-18 20:03:08'),
('14c7fad4-65e1-11ed-8a78-feed01260033', 'JULIAN GRAJALES', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-16 19:01:30'),
('20c06825-66c4-11ed-8a78-feed01260033', 'CONDESA', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-17 22:06:46'),
('2160574e-66c5-11ed-8a78-feed01260033', 'SALVADOR URBINA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-17 22:13:57'),
('22791dce-676d-11ed-8a78-feed01260033', 'CONOCIDO', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-18 18:16:34'),
('240f9cb9-65e4-11ed-8a78-feed01260033', 'EL TEJAR', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-16 19:23:25'),
('2b7d712d-65f7-11ed-8a78-feed01260033', 'FRACC. RENOVACION', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-16 21:39:37'),
('2f9c6f13-66cf-11ed-8a78-feed01260033', 'LAS GRANJAS', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-17 23:25:56'),
('3a534567-65de-11ed-8a78-feed01260033', 'NUEVA ESTRELLA', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-16 18:41:05'),
('485e531d-65d9-11ed-8a78-feed01260033', 'PASEO DEL BOSQUE', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-16 18:05:41'),
('4e03d05c-6ab5-11ed-8a78-feed01260033', 'SUCHIAPA', 'd590531d-65da-11ed-8a78-feed01260033', '2022-11-22 22:30:44'),
('5e909200-65f4-11ed-8a78-feed01260033', 'IGNACIO ALLENDE', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-16 21:19:35'),
('7e68444c-676f-11ed-8a78-feed01260033', 'PLUMA DE ORO', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-18 18:33:27'),
('9fd39cf8-6aab-11ed-8a78-feed01260033', 'PASO LIMON', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-22 21:21:27'),
('a279fc5f-6b5a-11ed-8a78-feed01260033', 'SANTA CRUZ', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-23 18:14:13'),
('a5ef60ca-66d4-11ed-8a78-feed01260033', 'FRANCISCO SARABIA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-18 00:05:02'),
('aa719c1c-66c1-11ed-8a78-feed01260033', 'RIBERA AMATAL', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-17 21:49:09'),
('b55ce226-66cd-11ed-8a78-feed01260033', 'KILOMETRO 4', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-17 23:15:21'),
('b895edc1-676c-11ed-8a78-feed01260033', 'DEMOCRATICA', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-18 18:13:36'),
('b9628f7b-65dc-11ed-8a78-feed01260033', 'JARDINES DEL GRIJALVA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-16 18:30:19'),
('bd193952-66c9-11ed-8a78-feed01260033', 'BARRIO BENITO JUAREZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-17 22:46:56'),
('bf42ba53-676d-11ed-8a78-feed01260033', 'RIBERA LAS FLECHAS', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-18 18:20:57'),
('c5eaacad-65e7-11ed-8a78-feed01260033', 'GUADALUPE VICTORIA', 'b12cf2d9-65e7-11ed-8a78-feed01260033', '2022-11-16 19:49:25'),
('c8962db7-65d4-11ed-8a78-feed01260033', 'NICOLAS BRAVO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-16 17:33:29'),
('c90f6ef6-6aad-11ed-8a78-feed01260033', 'EL REFUGIO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-22 21:36:55'),
('d43ae49f-6780-11ed-8a78-feed01260033', 'DISTRITO FEDERAL', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-18 20:37:33'),
('d517f521-66c2-11ed-8a78-feed01260033', 'POTINASPAK', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-17 21:57:30'),
('da75d751-677f-11ed-8a78-feed01260033', 'CHIAPA DE CORZO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-18 20:30:34'),
('e04830b5-65da-11ed-8a78-feed01260033', 'BARRIO SAN FRANCISCO', 'd590531d-65da-11ed-8a78-feed01260033', '2022-11-16 18:17:05'),
('eb29b36c-676a-11ed-8a78-feed01260033', 'EMILIANO ZAPATA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-18 18:00:42');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `subzonas`
--
ALTER TABLE `subzonas`
  ADD CONSTRAINT `pertenece` FOREIGN KEY (`idzona`) REFERENCES `zonas` (`idzona`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
