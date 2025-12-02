-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 02-12-2025 a las 16:47:00
-- Versión del servidor: 8.0.44
-- Versión de PHP: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `autor` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'Desconocido',
  `n_paginas` int DEFAULT '0',
  `fecha_publicacion` date DEFAULT '2001-01-01',
  `terminado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `titulo`, `autor`, `n_paginas`, `fecha_publicacion`, `terminado`) VALUES
(1, 'La mariposa mujer', 'Anónimo', 2, '2026-01-01', 1),
(3, 'Gregorio, el hombre que supo luchar', 'Sabina Alonso', 119, '1995-05-06', 1),
(4, 'La Soledad', 'Anónimo', 0, '1999-12-02', 0),
(7, 'Doña Casilda, Bilboko emakumerik zoragarriena', 'Mikel Garrido', 400, '1981-12-06', NULL),
(8, 'Y corriendo volvería a esperarte', 'El Portal De Mi Vida', 34, '2007-06-06', NULL),
(9, '1978: Espainiako Demokrazia', 'Nemesio Calzagorta,Laratz Urichirtu', 1300, '2004-12-06', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`) VALUES
(130, 'dweb', '$2y$10$QldwMe5TEWNjzjOz6DPpCeDxe5yYFP8rwV84tE5v/1jSwcfItIp86'),
(131, 'mikel', '$2y$10$cuOCaAMXQ0EnLh59BeMbNuFsWPzSaZeRQmVkgv8lenSjtL0TpWD8W'),
(133, 'mikel_navarro', '$2y$10$T0.GHTJutBnfC7uzQQh5cekV2/1IQXrZTfxwaPvgRm3KvaWHAtPXG'),
(134, 'lola_mento', '$2y$10$RkyogAuhjaMTbhNo6mKQ2eBehAszUhO3mclaR4z8fCddUGutZiCF6');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `titulo` (`titulo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
