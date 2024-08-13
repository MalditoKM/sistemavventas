-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-08-2024 a las 03:59:50
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemadeventas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_almacen`
--

CREATE TABLE `tb_almacen` (
  `id_producto` int(11) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `stock_minimo` int(11) DEFAULT NULL,
  `stock_maximo` int(11) DEFAULT NULL,
  `precio_compra` decimal(30,2) NOT NULL,
  `precio_venta` decimal(30,2) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `imagen` text DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_almacen`
--

INSERT INTO `tb_almacen` (`id_producto`, `codigo`, `nombre`, `descripcion`, `stock`, `stock_minimo`, `stock_maximo`, `precio_compra`, `precio_venta`, `fecha_ingreso`, `imagen`, `id_usuario`, `id_categoria`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'P-00001', 'COCA QUINA', 'de 2 litros', 17, 11, 500, 9.00, 12.00, '2023-02-12', '2023-02-12-06-26-25__6020052-1000x1000.jpg', 1, 1, '2023-02-12 18:26:25', '2024-07-31 20:51:51'),
(2, 'P-00002', 'AUDIFONOS', 'Con cargado incorporado', 125, 10, 200, 80.00, 120.00, '2023-02-13', '2023-02-13-02-29-53__8810fb37cb2f03d30c7c467ec772b5ed6811e7e6.jpeg', 1, 7, '2023-02-13 14:29:53', '0000-00-00 00:00:00'),
(3, 'P-00003', 'VINO TINTO', 'VINO TINTO BLANCO DE 300 ml', 120, 10, 200, 50.00, 80.00, '2023-02-13', '2023-02-13-02-35-15__vino.JPG', 1, 1, '2023-02-13 14:35:15', '0000-00-00 00:00:00'),
(4, 'P-00004', 'COMPUTADORA GAMES', 'Games', 15, 1, 15, 1200.00, 1400.00, '2024-07-31', '2024-07-31-11-41-01__logo.ico.jpg', 1, 4, '2024-07-31 23:41:01', '2024-08-01 17:04:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_categorias`
--

CREATE TABLE `tb_categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(255) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_categorias`
--

INSERT INTO `tb_categorias` (`id_categoria`, `nombre_categoria`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'LIQUIDOS', '2023-01-24 22:25:10', '2023-01-24 22:25:10'),
(2, 'FRUTAS', '2023-01-25 14:39:50', '2023-01-25 15:09:07'),
(3, 'COMIDAS', '2023-01-25 14:40:27', '0000-00-00 00:00:00'),
(4, 'ELECTRODOMESTICOS', '2023-01-25 14:41:14', '0000-00-00 00:00:00'),
(5, 'VERDURAS', '2023-01-25 14:43:06', '0000-00-00 00:00:00'),
(6, 'MEDICAMENTOS Y COMIDAS', '2023-01-25 14:44:51', '2023-01-25 15:09:22'),
(7, 'ELECTRONICOS', '2023-01-29 23:01:42', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_clientes`
--

CREATE TABLE `tb_clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(250) NOT NULL,
  `cedula` int(11) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_clientes`
--

INSERT INTO `tb_clientes` (`id_cliente`, `nombre_cliente`, `cedula`, `telefono`, `email`, `direccion`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'valentin', 1851042265, '0959264151', 'vale@gmail.com', 'ambato', '2024-07-31 20:13:27', '2024-07-31 20:13:27'),
(3, 'anael', 1851042166, '0987122220', 'ajjaj@gmail.com', 'quito', '2024-07-31 20:48:54', '2024-07-31 20:48:54'),
(5, 'Marlon Vargas', 1851042315, '0987122220', 'marlonvargas@gmail.com', 'ambato', '2024-08-05 21:44:00', '2024-08-05 21:44:00'),
(6, 'camila', 1851042777, '0987122220', 'camila@gmail.com', 'quito', '2024-07-12 20:48:54', '2024-07-31 20:48:54'),
(7, 'Maria Conde', 1851045524, '0987122220', 'maria@gmail.com', 'loja', '2024-08-05 21:44:00', '2024-08-05 21:44:00'),
(8, 'Maria Mendoza', 185102589, '0987122220', 'maria@gmail.com', 'loja', '2024-08-05 21:44:00', '2024-08-05 21:44:00'),
(9, 'valentina Casa', 185102255, '095926815', 'valentina@gmail.com', 'ambato', '2024-07-31 20:13:27', '2024-07-31 20:13:27'),
(10, 'anael catro', 1851049874, '0987126632', 'anael@gmail.com', 'quito', '2024-07-31 20:48:54', '2024-07-31 20:48:54'),
(11, 'mario flores', 1851044321, '0987145678', 'mario@gmail.com', 'loja', '2024-08-05 21:44:00', '2024-08-05 21:44:00'),
(12, 'camila Ordoñes', 1851042888, '0987196587', 'camilaordoñes@gmail.com', 'quito', '2024-07-12 20:48:54', '2024-07-31 20:48:54'),
(13, 'Maria casa', 185104872, '0987123456', 'mariacasa@gmail.com', 'loja', '2024-08-05 21:44:00', '2024-08-05 21:44:00'),
(14, 'jose Mendoza', 185109635, '0987145561', 'jose@gmail.com', 'guayas', '2024-08-05 21:44:00', '2024-08-05 21:44:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_compras`
--

CREATE TABLE `tb_compras` (
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nro_compra` int(11) NOT NULL,
  `fecha_compra` date NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `comprobante` varchar(255) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `precio_compra` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_compras`
--

INSERT INTO `tb_compras` (`id_compra`, `id_producto`, `nro_compra`, `fecha_compra`, `id_proveedor`, `comprobante`, `id_usuario`, `precio_compra`, `cantidad`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 4, 1, '2024-07-31', 1, '001', 1, '15', 5, '2024-07-31 20:55:35', '2024-08-01 00:16:32'),
(2, 1, 2, '2024-07-31', 1, '002', 1, '15', 3, '2024-08-01 01:33:46', '0000-00-00 00:00:00'),
(3, 2, 3, '2024-08-09', 2, '003', 1, '15.5', 20, '2024-08-09 19:15:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_detalle_ventas`
--

CREATE TABLE `tb_detalle_ventas` (
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_detalle_ventas`
--

INSERT INTO `tb_detalle_ventas` (`id_venta`, `id_producto`, `cantidad`) VALUES
(7, 0, 0),
(8, 0, 0),
(8, 2, 1),
(8, 4, 2),
(9, 0, 0),
(10, 0, 0),
(11, 0, 0),
(19, 0, 0),
(19, 1, 1),
(20, 0, 0),
(20, 3, 2),
(21, 0, 0),
(21, 4, 1),
(22, 0, 0),
(22, 1, 1),
(23, 0, 0),
(23, 3, 1),
(23, 2, 1),
(24, 0, 0),
(24, 1, 2),
(25, 0, 0),
(25, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_empresa`
--

CREATE TABLE `tb_empresa` (
  `id_ruc` int(11) NOT NULL,
  `nombre_empresa` varchar(90) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `iva` decimal(30,2) NOT NULL,
  `empresa_foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_empresa`
--

INSERT INTO `tb_empresa` (`id_ruc`, `nombre_empresa`, `telefono`, `email`, `direccion`, `iva`, `empresa_foto`) VALUES
(1851042316, 'MECANICA CUELLOS', '0987122220', 'mecanicacuellos@gmail.com', 'ambato', 0.15, 'MECANICA CUELLOS__MARLON WEB.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_proveedores`
--

CREATE TABLE `tb_proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(255) NOT NULL,
  `celular` varchar(50) NOT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `empresa` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `direccion` varchar(255) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_proveedores`
--

INSERT INTO `tb_proveedores` (`id_proveedor`, `nombre_proveedor`, `celular`, `telefono`, `empresa`, `email`, `direccion`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'Marlon vargas', '0987122220', '0987122220', 'REPUESTOS CUELLOS', 'mmm@gmail.com', 'AMBATO', '2024-07-31 20:50:19', '0000-00-00 00:00:00'),
(2, 'Mario Flores', '0912345678', '0912345678', 'REPUESTOS DELCA', 'jajaja@gmail.com', 'Ambato', '2024-07-31 20:57:17', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_roles`
--

CREATE TABLE `tb_roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(255) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_roles`
--

INSERT INTO `tb_roles` (`id_rol`, `rol`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'ADMINISTRADOR', '2023-01-23 23:15:19', '2023-01-23 23:15:19'),
(2, 'VENDEDOR', '2023-01-23 19:11:28', '2023-01-23 20:13:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_user` text NOT NULL,
  `token` varchar(100) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `usuario_foto` varchar(100) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id_usuario`, `nombres`, `email`, `password_user`, `token`, `id_rol`, `usuario_foto`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'Marlon Vargas', 'vargasmarlon@gmail.com', '$2y$10$E1kJ67nFuCn42jF52R/mp.ZXs5XepqXNG6F9UObAI0zOz4Ji5A1ku', '', 1, '', '2024-07-31 20:44:53', '0000-00-00 00:00:00'),
(4, 'Sebas', 'sebas1@gmail.com', '$2y$10$72oQ7vw2V7V4LQoC1gbgKe1hx.S5bctTtLsvBuQm8yWmQsIO9KE/i', '', 2, '', '2024-08-12 17:53:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_ventas`
--

CREATE TABLE `tb_ventas` (
  `id_ventas` int(11) NOT NULL,
  `id_producto` varchar(150) NOT NULL,
  `nro_venta` int(11) NOT NULL,
  `id_cliente` varchar(150) NOT NULL,
  `id_usuario` varchar(150) NOT NULL,
  `total_pagado` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_ventas`
--

INSERT INTO `tb_ventas` (`id_ventas`, `id_producto`, `nro_venta`, `id_cliente`, `id_usuario`, `total_pagado`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, '2', 1, '3', '1', 25, '2024-08-09 16:18:51', '2024-08-09 16:18:51'),
(2, '3', 2, '1', '1', 35, '2024-08-09 16:18:51', '2024-08-09 16:18:51'),
(7, 'COCA QUINA', 0, 'camila', 'marlon', 14, '2024-08-11 12:00:39', '0000-00-00 00:00:00'),
(8, 'COMPUTADORA GAMES', 0, 'camila', 'marlon', 50000, '2024-08-10 12:01:24', '0000-00-00 00:00:00'),
(9, 'AUDIFONOS', 0, 'Maria Conde', 'sebas', 155, '2024-08-11 12:04:53', '0000-00-00 00:00:00'),
(10, 'AUDIFONOS', 0, 'anael', 'sebas', 140, '2024-08-11 19:46:46', '0000-00-00 00:00:00'),
(11, 'AUDIFONOS', 0, 'vale', 'marlon', 140, '2024-08-11 19:47:28', '0000-00-00 00:00:00'),
(12, '0', 0, '0', '0', 140, '2024-08-11 19:47:29', '0000-00-00 00:00:00'),
(13, '0', 0, '0', '0', 140, '2024-08-11 19:47:44', '0000-00-00 00:00:00'),
(14, '0', 0, '0', '0', 95, '2024-08-11 19:49:00', '0000-00-00 00:00:00'),
(15, '3', 2, '1', '1', 35, '2024-08-10 16:18:51', '2024-08-09 16:18:51'),
(16, '3', 2, '1', '1', 35, '2024-08-10 16:18:51', '2024-08-09 16:18:51'),
(19, '0', 0, '0', '0', 14, '2024-08-12 16:02:10', '0000-00-00 00:00:00'),
(20, '0', 0, '0', '0', 185, '2024-08-12 16:03:20', '0000-00-00 00:00:00'),
(21, '0', 0, '0', '0', 1610, '2024-08-12 16:06:06', '0000-00-00 00:00:00'),
(22, 'COCA QUINA', 0, 'valentina Casa', 'Marlon Vargas', 14, '2024-08-12 17:42:13', '0000-00-00 00:00:00'),
(23, '0', 0, 'Consumidor Final', 'Marlon Vargas', 230, '2024-08-12 17:43:07', '0000-00-00 00:00:00'),
(24, 'AUDIFONOS', 0, 'Maria Conde', 'Sebas', 28, '2024-08-12 18:42:23', '0000-00-00 00:00:00'),
(25, 'AUDIFONOS\r\n', 0, 'Maria casa', 'Sebas', 140, '2024-08-12 18:43:18', '0000-00-00 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_almacen`
--
ALTER TABLE `tb_almacen`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `nombre` (`nombre`);

--
-- Indices de la tabla `tb_categorias`
--
ALTER TABLE `tb_categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `tb_clientes`
--
ALTER TABLE `tb_clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `tb_compras`
--
ALTER TABLE `tb_compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tb_empresa`
--
ALTER TABLE `tb_empresa`
  ADD PRIMARY KEY (`id_ruc`);

--
-- Indices de la tabla `tb_proveedores`
--
ALTER TABLE `tb_proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `tb_roles`
--
ALTER TABLE `tb_roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `tb_ventas`
--
ALTER TABLE `tb_ventas`
  ADD PRIMARY KEY (`id_ventas`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `nro_venta` (`nro_venta`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `nombre` (`id_producto`),
  ADD KEY `nombre_producto` (`id_producto`),
  ADD KEY `id_producto_2` (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_almacen`
--
ALTER TABLE `tb_almacen`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tb_categorias`
--
ALTER TABLE `tb_categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tb_clientes`
--
ALTER TABLE `tb_clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tb_compras`
--
ALTER TABLE `tb_compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tb_proveedores`
--
ALTER TABLE `tb_proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tb_roles`
--
ALTER TABLE `tb_roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tb_ventas`
--
ALTER TABLE `tb_ventas`
  MODIFY `id_ventas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_almacen`
--
ALTER TABLE `tb_almacen`
  ADD CONSTRAINT `tb_almacen_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categorias` (`id_categoria`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_almacen_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_compras`
--
ALTER TABLE `tb_compras`
  ADD CONSTRAINT `tb_compras_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `tb_almacen` (`id_producto`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_compras_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_compras_ibfk_4` FOREIGN KEY (`id_proveedor`) REFERENCES `tb_proveedores` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD CONSTRAINT `tb_usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `tb_roles` (`id_rol`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
