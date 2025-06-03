-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-06-2025 a las 18:20:40
-- Versión del servidor: 8.0.33
-- Versión de PHP: 8.0.30

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
(7, 'Cabaña en Bariloche', 'Una linda cabaña ubicada en un lugar increíble de Bariloche, rodeada de naturaleza y tranquilidad. Perfecta para descansar, disfrutar del paisaje y desconectar de la rutina. Ideal para pasar unos días en la montaña, cerca del lago y con una vista hermosa.', 1, 6, 200000.00, 'img/683f0c7110305_mejores-cabanas-en-bariloche-cabanita-en-el-bosque-1.jpg', 'img/683f0c7111e19_Bariloche-postada-833x471.jpg', 'img/683f0c711203b_bariloche-turismo.webp', 'img/683f0c71121fb_images.jpg', 4, 1, 'Bariloche, Argentina.', 'casa', 1, 1, 0, 1),
(8, 'Departamento en Bariloche', 'Disfrutá de una estadía única en este moderno departamento ubicado en el corazón de San Carlos de Bariloche. A tan solo unas cuadras del Centro Cívico y con una vista privilegiada al lago Nahuel Huapi, este alojamiento combina comodidad, estilo y una ubicación inmejorable.\r\n\r\nEl departamento cuenta con una habitación amplia con cama queen, living con sofá cama, cocina completamente equipada y baño moderno. Ideal para parejas, aventureros solitarios o familias pequeñas. Además, ofrece calefacción central, Wi-Fi de alta velocidad, Smart TV y cochera cubierta (opcional).\r\n\r\nDespués de un día explorando el cerro Catedral o caminando por el Circuito Chico, relajate mirando el atardecer desde el balcón o preparando una cena con vista a la cordillera.', 1, 6, 100000.00, 'img/683f0e47d1b33_5c-1.jpg', 'img/683f0e47d265b_1c-1.jpg', 'img/683f0e47d2acc_images (1).jpg', 'img/683f0e47d2f1e_200399583.jpg', 1, 1, 'Bariloche, Argentina.', 'departamento', 1, 0, 0, 1),
(10, 'Templo en Osaka', 'Un templo único en el corazón de Osaka, perfecto para una experiencia distinta y espiritual. Rodeado de historia y serenidad, este espacio es ideal para quienes buscan paz, inspiración o simplemente algo fuera de lo común. Dormí entre muros centenarios, escuchá el silencio y conectate con lo esencial en un lugar que no se parece a ningún otro.', 1, 6, 800000.00, 'img/683f1ffb968c0_1200px-Kinkaku3402CBcropped.jpg', 'img/683f1ffb96d2c_477571-Osaka.jpg', 'img/683f1ffb97d98_osaka-dotonbori-iStock-1138049211-1024x683.jpg', 'img/683f1ffb98016_198086.jpg', 8, 6, 'Osaka, Japon', 'casa', 0, 0, 0, 0);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
