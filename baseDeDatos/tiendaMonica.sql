-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-12-2025 a las 14:36:16
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
-- Base de datos: `tiendamonica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'variante1', 'wew', 1),
(2, 'wdsad', 'dsad', 1),
(3, 'sdasss', 'dsds', 1),
(4, 'asedfeaf', 'adada', 1),
(5, 'dsfs', 'sdds', 1),
(6, 'dsdsd', 'dsdsds', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE `colores` (
  `idColor` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `codigo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`idColor`, `nombre`, `estado`, `codigo`) VALUES
(1, 'amarillo', 1, 'FFFF00'),
(2, 'rojo', 1, 'ff0000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `idCompras` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `total` decimal(18,2) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idProvedor` int(11) NOT NULL,
  `cantidadItems` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_has_insumos`
--

CREATE TABLE `compras_has_insumos` (
  `compras_idCompras` int(11) NOT NULL,
  `insumos_idInsumo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `subTotal` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enlace`
--

CREATE TABLE `enlace` (
  `idEnlace` int(11) NOT NULL,
  `codigo` varchar(200) NOT NULL,
  `fechaInicio` datetime NOT NULL,
  `fechaFin` datetime NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregas`
--

CREATE TABLE `entregas` (
  `idEntrega` int(11) NOT NULL,
  `fechaLlegada` datetime DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `estadoEntrega` tinyint(4) DEFAULT NULL,
  `idCompra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `idInsumo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `precioUnitario` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`idInsumo`, `nombre`, `descripcion`, `cantidad`, `estado`, `precioUnitario`) VALUES
(1, 'estampado', 'afs', 3, 1, 0.00),
(2, 'hojas', 'hojas', 5, 1, 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos_has_productos`
--

CREATE TABLE `insumos_has_productos` (
  `idInsumo` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `insumos_has_productos`
--

INSERT INTO `insumos_has_productos` (`idInsumo`, `idProducto`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `idPago` int(11) NOT NULL,
  `total` decimal(18,2) NOT NULL,
  `fecha` datetime NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `idCompra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `idPedido` int(11) NOT NULL,
  `referencia` varchar(200) NOT NULL,
  `nombreCliente` varchar(100) NOT NULL,
  `apellidoCliente` varchar(100) NOT NULL,
  `fechaPedido` datetime NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  `total` decimal(18,2) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `idEnlace` int(11) DEFAULT NULL,
  `aceptado` tinyint(4) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idPedido`, `referencia`, `nombreCliente`, `apellidoCliente`, `fechaPedido`, `direccion`, `observaciones`, `total`, `estado`, `idEnlace`, `aceptado`, `idUsuario`) VALUES
(3, 'PED-20251217-694273f580537', 'pruebaInsertarVenta', 'prueba', '2025-12-17 04:12:21', 'las palmas', 'no c', 30000.00, 0, NULL, 0, 2),
(4, 'PED-20251217-69427ae6bee9d', 'prueba', 'prueba', '2025-12-17 04:41:58', 'calle 12', 'cssd', 30000.00, 0, NULL, 0, 1),
(5, 'PED-20251217-69427f17db84b', 'prueba2', 'prueba2', '2025-12-17 04:59:51', 'calle 12', 'dssd', 30000.00, 0, NULL, 0, 1),
(6, 'PED-20251217-69427f45d1af4', 'prueba2', 'prueba2', '2025-12-17 05:00:37', 'calle 12', 'dssd', 30000.00, 0, NULL, 0, 1),
(7, 'PED-20251217-69427f617cc1a', 'pruieba2', 'aaaa', '2025-12-17 05:01:05', 'dd', 'dsds', 30000.00, 0, NULL, 0, 1),
(8, 'PED-20251217-69427fe3049d0', 'pruebaInsertarVenta', 'sssss', '2025-12-17 05:03:15', 'calle 12', '43fdfd', 30000.00, 0, NULL, 0, 1),
(9, 'PED-20251217-69428038b3108', 'd', 'prueba', '2025-12-17 05:04:40', 'aaaa', '', 30000.00, 0, NULL, 0, 1),
(10, 'PED-20251217-6942812f12d23', 'dssss', 'prueba', '2025-12-17 05:08:47', 'las palmas', '', 30000.00, 0, NULL, 0, 1),
(11, 'PED-20251217-694282d746102', 'd', 'sssss', '2025-12-17 05:15:51', 'fdfdf', '', 30000.00, 0, NULL, 0, 1),
(12, 'PED-20251217-694283f511b2a', 'pruebaInsertarVenta', 'prueba', '2025-12-17 05:20:37', 'calle 12', '', 30000.00, 0, NULL, 0, 1),
(13, 'PED-20251217-694284c812748', 'pruebaInsertarVenta', 'prueba', '2025-12-17 05:24:08', 'las palmas', '', 30000.00, 0, NULL, 0, 1),
(14, 'PED-20251217-6942cc98dd871', 'pruebaInsertarVenta', 'prueba', '2025-12-17 10:30:32', 'ccxc', 'dsc', 5000.00, 0, NULL, 0, 1),
(15, 'PED-20251217-6942de55cb853', 'pruebaInsertarVenta', 'ffdf', '2025-12-17 11:46:13', 'calle 12', 'rgsd', 34000.00, 0, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_has_variantes`
--

CREATE TABLE `pedido_has_variantes` (
  `pedido_idPedido` int(11) NOT NULL,
  `variantes_idVariante` int(11) NOT NULL,
  `nombreProducto` varchar(45) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precioUnitario` decimal(18,2) NOT NULL,
  `talla` varchar(45) NOT NULL,
  `color` varchar(45) NOT NULL,
  `observaciones` varchar(250) DEFAULT NULL,
  `subTotal` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `pedido_has_variantes`
--

INSERT INTO `pedido_has_variantes` (`pedido_idPedido`, `variantes_idVariante`, `nombreProducto`, `cantidad`, `precioUnitario`, `talla`, `color`, `observaciones`, `subTotal`) VALUES
(3, 2, 'pantaloneta', 1, 30000.00, 'L', 'rojo', '', 30000.00),
(4, 2, 'pantaloneta', 1, 30000.00, 'L', 'rojo', '', 30000.00),
(5, 2, 'pantaloneta', 1, 30000.00, 'L', 'rojo', '', 30000.00),
(6, 2, 'pantaloneta', 1, 30000.00, 'L', 'rojo', '', 30000.00),
(7, 2, 'pantaloneta', 1, 30000.00, 'L', 'rojo', '', 30000.00),
(8, 2, 'pantaloneta', 1, 30000.00, 'L', 'rojo', '', 30000.00),
(9, 2, 'pantaloneta', 1, 30000.00, 'L', 'rojo', '', 30000.00),
(10, 2, 'pantaloneta', 1, 30000.00, 'L', 'rojo', '', 30000.00),
(11, 2, 'pantaloneta', 1, 30000.00, 'L', 'rojo', '', 30000.00),
(12, 2, 'pantaloneta', 1, 30000.00, 'L', 'rojo', '', 30000.00),
(13, 2, 'pantaloneta', 1, 30000.00, 'L', 'rojo', '', 30000.00),
(14, 4, 'prueba22', 1, 5000.00, 'XS', 'rojo', '', 5000.00),
(15, 5, 'prueba22', 1, 34000.00, 'XS', 'amarillo', '', 34000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `idTipoProducto` int(11) NOT NULL,
  `imagen` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombre`, `descripcion`, `estado`, `idTipoProducto`, `imagen`) VALUES
(1, 'camisetaaaaaaaaa', 'camiseta sin fondoaaaaa1', 1, 2, ''),
(2, 'pantaloneta', 'pantaloneta de tela fría', 1, 2, ''),
(3, 'prueba', 'dsd', 1, 2, ''),
(4, 'prueba', 'dsdsds', 0, 1, 'images/productos/prod_6942a8a8137a21.31410971.jpg'),
(5, 'prueba22', 'sss', 1, 1, 'images/productos/prod_6942cc204c3c00.13768423.jpg'),
(6, 'productoPrueba', 'esgsdgs', 1, 4, 'images/productos/prod_6942de8a52bbb3.14049201.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provedores`
--

CREATE TABLE `provedores` (
  `idProvedor` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `contacto` varchar(45) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `provedores`
--

INSERT INTO `provedores` (`idProvedor`, `nombre`, `contacto`, `estado`) VALUES
(1, 'sdas', 'sdasd', 0),
(2, 'textiles sas', '4334344', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provedores_has_categorias`
--

CREATE TABLE `provedores_has_categorias` (
  `idProvedor` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `provedores_has_categorias`
--

INSERT INTO `provedores_has_categorias` (`idProvedor`, `idCategoria`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'ADMIN', 'adminnn', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tallas`
--

CREATE TABLE `tallas` (
  `idTalla` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tallas`
--

INSERT INTO `tallas` (`idTalla`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'XS', NULL, 1),
(2, 'XS', NULL, 0),
(3, 'L', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoproducto`
--

CREATE TABLE `tipoproducto` (
  `idTipoProducto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipoproducto`
--

INSERT INTO `tipoproducto` (`idTipoProducto`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'textiles', 'aas', 1),
(2, 'Ropa Deportiva', 'sadas', 1),
(3, 'add', '', 1),
(4, 'sdssdf', 'dsdds', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `contrasena` varchar(200) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `idRol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `contrasena`, `estado`, `correo`, `idRol`) VALUES
(1, 'ADMIN', '1234', 1, 'pepe@gmail.com', 1),
(2, 'cliente', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variantes`
--

CREATE TABLE `variantes` (
  `idVariante` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `precio` decimal(18,2) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `tallas_idTalla` int(11) NOT NULL,
  `precioTallasGrandes` decimal(18,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `colores_idColor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `variantes`
--

INSERT INTO `variantes` (`idVariante`, `nombre`, `precio`, `estado`, `idProducto`, `tallas_idTalla`, `precioTallasGrandes`, `stock`, `imagen`, `colores_idColor`) VALUES
(1, 'variante1', 33000.00, 1, 1, 1, 0.00, 3, '0', 1),
(2, 'variante1', 30000.00, 1, 2, 3, 0.00, 5, '0', 2),
(3, 'variante222', 50000.00, 1, 2, 1, 0.00, 5, '0', 1),
(4, 'variante1111', 5000.00, 1, 5, 1, 0.00, 4, '0', 2),
(5, 'asddda', 34000.00, 1, 5, 1, 0.00, 44, '0', 1),
(6, 'placa', 40000.00, 1, 5, 1, 0.00, 55, '0', 1),
(7, 'camisetaVerde', 50000.00, 1, 6, 1, 0.00, 5, '0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `idVenta` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `total` decimal(18,2) NOT NULL,
  `estadoPago` tinyint(4) NOT NULL,
  `estadoVenta` tinyint(4) NOT NULL,
  `ganancias` decimal(18,2) NOT NULL,
  `pedido_idPedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`idColor`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`idCompras`),
  ADD KEY `fk_compras_usuarios1_idx` (`idUsuario`),
  ADD KEY `fk_compras_provedores1_idx` (`idProvedor`);

--
-- Indices de la tabla `compras_has_insumos`
--
ALTER TABLE `compras_has_insumos`
  ADD PRIMARY KEY (`compras_idCompras`,`insumos_idInsumo`),
  ADD KEY `fk_compras_has_insumos_insumos1_idx` (`insumos_idInsumo`),
  ADD KEY `fk_compras_has_insumos_compras1_idx` (`compras_idCompras`);

--
-- Indices de la tabla `enlace`
--
ALTER TABLE `enlace`
  ADD PRIMARY KEY (`idEnlace`);

--
-- Indices de la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD PRIMARY KEY (`idEntrega`),
  ADD KEY `fk_entregas_compras1_idx` (`idCompra`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`idInsumo`);

--
-- Indices de la tabla `insumos_has_productos`
--
ALTER TABLE `insumos_has_productos`
  ADD PRIMARY KEY (`idInsumo`,`idProducto`),
  ADD KEY `fk_insumos_has_productos_productos1_idx` (`idProducto`),
  ADD KEY `fk_insumos_has_productos_insumos1_idx` (`idInsumo`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`idPago`),
  ADD KEY `fk_pagos_compras1_idx` (`idCompra`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `fk_pedido_enlace1_idx` (`idEnlace`);

--
-- Indices de la tabla `pedido_has_variantes`
--
ALTER TABLE `pedido_has_variantes`
  ADD PRIMARY KEY (`pedido_idPedido`,`variantes_idVariante`),
  ADD KEY `fk_pedido_has_variantes_variantes1_idx` (`variantes_idVariante`),
  ADD KEY `fk_pedido_has_variantes_pedido1_idx` (`pedido_idPedido`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `fk_productos_tipoProducto1_idx` (`idTipoProducto`);

--
-- Indices de la tabla `provedores`
--
ALTER TABLE `provedores`
  ADD PRIMARY KEY (`idProvedor`);

--
-- Indices de la tabla `provedores_has_categorias`
--
ALTER TABLE `provedores_has_categorias`
  ADD PRIMARY KEY (`idProvedor`,`idCategoria`),
  ADD KEY `fk_provedores_has_categorias_categorias1_idx` (`idCategoria`),
  ADD KEY `fk_provedores_has_categorias_provedores_idx` (`idProvedor`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `tallas`
--
ALTER TABLE `tallas`
  ADD PRIMARY KEY (`idTalla`);

--
-- Indices de la tabla `tipoproducto`
--
ALTER TABLE `tipoproducto`
  ADD PRIMARY KEY (`idTipoProducto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `correo_UNIQUE` (`correo`),
  ADD KEY `fk_usuarios_roles1_idx` (`idRol`);

--
-- Indices de la tabla `variantes`
--
ALTER TABLE `variantes`
  ADD PRIMARY KEY (`idVariante`),
  ADD KEY `fk_variantes_productos1_idx` (`idProducto`),
  ADD KEY `fk_variantes_tallas1_idx` (`tallas_idTalla`),
  ADD KEY `fk_variantes_colores1_idx` (`colores_idColor`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`idVenta`,`pedido_idPedido`),
  ADD KEY `fk_ventas_pedido1_idx` (`pedido_idPedido`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
  MODIFY `idColor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `idCompras` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `enlace`
--
ALTER TABLE `enlace`
  MODIFY `idEnlace` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entregas`
--
ALTER TABLE `entregas`
  MODIFY `idEntrega` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `idInsumo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `idPago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `provedores`
--
ALTER TABLE `provedores`
  MODIFY `idProvedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tallas`
--
ALTER TABLE `tallas`
  MODIFY `idTalla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipoproducto`
--
ALTER TABLE `tipoproducto`
  MODIFY `idTipoProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `variantes`
--
ALTER TABLE `variantes`
  MODIFY `idVariante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `fk_compras_provedores1` FOREIGN KEY (`idProvedor`) REFERENCES `provedores` (`idProvedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compras_usuarios1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `compras_has_insumos`
--
ALTER TABLE `compras_has_insumos`
  ADD CONSTRAINT `fk_compras_has_insumos_compras1` FOREIGN KEY (`compras_idCompras`) REFERENCES `compras` (`idCompras`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compras_has_insumos_insumos1` FOREIGN KEY (`insumos_idInsumo`) REFERENCES `insumos` (`idInsumo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD CONSTRAINT `fk_entregas_compras1` FOREIGN KEY (`idCompra`) REFERENCES `compras` (`idCompras`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `insumos_has_productos`
--
ALTER TABLE `insumos_has_productos`
  ADD CONSTRAINT `fk_insumos_has_productos_insumos1` FOREIGN KEY (`idInsumo`) REFERENCES `insumos` (`idInsumo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_insumos_has_productos_productos1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_pagos_compras1` FOREIGN KEY (`idCompra`) REFERENCES `compras` (`idCompras`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_enlace1` FOREIGN KEY (`idEnlace`) REFERENCES `enlace` (`idEnlace`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido_has_variantes`
--
ALTER TABLE `pedido_has_variantes`
  ADD CONSTRAINT `fk_pedido_has_variantes_pedido1` FOREIGN KEY (`pedido_idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedido_has_variantes_variantes1` FOREIGN KEY (`variantes_idVariante`) REFERENCES `variantes` (`idVariante`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_tipoProducto1` FOREIGN KEY (`idTipoProducto`) REFERENCES `tipoproducto` (`idTipoProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `provedores_has_categorias`
--
ALTER TABLE `provedores_has_categorias`
  ADD CONSTRAINT `fk_provedores_has_categorias_categorias1` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_provedores_has_categorias_provedores` FOREIGN KEY (`idProvedor`) REFERENCES `provedores` (`idProvedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_roles1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `variantes`
--
ALTER TABLE `variantes`
  ADD CONSTRAINT `fk_variantes_colores1` FOREIGN KEY (`colores_idColor`) REFERENCES `colores` (`idColor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_variantes_productos1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_variantes_tallas1` FOREIGN KEY (`tallas_idTalla`) REFERENCES `tallas` (`idTalla`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_ventas_pedido1` FOREIGN KEY (`pedido_idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
