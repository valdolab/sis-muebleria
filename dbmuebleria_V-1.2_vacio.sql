-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 03-07-2022 a las 08:58:12
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

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
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `idcategoria` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tiene_subcat` tinyint(1) NOT NULL,
  `atr1` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `atr2` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `atr3` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `atr4` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `atr5` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contado` double DEFAULT NULL,
  `especial` double DEFAULT NULL,
  `base_inicial_c1` double DEFAULT NULL,
  `ganancia_inicial_c1` double DEFAULT NULL,
  `rango_c1` double DEFAULT NULL,
  `ganancia_subsecuente_c1` double DEFAULT NULL,
  `limite_costo_c1` double DEFAULT NULL,
  `base_inicial_c2` double DEFAULT NULL,
  `ganancia_inicial_c2` double DEFAULT NULL,
  `rango_c2` double DEFAULT NULL,
  `ganancia_subsecuente_c2` double DEFAULT NULL,
  `limite_costo_c2` double DEFAULT NULL,
  `meses_pago` int(11) DEFAULT NULL,
  `meses_garantia` int(11) DEFAULT NULL,
  `enganche` double DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `idcliente` char(32) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_cliente` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `zona` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `domicilio_cliente` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `subzona` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `tel1_cliente` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tel2_cliente` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cp_cliente` int(11) DEFAULT NULL,
  `idestado_civil` int(1) NOT NULL DEFAULT '0',
  `curp` char(18) COLLATE utf8_spanish_ci DEFAULT NULL,
  `rfc` char(13) COLLATE utf8_spanish_ci DEFAULT NULL,
  `trabajo_cliente` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `puesto_cliente` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion_trabajo_cliente` varchar(400) COLLATE utf8_spanish_ci DEFAULT NULL,
  `antiguedadA_trabajo_cliente` int(11) NOT NULL DEFAULT '0',
  `antiguedadM_trabajo_cliente` int(11) NOT NULL DEFAULT '0',
  `ingresos_cliente` double NOT NULL DEFAULT '0',
  `tipo_ingresos_cliente` varchar(20) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Quincenal',
  `nombre_conyugue_cliente` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `antiguedadA_vinculo` int(11) DEFAULT NULL,
  `antiguedadM_vinculo` int(11) DEFAULT NULL,
  `trabajo_conyugue` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `puesto_conyugue` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ingreso_mensual_conyugue` double DEFAULT NULL,
  `direccion_trabajo_conyugue` varchar(400) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tel_conyugue` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_vivienda_cliente` varchar(20) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Propia',
  `edad_residencia` int(11) NOT NULL DEFAULT '0',
  `renta_mensual` double NOT NULL DEFAULT '0',
  `ndependientes` int(11) NOT NULL DEFAULT '0',
  `nombre_aval` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tel_aval` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `domicilio_aval` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `trabajo_aval` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `puesto_aval` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ingreso_mensual_aval` double DEFAULT NULL,
  `nombre_conyugue_aval` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apto_credito` tinyint(1) NOT NULL,
  `nivel_apto` tinyint(2) NOT NULL,
  `estado_cliente` tinyint(1) NOT NULL DEFAULT '1',
  `no_cliente` int(11) NOT NULL,
  `masinfo` tinyint(1) NOT NULL DEFAULT '0',
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idcliente`),
  KEY `tiene una` (`zona`),
  KEY `se encuentra en` (`subzona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
CREATE TABLE IF NOT EXISTS `configuracion` (
  `idconfiguracion` int(11) NOT NULL AUTO_INCREMENT,
  `configuracion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `valor_char` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `valor_int` int(11) DEFAULT NULL,
  PRIMARY KEY (`idconfiguracion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`idconfiguracion`, `configuracion`, `valor_char`, `valor_int`) VALUES
(1, 'serie', '0000001', NULL),
(2, 'activador_especial', NULL, 1);

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
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`iddocumento`),
  KEY `es de la` (`idsucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`iddocumento`, `name_documento`, `folio`, `serie`, `idsucursal`, `estado`, `creado_en`) VALUES
(1, 'NOTA DE VENTA', 'MAT', '0000001', 1, 1, '2022-03-29 06:17:20');

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
(7, 'Eliminar productos'),
(8, 'Imágenes'),
(9, 'Ver costos'),
(10, 'Editar lista'),
(11, 'Compras'),
(12, 'CLIENTES'),
(13, 'Nuevo cliente'),
(14, 'Editar cliente Full'),
(15, 'Editar cliente Limitado'),
(16, 'Cobranza'),
(17, 'PROVEEDOR'),
(18, 'Nuevo proveedor'),
(19, 'Editar proveedores'),
(20, 'CONFIGURACION'),
(21, 'Usuarios'),
(22, 'Sucursales'),
(23, 'Documentos'),
(24, 'General');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_usuario`
--

DROP TABLE IF EXISTS `permiso_usuario`;
CREATE TABLE IF NOT EXISTS `permiso_usuario` (
  `permiso_idpermiso` int(11) NOT NULL,
  `permiso_idusuario` char(36) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`permiso_idpermiso`,`permiso_idusuario`),
  KEY `asignado al` (`permiso_idusuario`),
  KEY `es el` (`permiso_idpermiso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `permiso_usuario`
--

INSERT INTO `permiso_usuario` (`permiso_idpermiso`, `permiso_idusuario`) VALUES
(4, '0a96aada-bd56-11ec-b09f-asjg75jfl123'),
(5, '0a96aada-bd56-11ec-b09f-asjg75jfl123'),
(8, '0a96aada-bd56-11ec-b09f-asjg75jfl123'),
(9, '0a96aada-bd56-11ec-b09f-asjg75jfl123'),
(12, '0a96aada-bd56-11ec-b09f-asjg75jfl123'),
(13, '0a96aada-bd56-11ec-b09f-asjg75jfl123'),
(15, '0a96aada-bd56-11ec-b09f-asjg75jfl123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `idproducto` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `identificador` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `codigo_barras` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `categoria` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `subcategoria` char(36) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `serializado` tinyint(1) NOT NULL,
  `atr1_producto` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `atr2_producto` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `atr3_producto` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `atr4_producto` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `atr5_producto` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `stock_min` int(11) DEFAULT NULL,
  `stock_max` int(11) DEFAULT NULL,
  `ext_p` int(11) DEFAULT NULL,
  `costo` double NOT NULL,
  `costo_iva` double NOT NULL,
  `costo_contado` double NOT NULL,
  `costo_especial` double DEFAULT NULL,
  `costo_cr1` double NOT NULL,
  `costo_cr2` double NOT NULL,
  `costo_p1` double NOT NULL,
  `costo_p2` double NOT NULL,
  `costo_eq` double NOT NULL,
  `costo_enganche` double NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idproducto`),
  KEY `es_categoria` (`categoria`),
  KEY `es_subcategoria` (`subcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

DROP TABLE IF EXISTS `puesto`;
CREATE TABLE IF NOT EXISTS `puesto` (
  `idpuesto` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `puesto` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idpuesto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`idpuesto`, `puesto`, `descripcion`, `creado_en`) VALUES
('6e3f32fa-bd10-11ec-a5db-d481d723r4ed', 'Administrativo', 'Este es el puesto de administrador de la mueblaria. Podra acceder a cosas de administración', '2022-03-29 06:17:05'),
('6e3f32fa-bd10-11ec-a5db-d481d765gtrs', 'Vendedor-Cobrador', 'Este es el puesto de vendedor', '2022-03-29 06:17:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referencias_cliente`
--

DROP TABLE IF EXISTS `referencias_cliente`;
CREATE TABLE IF NOT EXISTS `referencias_cliente` (
  `idreferencia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `domicilio` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `relacion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tel` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nota` text COLLATE utf8_spanish_ci NOT NULL,
  `idcliente` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idreferencia`),
  KEY `pertenece_a_cliente` (`idcliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

DROP TABLE IF EXISTS `subcategoria`;
CREATE TABLE IF NOT EXISTS `subcategoria` (
  `idsubcategoria` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `categoria` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `atr1` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `atr2` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `atr3` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `atr4` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `atr5` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contado` double DEFAULT NULL,
  `especial` double DEFAULT NULL,
  `base_inicial_c1` double DEFAULT NULL,
  `ganancia_inicial_c1` double DEFAULT NULL,
  `rango_c1` double DEFAULT NULL,
  `ganancia_subsecuente_c1` double DEFAULT NULL,
  `limite_costo_c1` double DEFAULT NULL,
  `base_inicial_c2` double DEFAULT NULL,
  `ganancia_inicial_c2` double DEFAULT NULL,
  `rango_c2` double DEFAULT NULL,
  `ganancia_subsecuente_c2` double DEFAULT NULL,
  `limite_costo_c2` double DEFAULT NULL,
  `meses_pago` int(11) DEFAULT NULL,
  `meses_garantia` int(11) DEFAULT NULL,
  `enganche` double DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idsubcategoria`),
  KEY `pertenece_a_la_categoria` (`categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subzonas`
--

DROP TABLE IF EXISTS `subzonas`;
CREATE TABLE IF NOT EXISTS `subzonas` (
  `idsubzona` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `subzona` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `idzona` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idsubzona`),
  KEY `pertenece` (`idzona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `subzonas`
--

INSERT INTO `subzonas` (`idsubzona`, `subzona`, `idzona`, `creado_en`) VALUES
('lkmhlgok-6yth-hyhj-98xz-yujkasndjash', 'subzona de galecio', '378hinek-bd10-asdd-6yyh-d481d723r4ed', '2022-03-29 06:16:55'),
('yohrio96-vfgt-23nm-6765-84i34hi883dl', 'Subzona Tuxtla', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-03-29 06:16:55');

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
  `tipo` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idsucursales`),
  KEY `es de tipo` (`tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`idsucursales`, `sucursales`, `descripcion`, `estado`, `matriz`, `tipo`, `creado_en`) VALUES
(1, 'Tuxtla-Matriz', 'Sucursal Matrix-Tuxtla Gutiérrez', 1, 1, 'a8791f44-bc7e-11ec-bf6e-d481d7c3a9ad', '2022-03-29 06:16:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal_usuario`
--

DROP TABLE IF EXISTS `sucursal_usuario`;
CREATE TABLE IF NOT EXISTS `sucursal_usuario` (
  `idsucursal_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `sucursal_idusuario` char(36) COLLATE utf8_spanish_ci NOT NULL COMMENT 'corresponde',
  `sucursal_idsucursales` int(11) NOT NULL COMMENT 'tiene',
  PRIMARY KEY (`idsucursal_usuario`),
  KEY `asignado a` (`sucursal_idsucursales`),
  KEY `tiene acceso a` (`sucursal_idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sucursal_usuario`
--

INSERT INTO `sucursal_usuario` (`idsucursal_usuario`, `sucursal_idusuario`, `sucursal_idsucursales`) VALUES
(1, '0a96aada-bd56-11ec-b09f-asjg75jfl382', 1),
(8, '0a96aada-bd56-11ec-b09f-asjg75jfl123', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

DROP TABLE IF EXISTS `tipo`;
CREATE TABLE IF NOT EXISTS `tipo` (
  `idtipo` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_tipo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idtipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`idtipo`, `nombre_tipo`) VALUES
('a8791f44-bc7e-11ec-bf6e-d481d7c3a9ad', 'TIPO1'),
('pii91f44-bc7e-11ec-bf6e-d481d7c3a9qw', 'TIPO2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_acceso` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `rol` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `puesto` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) DEFAULT '1',
  `superadmin` tinyint(1) NOT NULL,
  `no_user` int(11) NOT NULL AUTO_INCREMENT,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idusuario`),
  KEY `tiene el puesto` (`puesto`),
  KEY `no_user` (`no_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para manejar los usuarios del sistema';

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `usuario_acceso`, `nombre`, `pass`, `rol`, `puesto`, `estado`, `superadmin`, `no_user`, `creado_en`) VALUES
('0a96aada-bd56-11ec-b09f-asjg75jfl123', 'IGERAG', 'Ruben Aguilar González', '81df10368e0655e4801b66269fd8b973', 'Administrador', '6e3f32fa-bd10-11ec-a5db-d481d723r4ed', 1, 0, 2, '2022-03-29 05:39:17'),
('0a96aada-bd56-11ec-b09f-asjg75jfl382', 'Luis', 'Luis Augusto Von Duben Aquino', 'c44688b5061756b3cca2b86c016a1535', 'SuperAdmin', '6e3f32fa-bd10-11ec-a5db-d481d723r4ed', 1, 1, 1, '2022-03-29 05:39:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

DROP TABLE IF EXISTS `zonas`;
CREATE TABLE IF NOT EXISTS `zonas` (
  `idzona` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `zona` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idzona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `zonas`
--

INSERT INTO `zonas` (`idzona`, `zona`, `creado_en`) VALUES
('378hinek-bd10-asdd-6yyh-d481d723r4ed', 'GALECIO', '2022-03-29 06:16:25'),
('a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'TUXTLA', '2022-03-29 06:16:25');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `se encuentra en` FOREIGN KEY (`subzona`) REFERENCES `subzonas` (`idsubzona`),
  ADD CONSTRAINT `tiene una` FOREIGN KEY (`zona`) REFERENCES `zonas` (`idzona`);

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `es de la` FOREIGN KEY (`idsucursal`) REFERENCES `sucursales` (`idsucursales`);

--
-- Filtros para la tabla `permiso_usuario`
--
ALTER TABLE `permiso_usuario`
  ADD CONSTRAINT `asignado al` FOREIGN KEY (`permiso_idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `es el` FOREIGN KEY (`permiso_idpermiso`) REFERENCES `permiso` (`idpermiso`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `es_categoria` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`idcategoria`),
  ADD CONSTRAINT `es_subcategoria` FOREIGN KEY (`subcategoria`) REFERENCES `subcategoria` (`idsubcategoria`);

--
-- Filtros para la tabla `referencias_cliente`
--
ALTER TABLE `referencias_cliente`
  ADD CONSTRAINT `pertenece_a_cliente` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`);

--
-- Filtros para la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD CONSTRAINT `pertenece_a_la_categoria` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `subzonas`
--
ALTER TABLE `subzonas`
  ADD CONSTRAINT `pertenece` FOREIGN KEY (`idzona`) REFERENCES `zonas` (`idzona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD CONSTRAINT `es de tipo` FOREIGN KEY (`tipo`) REFERENCES `tipo` (`idtipo`);

--
-- Filtros para la tabla `sucursal_usuario`
--
ALTER TABLE `sucursal_usuario`
  ADD CONSTRAINT `asignado a` FOREIGN KEY (`sucursal_idsucursales`) REFERENCES `sucursales` (`idsucursales`),
  ADD CONSTRAINT `tiene acceso a` FOREIGN KEY (`sucursal_idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `tiene el puesto` FOREIGN KEY (`puesto`) REFERENCES `puesto` (`idpuesto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
