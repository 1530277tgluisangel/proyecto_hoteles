-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 27-05-2019 a las 08:53:54
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hoteles`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `numero_cliente` varchar(20) COLLATE utf8_bin NOT NULL,
  `nombres` varchar(100) COLLATE utf8_bin NOT NULL,
  `paterno` varchar(100) COLLATE utf8_bin NOT NULL,
  `materno` varchar(100) COLLATE utf8_bin NOT NULL,
  `id_tipo_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `numero_cliente`, `nombres`, `paterno`, `materno`, `id_tipo_cliente`) VALUES
(1, '21', 'Olivia Vianey', 'Juarez', 'Mireles', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_habitaciones`
--

CREATE TABLE `estado_habitaciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_bin NOT NULL,
  `descripcion` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `estado_habitaciones`
--

INSERT INTO `estado_habitaciones` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Disponible', 'La habitación está a disposición de los clientes'),
(2, 'Ocupada', 'La habitación ya ha sido ocupada por un cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id` int(11) NOT NULL,
  `numero` varchar(50) COLLATE utf8_bin NOT NULL,
  `foto` varchar(50) COLLATE utf8_bin NOT NULL,
  `precio` double NOT NULL,
  `descripcion` text COLLATE utf8_bin NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_tipo_habitacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id`, `numero`, `foto`, `precio`, `descripcion`, `id_estado`, `id_tipo_habitacion`) VALUES
(1, '12', 'habitacion_1.jpg', 500, ' ', 2, 3),
(2, '67', 'habitacion_1.jpg', 0, ' ', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservaciones`
--

CREATE TABLE `reservaciones` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `numero_reservacion` varchar(20) COLLATE utf8_bin NOT NULL,
  `fecha_reserva` varchar(30) COLLATE utf8_bin NOT NULL,
  `dias_estadia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `reservaciones`
--

INSERT INTO `reservaciones` (`id`, `id_cliente`, `id_habitacion`, `numero_reservacion`, `fecha_reserva`, `dias_estadia`) VALUES
(3, 1, 2, '32', '2019-05-26', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_clientes`
--

CREATE TABLE `tipo_clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_bin NOT NULL,
  `descripcion` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tipo_clientes`
--

INSERT INTO `tipo_clientes` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Habitual', 'Acude mucho al hotel'),
(2, 'Esporádico', 'No va mucho');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_habitaciones`
--

CREATE TABLE `tipo_habitaciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_bin NOT NULL,
  `descripcion` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tipo_habitaciones`
--

INSERT INTO `tipo_habitaciones` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Simple', 'Descripción de habitación simple'),
(2, 'Doble', 'Descripción de habitación doble'),
(3, 'Matrimonial', 'Descripción habitación matrimonial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuarios`
--

CREATE TABLE `tipo_usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_bin NOT NULL,
  `descripcion` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tipo_usuarios`
--

INSERT INTO `tipo_usuarios` (`id`, `nombre`, `descripcion`) VALUES
(1, 'admin', 'Usuario con control del área administrativa del negocio'),
(2, 'recepcionista', 'Usuario encargado de hacer las reservaciones de los cuartos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `user_name` varchar(30) COLLATE utf8_bin NOT NULL,
  `passw` varchar(30) COLLATE utf8_bin NOT NULL,
  `nombres` varchar(30) COLLATE utf8_bin NOT NULL,
  `paterno` varchar(30) COLLATE utf8_bin NOT NULL,
  `materno` varchar(30) COLLATE utf8_bin NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `user_name`, `passw`, `nombres`, `paterno`, `materno`, `id_tipo_usuario`) VALUES
(1, 'admin', 'admin', 'Mario Humberto', 'Rodríguez', 'Chávez', 1),
(2, '1530277', 'luis', 'Luis Angel', 'Torres', 'Grimaldo', 2),
(5, 'p2', 'user', 'prueba', 'prueba', 'prueb', 1),
(6, 'prueba', 'prueba', 'Prueba', 'Prueba', 'Prueba', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_cliente` (`numero_cliente`),
  ADD KEY `id_tipo_cliente` (`id_tipo_cliente`);

--
-- Indices de la tabla `estado_habitaciones`
--
ALTER TABLE `estado_habitaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero` (`numero`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_tipo_habitacion` (`id_tipo_habitacion`);

--
-- Indices de la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_habitacion` (`id_habitacion`);

--
-- Indices de la tabla `tipo_clientes`
--
ALTER TABLE `tipo_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_habitaciones`
--
ALTER TABLE `tipo_habitaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_usuarios`
--
ALTER TABLE `tipo_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD KEY `id_tipo_usuario` (`id_tipo_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estado_habitaciones`
--
ALTER TABLE `estado_habitaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_clientes`
--
ALTER TABLE `tipo_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_habitaciones`
--
ALTER TABLE `tipo_habitaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_usuarios`
--
ALTER TABLE `tipo_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`id_tipo_cliente`) REFERENCES `tipo_clientes` (`id`);

--
-- Filtros para la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD CONSTRAINT `habitaciones_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado_habitaciones` (`id`),
  ADD CONSTRAINT `habitaciones_ibfk_2` FOREIGN KEY (`id_tipo_habitacion`) REFERENCES `tipo_habitaciones` (`id`);

--
-- Filtros para la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  ADD CONSTRAINT `reservaciones_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `reservaciones_ibfk_2` FOREIGN KEY (`id_habitacion`) REFERENCES `habitaciones` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
