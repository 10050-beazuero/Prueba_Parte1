-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-05-2023 a las 16:57:29
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `matriculacionvehicular`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agencia`
--

CREATE TABLE `agencia` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `descripcion` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `foto` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `horario_inicio` date NOT NULL,
  `horario_finalizacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `agencia`
--

INSERT INTO `agencia` (`id`, `descripcion`, `direccion`, `telefono`, `foto`, `horario_inicio`, `horario_finalizacion`) VALUES
(1, 'Los Chillos', 'Genral. Rumiñahui', '6054874', 'agencia-conocoto.jpg', '2023-02-11', '2023-02-12'),
(2, 'Cotocollao', 'La prensa', '6048754', 'agencia-cotocollao.jpg', '2023-01-05', '2023-01-07'),
(3, 'Ibarra', 'Calle Sucre y Olmedo', '0968754296', 'agencia-ibarra.jpg', '2023-04-01', '2023-04-03'),
(4, 'Manta', 'Av. 4ta y calle 23', '052056987', 'agencia-manta.jpg', '2023-06-01', '2023-06-03'),
(5, 'Santo Domingo', 'Av. Quito y Esmeraldas', '0968754296', 'agencia-santo-domingo.jpg', '2023-07-12', '2023-07-14'),
(6, 'Quito Sur', 'Av. Morán Valverde y Juan de Selis', '022323456', 'agencia-quito-sur.jpg', '2023-09-01', '2023-09-03'),
(7, 'Cuenca', 'Gran Colombia 9-69 y Benigno Malo', '074654789', 'agencia-cuenca.jpg', '2023-08-01', '2023-08-03'),
(8, 'Guayaquil Norte', 'Vía Daule, Km. 7 1/2', '042069745', 'agencia-guayaquil-norte.jpg', '2023-11-05', '2023-11-07'),
(9, 'Ambato', 'Av. Cevallos 555', '032845698', 'agencia-ambato.jpg', '2023-12-01', '2023-12-03'),
(10, 'Riobamba', 'Av. 10 de Agosto y Olmedo', '032658974', 'agencia-riobamba.jpg', '2023-10-01', '2023-10-03'),
(11, 'Loja', 'Av. Isidro Ayora y 10 de Agosto', '072589635', 'agencia-loja.jpg', '2023-05-01', '2023-05-03'),
(12, 'Portoviejo', 'Av. 5 de junio y Av. Flavio Reyes', '052089745', 'agencia-portoviejo.jpg', '2023-03-01', '2023-03-03'),
(13, 'Quito Sur', 'Guamani', '998740580', 'wOKogfxdvtEX.jpg', '2023-02-13', '2023-05-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color`
--

CREATE TABLE `color` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `color`
--

INSERT INTO `color` (`id`, `descripcion`) VALUES
(2, 'Negro'),
(3, 'Rojo'),
(4, 'Azul'),
(5, 'Plomo'),
(6, 'Verde'),
(7, 'Negro'),
(8, 'Plata'),
(9, 'Morado'),
(10, 'Naranja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `pais` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `foto` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id`, `descripcion`, `pais`, `direccion`, `foto`) VALUES
(1, 'Chévrolet', 'USA', 'Detroid', 'chevrolet.jpg'),
(2, 'Fiat', 'Italia', 'Nizza', 'fiat.jpg'),
(4, 'Great Wall', 'China', 'Shangai', 'great.jpg'),
(5, 'Toyota', 'Japón', 'Nagoya', 'toy.jpg'),
(6, 'Ford', 'USA', 'Michigan', 'ford.jpg'),
(7, 'Nissan', 'Japón', 'Yokohama', 'nissan.jpg'),
(8, 'Renault', 'Francia', 'Boulogne-Billancourt', 'renault.jpg'),
(9, 'Mazda', 'Japón', 'Fuchū', 'maz.jpg'),
(10, 'Volkswagen', 'Alemania', 'Wolfsburgo', 'volks.jpg'),
(12, 'Ferrari', 'Italia', 'Turin', 'HkDMrsvfsFvh.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `vehiculo` mediumint(8) UNSIGNED NOT NULL,
  `agencia` tinyint(3) UNSIGNED NOT NULL,
  `anio` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`id`, `fecha`, `vehiculo`, `agencia`, `anio`) VALUES
(2, '2023-05-13', 5, 1, 2000),
(3, '2023-05-13', 6, 6, 2022),
(4, '2023-05-13', 7, 13, 2021),
(5, '2023-05-14', 5, 13, 2002),
(6, '2023-05-14', 11, 1, 2000),
(7, '2023-05-14', 8, 8, 2015),
(8, '2023-05-14', 11, 11, 2019);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `placa` char(7) COLLATE utf8_spanish2_ci NOT NULL,
  `marca` smallint(5) UNSIGNED NOT NULL,
  `motor` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `chasis` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `combustible` enum('Gasolina','Diesel','Eléctrico') COLLATE utf8_spanish2_ci NOT NULL,
  `anio` year(4) NOT NULL,
  `color` smallint(5) UNSIGNED NOT NULL,
  `foto` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `avaluo` decimal(8,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`id`, `placa`, `marca`, `motor`, `chasis`, `combustible`, `anio`, `color`, `foto`, `avaluo`) VALUES
(5, 'ACB3465', 1, 'dede', 'Dede', 'Gasolina', 2017, 2, 'onix.jpg', '25415.00'),
(6, 'PHH2354', 1, 'sswe', 'eddede', 'Gasolina', 1962, 6, 'spark.jpg', '23541.36'),
(7, 'CHH3465', 5, 'edcdede', 'Dedede', 'Gasolina', 2017, 10, 'toyota_corolla.jpg', '25412.00'),
(8, 'PRURBA', 5, 'MIVC', '12344R', 'Diesel', 2018, 2, 'toyota_negro.jpg', '20000.00'),
(10, 'POIQW', 9, 'asd', 'qwet', 'Gasolina', 1992, 9, 'Mazda.jpg', '15000.00'),
(11, 'JUJA12', 9, 'iosda', 'qwescs', 'Gasolina', 1969, 4, 'CuhiayhCBgcp.jpg', '15000.00'),
(12, 'AA01', 12, 'TURNO', 'DISHXSSD', 'Gasolina', 2017, 3, 'ECJkTlvSAgSh.jpg', '74000.00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agencia`
--
ALTER TABLE `agencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehiculo` (`vehiculo`),
  ADD KEY `agencia` (`agencia`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marca` (`marca`),
  ADD KEY `color` (`color`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agencia`
--
ALTER TABLE `agencia`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `color`
--
ALTER TABLE `color`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `matricula`
--
ALTER TABLE `matricula`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_agencia` FOREIGN KEY (`agencia`) REFERENCES `agencia` (`id`),
  ADD CONSTRAINT `matricula_vehiculo` FOREIGN KEY (`vehiculo`) REFERENCES `vehiculo` (`id`);

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `vehiculo_color` FOREIGN KEY (`color`) REFERENCES `color` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehiculo_marca` FOREIGN KEY (`marca`) REFERENCES `marca` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
