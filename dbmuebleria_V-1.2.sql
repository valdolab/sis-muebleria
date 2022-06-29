-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 29-06-2022 a las 06:05:26
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
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `tiene_subcat`, `atr1`, `atr2`, `atr3`, `atr4`, `atr5`, `contado`, `especial`, `base_inicial_c1`, `ganancia_inicial_c1`, `rango_c1`, `ganancia_subsecuente_c1`, `limite_costo_c1`, `base_inicial_c2`, `ganancia_inicial_c2`, `rango_c2`, `ganancia_subsecuente_c2`, `limite_costo_c2`, `meses_pago`, `meses_garantia`, `creado_en`) VALUES
('00095e94-c070-11ec-8edf-18c04dae039e', 'ASD', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-22 00:13:47'),
('4df9bbf2-f5aa-11ec-9ebe-d481d7c3a9ad', 'PRUEBA2', 0, 'MARCA', 'QWE', 'QWE', 'QWE', 'QWE', 12, 12, 2000, 100, 100, 80, 10000, 2000, 150, 200, 130, 20000, 12, 12, '2022-06-26 23:47:08'),
('5a0be372-c010-11ec-a813-d481d7c3a9ad', 'BICIBLETA', 0, 'MARCA', 'TAMAÑO', 'LLANTAS', 'TIPO', NULL, 12, 22, 11, 11, 11, 11, 11, 22, 22, 22, 22, 22, 3, 3, '2022-04-22 00:13:47'),
('6b149c84-c010-11ec-a813-d481d7c3a9ad', 'LINEA BLANCA', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-22 00:13:47'),
('92ebf98d-c966-11ec-abb6-d481d7c3a9ad', 'ELECTRONICA', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-01 15:51:17'),
('c18a4e3f-ccd6-11ec-8195-d481d7c3a9ad', 'PRUEBA', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-06 00:52:03');

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

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nombre_cliente`, `zona`, `domicilio_cliente`, `subzona`, `tel1_cliente`, `tel2_cliente`, `cp_cliente`, `idestado_civil`, `curp`, `rfc`, `trabajo_cliente`, `puesto_cliente`, `direccion_trabajo_cliente`, `antiguedadA_trabajo_cliente`, `antiguedadM_trabajo_cliente`, `ingresos_cliente`, `tipo_ingresos_cliente`, `nombre_conyugue_cliente`, `antiguedadA_vinculo`, `antiguedadM_vinculo`, `trabajo_conyugue`, `puesto_conyugue`, `ingreso_mensual_conyugue`, `direccion_trabajo_conyugue`, `tel_conyugue`, `tipo_vivienda_cliente`, `edad_residencia`, `renta_mensual`, `ndependientes`, `nombre_aval`, `tel_aval`, `domicilio_aval`, `trabajo_aval`, `puesto_aval`, `ingreso_mensual_aval`, `nombre_conyugue_aval`, `apto_credito`, `nivel_apto`, `estado_cliente`, `no_cliente`, `masinfo`, `creado_en`) VALUES
('13e792dfb3ce9fc857347744f277b32f', 'Cliente de prueba', '378hinek-bd10-asdd-6yyh-d481d723r4ed', 'cambio de domicilio', 'lkmhlgok-6yth-hyhj-98xz-yujkasndjash', '9611920000', '9611926030', 29070, 0, 'VEGO971224HCSLNS00', 'VEGO9712245K7', 'asdasd', 'asdasd', 'asdasd', 4, 0, 5000, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 4, 0, 2, 'asdas', '9611926030', 'dsasd', 'asdasd', 'asdasda', 5000.958, 'asdasd', 1, 4, 1, 2, 1, '2022-04-03 21:48:25'),
('1679091c5a880faf6fb5e6087eb1b2dc', 'poronga2', '378hinek-bd10-asdd-6yyh-d481d723r4ed', NULL, 'lkmhlgok-6yth-hyhj-98xz-yujkasndjash', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 6, 0, '2022-04-03 21:48:59'),
('707381d68fe45ec481d00b455b632fce', 'probando lo de nocliente', '378hinek-bd10-asdd-6yyh-d481d723r4ed', NULL, 'lkmhlgok-6yth-hyhj-98xz-yujkasndjash', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 4, 0, '2022-04-01 02:06:48'),
('8f14e45fceea167a5a36dedd4bea2543', 'poronga3', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', NULL, 'yohrio96-vfgt-23nm-6765-84i34hi883dl', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 7, 0, '2022-04-03 21:52:53'),
('946622a4f13b86fb515b67f1e798614d', 'probando el nuevo id', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'cambiando el cliente sin cambiar no_cliente', 'yohrio96-vfgt-23nm-6765-84i34hi883dl', NULL, NULL, NULL, 0, 'VEGO971224HCSLNS00', 'VEGO9712245K7', NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 3, 1, 1, 0, '2022-04-03 21:48:03'),
('e4da3b7fbbce2345d7772b0674a318d5', 'poronga1', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', NULL, 'yohrio96-vfgt-23nm-6765-84i34hi883dl', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 1, 5, 0, '2022-04-03 21:47:09'),
('eccbc87e4b5ce2fe28308fd9f2a7baf3', 'Cliente de prueba 3', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'asdasd', 'yohrio96-vfgt-23nm-6765-84i34hi883dl', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 5, 1, 3, 0, '2022-04-03 21:48:34');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`iddocumento`, `name_documento`, `folio`, `serie`, `idsucursal`, `estado`, `creado_en`) VALUES
(1, 'NOTA DE VENTA', 'MAT', '0000001', 1, 1, '2022-03-29 06:17:20'),
(2, 'NOTA DE VENTA', 'TUX', '0000001', 1, 1, '2022-06-12 16:32:03');

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
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idproducto`),
  KEY `es_categoria` (`categoria`),
  KEY `es_subcategoria` (`subcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `identificador`, `codigo_barras`, `categoria`, `subcategoria`, `descripcion`, `serializado`, `atr1_producto`, `atr2_producto`, `atr3_producto`, `atr4_producto`, `atr5_producto`, `stock_min`, `stock_max`, `ext_p`, `costo`, `costo_iva`, `costo_contado`, `costo_especial`, `costo_cr1`, `costo_cr2`, `costo_p1`, `costo_p2`, `costo_eq`, `creado_en`) VALUES
('0507bbee-ccd8-11ec-8195-d481d7c3a9ad', 'qweasdzxc1', NULL, 'c18a4e3f-ccd6-11ec-8195-d481d7c3a9ad', '47422906-ccd7-11ec-8195-d481d7c3a9ad', 'prueba de prueba de product', 1, 'SAMSUNG', '6', '2', '10', NULL, NULL, NULL, NULL, 4500, 5220, 6316.2, NULL, 5846.4, 5324.4, 4.48, 4.08, 652.5, '2022-05-06 01:01:06'),
('082b0355-c68c-11ec-abb6-d481d7c3a9ad', 'wp100-asd001', NULL, '6b149c84-c010-11ec-a813-d481d7c3a9ad', '9e77b6b3-c1a7-11ec-91b0-d481d7c3a9ad', 'es una licuadora LG BLABLBL', 0, 'LG', '3', 'plastico', 'grande', NULL, NULL, NULL, NULL, 17, 19.72, 20.1144, 22.528128, 21.8892, 24.0584, 0.0273615, 0.030073, 400, '2022-04-28 00:42:07'),
('0def99df-c681-11ec-abb6-d481d7c3a9ad', 'wp100-asd002', NULL, '6b149c84-c010-11ec-a813-d481d7c3a9ad', '9aded115-c07a-11ec-8edf-18c04dae039e', 'lavadora SAMSUNG', 0, 'SAMSUNG', '3', '1', '10', '1', NULL, NULL, NULL, 7000, 8120, 9013.2, 8201.2, 9013.2, 8932, 13.32, 13.2, 400, '2022-04-27 23:23:32'),
('23bba124-c681-11ec-abb6-d481d7c3a9ad', 'wp100-asd003', NULL, '6b149c84-c010-11ec-a813-d481d7c3a9ad', '9aded115-c07a-11ec-8edf-18c04dae039e', 'lavadora patito', 0, 'PATITO', '6', '2', '10', '2', NULL, NULL, NULL, 1, 1.16, 1.2876, 1.1716, 1.2876, 1.276, 0.0016095, 0.001595, 400, '2022-04-27 23:24:09'),
('569ff4d5-c906-11ec-abb6-d481d7c3a9ad', 'wp100-asd004', NULL, '5a0be372-c010-11ec-a813-d481d7c3a9ad', NULL, 'prueba bici', 0, 'asd', '10', '2', 'montaña', NULL, NULL, NULL, NULL, 5600, 6496, 7275.52, 8876.1344, 7210.56, 7925.12, 3.33, 3.66, 1082.6666666667, '2022-05-01 04:22:27'),
('66bfc35f-c1d7-11ec-91b0-d481d7c3a9ad', 'asd', NULL, '5a0be372-c010-11ec-a813-d481d7c3a9ad', NULL, 'Aquí va la descricion mas detalla del producto', 1, 'asd', 'asd', 'asd', 'asd', NULL, NULL, NULL, NULL, 17, 19.72, 22.0864, 26.945408, 21.8892, 24.0584, 0.0273615, 0.030073, 400, '2022-04-22 00:59:04'),
('8f2d4de2-c96a-11ec-abb6-d481d7c3a9ad', '32h5g', NULL, '92ebf98d-c966-11ec-abb6-d481d7c3a9ad', 'c1451ae3-c966-11ec-abb6-d481d7c3a9ad', 'tele 32 smart', 1, 'hisense', '32', 'hd', NULL, NULL, NULL, NULL, NULL, 3200, 3712, 4825.6, 5011.2, 7424, 9280, 8, 10, 464, '2022-05-01 16:19:48'),
('9b58146b-cc01-11ec-8195-d481d7c3a9ad', 'wp100-asd006', NULL, '00095e94-c070-11ec-8edf-18c04dae039e', 'ae064f03-c07b-11ec-8edf-18c04dae039e', 'prueba con identificador en blanco', 1, 'SAMSUNG', 'asd', 'asd', 'asd', 'asd', NULL, NULL, NULL, 3000, 3480, 3897.6, 3897.6, 3897.6, 3897.6, 13.44, 13.44, 400, '2022-05-04 23:26:18'),
('b2b0fca7-f60e-11ec-9ebe-d481d7c3a9ad', 'wp100-asd0010', NULL, '4df9bbf2-f5aa-11ec-9ebe-d481d7c3a9ad', NULL, 'asdasd', 0, 'asd', 'asd', 'asd', 'asd', 'asd', 12, 12, 12, 4600, 5336, 5976.32, 5976.32, 7843.92, 11419.04, 17.64, 25.68, 400, '2022-06-27 11:45:44'),
('ecf8fb02-c680-11ec-abb6-d481d7c3a9ad', 'wp100-asd005', NULL, '6b149c84-c010-11ec-a813-d481d7c3a9ad', '9aded115-c07a-11ec-8edf-18c04dae039e', 'lavadora LG', 0, 'LG', '6', '2', '12', '1', NULL, NULL, NULL, 16, 18.56, 20.6016, 20.807616, 20.6016, 20.416, 0.025752, 0.02552, 400, '2022-04-27 23:22:37');

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
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idsubcategoria`),
  KEY `pertenece_a_la_categoria` (`categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`idsubcategoria`, `nombre`, `categoria`, `atr1`, `atr2`, `atr3`, `atr4`, `atr5`, `contado`, `especial`, `base_inicial_c1`, `ganancia_inicial_c1`, `rango_c1`, `ganancia_subsecuente_c1`, `limite_costo_c1`, `base_inicial_c2`, `ganancia_inicial_c2`, `rango_c2`, `ganancia_subsecuente_c2`, `limite_costo_c2`, `meses_pago`, `meses_garantia`, `creado_en`) VALUES
('47422906-ccd7-11ec-8195-d481d7c3a9ad', 'PRUEBA', 'c18a4e3f-ccd6-11ec-8195-d481d7c3a9ad', 'MARCA', 'ASD', 'ASD', 'ASD', NULL, 21, 12, 12, 1, 1, 1, 1, 2, 12, 12, 12, 12, 4, 12, '2022-05-06 00:55:48'),
('9aded115-c07a-11ec-8edf-18c04dae039e', 'LAVADORA', '6b149c84-c010-11ec-a813-d481d7c3a9ad', 'MARCA', 'KG', 'TAMAÑO', 'PESO', 'PRUEBA', 11, 1, 11, 0, 0, 0, 0, 10, NULL, NULL, NULL, NULL, 12, 6, '2022-04-22 00:14:19'),
('9e77b6b3-c1a7-11ec-91b0-d481d7c3a9ad', 'LICUADORA', '6b149c84-c010-11ec-a813-d481d7c3a9ad', 'MARCA', 'ASPAS', 'MATERIAL', 'TAMAÑO', NULL, 2, 12, 11, 0, 0, 0, 0, 22, NULL, NULL, NULL, NULL, 4, 4, '2022-04-22 00:14:19'),
('ae064f03-c07b-11ec-8edf-18c04dae039e', 'ASD', '00095e94-c070-11ec-8edf-18c04dae039e', 'MARCA', 'ASD', 'ASD', 'ASD', 'ASD', 12, 12, 12, 0, 0, 0, 0, 12, NULL, NULL, NULL, NULL, 12, 12, '2022-04-22 00:14:19'),
('c1451ae3-c966-11ec-abb6-d481d7c3a9ad', 'TELE', '92ebf98d-c966-11ec-abb6-d481d7c3a9ad', 'MARCA', 'PULGADAS', 'RESOLUCION', NULL, NULL, 30, 35, 100, 0, 0, 0, 0, 150, NULL, NULL, NULL, NULL, 4, 12, '2022-05-01 15:52:35');

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
('0d738354-bd56-11ec-b09f-18c04dae039e', 'prueba', '378hinek-bd10-asdd-6yyh-d481d723r4ed', '2022-04-16 07:23:03'),
('lkmhlgok-6yth-hyhj-98xz-yujkasndjash', 'subzona de galecio', '378hinek-bd10-asdd-6yyh-d481d723r4ed', '2022-03-29 06:16:55'),
('yohrio96-vfgt-23nm-6765-84i34hi883dl', 'subzona1 tuxtla', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-03-29 06:16:55');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`idsucursales`, `sucursales`, `descripcion`, `estado`, `matriz`, `tipo`, `creado_en`) VALUES
(1, 'Tuxtla-Matriz', 'Sucursal Matrix-Tuxtla Gutiérrez', 1, 1, 'a8791f44-bc7e-11ec-bf6e-d481d7c3a9ad', '2022-03-29 06:16:44'),
(2, 'Galecio', 'Sucursal de Galecio, Chiapa de Corzo', 1, 0, 'asd91f44-bc7e-11ec-bf6e-d481d7c3a9ad', '2022-03-29 06:16:44');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sucursal_usuario`
--

INSERT INTO `sucursal_usuario` (`idsucursal_usuario`, `sucursal_idusuario`, `sucursal_idsucursales`) VALUES
(1, '0a96aada-bd56-11ec-b09f-asjg75jfl382', 1),
(3, '0a96aada-bd56-11ec-b09f-asjg75jfl382', 2),
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
('81956ef4-bf77-11ec-a5db-d481d7c3a9ad', 'TIPO4'),
('829f9d7e-bf5b-11ec-a5db-d481d7c3a9ad', 'tipo de prueba'),
('a8791f44-bc7e-11ec-bf6e-d481d7c3a9ad', 'TIPO1'),
('asd91f44-bc7e-11ec-bf6e-d481d7c3a9ad', 'TIPO22'),
('pii91f44-bc7e-11ec-bf6e-d481d7c3a9qw', 'tipo3');

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
('0a96aada-bd56-11ec-b09f-asjg75jfl123', 'IGERAG', 'Ruben Aguilar González', '81df10368e0655e4801b66269fd8b973', 'Usurario', '6e3f32fa-bd10-11ec-a5db-d481d723r4ed', 1, 0, 2, '2022-03-29 05:39:17'),
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
('0a96aada-bd56-11ec-b09f-18c04dae039e', 'prueba', '2022-04-16 07:22:58'),
('378hinek-bd10-asdd-6yyh-d481d723r4ed', 'GALECIO', '2022-03-29 06:16:25'),
('6e3f32fa-bd10-gthh-hgfh-qiwwudhiqsj3', 'CAMBACEO PROPIO', '2022-03-29 06:16:25'),
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
