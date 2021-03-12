-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 20, 2021 at 05:21 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tienda`
--
CREATE DATABASE IF NOT EXISTS `tienda` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `tienda`;

-- --------------------------------------------------------

--
-- Table structure for table `caja`
--

DROP TABLE IF EXISTS `caja`;
CREATE TABLE IF NOT EXISTS `caja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monto_inicial` decimal(6,2) NOT NULL,
  `monto_actual` decimal(6,2) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `caja`
--

INSERT INTO `caja` (`id`, `monto_inicial`, `monto_actual`, `id_usuario`, `fecha_registro`) VALUES
(1, '500.00', '500.00', 1, '2021-02-17 21:01:45');

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `telefono` varchar(12) COLLATE latin1_spanish_ci NOT NULL,
  `direccion` varchar(250) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credito`
--

DROP TABLE IF EXISTS `credito`;
CREATE TABLE IF NOT EXISTS `credito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_plazo` int(11) NOT NULL,
  `id_estado_credito` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha_venta` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credito_cooperativa`
--

DROP TABLE IF EXISTS `credito_cooperativa`;
CREATE TABLE IF NOT EXISTS `credito_cooperativa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monto` decimal(6,2) NOT NULL,
  `descripcion` varchar(250) COLLATE latin1_spanish_ci NOT NULL,
  `id_estado_credito` int(11) NOT NULL,
  `responsable` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_credito` datetime NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detalles_creditos`
--

DROP TABLE IF EXISTS `detalles_creditos`;
CREATE TABLE IF NOT EXISTS `detalles_creditos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_credito` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `fecha_venta` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detalles_venta`
--

DROP TABLE IF EXISTS `detalles_venta`;
CREATE TABLE IF NOT EXISTS `detalles_venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `fecha_venta` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `estado_credito`
--

DROP TABLE IF EXISTS `estado_credito`;
CREATE TABLE IF NOT EXISTS `estado_credito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha_liberacion` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `estado_credito`
--

INSERT INTO `estado_credito` (`id`, `nombre`, `estado`, `fecha_liberacion`, `id_usuario`, `fecha_registro`) VALUES
(1, 'Pendientes', 1, '2021-02-19 00:00:00', 2, '2021-02-19 18:46:23'),
(2, 'Pagando', 1, '2021-02-19 00:00:00', 2, '2021-02-19 18:46:23');

-- --------------------------------------------------------

--
-- Table structure for table `estado_credito_coop`
--

DROP TABLE IF EXISTS `estado_credito_coop`;
CREATE TABLE IF NOT EXISTS `estado_credito_coop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gastos`
--

DROP TABLE IF EXISTS `gastos`;
CREATE TABLE IF NOT EXISTS `gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `id_usuario` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gastos_mantenimiento`
--

DROP TABLE IF EXISTS `gastos_mantenimiento`;
CREATE TABLE IF NOT EXISTS `gastos_mantenimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_gasto` int(11) NOT NULL,
  `monto` decimal(6,2) NOT NULL,
  `fecha_gasto` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `id_usuario` int(11) NOT NULL,
  `descripcion` varchar(250) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gastos_reservados`
--

DROP TABLE IF EXISTS `gastos_reservados`;
CREATE TABLE IF NOT EXISTS `gastos_reservados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(250) COLLATE latin1_spanish_ci NOT NULL,
  `total_pago` decimal(6,2) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_pago` date NOT NULL,
  `id_gasto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plazo_credito`
--

DROP TABLE IF EXISTS `plazo_credito`;
CREATE TABLE IF NOT EXISTS `plazo_credito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `duracion` int(11) NOT NULL COMMENT 'duracion en dias',
  `estado` int(11) NOT NULL DEFAULT '1',
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `plazo_credito`
--

INSERT INTO `plazo_credito` (`id`, `duracion`, `estado`, `id_usuario`) VALUES
(1, 7, 1, 2),
(2, 15, 1, 2),
(3, 30, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` varchar(250) COLLATE latin1_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_costo` decimal(6,2) NOT NULL,
  `precio_venta` decimal(6,2) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int(11) NOT NULL DEFAULT '1',
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `descripcion`, `cantidad`, `precio_costo`, `precio_venta`, `fecha_registro`, `estado`, `id_usuario`) VALUES
(1, 'Jabon AXION Barra', 'Barra de 3 unidades', 10, '3.10', '3.75', '2021-02-19 22:45:21', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `regalia`
--

DROP TABLE IF EXISTS `regalia`;
CREATE TABLE IF NOT EXISTS `regalia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `retencion_liberacion_credito_coop`
--

DROP TABLE IF EXISTS `retencion_liberacion_credito_coop`;
CREATE TABLE IF NOT EXISTS `retencion_liberacion_credito_coop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_credito_coop` int(11) NOT NULL,
  `motivo` varchar(300) COLLATE latin1_spanish_ci NOT NULL,
  `fecha_liberacion` datetime NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) NOT NULL,
  `responsable` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `nombre`, `estado`, `fecha_registro`) VALUES
(1, 'Desarrollador', 1, '2021-02-04 10:58:10'),
(2, 'Vendedor', 1, '2021-02-04 10:58:38'),
(3, 'Administrador', 1, '2021-02-04 10:58:47');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `correo` varchar(75) COLLATE latin1_spanish_ci NOT NULL,
  `clave` varchar(250) COLLATE latin1_spanish_ci NOT NULL,
  `telefono` varchar(12) COLLATE latin1_spanish_ci NOT NULL,
  `direccion` varchar(250) COLLATE latin1_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_tipo_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_completo`, `correo`, `clave`, `telefono`, `direccion`, `estado`, `fecha_registro`, `id_tipo_usuario`) VALUES
(1, 'Elmer Rauda', 'erauda@moovitgroup.com', 'ca64c8b7adc14becf33c4c7dee13e98c', '77416041', 'San Salvador', 1, '2021-02-04 10:56:01', 1),
(2, 'Isidro Colocho', 'icolocho', '202cb962ac59075b964b07152d234b70', '00000000', 'El Coyolito', 1, '2021-02-09 20:54:09', 1),
(3, 'Alfredo Rivera', 'erauda20@gmail.com', 'ca64c8b7adc14becf33c4c7dee13e98c', '77416041', 'San Salvador', 1, '2021-02-17 19:50:58', 3);

-- --------------------------------------------------------

--
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
