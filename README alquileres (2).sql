-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2025 a las 21:24:14
-- Versión del servidor: 8.0.41
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `airbnb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquileres`
--

CREATE TABLE `alquileres` (
  `id` int NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `disponible` tinyint(1) DEFAULT '1',
  `persona_id` int DEFAULT NULL,
  `precio_por_noche` decimal(10,2) NOT NULL,
  `urlimg` text NOT NULL,
  `urlimg2` text NOT NULL,
  `urlimg3` text NOT NULL,
  `urlimg4` text NOT NULL,
  `habitaciones` int NOT NULL,
  `banos` int NOT NULL,
  `direccion` text NOT NULL,
  `tipoAlojamiento` text NOT NULL,
  `tieneWifi` tinyint(1) NOT NULL,
  `tieneAire` tinyint(1) NOT NULL,
  `tieneCocina` tinyint(1) NOT NULL,
  `tieneTelevision` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alquileres`
--

INSERT INTO `alquileres` (`id`, `titulo`, `descripcion`, `disponible`, `persona_id`, `precio_por_noche`, `urlimg`, `urlimg2`, `urlimg3`, `urlimg4`, `habitaciones`, `banos`, `direccion`, `tipoAlojamiento`, `tieneWifi`, `tieneAire`, `tieneCocina`, `tieneTelevision`) VALUES
(2, 'Cabaña en las lomitas', 'cualquiera que decia', 1, 1, 10000.00, '', '', '', '', 0, 0, '', '', 0, 0, 0, 0),
(3, 'la casa de lauta', '123', 1, 1, 48000.00, '', '', '', '', 0, 0, '', '', 0, 0, 0, 0),
(4, 'Colapinto', 'Un colapinto chaval', 1, 1, 100.00, 'img/editcolapa.jpg', '', '', '', 3, 1, 'Monaco papa', 'departamento', 0, 0, 0, 0),
(5, 'Casa de brignoli', 'la casucha de brignoli', 1, 1, 50000.00, 'img/{8A5842B8-9D1D-48F6-BE9C-5A4983AB49D8}.png', '', '', '', 1, 1, 'lomas', 'casa', 0, 0, 0, 0),
(6, 'Hermosa casa en bariloche frente al lago', 'Sumergite en la tranquilidad de Bariloche en esta cálida cabaña de montaña, rodeada de bosques nativos y con vista parcial al lago Nahuel Huapi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse potenti. Vivamus quis magna a ex ullamcorper tempor.\r\n\r\nLa casa cuenta con amplios ventanales que permiten disfrutar del paisaje patagónico desde cada rincón. Curabitur nec nisl nec magna eleifend eleifend. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.\r\n\r\nIdeal para escapadas en pareja o en familia, con cocina totalmente equipada, estufa a leña y deck exterior con parrilla. Nulla facilisi. Nam dapibus, sapien in fermentum congue, tortor odio dignissim sapien, a tempus tellus augue vitae velit.', 1, 1, 500000.00, 'img/68375c2d6fa12_huge1592508692c1933c99a57083b39c48d7f3d7c0fcf3.jpg', 'img/68375c2d702a4_https___tr2storage.blob.core.windows.net_imagenes_NLzrVg9ieSiY2fEOUW-VmVLMeWrIP.jpeg', 'img/68375c2d703b3_images (1).jpg', 'img/68375c2d704b1_images.jpg', 4, 2, 'Bariloche, Rio Negro, Argentina', 'casa', 1, 1, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persona_id` (`persona_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD CONSTRAINT `alquileres_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
