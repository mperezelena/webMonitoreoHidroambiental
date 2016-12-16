-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 24-11-2016 a las 18:13:31
-- Versión del servidor: 5.7.16-0ubuntu0.16.04.1
-- Versión de PHP: 5.6.27-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pfc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `1`
--

CREATE TABLE `1` (
  `fecha_hora` datetime NOT NULL,
  `temp_a_dh` float NOT NULL,
  `hum_a_dh` float NOT NULL,
  `temp_s_ds` float NOT NULL,
  `hum_s_fc` float NOT NULL,
  `temp_s_sh` float NOT NULL,
  `hum_s_sh` float NOT NULL,
  `vel_v` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `1`
--

INSERT INTO `1` (`fecha_hora`, `temp_a_dh`, `hum_a_dh`, `temp_s_ds`, `hum_s_fc`, `temp_s_sh`, `hum_s_sh`, `vel_v`) VALUES
('2016-10-20 00:00:00', 22.9, 63, 20.6, 65, 21.3, 66, 6.7),
('2016-10-20 02:00:00', 21.9, 63, 20.2, 65, 20.9, 66, 6.8),
('2016-10-20 04:00:00', 22.3, 64, 19.6, 65, 20.1, 64, 7.6),
('2016-10-20 06:00:00', 23, 62, 19.8, 65, 20.5, 63, 8),
('2016-10-20 08:00:00', 23.9, 61, 20, 65, 21.1, 61, 8.4),
('2016-10-20 10:00:00', 24.4, 60, 20.1, 80, 21.5, 60, 8.5),
('2016-10-20 12:00:00', 26.1, 63, 20.3, 75, 21, 60, 7.6),
('2016-10-20 14:00:00', 26.6, 62, 21.1, 67, 21.6, 59, 7.4),
('2016-10-20 16:00:00', 26.7, 63, 20.9, 75, 21.5, 59, 7.4),
('2016-10-20 18:00:00', 25.5, 63, 20.9, 68, 21.4, 58, 7),
('2016-10-20 20:00:00', 22.6, 65, 20, 50, 20.8, 59, 7.2),
('2016-10-20 22:00:00', 20.5, 66, 19.9, 51, 20.2, 59, 7.4),
('2016-10-21 00:00:00', 19.6, 67, 18, 75, 19.1, 60, 7.4),
('2016-10-21 02:00:00', 18.3, 67, 17.9, 67, 19, 62, 7.3),
('2016-10-21 04:00:00', 17.9, 69, 18.1, 75, 18.8, 63, 7),
('2016-10-21 06:00:00', 18, 69, 18, 68, 18.9, 64, 7.1),
('2016-10-21 08:00:00', 18.8, 67, 18.8, 50, 19.3, 63, 6.9),
('2016-10-21 10:00:00', 20.1, 65, 20.3, 65, 20.9, 62, 6.9),
('2016-10-21 12:00:00', 22, 64, 21, 66, 22, 60, 6.5),
('2016-10-21 14:00:00', 22.3, 60, 21.2, 65, 22.1, 59, 6.6),
('2016-10-21 16:00:00', 23, 59, 21.4, 66, 22, 57, 6.5),
('2016-10-21 18:00:00', 22.4, 58, 21.2, 65, 21.8, 57, 6.7),
('2016-10-21 20:00:00', 20.8, 60, 21.4, 67, 22.1, 59, 7),
('2016-10-21 22:00:00', 20, 63, 20.6, 65, 21.2, 60, 6.9),
('2016-10-22 00:00:00', 19.5, 65, 19, 65, 19.9, 62, 6.7),
('2016-10-22 02:00:00', 18.9, 65, 18.6, 65, 19, 62, 6.8),
('2016-10-22 04:00:00', 18, 68, 18.5, 66, 19.1, 63, 7),
('2016-10-22 06:00:00', 19, 67, 18.7, 65, 19.3, 62, 6.9),
('2016-10-22 08:00:00', 19.9, 65, 19, 65, 19.5, 60, 6.8),
('2016-10-22 10:00:00', 20.6, 62, 19.9, 65, 20, 59, 6),
('2016-10-22 12:00:00', 22.1, 61, 20.3, 70, 20.6, 57, 5.8),
('2016-10-22 14:00:00', 23.9, 57, 21.8, 70, 21, 56, 6.1),
('2016-10-22 16:00:00', 24, 56, 21.7, 70, 21.1, 56, 6.2),
('2016-10-22 18:00:00', 23.2, 57, 21.3, 70, 20.9, 57, 6.2),
('2016-10-22 20:00:00', 21.8, 59, 21, 70, 20.4, 57, 6),
('2016-10-22 22:00:00', 20.9, 63, 20.5, 70, 20, 59, 7.3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `2`
--

CREATE TABLE `2` (
  `fecha_hora` datetime NOT NULL,
  `temp_a_dh` float NOT NULL,
  `hum_a_dh` float NOT NULL,
  `temp_s_sh` float NOT NULL,
  `hum_s_sh` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `2`
--

INSERT INTO `2` (`fecha_hora`, `temp_a_dh`, `hum_a_dh`, `temp_s_sh`, `hum_s_sh`) VALUES
('2016-10-19 00:00:00', 23, 55, 30, 70),
('2016-10-21 08:00:00', 28, 50, 22, 65),
('2016-11-02 08:00:00', 13, 60, 16, 72);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estacion`
--

CREATE TABLE `estacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `intervalo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estacion`
--

INSERT INTO `estacion` (`id`, `nombre`, `intervalo`) VALUES
(1, 'FICH', 60),
(2, 'Cululú', 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_us`
--

CREATE TABLE `nivel_us` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nivel_us`
--

INSERT INTO `nivel_us` (`id`, `nombre`) VALUES
(1, 'administrador'),
(2, 'invitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sensor`
--

CREATE TABLE `sensor` (
  `id` int(11) NOT NULL,
  `modelo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `id_fabricante` int(11) NOT NULL,
  `id_variable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `id_nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `clave`, `id_nivel`) VALUES
(1, 'admin', '1234', 1),
(2, 'invitado', '123', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variable`
--

CREATE TABLE `variable` (
  `num` int(11) NOT NULL,
  `id` varchar(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `1` int(11) NOT NULL,
  `2` int(11) NOT NULL,
  `sensor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `variable`
--

INSERT INTO `variable` (`num`, `id`, `nombre`, `1`, `2`, `sensor`) VALUES
(2, 'hum_a_dh', 'Humedad ambiente [%]', 11, 10, 'DHT22'),
(4, 'hum_s_fc', 'Humedad de suelo [%]', 11, 0, 'FC28'),
(6, 'hum_s_sh', 'Humedad de suelo [%]', 11, 11, 'SHT10'),
(1, 'temp_a_dh', 'Temperatura ambiente [°C]', 11, 10, 'DHT22'),
(3, 'temp_s_ds', 'Temperatura de suelo [°C]', 11, 0, 'DS18B20'),
(5, 'temp_s_sh', 'Temperatura de suelo [°C]', 11, 11, 'SHT10'),
(7, 'vel_v', 'Velocidad de viento [km/h]', 11, 0, 'Anemómetro');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `1`
--
ALTER TABLE `1`
  ADD PRIMARY KEY (`fecha_hora`);

--
-- Indices de la tabla `estacion`
--
ALTER TABLE `estacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nivel_us`
--
ALTER TABLE `nivel_us`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nivel_usuario` (`id_nivel`);

--
-- Indices de la tabla `variable`
--
ALTER TABLE `variable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `nivel_usuario` FOREIGN KEY (`id_nivel`) REFERENCES `nivel_us` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
