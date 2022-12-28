-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 03-08-2022 a las 00:40:46
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
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
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
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `tiene_subcat`, `atr1`, `atr2`, `atr3`, `atr4`, `atr5`, `contado`, `especial`, `base_inicial_c1`, `ganancia_inicial_c1`, `rango_c1`, `ganancia_subsecuente_c1`, `limite_costo_c1`, `base_inicial_c2`, `ganancia_inicial_c2`, `rango_c2`, `ganancia_subsecuente_c2`, `limite_costo_c2`, `meses_pago`, `meses_garantia`, `enganche`, `creado_en`) VALUES
('ae569a66-0838-11ed-8a78-feed01260033', 'MUEBLES', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-20 14:31:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` char(32) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_cliente` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `zona` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `domicilio_cliente` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `subzona` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `tel1_cliente` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tel2_cliente` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cp_cliente` int(11) DEFAULT NULL,
  `idestado_civil` int(1) NOT NULL DEFAULT 0,
  `curp` char(18) COLLATE utf8_spanish_ci DEFAULT NULL,
  `rfc` char(13) COLLATE utf8_spanish_ci DEFAULT NULL,
  `trabajo_cliente` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `puesto_cliente` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion_trabajo_cliente` varchar(400) COLLATE utf8_spanish_ci DEFAULT NULL,
  `antiguedadA_trabajo_cliente` int(11) NOT NULL DEFAULT 0,
  `antiguedadM_trabajo_cliente` int(11) NOT NULL DEFAULT 0,
  `ingresos_cliente` double NOT NULL DEFAULT 0,
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
  `edad_residencia` int(11) NOT NULL DEFAULT 0,
  `renta_mensual` double NOT NULL DEFAULT 0,
  `ndependientes` int(11) NOT NULL DEFAULT 0,
  `nombre_aval` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tel_aval` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `domicilio_aval` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `trabajo_aval` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `puesto_aval` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ingreso_mensual_aval` double DEFAULT NULL,
  `nombre_conyugue_aval` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apto_credito` tinyint(1) NOT NULL,
  `nivel_apto` tinyint(2) NOT NULL,
  `estado_cliente` tinyint(1) NOT NULL DEFAULT 1,
  `no_cliente` int(11) NOT NULL,
  `masinfo` tinyint(1) NOT NULL DEFAULT 0,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `idconfiguracion` int(11) NOT NULL,
  `configuracion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `valor_char` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `valor_int` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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

CREATE TABLE `documento` (
  `iddocumento` int(11) NOT NULL,
  `name_documento` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `folio` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `serie` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `idsucursal` int(11) NOT NULL,
  `estado` int(1) DEFAULT 1,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`iddocumento`, `name_documento`, `folio`, `serie`, `idsucursal`, `estado`, `creado_en`) VALUES
(1, 'NOTA DE VENTA', 'MAT', '0000001', 1, 1, '2022-03-29 06:17:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `newnotificacion`
--

CREATE TABLE `newnotificacion` (
  `idnotificaciones` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `mensaje` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `idnotificaciones` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `mensaje` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `permiso` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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

CREATE TABLE `permiso_usuario` (
  `permiso_idpermiso` int(11) NOT NULL,
  `permiso_idusuario` char(36) COLLATE utf8_spanish_ci NOT NULL
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

CREATE TABLE `producto` (
  `idproducto` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `identificador` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `codigo_barras` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `categoria` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `subcategoria` char(36) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish_ci DEFAULT NULL,
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
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `identificador`, `codigo_barras`, `categoria`, `subcategoria`, `descripcion`, `serializado`, `atr1_producto`, `atr2_producto`, `atr3_producto`, `atr4_producto`, `atr5_producto`, `stock_min`, `stock_max`, `ext_p`, `costo`, `costo_iva`, `costo_contado`, `costo_especial`, `costo_cr1`, `costo_cr2`, `costo_p1`, `costo_p2`, `costo_eq`, `costo_enganche`, `creado_en`) VALUES
('2482928a-083a-11ed-8a78-feed01260033', 'CELAYA-CELAYA', NULL, 'ae569a66-0838-11ed-8a78-feed01260033', '3c5ed5a3-0839-11ed-8a78-feed01260033', 'ANTE COMEDOR TUBULAR CELEYA SILLA CELAYA (4sillas 1 1/4\", 1banca mesa rectangular 3\" de 1.50 (x) 0.90)', 0, 'VALMAR', 'TUBULAR', 'RECTANGULAR', '4', NULL, NULL, NULL, NULL, 5941, 6892, 9304, 10700, 13026, 13646, 7.56, 7.92, 862, 987, '2022-07-20 14:42:13'),
('5b64b366-083a-11ed-8a78-feed01260033', 'LAZZIO-LAZZIO', NULL, 'ae569a66-0838-11ed-8a78-feed01260033', '3c5ed5a3-0839-11ed-8a78-feed01260033', 'ANTE COMEDOR TUBULAR MOD LAZZIO SILLAS LAZZIO (6SILLAS, 1MESA RECTANGULAR, 3\")', 0, 'VALMAR', 'TUBULAR', 'RECTANGULAR', '6', NULL, NULL, NULL, NULL, 6226, 7223, 9750, 11213, 13578, 14228, 7.52, 7.88, 903, 1025, '2022-07-20 14:43:45'),
('78227e70-083a-11ed-8a78-feed01260033', 'MONACO-MONACO', NULL, 'ae569a66-0838-11ed-8a78-feed01260033', '3c5ed5a3-0839-11ed-8a78-feed01260033', 'ANTE COMEDOR TUBULAR MOD MONACO SILLAS MONACO (6SILLAS, 1 MESA RECTANGULAR)', 0, 'VALMAR', 'TUBULAR', 'RECTANGULAR', '6', NULL, NULL, NULL, NULL, 6277, 7282, 9830, 11305, 13689, 14345, 7.5200000000000005, 7.879999999999999, 911, 1033, '2022-07-20 14:44:33'),
('929893e5-0839-11ed-8a78-feed01260033', 'DAMASCO-DAMASCO', NULL, 'ae569a66-0838-11ed-8a78-feed01260033', '3c5ed5a3-0839-11ed-8a78-feed01260033', 'ANTE COMEDOR TUBULAR MOD DAMASCO SILLA DAMASCO (4 sillas 1\", mesa rectangular 1 1/2\" de 1.22(x) 0.90)', 0, 'VALMAR', 'TUBULAR', 'RECTANGULAR', '4', NULL, NULL, NULL, NULL, 2752, 3193, 4310, 4957, 6385, 6704, 8, 8.4, 400, 536, '2022-07-20 14:38:08'),
('c1831932-0839-11ed-8a78-feed01260033', 'LIZA-SANTIAGO', NULL, 'ae569a66-0838-11ed-8a78-feed01260033', '3c5ed5a3-0839-11ed-8a78-feed01260033', 'ANTE COMEDOR TUBULAR MOD LIZA SILLAS SANTIAGO (6SILLAS, 1MESA RECTANGULAR)', 0, 'VALMAR', 'TUBULAR', 'RECTANGULAR', '6', NULL, NULL, NULL, NULL, 4260, 4942, 6672, 7672, 9587, 10032, 7.760000000000001, 8.12, 618, 753, '2022-07-20 14:39:27'),
('f03e4ddf-0839-11ed-8a78-feed01260033', 'VERSALLES-TIFFANY', NULL, 'ae569a66-0838-11ed-8a78-feed01260033', '3c5ed5a3-0839-11ed-8a78-feed01260033', 'ANTE COMEDOR TUBULAR VERSALLES SILLA TIFFANY (6sillas 1 1/4\", mesa rectangular 3\" de 1.50(x) 0.90)', 0, 'VALMAR', 'TUBULAR', 'RECTANGULAR', '6', NULL, NULL, NULL, NULL, 4842, 5617, 7583, 8720, 10785, 11290, 7.68, 8.04, 703, 834, '2022-07-20 14:40:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE `puesto` (
  `idpuesto` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `puesto` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
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

CREATE TABLE `referencias_cliente` (
  `idreferencia` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `domicilio` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `relacion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tel` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nota` text COLLATE utf8_spanish_ci NOT NULL,
  `idcliente` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
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
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`idsubcategoria`, `nombre`, `categoria`, `atr1`, `atr2`, `atr3`, `atr4`, `atr5`, `contado`, `especial`, `base_inicial_c1`, `ganancia_inicial_c1`, `rango_c1`, `ganancia_subsecuente_c1`, `limite_costo_c1`, `base_inicial_c2`, `ganancia_inicial_c2`, `rango_c2`, `ganancia_subsecuente_c2`, `limite_costo_c2`, `meses_pago`, `meses_garantia`, `enganche`, `creado_en`) VALUES
('3c5ed5a3-0839-11ed-8a78-feed01260033', 'ANTECOMEDORES', 'ae569a66-0838-11ed-8a78-feed01260033', 'MARCA', 'TIPO', 'MESA', 'SILLAS', NULL, 35, 15, 4400, 100, 400, 95, 20400, 4000, 110, 400, 105, 20000, 4, 6, 6.5, '2022-07-20 14:35:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subzonas`
--

CREATE TABLE `subzonas` (
  `idsubzona` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `subzona` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `idzona` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
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

CREATE TABLE `sucursales` (
  `idsucursales` int(11) NOT NULL,
  `sucursales` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `matriz` tinyint(1) NOT NULL DEFAULT 0,
  `tipo` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`idsucursales`, `sucursales`, `descripcion`, `estado`, `matriz`, `tipo`, `creado_en`) VALUES
(1, 'Galecio Narcía-Matriz', 'Matriz de la empresa. Aquí se encuentras los mandos medios y la gerencia. Es el punto central de las operaciones de la mueblería.', 1, 1, 'pii91f44-bc7e-11ec-bf6e-d481d7c3a9qw', '2022-03-29 06:16:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal_usuario`
--

CREATE TABLE `sucursal_usuario` (
  `idsucursal_usuario` int(11) NOT NULL,
  `sucursal_idusuario` char(36) COLLATE utf8_spanish_ci NOT NULL COMMENT 'corresponde',
  `sucursal_idsucursales` int(11) NOT NULL COMMENT 'tiene'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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

CREATE TABLE `tipo` (
  `idtipo` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_tipo` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`idtipo`, `nombre_tipo`) VALUES
('pii91f44-bc7e-11ec-bf6e-d481d7c3a9qw', 'MATRIZ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_acceso` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `rol` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `puesto` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) DEFAULT 1,
  `superadmin` tinyint(1) NOT NULL,
  `no_user` int(11) NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para manejar los usuarios del sistema';

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `usuario_acceso`, `nombre`, `pass`, `rol`, `puesto`, `estado`, `superadmin`, `no_user`, `creado_en`) VALUES
('0a96aada-bd56-11ec-b09f-asjg75jfl123', 'IGERAG', 'Ruben Aguilar González', '81df10368e0655e4801b66269fd8b973', 'SuperAdmin', '6e3f32fa-bd10-11ec-a5db-d481d723r4ed', 1, 1, 2, '2022-03-29 05:39:17'),
('0a96aada-bd56-11ec-b09f-asjg75jfl382', 'Luis', 'Luis Augusto Von Duben Aquino', 'c44688b5061756b3cca2b86c016a1535', 'SuperAdmin', '6e3f32fa-bd10-11ec-a5db-d481d723r4ed', 1, 1, 1, '2022-03-29 05:39:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE `zonas` (
  `idzona` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `zona` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `zonas`
--

INSERT INTO `zonas` (`idzona`, `zona`, `creado_en`) VALUES
('378hinek-bd10-asdd-6yyh-d481d723r4ed', 'GALECIO', '2022-03-29 06:16:25'),
('a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'TUXTLA', '2022-03-29 06:16:25');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`),
  ADD KEY `tiene una` (`zona`),
  ADD KEY `se encuentra en` (`subzona`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`idconfiguracion`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`iddocumento`),
  ADD KEY `es de la` (`idsucursal`);

--
-- Indices de la tabla `newnotificacion`
--
ALTER TABLE `newnotificacion`
  ADD PRIMARY KEY (`idnotificaciones`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`idnotificaciones`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `permiso_usuario`
--
ALTER TABLE `permiso_usuario`
  ADD PRIMARY KEY (`permiso_idpermiso`,`permiso_idusuario`),
  ADD KEY `asignado al` (`permiso_idusuario`),
  ADD KEY `es el` (`permiso_idpermiso`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `es_categoria` (`categoria`),
  ADD KEY `es_subcategoria` (`subcategoria`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`idpuesto`);

--
-- Indices de la tabla `referencias_cliente`
--
ALTER TABLE `referencias_cliente`
  ADD PRIMARY KEY (`idreferencia`),
  ADD KEY `pertenece_a_cliente` (`idcliente`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`idsubcategoria`),
  ADD KEY `pertenece_a_la_categoria` (`categoria`);

--
-- Indices de la tabla `subzonas`
--
ALTER TABLE `subzonas`
  ADD PRIMARY KEY (`idsubzona`),
  ADD KEY `pertenece` (`idzona`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`idsucursales`),
  ADD KEY `es de tipo` (`tipo`);

--
-- Indices de la tabla `sucursal_usuario`
--
ALTER TABLE `sucursal_usuario`
  ADD PRIMARY KEY (`idsucursal_usuario`),
  ADD KEY `asignado a` (`sucursal_idsucursales`),
  ADD KEY `tiene acceso a` (`sucursal_idusuario`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`idtipo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `tiene el puesto` (`puesto`),
  ADD KEY `no_user` (`no_user`);

--
-- Indices de la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD PRIMARY KEY (`idzona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `idconfiguracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `iddocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `referencias_cliente`
--
ALTER TABLE `referencias_cliente`
  MODIFY `idreferencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `idsucursales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sucursal_usuario`
--
ALTER TABLE `sucursal_usuario`
  MODIFY `idsucursal_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `no_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
