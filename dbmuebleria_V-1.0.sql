-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 04-03-2022 a las 10:23:43
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbmuebleria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

DROP TABLE IF EXISTS `zonas`;
CREATE TABLE IF NOT EXISTS `zonas` (
  `idzona` int(11) NOT NULL AUTO_INCREMENT,
  `zona` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idzona`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `zonas`
--

INSERT INTO `zonas` (`idzona`, `zona`) VALUES
(1, 'GALECIO'),
(2, 'CAMBACEO PROPIO'),
(3, 'TUXTLA'),
(4, 'Nueva zona prueba');

--
-- Estructura de tabla para la tabla `subzonas`
--

DROP TABLE IF EXISTS `subzonas`;
CREATE TABLE IF NOT EXISTS `subzonas` (
  `idsubzona` int(11) NOT NULL AUTO_INCREMENT,
  `subzona` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `idzona` int(11) NOT NULL,
  PRIMARY KEY (`idsubzona`),
  KEY `pertenece` (`idzona`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `subzonas`
--

INSERT INTO `subzonas` (`idsubzona`, `subzona`, `idzona`) VALUES
(1, 'subzona de galecio', 1),
(2, 'subzona2 galacio', 1),
(3, 'subzona3 galecio', 1),
(6, 'subzona1 cambaceo', 2),
(7, 'subzona2 cambaceo', 2),
(8, 'subzona1 tuxtla', 3),
(9, 'subzona2 tux', 3),
(10, 'subzona prueba', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `idcliente` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_cliente` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `zona` int(11) NOT NULL,
  `domicilio_cliente` varchar(400) COLLATE utf8_spanish_ci NOT NULL,
  `subzona` int(11) NOT NULL,
  `tel1_cliente` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tel2_cliente` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cp_cliente` int(11) NOT NULL,
  `idestado_civil` int(1) NOT NULL,
  `trabajo_cliente` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `puesto_cliente` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `direccion_trabajo_cliente` varchar(400) COLLATE utf8_spanish_ci NOT NULL,
  `antiguedadA_trabajo_cliente` int(11) NOT NULL,
  `antiguedadM_trabajo_cliente` int(11) NOT NULL,
  `ingresos_cliente` decimal(11,4) NOT NULL,
  `tipo_ingresos_cliente` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_conyugue_cliente` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `antiguedadA_vinculo` int(11) DEFAULT NULL,
  `antiguedadM_vinculo` int(11) DEFAULT NULL,
  `trabajo_conyugue` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `puesto_conyugue` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ingreso_mensual_conyugue` decimal(11,4) DEFAULT NULL,
  `direccion_trabajo_conyugue` varchar(400) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tel_conyugue` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_vivienda_cliente` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `edad_residencia` int(11) NOT NULL,
  `renta_mensual` double(11,4) NOT NULL,
  `ndependientes` int(11) NOT NULL,
  `nombre_aval` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tel_aval` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `domicilio_aval` varchar(400) COLLATE utf8_spanish_ci DEFAULT NULL,
  `trabajo_aval` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `puesto_aval` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ingreso_mensual_aval` double(11,4) DEFAULT NULL,
  `nombre_conyugue_aval` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apto_credito` tinyint(1) NOT NULL,
  `nivel_apto` tinyint(2) NOT NULL,
  `estado_cliente` tinyint(1) NOT NULL DEFAULT '1',
  `no_cliente` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idcliente`),
  KEY `tiene una` (`zona`),
  KEY `se encuentra en` (`subzona`),
  KEY `no_cliente` (`no_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nombre_cliente`, `zona`, `domicilio_cliente`, `subzona`, `tel1_cliente`, `tel2_cliente`, `cp_cliente`, `idestado_civil`, `trabajo_cliente`, `puesto_cliente`, `direccion_trabajo_cliente`, `antiguedadA_trabajo_cliente`, `antiguedadM_trabajo_cliente`, `ingresos_cliente`, `tipo_ingresos_cliente`, `nombre_conyugue_cliente`, `antiguedadA_vinculo`, `antiguedadM_vinculo`, `trabajo_conyugue`, `puesto_conyugue`, `ingreso_mensual_conyugue`, `direccion_trabajo_conyugue`, `tel_conyugue`, `tipo_vivienda_cliente`, `edad_residencia`, `renta_mensual`, `ndependientes`, `nombre_aval`, `tel_aval`, `domicilio_aval`, `trabajo_aval`, `puesto_aval`, `ingreso_mensual_aval`, `nombre_conyugue_aval`, `apto_credito`, `nivel_apto`, `estado_cliente`) VALUES
('6cf768d73633345419e95d41d5614b95', 'Cliente de prueba', 3, 'cambio de domicilio', 8, '9611920000', '9611926030', 29070, 0, 'asdasd', 'asdasd', 'asdasd', 4, 0, '5000.0000', 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 4, 0.0000, 2, 'asdas', '9611926030', 'dsasd', 'asdasd', 'asdasda', 5000.0000, 'asdasd', 1, 0, 1),
('f73fa03c199c001fcd195f7367a13ac2', 'Cliente de prueba 2', 1, 'asdasd', 1, '9611926030', '9611926030', 29070, 1, 'asdasd', 'asdasd', 'asdasd', 4, 0, '4000.0000', 'Quincenal', 'nombre del conyugue', 4, 0, 'asdasd', 'asdasd', '4000.0000', 'asdasdas', '9611231223', 'Propia', 3, 0.0000, 2, 'asdas', '9611926030', 'dsasd', 'asdasd', 'asdasda', 4000.0000, 'asdasd', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
CREATE TABLE IF NOT EXISTS `configuracion` (
  `idconfiguracion` int(11) NOT NULL AUTO_INCREMENT,
  `configuracion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `valor_char` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `valor_int` int(11) DEFAULT NULL,
  PRIMARY KEY (`idconfiguracion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`idconfiguracion`, `configuracion`, `valor_char`, `valor_int`) VALUES
(1, 'serie', '0000001', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

DROP TABLE IF EXISTS `sucursales`;
CREATE TABLE IF NOT EXISTS `sucursales` (
  `idsucursales` int(11) NOT NULL AUTO_INCREMENT,
  `sucursales` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `matriz` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idsucursales`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`idsucursales`, `sucursales`, `descripcion`, `estado`, `matriz`) VALUES
(1, 'Tuxtla-Matriz', 'Sucursal Matrix-Tuxtla Gutiérrez', 1, 1),
(2, 'Galecio', 'Sucursal de Galecio, Chiapa de Corzo', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

DROP TABLE IF EXISTS `documento`;
CREATE TABLE IF NOT EXISTS `documento` (
  `iddocumento` int(11) NOT NULL AUTO_INCREMENT,
  `name_documento` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `folio` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `serie` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `idsucursal` int(11) NOT NULL,
  `estado` int(1) DEFAULT '1',
  PRIMARY KEY (`iddocumento`),
  KEY `es de la` (`idsucursal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`iddocumento`, `name_documento`, `folio`, `serie`, `idsucursal`, `estado`) VALUES
(1,'NOTA DE VENTA', 'GQ', '0000001', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `newnotificacion`
--

DROP TABLE IF EXISTS `newnotificacion`;
CREATE TABLE IF NOT EXISTS `newnotificacion` (
  `idnotificaciones` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `mensaje` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`idnotificaciones`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

DROP TABLE IF EXISTS `notificaciones`;
CREATE TABLE IF NOT EXISTS `notificaciones` (
  `idnotificaciones` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `mensaje` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`idnotificaciones`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

DROP TABLE IF EXISTS `permiso`;
CREATE TABLE IF NOT EXISTS `permiso` (
  `idpermiso` int(11) NOT NULL AUTO_INCREMENT,
  `permiso` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idpermiso`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `permiso`) VALUES
(1, 'VENTAS'),
(2, 'Nueva venta'),
(3, 'Editar ventas'),
(4, 'PRODUCTOS'),
(5, 'Nuevo producto'),
(6, 'Editar productos'),
(7, 'Compras'),
(8, 'CLIENTES'),
(9, 'Nuevo cliente'),
(10, 'Editar cliente Full'),
(11, 'Editar cliente Limitado'),
(12, 'Cobranza'),
(13, 'PROVEEDOR'),
(14, 'Nuevo proveedor'),
(15, 'Editar proveedores'),
(16, 'CONFIGURACION'),
(17, 'Usuarios'),
(18, 'Sucursales'),
(19, 'Documentos'),
(20, 'General');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

DROP TABLE IF EXISTS `puesto`;
CREATE TABLE IF NOT EXISTS `puesto` (
  `idpuesto` int(11) NOT NULL AUTO_INCREMENT,
  `puesto` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`idpuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`idpuesto`, `puesto`, `descripcion`) VALUES
(1, 'Administrativo', 'Este es el puesto de administrador de la mueblaria. Podra acceder a cosas de administración'),
(2, 'Vendedor-Cobrador', 'Este es el puesto de vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `rol` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `puesto` int(5) NOT NULL,
  `estado` tinyint(1) DEFAULT '1',
  `superadmin` tinyint(1) NOT NULL,
  `iduser_auto` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idusuario`),
  KEY `tiene el puesto` (`puesto`),
  KEY `iduser_auto` (`iduser_auto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para manejar los usuarios del sistema';

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `pass`, `rol`, `puesto`, `estado`, `superadmin`, `iduser_auto`) VALUES
('IGERAG', 'Ruben Aguilar González', '81df10368e0655e4801b66269fd8b973', 'SuperAdmin', 1, 1, 1, 1),
('OSV', 'OSVALDO', '0c04e1d2f9dec7007ecc22862711b57a', 'Usurario', 1, 1, 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_usuario`
--

DROP TABLE IF EXISTS `permiso_usuario`;
CREATE TABLE IF NOT EXISTS `permiso_usuario` (
  `permiso_idpermiso` int(11) NOT NULL,
  `permiso_idusuario` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`permiso_idpermiso`,`permiso_idusuario`),
  KEY `asignado al` (`permiso_idusuario`),
  KEY `es el` (`permiso_idpermiso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `permiso_usuario`
--

INSERT INTO `permiso_usuario` (`permiso_idpermiso`, `permiso_idusuario`) VALUES
(2, 'OSV'),
(3, 'OSV'),
(6, 'OSV'),
(7, 'OSV'),
(8, 'OSV'),
(9, 'OSV'),
(11, 'OSV');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal_usuario`
--

DROP TABLE IF EXISTS `sucursal_usuario`;
CREATE TABLE IF NOT EXISTS `sucursal_usuario` (
  `sucursal_idusuario` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'corresponde',
  `sucursal_idsucursales` int(11) NOT NULL COMMENT 'tiene',
  PRIMARY KEY (`sucursal_idusuario`,`sucursal_idsucursales`),
  KEY `asignado a` (`sucursal_idsucursales`),
  KEY `tiene acceso a` (`sucursal_idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sucursal_usuario`
--

INSERT INTO `sucursal_usuario` (`sucursal_idusuario`, `sucursal_idsucursales`) VALUES
('IGERAG', 1),
('OSV', 1),
('IGERAG', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referencias_cliente`
--

DROP TABLE IF EXISTS `referencias_cliente`;
CREATE TABLE IF NOT EXISTS `referencias_cliente` (
  `idreferencia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `domicilio` varchar(400) COLLATE utf8_spanish_ci NOT NULL,
  `relacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `tel` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nota` text COLLATE utf8_spanish_ci NOT NULL,
  `idcliente` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idreferencia`),
  KEY `pertenece_a_cliente` (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `referencias_cliente`
--

INSERT INTO `referencias_cliente` (`idreferencia`, `nombre`, `domicilio`, `relacion`, `tel`, `nota`, `idcliente`) VALUES
(1, 'referencia1FIN', 'domref', 'asda', '9611926030', 'notas ref1', 'f73fa03c199c001fcd195f7367a13ac2'),
(2, 'referencia2FIN', 'domref', 'asda', '9611926030', 'ref2', 'f73fa03c199c001fcd195f7367a13ac2'),
(3, 'referencia1FIN', 'domref', 'asda', '9611926030', 'nota de ref1', '6cf768d73633345419e95d41d5614b95'),
(4, 'referencia2FIN', 'domref', 'asda', '9611926030', 'nota de ref 2', '6cf768d73633345419e95d41d5614b95');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `se encuentra en` FOREIGN KEY (`subzona`) REFERENCES `subzonas` (`idsubzona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tiene una` FOREIGN KEY (`zona`) REFERENCES `zonas` (`idzona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `es de la` FOREIGN KEY (`idsucursal`) REFERENCES `sucursales` (`idsucursales`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permiso_usuario`
--
ALTER TABLE `permiso_usuario`
  ADD CONSTRAINT `asignado al` FOREIGN KEY (`permiso_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `es el` FOREIGN KEY (`permiso_idpermiso`) REFERENCES `permiso` (`idpermiso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `referencias_cliente`
--
ALTER TABLE `referencias_cliente`
  ADD CONSTRAINT `pertenece_a_cliente` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `subzonas`
--
ALTER TABLE `subzonas`
  ADD CONSTRAINT `pertenece` FOREIGN KEY (`idzona`) REFERENCES `zonas` (`idzona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sucursal_usuario`
--
ALTER TABLE `sucursal_usuario`
  ADD CONSTRAINT `asignado a` FOREIGN KEY (`sucursal_idsucursales`) REFERENCES `sucursales` (`idsucursales`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tiene acceso a` FOREIGN KEY (`sucursal_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `tiene el puesto` FOREIGN KEY (`puesto`) REFERENCES `puesto` (`idpuesto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
