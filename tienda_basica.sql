-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-09-2024 a las 20:05:35
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
-- Base de datos: `tienda_basica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `fecha`) VALUES
(1, 'ELECTRONICA', '2024-05-12 23:55:39'),
(2, 'ELECTRODOMESTICOS', '2024-05-12 23:55:39'),
(3, 'ALMACEN', '2024-05-12 23:55:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL,
  `precioVenta` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `name_file` varchar(350) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `descripcion`, `stock`, `precioVenta`, `status`, `id_cat`, `name_file`, `fecha`) VALUES
(1, 'Caja 2 KG', 7, 10, 'Disponible', 3, 'caja.png', '2024-05-11 22:01:11'),
(2, 'Caja 2.5 KG', 7, 13, 'Disponible', 3, 'caja.png', '2024-05-10 22:01:18'),
(3, 'Caja 5 KG', 0, 30, 'Disponible', 3, 'caja.png', '2024-05-12 22:01:22'),
(4, 'Samsung S20', 11, 5000, 'Disponible', 1, 's20.jpg', '2024-05-13 05:58:14'),
(5, 'Laptop ASUS', 3, 1500, 'Disponible', 1, 'asus.png', '2024-05-13 06:38:35'),
(6, 'Impresora Epson', 11, 5000, 'Disponible', 1, 'printEpson.png', '2024-05-13 06:40:14'),
(7, 'PortaBoligrafos', 10, 200, 'Disponible', 3, 'portaboligrafos.png', '2024-05-13 16:45:32'),
(8, 'Mascara', 9, 50, 'Disponible', 3, 'shadow.jpg', '2024-05-19 23:49:40'),
(11, 'Colchon Matrimonial', 19, 2000, 'Disponible', 2, '', '2024-09-07 09:13:28'),
(12, 'Ropero de sedro', 6, 500, 'Disponible', 3, '', '2024-09-07 09:38:41'),
(13, 'Microondas LG', 5, 1500, 'Disponible', 2, '', '2024-09-07 19:45:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prod_vendidos`
--

CREATE TABLE `prod_vendidos` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` varchar(50) NOT NULL,
  `id_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prod_vendidos`
--

INSERT INTO `prod_vendidos` (`id`, `id_producto`, `cantidad`, `id_venta`) VALUES
(75, 7, '1', 55),
(76, 6, '1', 55),
(77, 7, '1', 56),
(78, 3, '2', 56),
(79, 3, '2', 57),
(80, 8, '1', 57),
(81, 12, '1', 57),
(82, 12, '3', 58),
(83, 11, '1', 58),
(84, 3, '1', 58);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `clave` varchar(350) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `correo`, `clave`, `id_rol`, `fecha`) VALUES
(11, 'Administrador', 'admin@gmail.com', '$2y$05$6ljkcn/Qa2Cb7tv5ULFsn.mNyy9nLOmD/1rm0V9VeFAnOlSiV0G5u', 1, '2024-05-12 16:19:12'),
(12, 'Example', 'example@gmail.com', '$2y$10$efpd/39lDZcC7aAKppmM6u2UHm9Jqdvr5h9gBANnD15QpBuqSTtBu', 2, '2024-05-12 16:19:21'),
(20, 'Emanuel', 'example@gmail.com.mx', '$2y$10$BGCO0LqeWXPXZ3YBiQSHAeJcZl4xr4Vrjg4LOkvsvhIJ7Lt6hwfN2', 2, '2024-05-12 16:23:08'),
(23, 'Alejandro', 'newuser@genotipo.com', '$2y$10$m6qhbfHG.gikhEMET0K5ZOX60v0IfaZqSsEwMu4ocLFZOh6VWLvgO', 2, '2024-05-12 23:53:00'),
(24, 'Alex', 'lex@hotmail.com', '$2y$10$NoGP7qroG9eFpiUBSGswIO1.iDbkypH/4xCQOhZ5rFWrbfEvBFt9e', 2, '2024-05-13 14:39:24'),
(28, 'Marcos', 'marcos@gmail.com', '$2y$10$fWl0Hud5/3E.H/ZNijJgpOVUKO3N0pCKG3YHa.nLfF7OuX2Ba1mQ6', 2, '2024-09-07 17:40:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendidos`
--

CREATE TABLE `vendidos` (
  `id` int(11) NOT NULL,
  `total` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vendidos`
--

INSERT INTO `vendidos` (`id`, `total`, `fecha`, `id_user`, `estado`, `registro`) VALUES
(55, '5200', '2024-09-07', 11, 'Confirmado', '2024-09-07 07:19:15'),
(56, '260', '2024-09-07', 11, 'Pendiente', '2024-09-07 06:48:36'),
(57, '610', '2024-09-07', 24, 'Pendiente', '2024-09-07 07:47:10'),
(58, '3530', '2024-09-07', 28, 'Confirmado', '2024-09-07 17:47:17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `prod_vendidos`
--
ALTER TABLE `prod_vendidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vendidos`
--
ALTER TABLE `vendidos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `prod_vendidos`
--
ALTER TABLE `prod_vendidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `vendidos`
--
ALTER TABLE `vendidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
