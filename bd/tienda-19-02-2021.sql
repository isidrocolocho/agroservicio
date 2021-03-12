-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-02-2021 a las 03:11:17
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--
CREATE DATABASE IF NOT EXISTS `tienda` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `tienda`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id` int(11) NOT NULL,
  `monto_inicial` decimal(6,2) NOT NULL,
  `monto_actual` decimal(6,2) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id`, `monto_inicial`, `monto_actual`, `id_usuario`, `fecha_registro`) VALUES
(1, '500.00', '500.00', 1, '2021-02-17 21:01:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `telefono` varchar(12) COLLATE latin1_spanish_ci NOT NULL,
  `direccion` varchar(250) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre_completo`, `telefono`, `direccion`, `fecha_registro`, `id_usuario`) VALUES
(1, 'Beto Colocho ', '77416041', 'Ã±sdngondsgjsndgsd', '2021-02-19 18:40:15', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credito`
--

CREATE TABLE `credito` (
  `id` int(11) NOT NULL,
  `id_plazo` int(11) NOT NULL,
  `id_estado_credito` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha_venta` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `credito`
--

INSERT INTO `credito` (`id`, `id_plazo`, `id_estado_credito`, `estado`, `fecha_venta`, `id_usuario`, `id_cliente`) VALUES
(1, 1, 1, 1, '2021-02-19 19:30:36', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credito_cooperativa`
--

CREATE TABLE `credito_cooperativa` (
  `id` int(11) NOT NULL,
  `monto` decimal(6,2) NOT NULL,
  `descripcion` varchar(250) COLLATE latin1_spanish_ci NOT NULL,
  `id_estado_credito` int(11) NOT NULL,
  `responsable` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_credito` datetime NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_creditos`
--

CREATE TABLE `detalles_creditos` (
  `id` int(11) NOT NULL,
  `id_credito` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `fecha_venta` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `detalles_creditos`
--

INSERT INTO `detalles_creditos` (`id`, `id_credito`, `id_producto`, `cantidad`, `precio`, `fecha_venta`) VALUES
(1, 1, 7, 1, '0.25', '2021-02-19 19:30:36'),
(2, 1, 6, 1, '0.50', '2021-02-19 19:30:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_venta`
--

CREATE TABLE `detalles_venta` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `fecha_venta` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `detalles_venta`
--

INSERT INTO `detalles_venta` (`id`, `id_venta`, `id_producto`, `cantidad`, `precio`, `fecha_venta`) VALUES
(2, 1, 4, 1, '0.25', '2021-02-12 00:17:35'),
(3, 2, 1, 1, '1.30', '2021-02-12 00:17:51'),
(4, 2, 2, 1, '0.25', '2021-02-12 00:17:51'),
(5, 3, 2, 2, '0.25', '2021-02-12 10:34:14'),
(6, 3, 3, 2, '0.35', '2021-02-12 10:34:14'),
(7, 4, 4, 2, '0.25', '2021-02-14 08:40:10'),
(8, 4, 1, 3, '1.30', '2021-02-14 08:40:10'),
(9, 5, 5, 2, '0.50', '2021-02-14 08:43:24'),
(10, 10, 5, 5, '0.50', '2021-02-14 08:54:13'),
(11, 11, 6, 5, '0.50', '2021-02-14 08:57:09'),
(12, 12, 6, 3, '0.50', '2021-02-14 08:58:29'),
(13, 13, 7, 3, '0.25', '2021-02-14 09:03:26'),
(14, 14, 6, 2, '0.50', '2021-02-14 09:05:00'),
(15, 14, 7, 2, '0.25', '2021-02-14 09:05:00'),
(16, 15, 7, 10, '0.25', '2021-02-17 19:49:40'),
(17, 15, 6, 2, '0.50', '2021-02-17 19:49:40'),
(18, 16, 6, 2, '0.50', '2021-02-17 20:02:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_credito`
--

CREATE TABLE `estado_credito` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha_liberacion` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `estado_credito`
--

INSERT INTO `estado_credito` (`id`, `nombre`, `estado`, `fecha_liberacion`, `id_usuario`, `fecha_registro`) VALUES
(1, 'Pendientes', 1, '2021-02-19 00:00:00', 2, '2021-02-19 18:46:23'),
(2, 'Pagando', 1, '2021-02-19 00:00:00', 2, '2021-02-19 18:46:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_credito_coop`
--

CREATE TABLE `estado_credito_coop` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `id_usuario` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id`, `nombre`, `estado`, `id_usuario`, `fecha_registro`) VALUES
(1, 'Recibos', 1, 3, '2021-02-17 21:39:41'),
(2, 'Invitados', 1, 3, '2021-02-17 22:27:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_mantenimiento`
--

CREATE TABLE `gastos_mantenimiento` (
  `id` int(11) NOT NULL,
  `id_gasto` int(11) NOT NULL,
  `monto` decimal(6,2) NOT NULL,
  `fecha_gasto` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `id_usuario` int(11) NOT NULL,
  `descripcion` varchar(250) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_reservados`
--

CREATE TABLE `gastos_reservados` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plazo_credito`
--

CREATE TABLE `plazo_credito` (
  `id` int(11) NOT NULL,
  `duracion` int(11) NOT NULL COMMENT 'duracion en dias',
  `estado` int(11) NOT NULL DEFAULT '1',
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `plazo_credito`
--

INSERT INTO `plazo_credito` (`id`, `duracion`, `estado`, `id_usuario`) VALUES
(1, 7, 1, 2),
(2, 15, 1, 2),
(3, 30, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` varchar(250) COLLATE latin1_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_costo` decimal(6,2) NOT NULL,
  `precio_venta` decimal(6,2) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int(11) NOT NULL DEFAULT '1',
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `descripcion`, `cantidad`, `precio_costo`, `precio_venta`, `fecha_registro`, `estado`, `id_usuario`) VALUES
(7, 'Jabon barra AXION', 'Jabon barra', 9, '0.15', '0.25', '2021-02-14 08:58:58', 1, 1),
(6, 'Paquete servilletas', 'Servilletas dany', 0, '0.35', '0.50', '2021-02-14 08:56:52', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regalia`
--

CREATE TABLE `regalia` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retencion_liberacion_credito_coop`
--

CREATE TABLE `retencion_liberacion_credito_coop` (
  `id` int(11) NOT NULL,
  `id_credito_coop` int(11) NOT NULL,
  `motivo` varchar(300) COLLATE latin1_spanish_ci NOT NULL,
  `fecha_liberacion` datetime NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) NOT NULL,
  `responsable` varchar(200) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `nombre`, `estado`, `fecha_registro`) VALUES
(1, 'Desarrollador', 1, '2021-02-04 10:58:10'),
(2, 'Vendedor', 1, '2021-02-04 10:58:38'),
(3, 'Administrador', 1, '2021-02-04 10:58:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `correo` varchar(75) COLLATE latin1_spanish_ci NOT NULL,
  `clave` varchar(250) COLLATE latin1_spanish_ci NOT NULL,
  `telefono` varchar(12) COLLATE latin1_spanish_ci NOT NULL,
  `direccion` varchar(250) COLLATE latin1_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_tipo_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_completo`, `correo`, `clave`, `telefono`, `direccion`, `estado`, `fecha_registro`, `id_tipo_usuario`) VALUES
(1, 'Elmer Rauda', 'erauda@moovitgroup.com', 'ca64c8b7adc14becf33c4c7dee13e98c', '77416041', 'San Salvador', 1, '2021-02-04 10:56:01', 1),
(2, 'Isidro Colocho', 'icolocho', '202cb962ac59075b964b07152d234b70', '00000000', 'El Coyolito', 1, '2021-02-09 20:54:09', 1),
(3, 'Alfredo Rivera', 'erauda20@gmail.com', 'ca64c8b7adc14becf33c4c7dee13e98c', '77416041', 'San Salvador', 1, '2021-02-17 19:50:58', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fecha`, `id_usuario`) VALUES
(11, '2021-02-14 08:57:09', 1),
(12, '2021-02-14 08:58:29', 1),
(13, '2021-02-14 09:03:26', 1),
(14, '2021-02-14 09:05:00', 1),
(15, '2021-02-17 19:49:39', 1),
(16, '2021-02-17 20:02:57', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `credito`
--
ALTER TABLE `credito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `credito_cooperativa`
--
ALTER TABLE `credito_cooperativa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalles_creditos`
--
ALTER TABLE `detalles_creditos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_credito`
--
ALTER TABLE `estado_credito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_credito_coop`
--
ALTER TABLE `estado_credito_coop`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gastos_mantenimiento`
--
ALTER TABLE `gastos_mantenimiento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gastos_reservados`
--
ALTER TABLE `gastos_reservados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `plazo_credito`
--
ALTER TABLE `plazo_credito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `regalia`
--
ALTER TABLE `regalia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `retencion_liberacion_credito_coop`
--
ALTER TABLE `retencion_liberacion_credito_coop`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `credito`
--
ALTER TABLE `credito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `credito_cooperativa`
--
ALTER TABLE `credito_cooperativa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalles_creditos`
--
ALTER TABLE `detalles_creditos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `estado_credito`
--
ALTER TABLE `estado_credito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estado_credito_coop`
--
ALTER TABLE `estado_credito_coop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `gastos_mantenimiento`
--
ALTER TABLE `gastos_mantenimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gastos_reservados`
--
ALTER TABLE `gastos_reservados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plazo_credito`
--
ALTER TABLE `plazo_credito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `regalia`
--
ALTER TABLE `regalia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `retencion_liberacion_credito_coop`
--
ALTER TABLE `retencion_liberacion_credito_coop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
