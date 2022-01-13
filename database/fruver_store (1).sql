-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-01-2022 a las 12:09:57
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
-- Base de datos: `fruver_store`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Verduras'),
(2, 'Frutas'),
(3, 'Otros'),
(4, 'dasdsadas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_pedidos`
--

DROP TABLE IF EXISTS `lineas_pedidos`;
CREATE TABLE IF NOT EXISTS `lineas_pedidos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(255) NOT NULL,
  `producto_id` int(255) NOT NULL,
  `unidades` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_linea_pedido` (`pedido_id`),
  KEY `fk_linea_producto` (`producto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lineas_pedidos`
--

INSERT INTO `lineas_pedidos` (`id`, `pedido_id`, `producto_id`, `unidades`) VALUES
(1, 1, 7, 1),
(2, 1, 6, 1),
(3, 2, 1, 1),
(4, 2, 4, 1),
(5, 3, 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(255) NOT NULL,
  `departamento` varchar(100) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `costo` float(200,2) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pedido_usuario` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `departamento`, `municipio`, `direccion`, `costo`, `estado`, `fecha`, `hora`) VALUES
(1, 3, 'Antioquia', 'Sabaneta', 'cra 46 68-14', 4800.00, 'confirm', '2021-09-08', '14:48:31'),
(2, 5, 'dasd', 'sdadsad', 'dadsadasd', 5000.00, 'confirm', '2021-09-08', '14:50:29'),
(3, 3, 'Antioquia', 'Sabaneta', 'adsadsada', 213123.00, 'confirm', '2021-09-08', '16:12:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text,
  `precio` float(100,2) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `stock` int(255) NOT NULL,
  `oferta` varchar(2) DEFAULT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_producto_categoria` (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `categoria_id`, `nombre`, `descripcion`, `precio`, `estado`, `stock`, `oferta`, `fecha`, `imagen`) VALUES
(1, 1, 'Papa', '1Kg de papa', 2000.00, 'Activo', 100, NULL, '2021-09-07', 'papa.jpg'),
(2, 2, 'Manzana Roja', '1 unidad', 1500.00, 'Activo', 20, NULL, '2021-09-07', 'manzana.jfif'),
(3, 3, 'Coca Cola', '1.5 Lt.', 4000.00, 'Activo', 20, NULL, '2021-09-07', 'cocacola.png'),
(4, 3, 'Huevos', 'Caja 6 huevos.', 3000.00, 'Activo', 15, NULL, '2021-09-07', 'huevos.png'),
(5, 3, 'Bolsa de leche', '1 bolsa de leche 1 lt.', 2500.00, 'Activo', 10, NULL, '2021-09-07', 'leche.png'),
(6, 1, 'Aguacate', '1 aguacate de 0.5 kg.', 3000.00, 'Activo', 100, NULL, '2021-09-07', 'aguacate.png'),
(7, 1, 'Plátano verde', '1 kg. de plátano verde.', 1800.00, 'Activo', 50, NULL, '2021-09-07', 'platano-verde.jpg'),
(8, 2, 'Lulo', '1 kg. de lulo.', 4000.00, 'Activo', 10, NULL, '2021-09-07', 'lulo.png'),
(9, 2, 'Maracuya', '1 kg. de maracuya', 3500.00, 'Activo', 12, NULL, '2021-09-07', 'Maracuya.jpg'),
(10, 4, 'fasdsad', 'dasdadsad', 213123.00, 'Activo', 12, NULL, '2021-09-08', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(20) DEFAULT NULL,
  `estado` varchar(255) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `rol`, `estado`, `imagen`) VALUES
(3, 'admin', 'admin', 'admin@admin.com', '$2y$04$kx7Lz.0n4UGAZ2iz6rranuJ7SgCinnRahKPIW67sny025SuOOcghq', 'admin', 'Activo', NULL),
(4, 'user', 'user', 'user@user.com', '$2y$04$aQHNHaJuyjwDzMShKzOeMOp/z71lJMU/aDeatfi9upAn7KOsWP.9u', 'user', 'Inactivo', NULL),
(5, 'user', 'user', 'useruser@user.com', '$2y$04$DyOMDiwdZ4b4WWFl/DhVLe2AvmMHFUn2EhRhZG0rZxHXLkviO/r2u', 'user', 'Activo', NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lineas_pedidos`
--
ALTER TABLE `lineas_pedidos`
  ADD CONSTRAINT `fk_linea_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `fk_linea_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
