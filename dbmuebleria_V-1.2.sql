-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 19-04-2022 a las 19:41:32
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
  `credito1` double DEFAULT NULL,
  `credito2` double DEFAULT NULL,
  `meses_pago` int(11) DEFAULT NULL,
  `meses_garantia` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `tiene_subcat`, `atr1`, `atr2`, `atr3`, `atr4`, `atr5`, `contado`, `especial`, `credito1`, `credito2`, `meses_pago`, `meses_garantia`) VALUES
('5a0be372-c010-11ec-a813-d481d7c3a9ad', 'BICICLETA', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('6b149c84-c010-11ec-a813-d481d7c3a9ad', 'SECADORA', 0, 'MARCA', 'GENERO', 'KG', 'TAMAÑO', NULL, 10, 20, 15, 20, 12, 6);

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
(1, 'NOTA DE VENTA', 'GQ', '0000001', 2, 1, '2022-03-29 06:17:20');

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
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `idproducto` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `identificador` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `codigo_barras` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `categoria` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `subcategoria` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `serializado` tinyint(1) NOT NULL,
  `detalle_atr1` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `detalle_atr2` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `detalle_atr3` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `detalle_atr4` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `detalle_atr5` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `stock_min` int(11) DEFAULT NULL,
  `stock_max` int(11) DEFAULT NULL,
  `ext_p` int(11) DEFAULT NULL,
  `costo` double NOT NULL,
  `costo_iva` double NOT NULL,
  `costo_contado` double NOT NULL,
  `costo_especial` double NOT NULL,
  `costo_cr1` double NOT NULL,
  `costo_cr2` double NOT NULL,
  `costo_p1` double NOT NULL,
  `costo_p2` double NOT NULL,
  `costo_eq` double NOT NULL,
  PRIMARY KEY (`idproducto`)
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
  `art2` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `atr3` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `atr4` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `atr5` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contado` double DEFAULT NULL,
  `especial` double DEFAULT NULL,
  `credito1` double DEFAULT NULL,
  `credito2` double DEFAULT NULL,
  `meses_pago` int(11) DEFAULT NULL,
  `meses_garantia` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`idsucursales`, `sucursales`, `descripcion`, `estado`, `matriz`, `tipo`, `creado_en`) VALUES
(1, 'Tuxtla-Matriz', 'Sucursal Matrix-Tuxtla Gutiérrez', 1, 1, 'a8791f44-bc7e-11ec-bf6e-d481d7c3a9ad', '2022-03-29 06:16:44'),
(2, 'Galecio', 'Sucursal de Galecio, Chiapa de Corzo', 1, 0, 'asd91f44-bc7e-11ec-bf6e-d481d7c3a9ad', '2022-03-29 06:16:44'),
(3, 'sucursal prueba', 'asd', 1, 0, 'a8791f44-bc7e-11ec-bf6e-d481d7c3a9ad', '2022-04-01 19:49:58');

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
  `idusuario` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
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

INSERT INTO `usuario` (`idusuario`, `nombre`, `pass`, `rol`, `puesto`, `estado`, `superadmin`, `no_user`, `creado_en`) VALUES
('IGERAG', 'Ruben Aguilar González', '81df10368e0655e4801b66269fd8b973', 'SuperAdmin', '6e3f32fa-bd10-11ec-a5db-d481d723r4ed', 1, 1, 1, '2022-03-29 05:39:17'),
('OSV', 'Osvaldo David Velazquez', '0c04e1d2f9dec7007ecc22862711b57a', 'Usurario', '6e3f32fa-bd10-11ec-a5db-d481d723r4ed', 1, 0, 2, '2022-03-29 05:39:17');

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
-- Filtros para la tabla `referencias_cliente`
--
ALTER TABLE `referencias_cliente`
  ADD CONSTRAINT `pertenece_a_cliente` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`);

--
-- Filtros para la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD CONSTRAINT `pertenece_a_la_categoria` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`idcategoria`);

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