-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-06-2023 a las 18:46:58
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `almacen`;
CREATE TABLE IF NOT EXISTS `almacen` (
  `idalmacen` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `sucursal` int(11) NOT NULL,
  PRIMARY KEY (`idalmacen`),
  KEY `pertenece` (`sucursal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



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




DROP TABLE IF EXISTS `compra_tipo`;
CREATE TABLE IF NOT EXISTS `compra_tipo` (
  `idtipo_compra` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_compra` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idtipo_compra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



DROP TABLE IF EXISTS `configuracion`;
CREATE TABLE IF NOT EXISTS `configuracion` (
  `idconfiguracion` int(11) NOT NULL AUTO_INCREMENT,
  `configuracion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `valor_char` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `valor_int` int(11) DEFAULT NULL,
  PRIMARY KEY (`idconfiguracion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `documento`;
CREATE TABLE IF NOT EXISTS `documento` (
  `iddocumento` int(11) NOT NULL AUTO_INCREMENT,
  `name_documento` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `folio` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `serie` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `idsucursal` int(11) NOT NULL,
  `estado` int(1) DEFAULT '1',
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`iddocumento`),
  KEY `es de la` (`idsucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



DROP TABLE IF EXISTS `entrada`;
CREATE TABLE IF NOT EXISTS `entrada` (
  `identrada` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `comprador` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `proveedor` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `tel_proveedor` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` date NOT NULL,
  `folio_compra` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_compra` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `sucursal` int(11) NOT NULL,
  `almacen` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `no_pagos` double DEFAULT NULL,
  `pago_parcial` double DEFAULT NULL,
  `subtotal1` double NOT NULL,
  `iva` double NOT NULL,
  `subtotal2` double NOT NULL,
  `descuento` double NOT NULL DEFAULT '0',
  `total` double NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `borrado_logico` tinyint(1) NOT NULL DEFAULT '0',
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`identrada`),
  KEY `compra_de_tipo` (`tipo_compra`),
  KEY `de_la_sucursal` (`sucursal`),
  KEY `del_almacen` (`almacen`),
  KEY `comprado_del_proveedor` (`proveedor`),
  KEY `lo_compro` (`comprador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `entrada_productos`;
CREATE TABLE IF NOT EXISTS `entrada_productos` (
  `identrada_producto` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `entrada` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `producto` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio_x_unidad` double NOT NULL,
  `precio_total` double NOT NULL,
  `precio_x_unidad_iva` double DEFAULT NULL,
  `precio_total_iva` double DEFAULT NULL,
  `con_iva` tinyint(1) NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`identrada_producto`),
  KEY `pertenece_a_entrada` (`entrada`),
  KEY `es_del_producto` (`producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



DROP TABLE IF EXISTS `entrada_productos_serie`;
CREATE TABLE IF NOT EXISTS `entrada_productos_serie` (
  `identrada_producto_serie` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `entrada_productos` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `entrada` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `producto` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `almacen_actual` char(36) COLLATE utf8_spanish_ci DEFAULT NULL,
  `serie` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `vendido` tinyint(1) NOT NULL DEFAULT '0',
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`identrada_producto_serie`),
  KEY `de_la_entrada_producto` (`entrada_productos`),
  KEY `del_producto` (`producto`),
  KEY `pertenece_a_la_entrada` (`entrada`),
  KEY `esta_en_el_almacen` (`almacen_actual`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `modalidad_pago`;
CREATE TABLE IF NOT EXISTS `modalidad_pago` (
  `idmodalidad_pago` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_modalidad` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idmodalidad_pago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



DROP TABLE IF EXISTS `movimiento`;
CREATE TABLE IF NOT EXISTS `movimiento` (
  `idmovimiento` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `salida` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date DEFAULT NULL,
  `abono` double DEFAULT '0',
  `descuento` double DEFAULT '0',
  `recargo` double DEFAULT '0',
  `saldo_al_momento` double DEFAULT '0',
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idmovimiento`),
  KEY `movimieto_de_la_salida` (`salida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `movimiento_atrasos`;
CREATE TABLE IF NOT EXISTS `movimiento_atrasos` (
  `idmovimiento_atraso` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `salida` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_periodo_atraso` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `periodo_atraso` double NOT NULL,
  `dias_atraso` double NOT NULL,
  `base_atraso` double NOT NULL,
  `debe_atrasado` double NOT NULL,
  `fecha_inicio` date NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idmovimiento_atraso`),
  KEY `atraso_de_la_salida` (`salida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



DROP TABLE IF EXISTS `newnotificacion`;
CREATE TABLE IF NOT EXISTS `newnotificacion` (
  `idnotificaciones` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `mensaje` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`idnotificaciones`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `notificaciones`;
CREATE TABLE IF NOT EXISTS `notificaciones` (
  `idnotificaciones` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `mensaje` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`idnotificaciones`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `permiso`;
CREATE TABLE IF NOT EXISTS `permiso` (
  `idpermiso` int(11) NOT NULL AUTO_INCREMENT,
  `permiso` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idpermiso`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



DROP TABLE IF EXISTS `permiso_usuario`;
CREATE TABLE IF NOT EXISTS `permiso_usuario` (
  `permiso_idpermiso` int(11) NOT NULL,
  `permiso_idusuario` char(36) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`permiso_idpermiso`,`permiso_idusuario`),
  KEY `asignado al` (`permiso_idusuario`),
  KEY `es el` (`permiso_idpermiso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `idproducto` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `identificador` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `codigo_barras` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `categoria` char(36) COLLATE utf8_spanish_ci DEFAULT NULL,
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
  `en_stock` int(11) NOT NULL DEFAULT '0',
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idproducto`),
  KEY `es_categoria` (`categoria`),
  KEY `es_subcategoria` (`subcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE IF NOT EXISTS `proveedor` (
  `idproveedor` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_proveedor` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `tel_proveedor` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idproveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS `puesto`;
CREATE TABLE IF NOT EXISTS `puesto` (
  `idpuesto` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `puesto` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idpuesto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `referencias_cliente`;
CREATE TABLE IF NOT EXISTS `referencias_cliente` (
  `idreferencia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `domicilio` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `relacion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tel` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nota` mediumtext COLLATE utf8_spanish_ci NOT NULL,
  `idcliente` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idreferencia`),
  KEY `pertenece_a_cliente` (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=412 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `salida`;
CREATE TABLE IF NOT EXISTS `salida` (
  `idsalida` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `vendedor` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `cliente` char(32) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_salida` date DEFAULT NULL,
  `documento` int(11) DEFAULT NULL,
  `folio_venta` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `folio_venta_serie` int(11) DEFAULT NULL,
  `tipo_venta` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `modalidad_pago` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `no_pagos` double DEFAULT '0',
  `pago_parcial` double DEFAULT '0',
  `per_dia_pago` date DEFAULT NULL,
  `dias_pago_semanal` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dias_pago_quincenal` int(11) DEFAULT NULL,
  `dias_pago_quincenal_2` int(11) DEFAULT NULL,
  `dias_pago_mensual` int(11) DEFAULT NULL,
  `enganche` double NOT NULL DEFAULT '0',
  `subtotal1` double NOT NULL,
  `iva` double NOT NULL,
  `subtotal2` double NOT NULL,
  `descuento` double NOT NULL DEFAULT '0',
  `total_general` double NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `nivel_salida` tinyint(2) NOT NULL DEFAULT '0',
  `nota_salida` mediumtext COLLATE utf8_spanish_ci,
  `fecha_ideal` mediumtext COLLATE utf8_spanish_ci,
  `borrado_logico` tinyint(1) NOT NULL DEFAULT '0',
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idsalida`),
  KEY `venta_hecha_por` (`vendedor`),
  KEY `vendido_a` (`cliente`),
  KEY `tipo_de_venta` (`tipo_venta`),
  KEY `es del folio` (`documento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `salida_acuerdo`;
CREATE TABLE IF NOT EXISTS `salida_acuerdo` (
  `idsalida_acuerdo` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `salida` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `modalidad_actual` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `dia_semanal` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dia_quincenal` int(11) DEFAULT NULL,
  `dia_quincenal_2` int(11) DEFAULT NULL,
  `dia_mensual` int(11) DEFAULT NULL,
  `nuevo_pago` double NOT NULL DEFAULT '0',
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idsalida_acuerdo`),
  KEY `acuerdo_actual_de_la_salida` (`salida`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `salida_productos`;
CREATE TABLE IF NOT EXISTS `salida_productos` (
  `idsalida_producto` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `salida` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `producto` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `tipo_precio` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `precio_x_unidad` double NOT NULL,
  `precio_total` double NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idsalida_producto`),
  KEY `pertenece_a_salida` (`salida`),
  KEY `es_el_producto` (`producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `salida_productos_origen`;
CREATE TABLE IF NOT EXISTS `salida_productos_origen` (
  `idsalida_producto_origen` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `salida_productos` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `salida` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `producto` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `serie_origen` char(36) COLLATE utf8_spanish_ci DEFAULT NULL,
  `serie_completa` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idsalida_producto_origen`),
  KEY `es_de_la_salida_productos` (`salida_productos`),
  KEY `es_de_la_salida` (`salida`),
  KEY `es_de_el_producto` (`producto`),
  KEY `salida_de_origen` (`serie_origen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `salida_usuarios_a_cargo`;
CREATE TABLE IF NOT EXISTS `salida_usuarios_a_cargo` (
  `idsalida_usuarios_a_cargo` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `salida` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_admin_a_cargo` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `vendedor_a_cargo` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idsalida_usuarios_a_cargo`),
  KEY `a_cargo_de_la_salida` (`salida`),
  KEY `persona_admin_a_cargo` (`usuario_admin_a_cargo`),
  KEY `vendedor_a_cargo` (`vendedor_a_cargo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


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


DROP TABLE IF EXISTS `subzonas`;
CREATE TABLE IF NOT EXISTS `subzonas` (
  `idsubzona` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `subzona` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `idzona` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idsubzona`),
  KEY `pertenece` (`idzona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


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


DROP TABLE IF EXISTS `sucursal_usuario`;
CREATE TABLE IF NOT EXISTS `sucursal_usuario` (
  `idsucursal_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `sucursal_idusuario` char(36) COLLATE utf8_spanish_ci NOT NULL COMMENT 'corresponde',
  `sucursal_idsucursales` int(11) NOT NULL COMMENT 'tiene',
  PRIMARY KEY (`idsucursal_usuario`),
  KEY `asignado a` (`sucursal_idsucursales`),
  KEY `tiene acceso a` (`sucursal_idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `tipo`;
CREATE TABLE IF NOT EXISTS `tipo` (
  `idtipo` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_tipo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idtipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para manejar los usuarios del sistema';


DROP TABLE IF EXISTS `venta_tipo`;
CREATE TABLE IF NOT EXISTS `venta_tipo` (
  `idtipo_venta` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_venta` varchar(100) CHARACTER SET utf32 COLLATE utf32_spanish_ci NOT NULL,
  PRIMARY KEY (`idtipo_venta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `zonas`;
CREATE TABLE IF NOT EXISTS `zonas` (
  `idzona` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `zona` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idzona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

ALTER TABLE `almacen`
  ADD CONSTRAINT `pertence a almacen` FOREIGN KEY (`sucursal`) REFERENCES `sucursales` (`idsucursales`);


ALTER TABLE `cliente`
  ADD CONSTRAINT `se encuentra en` FOREIGN KEY (`subzona`) REFERENCES `subzonas` (`idsubzona`),
  ADD CONSTRAINT `tiene una` FOREIGN KEY (`zona`) REFERENCES `zonas` (`idzona`);


ALTER TABLE `documento`
  ADD CONSTRAINT `es de la` FOREIGN KEY (`idsucursal`) REFERENCES `sucursales` (`idsucursales`);


ALTER TABLE `entrada`
  ADD CONSTRAINT `compra_de_tipo` FOREIGN KEY (`tipo_compra`) REFERENCES `compra_tipo` (`idtipo_compra`),
  ADD CONSTRAINT `comprado_del_proveedor` FOREIGN KEY (`proveedor`) REFERENCES `proveedor` (`idproveedor`),
  ADD CONSTRAINT `de_la_sucursal` FOREIGN KEY (`sucursal`) REFERENCES `sucursales` (`idsucursales`),
  ADD CONSTRAINT `del_almacen` FOREIGN KEY (`almacen`) REFERENCES `almacen` (`idalmacen`),
  ADD CONSTRAINT `lo_compro` FOREIGN KEY (`comprador`) REFERENCES `usuario` (`idusuario`);


ALTER TABLE `entrada_productos`
  ADD CONSTRAINT `es_del_producto` FOREIGN KEY (`producto`) REFERENCES `producto` (`idproducto`),
  ADD CONSTRAINT `pertenece_a_entrada` FOREIGN KEY (`entrada`) REFERENCES `entrada` (`identrada`);


ALTER TABLE `entrada_productos_serie`
  ADD CONSTRAINT `de_la_entrada_producto` FOREIGN KEY (`entrada_productos`) REFERENCES `entrada_productos` (`identrada_producto`),
  ADD CONSTRAINT `del_producto` FOREIGN KEY (`producto`) REFERENCES `producto` (`idproducto`),
  ADD CONSTRAINT `esta_en_el_almacen` FOREIGN KEY (`almacen_actual`) REFERENCES `almacen` (`idalmacen`),
  ADD CONSTRAINT `pertenece_a_la_entrada` FOREIGN KEY (`entrada`) REFERENCES `entrada` (`identrada`);


ALTER TABLE `movimiento`
  ADD CONSTRAINT `movimieto_de_la_salida` FOREIGN KEY (`salida`) REFERENCES `salida` (`idsalida`);


ALTER TABLE `movimiento_atrasos`
  ADD CONSTRAINT `atraso_de_la_salida` FOREIGN KEY (`salida`) REFERENCES `salida` (`idsalida`);


ALTER TABLE `permiso_usuario`
  ADD CONSTRAINT `asignado al` FOREIGN KEY (`permiso_idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `es el` FOREIGN KEY (`permiso_idpermiso`) REFERENCES `permiso` (`idpermiso`);


ALTER TABLE `producto`
  ADD CONSTRAINT `es_categoria` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`idcategoria`),
  ADD CONSTRAINT `es_subcategoria` FOREIGN KEY (`subcategoria`) REFERENCES `subcategoria` (`idsubcategoria`);


ALTER TABLE `referencias_cliente`
  ADD CONSTRAINT `pertenece_a_cliente` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`);


ALTER TABLE `salida`
  ADD CONSTRAINT `es del folio` FOREIGN KEY (`documento`) REFERENCES `documento` (`iddocumento`),
  ADD CONSTRAINT `tipo_de_venta` FOREIGN KEY (`tipo_venta`) REFERENCES `venta_tipo` (`idtipo_venta`),
  ADD CONSTRAINT `vendido_a` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`idcliente`),
  ADD CONSTRAINT `venta_hecha_por` FOREIGN KEY (`vendedor`) REFERENCES `usuario` (`idusuario`);


ALTER TABLE `salida_acuerdo`
  ADD CONSTRAINT `modalidad_actual_de_la_salida` FOREIGN KEY (`salida`) REFERENCES `salida` (`idsalida`);


ALTER TABLE `salida_productos`
  ADD CONSTRAINT `es_el_producto` FOREIGN KEY (`producto`) REFERENCES `producto` (`idproducto`),
  ADD CONSTRAINT `pertenece_a_salida` FOREIGN KEY (`salida`) REFERENCES `salida` (`idsalida`);


ALTER TABLE `salida_productos_origen`
  ADD CONSTRAINT `es_de_el_producto` FOREIGN KEY (`producto`) REFERENCES `producto` (`idproducto`),
  ADD CONSTRAINT `es_de_la_salida` FOREIGN KEY (`salida`) REFERENCES `salida` (`idsalida`),
  ADD CONSTRAINT `es_de_la_salida_productos` FOREIGN KEY (`salida_productos`) REFERENCES `salida_productos` (`idsalida_producto`),
  ADD CONSTRAINT `salida_de_origen` FOREIGN KEY (`serie_origen`) REFERENCES `entrada_productos_serie` (`identrada_producto_serie`);


ALTER TABLE `salida_usuarios_a_cargo`
  ADD CONSTRAINT `a_cargo_de_la_salida` FOREIGN KEY (`salida`) REFERENCES `salida` (`idsalida`),
  ADD CONSTRAINT `persona_admin_a_cargo` FOREIGN KEY (`usuario_admin_a_cargo`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `vendedor_a_cargo` FOREIGN KEY (`vendedor_a_cargo`) REFERENCES `usuario` (`idusuario`);


ALTER TABLE `subcategoria`
  ADD CONSTRAINT `pertenece_a_la_categoria` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `subzonas`
  ADD CONSTRAINT `pertenece` FOREIGN KEY (`idzona`) REFERENCES `zonas` (`idzona`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `sucursales`
  ADD CONSTRAINT `es de tipo` FOREIGN KEY (`tipo`) REFERENCES `tipo` (`idtipo`);


ALTER TABLE `sucursal_usuario`
  ADD CONSTRAINT `asignado a` FOREIGN KEY (`sucursal_idsucursales`) REFERENCES `sucursales` (`idsucursales`),
  ADD CONSTRAINT `tiene acceso a` FOREIGN KEY (`sucursal_idusuario`) REFERENCES `usuario` (`idusuario`);


ALTER TABLE `usuario`
  ADD CONSTRAINT `tiene el puesto` FOREIGN KEY (`puesto`) REFERENCES `puesto` (`idpuesto`);



INSERT INTO `almacen` (`idalmacen`, `nombre`, `sucursal`) VALUES
('43ad1e21-f6a5-11ed-a2bc-feed01180002', 'BODEGA', 1);


INSERT INTO `categoria` (`idcategoria`, `nombre`, `tiene_subcat`, `atr1`, `atr2`, `atr3`, `atr4`, `atr5`, `contado`, `especial`, `base_inicial_c1`, `ganancia_inicial_c1`, `rango_c1`, `ganancia_subsecuente_c1`, `limite_costo_c1`, `base_inicial_c2`, `ganancia_inicial_c2`, `rango_c2`, `ganancia_subsecuente_c2`, `limite_costo_c2`, `meses_pago`, `meses_garantia`, `enganche`, `creado_en`) VALUES
('b6545c29-07e5-11ee-92a1-feed01180002', 'ELECTRONICA', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-10 23:22:48'),
('cb80e827-f6a3-11ed-a2bc-feed01180002', 'LINEA BLANCA', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-20 00:18:06');



INSERT INTO `cliente` (`idcliente`, `nombre_cliente`, `zona`, `domicilio_cliente`, `subzona`, `tel1_cliente`, `tel2_cliente`, `cp_cliente`, `idestado_civil`, `curp`, `rfc`, `trabajo_cliente`, `puesto_cliente`, `direccion_trabajo_cliente`, `antiguedadA_trabajo_cliente`, `antiguedadM_trabajo_cliente`, `ingresos_cliente`, `tipo_ingresos_cliente`, `nombre_conyugue_cliente`, `antiguedadA_vinculo`, `antiguedadM_vinculo`, `trabajo_conyugue`, `puesto_conyugue`, `ingreso_mensual_conyugue`, `direccion_trabajo_conyugue`, `tel_conyugue`, `tipo_vivienda_cliente`, `edad_residencia`, `renta_mensual`, `ndependientes`, `nombre_aval`, `tel_aval`, `domicilio_aval`, `trabajo_aval`, `puesto_aval`, `ingreso_mensual_aval`, `nombre_conyugue_aval`, `apto_credito`, `nivel_apto`, `estado_cliente`, `no_cliente`, `masinfo`, `creado_en`) VALUES
('013d407166ec4fa56eb1e1f8cbe183b9', 'OCTAVIO ROMAN MOLINA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '240f9cb9-65e4-11ed-8a78-feed01260033', '9612959410', NULL, 29180, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 138, 0, '2022-12-12 22:43:35'),
('02522a2b2726fb0a03bb19f2d8d9524d', 'ROBERTO RUIZ MOLINA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', 'a5ef60ca-66d4-11ed-8a78-feed01260033', '9612936619', NULL, 29176, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 134, 0, '2022-12-12 22:27:24'),
('069059b7ef840f0c74a814ec9237b6ec', 'RUDI ALBERTO SOLIS SERRANO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '01de812e-65d7-11ed-8a78-feed01260033', '9614812432', NULL, 29178, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 126, 0, '2022-12-12 21:48:07'),
('07041c56817634bb15e75c2cba43383e', 'ERIKA JANETH INFANTE NANDUCA', 'd590531d-65da-11ed-8a78-feed01260033', 'PRIV DE LA12A OTE SIN  NUMERO', '4e03d05c-6ab5-11ed-8a78-feed01260033', '9617146763', NULL, 29150, 1, 'IANE860818MCSNNR03', NULL, 'EN EL HOGAR', 'AMA DE CASA', NULL, 0, 0, 0, 'Quincenal', 'ANGEL GONZALEZ VELASCO', 13, 0, 'NEGOCIO PROPIO', 'MAESTRO MECANICO', 24000, 'MISMO DOMICILIO', '9611992716', 'Propia', 10, 0, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 123, 1, '2022-12-12 21:35:15'),
('072b030ba126b2f4b2374f342be9ed44', 'CITLALI PEREZ PEREZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', 'd43ae49f-6780-11ed-8a78-feed01260033', '9612214718', NULL, 29179, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 60, 0, '2022-11-18 20:38:23'),
('092a367c5a70155b17ef9b329964b393', 'DELFINA ELIZABETH ALVAREZ PALACIOS', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'TULIPAN LTE 9 MZ 61', 'd517f521-66c2-11ed-8a78-feed01260033', '9614060901', NULL, 29018, 1, 'AAPD840701MCSLLL03', NULL, 'POLICIA ESTATAL', 'VIGILANTE', 'DIF ESTATAL, PASO EL LIMON', 3, 0, 4100, 'Quincenal', 'JULIO CESAR MATEOS LOPEZ', 18, 0, 'TAXISTA', 'TAXISTA', 8000, 'TUXTLA GUTIERREZ', '9611663612', 'Rentada', 5, 0, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 32, 1, '2022-11-17 22:04:03'),
('1012ed3411b9bbfebd1cd316faa73518', 'NATALIO MORENO SARAUZ', 'd590531d-65da-11ed-8a78-feed01260033', 'ANTES DEL VIVERO, BARRIO SAN FRANCISCO', 'e04830b5-65da-11ed-8a78-feed01260033', '9611284742', NULL, 29150, 1, 'MOSN730106HCSRRT02', NULL, 'ALBAÑIL Y FONTANERO', 'ALBAÑIL Y FONTANERO', 'TUXTLA GUTIERREZ', 25, 0, 2500, 'Semanal', 'MARINELLI MARROQUIN ALBORES', 30, 0, NULL, NULL, 0, NULL, '9611079050', 'Propia', 22, 0, 0, 'AMPARO SARAUZ GUTIERREZ ', NULL, 'BARRIO SAN FRANCISCO, SUCHIAPA', NULL, NULL, NULL, NULL, 1, 0, 1, 15, 1, '2022-11-16 19:43:40'),
('1385974ed5904a438616ff7bdb3f7439', 'TERESA YOLANDA MOLINA ALVAREZ', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'DOMICILIO CONOCIDO', '22791dce-676d-11ed-8a78-feed01260033', '9613026907', NULL, NULL, 1, NULL, NULL, 'HOSPITAL ARBOLEDAS', 'ADMINISTRADORA', '16 PTE NTE NUMERO 436', 2, 0, 6750, 'Quincenal', 'RAUL SANTELIZ MUÑOS', 8, 0, 'HOSPITAL ARBOLEDAS', 'ENFERMERO', 19800, '16 PTE NTE NUMERO 436', '9612958945', 'Rentada', 0, 4000, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 140, 1, '2022-12-12 23:39:44'),
('17690c01ce7fe1781cdfd8137869d021', 'MARIA ELENA BALCAZAR SANTOS', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '3A SUR PTE SIN NUMERO', '2160574e-66c5-11ed-8a78-feed01260033', '9611299952', NULL, 29169, 0, 'BASE750313MCSLNL01', NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 38, 0, '2022-11-17 23:05:17'),
('1c919f2cd33519db2cfc66df1fb593cf', 'REYNA MIREYA DIAZ VAZQUEZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'CALLE CENTRAL SUR SIN NUMERO', '14c7fad4-65e1-11ed-8a78-feed01260033', '9612505353', NULL, 29180, 1, 'DIVR920111MCSZZY03', NULL, 'NEGOCIO PROPIO', 'VENTA DE CENAS Y ANTONJOS', 'MISMO DOMICILIO', 0, 0, 900, 'Semanal', 'VICTOR MANUEL ALVARES DOMINGUEZ', 3, 0, 'ALBAÑIL', 'ALBAÑIL', 11000, 'TUXTLA GUTIERREZ', '9612182228', 'Rentada', 2, 800, 0, 'BRIGIDA GUADALUPE VASQUEZ GOMEZ', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 57, 1, '2022-11-18 20:28:59'),
('1d3c84c21cc91e1241850217bc6b2c76', 'DEYSI DEL ROSARIO RUIZ PEREZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'ABAJO DE LA IGLESIA CATOLICA SIN NUMERO', 'aa719c1c-66c1-11ed-8a78-feed01260033', '9614261697', NULL, 29169, 1, 'RUPD030713MCSZRYA4', NULL, 'EN EL HOGAR', 'AMA DE CASA', NULL, 0, 0, 0, 'Quincenal', 'JUAN CARLOS TRUJILLO SERRANO', 3, 0, 'PEPSI', 'VENDEDOR', 10000, 'RIBERA CUPIA', '9613861359', 'Rentada', 1, 500, 1, 'MARIA CONCEPCION PEREZ LOPEZ', '9612321301', 'CALLE DOMITILA SIN NUMERO, AMERICA LIBRE \"DIFIERE DE LA REFERENCIA\"', NULL, NULL, NULL, NULL, 1, 0, 1, 31, 1, '2022-11-17 21:56:22'),
('1dbaa611306ed6e2db4cb9e385a976cb', 'ROBERTO MARROQUIN VAZQUEZ', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'CALLEJON LOS LOPEZ 98', 'yohrio96-vfgt-23nm-6765-84i34hi883dl', '9616646948', NULL, 29019, 1, 'MAVR730424HCSRZB04', NULL, 'NEGOCIO PROPIO', 'TALLER DE HOJALATERIA Y PINTURA', 'LOMA BONITA', 5, 0, 6000, 'Semanal', 'GRACIELA LOPEZ ZAVALETA', 4, 0, 'NEGOCIO PROPIO', 'TAQUERIA', 7000, 'LOMA BONITA', '9611226694', 'Propia', 27, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 54, 1, '2022-11-18 18:55:41'),
('1ff1de774005f8da13f42943881c655f', 'JUAN JESUS MEDINA GUILLEN', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'DOMICILIO CONOCIDO', '01d3e8b1-65f6-11ed-8a78-feed01260033', '9611351519', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 24, 0, '2022-11-16 21:33:04'),
('24868c15b7dc648197d9c966e3ab914b', 'KARLA BELZAY HERNANDEZ PEREZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'BARRIO TIERRA BLANCA', '14c7fad4-65e1-11ed-8a78-feed01260033', '9616509189', NULL, 29180, 1, 'HEPK940414MCSRRR02', NULL, 'EN EL HOGAR', 'AMA DE CASA', NULL, 0, 0, 0, 'Quincenal', 'JESUS GOMEZ SOLIS', 9, 0, 'POLICIA ESTATAL', 'POLICIA RAZO', 8000, 'TUXTLA GUTIERREZ', '9616509189', 'Propia', 30, 0, 2, 'EL MARIDO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 55, 1, '2022-11-18 19:59:16'),
('261caceef1b858c58f90f90dafe3abb7', 'YANETH MOLINA SANCHEZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'CALLE EMILIANO ZAPATA, RUMBO A LA NORIA', 'c8962db7-65d4-11ed-8a78-feed01260033', '9611701361', NULL, 29180, 1, 'MOSY871112MCSLNN06', NULL, 'EN EL HOGAR', 'AMA DE CASA', NULL, 0, 0, 0, 'Quincenal', 'LEYBER SANTILLAN DOMINGUEZ', 13, 0, 'SEGURIDAD PUBLICA', 'GUARDIA DE POLICIA', 9000, 'AEROPUERTO INTERNACIONAL', '9611020892', 'Familiares', 13, 0, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 141, 1, '2022-12-13 17:24:02'),
('27383a1c423be193a00d65a9bc62a6a4', 'ALEJANDRA PEREZ SIMUTA', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'AV CHIAPA, TRINITARIA Y SIMOJOVEL', 'b55ce226-66cd-11ed-8a78-feed01260033', '9613629573', NULL, 29019, 1, 'PESA940629MCSRML00', NULL, 'NEGOCIO PROPIO', 'VENTA DE PRODUCTO ESTAJON, NATURA', 'TUXTLA GUTIERREZ', 3, 0, 5000, 'Quincenal', 'HECTOR SANTOS SANDOVAL HERNANDEZ', 6, 0, 'TESORO MUNICIPAL', 'GUARURA', 20000, 'MOTOCINTLA', '9613223714', 'Propia', 25, 0, 3, 'EL MARIDO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 42, 1, '2022-11-17 23:23:16'),
('28f3e92f8e0cde96fee4caaf3c93daee', 'ALEJANDRO BOLIVAR MENDOZA', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'C VERACRUZ NO. 788', '7bf4593a-6c3b-11ed-8a78-feed01260033', '9614298273', NULL, 29029, 1, 'BOMA700418HCSLNL07', NULL, 'JUBILADO DE PEMEX', 'JUBILADO', NULL, 0, 0, 6000, 'Quincenal', 'HUGUETTE QUEVEDO VERA', 16, 0, 'EN EL HOGAR', 'AMA DE CASA', 0, NULL, '9613534857', 'Propia', 16, 0, 2, 'LA ESPOSA', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 79, 1, '2022-11-24 21:14:39'),
('2a38a4a9316c49e5a833517c45d31070', 'BERENICE ROBLERO VAZQUEZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '2160574e-66c5-11ed-8a78-feed01260033', '9613317510', NULL, 29169, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 88, 0, '2022-11-25 21:02:27'),
('2dea84749df7aa151bf89c548ce895bb', 'LETICIA GALLEGOS HERNANDES', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'AV CENTRAL PTE SIN NUMERO Y RUMBO AL RIO', '14c7fad4-65e1-11ed-8a78-feed01260033', '9611732298', NULL, 29180, 1, 'GAHL791107MCSLRT03', NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', 'BELISARIO MENDOZA ESTRADA', 27, 0, 'MEDICO', 'MEDICO', 10000, 'COMITAN', '9611732298', 'Propia', 42, 0, 2, 'ANITA HERNANDEZ CALVO', '9613668654', 'JULIAN GRAJALES', NULL, NULL, NULL, NULL, 1, 0, 1, 13, 1, '2022-11-16 19:16:15'),
('2edfe106cf165db3bc1244abfc4d232b', 'SAUL GOMEZ HERNANDEZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '14c7fad4-65e1-11ed-8a78-feed01260033', '9614697958', NULL, 29180, 1, 'GOHS781130HCSMRL06', NULL, 'NEGOCIO PROPIO', 'MAESTRO CARPINTERO', 'MISMO DOMICILIO', 21, 0, 2000, 'Semanal', 'MARILU DOMINGUEZ RAMIREZ', 18, 0, 'EMPLEADA DOMESTICA', 'EMPLEADA DOMESTICA', 2000, 'JULIAN GRAJALES', NULL, 'Propia', 19, 0, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 68, 1, '2022-11-22 22:15:54'),
('2f9560b09a37a46c49a1885f47a1ac0f', 'YOLANDA MENDEZ MENDOZA', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '19 AV SUR PTE NO. 941', 'b86bb966-74c9-11ed-8a78-feed01260033', '9612130972', NULL, 29066, 0, 'MEMY580124MCSNNL04', NULL, 'SECRETARIA DE SALUD', 'LABORATORISTA', '9A SUR, CALLE CENTRAL Y 2A OTE SIN NUMERO', 45, 0, 11400, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 7, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 113, 1, '2022-12-05 18:32:00'),
('33d086734fda71e3c10f0a7cfe18a6c6', 'FLOYDE SANCHEZ LOPEZ', 'd590531d-65da-11ed-8a78-feed01260033', '3A AV SUR PTE NUMERO 340', '4e03d05c-6ab5-11ed-8a78-feed01260033', '9614581433', NULL, 29150, 1, 'SALF790411MCSNPL03', NULL, 'NEGOCIO PROPIO', 'VENTA DE CERVEZAS Y BOTANAS', 'MISMO DOMICILIO', 10, 0, 3500, 'Semanal', 'WILLIAM JAVIER MONTEJO NUCAMENDI', 10, 0, 'NEGOCIO PROPIO', 'MISMO QUE LA ESPOSA', 0, 'MISMO DOMICILIO', '9613354498', 'Propia', 10, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 78, 1, '2022-11-24 20:59:11'),
('33e75ff09dd601bbe69f351039152189', 'ANDREA DE JESUS RAMIREZ ESCOBAR', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'DOMICILIO CONOCIDO', '01d3e8b1-65f6-11ed-8a78-feed01260033', '9611946556', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 28, 0, '2022-11-16 21:56:32'),
('34907053fc0f287789116252e776daa2', 'EDUVINA CERIOLI GONZALEZ ROBLERO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'ANDADOR DALIA NORTE 3.311', 'b9628f7b-65dc-11ed-8a78-feed01260033', '9612975083', NULL, 29165, 1, 'GORE770829MCSNBD09', NULL, 'LIMPIEZA', 'AYUDANTE', 'JARDINES DEL GRIJALVA', 1, 0, 2200, 'Quincenal', 'JOEL DE JESUS ROMEO PASCUAL', 5, 0, 'POLARIZADOS E INSTALACION DE ALARMAS', 'AYUDANTE', 4000, 'TUXTLA GUTIERREZ', '9613047073', 'Propia', 13, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 7, 1, '2022-11-16 18:37:24'),
('375cf1e6e3aa2a37fb4adbbdddd39000', 'CRISTAN JOAHN RAMOS FLECHA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '5e909200-65f4-11ed-8a78-feed01260033', '9611062282', '9981961006', 29180, 0, 'RAFC020923HCSMLRA2', NULL, 'AEROPUERTO INTERNACIONAL', 'BARTENDER', 'AEROPUERTO INTERNACIONAL', 1, 0, 3000, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 20, 0, 0, 'LLUVIA CORDOBA RUIZ', NULL, 'IGNACIO ALLENDE', NULL, NULL, NULL, NULL, 1, 0, 1, 23, 1, '2022-11-16 21:29:05'),
('38e422200245116b5cb324565d8de73f', 'ELISABETH NORMA GUTIERREZ DIAZ', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'CALZADA A SUCHIAPA 60,, CALLEJON EL GALLO', 'yohrio96-vfgt-23nm-6765-84i34hi883dl', '9612493004', NULL, 29049, 1, 'GUDE671227MCSTZL04', NULL, 'NEGOCIO PROPIO', 'VENTA DE HAMBURGUESAS', 'AMPLIACION LOMA BONITA', 7, 0, 1800, 'Semanal', 'JORGE ANTONIO SOLIZ SOLIZ', 2, 0, 'AUTOBUSES MAYA', 'CHOFER', 6000, 'TUXTLA GUTIERREZ', NULL, 'Propia', 18, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, 1, '2023-06-10 23:01:39'),
('3b509ce2d9a41fda249b720e20112ac8', 'ANALIN DOMINGUEZ MARROQUIN', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '240f9cb9-65e4-11ed-8a78-feed01260033', '9611762796', NULL, 29180, 1, 'DOMA850731MCSMRN01', NULL, 'EN EL HOGAR', 'AMA DE CASA', NULL, 0, 0, 0, 'Quincenal', 'VICTOR MANUEL GOMEZ REYNOSA', 18, 0, 'POLICIA', 'POLICIA', 6000, NULL, '9611097970', 'Propia', 18, 0, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 44, 1, '2022-11-18 00:00:13'),
('3be225645091ec11f22003c419cf5919', 'MOISES MEJIA FLORES', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'C CENTRAL SIN NUMERO', 'd43ae49f-6780-11ed-8a78-feed01260033', '9611657715', NULL, 29179, 1, 'MEFM860901HCSJLS08', NULL, 'AEROPUERTO INTERNACIONAL', 'TAXISTA', 'AEROPUERTO INTERNACIONAL', 3, 0, 4000, 'Quincenal', 'DIANA VIRGINIA COELLO MENDEZ', 0, 0, 'EN EL HOGAR', 'AMA DE CASA', 0, NULL, '9613162096', 'Rentada', 2, 1000, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 102, 1, '2022-12-05 15:45:01'),
('3d4fae0365a456af9e580fe8d43df515', 'LUZ MARIA CRUZ NARCIA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '01de812e-65d7-11ed-8a78-feed01260033', '9616679173', NULL, 29178, 0, 'CUNL880804MCSRRZ00', NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 59, 0, '2022-11-18 20:35:47'),
('41ba14ab3ef8a4a669ce29433e11d3cd', 'JESUS AUTREY PERES MALDONADO', 'f23461b0-65de-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '00bff561-65df-11ed-8a78-feed01260033', '9612527758', NULL, 29380, 0, 'PEMJ791224HCSRLS07', NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 41, 0, '2022-11-17 23:13:34'),
('42a0e188f5033bc65bf8d78622277c4e', 'BERNABE JONAPA NARCIA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '01de812e-65d7-11ed-8a78-feed01260033', '9611869910', NULL, 29178, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 136, 0, '2022-12-12 22:29:16'),
('42fa35379e271d074776f6372818ddd7', 'LEYDI DIANA MARROQUIN SANCHEZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'CALLE INOMINADA N. 17, A UN COSTADO DEL KINDER', '240f9cb9-65e4-11ed-8a78-feed01260033', '9613215069', NULL, 29180, 0, 'MASL970621MCSRNY02', NULL, 'AEROPUERTO INTERNACIONAL', 'OPERADORA', 'AEROPUERTO INTERNACIONAL', 0, 4, 3200, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 24, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 14, 1, '2022-11-16 19:28:56'),
('43ec517d68b6edd3015b3edc9a11367b', 'ESTRAY HERNANDEZ HERNANDEZ', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'DOMICILIO CONOCIDO', '0efc07e4-6cdd-11ed-8a78-feed01260033', '9611141709', NULL, 29000, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 81, 0, '2022-11-25 16:21:35'),
('45c48cce2e2d7fbdea1afc51c7c6ad26', 'EDILBERTO JONAPA GARCIA', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'DOMICILIO CONOCIDO', '3a534567-65de-11ed-8a78-feed01260033', '9613132666', NULL, 29010, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 9, 0, '2022-11-16 18:42:55'),
('46313523f3353be73b79e987d2d6f7bc', 'MELANIE GARCIA GOMEZ', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'AV PENSAMIENTO  MZ 8 LTE 2, C BUGAMBILIA Y MARGARITA', '9fd39cf8-6aab-11ed-8a78-feed01260033', '9614375145', NULL, 29049, 1, 'GAGM850716MCSRML03', NULL, 'TACOS TIA JUANA', 'ENCARGADA', '8A NTE ENTRE 13 Y 14 PTE NO. 1468', 2, 0, 3000, 'Semanal', 'AZAEL LIMA GRAJALES', 20, 0, 'TRANSPORTISTA', 'CHOFER', 8000, 'PLAZA CRISTAL PTE', '9613632038', 'Propia', 20, 0, 0, 'EL MARIDO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 62, 1, '2022-11-22 21:35:20'),
('478d44ef2f62168afb44a1a449aa1dd3', 'RODOLFO NAFATE LOPEZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', 'd43ae49f-6780-11ed-8a78-feed01260033', '9612475949', NULL, 29179, 0, 'NALR830504HCSFPD06', NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 101, 0, '2022-12-05 15:38:40'),
('47fc683fde6a2764929cef2891568cba', 'MARIA GUADALUPE MEGCHUN SANTIAGO', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'PRIV AGUA MARINA 144 MZ 37 LTE 5', 'b895edc1-676c-11ed-8a78-feed01260033', '9611035381', NULL, 29019, 1, 'MESG730510MCSGND05', NULL, 'VENTAS PARTICULARES', 'COMERCIANTE', 'MISMO DOMICILIO', 6, 0, 2700, 'Semanal', 'FRANCISCO PASCUAL GOMEZ GOMEZ', 8, 0, 'OBRAS PUBLICAS', 'MANTENIMIENTO', 9400, 'COL MAYA', '9613731803', 'Propia', 11, 0, 1, 'MARTHA CLAUDIA CERVANTES PEREZ', '9612882756', NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 67, 1, '2022-11-22 22:06:23'),
('481acf038c1fed0f52b8801f67855332', 'BRENDA GUADALUPE MACIAS ESTRADA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'CARR LA ANGOSTURA KM 3', 'bf42ba53-676d-11ed-8a78-feed01260033', '9613434102', NULL, 29167, 1, 'MAEB910704MCSCSR09', NULL, 'EN EL HOGAR', 'PROMOTOR DE VENTAS', 'EN SU DOMICILIO', 2, 0, 1500, 'Semanal', 'RUBICEL DIAZ PEREZ', 17, 0, 'TORTILLERIA PLAYA VISTA', 'EMPLEADO', 8000, 'RIBERA PLAYA VISTA', NULL, 'Propia', 6, 0, 5, 'BLANCA BERENICE OVILLA AGUILAR', '9612414304', NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 52, 1, '2022-11-18 18:31:37'),
('4a73a442da6f957ab1c73541ffdfb01e', 'ROSA ESTELA BERTRY GARCIA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'C CAOBA MZ 36 LTE 12', 'c90f6ef6-6aad-11ed-8a78-feed01260033', '9611904023', NULL, 29163, 1, 'BEGR860203MTCRRS02', NULL, 'ACTIVIDAD INMOBILIARIA', 'RENTA UNA CASA Y/O HABITACION', 'MISMO DOMICILIO', 9, 0, 600, 'Quincenal', 'ALDO MANUEL ALVAREZ TORRES', 19, 0, 'MARKEN', 'ENCARGADO', 10400, 'A DOS CUADRAS DE LA SECUNDARIA', '9611988094', 'Propia', 9, 0, 2, 'EL MARIDO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 63, 1, '2022-11-22 21:47:44'),
('4c357130c2b45e775cd0220a6825bb52', 'DOLORES BALBUENA BALBUENA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2A OTE NTE SIN NUMERO, FRENTE AL COBACH', '14c7fad4-65e1-11ed-8a78-feed01260033', '9615805156', NULL, 29180, 0, 'BABD710402MCSLLL02', NULL, 'NIÑERA', 'NIÑERA', 'JULIAN GRAJALES', 5, 0, 1300, 'Semanal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 50, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 22, 1, '2022-11-16 21:17:44'),
('4cbca2586d0543b7a99d6ab380870eff', 'KARINA LIZETH JONAPA RAMIREZ', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '19 SUR OTE LTE 6 MZ 6', '05638eed-677c-11ed-8a78-feed01260033', '9611024744', NULL, 29080, 1, 'JORK941128MCSNMR01', NULL, 'EN EL HOGAR', 'AMA DE CASA', NULL, 0, 0, 0, 'Quincenal', 'JORGE LUIS BAUTISTA ALEMAN', 4, 0, 'TAXISTA', 'CHOFER', 5000, NULL, '9611700121', 'Rentada', 1, 1800, 1, 'MARTHA LILIA RAMIREZ MORALES, PARECE SER LA MAMA Y ES REFERENCIA', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 56, 1, '2022-11-18 20:13:53'),
('4da2b5985590574140bd35241b6b41fc', 'MARTHA GOMEZ GONZALEZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'CALLE SIN NOMBRE MZ 28 LTE 2', 'a5ef60ca-66d4-11ed-8a78-feed01260033', '9613027911', NULL, 29176, 0, 'GOGM671126MCSMNR09', NULL, 'TRABAJO DOMESTICO', 'LIMPIEZA', 'FRANCISCO SARABIA', 0, 0, 1200, 'Semanal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, 'RODOLFO GOMEZ GONZALEZ, HERMANO, REFERENCIA', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 128, 1, '2022-12-12 21:56:50'),
('4dbf5ba63c054c3303da674d2bb4f026', 'SILVIA MARIA DE LOS ANGELES', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'CALLE CONSTITUYENTES 165 MZ 5 LTE 2', '2b7d712d-65f7-11ed-8a78-feed01260033', '9611406307', NULL, 29010, 1, 'AURS531103MCSGML06', NULL, 'NEGOCIO PROPIO', 'TIENDA DE ABARROTES', 'DOMICILIO PROPIO', 20, 0, 15000, 'Quincenal', 'HUGO MOLINA ZENTENO', 49, 0, 'GOB. EDO.', 'JUBILADO', 9000, 'MISMO DOMICILIO', NULL, 'Propia', 50, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 26, 1, '2022-11-16 21:46:47'),
('54229abfcfa5649e7003b83dd4755294', 'ROBERTO RUIZ GOMEZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', 'a5ef60ca-66d4-11ed-8a78-feed01260033', '9612112871', NULL, 29176, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 91, 0, '2022-11-25 21:10:45'),
('55926ae63776f9941c346247ab95d8a3', 'MARIA DE JESUS TORRES HERNANDEZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'CARR INTERNACIONAL Y C LAS CASA SIN NUMERO', 'da75d751-677f-11ed-8a78-feed01260033', '9611105010', NULL, 29160, 1, 'TOHJ740110MCSRRS04', NULL, 'NEGOCIO PROPIO', 'CENADURIA BLANQUITA', 'MISMO DOMICILIO', 20, 0, 3500, 'Semanal', 'JOSE ALFREDO DOMINGUEZ SANCHEZ', 31, 0, 'TRANSPORTISTA', 'CHOFER', 7500, 'CHIAPA DE CORZO', '9612800531', 'Rentada', 9, 2600, 1, 'ALVERINDA VELAZQUEZ GONZALEZ', '9613729275', NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 99, 1, '2022-11-25 23:16:37'),
('577d9de1d02bbcb79ca7a59cf09449f3', 'LIRIO AZUCENA FLORES MORENO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'TOMAS CUESTA 80', 'da75d751-677f-11ed-8a78-feed01260033', '9614465426', NULL, 29160, 0, 'FOML880323MCSLRR07', NULL, 'NEGOCIO PROPIO', 'VENTA DE AVON Y ES COSTURERA', 'MISMO DOMICILIO', 0, 0, 2500, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Familiares', 34, 0, 1, 'CANDIDO LOPEZ', '9611114515', NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 117, 1, '2022-12-05 20:18:39'),
('58b6bb5060f837cbbc9e16ea03eaa0ce', 'BEATRIZ ADRIANA CASTILLEJOS PEREZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '2160574e-66c5-11ed-8a78-feed01260033', '9612685155', NULL, 29169, 1, 'CAPB770417MCSSRT06', NULL, 'LAVATAP', 'LIMPIEZA', 'PLANTA DE LA MOSCA', 2, 0, 1600, 'Quincenal', 'ISAIAS GUTIERREZ SUAREZ', 6, 0, 'NEGOCIO PROPIO', 'VENTA DE ABARROTES Y ESPECIAS', 6000, 'MISMO DOMICILIO', '9611952984', 'Rentada', 1, 800, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 75, 1, '2022-11-24 20:31:24'),
('591b3ebc82965c51360586996bcf0891', 'JESUS MAZA ZARATE', '57f9027c-6c37-11ed-8a78-feed01260033', 'C BELEN Y C EFRAIN, BARR SAN MARCOS, AMPLIACION SAN JOSE', '6935afdb-6c37-11ed-8a78-feed01260033', '9617091116', NULL, 29130, 0, 'MAZJ560324HCSZRS03', NULL, 'PENSIONADO', 'PENSIONADO', 'GOBIERNO', 0, 0, 3500, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 2, 0, 0, 'MADELI JIMENEZ CRUZ, ES REFERENCIA', '9612450133', NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 76, 1, '2022-11-24 20:41:41'),
('5ef059938ba799aaa845e1c2e8a762bd', 'GUADALUPE OVANDO PASCASIO', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'DOMICILIO CONOCIDO', '335e5e01-74da-11ed-8a78-feed01260033', '9614261583', NULL, 29037, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 118, 0, '2022-12-05 20:21:13'),
('652249ab5a0f0634a2177cc0c48e3ce1', 'OLGA LILIA SIMUTA DELGADO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'AV JUAN SABINES N. 73', '85f934ff-74c5-11ed-8a78-feed01260033', '9614579687', NULL, 29164, 1, 'SIDO820826MCSMLL08', NULL, 'N', 'TIENDA DE ABARROTES', 'MISMO DOMICILIO', 3, 0, 2000, 'Semanal', 'GUSTAVO ALEJADNRO DOMINGUEZ VILLATORO', 8, 0, 'NEGOCIO PROPIO', 'TALLER MECANICO', 10000, '21 DE OCTUBRE, CARR INTERNACIONAL', '9612513586', 'Propia', 8, 0, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 109, 1, '2022-12-05 18:01:47'),
('652f3e56168451e810c7010c4ce407aa', 'RITA MARIA ESTRADA LUNA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'C JACARANDA 2258', 'b9628f7b-65dc-11ed-8a78-feed01260033', '9611844170', NULL, 29165, 0, 'EALR810523MCSSNT04', NULL, 'NEGOCIO PROPIO', 'APLICACION DE UÑAS Y VENTA DE CALZADO POR CATALOGO', 'JARDINES DEL GRIJALVA', 3, 0, 3000, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 12, 0, 2, 'BERTHA SANDOVAL NIETO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 85, 1, '2022-11-25 17:02:51'),
('65ded5353c5ee48d0b7d48c591b8f430', 'JOSE LUIS HERNANDEZ GOMEZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', 'bf6e33a6-7a6b-11ed-8a78-feed01260033', '9611243801', NULL, 29178, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 132, 0, '2022-12-12 22:25:00'),
('668e430f71350aa4f74bb6f9a7896149', 'ROSITA PACHECO MORENO', 'd590531d-65da-11ed-8a78-feed01260033', 'ULTIMAS CASAS RUMBO A LA CIENEGA', '03d65ebd-6d11-11ed-8a78-feed01260033', '9614510325', NULL, 29150, 1, 'PAMR740904MCSCRS02', NULL, 'NEGOCIO PROPIO', 'VENTA DE LACTEOS, QUESO Y CREMA', 'MISMO DOMICILIO', 4, 0, 750, 'Semanal', 'ISAURO PEREZ RUIZ', 29, 0, 'RUTA SUCHIAPA-TUXTLA', 'CHOFER', 7500, 'SUCHIAPA', '9611221463', 'Familiares', 4, 0, 0, 'EL MARIDO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 144, 1, '2022-12-13 17:42:51'),
('67c6a1e7ce56d3d6fa748ab6d9af3fd7', 'MARIA BELLANEY LUNA RINCON', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '01de812e-65d7-11ed-8a78-feed01260033', '9613355785', NULL, 29178, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 47, 0, '2022-11-18 17:56:16'),
('6974ce5ac660610b44d9b9fed0ff9548', 'HECTOR SANCHEZ MEJIA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', 'd43ae49f-6780-11ed-8a78-feed01260033', '9613488088', NULL, 29179, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 103, 0, '2022-12-05 15:47:12'),
('69d3ab889bf82428f921d05b10de0e24', 'JUAN FRANCISCO ZENTENO AGUILAR', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '4A SUR PTE 256, 4A Y5A PTE', '7e68444c-676f-11ed-8a78-feed01260033', '9612463828', NULL, 29057, 0, 'ZEAJ730417HCSNGN03', NULL, 'SUPER NACHO', 'ENCARGADO DE REPARTO', '5A NTE, PLAZA SOL', 1, 0, 5200, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 15, 0, 0, 'MARIA DEL SOCORRO AGUILAR NUÑEZ', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 53, 1, '2022-11-18 20:00:58'),
('6ab24fa03cbcef87de7fa8adbc181a78', 'JULIETA ESCOBAR DE LA CRUZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'AV AZALEA 1336', '14c7fad4-65e1-11ed-8a78-feed01260033', '9611363493', NULL, 29165, 0, 'EOCJ741108MCSSRL07', NULL, 'ISSTE EVDI NO. 37', 'EDUCATIVO', '1A NTE PTE NO. 1586 COL. MOCTEZUMA', 25, 0, 5000, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 13, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 19, 1, '2022-11-16 20:49:45'),
('6b7559e557a13074d62549610e51e562', 'RUBISEL SANTOS MENDEZ', 'f23461b0-65de-11ed-8a78-feed01260033', 'A 3 CUADRAS DE LA ESCUELA', '00bff561-65df-11ed-8a78-feed01260033', '9616254185', NULL, 29380, 1, 'SAMR880915HCSNNB02', NULL, 'COBACH', 'ADMINISTRATIVO', 'OCOSINGO', 5, 0, 5000, 'Quincenal', 'BRENDA YARENI VELAZCO GRAJALES', 3, 0, 'IMSS', 'ENFERMERA', 18000, '5 DE MAYO, TUXTLA GUTIERREZ', '9613098751', 'Propia', 20, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 11, 1, '2022-11-16 18:52:34'),
('6c5a0b4dc49b855cfaba38f48af4ec9e', 'JESUS ALEXANDER PEREZ JIMENEZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'ATRAS DEL RASTRO SIN NUMERO', '59067bed-6d06-11ed-8a78-feed01260033', '9612450224', NULL, 29160, 1, 'PEJJ991217HCSRMS06', NULL, 'LALA COMERCIALIZADORA', 'OPERADOR DE MONTACARGA', 'CARR CHIAPA DE CORZO', 1, 0, 2000, 'Semanal', 'BEXI DOMINGUEZ PEREZ', 2, 0, 'EN EL HOGAR', 'AMA DE CASA', 0, NULL, NULL, 'Familiares', 2, 0, 0, 'MARIA VERONICA PEREZ PATISTAN', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 93, 1, '2022-11-25 21:33:52'),
('6ef906ef110f51070f806a7814e6af21', 'GUADALUPE JOSE DE LA TORRE', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '01de812e-65d7-11ed-8a78-feed01260033', '9612345047', NULL, 29178, 0, 'JOTG790627MCSSRD09', NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 65, 0, '2022-11-22 21:51:59'),
('6f50b316876a6e34fe17e549b711455e', 'VIRIDIANA CRUZ POZO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', 'a5ef60ca-66d4-11ed-8a78-feed01260033', '9611127082', NULL, 29176, 0, 'CUPV950213MCSRZR09', NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 121, 0, '2022-12-12 21:15:13'),
('70b6851d0f73536706e284e43dde9a4b', 'ABRAHAM CORDOVA SARMIENTO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'AND DALIA SUR MZ 1 LTE 20', 'b9628f7b-65dc-11ed-8a78-feed01260033', '9616696455', NULL, 29165, 0, 'COSA780316HCSRRB07', NULL, 'NEGOCIO PROPIO', 'ESTETICA Y COMERCIO', 'MISMO DOMICILIO', 22, 0, 6000, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Familiares', 9, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 122, 1, '2022-12-12 21:23:23'),
('720ab762f335211f9510814744976521', 'RAUL VELAZQUEZ PEREZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'A 150 MTS DE LA ESCUELA PRIMARIA SIN NUMERO, LDO IGLESIA CRISTIANA', 'd43ae49f-6780-11ed-8a78-feed01260033', '9612320209', NULL, 29179, 1, 'VEPR770223HCSLRL08', NULL, 'TAXISTA EN EL AEROPUERTO', 'DUEÑO', 'AEROPUERTO INTERNACIONAL', 15, 0, 3000, 'Semanal', 'VERONICA JIMENEZ PINTO', 20, 0, 'NEGOCIO PROPIO', 'VENTA DE POLLO', 2000, 'MISMO DOMICILIO', '9614284478', 'Propia', 17, 0, 0, 'VERONICA DE JESUS JIMENEZ PINTO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 69, 1, '2022-11-22 22:28:09'),
('75e5a2864654ca45694c8ba44ef0ead9', 'ANA KARINA RUIZ PACHECO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'ENTRADA A LA BOMBA', '34b8256c-7b0f-11ed-8a78-feed01260033', '9611205834', NULL, 29180, 1, 'RUPA950901MCSZCN03', NULL, 'AGRIOCULTOR', 'AYUDANTE', 'EL TEJAR', 5, 0, 900, 'Semanal', 'MARCOS YAIR CRUZ LOPEZ', 7, 0, 'AGRICULTOR', 'AYUDANTE', 6000, 'EL TEJAR', NULL, 'Familiares', 27, 0, 3, 'GUILLERMO RUIZ PACHECO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 146, 1, '2022-12-13 18:01:37'),
('764ae0c6513d868d18f805c8094de0d8', 'ROSEBEL PEREZ HERNANDEZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '3A SUR PTE LTE 46', '2160574e-66c5-11ed-8a78-feed01260033', '9614527267', NULL, 29169, 1, 'PEHR791014HCSRRS06', NULL, 'MOTO TAXI', 'CHOFER', 'AMATAL', 2, 0, 1500, 'Semanal', 'MARTHA LILIA CRUZ HERNANDEZ', 23, 0, 'EN EL HOGAR', 'AMA DE CASA', 0, NULL, NULL, 'Propia', 7, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 147, 1, '2022-12-13 18:11:50'),
('77027d130de938eebdd573938116eb6f', 'FELIX PEREZ ENRIQUEZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'JUNTO AL RANCHO LINDA VISTA', '14c7fad4-65e1-11ed-8a78-feed01260033', '9611387623', NULL, 29180, 0, 'PEEF010609HTCRNLA2', NULL, 'NEGOCIO PROPIO', 'AGRICULTOR', 'JULIAN GRAJALES', 0, 7, 2000, 'Semanal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 1, 0, 0, 'PASCUAL PEREZ JIMENEZ', '9321220084', 'JULIAN GRAJALES', NULL, NULL, NULL, NULL, 0, 0, 1, 20, 1, '2022-11-16 20:58:02'),
('7819892737cb80cfb5a3d5485efd3805', 'ROCIO DEL CARMEN MAZARIEOS GOMEZ', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'AV ROSALES MZ1 LTE 10', '20c06825-66c4-11ed-8a78-feed01260033', '9614308575', NULL, 29018, 0, 'MAGR720617MCSZMC07', NULL, 'GUARDERIA', 'COCINERA', 'POTINASPAK', 11, 0, 1300, 'Semanal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 12, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 33, 1, '2022-11-17 22:12:46'),
('783ae2d6b5eee0807ddfd484b062fb26', 'ORALIA GOMEZ PEREZ', 'b12cf2d9-65e7-11ed-8a78-feed01260033', '3 CUADRAS ANTES DEL PANTEON', 'c5eaacad-65e7-11ed-8a78-feed01260033', '9651064873', NULL, 29375, 1, 'GOPO811109MCSMRR07', NULL, 'EN EL HOGAR', 'AMA DE CASA', NULL, 0, 0, 0, 'Quincenal', 'ORACIO VAZQUEZ BILCHIS', 30, 0, 'AGRICULTOR', 'AGRICULTOR', 5200, 'GUADALUPE VICTORIA', NULL, 'Propia', 23, 0, 2, 'MARIA OFELIA TORRES GOMEZ', NULL, 'GUADALUPE VICTORIA', NULL, NULL, NULL, NULL, 1, 0, 1, 17, 1, '2022-11-16 20:26:32'),
('7ac4faa38ff9e9178e54f575b7c4b145', 'LUIS ENRIQUE PEREZ PACHECO', 'd590531d-65da-11ed-8a78-feed01260033', 'ULTIMAS CASAS RUMBO A LA CIENEGA', '03d65ebd-6d11-11ed-8a78-feed01260033', '9611319979', NULL, 29150, 1, 'PEPL921112HCSRCS01', NULL, 'BALCONERO', 'BALCONERO', 'TUXTLA GUTIERREZ Y PACU', 6, 0, 2800, 'Semanal', 'MARGELI TOALA RAMOS', 9, 0, 'EN EL HOGAR', 'AMA DE CASA', 0, NULL, NULL, 'Propia', 3, 0, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 96, 1, '2022-11-25 22:37:48'),
('7b304a3dce927767587935174f20221c', 'MARIA GUADALUPE CRUZ GOMEZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'AV NOGAL 3009, BLVD LIRIO DE LOS VALLES', 'b9628f7b-65dc-11ed-8a78-feed01260033', '9611057426', NULL, 29165, 0, 'COGG7712111MCRMD08', NULL, 'NEGOCIO PROPIO', 'VENTA DE CERVEZA Y POLLO DESTAZADO', 'AV NOGAL MZ 30 LT 9', 2, 0, 3000, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 15, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 74, 1, '2022-11-23 18:46:49'),
('7ccd5f61e6c55f5e758adeebe58e53ac', 'YUDIANA CRUZ HERNANDEZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'AV CORONEL, FRENTE A LA TORTILLERIA Y FARMACIA STO DOMINGO', '2160574e-66c5-11ed-8a78-feed01260033', '9614577262', NULL, 29169, 1, 'CUHY930718MCSRRD01', NULL, 'VENTA DE GORDITAS Y TACOS', 'AYUDANTE', 'ORILLA DE CARRETERA, SALVADOR URBINA', 3, 0, 800, 'Semanal', 'RICARDO HERNANDEZ UTRILLA', 1, 0, 'RECICLADORA', 'COMPACTADOR', 8000, 'ENTRADA AL PUENTE SANTO DOMINGO', '9613750228', 'Familiares', 11, 0, 2, 'EL MARIDO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 34, 1, '2022-11-17 22:21:04'),
('7dead25c47abf922dcc154fc56ead3b5', 'EULALIA GARCIA GONZALEZ', 'd590531d-65da-11ed-8a78-feed01260033', 'ANTES DEL VIVERO, BARRIO SAN FRANCISCO', 'e04830b5-65da-11ed-8a78-feed01260033', '9614682841', NULL, 29150, 1, 'GAGE781029MCSRNL02', NULL, 'VIVERO DE SUCHIAPA', 'EMPLEADA, AYUDANTE', 'SUCHIAPA', 8, 0, 1200, 'Semanal', 'GEREMIAS TECO JIMENEZ', 15, 0, 'ALBAÑIL', 'ALBAÑIL', 8800, 'SUCHIAPA', '9614252202', 'Propia', 22, 0, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 6, 1, '2022-11-16 18:27:32'),
('7e19e2e23d69755379b743f787d191fd', 'BRENDA GUADALUPE GRAJALES CONSTANTINO', 'f23461b0-65de-11ed-8a78-feed01260033', 'A 3 CUADRAS DE LA ESCUELA', '00bff561-65df-11ed-8a78-feed01260033', '9613026540', NULL, 29380, 1, 'GACB801128MCSRNR08', NULL, 'PRESICENCIA MUNICIPAL DIF', 'ADMINISTRATIVO', '20 DE NOVIEMBRE', 0, 3, 3500, 'Quincenal', 'RIGOBERTO VELAZCO CONSUEGRA', 30, 0, 'TRAILERO', 'CHOFER', 14400, NULL, '9611000014', 'Propia', 30, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 35, 1, '2022-11-17 22:31:56'),
('7f1de29e6da19d22b51c68001e7e0e54', 'MERCEDES CRUZ RUIZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '2160574e-66c5-11ed-8a78-feed01260033', '9616073086', NULL, 29169, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 135, 0, '2022-12-12 22:28:35'),
('8456d692667485a3a81daf9b31566e15', 'PAOLA MAYRANI MACIAS ARCHILA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2A ENTRADA DE JULIAN GRAJALES', '14c7fad4-65e1-11ed-8a78-feed01260033', '9616259781', NULL, 29180, 0, 'MAAP960528MCSCRL04', NULL, 'LASTRE CONSTRUCCIONES', 'ADMINISTRATIVO', 'AEROPUERTO INTERNACIONAL', 0, 8, 3000, 'Semanal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 28, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 71, 1, '2022-11-23 18:12:18'),
('8613985ec49eb8f757ae6439e879bb2a', 'JOSE GUILLEN DE LA TORRE', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'LIBRAMIENTO SUR OTE 1250, COL FRANCISCO I MADERO', '01d3e8b1-65f6-11ed-8a78-feed01260033', '9614537987', NULL, 29090, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 90, 0, '2022-11-25 21:07:54'),
('88ceee688ce41b0fdda67e4328d16e8f', 'JOSEFA RODRIGUEZ PEREZ', 'f23461b0-65de-11ed-8a78-feed01260033', '4A NTE PTE SIN NUMERO, 3A Y 4A PTE', '00bff561-65df-11ed-8a78-feed01260033', '9611779176', NULL, 29380, 1, 'ROPJ860119MCSDRS00', NULL, 'EN EL HOGAR', 'AMA DE CASA', NULL, 0, 0, 0, 'Quincenal', 'ALFONSO PABLO ALTUNAR', 1, 0, 'AYUNTAMIENTO DEL 20 DE NOVIEMBRE', 'DIRECTOR AGROPECUARIO', 10000, 'FRENTE AL PARQUE, 20 DE NOVIEMBRE', '9611779176', 'Propia', 12, 0, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 106, 1, '2022-12-05 17:40:48'),
('891730bf9e5af6a218a0f927a8b6af13', 'LUIS ISAI TORRES DIAZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'AL LADO DE LA SRA ISABEL SIN NUMERO', '14c7fad4-65e1-11ed-8a78-feed01260033', '9614479920', NULL, 29180, 1, 'TODL000418HCSRZSA1', NULL, 'AEROPUERTO INTERNACIONAL', 'INSPECTOR DE SEGURIDAD', 'AEROPUERTO INTERNACIONAL', 0, 5, 3700, 'Quincenal', 'GUADALUPE GOMEZ RAMOS', 4, 0, 'EN EL HOGAR', 'AMA DE CASA', 0, NULL, NULL, 'Rentada', 0, 500, 2, 'JOSE LUIS TORRES RUIZ, PARACE SER EL PAPA, ES REFERENCIA', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 73, 1, '2022-11-23 18:36:06'),
('8e296a067a37563370ded05f5a3bf3ec', 'GUSTAVO PANIAGUA ALFONSO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '01de812e-65d7-11ed-8a78-feed01260033', '9614727186', NULL, 29178, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 25, 0, '2022-11-16 21:34:40'),
('8f14b750f8267d2b25489df52e53d13c', 'MARIA LUCIA PEREZ GUILLEN', 'd590531d-65da-11ed-8a78-feed01260033', 'AV CENTRAL PTE S.N., 1A Y 2A PTE', '03d65ebd-6d11-11ed-8a78-feed01260033', '9612309751', NULL, 29150, 1, 'PEGL801215MCSRLC08', NULL, 'NEGOCIO PROPIO', 'VENTA DE DESAYUNOS Y COMIDAS', 'MISMO DOMICILIO', 3, 0, 1500, 'Semanal', 'CARLOS TOALA DIAZ', 3, 0, 'ESCUELA SECUNDARIA', 'ADMINISTRATIVO', 7000, 'SUCHIAPA', NULL, 'Propia', 19, 0, 2, 'EL MARIDO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 120, 1, '2022-12-05 20:48:23'),
('8f290d6ec0963d66f56b67ab393450e7', 'PAULINA BALBUENA GOMEZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2A OTE NTE SIN NUMERO, FRENTE AL COBACH', '14c7fad4-65e1-11ed-8a78-feed01260033', '9612520369', NULL, 29180, 1, 'BAGP970114MCSLML02', NULL, 'BUFET CHINO', 'CAJERA', 'TUXTLA GUTIERREZ', 2, 0, 1700, 'Semanal', 'CRUZ SANTILLON DOMINGUEZ', 11, 0, 'DUEÑO DE TAXI', 'CHOFER', 4000, 'TUXTLA GUTIERREZ', '9611427516', 'Propia', 8, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 30, 1, '2022-11-16 23:49:22'),
('90cfecdc4b27895c0b8f7ead3a027e40', 'ISRAEL VELAZQUEZ PEREZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', 'd43ae49f-6780-11ed-8a78-feed01260033', '9611167182', NULL, 29179, 0, 'VEPI790305HCSLRS09', NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 111, 0, '2022-12-05 18:16:47'),
('92b0d335f6dae322379c5f205a2235c6', 'LUIS ARBEY RAMIREZ SOLIS', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '2160574e-66c5-11ed-8a78-feed01260033', '9612573253', NULL, 29169, 0, 'RASL830712HCSMLS06', NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 125, 0, '2022-12-12 21:46:30'),
('92cc227532d17e56e07902b254dfad10', 'BRENDA YANETH SOLIS GOMEZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '01de812e-65d7-11ed-8a78-feed01260033', '9612483866', NULL, 29178, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 92, 0, '2022-11-25 21:12:14'),
('9b4396d88b6b347cae20222f4fb0fdac', 'KAREN CONCEPCION DEL PILAR HERNANDEZ', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'C CUNDAPI MZ 21', '9c71bea3-6c38-11ed-8a78-feed01260033', '9614396400', NULL, 29067, 1, 'HESK900130MCSRRR05', NULL, 'IMPRENTA', 'DUEÑA', '16 SUR ENTRE 5 Y 6 OTE NO. 420', 4, 0, 4000, 'Semanal', 'JOSE DE JESUS SANCHEZ HERNANDEZ', 4, 0, 'IMPRENTA', 'DUEÑO', 0, '16 SUR ENTRE 5 Y 6 OTE NO. 420', '9614396400', 'Familiares', 27, 0, 0, 'ARMANDO HERNANDEZ JIMENEZ, EL PAPA, ES REFERENCIA', '9613716436', NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 77, 1, '2022-11-24 20:50:30'),
('9b8619251a19057cff70779273e95aa6', 'MIGUEL ARMANDO HERNANDEZ PEREZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '14c7fad4-65e1-11ed-8a78-feed01260033', '9612479872', NULL, 29180, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 130, 0, '2022-12-12 22:12:09'),
('9c1e370d784b4f1ac55fe7b8ac4bb2e2', 'NANCY BEATRIZ LAZARO VELAZQUEZ', 'd590531d-65da-11ed-8a78-feed01260033', '7A OTE NTE SIN NUMERO', '4e03d05c-6ab5-11ed-8a78-feed01260033', '9614465517', NULL, 29150, 1, 'LAVN821220MCSZLN06', NULL, 'NEGOCIO PROPIO', 'VENTA DE POZOL Y EMPANADAS', 'BARRIO SAN JACINTO', 20, 0, 2000, 'Semanal', 'JORGE JUAN NANGUELO GUTIERREZ', 20, 0, 'CARPINTERO', 'CARPINTERO', 10000, 'BARRIO SAN JACINTO', '9611217436', 'Propia', 38, 0, 3, 'EL MARIDO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 95, 1, '2022-11-25 21:45:21'),
('9c9f52c8b9b3728c6c760b699b4df441', 'SAMUEL PABLO CRUZ JIMENEZ', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'CALZADA DEL CARMEN MZ 6 LTE 3', 'a279fc5f-6b5a-11ed-8a78-feed01260033', '9613224681', NULL, 29019, 1, 'CUJS830615HCSRMM08', NULL, 'OFICINA RADIO TAXIS', 'ADMINISTRATIVO', '15 OTE Y 4A NTE', 1, 6, 2500, 'Quincenal', 'BLANCA ROSA PEREZ GONZALEZ', 12, 0, 'PROVEEDORA DANJAR', 'SECRETARIA', 4800, '15 PTE Y 1A NTE', '9612325278', 'Propia', 8, 0, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 72, 1, '2022-11-23 18:20:44'),
('9e4907185909f5631c3bed30a3e983c7', 'CRHISTIAN GUADALUPE MACIAS ESPINOSA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'CALLEJON SUCHIAPA LAS FLECHAS', 'bf42ba53-676d-11ed-8a78-feed01260033', '9983397244', NULL, 29167, 1, 'MAEC921203MCSCSR03', NULL, 'NEGOCIO PROPIO', 'VENTA DE TAMALES', 'ENTRADA DE JARDINES DEL GRIJALVA', 10, 0, 3000, 'Semanal', 'OMAR DE JESUS BESAREZ LOPEZ', 2, 0, 'ENCUVADORA PROAVICO', 'AYUDANTE GENERAL', 7200, 'A UN LADO DE LA PRIMARIA, RIBERA LAS FLECHAS', NULL, 'Familiares', 30, 0, 3, 'LUZ MARIA ESPINOSA MIJANGOS', '9612419754', 'RIBERA LAS FLECHAS, CHIAPA DE CORZO', NULL, NULL, NULL, NULL, 1, 0, 1, 131, 1, '2022-12-12 22:22:58'),
('9e62e4d5a77d21ff0237336fb5e7b4c2', 'ULBER ALEJANDRO FLORES PEREZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'AV 1A SUR PTE SIN NUMERO', 'eb29b36c-676a-11ed-8a78-feed01260033', '9614050937', NULL, 29160, 1, 'FOPU930919HCSLRL05', NULL, 'MOTO TAXI', 'CHOFER', 'EMILIANO ZAPATA', 7, 0, 1500, 'Semanal', 'CLAUDIA LIZETH FLORES MORALES', 0, 0, 'EN EL HOGAR', 'AMA DE CASA', 0, NULL, NULL, 'Propia', 3, 0, 2, 'DARINEL FLORES PEREZ', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 48, 1, '2022-11-18 18:11:32'),
('9fc3d7152ba9336a670e36d0ed79bc43', 'EDALI COUTIÑO CRUZ', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'DOMICILIO CONOCIDO', 'f256b966-7a6b-11ed-8a78-feed01260033', NULL, NULL, 29040, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 133, 0, '2022-12-12 22:26:12'),
('a2c037c71efd473c881ea537cc7911f9', 'KARLA PATRICIA MICELI DOMINGUEZ MICELI', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'AV. CUPAPE LT 3', '485e531d-65d9-11ed-8a78-feed01260033', '9671354911', NULL, 29094, 1, 'DOMK960316MCSMCR02', NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', 'LUIS ENRIQUE SANCHEZ PANIAGUA', 0, 0, 'SEGURIDAD PUBLICA', 'VIGILANTE', 8000, 'TUXTLA GUTIERREZ', '9612238445', 'Propia', 7, 0, 3, 'RIGOBERTO SANCHEA VAZQUEZ', '9614799566', 'TUXTLA GUTIERREZ', NULL, NULL, NULL, NULL, 1, 0, 1, 5, 1, '2022-11-16 18:14:57'),
('a3c65c2974270fd093ee8a9bf8ae7d0b', 'MARIA ELENA CRUZ JOSE', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'LAS MARAVILLAS SIN NUMERO', '1abbf96d-74c5-11ed-8a78-feed01260033', '9616603954', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 108, 0, '2022-12-05 17:49:35'),
('a4189853fcdcc0f1a95345310ff4ff45', 'LUIS MIGUEL RUIZ BALBUENA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'C TOMAS CUESTA Y AV HIDALGO', 'da75d751-677f-11ed-8a78-feed01260033', '9612983696', NULL, 29160, 1, 'RUBL840401HCSZLS06', NULL, 'CONCECULTA', 'MAESTRO DE MUSICA', 'SANTO DOMINGO', 7, 0, 2850, 'Quincenal', 'BRENDA GUADALUPE HERNANDEZ PATISHTAN', 20, 0, 'NEGOCIO PROPIO', 'CENADURIA', 4000, 'MISMO DOMICILIO', '9611686154', 'Familiares', 6, 0, 2, 'LIRIO AZUENA FLORES MORENO', '9612471348', NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 115, 1, '2022-12-05 19:44:47'),
('a43121f51b70187e210bba47f1cfa953', 'DANIRA MORENO LUNA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '01de812e-65d7-11ed-8a78-feed01260033', '9611022525', NULL, 29178, 0, 'MOLD840526MCSRNN00', NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 89, 0, '2022-11-25 21:04:05'),
('a87ff679a2f3e71d9181a67b7542122c', 'MARTHA YUDEISI PEREZ RINCON', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '01de812e-65d7-11ed-8a78-feed01260033', '9612109563', NULL, 29178, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 4, 0, '2022-11-16 18:01:22'),
('ac20271fa4a1b39f68ba5c98b695bcc3', 'MARTHA ELENA CAÑAVERAL GONZALEZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'ULTIMA CALLE SIN NUMERO', '14c7fad4-65e1-11ed-8a78-feed01260033', '9611950571', NULL, 29180, 1, 'CAGM760702MCSXNR07', NULL, 'CASA DE ENLACE, DIF', 'AUXILIAR', 'JULIAN GRAJALES', 11, 0, 3900, 'Quincenal', 'JOSE MARTIN LIEVANO GOMEZ', 24, 0, 'AGRICULTOR', NULL, 5000, 'JULIAN GRAJALES', '9614561044', 'Propia', 45, 0, 1, 'EL MARIDO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 83, 1, '2022-11-25 16:42:48'),
('acbff1eb3a4f018a2deb1d2e82cce959', 'BLANCA MAGALI GARCIA RODRIGUEZ', 'f23461b0-65de-11ed-8a78-feed01260033', 'SALIDA A ACALA SIN NUMERO', '00bff561-65df-11ed-8a78-feed01260033', '9616670058', NULL, 29380, 0, 'GARB641117MCSRDL08', NULL, 'FINANCIERA NACIONAL DEL DESARROLLO', 'LIMPIEZA', 'FRENTE AL TECNOLOGICO', 0, 0, 2600, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 4, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 80, 1, '2022-11-24 21:29:22'),
('b07b50819018073f6b47704bcc3f4a6b', 'OSCAR DANIEL GOMEZ HERNANDEZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'FRENTE A LA CANCHA DE BASQUETBOL', '8479fc80-6ce0-11ed-8a78-feed01260033', '9611023946', NULL, 29170, 1, 'GOHO860730HCSMRS00', NULL, 'CHOFER DE MOTO TAXI', 'PROPIETARIO', 'AMERICA LIBRE', 12, 0, 450, 'Semanal', 'MARIA MERCEDES RAMOS ACEROS', 11, 0, 'EN EL HOGAR', 'AMA DE CASA', 0, NULL, NULL, 'Propia', 30, 0, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 84, 1, '2022-11-25 16:52:20'),
('b5904f878eb42ed48a4f690d485bace3', 'GABRIEL ARNULFO MENDEZ MONTEJO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'CERCA DE FINCA DOLORES', 'a5ef60ca-66d4-11ed-8a78-feed01260033', '9613593924', NULL, 29176, 0, 'MEMG000829HCSNNBA1', NULL, 'AEROPUERTO INTERNACIONAL', 'ATENCION A CLIENTES', 'AEROPUERTO INTERNACIONAL', 1, 2, 2500, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 22, 0, 0, 'LUCIA MONTEJO JOSE', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 46, 1, '2022-11-18 17:54:04'),
('b6be92fd3410104737539b6c28875172', 'LUZ MARIA GUTIERREZ JOSE', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'A 50 METROS DEL DEPOSITO SUPERIOR S', 'a5ef60ca-66d4-11ed-8a78-feed01260033', '9613051916', NULL, 29176, 1, 'GUJL840520MCSTSZ09', NULL, 'NEGOCIO PROPIO', 'ELABORACION Y VENTA DE PAN', '1A SUR PTE', 0, 0, 3000, 'Quincenal', 'RENAN GOMEZ ALEGRIA', 21, 0, 'ESTIBADOR', 'ESTIBADOR', 8000, 'TUXTLA GUTIERREZ', '9612019536', 'Propia', 6, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 116, 1, '2022-12-05 20:05:24');
INSERT INTO `cliente` (`idcliente`, `nombre_cliente`, `zona`, `domicilio_cliente`, `subzona`, `tel1_cliente`, `tel2_cliente`, `cp_cliente`, `idestado_civil`, `curp`, `rfc`, `trabajo_cliente`, `puesto_cliente`, `direccion_trabajo_cliente`, `antiguedadA_trabajo_cliente`, `antiguedadM_trabajo_cliente`, `ingresos_cliente`, `tipo_ingresos_cliente`, `nombre_conyugue_cliente`, `antiguedadA_vinculo`, `antiguedadM_vinculo`, `trabajo_conyugue`, `puesto_conyugue`, `ingreso_mensual_conyugue`, `direccion_trabajo_conyugue`, `tel_conyugue`, `tipo_vivienda_cliente`, `edad_residencia`, `renta_mensual`, `ndependientes`, `nombre_aval`, `tel_aval`, `domicilio_aval`, `trabajo_aval`, `puesto_aval`, `ingreso_mensual_aval`, `nombre_conyugue_aval`, `apto_credito`, `nivel_apto`, `estado_cliente`, `no_cliente`, `masinfo`, `creado_en`) VALUES
('b732d007018bdc704e701f5816ea0e36', 'ERIKA YERENY VIDAL NUCAMENDI', 'd590531d-65da-11ed-8a78-feed01260033', 'FINCA EL SALVADOR SIN NUMERO KM 22', '4e03d05c-6ab5-11ed-8a78-feed01260033', '9613162013', NULL, 29150, 1, 'VINE881005MCSDCR06', NULL, 'HOSPITAL REGIONAL', 'ENFERMERA', '9A SUR ENTRE CALLE CENTRAL Y 1A OTE', 8, 0, 7200, 'Quincenal', 'SILVESTRE SOLIS ARCHILA', 5, 0, 'AVICOLA SAN ANTONIO', 'CHOFER', 6200, 'TUXTLA GUTIERREZ', '9611431133', 'Familiares', 0, 0, 0, 'ROMELIA NUCAMENDI FERNANDEZ, LA MAMA, ES REFERENCIA', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 124, 1, '2022-12-12 21:44:18'),
('bf198027c4073a3ecd9c31b14611582c', 'MISAEL DIAZ PEREZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'FRENTE A LA PREPA SIN NUMERO', '01de812e-65d7-11ed-8a78-feed01260033', '9611992723', NULL, 29178, 0, 'DIPM940116HCSZRS08', NULL, 'EMPRESA DE HERBOLIA', 'PROMOTOR DE VENTAS', 'TUXTLA GUTIERREZ', 10, 0, 2800, 'Semanal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 12, 1, '2022-11-16 18:59:27'),
('c08997a503dd4772f98afd096ea99a1a', 'KARLA BERENICE HERNANDEZ LARA', 'd590531d-65da-11ed-8a78-feed01260033', 'CALLE LA CONDESA SIN NUMERO', '4e03d05c-6ab5-11ed-8a78-feed01260033', '9613214251', NULL, 29150, 1, 'HELK030106MOCRRRA7', NULL, 'EN EL HOGAR', 'AMA DE CASA', NULL, 0, 0, 0, 'Quincenal', 'ELIAS PEREZ NAFATE', 4, 0, 'ALBAÑIL', 'ALBAÑIL', 6000, 'MISMO DOMICILIO', NULL, 'Familiares', 4, 0, 1, 'MANUELA LARA GUTIERREZ', '9616039600', NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 70, 1, '2022-11-22 22:37:26'),
('c0c7c76d30bd3dcaefc96f40275bdc0a', 'MARIA GLORIA VON DUBEN AQUINO', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'DOMICILIO CONOCIDO', '22791dce-676d-11ed-8a78-feed01260033', '9614274671', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 50, 0, '2022-11-18 18:16:43'),
('c2987a388f5876a797af8f6434a4d8ba', 'ANA MARIA ALFARO PASCACIO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', 'a5ef60ca-66d4-11ed-8a78-feed01260033', '3328358101', NULL, 29176, 0, 'AAPA760327MCSLSN08', NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 143, 0, '2022-12-13 17:31:29'),
('c2b6aae0698006cc8e1d18b771c9102b', 'RUBICEL MARROQUIN HERNANDEZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'CALLE INOMINADA SIN NUMERO, A UN LADO DEL KINDER', '240f9cb9-65e4-11ed-8a78-feed01260033', '9613058518', NULL, 29180, 1, 'MAHR710220HCSRRB00', NULL, 'AGRIOCULTOR', 'AGRICULTOR', 'SUCHIAPA', 8, 0, 2000, 'Quincenal', 'ZOILA CUNDAPI NAFETE', 10, 0, 'NEGOCIO PROPIO', 'SASTRE', 2000, 'MISMO DOMICILIO', NULL, 'Propia', 15, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 145, 1, '2022-12-13 17:50:40'),
('c475dab319efc2cbe2458a238fb31f67', 'ELENA ALFARO CHAMPO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '01de812e-65d7-11ed-8a78-feed01260033', '9613642214', NULL, 29178, 1, 'AACE920106MCSLHL01', NULL, 'EN EL HOGAR', 'AMA DE CASA', NULL, 0, 0, 0, 'Quincenal', 'JOSE JAVIER NARCIA LUNA', 7, 0, 'POLICIA MUNICIPAL', 'CHOFER', 5000, 'CHIAPA DE CORZO', '9613642214', 'Propia', 1, 0, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 129, 1, '2022-12-12 22:01:50'),
('c7e1249ffc03eb9ded908c236bd1996d', 'DIANA YANETH ALVAREZ DE LA CRUZ', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'DOMICILIO CONOCIDO', '13c9781f-6d04-11ed-8a78-feed01260033', '9612112992', NULL, 29070, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 87, 0, '2022-11-25 21:01:03'),
('c7fcd7497fdc61e8f56e865fadd46737', 'EMILIANO GONZALEZ PEREZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'HIDALGO 72 / RAYON Y 21 DE OCTUBRE', 'bd193952-66c9-11ed-8a78-feed01260033', '9611546505', NULL, 29160, 1, 'GOPE521210HCSNRM04', NULL, 'PENSIONADO', 'PENSIONADO', 'CHIAPA DE CORZO', 31, 0, 5500, 'Quincenal', 'ELENA DIAZ', 45, 0, 'EN EL HOGAR', 'AMA DE CASA', 0, NULL, '9611546505', 'Propia', 30, 0, 2, 'LA ESPOSA', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 98, 1, '2022-11-25 23:02:39'),
('c9f0f895fb98ab9159f51fd0297e236d', 'HUMBERLAY JOSE GOMEZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '01de812e-65d7-11ed-8a78-feed01260033', '9611084490', NULL, 29178, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 8, 0, '2022-11-16 18:39:51'),
('cf9cc23e2b5ab0bd963f72439e0b9231', 'AYDE SUCHIAPA GOMEZ', 'f23461b0-65de-11ed-8a78-feed01260033', '1A Y 3A NTE PTE POR LA ZAPATERIA, A MEDIA CUADRA ANTES DE LA IGLESIA', '00bff561-65df-11ed-8a78-feed01260033', '9616550230', NULL, 29380, 1, 'SUGA631101MCSCMY03', NULL, 'EN EL HOGAR', 'AMA DE CASA', NULL, 0, 0, 0, 'Quincenal', 'CARMEN MENDEZ HERNANDEZ', 35, 0, 'NEGOCIO PROPIO', 'BALCONER', 4000, 'MISMO DOMICILIO', '9611107259', 'Propia', 56, 0, 0, 'YARENI MENDEZ SUCHIAPA, HIJA', '9611989780', NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 114, 1, '2022-12-05 19:20:17'),
('d1e7d0d5ddb280aa224953c2f45b048d', 'ARACELI GOMEZ TETUMO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'AV INDEPENDENCIA 85, BARRIO STA ELENA', 'da75d751-677f-11ed-8a78-feed01260033', '9613361168', NULL, 29160, 1, 'GOTA880909MCSMTR03', NULL, 'NEGOCIO PROPIO', 'COSTURA Y BORDADOS', 'AV INDEPENDENCIA', 10, 0, 1500, 'Semanal', 'COSME HERNANDEZ RALDA', 17, 0, 'GASOLINERA', 'DESPACHADOR', 4000, 'TUXTLA GUTIERREZ', '9611910686', 'Propia', 17, 0, 2, 'EL MARIDO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 97, 1, '2022-11-25 22:50:42'),
('d2eb7ed18b185f259e59e30290472600', 'CARMEN EDILENI RUIZ VICENTE', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'CALLE BENITO JUAREZ 03', 'c8962db7-65d4-11ed-8a78-feed01260033', '9611767382', NULL, 29180, 1, 'RUVC851002MCSZCR04', NULL, 'VICERA EL PILON', 'AYUDANTE', 'TUXTLA GUTIERREZ', 1, 0, 1570, 'Semanal', 'OMAR ALEJANDRE DIAZ PEREZ', 10, 0, 'AGRICULTOR', 'EMPLEADO', 3200, 'EL TEJAR', '9611175249', 'Propia', 14, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 18, 1, '2022-11-16 20:36:20'),
('d3573f35d34af4a5f659349c2c611a3e', 'SANDRA ALICIA ENCINO GOMEZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'POR LAS CURVAS RUMBO AL RIO, FRENTE AL PRIMER TOPE', '01de812e-65d7-11ed-8a78-feed01260033', '9613695198', NULL, 29178, 0, 'EIGS891024MCSNMN08', NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 142, 0, '2022-12-13 17:28:37'),
('d3704e52bfaacee53cfe2614b7944396', 'MARIA ESTHELA VERA GOMEZ', 'b12cf2d9-65e7-11ed-8a78-feed01260033', '3A SUR OTE 1689', 'c5eaacad-65e7-11ed-8a78-feed01260033', '9651167003', NULL, 29375, 1, 'VEGE760919MCSRMS05', NULL, 'EMPLEADA DOMESTICA', 'AYUDANTE', 'GUADALUPE VICTORIA', 4, 0, 700, 'Semanal', 'RAMON DOMINGUEZ MACIAS', 45, 0, 'AGRICULTOR', 'AGRICULTOR', 3000, 'GUADALUPE VICTORIA', '9651227370', 'Propia', 15, 0, 3, 'EL CONYUGE', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 29, 1, '2022-11-16 22:13:31'),
('d3d0f6d65b7ef1918992dc9b8a2e02fa', 'VIRIDIANA GUADALUPE LOPEZ NUÑEZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'AV CUAUHTEMOC 754', 'bd193952-66c9-11ed-8a78-feed01260033', '9612028092', NULL, 29160, 0, 'LONV890414MCSPXR06', NULL, 'NEGOCIO PROPIO', 'VENTA DE ANTOJITOS', 'MISMO DOMICILIO', 8, 0, 3000, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 33, 0, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 37, 1, '2022-11-17 22:52:42'),
('d3d9446802a44259755d38e6d163e820', 'JORGE ALBERTO NUCAMENDI JOSE', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '01de812e-65d7-11ed-8a78-feed01260033', '9613592189', NULL, 29178, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 10, 0, '2022-11-16 18:44:32'),
('d645920e395fedad7bbbed0eca3fe2e0', 'JESUS GOMEZ CRUZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '14c7fad4-65e1-11ed-8a78-feed01260033', '9612462919', NULL, 29180, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 40, 0, '2022-11-17 23:12:35'),
('da5d79f48944cc19c60fa019747ffea8', 'GERARDO HERNANDEZ GUTIERREZ', '909caf25-6d02-11ed-8a78-feed01260033', 'C 5 DE MAYO POR LA ESCUELA PRIMARIA', 'a83dfb80-6d02-11ed-8a78-feed01260033', '9613238868', NULL, 29129, 1, 'HEGG890527HCSRTR05', NULL, 'BALCONERIA', 'BALCONERO', '16 DE SEPTIEMBRE', 5, 0, 4000, 'Quincenal', 'KARLA ERMELINDA HERNANDEZ GUTIERREZ', 4, 0, 'EMPLEADA DOMESTICA', 'EMPLEADA DOMESTICA', 3000, 'TUXTLA GUTIERREZ', NULL, 'Propia', 33, 0, 1, 'RUBEN HERNANDEZ RAMIREZ, EL PAPA, ES REFERENCIA', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 86, 1, '2022-11-25 20:58:01'),
('da60f874dfb6f6043285ec3ca857c023', 'LUIS ALBERTO ESPINOSA PEREZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '01de812e-65d7-11ed-8a78-feed01260033', '9611054267', NULL, 29178, 0, 'EIPL800513HCSSRS09', NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 39, 0, '2022-11-17 23:08:40'),
('db563ca390f8f2033bcac0d09a3aef41', 'VICTOR HUGO RUIZ MEDINA', 'f23461b0-65de-11ed-8a78-feed01260033', '2A OTE SUR SIN NUMERO', '00bff561-65df-11ed-8a78-feed01260033', '9611941148', NULL, 29380, 1, 'RUMV570422HCSZDC02', NULL, 'RTH PRODUCCIONES, NEGOCIO PROPIO', 'CONTRATISTA DE MUSICA', '2A OTE SUR', 0, 0, 5000, 'Quincenal', 'MAFRIDA RUIZ FAJARDO', 35, 0, 'EN EL HOGAR', 'AMA DE CASA', 0, NULL, NULL, 'Propia', 35, 0, 0, 'LA ESPOSA', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 105, 1, '2022-12-05 17:29:06'),
('dd4bdb1632f1815d890f2400f00cb7d4', 'MARIA EDID LUNA RUIZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '01de812e-65d7-11ed-8a78-feed01260033', '9613575717', NULL, 29178, 0, 'LURE790328MCSNZD05', NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 112, 0, '2022-12-05 18:19:34'),
('dde2566ecf7108ad5bd38a03ea1a6e92', 'ENCARNACION TRINIDAD ESQUINCA', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'AV JAIME SABINES MZ 8 LTE 32, EL PEJE DE ORO', 'f5f2baa1-6d18-11ed-8a78-feed01260033', '9613697982', NULL, 29058, 1, 'TIEE640225HCSRSN08', NULL, 'EMPLEADO DE GOBIERNO DEL ESTADO', 'OFICIAL', 'LIB SUR OTE, SEGURIDAD PUBLICA DEL ESTADO', 30, 0, 5300, 'Quincenal', 'ROSA LOPEZ PEREZ', 34, 0, 'EN EL HOGAR', 'AMA DE CASA', 0, NULL, NULL, 'Propia', 12, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 100, 1, '2022-11-25 23:34:41'),
('de70536ba66303a45b0bfb1d4f94f905', 'ANA CECILIA FLORES ALFARO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'CALLE SIN NOMBRE MANZANA 9 LOTE 904', '01de812e-65d7-11ed-8a78-feed01260033', '9611550704', NULL, 29178, 1, 'FOAA950304MCSLLN03', NULL, 'EN EL HOGAR', 'AMA DE CASA', NULL, 0, 0, 0, 'Quincenal', 'GEU ELEAZAR CAMACHO MARTINEZ', 4, 0, 'AEROPUERTO INTERNACIONAL', 'OPERADOR', 8096, 'CHIAPA DE CORZO', '9612789465', 'Propia', 4, 0, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 3, 1, '2022-11-16 17:59:30'),
('def7869b0926fba849ca8e6e5dae9833', 'SANDRA ISABEL GUTIERREZ SANTIAGO', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'LIBRAMIENTO SUR OTE 1251, COL FRANCISCO I MADERO', '01d3e8b1-65f6-11ed-8a78-feed01260033', '9612799106', NULL, 29090, 0, 'GUSS821222MCSTNN01', NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 61, 0, '2022-11-22 21:20:11'),
('e02d830c94fc94127ce8981f6c4ac074', 'BLANCA LILIA RUIZ PEREZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '01de812e-65d7-11ed-8a78-feed01260033', '9612878110', NULL, 29178, 0, 'RUPB740913MCSZRL03', NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 119, 0, '2022-12-05 20:39:31'),
('e1080dcd694f940bb9b257cf26ade4ab', 'CRUSMEL CRISTIAN HERNANDEZ GARCIA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'AV 2A OTE SIN NUMERO, BARRIO TIERRA BLANCA', '14c7fad4-65e1-11ed-8a78-feed01260033', '5625083198', NULL, 29180, 1, 'HEGC900519HCSRRR08', NULL, 'ARNECON', 'OPERADOR', 'POR EL TECNOLOGICO, TUXTLA GUTIERREZ', 1, 0, 1200, 'Semanal', 'MARIA DEL REFUGIO NOLASCO MATIAS', 10, 0, 'EN EL HOGAR', 'AMA DE CASA', 0, NULL, '5625083198', 'Propia', 7, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 139, 1, '2022-12-12 23:31:32'),
('e31ca25dab7679e1ce7bfb47488acf05', 'ALEJANDRO ROBLES GUILLEN', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'SALIDA A JULIAN GRAJALES, EL RANCHITO', '34b8256c-7b0f-11ed-8a78-feed01260033', '9613280133', NULL, 29180, 1, 'ROGA700102HCSBLL02', NULL, 'SEGURIDADA PUBLICA', 'OPERATIVIDAD', 'TUXTLA GUTIERREZ', 25, 0, 4300, 'Quincenal', 'JOSEFA RUIZ PEREZ', 30, 0, NULL, NULL, 0, NULL, NULL, 'Propia', 28, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 2, 1, '2023-06-10 23:49:18'),
('e40d25dfaf8c5b132af37994d71abfa1', 'ROSA CASTILLO MORALES', 'b12cf2d9-65e7-11ed-8a78-feed01260033', 'AV 2A NTE OTE SIN NUMERO', 'c5eaacad-65e7-11ed-8a78-feed01260033', '9651218562', NULL, 29375, 1, 'CAMR761217MCSSRS01', NULL, 'NEGOCIO PROPIO', 'VENTA DE TORTILLAS, TACOS FRITOS Y EMPANADAS', 'EN SU DOMICILIO', 4, 0, 600, 'Semanal', 'AURELIO HERNANDEZ GUTIERREZ', 5, 0, 'BONICE', 'VENDEDO', 6000, 'GUADALUPE VICTORIA', NULL, 'Propia', 20, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 16, 1, '2022-11-16 20:09:06'),
('e6e6a84df33ed76483b222c39db89a0a', 'JOSE ARLEY HERNANDEZ PEREZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'C ABELARDO DE LA TORRE G', '8479fc80-6ce0-11ed-8a78-feed01260033', '9613678287', NULL, 29170, 0, 'HEPA010809HCSRRRA8', NULL, 'ENCUBADORA PRO-AVICO', 'VACUNACION', 'RIBERA LAS FLECHAS', 0, 2, 2700, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, 'MANUEL DE JESUS HERNANDEZ PEREZ', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 110, 1, '2022-12-05 18:11:26'),
('e98d1499939a4f35deb64995a903df09', 'FANNY BEATRIZ RUIZ CRUZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '3A AV SUR OTE SIN NUMERO', '14c7fad4-65e1-11ed-8a78-feed01260033', '9616074941', NULL, 29180, 1, 'RUCF000227MCSZRNA2', NULL, 'TELCEL', 'ENCARGADA DE SUCURSAL', 'AV CENTRAL, TUXTLA GUTIERREZ', 2, 0, 3600, 'Semanal', 'ABEL MORALES FLORES', 2, 0, 'PEPSI', 'AYUDANTE GENERAL', 8000, 'PASANDO EL RETEN, RIBREA', '9614485765', 'Propia', 19, 0, 1, 'MAYRA ISABEL RUIZ GOMEZ', '9612432289', 'JULIAN GRAJALES', 'NEGOCIO PROPIO', NULL, 5000, NULL, 1, 0, 1, 137, 1, '2022-12-12 22:39:57'),
('ea5d2f1c4608232e07d3aa3d998e5135', 'MARISA ICELA NUCAMENDI PEREZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '01de812e-65d7-11ed-8a78-feed01260033', '9612997220', NULL, 29178, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 64, 0, '2022-11-22 21:49:56'),
('ec5decca5ed3d6b8079e2e7e7bacc9f2', 'GABRIELA JOSE ALVAREZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '2160574e-66c5-11ed-8a78-feed01260033', '9614159752', NULL, 29169, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 127, 0, '2022-12-12 21:49:34'),
('efdfb52672c2ad3266cd28748af2ca79', 'CELIA GUTIERREZ GARCIA', 'f23461b0-65de-11ed-8a78-feed01260033', 'MZ 5 LTE 6', '00bff561-65df-11ed-8a78-feed01260033', '9612396762', NULL, 29380, 1, 'GUGC720321MCSTRL04', NULL, 'EN EL HOGAR', 'AMA DE CASA', NULL, 0, 0, 0, 'Quincenal', 'LEONARDO PEREZ HERNANDEZ', 30, 0, 'AGRICULTOR', 'AGRICULTOR', 3500, '20 DE NOVIEMBRE', NULL, 'Propia', 0, 0, 0, 'ANA YELLI TOALA CHAMPO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 104, 1, '2022-12-05 16:43:55'),
('f2a17b6938aedfb31152e2c4c9fae1ff', 'WILSON RUIZ MENDEZ', 'f23461b0-65de-11ed-8a78-feed01260033', 'A 3 CUADRAS DE LA ESCUELA', '00bff561-65df-11ed-8a78-feed01260033', '9612722784', NULL, 29380, 1, 'RUMW990117HCSZNL06', NULL, 'CUSTEPEC', 'CHOFER', NULL, 3, 0, 2500, 'Quincenal', 'KARLA GUADALUPE VELAZCO GRAJALES', 3, 0, 'EN EL HOGAR', 'AMA DE CASA', 0, NULL, NULL, 'Familiares', 3, 0, 2, 'BRENDA GUADALUPA GRAJALES CONSTANTINO', '9613026540', 'A 3 CUADRAS DE LA ESCUELA, 20 DE NOVIEMBRE', NULL, NULL, NULL, NULL, 1, 0, 1, 36, 1, '2022-11-17 22:44:55'),
('f3f93702c606844cc549cebce0439195', 'ARIEL NURIULU ACERO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'CABEZA DE AGUA SIN NUMERO', '14c7fad4-65e1-11ed-8a78-feed01260033', '9333276482', NULL, NULL, 0, 'NUAA640125HCSRCR01', NULL, 'NEGOCIO PROPIO', 'COMERCIANTE', 'JULIAN GRAJALES', 0, 0, 3000, 'Semanal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 4, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 27, 1, '2022-11-16 21:54:49'),
('f457c545a9ded88f18ecee47145a72c0', 'MARTHA PEREZ HERNANDEZ', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'DOMICILIO CONOCIDO', 'b895edc1-676c-11ed-8a78-feed01260033', '3223201849', NULL, 29019, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 49, 0, '2022-11-18 18:14:43'),
('f4b9ec30ad9f68f89b29639786cb62ef', 'RAFAEL VAZQUEZ PEREZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '01de812e-65d7-11ed-8a78-feed01260033', '9616591393', NULL, 29178, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 94, 0, '2022-11-25 21:35:01'),
('f4d307d8dbe821d66b83f33778f82cd6', 'CRISTIAN YONATHAN GOMEZ ALEMAN', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '5e909200-65f4-11ed-8a78-feed01260033', '9612785261', NULL, 29180, 0, 'GOAC001010HCSMLRA3', NULL, 'IGNACIO ALLENDE', 'AGRICULTOR', 'IGNACIO ALLENDE', 2, 0, 800, 'Semanal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 21, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 51, 1, '2022-12-19 19:57:09'),
('f5d871015f729cfa6a930c1a46bcaab8', 'AURENA PATRICIA ESCOBAR DIAZ', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'AN PUERTA MZ 49 ED 404 D P A', '9c5a85d7-6cdd-11ed-8a78-feed01260033', '9614231630', NULL, 29027, 1, 'EODA900710MCSSZR05', NULL, 'BESCO LIMPIEZA UVM', 'INTENDENTE', 'FRACC MONTES AZULES, BLVD CASTILLOS 375', 2, 0, 1250, 'Semanal', 'WILLIAM HERNANDEZ CUNDAPI', 9, 0, 'CARNICERIA EL JAROCHO', 'REPARTIDOR', 8000, '5A NTE, 3A Y 2A PTE', '9616086038', 'Familiares', 2, 0, 3, 'MARTHA PATRICIA DIAZ SANCHEZ', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 82, 1, '2022-11-25 16:34:30'),
('f6ad45d70d7edcb8ace285d2fc667d33', 'RAFAEL ALTUZAR PEDROZA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'AV JULIAN GRAJALES 208, BARRIO SAN MIGUEL ARCANGEL', 'da75d751-677f-11ed-8a78-feed01260033', '9611502608', NULL, 29160, 0, 'AUPR691026HDFLDF01', NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 58, 0, '2022-11-18 20:33:18'),
('f874fcadf7e096f6acbf2826adda2728', 'MAYRA ALFARO CHAMPO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '01de812e-65d7-11ed-8a78-feed01260033', '9611928958', NULL, 29178, 0, 'AACM871011MCSLHY02', NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 107, 0, '2022-12-05 17:42:56'),
('f988608bdfda0eeada3a6030e329a016', 'ALBERTO MENDEZ MONTEJO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'CERCA DE FINCA DOLORES', 'a5ef60ca-66d4-11ed-8a78-feed01260033', '9612464969', NULL, 29176, 1, 'MEMA931007HCSNNL00', NULL, 'AEROPUERTO INTERNACIONAL', 'AGENTE DE TRAFICO', 'AEROPUERTO INTERNACIONAL', 1, 8, 3500, 'Quincenal', 'ANGELICA GUADALUPE MACIAS GARCIA', 2, 0, 'EN EL HOGAR', 'AMA DE CASA', 0, NULL, '9616508212', 'Propia', 28, 0, 1, 'LUCIA MONTEJO JOSE', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 45, 1, '2022-11-18 00:12:34'),
('fadcb7fd3b860fefec95be2da09d0527', 'BARTOLOME COUTIÑO LOPEZ', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'MEXICO LT 12 MZ 107, AV GUANAJUATO TLAXCALA', '2f9c6f13-66cf-11ed-8a78-feed01260033', '9321027298', NULL, 29019, 1, 'COLB780915HCSTPR00', NULL, 'TALLER BCB', 'OPERADOR', 'JUAN CRISPIN', 15, 0, 5000, 'Semanal', 'NAYELI GONZALEZ DIAZ', 2, 0, 'EN EL HOGAR', 'AMA DE CASA', 0, NULL, NULL, 'Propia', 38, 0, 0, 'LA MAMA, ES REFERENCIA', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 43, 1, '2022-11-17 23:33:50'),
('fca90cb5934b08568158292181c58b7f', 'MARIA DE LOS ANGELES VAZQUEZ NANDAYAPA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'CALLE PRINCIPAL SIN NUMERO, A 100 M. DE LA ESCUELA PRIMARIA', '240f9cb9-65e4-11ed-8a78-feed01260033', '9614015075', NULL, 29180, 1, 'VANA640605MCSZNN04', NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', 'SAUL ORACIO GONZALEZ ORANTES', 4, 0, 'CERVECENTRO', 'PROPIETARIO', 9000, 'EL TEJAR', '9614524700', 'Propia', 4, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 21, 1, '2022-11-16 21:09:15'),
('ffe56005a66d340b51a8c9d7029e3f82', 'GUSTAVO HUMBERTO PANIAGUA RUIZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', 'DOMICILIO CONOCIDO', '01de812e-65d7-11ed-8a78-feed01260033', '9611885717', NULL, 29178, 0, 'PARG480814HCSNZS00', NULL, NULL, NULL, NULL, 0, 0, 0, 'Quincenal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Propia', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 66, 0, '2022-11-22 21:54:04');




INSERT INTO `compra_tipo` (`idtipo_compra`, `nombre_compra`) VALUES
('2c907098-53f8-11ed-9f62-d481d7c3a9ad', 'Credito'),
('36ed5c19-53f8-11ed-9f62-d481d7c3a9ad', 'Contado');


INSERT INTO `configuracion` (`idconfiguracion`, `configuracion`, `valor_char`, `valor_int`) VALUES
(1, 'serie', '0000001', NULL),
(2, 'activador_especial', NULL, 1);


INSERT INTO `documento` (`iddocumento`, `name_documento`, `folio`, `serie`, `idsucursal`, `estado`, `creado_en`) VALUES
(1, 'NOTA DE VENTA', 'MAT', '0000002', 1, 1, '2023-04-18 20:05:09');


INSERT INTO `entrada` (`identrada`, `comprador`, `proveedor`, `tel_proveedor`, `fecha`, `folio_compra`, `tipo_compra`, `sucursal`, `almacen`, `no_pagos`, `pago_parcial`, `subtotal1`, `iva`, `subtotal2`, `descuento`, `total`, `activo`, `borrado_logico`, `creado_en`) VALUES
('8aa6961f-f6a5-11ed-a2bc-feed01180002', '0a96aada-bd56-11ec-b09f-asjg75jfl123', 'eda7c86c-f6a4-11ed-a2bc-feed01180002', '9616187160', '2022-06-21', 'OT51040', '2c907098-53f8-11ed-9f62-d481d7c3a9ad', 1, '43ad1e21-f6a5-11ed-a2bc-feed01180002', 4, 623.9125, 2495.65, 399.3, 2894.95, 0, 2894.95, 1, 0, '2023-05-20 00:30:37'),
('996e3d53-07e8-11ee-92a1-feed01180002', '0a96aada-bd56-11ec-b09f-asjg75jfl123', '17187b04-07e5-11ee-92a1-feed01180002', '0000000000', '2022-07-12', 'CEI-755442', '36ed5c19-53f8-11ed-9f62-d481d7c3a9ad', 1, '43ad1e21-f6a5-11ed-a2bc-feed01180002', 1, 2671.55, 2671.55, 427.45, 3099, 0, 3099, 1, 0, '2023-06-10 23:43:28');


INSERT INTO `entrada_productos` (`identrada_producto`, `entrada`, `producto`, `cantidad`, `precio_x_unidad`, `precio_total`, `precio_x_unidad_iva`, `precio_total_iva`, `con_iva`, `creado_en`) VALUES
('8aa6cb50-f6a5-11ed-a2bc-feed01180002', '8aa6961f-f6a5-11ed-a2bc-feed01180002', '82850be0-f6a4-11ed-a2bc-feed01180002', 1, 2495.65, 2495.65, 2894.954, 2894.954, 0, '2023-05-20 00:30:37'),
('996f8671-07e8-11ee-92a1-feed01180002', '996e3d53-07e8-11ee-92a1-feed01180002', 'dacc0662-07e7-11ee-92a1-feed01180002', 1, 2671.55, 2671.55, 3098.998, 3098.998, 0, '2023-06-10 23:43:28');


INSERT INTO `entrada_productos_serie` (`identrada_producto_serie`, `entrada_productos`, `entrada`, `producto`, `almacen_actual`, `serie`, `vendido`, `creado_en`) VALUES
('8aa6f311-f6a5-11ed-a2bc-feed01180002', '8aa6cb50-f6a5-11ed-a2bc-feed01180002', '8aa6961f-f6a5-11ed-a2bc-feed01180002', '82850be0-f6a4-11ed-a2bc-feed01180002', '43ad1e21-f6a5-11ed-a2bc-feed01180002', '0293', 1, '2023-05-20 00:30:37'),
('996fed8a-07e8-11ee-92a1-feed01180002', '996f8671-07e8-11ee-92a1-feed01180002', '996e3d53-07e8-11ee-92a1-feed01180002', 'dacc0662-07e7-11ee-92a1-feed01180002', '43ad1e21-f6a5-11ed-a2bc-feed01180002', 'R9PT414EY7T', 0, '2023-06-10 23:43:28');


INSERT INTO `modalidad_pago` (`idmodalidad_pago`, `nombre_modalidad`) VALUES
('2de9e123-53da-11ed-9f62-d481d7c3a9ad', 'semanal'),
('35217c59-53da-11ed-9f62-d481d7c3a9ad', 'quincenal'),
('45519ce0-53da-11ed-9f62-d481d7c3a9ad', 'mensual');


INSERT INTO `movimiento` (`idmovimiento`, `salida`, `fecha`, `abono`, `descuento`, `recargo`, `saldo_al_momento`, `creado_en`) VALUES
('1a9ec532-07e2-11ee-92a1-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', '2022-09-30', 0, 0, 0, 3784, '2023-06-10 22:56:58'),
('1a9f3e27-07e2-11ee-92a1-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', '2022-10-15', 0, 0, 0, 3784, '2023-06-10 22:56:58'),
('1a9fff12-07e2-11ee-92a1-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', '2022-11-15', 0, 0, 0, 3784, '2023-06-10 22:56:58'),
('1aa076c6-07e2-11ee-92a1-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', '2022-11-30', 0, 0, 0, 3784, '2023-06-10 22:56:58'),
('1aa0ebc7-07e2-11ee-92a1-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', '2022-12-31', 0, 0, 0, 3784, '2023-06-10 22:56:58'),
('1aa1709f-07e2-11ee-92a1-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', '2023-01-15', 0, 0, 0, 3784, '2023-06-10 22:56:58'),
('1aa1e486-07e2-11ee-92a1-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', '2023-01-31', 0, 0, 0, 3784, '2023-06-10 22:56:58'),
('1aa2636b-07e2-11ee-92a1-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', '2023-02-15', 0, 0, 0, 3784, '2023-06-10 22:56:58'),
('1aa2d553-07e2-11ee-92a1-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', '2023-02-28', 0, 0, 0, 3784, '2023-06-10 22:56:58'),
('1aa34030-07e2-11ee-92a1-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', '2023-03-15', 0, 0, 0, 3784, '2023-06-10 22:56:58'),
('29bad387-f8dc-11ed-a2bc-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', '2022-07-14', 516, 0, 0, 5884, '2023-05-22 20:06:39'),
('41b0e35c-f8db-11ed-a2bc-feed01180002', '41afc2e9-f8db-11ed-a2bc-feed01180002', '2023-05-22', 500, 0, 0, 6938, '2023-05-22 20:00:09'),
('9750f1e6-07e1-11ee-92a1-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', '2022-08-02', 400, 0, 0, 5484, '2023-06-10 22:53:18'),
('a6c45abf-07e1-11ee-92a1-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', '2022-08-18', 300, 0, 0, 5184, '2023-06-10 22:53:44'),
('b78cbb0b-07e1-11ee-92a1-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', '2022-09-02', 300, 0, 0, 4884, '2023-06-10 22:54:12'),
('edc93216-07e1-11ee-92a1-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', '2022-10-18', 1100, 0, 0, 3784, '2023-06-10 22:55:43');


INSERT INTO `movimiento_atrasos` (`idmovimiento_atraso`, `salida`, `tipo_periodo_atraso`, `periodo_atraso`, `dias_atraso`, `base_atraso`, `debe_atrasado`, `fecha_inicio`, `creado_en`) VALUES
('2a839070-f8dc-11ed-a2bc-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', 'quincenal', 1, 15, 400, 400, '2022-08-16', '2023-05-22 20:06:40'),
('2a84163e-f8dc-11ed-a2bc-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', 'quincenal', 1, 15, 400, 400, '2022-09-01', '2023-05-22 20:06:40'),
('2a849ade-f8dc-11ed-a2bc-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', 'quincenal', 1, 15, 400, 400, '2022-09-16', '2023-05-22 20:06:40'),
('2a851243-f8dc-11ed-a2bc-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', 'quincenal', 1, 15, 400, 400, '2022-10-01', '2023-05-22 20:06:40'),
('2a85877c-f8dc-11ed-a2bc-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', 'quincenal', 1, 15, 400, 400, '2022-10-16', '2023-05-22 20:06:40'),
('2a85e9b3-f8dc-11ed-a2bc-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', 'quincenal', 1, 15, 400, 400, '2022-11-01', '2023-05-22 20:06:40'),
('2a864f0a-f8dc-11ed-a2bc-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', 'quincenal', 1, 15, 400, 400, '2022-11-16', '2023-05-22 20:06:40'),
('2a86ab96-f8dc-11ed-a2bc-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', 'quincenal', 1, 15, 400, 400, '2022-12-01', '2023-05-22 20:06:40'),
('2a8719ab-f8dc-11ed-a2bc-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', 'quincenal', 1, 15, 400, 400, '2023-01-01', '2023-05-22 20:06:40'),
('2a879132-f8dc-11ed-a2bc-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', 'quincenal', 1, 15, 400, 400, '2023-01-16', '2023-05-22 20:06:40'),
('2a87fa3b-f8dc-11ed-a2bc-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', 'quincenal', 1, 15, 400, 400, '2023-02-01', '2023-05-22 20:06:40'),
('2a886dda-f8dc-11ed-a2bc-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', 'quincenal', 1, 15, 400, 400, '2023-02-16', '2023-05-22 20:06:40'),
('2a88d50c-f8dc-11ed-a2bc-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', 'quincenal', 1, 15, 400, 400, '2023-03-01', '2023-05-22 20:06:40'),
('2a893fff-f8dc-11ed-a2bc-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', 'quincenal', 1, 15, 400, 400, '2023-03-16', '2023-05-22 20:06:40'),
('2a89a2fc-f8dc-11ed-a2bc-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', 'quincenal', 1, 15, 400, 400, '2023-04-01', '2023-05-22 20:06:40'),
('2a8a08f4-f8dc-11ed-a2bc-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', 'quincenal', 1, 15, 400, 400, '2023-04-16', '2023-05-22 20:06:40'),
('2a8a7648-f8dc-11ed-a2bc-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', 'quincenal', 1, 15, 400, 400, '2023-05-01', '2023-05-22 20:06:40'),
('2a8ae2e2-f8dc-11ed-a2bc-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', 'quincenal', 1, 15, 400, 400, '2023-05-16', '2023-05-22 20:06:40'),
('a12383d1-0165-11ee-92a1-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', 'quincenal', 1, 15, 400, 400, '2023-06-01', '2023-06-02 16:50:50');

INSERT INTO `usuario` (`idusuario`, `usuario_acceso`, `nombre`, `pass`, `rol`, `puesto`, `estado`, `superadmin`, `no_user`, `creado_en`) VALUES
('0a96aada-bd56-11ec-b09f-asjg75jfl123', 'IGERAG', 'Ruben Aguilar González', '81df10368e0655e4801b66269fd8b973', 'SuperAdmin', '6e3f32fa-bd10-11ec-a5db-d481d723r4ed', 1, 1, 2, '2022-03-29 05:39:17'),
('0a96aada-bd56-11ec-b09f-asjg75jfl382', 'LUIS V', 'Luis Augusto Von Duben Aquino', 'c44688b5061756b3cca2b86c016a1535', 'SuperAdmin', '6e3f32fa-bd10-11ec-a5db-d481d723r4ed', 1, 1, 1, '2022-03-29 05:39:17'),
('b4f9567e-f6a5-11ed-a2bc-feed01180002', 'ADOLFO', 'ADOLFO FERNANDEZ UTRILLA', '8542516f8870173d7d1daba1daaaf0a1', 'Usuario', '6e3f32fa-bd10-11ec-a5db-d481d765gtrs', 1, 0, 3, '2023-05-20 00:31:48');


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


INSERT INTO `permiso_usuario` (`permiso_idpermiso`, `permiso_idusuario`) VALUES
(4, '0a96aada-bd56-11ec-b09f-asjg75jfl123'),
(5, '0a96aada-bd56-11ec-b09f-asjg75jfl123'),
(8, '0a96aada-bd56-11ec-b09f-asjg75jfl123'),
(9, '0a96aada-bd56-11ec-b09f-asjg75jfl123'),
(12, '0a96aada-bd56-11ec-b09f-asjg75jfl123'),
(13, '0a96aada-bd56-11ec-b09f-asjg75jfl123'),
(15, '0a96aada-bd56-11ec-b09f-asjg75jfl123');


INSERT INTO `producto` (`idproducto`, `identificador`, `codigo_barras`, `categoria`, `subcategoria`, `descripcion`, `serializado`, `atr1_producto`, `atr2_producto`, `atr3_producto`, `atr4_producto`, `atr5_producto`, `stock_min`, `stock_max`, `ext_p`, `costo`, `costo_iva`, `costo_contado`, `costo_especial`, `costo_cr1`, `costo_cr2`, `costo_p1`, `costo_p2`, `costo_eq`, `costo_enganche`, `en_stock`, `creado_en`) VALUES
('82850be0-f6a4-11ed-a2bc-feed01180002', 'WSA-1102PCN', NULL, 'cb80e827-f6a3-11ed-a2bc-feed01180002', '18a45e25-f6a4-11ed-a2bc-feed01180002', 'LAVADORA HISENSE 2 TINAS WSA-1102PCN BLANCO/SILVER 11KG (centrifuga 5.50kg, tapa transparente, lavado STRON WASH)', 1, 'HISENSE', 'SEMIAUTOMATICA', '2 TINAS', '11 KILOS', NULL, NULL, NULL, 1, 3053, 3542, 4604, 5295, 7438, 7792, 8.4, 8.8, 443, 802, 0, '2023-05-20 00:23:14'),
('dacc0662-07e7-11ee-92a1-feed01180002', 'TAB A7 LITE', NULL, 'b6545c29-07e5-11ee-92a1-feed01180002', '4e3c7d3c-07e6-11ee-92a1-feed01180002', 'TABLET SAMSUNG MOD GALAXY TAB A7 LITE SM-T220 8.7\" 32 GB + 3 GB RAM', 1, 'SAMSUNG', '8.7\"', '32 GB', '3 GB', NULL, NULL, NULL, 1, 2672, 3100, 4185, 4813, 6509, 6819, 8.4, 8.8, 400, 714, 1, '2023-06-10 23:38:08');


INSERT INTO `proveedor` (`idproveedor`, `nombre_proveedor`, `tel_proveedor`) VALUES
('17187b04-07e5-11ee-92a1-feed01180002', 'MERCADO LIBRE', '0000000000'),
('eda7c86c-f6a4-11ed-a2bc-feed01180002', 'EMPRESAS ORCE SA DE CV', '9616187160');


INSERT INTO `puesto` (`idpuesto`, `puesto`, `descripcion`, `creado_en`) VALUES
('6e3f32fa-bd10-11ec-a5db-d481d723r4ed', 'Administrativo', 'Este es el puesto de administrador de la mueblaria. Podra acceder a cosas de administración', '2022-03-29 06:17:05'),
('6e3f32fa-bd10-11ec-a5db-d481d765gtrs', 'Vendedor-Cobrador', 'Este es el puesto de vendedor', '2022-03-29 06:17:05');


INSERT INTO `referencias_cliente` (`idreferencia`, `nombre`, `domicilio`, `relacion`, `tel`, `nota`, `idcliente`) VALUES
(9, 'IRIS EDUVIGES FLORES ALFARO', 'GALECIO NARCIA', 'HERMANA', '9616935556', '', 'de70536ba66303a45b0bfb1d4f94f905'),
(10, 'ROSARIO RUIZ FLORES', 'GALECIO NARCIA', 'PRIMA', '9611887233', '', 'de70536ba66303a45b0bfb1d4f94f905'),
(11, 'JOSE GREGORIO NUCAMENDI PEREZ', 'GALECIO NARCIA', 'CONOCIDO', '9611018829', '', 'de70536ba66303a45b0bfb1d4f94f905'),
(12, 'RUBICELIA LUNA VIDAL', 'GALECIO NARCIA', 'CONOCIDA', '9611991338', '', 'de70536ba66303a45b0bfb1d4f94f905'),
(13, 'VIRIDIANA PANIAGUA SANCHEZ', 'TUXTLA GUTIERREZ', 'CUÑADA - CONOCIDA', '9613320167', '', 'a2c037c71efd473c881ea537cc7911f9'),
(14, 'JORGE ARTURO TOALA DOMINGUEZ', 'TUXTLA GUTIERREZ', 'PAPA', '9614383316', '', 'a2c037c71efd473c881ea537cc7911f9'),
(15, 'GERARDO ARTURO DOMINGUEZ TOALA', 'TUXTLA GUTIERREZ', 'HERMANO', '9611144132', '', 'a2c037c71efd473c881ea537cc7911f9'),
(16, 'RIGOBERTO SANCHEA VAZQUEZ', 'TUXTLA GUTIERREZ', 'SUEGRO', '9614799566', '', 'a2c037c71efd473c881ea537cc7911f9'),
(17, 'MARIA EZEQUIELA GUTIERREZ ALBORES', 'SUCHIAPA', 'NUERA', '9611171920', '', '7dead25c47abf922dcc154fc56ead3b5'),
(18, 'LIDIA PAULA MORENO GUTIERREZ', 'SUCHIAPA', 'NUERA', '9613027184', '', '7dead25c47abf922dcc154fc56ead3b5'),
(19, 'DOROTEA TECO GARCIA', 'SUCHIAPA', 'HIJA', '9611170413', '', '7dead25c47abf922dcc154fc56ead3b5'),
(20, 'VIRIDIANA GUTIERREZ ALBORES', 'SUCHIAPA', 'CONOCIDA', '9613691226', '', '7dead25c47abf922dcc154fc56ead3b5'),
(21, 'CARLOS GILBERTO MENDEZ GONZALEZ', 'BERRIOZABAL', 'HIJO', '9613727374', '', '34907053fc0f287789116252e776daa2'),
(22, 'UBE YOVANI DOMINGUEZ GONZALEZ', 'JARDINES DEL GRIJALVA', 'HIJO', '9613659917', '', '34907053fc0f287789116252e776daa2'),
(23, 'GLADIS SIOMARA ESCOBAR SHON', 'JARDINES DEL GRIJALVA', 'VECINA', '9611315943', '', '34907053fc0f287789116252e776daa2'),
(24, 'MICHEL JAVIER CARRASCO SOLIZ', 'JARDINES DEL GRIJALVA', 'YERNO', '9614262229', '', '34907053fc0f287789116252e776daa2'),
(25, 'OCTAVIO SANTOS COELLO', '20 DE NOVIEMBRE', 'PRIMO', '9612007815', '', '6b7559e557a13074d62549610e51e562'),
(26, 'NELY DEL CARMEN MENDEZ MONTEROSA', '2O DE NOVIEMBRE', 'MAMA', '9616557335', '', '6b7559e557a13074d62549610e51e562'),
(27, 'OMAR CONDE HERNANDEZ', '20 DE NOVIEMBRE', 'CUÑADO - CONOCIDO', '9613482181', '', '6b7559e557a13074d62549610e51e562'),
(28, 'JOSE GUADALUPE CRUZ HERNANDEZ', '20 DE NOVIEMBRE', 'CONOCIDO', '9612326781', '', '6b7559e557a13074d62549610e51e562'),
(29, 'CARLOS ALBERTO DIAZ PEREZ', 'TUXTLA GUTIERREZ', 'HERMANO', '9614153978', '', 'bf198027c4073a3ecd9c31b14611582c'),
(30, 'ARIANA DIAZ CANSINO', 'TUXTLA GUTIERREZ', 'HERMANA', '9212009200', '', 'bf198027c4073a3ecd9c31b14611582c'),
(31, 'FABIOLA JIMENEZ PEREZ', 'DISTRITO FEDERAL', 'CUÑADA - CONOCIDA', '9611021150', '', 'bf198027c4073a3ecd9c31b14611582c'),
(32, 'NANCY KARINA PEREZ VAZQUEZ', 'GALECIO NARCIA', 'CONOCIDA', '9612700099', '', 'bf198027c4073a3ecd9c31b14611582c'),
(33, 'ENRI FABIAN MENDOZA GALLEGOS', 'JULIAN GRAJALES', 'HIJO', '9616401738', '', '2dea84749df7aa151bf89c548ce895bb'),
(34, 'VIVIANA GUADALUPE COUTIÑO TREJO', 'JULIAN GRAJALES', 'NUERA', '9612348220', '', '2dea84749df7aa151bf89c548ce895bb'),
(35, 'ANITA HERNANDEZ CALVO', 'JULIAN GRAJALES', 'MAMA', '9613668654', '', '2dea84749df7aa151bf89c548ce895bb'),
(36, 'ELVIA PEREZ GOMEZ', 'JULIAN GRAJALES', 'VECINA', '9612187010', '', '2dea84749df7aa151bf89c548ce895bb'),
(37, 'RONALDO MARROQUIN SANCHEZ', 'EL TEJAR', 'HERMANO', '9612062131', '', '42fa35379e271d074776f6372818ddd7'),
(38, 'JOSE MARROQUIN PEÑA', 'EL TEJAR', 'PAPA', '9611826558', '', '42fa35379e271d074776f6372818ddd7'),
(39, 'ANALI DOMINGUEZ MARROQUIN', 'EL TEJAR', 'VECINA', '9611762796', '', '42fa35379e271d074776f6372818ddd7'),
(40, 'ELOY DOMINGUEZ MARROQUIN', 'EL TEJAR', 'PRIMO', '9612023443', '', '42fa35379e271d074776f6372818ddd7'),
(41, 'RUSBEL ARDAI MORENO MARROQUIN', 'SUCHIAPA', 'HIJO', '9611085127', '', '1012ed3411b9bbfebd1cd316faa73518'),
(42, 'ITZEL GUADALUPE MORENO MARROQUIN', 'SUCHIAPA', 'HIJA', '9616253814', '', '1012ed3411b9bbfebd1cd316faa73518'),
(43, 'JESUS GUADALUPE SARAUZ NAFATE', 'SUCHIAPA', 'CHALAN', '9612784457', '', '1012ed3411b9bbfebd1cd316faa73518'),
(44, 'JOSE MARTIN CHAMPO NAFATE', 'SUCHIAPA', 'CONOCIDO', '9612023895', '', '1012ed3411b9bbfebd1cd316faa73518'),
(48, 'AURELIO HERNANDEZ CASTILLO', 'GUADALUPE VICTORIA', 'HIJO', '9612368460', '', 'e40d25dfaf8c5b132af37994d71abfa1'),
(49, 'FELIPE HERNANDEZ CASTILLO', 'GUADALUPE VICTORIA', 'HIJO', '9651194577', '', 'e40d25dfaf8c5b132af37994d71abfa1'),
(50, 'ARTEMIA MACIAS PEREZ', 'GUADALUPE VICTORIA', 'VECINA', '9616427986', '', 'e40d25dfaf8c5b132af37994d71abfa1'),
(55, 'ROSA ANGELITA TOALA MENDEZ', 'GUADALUPE VICTORIA', 'VECINA', '9611954072', '', '783ae2d6b5eee0807ddfd484b062fb26'),
(56, 'HEIDI ROCIO GUZMAN PEREZ', 'GUADALUPE VICTORIA', 'CONOCIDA', '9611953851', '', '783ae2d6b5eee0807ddfd484b062fb26'),
(57, 'JUAN MANUEL VAZQUEZ BILCHIS', 'GUADALUPE VICTORIA', 'CUÑADO', '9612942380', '', '783ae2d6b5eee0807ddfd484b062fb26'),
(58, 'MANUEL ANTONIO VAZQUEZ GOMEZ', 'GUADALUPE VICTORIA', 'SOBRINO', '9656975258', '', '783ae2d6b5eee0807ddfd484b062fb26'),
(59, 'DULCE ANITA SANCHEZ RUIZ', 'EL TEJAR', 'PRIMA', '5525090929', '', 'd2eb7ed18b185f259e59e30290472600'),
(60, 'GUDELIO RUIZ SANCHEZ', 'NICOLAS BRAVO', 'PAPA', '9612030346', '', 'd2eb7ed18b185f259e59e30290472600'),
(61, 'GUADALUPE DIAZ PEREZ', 'TUXTLA GUTIERREZ', 'AMIGA', '9611935468', '', 'd2eb7ed18b185f259e59e30290472600'),
(62, 'ANGELICA GARCIA COLMENAREZ', 'TUXTLA GUTIERREZ', 'AMIGA', '9613164737', '', 'd2eb7ed18b185f259e59e30290472600'),
(63, 'MARIA NOEMI SANCHEZ ESCOBAR', 'MISMO DOMICILIO', 'SOBRINA', '9614373031', '', '6ab24fa03cbcef87de7fa8adbc181a78'),
(64, 'MARISOL ESCOBAR DE LA CRUZ', 'AMAPOLA 2825, JARDINES DEL GRIJALVA', 'HERMANA', '9612608771', '', '6ab24fa03cbcef87de7fa8adbc181a78'),
(65, 'VERONICA MARTINEZ OCAÑA', 'BARRIO EL CERRITO, POR LA SEC. LOPEZ MATEOS', 'COMPAÑERA TRABAJO', '9613592031', '', '6ab24fa03cbcef87de7fa8adbc181a78'),
(66, 'REBECA JOSEFINA CRUZ GONZALEZ', 'BARRIO NIÑO DE ATOCHA', 'AMIGA', '9611773664', '', '6ab24fa03cbcef87de7fa8adbc181a78'),
(67, 'MARIA DE JESUS PEREZ ENRIQUEZ', 'JULIAN GRAJALES', 'HERMANA', '9321220084', '', '77027d130de938eebdd573938116eb6f'),
(68, 'YESSICA PEREZ ENRIQUEZ', 'JULIAN GRAJALES', 'HERMANA', '9611514648', '', '77027d130de938eebdd573938116eb6f'),
(69, 'MARGARITO HERNANDEZ VICENTE', 'JULIAN GRAJALES', 'CONOCIDO', '9611816615', '', '77027d130de938eebdd573938116eb6f'),
(70, 'AMADOR GOMEZ LOPEZ', 'JULIAN GRAJALES', 'CONOCIDO', '9612443084', '', '77027d130de938eebdd573938116eb6f'),
(71, 'GUADALUPE GONZALEZ VAZQUEZ', 'EL TEJAR', 'HIJA', '9611735477', '', 'fca90cb5934b08568158292181c58b7f'),
(72, 'MARTHA DOMINGUEZ', 'EL TEJAR', 'CONOCIDA', '9611326889', '', 'fca90cb5934b08568158292181c58b7f'),
(73, 'CIELO IVET GONZALEZ VAZQUEZ', 'EL TEJAR', 'HIJA', '9614014851', '', 'fca90cb5934b08568158292181c58b7f'),
(74, 'ANTONIO PEREZ PEREZ', 'EL TEJAR', 'CONOCIDO', '9611806807', '', 'fca90cb5934b08568158292181c58b7f'),
(75, 'NORMA PATRICIA BALBUENA', 'JULIAN GRAJALES', 'SOBRINA', '9613161050', '', '4c357130c2b45e775cd0220a6825bb52'),
(76, 'LUIS ALBERTO BALBUENA BALBUENA', 'JULIAN GRAJALES', 'HERMANO', '9615802277', '', '4c357130c2b45e775cd0220a6825bb52'),
(77, 'MAGNOLIA BALBUENA BALBUENA', 'JULIAN GRAJALES', 'CONOCIDA', '9613001037', '', '4c357130c2b45e775cd0220a6825bb52'),
(78, 'LUSEFINA BALBUENA GOMEZ', 'JULIAN GRAJALES', 'CONOCIDA', '9611650630', '', '4c357130c2b45e775cd0220a6825bb52'),
(79, 'CIELO MARGOTH FLECHA CORDO', 'IGNACIO ALLENDE', 'MAMA', '9612048442', '', '375cf1e6e3aa2a37fb4adbbdddd39000'),
(80, 'ALEXIA RAMOS FLECHA', 'IGNACIO ALLENDE', 'HERMANA', '9988703812', '', '375cf1e6e3aa2a37fb4adbbdddd39000'),
(81, 'JOSE MANUEL CORDOVA GOMEZ', 'IGNACIO ALLENDE', 'AMIGO', '9612641517', '', '375cf1e6e3aa2a37fb4adbbdddd39000'),
(82, 'CRISTOBAL DE JESUS', 'A 3 CASAS DEL CLIENTE', 'AMIGO', '9612041543', '', '375cf1e6e3aa2a37fb4adbbdddd39000'),
(83, 'HUGO MOLINA AGUILAR', 'CASAS GEO', 'HIJO', '9614596535', '', '4dbf5ba63c054c3303da674d2bb4f026'),
(84, 'GUADALUPE AGUILAR RAMOS', 'REAL DEL BOSQUE', 'HERMANA', '9611225453', '', '4dbf5ba63c054c3303da674d2bb4f026'),
(85, 'ARACELY ARAUJO', 'FRACC. LA VICTORIA', 'AMIGA', '9611362172', '', '4dbf5ba63c054c3303da674d2bb4f026'),
(86, 'SAIDAI RUIZ', 'REAL DEL BOSQUE', 'NUERA', '9613234955', '', '4dbf5ba63c054c3303da674d2bb4f026'),
(87, 'MARICELI NURIULU ASERO', 'TUXTLA GUTIERREZ', 'HERMANA', '9614301163', '', 'f3f93702c606844cc549cebce0439195'),
(88, 'JULIO ACERO VIDAL', 'SUCHIAPA', 'TIO', '9611523578', '', 'f3f93702c606844cc549cebce0439195'),
(89, 'JAVIER VAZQUEZ MORENO', 'JULIAN GRAJALES', 'AMIGO', '9612446333', '', 'f3f93702c606844cc549cebce0439195'),
(90, 'SERGIO AGUILAR DIAZ', 'JULIAN GRAJALES', 'AMIGO', '9612609095', '', 'f3f93702c606844cc549cebce0439195'),
(91, 'WILIAN ALEXANDER GOMEZ VERA', 'GUADALUPE VICTORIA', 'HIJO', '9651285456', '', 'd3704e52bfaacee53cfe2614b7944396'),
(92, 'NANCY JASMIN DOMINGUEZ MENDEZ', 'GUADALUPE VICTORIA', 'CONOCIDO', '9613674785', '', 'd3704e52bfaacee53cfe2614b7944396'),
(93, 'YAELI JASMIN ROBLES VERA', 'GUADALUPE VICTORIA', 'HIJA', '6161299551', '', 'd3704e52bfaacee53cfe2614b7944396'),
(94, 'MARIA GUADALUPE DIAZ GARCIA', 'GUADALUPE VICTORIA', 'VECINA', '9651228040', '', 'd3704e52bfaacee53cfe2614b7944396'),
(95, 'LUSEFINA BALBUENA GOMEZ', 'JULIAN GRAJALES', 'HERMANA', '9611650630', '', '8f290d6ec0963d66f56b67ab393450e7'),
(96, 'FERNANDO MAZA MORSIA', 'JULIAN GRAJALES', 'CUÑADO', '9612368082', '', '8f290d6ec0963d66f56b67ab393450e7'),
(97, 'NORMA BALBUENA BALBUENA', 'JULIAN GRAJALES', 'PRIMA', '9616613082', '', '8f290d6ec0963d66f56b67ab393450e7'),
(98, 'JESUS REYES GARCIA', 'JULIAN GRAJALES', 'CONOCIDO', '9611663689', '', '8f290d6ec0963d66f56b67ab393450e7'),
(99, 'SANDRA ISABEL PEREZ LOPEZ', 'RIBERA LA UNION', 'TIA', '9613079752', '', '1d3c84c21cc91e1241850217bc6b2c76'),
(100, 'MARIA CONCEPCION PEREZ LOPEZ', 'RIBERA LAS FLECHAS', 'MAMA', '9612321301', '', '1d3c84c21cc91e1241850217bc6b2c76'),
(101, 'MARTHA EDID VAZQUEZ JIMENEZ', 'RIBERA AMATAL', 'CONOCIDA', '9613045213', '', '1d3c84c21cc91e1241850217bc6b2c76'),
(102, 'BRENDA RIBERA MACIAS', 'RIBERA AMATAL', 'VECINA', '9613356182', '', '1d3c84c21cc91e1241850217bc6b2c76'),
(103, 'MARCIA IVON ARIAS URBINA', 'POTINASPAK, TUXTLA GUTIERREZ', 'AMIGA', '9613031073', '', '092a367c5a70155b17ef9b329964b393'),
(104, 'ROCIO DEL CARMEN MAZARIEGOS GOMEZ', 'CONDESA, TUXTLA GUTIERREZ', 'AMIGA', '9614308575', '', '092a367c5a70155b17ef9b329964b393'),
(105, 'BEATRIZ CORDOBA LOPEZ', 'CENTRO, TUXTLA GUTIERREZ', 'PRIMA', '9613340106', '', '092a367c5a70155b17ef9b329964b393'),
(106, 'WILLIAM RAMIRO ALVAREZ PALACIOS', 'POTINASPAL, TUXTLA GUTIERREZ', 'HERMANO', '9613211174', '', '092a367c5a70155b17ef9b329964b393'),
(107, 'NOEMI SANDOVAL PINEDA', 'CONDESA, TUXTLA GUTIERREZ', 'AMIGA', '9612012218', '', '7819892737cb80cfb5a3d5485efd3805'),
(108, 'MINERVA BARRIOS DE HAN', 'POTINASPAK, TUXTLA GUTIERREZ', 'AMIGA', '9613418505', '', '7819892737cb80cfb5a3d5485efd3805'),
(109, 'LORENOZO RAFAEL MAZARIEGOS', 'SANTA FE, TUXTLA GUTIERREZ', 'HERMANO', '9612301777', '', '7819892737cb80cfb5a3d5485efd3805'),
(110, 'ATILA DEL CARMEN CRUZ ORTIZ', 'SANTA FE, TUXTLA GUTIERREZ', 'CUÑADA', '9613288956', '', '7819892737cb80cfb5a3d5485efd3805'),
(111, 'ADRIANA MACOL PEREZ', 'SALVADOR URBINA, RUMBO AL PARQUE', 'PRIMA', '9611766522', '', '7ccd5f61e6c55f5e758adeebe58e53ac'),
(112, 'MARIA CONCEPCION CABALLERO VELAZQUEZ', 'SALVADOR URBINA', 'TIA', '9611242213', '', '7ccd5f61e6c55f5e758adeebe58e53ac'),
(113, 'BERENICE DEL ROSARIO MARTINEZ ALFARO', 'SALVADOR URBINA', 'VECINA', '9611991612', '', '7ccd5f61e6c55f5e758adeebe58e53ac'),
(114, 'YOVANI MACAL VAZQUEZ', 'SALVADOR URBINA', 'CONOCIDA', '9613145528', '', '7ccd5f61e6c55f5e758adeebe58e53ac'),
(115, 'BRENDA YARENI VELAZCO GRAJALES', '20 DE NOVIEMBRE', 'HIJA', '9611764157', '', '7e19e2e23d69755379b743f787d191fd'),
(116, 'KARLA GUADALUPE VELAZCO GRAJALES', '20 DE NOVIEMBRE', 'HIJA', '9614256484', '', '7e19e2e23d69755379b743f787d191fd'),
(117, 'HUMBERTO DE JESUS RUIZ HERRERA', '20 DE NOVIEMBRE', 'CONOCIDO', '9614303815', '', '7e19e2e23d69755379b743f787d191fd'),
(118, 'WILSON RUIZ MENDEZ', '20 DE NOVIEMBRE', 'CONOCIDO', '9612722784', '', '7e19e2e23d69755379b743f787d191fd'),
(119, 'WILSON RUIZ RUIZ', '20 DE NOVIEMBRE', 'PAPA', '9612652355', '', 'f2a17b6938aedfb31152e2c4c9fae1ff'),
(120, 'ROXANA MENDEZ ZUÑIGA', '20 DE NOVIEMBRE', 'MAMA', '9611981541', '', 'f2a17b6938aedfb31152e2c4c9fae1ff'),
(121, 'CORAZON RUIZ LOPEZ', '20 DE NOVIEMBRE', 'CONOCIDO', '9613016799', '', 'f2a17b6938aedfb31152e2c4c9fae1ff'),
(122, 'HECTOR LOPEZ ZUÑIGA', '20 DE NOVIEMBRE', 'CONOCIDO', '9612188851', '', 'f2a17b6938aedfb31152e2c4c9fae1ff'),
(123, 'IRIS LOPEZ PEREZ', 'CHIAPA DE CORZO', 'PRIMA', '9613437248', '', 'd3d0f6d65b7ef1918992dc9b8a2e02fa'),
(124, 'JORGE OMAR HERNANDEZ NUÑEZ', 'CHIAPA DE CORZO', 'PRIMO', '9613168088', '', 'd3d0f6d65b7ef1918992dc9b8a2e02fa'),
(125, 'BRAYAN RIGOBERTO GUTU NAMINDAMO', 'CHIAPA DE CORZO', 'CONOCIDO', '9611515608', '', 'd3d0f6d65b7ef1918992dc9b8a2e02fa'),
(126, 'BRAYAN JOSE CALVO MARTINEZ', 'CHIAPA DE CORZO', 'CONOCIDO', '9611741311', '', 'd3d0f6d65b7ef1918992dc9b8a2e02fa'),
(127, 'GABRIELA SANDOVAL SIMUTA', 'TUXTLA GUTIERREZ', 'PRIMA', '9612877700', '', '27383a1c423be193a00d65a9bc62a6a4'),
(128, 'FRANCISCO JAVIER SANDOVAL SIMUTA', 'TUXTLA GUTIERREZ', 'PRIMO', '9613566817', '', '27383a1c423be193a00d65a9bc62a6a4'),
(129, 'WILMAR ROBLERO ESCOBAR', 'MOTOCINTLA', 'CONOCIDO', '9626952772', '', '27383a1c423be193a00d65a9bc62a6a4'),
(130, 'LEYDI MAGALI DIAZ DIAZ', 'MOTOCINTLA', 'CONOCIDA', '9621397656', '', '27383a1c423be193a00d65a9bc62a6a4'),
(131, 'ERIKA YANETH COUTIÑO LOPEZ', 'YUQUIZ', 'HERMANA', '9611751844', '', 'fadcb7fd3b860fefec95be2da09d0527'),
(132, 'ROSELIA LOPEZ MAZA', 'LAS GRANJAS', 'MAMA', '9611850031', '', 'fadcb7fd3b860fefec95be2da09d0527'),
(133, 'FERNANDO SALINAS OZUNA', 'ALBANIA BAJA', 'CONOCIDO', '9615803188', '', 'fadcb7fd3b860fefec95be2da09d0527'),
(134, 'AVELARDO PEREZ SANCHEZ', 'TUXTLA GUTIERREZ', 'CONOCIDO', '9191593293', '', 'fadcb7fd3b860fefec95be2da09d0527'),
(135, 'ANA YULISA MARROQUIN SANCHEZ', 'EL TEJAR', 'PRIMA', '9615806514', '', '3b509ce2d9a41fda249b720e20112ac8'),
(136, 'LEONEL DOMINGUEZ MARROQUIN', 'EL TEJAR', 'HERMANO', '9611525048', '', '3b509ce2d9a41fda249b720e20112ac8'),
(137, 'JOSE MENDEZ ENOEL', 'SUCHIAPA', 'PRIMO', '9612390807', '', 'f988608bdfda0eeada3a6030e329a016'),
(138, 'GABRIEL MENDEZ MONTEJO', 'FRANCISCO SARABIA', 'HERMANO', '9619386943', '', 'f988608bdfda0eeada3a6030e329a016'),
(139, 'DANIEL NUCAMENDI', 'GALECIO NARCIA', 'AMIGO', '9612504258', '', 'f988608bdfda0eeada3a6030e329a016'),
(140, 'LUIS ALBERTO CASTRO', 'FRANCISCO SARABIA', 'AMIGO', '9611424365', '', 'f988608bdfda0eeada3a6030e329a016'),
(141, 'NOE MENDEZ MONTEJO', 'FRANCISCO SARABI', 'HERMANO', '9612351344', '', 'b5904f878eb42ed48a4f690d485bace3'),
(142, 'ALBERTO MENDEZ MONTEJO', 'FRANCISCO SARABIA', 'HERMANO', '9612464969', '', 'b5904f878eb42ed48a4f690d485bace3'),
(143, 'JORDAN GOMEZ VICENTE', 'FRANCISCO SARABIA', 'CONOCIDO', '9613137019', '', 'b5904f878eb42ed48a4f690d485bace3'),
(144, 'ANA MARIA ALFARO PASCACIO', 'FRANCISCO SARABIA', 'VENDEDORA EXTERNA', '3328358101', '', 'b5904f878eb42ed48a4f690d485bace3'),
(145, 'LISANDRO RINCON PEREZ', 'EMILIANO ZAPATA', 'CONCUÑO', '9613063717', '', '9e62e4d5a77d21ff0237336fb5e7b4c2'),
(146, 'HECTOR IVAN PEREZ CORTES', 'EMILIANO ZAPATA', 'PRIMO', '9616198867', '', '9e62e4d5a77d21ff0237336fb5e7b4c2'),
(147, 'HECTOR MANUEL PEREZ LAZARO', 'EMILIANO ZAPATA', 'TIO', '9611944449', '', '9e62e4d5a77d21ff0237336fb5e7b4c2'),
(148, 'JOSE CLEMENTE MARTINEZ', 'EMILIANO ZAPATA', 'CONOCIDO', '9612472096', '', '9e62e4d5a77d21ff0237336fb5e7b4c2'),
(149, 'PAOLA YURIDIA GOMEZ MACIAS', 'RIBERA PLAYA VISTA', 'HERMANA', '9612970369', '', '481acf038c1fed0f52b8801f67855332'),
(150, 'FLOR DE MARIA MACIAS ESTRADA', 'RIBERA PLAYA VISTA', 'MAMA', '9613448984', '', '481acf038c1fed0f52b8801f67855332'),
(151, 'BLANCA BERENICE OVILLA AGUILAR', 'RIBERA PLAYA VISTA', 'CONOCIDA', '9612414304', '', '481acf038c1fed0f52b8801f67855332'),
(152, 'YESICA ASUNCION ORDOÑEZ', 'RIBERA PLAYA VISTA', 'CONOCIDO', '9613036022', '', '481acf038c1fed0f52b8801f67855332'),
(157, 'JUAN ANTONIO MARROQUIN LOPEZ', 'TUXTLA GUTIERREZ', 'HIJO', '9612420045', '', '1dbaa611306ed6e2db4cb9e385a976cb'),
(158, 'BRENDA FABIOLA MARROQUIN LOPEZ', 'TUXTLA GUTIERREZ', 'HIJA', '9613764152', '', '1dbaa611306ed6e2db4cb9e385a976cb'),
(159, 'ALFREDO MORA ZUÑIGA', 'TUXTLA GUTIERREZ', 'CONOCIDO', '9613347050', '', '1dbaa611306ed6e2db4cb9e385a976cb'),
(160, 'ALBERTO WASTLO SANTO', 'TUXTLA GUTIERREZ', 'CONOCIDO', '6221737081', '', '1dbaa611306ed6e2db4cb9e385a976cb'),
(161, 'KARINA DEL ROSARIO HERNANDEZ PEREZ', 'JULIAN GRAJALES', 'HERMANA', '9615719448', '', '24868c15b7dc648197d9c966e3ab914b'),
(162, 'DAVID GOMEZ HERNANDEZ', 'JULIAN GRAJALES', 'PRIMO', '9612306188', '', '24868c15b7dc648197d9c966e3ab914b'),
(163, 'LILIANA SANCHEZ ARROYO', 'JULIAN GRAJALES', 'CONOCIDO', '9613713764', '', '24868c15b7dc648197d9c966e3ab914b'),
(164, 'LAURA PATRICIA PEREZ PEREZ', 'JULIAN GRAJALES', 'CONOCIDO', '9614519751', '', '24868c15b7dc648197d9c966e3ab914b'),
(165, 'BERLAIN ZENTENO AGUILAR', 'TUXTLA GUTIERREZ', 'HERMANO', '9613173576', '', '69d3ab889bf82428f921d05b10de0e24'),
(166, 'MAURICIO ZENTENO AGUILAR', 'TUXTLA GUTIERREZ', 'SORBINO', '9612021205', '', '69d3ab889bf82428f921d05b10de0e24'),
(167, 'MARIA GUADALUPE CASTILLEJOS GALLEGOS', 'TUXTLA GUTIERREZ', 'CONOCIDA', '9612556722', '', '69d3ab889bf82428f921d05b10de0e24'),
(168, 'SESARIO HERNANDEZ SANCHEZ', 'TUXTLA GUTIERREZ', 'AMIGO', '9611940252', '', '69d3ab889bf82428f921d05b10de0e24'),
(169, 'LILIA RAMIREZ MORALES', 'CALLE RAFAEL GUTIERREZ', 'MAMA', '9612514163', '', '4cbca2586d0543b7a99d6ab380870eff'),
(170, 'DANIEL JONAPA RAMIREZ', 'CALLE RAFAEL GUTIERREZ', 'HERMANO', '9611006964', '', '4cbca2586d0543b7a99d6ab380870eff'),
(171, 'ELIZABETH ROCHA ALEMAN', '11 SUR OTE', 'PRIMA', '9615801852', '', '4cbca2586d0543b7a99d6ab380870eff'),
(172, 'MARSELI ALEMAN TORRES', '11 SUR OTE', 'SUEGRA', '9611936291', '', '4cbca2586d0543b7a99d6ab380870eff'),
(173, 'ALEJANDRO DIAZ PASCASIO', 'JULIAN GRAJALES', 'PAPA', '9613317790', '', '1c919f2cd33519db2cfc66df1fb593cf'),
(174, 'ALEJANDRA DIAZ VAZQUEZ', 'JULIAN GRAJALES', 'HERMANA', '9613345062', '', '1c919f2cd33519db2cfc66df1fb593cf'),
(175, 'CARLOS VICENTE EPINOSA', 'JULIAN GRAJALES', 'CUÑADO', '2285127033', '', '1c919f2cd33519db2cfc66df1fb593cf'),
(176, 'MARCO ANTONIO DOMINGUEZ MOLINA', 'JULIAN GRAJALES', 'CONOCIDO', '9613345062', '', '1c919f2cd33519db2cfc66df1fb593cf'),
(177, 'ELEAZAR GARCIA GOMEZ', '1A NORTE ENTRE 1A Y 2A SUR NO. 205, COPOYA', 'HERMANO', '9613209360', '', '46313523f3353be73b79e987d2d6f7bc'),
(178, 'PERLA DEL RUBI GARCIA GOMEZ', '4A OTE ENTRE 16 Y 17 NTE, TUXTLA GUTIERREZ', 'HERMANA', '9611310779', '', '46313523f3353be73b79e987d2d6f7bc'),
(179, 'ISIDRA AUDELINA MENDEZ MENDEZ', 'AND. RETABLO MZ 53 EDIFICIO 423 SAN JOSE', 'CONOCIDA', '9611912735', '', '46313523f3353be73b79e987d2d6f7bc'),
(180, 'RENE MORENO RAMIREZ', 'AV VIOLETA NO 254, PASO LIMON', 'CONOCIDO', '9616521946', '', '46313523f3353be73b79e987d2d6f7bc'),
(181, 'YARA DALILA GARCIA PEREZ', 'FRACC LAS FLORES TUXTLA GUTIERREZ', 'TIA', '9932997103', '', '4a73a442da6f957ab1c73541ffdfb01e'),
(182, 'ELISETH BERTRUY GARCIA', 'CENTRO, VILLAHERMOSA', 'HERMANA', '9931108143', '', '4a73a442da6f957ab1c73541ffdfb01e'),
(183, 'LIVIER CHAVEZ VAZQUEZ', 'COL CRUZ CON CASITAS, TUXTLA GUTIERREZ', 'AMIGA', '9611077856', '', '4a73a442da6f957ab1c73541ffdfb01e'),
(184, 'VERONICA BELTRAN', 'FRENTE A SU CASA, DUEÑA DE LA CARNICERIA BELTRAN', 'AMIGA', '9614477376', '', '4a73a442da6f957ab1c73541ffdfb01e'),
(185, 'ROSI GUADALUPE MEGCHUN SANTIAGO', 'AGUA MARINA MZ 37 LTE 6, DEMOCRATICA', 'HIJA', '9612800356', '', '47fc683fde6a2764929cef2891568cba'),
(186, 'JOSE JUAN MEGCHUN SANTIAGO', 'POTINASPAK, TUXTLA GUTIERREZ', 'HERMANO', '9611100152', '', '47fc683fde6a2764929cef2891568cba'),
(187, 'ROSA SANTIZ GOMEZ', 'DEMOCRATICA, TUXTLA GUTIERREZ', 'CONOCIDO', '9611504948', '', '47fc683fde6a2764929cef2891568cba'),
(188, 'TITO CRISOSTOMO ALVAREZ', 'C MONTES DE OCA COL 27 DE FEBRERO', 'CONOCIDO', '9611396666', '', '47fc683fde6a2764929cef2891568cba'),
(189, 'DAVID GOMEZ HERNANDEZ', 'JULIAN GRAJALES', 'HERMANO', '9612306188', '', '2edfe106cf165db3bc1244abfc4d232b'),
(190, 'GRACIELA GOMEZ HERNANDEZ', 'JULIAN GRAJALES', 'HERMANA', '9611141626', '', '2edfe106cf165db3bc1244abfc4d232b'),
(191, 'ROSELINO MARTINEZ ESCOBAR', 'JULIAN GRAJALES', 'VECINO', '9613038131', '', '2edfe106cf165db3bc1244abfc4d232b'),
(192, 'HORFANEY GOMEZ GUTIERREZ', 'JULIAN GRAJALES', 'CONOCIDO', '9612681727', '', '2edfe106cf165db3bc1244abfc4d232b'),
(193, 'ISRAEL VELAZQUEZ PEREZ', 'DISTRITO FEDERAL', 'HERMANO', '9611167182', '', '720ab762f335211f9510814744976521'),
(194, 'ISAAC ESPINOZA VELAZQUEZ', 'LIMITE ENTR DISTRITO FEDERAL Y GALECIO NARCIA', 'SOBRINO', '9616548266', '', '720ab762f335211f9510814744976521'),
(195, 'OSVALDO SANCHEZ', 'NICOLAS BRAVO', 'COMPAÑERO DE TRABAJO', '9612501599', '', '720ab762f335211f9510814744976521'),
(196, 'SERGIO MORENO RUIZ', 'SERGIO MORENO RUIZ', 'COMPAÑERO DE TRABAJO Y VECINO', '9613175023', '', '720ab762f335211f9510814744976521'),
(197, 'ERIKA YANETH LARA GUTIERREZ', 'SUCHIAPA', 'TIA', '9613407407', '', 'c08997a503dd4772f98afd096ea99a1a'),
(198, 'ANTONIO AGUILAR LARA', 'SUCHIAPA', 'TIO', '9613142404', '', 'c08997a503dd4772f98afd096ea99a1a'),
(199, 'FRANCISCO ZIMUTA NANGUELU', 'SUCHIAPA', 'CONOCIDO', '9613707047', '', 'c08997a503dd4772f98afd096ea99a1a'),
(200, 'NEHEMIAS LOPEZ GUTIERREZ', 'SUCHIAPA', 'CONOCIDO', '9612095432', '', 'c08997a503dd4772f98afd096ea99a1a'),
(201, 'KEYLA CRISTEL MACIAS RUIZ', 'A UN COSTADO, JULIAN GRAJALES', 'PRIMA', '9614624059', '', '8456d692667485a3a81daf9b31566e15'),
(202, 'JULIO CESAR MACIAS BALBUENA', 'JULIAN GRAJALES', 'TIO', '9613404171', '', '8456d692667485a3a81daf9b31566e15'),
(203, 'ADARCILIO DE JESUS MOLINA HERNANDEZ', 'A UN COSTAO. JULIAN GRAJALES', 'VECINO', '9612991963', '', '8456d692667485a3a81daf9b31566e15'),
(204, 'LUIS GILBERTO NARCIA MOLINA', 'JULIAN GRAJALES', 'VECINO', '9614597199', '', '8456d692667485a3a81daf9b31566e15'),
(205, 'RAQUEL CRUZ JIMENEZ', '1A PTE NTE 648, BARR COLON', 'HERMANA', '9613045879', '', '9c9f52c8b9b3728c6c760b699b4df441'),
(206, 'VERONICA YANIRA LOPEZ JIMENEZ', '12 NTE ENTRE 3A Y 4A  PTE', 'PRIMA', '9613323593', '', '9c9f52c8b9b3728c6c760b699b4df441'),
(207, 'ANA LETICIA PEREZ RAMIREZ', 'C. CHIAPAS KM 4', 'SOBRINA', '9611225899', '', '9c9f52c8b9b3728c6c760b699b4df441'),
(208, 'VICTOR HUGO DIAZ NIÑODIOS', 'JULIAN GRAJALES', 'TIO', '9611328124', '', '891730bf9e5af6a218a0f927a8b6af13'),
(209, 'JOSE LUIS TORRES RUIZ', 'JULIAN GRAJALES', 'PAPA', '9613181991', '', '891730bf9e5af6a218a0f927a8b6af13'),
(210, 'MARIA LUIZA', 'JULIAN GRAJALES', 'SUEGRA', '9612762406', '', '891730bf9e5af6a218a0f927a8b6af13'),
(211, 'DARINI LISETH GOMEZ RAMOS', 'JULIAN GRAJALES', 'CUÑADA', '9616035543', '', '891730bf9e5af6a218a0f927a8b6af13'),
(212, 'ANDREA AMPARO CUESTA CRUZ', 'SALTILLO COAHUILA', 'HIJA', '8443936109', '', '7b304a3dce927767587935174f20221c'),
(213, 'ROBERTO ANTONIO CUESTA CRUZ', 'JARDINES DEL GRIJALVA', 'HIJO', '9841250866', '', '7b304a3dce927767587935174f20221c'),
(214, 'CELENE YAMILETH PEREZ TOALA', 'JARDINES DEL GRIJALVA', 'CONOCIDO', '9651186675', '', '7b304a3dce927767587935174f20221c'),
(215, 'CARLOS EDUARDO GRAJALES FLORES', 'JARDINES DEL GRIJALVA', 'CONOCIDO', '9971350116', '', '7b304a3dce927767587935174f20221c'),
(216, 'LEONARDO CASTILLEJOS PEREZ', 'SALVADOR URBINA', 'HERMANO', '9611337055', '', '58b6bb5060f837cbbc9e16ea03eaa0ce'),
(217, 'ANGELICA CASTILLEJOS PEREZ', 'SALVADOR URBINA', 'HERMANA', '9612571377', '', '58b6bb5060f837cbbc9e16ea03eaa0ce'),
(218, 'HURELIA MAZA ABENDAÑO', 'PLAN CHIAPAS', 'HIJA', '9612006057', '', '591b3ebc82965c51360586996bcf0891'),
(219, 'MARIA JERTRUDES CRUZ HENRIQUE', 'BERRIOZABAL', 'ESPOSA', '9612016123', '', '591b3ebc82965c51360586996bcf0891'),
(220, 'MADELI JIMENEZ CRUZ', 'BERRIOZABAL', 'CONOCIDO', '9612450133', '', '591b3ebc82965c51360586996bcf0891'),
(221, 'AVI VAZQUEZ SANCHEZ', 'BERRIOZABAL', 'VECINA', '9612631388', '', '591b3ebc82965c51360586996bcf0891'),
(222, 'AIDA SARMIENTO TOLEDO', 'CALLE COJAMA, BOSQUES DEL SUR, TUXTLA', 'MAMA', '9612841257', '', '9b4396d88b6b347cae20222f4fb0fdac'),
(223, 'ARMANDO HERNANDEZ JIMENEZ', 'BOSQUES DEL SUR, TUXTLA', 'PAPA', '9613716436', '', '9b4396d88b6b347cae20222f4fb0fdac'),
(224, 'HECTOR SAMUDIO GUZMAN', 'TUXTLA GUTIERREZ', 'CONOCIDO', '9611875679', '', '9b4396d88b6b347cae20222f4fb0fdac'),
(225, 'ELUISA PEREZ SOTO', 'TUXTLA GUTIERREZ', 'CONOCIDA', '9611946470', '', '9b4396d88b6b347cae20222f4fb0fdac'),
(226, 'TERESA DE JESUS SANCHEZ LOPEZ', 'SALTILLO COAHUILA', 'HIJA', '8444195743', '', '33d086734fda71e3c10f0a7cfe18a6c6'),
(227, 'DIANA BERENICE SANCHEZ LOPEZ', 'QUINTANA ROO', 'HIJA', '9842329705', '', '33d086734fda71e3c10f0a7cfe18a6c6'),
(228, 'GREGORIA GUTIERREZ MONTEJO', 'SUCHIAPA', 'CONOCIDA', '9612497468', '', '33d086734fda71e3c10f0a7cfe18a6c6'),
(229, 'OLIVIA MATIA PEÑA', 'TUXTLA GUTIERREZ', 'CONOCIDA', '9611950414', '', '33d086734fda71e3c10f0a7cfe18a6c6'),
(230, 'ROGELIO DE JESUS BOLIVAR FUENTES', 'TUXTLA GUTIERREZ', 'SOBRINO', '9611937000', '', '28f3e92f8e0cde96fee4caaf3c93daee'),
(231, 'EDGAR BOLIVAR FUENTES', 'TUXTLA GUTIERREZ', 'SOBRINO', '9613642450', '', '28f3e92f8e0cde96fee4caaf3c93daee'),
(232, 'ISLELA SANCHEZ LOPEZ', 'TUXTLA GUTIERREZ', 'CONOCIDA', '9614529103', '', '28f3e92f8e0cde96fee4caaf3c93daee'),
(233, 'ALONDRA QUEVEDO VERA', 'TUXTLA GUTIERREZ', 'CONOCIDA', '9611820027', '', '28f3e92f8e0cde96fee4caaf3c93daee'),
(234, 'MANUEL DE JESUS VICENTE PEREZ', '20 DE NOVIEMBRE', 'CONOCIDO', '9611225290', '', 'acbff1eb3a4f018a2deb1d2e82cce959'),
(235, 'SUANI FERNANDA YAQUELIN HERNANDEZ GARCIA', '20 DE NOVIEMBRE', 'NIETA', '9613156023', '', 'acbff1eb3a4f018a2deb1d2e82cce959'),
(236, 'MARIA ALONZO PEREZ VICENTE', '20 DE NOVIEMBRE', 'CONOCIDO', '9611079560', '', 'acbff1eb3a4f018a2deb1d2e82cce959'),
(237, 'MARI CRUZ OVANDO GARCI', '20 DE NOVIEMBRE', 'SOBRINA', '9612014280', '', 'acbff1eb3a4f018a2deb1d2e82cce959'),
(238, 'LUCRECIA DIAZ SANCHEZ', 'AV TAMARINDO MZ 29 LTE 13 CHIAPA SOL', 'TIA', '9613488462', '', 'f5d871015f729cfa6a930c1a46bcaab8'),
(239, 'ALEXANDRO RUBENAY ESCOBAR DIAZ', 'POTINASPAK, TUXTLA GUTIERREZ', 'HERMANO', '9613189333', '', 'f5d871015f729cfa6a930c1a46bcaab8'),
(240, 'AMPARO LIZBETH URBINA ZAMBRANO', '1A OTE NTE 2063 PEDREGAL SAN ANTONIO', 'CONOCIDO', '9611397272', '', 'f5d871015f729cfa6a930c1a46bcaab8'),
(241, 'GUILLERMINA GUTIERREZ AGUEDA', 'TUXTLA GUTIERREZ', 'CONOCIDO', '9614620424', '', 'f5d871015f729cfa6a930c1a46bcaab8'),
(242, 'GUILLERMO LIEVANO MACAL', 'JULIAN GRAJALES', 'SUEGRO', '9612477857', '', 'ac20271fa4a1b39f68ba5c98b695bcc3'),
(243, 'LIZBETH RUIZ', 'JULIAN GRAJALES', 'VECINA', '9611322850', '', 'ac20271fa4a1b39f68ba5c98b695bcc3'),
(244, 'DELFINA CAÑAVERAL GONZALEZ', 'JULIAN GRAJALES', 'HERMANA', '9614477726', '', 'ac20271fa4a1b39f68ba5c98b695bcc3'),
(245, 'CRISTEL GUADALUPE LIEVANO CAÑAVERAL', 'JULIAN GRAJALES', 'SOBRINA', '9611895603', '', 'ac20271fa4a1b39f68ba5c98b695bcc3'),
(246, 'ERIKA GOMEZ HERNANDEZ', 'AMERICA LIBRE', 'HERMANA', '9612976774', '', 'b07b50819018073f6b47704bcc3f4a6b'),
(247, 'MARIA DEL PILAR GOMEZ HERNANDEZ', 'AMERICA LIBRE', 'HERMANA', '9611574588', '', 'b07b50819018073f6b47704bcc3f4a6b'),
(248, 'JAMISE RAMOS ACEROS', 'AMERICA LIBRE', 'CUÑADA', '9612661692', '', 'b07b50819018073f6b47704bcc3f4a6b'),
(249, 'MAURICIO RAMOS ACEROS', 'AMERICA LIBRE', 'CUÑADO', '9611203929', '', 'b07b50819018073f6b47704bcc3f4a6b'),
(250, 'LALIN ALVAREZ ESTRADA', 'JARDINES DEL GRIJALVA', 'HIJO', '9617082614', '', '652f3e56168451e810c7010c4ce407aa'),
(251, 'JULIO ESTEBAN ALVAREZ ESTRADA', 'JARDINES DEL GRIJALVA', 'HIJO', '9611764566', '', '652f3e56168451e810c7010c4ce407aa'),
(252, 'JOSE MANUEL CASTILLO VENTURA', 'JARDINES DEL GRIJALVA', 'CONOCIDO', '9651229897', '', '652f3e56168451e810c7010c4ce407aa'),
(253, 'VICTOR HUGO ALFARO SANTOS', 'JARDINES DEL GRIJALVA', 'CONOCIDO', '9612581738', '', '652f3e56168451e810c7010c4ce407aa'),
(255, 'RUBEN HERNANDEZ RAMIREZ', '16 DE SEPTIEMBRE, SAN FERNANDO', 'PAPA', '9611921196', '', 'da5d79f48944cc19c60fa019747ffea8'),
(256, 'CLAUDIA HERNANDEZ GUTIERREZ', '16 DE SEPTIEMBRE, SAN FERNANDO', 'HERMANA', '9611000154', '', 'da5d79f48944cc19c60fa019747ffea8'),
(257, 'LUIS DAVID LOPEZ', '16 DE SEPTIEMBRE, SAN FERNANDO', 'CONOCIDO', '9614378984', '', 'da5d79f48944cc19c60fa019747ffea8'),
(258, 'SERGIO LOPEZ FERNANDEZ', '16 DE SEPTIEMBRE, SAN FERNANDO', 'CONOCIDO', '9611063536', '', 'da5d79f48944cc19c60fa019747ffea8'),
(261, 'MARIA UDULIA JIMENEZ JIMENEZ', 'CHIAPA DE CORZO', 'MAMA', '9614524765', '', '6c5a0b4dc49b855cfaba38f48af4ec9e'),
(262, 'ERNESTO GONZALEZ ESCOBAR', 'SANTA FE', 'TIO', '', '', '6c5a0b4dc49b855cfaba38f48af4ec9e'),
(263, 'FERNANDO AVIMAEL DOMINGUEZ PEREZ', 'EL RECUERDO', 'CUÑADO', '9614496074', '', '6c5a0b4dc49b855cfaba38f48af4ec9e'),
(264, 'INGRI MAYLI DOMINGUEZ PEREZ', 'EL RECUERDO', 'CUÑADA', '9611716710', '', '6c5a0b4dc49b855cfaba38f48af4ec9e'),
(265, 'JORGE IVAN NANGUELO LAZARO', 'SUCHIAPA', 'HIJO', '9612161210', '', '9c1e370d784b4f1ac55fe7b8ac4bb2e2'),
(266, 'ERIKA PAOLA LAZARO PEREZ', 'SUCHIAPA', 'SOBRINA', '9612345887', '', '9c1e370d784b4f1ac55fe7b8ac4bb2e2'),
(267, 'CLAUDIA MORENO', 'SUCHIAPA', 'AMIGA', '9611816380', '', '9c1e370d784b4f1ac55fe7b8ac4bb2e2'),
(268, 'MARIA DEL CARMEN', 'SUCHIAPA', 'CONOCIDA', '9613735975', '', '9c1e370d784b4f1ac55fe7b8ac4bb2e2'),
(269, 'ANDRES RAMOS PEREZ', 'PACU', 'CONOCIDO', '9611383544', '', '7ac4faa38ff9e9178e54f575b7c4b145'),
(270, 'TERESITA DE JESUS TOALA RAMOS', '2A OTE NTE 210, PACU', 'SUEGRA', '9611568785', '', '7ac4faa38ff9e9178e54f575b7c4b145'),
(271, 'JUAN CARLOS PEREZ TOALA', 'PACU', 'CONOCIDO', '9616593315', '', '7ac4faa38ff9e9178e54f575b7c4b145'),
(272, 'WILLIAM FABIAN PEREZ PACHECO', 'PACU', 'HERMANO', '9613205276', '', '7ac4faa38ff9e9178e54f575b7c4b145'),
(277, 'VICTOR ALONSO GONZALEZ DIAZ', 'CHIAPA DE CORZO', 'HIJO', '9611281982', '', 'c7fcd7497fdc61e8f56e865fadd46737'),
(278, 'EMILIANO GONZALEZ DIAZ', 'JUAN DE GRIJALVA, CHIAPA DE CORZO', 'HIJO', '9616595993', '', 'c7fcd7497fdc61e8f56e865fadd46737'),
(279, 'ANA CRISTINA PEREZ DIAZ', 'CHIAPA DE CORZO', 'CONOCIDA', '9616590890', '', 'c7fcd7497fdc61e8f56e865fadd46737'),
(280, 'ADAN PEREZ HERNANDEZ', 'CHIAPA DE CORZO', 'CONOCIDO', '9613561520', '', 'c7fcd7497fdc61e8f56e865fadd46737'),
(281, 'MARIA VICTORIA TORRES HERNANDEZ', 'C MORELOS ENTRE ALVARO OBREGON E HIDALGO, CHIAPA DE CORZO', 'HERMANA', '9616592882', '', '55926ae63776f9941c346247ab95d8a3'),
(282, 'GABRIELA GUADALUPE DOMINGUEZ TORRES', 'CARR INTERNACIONAL, RIB. NAMDAMBUA, CHIAPA DE CORZO', 'HIJA', '9612184354', '', '55926ae63776f9941c346247ab95d8a3'),
(283, 'MARIA MAGDALENA ARCOS MENDEZ', 'INFONAVIT, CHIAPA DE CORZO', 'CONOCIDA', '9611157769', '', '55926ae63776f9941c346247ab95d8a3'),
(284, 'MARIA LOPEZ PAKISTAN', 'AV HIDALGO Y LAZARO CARDENAS, CHIAPA DE CORZO', 'CONOCIDA', '9611431447', '', '55926ae63776f9941c346247ab95d8a3'),
(285, 'MARIA DEL CARMEN TRINIDAD ESQUINCA', 'NUEVO LEON, MONTERREY', 'HERMANA', '8184675238', '', 'dde2566ecf7108ad5bd38a03ea1a6e92'),
(286, 'ANA SILVIA TRINIDAD ESQUINCA', 'LAS GRANJAS, TUXTLA GUTIERREZ', 'HERMANA', '9616384355', '', 'dde2566ecf7108ad5bd38a03ea1a6e92'),
(287, 'EZEQUIEL ALVAREZ PEREZ', 'LAS GRANJAS, TUXTLA GUTIERREZ', 'CONOCIDO', '9161002630', '', 'dde2566ecf7108ad5bd38a03ea1a6e92'),
(288, 'JOSE LUIS ALVAREZ VELEZ', 'LAS GRANJAS, TUXTLA GUTIERREZ', 'CONOCIDO', '9611867792', '', 'dde2566ecf7108ad5bd38a03ea1a6e92'),
(289, 'SERGIO ALEJANDRO GARCIA SIMUTA', 'GALECIO NARCIA', 'AMIGO', '9613717152', '', '3be225645091ec11f22003c419cf5919'),
(290, 'CANDELARIO MEJIA SERRANO', 'DISTRITO FEDERAL', 'PRIMO', '9614805902', '', '3be225645091ec11f22003c419cf5919'),
(291, 'MARIA DEL ROSARIO MENDEZ GOMEZ', 'AURORA BUENA VISTA', 'SUEGRA', '9612519959', '', '3be225645091ec11f22003c419cf5919'),
(292, 'EDWIN LEMIN PEREZ GUTIERREZ', 'AV 7A NTE OTE S.N.', 'HIJO', '9613374289', '', 'efdfb52672c2ad3266cd28748af2ca79'),
(293, 'VIOLETA PEREZ GUTIERREZ', 'AV 7A NTE OTE S.N.', 'PRIMA', '9612509370', '', 'efdfb52672c2ad3266cd28748af2ca79'),
(294, 'ALDEMAR TOALA JOSE', 'AV 7A NTE OTE S.N.', 'VECINO', '9613668771', '', 'efdfb52672c2ad3266cd28748af2ca79'),
(295, 'AMAYRANI PEREZ GUTIERREZ', 'AV 7A NTE', 'HIJA', '9614951673', '', 'efdfb52672c2ad3266cd28748af2ca79'),
(296, 'FRIDA SOFIA RUIZ RUIZ', 'AL LADO DE LA CASA DEL CLIENTE', 'HIJA', '9613751508', '', 'db563ca390f8f2033bcac0d09a3aef41'),
(297, 'FABIAN GUILLEN PASCASIO', 'AL LADO DE LA CASA DEL CLIENTE', 'CONOCIDO', '9611686256', '', 'db563ca390f8f2033bcac0d09a3aef41'),
(298, 'HUGO SOSTENER RUIZ RUIZ', '20 DE NOVIEMBRE', 'HIJO', '9613355358', '', 'db563ca390f8f2033bcac0d09a3aef41'),
(299, 'ARTURO GOMEZ GÜIRAO', 'POR EL PARQUE, 20 DE NOVIEMBRE', 'CONOCIDO', '9612714717', '', 'db563ca390f8f2033bcac0d09a3aef41'),
(300, 'JUAN ANTONIO PABLO ALTUNAR', 'VICENTE GUERRERO, 20 DE NOVIEMBRE', 'CUÑADO', '3321097223', '', '88ceee688ce41b0fdda67e4328d16e8f'),
(301, 'MARIA VIRGINIA PABLO ALTUNAR', '20 DE NOVIEMBRE', 'CUÑADA', '9612157334', '', '88ceee688ce41b0fdda67e4328d16e8f'),
(302, 'JOSE GOMEZ TORRES', 'POR EL CAMPO, 20 DE NOVIEMBRE', 'CONOCIDO', '9613154385', '', '88ceee688ce41b0fdda67e4328d16e8f'),
(303, 'ESUIN CHAMPO SUCHIAPA', '3 MAYO LAS CASITAS, 20 DE NOVIEMBRE', 'CONOCIDO', '9613355320', '', '88ceee688ce41b0fdda67e4328d16e8f'),
(304, 'MARIO SIMUTA DELGADO', 'CENTRO, TUXTLA GUTIERREZ', 'HERMANO', '9651243040', '', '652249ab5a0f0634a2177cc0c48e3ce1'),
(305, 'ANA CRISTEL SIMUTA FLORES', 'CENTRO, TUXTLA GUTIERREZ', 'SOBRINA', '9651161564', '', '652249ab5a0f0634a2177cc0c48e3ce1'),
(306, 'MAYRA JIMENEZ LOPEZ', 'ALBANIA BAJA, TUXTLA GUTIERREZ', 'CONOCIDA', '9612451489', '', '652249ab5a0f0634a2177cc0c48e3ce1'),
(307, 'MARIA DE JESUS HERNANDEZ SANCHEZ', 'JUAN SABINES,COL MORELOS, CHIAPA DE CORZO', 'CONOCIDO', '9613565997', '', '652249ab5a0f0634a2177cc0c48e3ce1'),
(308, 'LUIS ALBERTO HERNANDEZ PEREZ', 'C. ABELARDO DE LA TORRE, AMERICA LIBRE', 'HERMANO', '9613665388', '', 'e6e6a84df33ed76483b222c39db89a0a'),
(309, 'MARIA DEL ROSARIO NARCIA HERNANDEZ', 'C ABELARDO DE LA TORRE, AMERICA LIBRE', 'PRIMA', '9613317110', '', 'e6e6a84df33ed76483b222c39db89a0a'),
(310, 'ANTONIO HERNANDEZ HERNANDEZ', 'EJIDO LA UNION', 'CONOCIDO', '9616440049', '', 'e6e6a84df33ed76483b222c39db89a0a'),
(311, 'ELVI GALLEGOS VERA', 'TUXTLA GUTIERREZ', 'CONOCIDO', '9612450182', '', 'e6e6a84df33ed76483b222c39db89a0a'),
(312, 'KARINA ALVAREZ BALLINAS', 'JARDINES DEL GRIJALVA', 'SOBRINA', '9614295122', '', '2f9560b09a37a46c49a1885f47a1ac0f'),
(313, 'KARLA PATRICIA MOGUEL MENDEZ', 'JARDINES DEL GRIJALVA', 'HIJA', '9611841649', '', '2f9560b09a37a46c49a1885f47a1ac0f'),
(314, 'NATIVIDAD ANGEL RODRIGUEZ', 'TUXTLA GUTIERREZ', 'CONOCIDA', '9611505211', '', '2f9560b09a37a46c49a1885f47a1ac0f'),
(315, 'MARIA DEL SOCORRO MORALES RAMOS', '4A PTE, SAN FRANCISCO', 'CONOCIDA', '9611420563', '', '2f9560b09a37a46c49a1885f47a1ac0f'),
(316, 'ROSARIO SUCHIAPA GOMEZ', '3A NTE, C CENTRAL Y 1A OTE', 'HERMANA', '9614477126', '', 'cf9cc23e2b5ab0bd963f72439e0b9231'),
(317, 'YARENI MENDEZ SUCHIAPA', 'AV 2A NTE', 'HIJA', '9611989780', '', 'cf9cc23e2b5ab0bd963f72439e0b9231'),
(318, 'MAYRA FLORES CHAMPO', '2A NTE', 'VECINA', '9613302603', '', 'cf9cc23e2b5ab0bd963f72439e0b9231'),
(319, 'LAURA PEREZ FLORES', '2A NTE', 'VECINA', '9611087875', '', 'cf9cc23e2b5ab0bd963f72439e0b9231'),
(320, 'MILITA VICTORIA BALBUENA CONSTANTINO', 'AV LAZARO CARDENAS Y CLLJON LAZARO CARDENAS', 'TIA', '9612385688', '', 'a4189853fcdcc0f1a95345310ff4ff45'),
(321, 'TONI ORILIO NANDAYAPA BALBUENA', 'AV LAZARO CARDENAS Y CLLJON LAZARO CARDENAS', 'PRIMO', '9614231553', '', 'a4189853fcdcc0f1a95345310ff4ff45'),
(322, 'BERTHA ELENA PEREZ HERNANDEZ', 'AV ALVARO OBREGON Y TOMAS CUESTA', 'CONOCIDA', '9612678222', '', 'a4189853fcdcc0f1a95345310ff4ff45'),
(323, 'MARIO HERNANDEZ PATISHTAN', 'AV HIDALGO Y SANTO DEGOLLADO', 'CUÑADO', '961287307', '', 'a4189853fcdcc0f1a95345310ff4ff45'),
(324, 'MARIA GUADALUPE MENDOZA GUTIERREZ', 'TUXTLA GUTIERREZ', 'SOBRINA', '9615372859', '', 'b6be92fd3410104737539b6c28875172'),
(325, 'MARIA ANGELA JOSE JOSE', 'FRANCISCO SARABIA', 'MAMA', '9614575301', '', 'b6be92fd3410104737539b6c28875172'),
(326, 'MARIA ELENA PEREZ PEREZ', 'FRANCISCO SARABIA', 'CONOCIDA', '9614251967', '', 'b6be92fd3410104737539b6c28875172'),
(327, 'OLIVER ALBORES PEREZ', 'FRANCISCO SARABIA', 'CONOCIDO', '9612015160', '', 'b6be92fd3410104737539b6c28875172'),
(328, 'MARIA DEL CARMEN GOMEZ MORENO', 'RIBERA LAS FLECHAS', 'PRIMA', '9611995042', '', '577d9de1d02bbcb79ca7a59cf09449f3'),
(329, 'CONCEPCION VALENCIA ALBEDAÑO', 'AV DR BELIZARIO DOMINGUEZ, CHIAPA DE CORZO', 'CONOCIDO', '9612050387', '', '577d9de1d02bbcb79ca7a59cf09449f3'),
(330, 'LEONEL MORENO CUESTA', 'KM 6 POR EL OXXO, RIBERA LAS FLECHAS', 'TIO', '9612881809', '', '577d9de1d02bbcb79ca7a59cf09449f3'),
(331, 'GABRIELA NARCIA HERNANDEZ', 'CHIAPA DE CORZO', 'CONOCIDO', '9613286410', '', '577d9de1d02bbcb79ca7a59cf09449f3'),
(332, 'SAMUEL PEREZ GUILLEN', 'AV CENTRAL Y 2A PTE, PACU', 'HERMANO', '9611135858', '', '8f14b750f8267d2b25489df52e53d13c'),
(333, 'JOSE BERNAL PEREZ GUILLEN', '2A PTE FRENTE AL CAMPO, PACU', 'HERMANO', '9611600316', '', '8f14b750f8267d2b25489df52e53d13c'),
(334, 'JAVIER VAZQUEZ HERNANDEZ', '2A PTE, PACU', 'YERNO', '9612007767', '', '8f14b750f8267d2b25489df52e53d13c'),
(335, 'MANUEL PEREZ TOALA', '2A PTE, PACU', 'HERMANO', '9612394681', '', '8f14b750f8267d2b25489df52e53d13c'),
(336, 'GLADYS XIOMARA ESCOBAR CHONG', 'AND DALIA MZ 1 AL LADO DE SU CASA', 'VECINA', '9611315943', '', '70b6851d0f73536706e284e43dde9a4b'),
(337, 'ELIBETH ESPINOZA VAZQUEZ', 'DOMICILIO CONOCIDO', 'COMPADRE', '9613043601', '', '70b6851d0f73536706e284e43dde9a4b'),
(338, 'FLORINDA CRUZ CORDOVA', '13 SUR ENTRE 1A Y 2A PTE', 'MAMA', '9612625880', '', '70b6851d0f73536706e284e43dde9a4b'),
(339, 'JUAN CORDOVA SARMIENTO', '13 SUR ENTRE 1A Y 2A PTE', 'HERMANO', '9612502385', '', '70b6851d0f73536706e284e43dde9a4b'),
(340, 'ERAYDES NANDUCA MOLINA', 'PRIV 12A OTE NTE SIN NUMERO, BARRIO SAN ANTONIO MALUCO', 'MAMA', '9611028741', '', '07041c56817634bb15e75c2cba43383e'),
(341, 'ROBERTONI INFANTE NANDUCA', 'SAN PEDRO BUENAVISTA, VILLA CORZO', 'HERMANO', '0651278009', '', '07041c56817634bb15e75c2cba43383e'),
(342, 'JORGE INOCENTE ALBORES JIMENEZ', 'COL EL CAPRICHO FRENTE AL MODULO DE POLICIA', 'CONOCIDO', '9613278814', '', '07041c56817634bb15e75c2cba43383e'),
(343, 'MARIVEL TONDOPO NAFATE', 'BARRIO MALUCO SUCHIAPA', 'AMIGA', '9611906448', '', '07041c56817634bb15e75c2cba43383e'),
(344, 'DEY CAROL MORALES NANDUCA', 'CALLEJON EL SALVADOR, SUCHIAPA', 'CONOCIDA', '9612395473', '', 'b732d007018bdc704e701f5816ea0e36'),
(345, 'ANA ISABEL AQUINO HERNANDEZ', 'AMPLIACION JARDINES EL PEDREGAL, TUXTLA GUTIERREZ', 'AMIGA', '9611710582', '', 'b732d007018bdc704e701f5816ea0e36'),
(346, 'ROMALIA NUCAMENDI FERNANDEZ', 'FINCA EL SALVADOR KM 22, SUCHIAPA', 'MAMA', '9611921357', '', 'b732d007018bdc704e701f5816ea0e36'),
(347, 'MAURICIO NUCAMENDI FERNANDEZ', 'FINCA EL SALVADOR, CUCHIAPA', 'TIO', '9612982966', '', 'b732d007018bdc704e701f5816ea0e36'),
(348, 'MELIDA GOMEZ GONZALEZ', 'FRANCISCO SARABIA', 'HERMANA', '9612722719', '', '4da2b5985590574140bd35241b6b41fc'),
(349, 'RODOLFO GOMEZ GONZALEZ', 'FRANCISCO SARABIA', 'HERMANO', '9612304124', '', '4da2b5985590574140bd35241b6b41fc'),
(350, 'CLAUDIA ORTEGA', 'FRANCISCO SARABIA', 'VECINA COMADRE', '9612022943', '', '4da2b5985590574140bd35241b6b41fc'),
(351, 'ROBERTO GRAJALES', 'FRANCISCO SARABIA', 'VECINO COMPADRE', '9611360287', '', '4da2b5985590574140bd35241b6b41fc'),
(352, 'MAIRA ALFARO CHAMPO', 'GALECIO NARCIA', 'HERMANA', '9611928958', '', 'c475dab319efc2cbe2458a238fb31f67'),
(353, 'OCTAVIO ALFARO CHAMPO', 'GALECIO NARCIA', 'HERMANO', '9612705380', '', 'c475dab319efc2cbe2458a238fb31f67'),
(354, 'JARUMI NARCIA LUNA', 'GALECIO NARCIA', 'CUÑADA', '9613609655', '', 'c475dab319efc2cbe2458a238fb31f67'),
(355, 'LUZ MARIA ESPINOSA MIJANGOS', 'AL LADO DEL CLIENTE, LAS FLECHAS', 'MAMA', '9612419754', '', '9e4907185909f5631c3bed30a3e983c7'),
(356, 'SARAIN MACIAS ESTRADA', 'AL LADO DEL CLIENTE, LAS FLECHAS', 'PAPA', '9612437071', '', '9e4907185909f5631c3bed30a3e983c7'),
(357, 'PAOLA GOMEZ MACIAS', 'RIBERA PLAYA VISTA', 'CONOCIDO', '9612970369', '', '9e4907185909f5631c3bed30a3e983c7'),
(358, 'AURA LOPEZ CASTRO', 'RIBERLA LAS FLECHAS', 'CONOCIDO', '9651164245', '', '9e4907185909f5631c3bed30a3e983c7'),
(359, 'LESAI GOMEZ MORALES', 'JULIAN GRAJALES', 'CONOCIDA', '9611679298', '', 'e98d1499939a4f35deb64995a903df09'),
(360, 'LUZ ELENA RUIZ GOMEZ', 'RUMBO AL COBACH, JULIAN GRAJALES', 'TIA', '9611854116', '', 'e98d1499939a4f35deb64995a903df09'),
(361, 'ADASILIO MOLINA HERNANDEZ', 'JULIAN GRAJALES', 'CONOCIDO', '9612991963', '', 'e98d1499939a4f35deb64995a903df09'),
(362, 'ALEXANDER LOPEZ DE LA CRUZ', 'JULIAN GRAJALES', 'PRIMO', '9612165071', '', 'e98d1499939a4f35deb64995a903df09'),
(363, 'PEDRO NOLASCO MATIAS', 'JALTENANGO', 'CUÑADO', '9615723847', '', 'e1080dcd694f940bb9b257cf26ade4ab'),
(364, 'JUANA ALICIA GONZALEZ HERNANDEZ', 'JULIAN GRAJALES', 'HERMANA', '9611306882', '', 'e1080dcd694f940bb9b257cf26ade4ab'),
(365, 'YOANA JIMENEZ RUIZ', 'FRENTE LA TORTILLERIA, JULIAN GRAJALES', 'CONOCIDA', '9611307178', '', 'e1080dcd694f940bb9b257cf26ade4ab'),
(366, 'FELIPE HERNANDEZ HERNANDEZ', 'JULIAN GRAJALES', 'PAPA', '9611615640', '', 'e1080dcd694f940bb9b257cf26ade4ab'),
(367, 'DOLORES MOLINA ALVAREZ', 'AV SANTA ELENA, SANTA FE, CHIAPA DE CORZO', 'HERMANA', '9612532905', '', '1385974ed5904a438616ff7bdb3f7439'),
(368, 'YOLANDA ALVAREZ GARCIA', 'SIN ESPECIFICAR', 'MAMA', '9616164412', '', '1385974ed5904a438616ff7bdb3f7439'),
(369, 'WENDY ESTEFANIA SANTILLAN DOMINGUEZ', 'JULIAN GRAJALES', 'CUÑADA', '9613337594', '', '261caceef1b858c58f90f90dafe3abb7'),
(370, 'ELIU MOLINA SANCHEZ', 'JULIAN GRAJALES', 'HERMANO', '9614476893', '', '261caceef1b858c58f90f90dafe3abb7'),
(371, 'PAULINA BALBUENA GOMEZ', 'JULIAN GRAJALES', 'PRIMA', '9612520369', '', '261caceef1b858c58f90f90dafe3abb7'),
(372, 'MARIA FERNANDA SANTILLAN DOMINGUEZ', 'NICOLAS BRAVO', 'CUÑADA', '9613669661', '', '261caceef1b858c58f90f90dafe3abb7'),
(373, 'WILLIAM FABIO PEREZ PACHECO', 'A UNA CASA, PACU', 'HIJO', '9613205276', '', '668e430f71350aa4f74bb6f9a7896149'),
(374, 'VIRIDIANA PEREZ PACHECO', 'ALTOS DEL SUR, TUXTLA GUTIERREZ', 'HIJA', '9611553335', '', '668e430f71350aa4f74bb6f9a7896149'),
(375, 'YULIANA AGUILAR RAMOS', 'PACU', 'CONOCIDA', '9613664572', '', '668e430f71350aa4f74bb6f9a7896149'),
(376, 'MARGELI TOALA RAMOS', 'PACU', 'VECINA', '9611319979', '', '668e430f71350aa4f74bb6f9a7896149'),
(377, 'JOSE MARROQUIN PEÑA', 'EL TEJAR', 'HERMANO', '9611826558', '', 'c2b6aae0698006cc8e1d18b771c9102b'),
(378, 'LEYDI MARROQUIN SANCHEZ', 'EL TEJAR', 'SORBINA', '9612109508', '', 'c2b6aae0698006cc8e1d18b771c9102b'),
(379, 'GRADIOLA CUNDAPI NAFATE', 'EL TEJAR', 'CONOCIDA', '9614220136', '', 'c2b6aae0698006cc8e1d18b771c9102b'),
(380, 'MARTHA LUCERO NAFATE CUNDAPI', 'EL TEJAR', 'CONOCIDA', '9611378616', '', 'c2b6aae0698006cc8e1d18b771c9102b'),
(381, 'MARIA ISABEL PACHECO NARCIA', 'EL TEJAR', 'MAMA', '9611721352', '', '75e5a2864654ca45694c8ba44ef0ead9'),
(382, 'SANDI LIZETH RUIZ PACHECO', 'NICOLAS BRAVO', 'HERMANA', '9613372547', '', '75e5a2864654ca45694c8ba44ef0ead9'),
(383, 'HUGO ALEJANDRO CRUZ LOPEZ', 'EL TEJAR', 'CUÑADO', '9611693294', '', '75e5a2864654ca45694c8ba44ef0ead9'),
(384, 'MARIA GARCIA', 'EL RANCHITO', 'CONOCIDA', '9614580069', '', '75e5a2864654ca45694c8ba44ef0ead9'),
(385, 'BERNABE DE LA CRUZ MENDEZ', 'SALVADOR URBINA', 'CONOCIDO', '9616521191', '', '764ae0c6513d868d18f805c8094de0d8'),
(386, 'EFRAIN HERNANDEZ MARROQUIN', 'SALVADOR URBINA', 'PRIMO', '9612411001', '', '764ae0c6513d868d18f805c8094de0d8'),
(387, 'CRISTOBAL SANTIAGO PEREZ HERNANDEZ', 'SALVADOR URBINA', 'HIJO', '9611812357', '', '764ae0c6513d868d18f805c8094de0d8'),
(388, 'ALFONSO VENEGA', 'SALVADOR URBINA', 'VECINO', '9612368948', '', '764ae0c6513d868d18f805c8094de0d8'),
(393, 'ANAYANCI GOMEZ ALEMAN', 'IGNACIO ALLENDE', 'HERMANA', '9614571779', '', 'f4d307d8dbe821d66b83f33778f82cd6'),
(394, 'JOSE MIGUEL GOMEZ ALEMAN', 'IGNACIO ALLENDE', 'HERMANO', '9612163303', '', 'f4d307d8dbe821d66b83f33778f82cd6'),
(395, 'VERI RUIZ MOLINA', 'IGNACIO ALLENDE', 'CONOCIDA', '9614511088', '', 'f4d307d8dbe821d66b83f33778f82cd6'),
(396, 'MARIANO MELCHOR RUIZ', 'NICOLAS BRAVO', 'CONOCIDO', '9616494627', '', 'f4d307d8dbe821d66b83f33778f82cd6'),
(397, 'CARLOS ENRIQUE GOMEZ TETUMO', 'CHIAPA DE CORZO', 'HERMANO', '9612322067', '', 'd1e7d0d5ddb280aa224953c2f45b048d'),
(398, 'CRISTIAN ANDREY HERNANDEZ GOMEZ', 'CHIAPA DE CORZO', 'SOBRINO', '9612428995', '', 'd1e7d0d5ddb280aa224953c2f45b048d'),
(399, 'MONICA LEYVA DOMINGUEZ', 'AV INDEPENDENCIA, CHIAPA DE CORZO', 'CONOCIDA', '9613163716', '', 'd1e7d0d5ddb280aa224953c2f45b048d'),
(400, 'LOLIA GUADALUPE GOMEZ DE LUZ', 'CHIAPA DE CORZO', 'CONOCIDA', '9613367066', '', 'd1e7d0d5ddb280aa224953c2f45b048d'),
(404, 'PAUL ANTONIO SOLIZ GUTIERREZ', 'TUXTLA GUTIERREZ', 'HIJO', '9611601662', '', '38e422200245116b5cb324565d8de73f'),
(405, 'CONCEPCION SOLIZ CASTELLANO', 'SAN ANTONIO PEDREGAL, TUXTLA GUTIERREZ', 'PRIMA', '9611956051', '', '38e422200245116b5cb324565d8de73f'),
(406, 'YEMI ACOS SOLIZ', 'LOMA BONITA CALLEJON LA PALOMA, TUXTLA GUTIERREZ', 'CONOCIDA', '9613700922', '', '38e422200245116b5cb324565d8de73f'),
(407, 'LUPITA CASTELLANO LOPEZ', 'TUXTLA GUTIERREZ', 'VECINA - CONOCIDA', '9611007235', '', '38e422200245116b5cb324565d8de73f'),
(408, 'LEYDI ELIZABETH ROBLES RUIZ', 'NICOLAS BRAVO', 'HIJA', '9613263384', '', 'e31ca25dab7679e1ce7bfb47488acf05'),
(409, 'ROMEO ROBLES GUILLEN', 'NICOLAS BRAVO - RANCHITO', 'HERMANO', '9613083869', '', 'e31ca25dab7679e1ce7bfb47488acf05'),
(410, 'ALEXANDER JOSE HERNANDEZ', 'EL CASTAÑO', 'COMPAÑERO', '9613859003', '', 'e31ca25dab7679e1ce7bfb47488acf05'),
(411, 'OCTAVIO CAÑAVERAL', 'JULIAN GRAJALES', 'AMIGO', '9611549482', '', 'e31ca25dab7679e1ce7bfb47488acf05');


INSERT INTO `salida` (`idsalida`, `vendedor`, `cliente`, `fecha_salida`, `documento`, `folio_venta`, `folio_venta_serie`, `tipo_venta`, `modalidad_pago`, `no_pagos`, `pago_parcial`, `per_dia_pago`, `dias_pago_semanal`, `dias_pago_quincenal`, `dias_pago_quincenal_2`, `dias_pago_mensual`, `enganche`, `subtotal1`, `iva`, `subtotal2`, `descuento`, `total_general`, `activo`, `nivel_salida`, `borrado_logico`, `creado_en`) VALUES
('29ba1edf-f8dc-11ed-a2bc-feed01180002', 'b4f9567e-f6a5-11ed-a2bc-feed01180002', '38e422200245116b5cb324565d8de73f', '2022-07-14', 1, 'MAT-0000001', 1, '2651952b-2977-11ed-a437-d481d7c3a9ad', 'quincenal', 16, 400, '2022-08-01', NULL, 1, 16, NULL, 516, 5517.24, 882.76, 6400, 0, 6400, 0, 0, 0, '2023-05-22 20:06:39');


INSERT INTO `salida_productos` (`idsalida_producto`, `salida`, `producto`, `cantidad`, `tipo_precio`, `precio_x_unidad`, `precio_total`, `creado_en`) VALUES
('29ba63ec-f8dc-11ed-a2bc-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', '82850be0-f6a4-11ed-a2bc-feed01180002', 1, 'costo_cr2', 6400, 6400, '2023-05-22 20:06:39');



INSERT INTO `salida_productos_origen` (`idsalida_producto_origen`, `salida_productos`, `salida`, `producto`, `serie_origen`, `creado_en`) VALUES
('29ba852f-f8dc-11ed-a2bc-feed01180002', '29ba63ec-f8dc-11ed-a2bc-feed01180002', '29ba1edf-f8dc-11ed-a2bc-feed01180002', '82850be0-f6a4-11ed-a2bc-feed01180002', '8aa6f311-f6a5-11ed-a2bc-feed01180002', '2023-05-22 20:06:39');



INSERT INTO `subcategoria` (`idsubcategoria`, `nombre`, `categoria`, `atr1`, `atr2`, `atr3`, `atr4`, `atr5`, `contado`, `especial`, `base_inicial_c1`, `ganancia_inicial_c1`, `rango_c1`, `ganancia_subsecuente_c1`, `limite_costo_c1`, `base_inicial_c2`, `ganancia_inicial_c2`, `rango_c2`, `ganancia_subsecuente_c2`, `limite_costo_c2`, `meses_pago`, `meses_garantia`, `enganche`, `creado_en`) VALUES
('18a45e25-f6a4-11ed-a2bc-feed01180002', 'LAVADORAS', 'cb80e827-f6a3-11ed-a2bc-feed01180002', 'MARCA', 'TIPO', 'TINAS', 'CAPACIDAD', NULL, 30, 15, 4000, 110, 400, 104, 20000, 4000, 120, 400, 114, 20000, 8, 12, 9, '2023-05-20 00:20:16'),
('4e3c7d3c-07e6-11ee-92a1-feed01180002', 'TABLETS', 'b6545c29-07e5-11ee-92a1-feed01180002', 'MARCA', 'PANTALLA', 'ALMACENAMIENTO', 'RAM', NULL, 35, 15, 4000, 110, 400, 104, 20000, 4000, 120, 400, 114, 20000, 8, 12, 9, '2023-06-10 23:27:03');



INSERT INTO `subzonas` (`idsubzona`, `subzona`, `idzona`, `creado_en`) VALUES
('00bff561-65df-11ed-8a78-feed01260033', '20 DE NOVIEMBRE', 'f23461b0-65de-11ed-8a78-feed01260033', '2022-11-16 18:46:38'),
('01d3e8b1-65f6-11ed-8a78-feed01260033', 'LIBRAMIENTO SUR', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-16 21:31:18'),
('01de812e-65d7-11ed-8a78-feed01260033', 'GALECIO NARCIA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-16 17:49:24'),
('03d65ebd-6d11-11ed-8a78-feed01260033', 'PACU', 'd590531d-65da-11ed-8a78-feed01260033', '2022-11-25 22:32:16'),
('05638eed-677c-11ed-8a78-feed01260033', 'BENITO JUAREZ', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-18 20:03:08'),
('0efc07e4-6cdd-11ed-8a78-feed01260033', 'CENTRO', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-25 16:20:21'),
('13c9781f-6d04-11ed-8a78-feed01260033', 'FRACC ORQUIDEA', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-25 20:59:39'),
('14c7fad4-65e1-11ed-8a78-feed01260033', 'JULIAN GRAJALES', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-16 19:01:30'),
('1abbf96d-74c5-11ed-8a78-feed01260033', 'RANCHO LAS MARAVILLAS', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-12-05 17:49:02'),
('20c06825-66c4-11ed-8a78-feed01260033', 'CONDESA', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-17 22:06:46'),
('2160574e-66c5-11ed-8a78-feed01260033', 'SALVADOR URBINA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-17 22:13:57'),
('22791dce-676d-11ed-8a78-feed01260033', 'CONOCIDO', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-18 18:16:34'),
('240f9cb9-65e4-11ed-8a78-feed01260033', 'EL TEJAR', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-16 19:23:25'),
('2b7d712d-65f7-11ed-8a78-feed01260033', 'FRACC. RENOVACION', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-16 21:39:37'),
('2f9c6f13-66cf-11ed-8a78-feed01260033', 'LAS GRANJAS', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-17 23:25:56'),
('335e5e01-74da-11ed-8a78-feed01260033', 'BARRIO NIÑO DE ATOCHA', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-12-05 20:20:03'),
('34b8256c-7b0f-11ed-8a78-feed01260033', 'EL RANCHITO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-12-13 17:54:35'),
('3a534567-65de-11ed-8a78-feed01260033', 'NUEVA ESTRELLA', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-16 18:41:05'),
('485e531d-65d9-11ed-8a78-feed01260033', 'PASEO DEL BOSQUE', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-16 18:05:41'),
('4e03d05c-6ab5-11ed-8a78-feed01260033', 'SUCHIAPA', 'd590531d-65da-11ed-8a78-feed01260033', '2022-11-22 22:30:44'),
('59067bed-6d06-11ed-8a78-feed01260033', 'EL RECUERDO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-25 21:15:54'),
('5e909200-65f4-11ed-8a78-feed01260033', 'IGNACIO ALLENDE', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-16 21:19:35'),
('6935afdb-6c37-11ed-8a78-feed01260033', 'BERRIOZABAL', '57f9027c-6c37-11ed-8a78-feed01260033', '2022-11-24 20:34:36'),
('7bf4593a-6c3b-11ed-8a78-feed01260033', 'PLAN DE AYALA', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-24 21:03:45'),
('7e68444c-676f-11ed-8a78-feed01260033', 'PLUMA DE ORO', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-18 18:33:27'),
('8479fc80-6ce0-11ed-8a78-feed01260033', 'AMERICA LIBRE', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-25 16:45:06'),
('85f934ff-74c5-11ed-8a78-feed01260033', 'MORELOS', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-12-05 17:52:02'),
('9c5a85d7-6cdd-11ed-8a78-feed01260033', 'CHAPULTEPEC', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-25 16:24:18'),
('9c71bea3-6c38-11ed-8a78-feed01260033', 'BOSQUES DEL SUR', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-24 20:43:11'),
('9fd39cf8-6aab-11ed-8a78-feed01260033', 'PASO LIMON', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-22 21:21:27'),
('a279fc5f-6b5a-11ed-8a78-feed01260033', 'SANTA CRUZ', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-23 18:14:13'),
('a5ef60ca-66d4-11ed-8a78-feed01260033', 'FRANCISCO SARABIA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-18 00:05:02'),
('a83dfb80-6d02-11ed-8a78-feed01260033', '16 DE SEPTIEMBRE', '909caf25-6d02-11ed-8a78-feed01260033', '2022-11-25 20:49:29'),
('aa719c1c-66c1-11ed-8a78-feed01260033', 'RIBERA AMATAL', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-17 21:49:09'),
('b55ce226-66cd-11ed-8a78-feed01260033', 'KILOMETRO 4', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-17 23:15:21'),
('b86bb966-74c9-11ed-8a78-feed01260033', 'CALVARIUM', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-12-05 18:22:04'),
('b895edc1-676c-11ed-8a78-feed01260033', 'DEMOCRATICA', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-18 18:13:36'),
('b9628f7b-65dc-11ed-8a78-feed01260033', 'JARDINES DEL GRIJALVA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-16 18:30:19'),
('bd193952-66c9-11ed-8a78-feed01260033', 'BARRIO BENITO JUAREZ', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-17 22:46:56'),
('bf42ba53-676d-11ed-8a78-feed01260033', 'RIBERA LAS FLECHAS', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-18 18:20:57'),
('bf6e33a6-7a6b-11ed-8a78-feed01260033', 'AURORA BUENAVISTA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-12-12 22:24:31'),
('c5eaacad-65e7-11ed-8a78-feed01260033', 'GUADALUPE VICTORIA', 'b12cf2d9-65e7-11ed-8a78-feed01260033', '2022-11-16 19:49:25'),
('c8962db7-65d4-11ed-8a78-feed01260033', 'NICOLAS BRAVO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-16 17:33:29'),
('c90f6ef6-6aad-11ed-8a78-feed01260033', 'EL REFUGIO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-22 21:36:55'),
('d43ae49f-6780-11ed-8a78-feed01260033', 'DISTRITO FEDERAL', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-18 20:37:33'),
('d517f521-66c2-11ed-8a78-feed01260033', 'POTINASPAK', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-17 21:57:30'),
('da75d751-677f-11ed-8a78-feed01260033', 'CHIAPA DE CORZO', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-18 20:30:34'),
('e04830b5-65da-11ed-8a78-feed01260033', 'BARRIO SAN FRANCISCO', 'd590531d-65da-11ed-8a78-feed01260033', '2022-11-16 18:17:05'),
('eb29b36c-676a-11ed-8a78-feed01260033', 'EMILIANO ZAPATA', 'bc2b8b27-65d4-11ed-8a78-feed01260033', '2022-11-18 18:00:42'),
('f256b966-7a6b-11ed-8a78-feed01260033', 'FRACC BUENAVENTURA', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-12-12 22:25:56'),
('f5f2baa1-6d18-11ed-8a78-feed01260033', 'RIBERA EL CARMEN', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-11-25 23:29:09'),
('yohrio96-vfgt-23nm-6765-84i34hi883dl', 'LOMA BONITA', 'a3e3dasd-bd10-hyhj-6765-2182783dpoas', '2022-03-29 06:16:55');


INSERT INTO `sucursales` (`idsucursales`, `sucursales`, `descripcion`, `estado`, `matriz`, `tipo`, `creado_en`) VALUES
(1, 'Galecio Narcía-Matriz', 'Matriz de la empresa. Aquí se encuentras los mandos medios y la gerencia. Es el punto central de las operaciones de la mueblería.', 1, 1, 'pii91f44-bc7e-11ec-bf6e-d481d7c3a9qw', '2022-03-29 06:16:44');



INSERT INTO `sucursal_usuario` (`idsucursal_usuario`, `sucursal_idusuario`, `sucursal_idsucursales`) VALUES
(1, '0a96aada-bd56-11ec-b09f-asjg75jfl382', 1),
(8, '0a96aada-bd56-11ec-b09f-asjg75jfl123', 1),
(9, 'b4f9567e-f6a5-11ed-a2bc-feed01180002', 1);


INSERT INTO `tipo` (`idtipo`, `nombre_tipo`) VALUES
('pii91f44-bc7e-11ec-bf6e-d481d7c3a9qw', 'MATRIZ');



INSERT INTO `venta_tipo` (`idtipo_venta`, `nombre_venta`) VALUES
('2651952b-2977-11ed-a437-d481d7c3a9ad', 'Credito'),
('38f8be92-2979-11ed-a437-d481d7c3a9ad', 'PayJoy'),
('462c4a06-2977-11ed-a437-d481d7c3a9ad', 'Contado'),
('e4f5e2d7-5884-11ed-9b0e-d481d7c3a9ad', 'Apartado');


INSERT INTO `zonas` (`idzona`, `zona`, `creado_en`) VALUES
('57f9027c-6c37-11ed-8a78-feed01260033', 'BERRIOZABAL', '2022-11-24 20:34:07'),
('909caf25-6d02-11ed-8a78-feed01260033', 'SAN FERNANDO', '2022-11-25 20:48:50'),
('a3e3dasd-bd10-hyhj-6765-2182783dpoas', 'TUXTLA GUTIERREZ', '2022-03-29 06:16:25'),
('b12cf2d9-65e7-11ed-8a78-feed01260033', 'VILLAFLORES', '2022-11-16 19:48:50'),
('bc2b8b27-65d4-11ed-8a78-feed01260033', 'CHIAPA DE CORZO', '2022-11-16 17:33:08'),
('d590531d-65da-11ed-8a78-feed01260033', 'SUCHIAPA', '2022-11-16 18:16:47'),
('f23461b0-65de-11ed-8a78-feed01260033', 'EMILIANO ZAPATA', '2022-11-16 18:46:13');



COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

